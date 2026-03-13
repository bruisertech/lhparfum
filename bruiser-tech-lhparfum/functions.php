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
 * Custom WooCommerce Texts
 */
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

        if ( ! empty( $tax_query ) ) {
            $q->set( 'tax_query', $tax_query );
        }

        // Price Filter
        $min_price = isset( $_GET['min_price'] ) && $_GET['min_price'] !== '' ? floatval( wp_unslash( $_GET['min_price'] ) ) : 0;
        $max_price = isset( $_GET['max_price'] ) && $_GET['max_price'] !== '' ? floatval( wp_unslash( $_GET['max_price'] ) ) : 0;

        if ( $max_price > 0 ) {
            $meta_query = (array) $q->get( 'meta_query' );
            $meta_query[] = array(
                'key'     => '_price',
                'value'   => array( $min_price, $max_price ),
                'compare' => 'BETWEEN',
                'type'    => 'NUMERIC'
            );
            $q->set( 'meta_query', $meta_query );
        } elseif ( $min_price > 0 ) {
            $meta_query = (array) $q->get( 'meta_query' );
            $meta_query[] = array(
                'key'     => '_price',
                'value'   => $min_price,
                'compare' => '>=',
                'type'    => 'NUMERIC'
            );
            $q->set( 'meta_query', $meta_query );
        }
    }
}
add_action( 'woocommerce_product_query', 'bruiser_tech_lhparfum_product_query' );
