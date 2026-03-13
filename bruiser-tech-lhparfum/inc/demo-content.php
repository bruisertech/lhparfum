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
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'ocdi/dummy.xml',
            'import_preview_image_url'     => get_template_directory_uri() . '/screenshot.jpg',
            'import_notice'                => __( 'Después de iniciar la importación, se configurará la página de inicio, se crearán las colecciones y se añadirán 10 productos de prueba con rarezas y categorías.', 'bruiser-tech-lhparfum' ),
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

    // Assign pages to Primary Menu automatically
    $main_menu = get_term_by( 'name', 'Menu Principal', 'nav_menu' );
    if ( ! $main_menu ) {
        $menu_id = wp_create_nav_menu( 'Menu Principal' );
        if ( ! is_wp_error( $menu_id ) ) {
            $locations = get_theme_mod( 'nav_menu_locations' );
            $locations['menu-1'] = $menu_id;
            set_theme_mod( 'nav_menu_locations', $locations );

            // Add pages
            wp_update_nav_menu_item( $menu_id, 0, array( 'menu-item-title' => 'Inicio', 'menu-item-object-id' => $front_page_id, 'menu-item-object' => 'page', 'menu-item-type' => 'post_type', 'menu-item-status' => 'publish' ) );
            $colecciones = lhparfum_get_post_by_title('Colecciones');
            if($colecciones) wp_update_nav_menu_item( $menu_id, 0, array( 'menu-item-title' => 'Colecciones', 'menu-item-object-id' => $colecciones->ID, 'menu-item-object' => 'page', 'menu-item-type' => 'post_type', 'menu-item-status' => 'publish' ) );
            wp_update_nav_menu_item( $menu_id, 0, array( 'menu-item-title' => 'Tienda', 'menu-item-url' => home_url( '/shop/' ), 'menu-item-type' => 'custom', 'menu-item-status' => 'publish' ) );
            $nosotros = lhparfum_get_post_by_title('Sobre Nosotros');
            if($nosotros) wp_update_nav_menu_item( $menu_id, 0, array( 'menu-item-title' => 'Sobre Nosotros', 'menu-item-object-id' => $nosotros->ID, 'menu-item-object' => 'page', 'menu-item-type' => 'post_type', 'menu-item-status' => 'publish' ) );
            $contacto = lhparfum_get_post_by_title('Contacto');
            if($contacto) wp_update_nav_menu_item( $menu_id, 0, array( 'menu-item-title' => 'Contacto', 'menu-item-object-id' => $contacto->ID, 'menu-item-object' => 'page', 'menu-item-type' => 'post_type', 'menu-item-status' => 'publish' ) );
        }
    }

    // 3. Setup WooCommerce Pages and 10 Products
    if ( class_exists( 'WooCommerce' ) ) {
        WC_Install::create_pages();

        // Ensure terms exist
        $rarezas = ['Nicho', 'Diseñador', 'Árabe', 'Accesible'];
        foreach ( $rarezas as $rareza ) {
            if ( ! term_exists( $rareza, 'lh_rareza' ) ) wp_insert_term( $rareza, 'lh_rareza' );
        }

        $generos = ['Mujer', 'Hombre', 'Unisex'];
        foreach ( $generos as $genero ) {
            if ( ! term_exists( $genero, 'lh_genero' ) ) wp_insert_term( $genero, 'lh_genero' );
        }

        $aromas = ['Floral', 'Amaderado', 'Cítrico', 'Oriental', 'Fresco'];
        foreach ( $aromas as $aroma ) {
            if ( ! term_exists( $aroma, 'lh_aroma' ) ) wp_insert_term( $aroma, 'lh_aroma' );
        }

        $marcas = ['Tom Ford', 'Creed', 'Dior', 'Lattafa', 'Zara', 'Maison Francis Kurkdjian'];
        foreach ( $marcas as $marca ) {
            if ( ! term_exists( $marca, 'lh_marca' ) ) wp_insert_term( $marca, 'lh_marca' );
        }

        // Crear 10 Productos de Demo
        // Note: `source.unsplash.com` was deprecated. I am explicitly using static raw image URLs from Unsplash
        // with specific photo IDs, sized exactly to 800x1066 via query params to guarantee they download properly.
        $demo_products = array(
            array(
                'title'       => 'Oud Royal',
                'content'     => 'El lujo embotellado. Un viaje sensorial con auténtico oud de Oriente.',
                'price'       => '450000',
                'image_url'   => 'https://images.unsplash.com/photo-1594035910387-fea47794261f?q=80&w=800&h=1066&fit=crop',
                'rareza'      => 'Árabe', 'genero' => 'Unisex', 'aroma' => 'Oriental', 'marca' => 'Lattafa'
            ),
            array(
                'title'       => 'Essence de Nuit',
                'content'     => 'Una fragancia elegante y misteriosa para las noches más especiales.',
                'price'       => '250000',
                'image_url'   => 'https://images.unsplash.com/photo-1541643600914-78b084683601?q=80&w=800&h=1066&fit=crop',
                'rareza'      => 'Diseñador', 'genero' => 'Mujer', 'aroma' => 'Floral', 'marca' => 'Dior'
            ),
            array(
                'title'       => 'Bois Noir',
                'content'     => 'Una mezcla profunda y amaderada con notas de sándalo y cedro.',
                'price'       => '320000',
                'image_url'   => 'https://images.unsplash.com/photo-1622618991746-fe6004db3a47?q=80&w=800&h=1066&fit=crop',
                'rareza'      => 'Nicho', 'genero' => 'Hombre', 'aroma' => 'Amaderado', 'marca' => 'Tom Ford'
            ),
            array(
                'title'       => 'Citrus Paradis',
                'content'     => 'Fresco, ligero y lleno de energía. Perfecto para el día a día.',
                'price'       => '180000',
                'image_url'   => 'https://images.unsplash.com/photo-1588405748880-12d1d2a59f75?q=80&w=800&h=1066&fit=crop',
                'rareza'      => 'Accesible', 'genero' => 'Unisex', 'aroma' => 'Cítrico', 'marca' => 'Zara'
            ),
            array(
                'title'       => 'Amber Niche',
                'content'     => 'El nicho definitivo, una resina dorada que atrapa la atención.',
                'price'       => '550000',
                'image_url'   => 'https://images.unsplash.com/photo-1590736704728-f4730bb30770?q=80&w=800&h=1066&fit=crop',
                'rareza'      => 'Nicho', 'genero' => 'Unisex', 'aroma' => 'Oriental', 'marca' => 'Maison Francis Kurkdjian'
            ),
            array(
                'title'       => 'Velvet Rose',
                'content'     => 'Una rosa profunda y aterciopelada, envuelta en misterio.',
                'price'       => '290000',
                'image_url'   => 'https://images.unsplash.com/photo-1615397323386-30c144a2b1f8?q=80&w=800&h=1066&fit=crop',
                'rareza'      => 'Diseñador', 'genero' => 'Mujer', 'aroma' => 'Floral', 'marca' => 'Dior'
            ),
            array(
                'title'       => 'Habibi Musk',
                'content'     => 'Almizcle puro con destellos dulces, directo desde Dubai.',
                'price'       => '120000',
                'image_url'   => 'https://images.unsplash.com/photo-1595425964070-5cb2b5c00e6f?q=80&w=800&h=1066&fit=crop',
                'rareza'      => 'Árabe', 'genero' => 'Unisex', 'aroma' => 'Fresco', 'marca' => 'Lattafa'
            ),
            array(
                'title'       => 'Homme Bleu',
                'content'     => 'Clásico, marino, para el hombre que conquista la ciudad.',
                'price'       => '380000',
                'image_url'   => 'https://images.unsplash.com/photo-1523293182086-7651a899d37f?q=80&w=800&h=1066&fit=crop',
                'rareza'      => 'Diseñador', 'genero' => 'Hombre', 'aroma' => 'Fresco', 'marca' => 'Dior'
            ),
            array(
                'title'       => 'Santal Eco',
                'content'     => 'Una alternativa accesible a las maderas más finas.',
                'price'       => '95000',
                'image_url'   => 'https://images.unsplash.com/photo-1616401784845-180882ba9ba8?q=80&w=800&h=1066&fit=crop',
                'rareza'      => 'Accesible', 'genero' => 'Unisex', 'aroma' => 'Amaderado', 'marca' => 'Zara'
            ),
            array(
                'title'       => 'Sultan Gold',
                'content'     => 'Especias cálidas y oro líquido.',
                'price'       => '140000',
                'image_url'   => 'https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?q=80&w=800&h=1066&fit=crop',
                'rareza'      => 'Árabe', 'genero' => 'Hombre', 'aroma' => 'Oriental', 'marca' => 'Lattafa'
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
                    wp_set_object_terms( $post_id, $product_data['rareza'], 'lh_rareza' );
                    wp_set_object_terms( $post_id, $product_data['genero'], 'lh_genero' );
                    wp_set_object_terms( $post_id, $product_data['aroma'], 'lh_aroma' );
                    wp_set_object_terms( $post_id, $product_data['marca'], 'lh_marca' );

                    update_post_meta( $post_id, '_visibility', 'visible' );
                    update_post_meta( $post_id, '_stock_status', 'instock');
                    update_post_meta( $post_id, 'total_sales', '0');
                    update_post_meta( $post_id, '_regular_price', $product_data['price'] );
                    update_post_meta( $post_id, '_price', $product_data['price'] );
                    update_post_meta( $post_id, '_sku', sanitize_title( $product_data['title'] ) );

                    // Intentar adjuntar imagen. Timeout explicitly handled.
                    require_once( ABSPATH . 'wp-admin/includes/file.php' );
                    require_once( ABSPATH . 'wp-admin/includes/media.php' );
                    require_once( ABSPATH . 'wp-admin/includes/image.php' );

                    // Add a filter to increase timeout specifically for demo images on slow hosts
                    if ( ! function_exists( 'lhparfum_extend_http_timeout' ) ) {
                        function lhparfum_extend_http_timeout() { return 60; }
                    }
                    add_filter( 'http_request_timeout', 'lhparfum_extend_http_timeout' );

                    $tmp = download_url( $product_data['image_url'] );

                    remove_filter( 'http_request_timeout', 'lhparfum_extend_http_timeout' );

                    if ( ! is_wp_error( $tmp ) ) {
                        // Dummy image has no extension in url path usually, force .jpg
                        $file_array = array(
                            'name'     => sanitize_title($product_data['title']) . '.jpg',
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
