<?php
/**
 * Demo Content Generator for BRUISER TECH LHPARFUM
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function lhparfum_generate_demo_products() {
    // Only run if triggered manually (e.g., via a query param like ?generate_demo=true) and user is admin
    if ( ! isset( $_GET['generate_demo'] ) || ! current_user_can( 'administrator' ) ) {
        return;
    }

    if ( ! class_exists( 'WooCommerce' ) ) {
        echo 'WooCommerce is not active.';
        exit;
    }

    $demo_products = array(
        array(
            'title'       => 'Aromatic Ginger',
            'content'     => 'Top notes convey the initial impression of fresh ginger, marine saltiness, and sparkling citrus. Next, enter clary sage and rosemary bringing an herbaceous, aromatic tone into play.',
            'price'       => '39.00',
            'image_url'   => 'https://dossier.eu/cdn/shop/files/Aromatic_Ginger-Aromatic_Fougere-Fresh_Aromatic.png?v=1742568481&width=533',
        ),
        array(
            'title'       => 'Woody Sandalwood',
            'content'     => 'A vibrant woody fragrance combining the warmth of sandalwood with fresh and vibrant notes.',
            'price'       => '39.00',
            'image_url'   => 'https://dossier.eu/cdn/shop/files/Woody-Sandalwood.png?v=1741886904&width=533',
        ),
        array(
            'title'       => 'Ambery Saffron',
            'content'     => 'A luxurious blend of amber and saffron, perfect for a sophisticated evening.',
            'price'       => '39.00',
            'image_url'   => 'https://dossier.eu/cdn/shop/files/Ambery-Saffron-Warm-Warm-Woody-Ambery_int.png?v=1741886317&width=533',
        ),
        array(
            'title'       => 'Musky Oakmoss',
            'content'     => 'A fresh and earthy scent grounded in the classic appeal of oakmoss and musk.',
            'price'       => '39.00',
            'image_url'   => 'https://dossier.eu/cdn/shop/files/Musky_Oakmoss_Freshness-Fresh_Green_and_Citrus_Tea.png?v=1741886703&width=533',
        )
    );

    foreach ( $demo_products as $product_data ) {
        // Check if product already exists
        $existing_product = get_page_by_title( $product_data['title'], OBJECT, 'product' );
        if ( ! $existing_product ) {
            $post_id = wp_insert_post( array(
                'post_title'   => $product_data['title'],
                'post_content' => $product_data['content'],
                'post_status'  => 'publish',
                'post_type'    => 'product',
            ) );

            if ( ! is_wp_error( $post_id ) ) {
                wp_set_object_terms( $post_id, 'simple', 'product_type' );
                update_post_meta( $post_id, '_visibility', 'visible' );
                update_post_meta( $post_id, '_stock_status', 'instock');
                update_post_meta( $post_id, 'total_sales', '0');
                update_post_meta( $post_id, '_downloadable', 'no');
                update_post_meta( $post_id, '_virtual', 'no');
                update_post_meta( $post_id, '_regular_price', $product_data['price'] );
                update_post_meta( $post_id, '_sale_price', '' );
                update_post_meta( $post_id, '_purchase_note', '' );
                update_post_meta( $post_id, '_featured', 'no' );
                update_post_meta( $post_id, '_weight', '' );
                update_post_meta( $post_id, '_length', '' );
                update_post_meta( $post_id, '_width', '' );
                update_post_meta( $post_id, '_height', '' );
                update_post_meta( $post_id, '_sku', sanitize_title( $product_data['title'] ) );
                update_post_meta( $post_id, '_product_attributes', array() );
                update_post_meta( $post_id, '_sale_price_dates_from', '' );
                update_post_meta( $post_id, '_sale_price_dates_to', '' );
                update_post_meta( $post_id, '_price', $product_data['price'] );
                update_post_meta( $post_id, '_sold_individually', '' );
                update_post_meta( $post_id, '_manage_stock', 'no' );
                update_post_meta( $post_id, '_backorders', 'no' );
                update_post_meta( $post_id, '_stock', '' );

                // Try to attach image if possible (Note: side-loading images reliably in a simple script is complex,
                // saving the URL as meta is a fallback, but we'll try a basic sideload)
                require_once( ABSPATH . 'wp-admin/includes/file.php' );
                require_once( ABSPATH . 'wp-admin/includes/media.php' );
                require_once( ABSPATH . 'wp-admin/includes/image.php' );

                $tmp = download_url( $product_data['image_url'] );
                if ( ! is_wp_error( $tmp ) ) {
                    $file_array = array(
                        'name'     => basename( wp_parse_url( $product_data['image_url'], PHP_URL_PATH ) ),
                        'tmp_name' => $tmp
                    );
                    $thumb_id = media_handle_sideload( $file_array, $post_id );
                    if ( ! is_wp_error( $thumb_id ) ) {
                        set_post_thumbnail( $post_id, $thumb_id );
                    }
                }
            }
        }
    }

    echo 'Demo products generated successfully. Please remove ?generate_demo=true from the URL.';
    exit;
}
add_action( 'init', 'lhparfum_generate_demo_products' );
