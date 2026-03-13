<?php
/**
 * Herramienta para borrar la Demo de LHPARFUM
 *
 * @package BRUISER_TECH_LHPARFUM
 */

if ( ! defined( 'ABSPATH' ) ) {
    die();
}

// Añadir página al menú de Herramientas
function lhparfum_add_reset_demo_page() {
    add_management_page(
        __( 'Reset Demo LHPARFUM', 'bruiser-tech-lhparfum' ),
        __( 'Reset Demo LHPARFUM', 'bruiser-tech-lhparfum' ),
        'manage_options',
        'lhparfum-reset-demo',
        'lhparfum_reset_demo_page_callback'
    );
}
add_action( 'admin_menu', 'lhparfum_add_reset_demo_page' );

// Callback para renderizar la página
function lhparfum_reset_demo_page_callback() {
    // Procesar el borrado si se envía el formulario
    if ( isset( $_POST['lhparfum_reset_demo_nonce'] ) && wp_verify_nonce( $_POST['lhparfum_reset_demo_nonce'], 'lhparfum_reset_demo_action' ) ) {
        lhparfum_execute_demo_reset();
        echo '<div class="notice notice-success is-dismissible"><p>' . __( 'Los datos de la demo de LHPARFUM han sido borrados correctamente.', 'bruiser-tech-lhparfum' ) . '</p></div>';
    }

    ?>
    <div class="wrap">
        <h1><?php echo esc_html__( 'Resetear Demo de LHPARFUM', 'bruiser-tech-lhparfum' ); ?></h1>
        <p><?php echo esc_html__( '¿Hiciste pruebas y quieres borrar los productos y páginas creadas por el importador de la demo?', 'bruiser-tech-lhparfum' ); ?></p>
        <p><strong><?php echo esc_html__( 'Advertencia: Esto borrará de forma permanente los siguientes elementos y sus imágenes destacadas:', 'bruiser-tech-lhparfum' ); ?></strong></p>
        <ul style="list-style: disc; margin-left: 20px;">
            <li>Páginas: Inicio, Contacto</li>
            <li>Productos: Essence de Nuit, Fleur Sauvage, Bois Noir, Oud Royal, Citrus Paradis</li>
        </ul>
        <br>
        <form method="post" action="">
            <?php wp_nonce_field( 'lhparfum_reset_demo_action', 'lhparfum_reset_demo_nonce' ); ?>
            <input type="submit" class="button button-primary button-large" value="<?php echo esc_attr__( 'Borrar Datos de la Demo', 'bruiser-tech-lhparfum' ); ?>" onclick="return confirm('¿Estás seguro de que quieres borrar todos los datos de la demo generados? Esta acción no se puede deshacer.');">
        </form>
    </div>
    <?php
}

function lhparfum_reset_get_post_by_title( $page_title, $post_type = 'page' ) {
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

// Lógica de borrado
function lhparfum_execute_demo_reset() {
    // 1. Borrar Páginas
    $pages_to_delete = array( 'Inicio', 'Contacto' );
    foreach ( $pages_to_delete as $page_title ) {
        $page = lhparfum_reset_get_post_by_title( $page_title, 'page' );
        if ( $page ) {
            wp_delete_post( $page->ID, true ); // true = force delete (bypass trash)
        }
    }

    // Resetear opciones de Front Page
    update_option( 'show_on_front', 'posts' );
    update_option( 'page_on_front', 0 );

    // 2. Borrar Productos de WooCommerce
    $products_to_delete = array( 'Essence de Nuit', 'Fleur Sauvage', 'Bois Noir', 'Oud Royal', 'Citrus Paradis' );
    foreach ( $products_to_delete as $product_title ) {
        $product = lhparfum_reset_get_post_by_title( $product_title, 'product' );
        if ( $product ) {
            // Borrar imagen adjunta
            $thumbnail_id = get_post_thumbnail_id( $product->ID );
            if ( $thumbnail_id ) {
                wp_delete_attachment( $thumbnail_id, true );
            }
            // Borrar producto
            wp_delete_post( $product->ID, true );
        }
    }
}
