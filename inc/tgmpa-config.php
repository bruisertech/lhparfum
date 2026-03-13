<?php
/**
 * TGM Plugin Activation configuration for BRUISER TECH LHPARFUM.
 *
 * @package BRUISER_TECH_LHPARFUM
 */

require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'bruiser_tech_lhparfum_register_required_plugins' );

function bruiser_tech_lhparfum_register_required_plugins() {
    $plugins = array(
        array(
            'name'      => 'WooCommerce',
            'slug'      => 'woocommerce',
            'required'  => true,
        ),
        array(
            'name'      => 'One Click Demo Import',
            'slug'      => 'one-click-demo-import',
            'required'  => true,
        ),
    );

    $config = array(
        'id'           => 'bruiser-tech-lhparfum',
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => '',
    );

    tgmpa( $plugins, $config );
}
