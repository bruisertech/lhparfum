<?php
/**
 * Demo Content Configuration for One Click Demo Import (OCDI)
 *
 * @package BRUISER_TECH_LHPARFUM
 */

if ( ! defined( 'ABSPATH' ) ) {
    die( 'Exit if accessed directly' );
}

function lhparfum_ocdi_import_files() {
    return array(
        array(
            'import_file_name'             => 'LHPARFUM Demo',
            'import_preview_image_url'     => get_template_directory_uri() . '/screenshot.jpg',
            'import_notice'                => __( 'Después de iniciar la importación, se configurará la página de inicio y se crearán los productos de ejemplo automáticamente.', 'bruiser-tech-lhparfum' ),
            'preview_url'                  => 'https://instagram.com/bruiser.tech',
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'lhparfum_ocdi_import_files' );

function lhparfum_ocdi_after_import_setup() {
    // 1. Crear Página de Inicio si no existe
    $front_page_id = get_page_by_title( 'Inicio' );
    if ( ! $front_page_id ) {
        $front_page_id = wp_insert_post( array(
            'post_title'   => 'Inicio',
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ) );
    }

    // 2. Crear Página de Contacto si no existe
    $contact_page_id = get_page_by_title( 'Contacto' );
    if ( ! $contact_page_id ) {
        wp_insert_post( array(
            'post_title'   => 'Contacto',
            'post_content' => 'Ponte en contacto con nosotros.',
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ) );
    }

    // Configurar Inicio como Front Page
    if ( ! is_wp_error( $front_page_id ) ) {
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page_id );
    }

    // 3. Crear 5 Productos de Demo de WooCommerce
    if ( class_exists( 'WooCommerce' ) ) {
        $demo_products = array(
            array(
                'title'       => 'Essence de Nuit',
                'content'     => 'Una fragancia elegante y misteriosa para las noches más especiales.',
                'price'       => '250000',
                'image_url'   => 'https://images.unsplash.com/photo-1594035910387-fea47794261f?auto=format&fit=crop&q=80&w=500',
            ),
            array(
                'title'       => 'Fleur Sauvage',
                'content'     => 'Notas florales silvestres combinadas con un toque cítrico vibrante.',
                'price'       => '210000',
                'image_url'   => 'https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&q=80&w=500',
            ),
            array(
                'title'       => 'Bois Noir',
                'content'     => 'Una mezcla profunda y amaderada con notas de sándalo y cedro.',
                'price'       => '320000',
                'image_url'   => 'https://images.unsplash.com/photo-1622618991746-fe6004db3a47?auto=format&fit=crop&q=80&w=500',
            ),
            array(
                'title'       => 'Oud Royal',
                'content'     => 'El lujo embotellado. Un viaje sensorial con auténtico oud de Oriente.',
                'price'       => '450000',
                'image_url'   => 'https://images.unsplash.com/photo-1590736704728-f4730bb30770?auto=format&fit=crop&q=80&w=500',
            ),
            array(
                'title'       => 'Citrus Paradis',
                'content'     => 'Fresco, ligero y lleno de energía. Perfecto para el día a día.',
                'price'       => '180000',
                'image_url'   => 'https://images.unsplash.com/photo-1588405748880-12d1d2a59f75?auto=format&fit=crop&q=80&w=500',
            )
        );

        foreach ( $demo_products as $product_data ) {
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
                    update_post_meta( $post_id, '_regular_price', $product_data['price'] );
                    update_post_meta( $post_id, '_price', $product_data['price'] );
                    update_post_meta( $post_id, '_sku', sanitize_title( $product_data['title'] ) );

                    // Intentar adjuntar imagen (Fallback: requiere sideload que puede fallar en entornos restringidos)
                    require_once( ABSPATH . 'wp-admin/includes/file.php' );
                    require_once( ABSPATH . 'wp-admin/includes/media.php' );
                    require_once( ABSPATH . 'wp-admin/includes/image.php' );

                    $tmp = download_url( $product_data['image_url'] );
                    if ( ! is_wp_error( $tmp ) ) {
                        $file_array = array(
                            'name'     => basename( wp_parse_url( $product_data['image_url'], PHP_URL_PATH ) ) . '.jpg',
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
    }
}
add_action( 'pt-ocdi/after_import', 'lhparfum_ocdi_after_import_setup' );
