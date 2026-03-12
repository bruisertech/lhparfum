<?php
/**
 * BRUISER TECH LHPARFUM Theme Customizer
 *
 * @package BRUISER_TECH_LHPARFUM
 */

function bruiser_tech_lhparfum_customize_register( $wp_customize ) {

    // ==========================
    // SECCIÓN: Identidad del Sitio (Ya existe, solo añadimos cosas si es necesario)
    // ==========================
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

    // ==========================
    // PANEL: Opciones del Tema LHPARFUM
    // ==========================
    $wp_customize->add_panel( 'lhparfum_theme_options', array(
        'priority'       => 30,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __( 'Opciones del Tema (LHPARFUM)', 'bruiser-tech-lhparfum' ),
        'description'    => __( 'Configura los colores, modo oscuro, pie de página y más.', 'bruiser-tech-lhparfum' ),
    ) );

    // ==========================
    // SECCIÓN: Colores y Apariencia
    // ==========================
    $wp_customize->add_section( 'lhparfum_colors', array(
        'title'    => __( 'Colores y Modo Oscuro', 'bruiser-tech-lhparfum' ),
        'panel'    => 'lhparfum_theme_options',
        'priority' => 10,
    ) );

    // Habilitar Modo Oscuro por defecto
    $wp_customize->add_setting( 'lhparfum_dark_mode', array(
        'default'           => false,
        'sanitize_callback' => 'lhparfum_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'lhparfum_dark_mode', array(
        'label'    => __( 'Activar Modo Oscuro Elegante', 'bruiser-tech-lhparfum' ),
        'section  ' => 'lhparfum_colors',
        'type'     => 'checkbox',
        'description' => __( 'Si se activa, el sitio usará un esquema de colores oscuros por defecto.', 'bruiser-tech-lhparfum' ),
    ) );

    // Color de Acento Principal
    $wp_customize->add_setting( 'lhparfum_accent_color', array(
        'default'           => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lhparfum_accent_color', array(
        'label'    => __( 'Color de Acento', 'bruiser-tech-lhparfum' ),
        'section'  => 'lhparfum_colors',
    ) ) );

    // ==========================
    // SECCIÓN: Pie de Página (Footer)
    // ==========================
    $wp_customize->add_section( 'lhparfum_footer_options', array(
        'title'    => __( 'Pie de Página (Footer)', 'bruiser-tech-lhparfum' ),
        'panel'    => 'lhparfum_theme_options',
        'priority' => 20,
    ) );

    // Teléfono de Emergencia/Contacto
    $wp_customize->add_setting( 'lhparfum_footer_phone', array(
        'default'           => '+57 300 123 4567',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'lhparfum_footer_phone', array(
        'label'    => __( 'Teléfono de Contacto', 'bruiser-tech-lhparfum' ),
        'section'  => 'lhparfum_footer_options',
        'type'     => 'text',
    ) );

    // Texto de Copyright
    $wp_customize->add_setting( 'lhparfum_footer_copyright', array(
        'default'           => 'LHPARFUM. Todos los derechos reservados.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'lhparfum_footer_copyright', array(
        'label'    => __( 'Texto de Copyright', 'bruiser-tech-lhparfum' ),
        'section'  => 'lhparfum_footer_options',
        'type'     => 'text',
    ) );

}
add_action( 'customize_register', 'bruiser_tech_lhparfum_customize_register' );

/**
 * Sanitize Checkbox
 */
function lhparfum_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Output Custom CSS based on Customizer settings
 */
function lhparfum_customizer_css() {
    $accent_color = get_theme_mod( 'lhparfum_accent_color', '#000000' );
    $is_dark      = get_theme_mod( 'lhparfum_dark_mode', false );

    // We will inject a script to handle dark mode classes on <html> if needed,
    // or just output CSS variables that Tailwind can pick up.
    ?>
    <style type="text/css">
        :root {
            --lhparfum-accent: <?php echo esc_attr( $accent_color ); ?>;
        }

    </style>
    <?php
}
add_action( 'wp_head', 'lhparfum_customizer_css' );
