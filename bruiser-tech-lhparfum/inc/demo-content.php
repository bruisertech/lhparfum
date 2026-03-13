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

function lhparfum_get_post_by_title( $page_title, $post_type = 'page' ) {
    $query = new WP_Query( array(
        'post_type'              => $post_type,
        'title'                  => $page_title,
        'post_status'            => 'all',
        'posts_per_page'         => 1,
        'no_found_rows'          => true,
        'ignore_sticky_posts'    => true,
        'update_post_term_cache' => false,
        'update_post_meta_cache' => false,
    ) );

    if ( ! empty( $query->posts ) ) {
        return $query->posts[0];
    }
    return null;
}

function lhparfum_ocdi_after_import_setup() {
    // 1. Crear Página de Inicio si no existe
    $front_page = lhparfum_get_post_by_title( 'Inicio', 'page' );
    $front_page_id = $front_page ? $front_page->ID : 0;

    if ( ! $front_page_id ) {
        $front_page_id = wp_insert_post( array(
            'post_title'   => 'Inicio',
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ) );
    }

    // 2. Crear Páginas (Colecciones, Sobre Nosotros, Contacto)
    $pages = array(
        array(
            'title'   => 'Colecciones',
            'content' => '<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull"><div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16"><!-- wp:heading {"textAlign":"center","level":1,"style":{"spacing":{"margin":{"bottom":"2rem"}}}} -->
<h1 class="wp-block-heading has-text-align-center" style="margin-bottom:2rem; font-weight: 800; text-transform: uppercase;">Nuestras Colecciones</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"4rem"}}}} -->
<p class="has-text-align-center text-gray-500 text-lg" style="margin-bottom:4rem">Descubre las familias olfativas de LHPARFUM.</p>
<!-- /wp:paragraph -->

<!-- wp:columns -->
<div class="wp-block-columns grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"><!-- wp:column -->
<div class="wp-block-column bg-gray-50 dark:bg-gray-800 p-8 text-center border border-gray-200 dark:border-gray-700"><!-- wp:heading {"textAlign":"center","level":3} -->
<h3 class="wp-block-heading has-text-align-center font-bold text-xl mb-4">Oriental / Amaderada</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p class="text-gray-500 dark:text-gray-400">Aromas cálidos, sensuales y profundos. Maderas nobles, especias y notas dulces.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column bg-gray-50 dark:bg-gray-800 p-8 text-center border border-gray-200 dark:border-gray-700"><!-- wp:heading {"textAlign":"center","level":3} -->
<h3 class="wp-block-heading has-text-align-center font-bold text-xl mb-4">Cítrica / Fresca</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p class="text-gray-500 dark:text-gray-400">Vibrantes, luminosas y enérgicas. Cítricos, notas verdes y acuáticas.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column bg-gray-50 dark:bg-gray-800 p-8 text-center border border-gray-200 dark:border-gray-700"><!-- wp:heading {"textAlign":"center","level":3} -->
<h3 class="wp-block-heading has-text-align-center font-bold text-xl mb-4">Floral</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p class="text-gray-500 dark:text-gray-400">Elegantes, románticas y atemporales. Rosas, jazmín, ylang-ylang y flores exóticas.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div></div>
<!-- /wp:group -->'
        ),
        array(
            'title'   => 'Sobre Nosotros',
            'content' => '<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull"><div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
<!-- wp:heading {"textAlign":"center","level":1,"style":{"spacing":{"margin":{"bottom":"3rem"}}}} -->
<h1 class="wp-block-heading has-text-align-center" style="margin-bottom:3rem; font-weight: 800; text-transform: uppercase;">La Esencia de LHPARFUM</h1>
<!-- /wp:heading -->

<!-- wp:columns {"verticalAlignment":"center"} -->
<div class="wp-block-columns are-vertically-aligned-center grid grid-cols-1 md:grid-cols-2 gap-12 items-center"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"align":"center"} -->
<figure class="wp-block-image aligncenter"><img src="https://images.unsplash.com/photo-1615397323386-30c144a2b1f8?auto=format&fit=crop&q=80&w=800" alt="Sobre Nosotros"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading font-bold text-2xl mb-4">Perfección Embotellada</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p class="text-gray-600 dark:text-gray-400 mb-6 text-lg">Nacidos en Colombia, nuestra misión es democratizar la alta perfumería. Creemos que una fragancia de lujo no debería ser un privilegio inalcanzable, sino una expresión personal diaria.</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p class="text-gray-600 dark:text-gray-400 text-lg">Seleccionamos los ingredientes más puros y nobles del mundo para crear composiciones olfativas únicas, envasadas con elegancia y sobriedad.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
</div></div>
<!-- /wp:group -->'
        ),
        array(
            'title'   => 'Contacto',
            'content' => '<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull"><div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
<!-- wp:heading {"textAlign":"center","level":1,"style":{"spacing":{"margin":{"bottom":"2rem"}}}} -->
<h1 class="wp-block-heading has-text-align-center" style="margin-bottom:2rem; font-weight: 800; text-transform: uppercase;">Contáctanos</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center text-gray-500 text-lg mb-8">¿Tienes dudas sobre una fragancia? ¿Necesitas ayuda con tu pedido? Estamos aquí para asistirte.</p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<div class="bg-gray-50 dark:bg-gray-800 p-8 border border-gray-200 dark:border-gray-700 mb-12">
    <h3 class="font-bold text-xl mb-4 text-gray-900 dark:text-white">Atención al Cliente</h3>
    <p class="text-gray-600 dark:text-gray-400 mb-2"><strong>Email:</strong> contacto@lhparfum.com</p>
    <p class="text-gray-600 dark:text-gray-400 mb-2"><strong>Teléfono:</strong> +57 300 123 4567</p>
    <p class="text-gray-600 dark:text-gray-400"><strong>Horario:</strong> Lunes a Viernes, 9:00 AM - 6:00 PM</p>
</div>
<!-- /wp:html -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center text-gray-500 text-sm italic">Para consultas sobre envíos, por favor incluye tu número de orden en el mensaje.</p>
<!-- /wp:paragraph -->
</div></div>
<!-- /wp:group -->'
        )
    );

    foreach ( $pages as $page ) {
        $existing_page = lhparfum_get_post_by_title( $page['title'], 'page' );
        if ( ! $existing_page ) {
            wp_insert_post( array(
                'post_title'   => $page['title'],
                'post_content' => $page['content'],
                'post_status'  => 'publish',
                'post_type'    => 'page',
            ) );
        }
    }

    // Configurar Inicio como Front Page
    if ( $front_page_id && ! is_wp_error( $front_page_id ) ) {
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', (int) $front_page_id );
    }

    // 3. Crear Productos de Demo de WooCommerce
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
            $existing_product = lhparfum_get_post_by_title( $product_data['title'], 'product' );
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
