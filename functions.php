<?php
/**
 * Theme functions and definitions
 *
 * @package BRUISER_TECH_LHPARFUM
 */

if ( ! function_exists( 'bruiser_tech_lhparfum_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     */
    function bruiser_tech_lhparfum_setup() {
        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        // Let WordPress manage the document title.
        add_theme_support( 'title-tag' );

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support( 'post-thumbnails' );

        // Register navigation menus.
        register_nav_menus( array(
            'menu-1' => esc_html__( 'Primary', 'bruiser-tech-lhparfum' ),
        ) );

        // Switch default core markup for search form, comment form, and comments to output valid HTML5.
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        // Add support for core custom logo.
        add_theme_support( 'custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ) );

        // Add WooCommerce support
        add_theme_support( 'woocommerce' );
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );
    }
endif;
add_action( 'after_setup_theme', 'bruiser_tech_lhparfum_setup' );

/**
 * Enqueue scripts and styles.
 */
function bruiser_tech_lhparfum_scripts() {
    wp_enqueue_style( 'bruiser-tech-lhparfum-style', get_stylesheet_uri(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'bruiser_tech_lhparfum_scripts' );

/**
 * Load Demo Content Generator
 */
require get_template_directory() . '/inc/demo-content.php';

/**
 * TGM Plugin Activation
 */
require get_template_directory() . '/inc/tgmpa-config.php';

/**
 * Customizer Additions
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Demo Reset Tool
 */
require get_template_directory() . '/inc/demo-reset.php';

/**
 * Auto-Update Infrastructure (Plugin Update Checker)
 */
require_once get_template_directory() . '/inc/plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
    'https://github.com/bruisertech/lhparfum',
    __FILE__,
    'lhparfum-main',
    1 // Check exactly every 1 hour as requested
);

// Optional: Set the branch that contains the stable release.
$myUpdateChecker->setBranch('lhparfum-main');

// Set GitHub authentication if a token is defined in wp-config.php (required for private repos)
if ( defined( 'LH_PARFUM_GITHUB_TOKEN' ) ) {
    $myUpdateChecker->setAuthentication( LH_PARFUM_GITHUB_TOKEN );
}

// Force PUC to strictly use the branch contents instead of looking for Releases/Tags
add_filter( $myUpdateChecker->getUniqueName('vcs_update_detection_strategies'), function( $strategies ) {
    // Keep only the STRATEGY_BRANCH strategy
    if ( isset( $strategies['branch'] ) ) {
        return array( 'branch' => $strategies['branch'] );
    }
    return $strategies;
} );

/**
 * Admin Bar Sync Button for Auto-Update
 */
function lhparfum_add_sync_button_to_admin_bar( $admin_bar ) {
    if ( ! current_user_can( 'update_themes' ) ) {
        return;
    }

    $admin_bar->add_node( array(
        'id'    => 'lhparfum-force-sync',
        'title' => '🚀 Forzar Sync GitHub',
        'href'  => wp_nonce_url( admin_url( 'update-core.php?force-check=1&lhparfum_sync=1' ), 'lhparfum_sync_action' ),
        'meta'  => array(
            'title' => __( 'Forzar comprobación de actualizaciones del tema LHPARFUM', 'bruiser-tech-lhparfum' ),
        ),
    ) );
}
add_action( 'admin_bar_menu', 'lhparfum_add_sync_button_to_admin_bar', 100 );

function lhparfum_handle_force_sync() {
    if ( isset( $_GET['lhparfum_sync'], $_GET['_wpnonce'] ) && wp_verify_nonce( $_GET['_wpnonce'], 'lhparfum_sync_action' ) && current_user_can( 'update_themes' ) ) {
        global $myUpdateChecker;
        if ( isset( $myUpdateChecker ) ) {
            // Force PUC to clear its own internal update cache state
            delete_site_transient( $myUpdateChecker->getUniqueName('update') );

            $myUpdateChecker->checkForUpdates();

            // Force WordPress to clear its update cache
            delete_site_transient( 'update_themes' );

            // Redirect back with force-check so WP core also refreshes its UI
            wp_redirect( admin_url( 'update-core.php?force-check=1&theme_sync_success=1' ) );
            exit;
        }
    }
}
add_action( 'admin_init', 'lhparfum_handle_force_sync' );

function lhparfum_sync_success_notice() {
    if ( isset( $_GET['theme_sync_success'] ) ) {
        echo '<div class="notice notice-success is-dismissible"><p>' . esc_html__( '✅ Sincronización con GitHub completada con éxito. Revisa si hay nuevas versiones disponibles.', 'bruiser-tech-lhparfum' ) . '</p></div>';
    }
}
add_action( 'admin_notices', 'lhparfum_sync_success_notice' );

/**
 * Custom WooCommerce Adjustments
 */
// Remove breadcrumbs
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

// Change add to cart text on single product pages
add_filter( 'woocommerce_product_single_add_to_cart_text', 'bruiser_tech_lhparfum_custom_cart_button_text' );
// Change add to cart text on product archives
add_filter( 'woocommerce_product_add_to_cart_text', 'bruiser_tech_lhparfum_custom_cart_button_text' );

function bruiser_tech_lhparfum_custom_cart_button_text() {
    return __( 'Adquirir fragancia', 'bruiser-tech-lhparfum' );
}

/**
 * Register Custom Taxonomies for Perfumes
 */
function bruiser_tech_lhparfum_register_taxonomies() {
    // 1. Rareza (Rareness/Type)
    register_taxonomy( 'lh_rareza', array( 'product' ), array(
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_in_rest'      => true,
        'labels'            => array(
            'name'          => __( 'Rarezas', 'bruiser-tech-lhparfum' ),
            'singular_name' => __( 'Rareza', 'bruiser-tech-lhparfum' ),
        ),
    ) );

    // 2. Genero (Gender)
    register_taxonomy( 'lh_genero', array( 'product' ), array(
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_in_rest'      => true,
        'labels'            => array(
            'name'          => __( 'Géneros', 'bruiser-tech-lhparfum' ),
            'singular_name' => __( 'Género', 'bruiser-tech-lhparfum' ),
        ),
    ) );

    // 3. Aroma (Scent Profile)
    register_taxonomy( 'lh_aroma', array( 'product' ), array(
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_in_rest'      => true,
        'labels'            => array(
            'name'          => __( 'Aromas', 'bruiser-tech-lhparfum' ),
            'singular_name' => __( 'Aroma', 'bruiser-tech-lhparfum' ),
        ),
    ) );

    // 4. Marca (Brand)
    register_taxonomy( 'lh_marca', array( 'product' ), array(
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_in_rest'      => true,
        'labels'            => array(
            'name'          => __( 'Marcas', 'bruiser-tech-lhparfum' ),
            'singular_name' => __( 'Marca', 'bruiser-tech-lhparfum' ),
        ),
    ) );
}
add_action( 'init', 'bruiser_tech_lhparfum_register_taxonomies', 0 );

/**
 * Custom WooCommerce Product Query logic for Filters
 */
function bruiser_tech_lhparfum_product_query( $q ) {
    if ( ! is_admin() && $q->is_main_query() && is_post_type_archive( 'product' ) ) {

        $tax_query = (array) $q->get( 'tax_query' );

        // Rareza Filter
        if ( isset( $_GET['filter_rareza'] ) && is_array( $_GET['filter_rareza'] ) ) {
            $tax_query[] = array(
                'taxonomy' => 'lh_rareza',
                'field'    => 'slug',
                'terms'    => array_map( 'sanitize_text_field', wp_unslash( $_GET['filter_rareza'] ) ),
            );
        }

        // Genero Filter
        if ( isset( $_GET['filter_genero'] ) && is_array( $_GET['filter_genero'] ) ) {
            $tax_query[] = array(
                'taxonomy' => 'lh_genero',
                'field'    => 'slug',
                'terms'    => array_map( 'sanitize_text_field', wp_unslash( $_GET['filter_genero'] ) ),
            );
        }

        // Aroma Filter
        if ( isset( $_GET['filter_aroma'] ) && is_array( $_GET['filter_aroma'] ) ) {
            $tax_query[] = array(
                'taxonomy' => 'lh_aroma',
                'field'    => 'slug',
                'terms'    => array_map( 'sanitize_text_field', wp_unslash( $_GET['filter_aroma'] ) ),
            );
        }

        // Marca Filter
        if ( isset( $_GET['filter_marca'] ) && is_array( $_GET['filter_marca'] ) ) {
            $tax_query[] = array(
                'taxonomy' => 'lh_marca',
                'field'    => 'slug',
                'terms'    => array_map( 'sanitize_text_field', wp_unslash( $_GET['filter_marca'] ) ),
            );
        }

        if ( ! empty( $tax_query ) ) {
            // Need relation AND if we have multiple taxonomies being filtered
            $tax_query['relation'] = 'AND';
            $q->set( 'tax_query', $tax_query );
        }

        // Price Filter: WooCommerce natively supports min_price and max_price query vars.
        // We set it here so it applies internally without requiring custom database lookups.
        if ( isset( $_GET['max_price'] ) && is_numeric( $_GET['max_price'] ) ) {
            $max_price = floatval( wp_unslash( $_GET['max_price'] ) );
            $q->set( 'max_price', $max_price );
        }
    }
}
add_action( 'woocommerce_product_query', 'bruiser_tech_lhparfum_product_query' );
