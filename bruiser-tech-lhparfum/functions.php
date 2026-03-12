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
    // Add Tailwind CSS via CDN
    wp_enqueue_script( 'tailwindcss', 'https://cdn.tailwindcss.com', array(), '3.4.1', false );
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
