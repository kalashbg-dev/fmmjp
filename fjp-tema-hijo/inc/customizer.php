<?php
/**
 * FJP - Configuración del Personalizador (Customizer)
 * Agrega opciones globales al panel "Apariencia > Personalizar".
 *
 * @package FJP
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Registrar Ajustes en el Customizer
 *
 * @param WP_Customize_Manager $wp_customize Objeto del personalizador.
 */
function fjp_customize_register($wp_customize) {

    // 1. Crear Panel FJP
    $wp_customize->add_panel('fjp_global_settings', array(
        'title'       => __('FJP Ajustes Globales', 'fjp'),
        'description' => __('Opciones avanzadas del tema hijo FJP', 'fjp'),
        'priority'    => 10,
    ));

    // 2. Sección Cabecera (Header)
    $wp_customize->add_section('fjp_header_options', array(
        'title'       => __('Cabecera (Header)', 'fjp'),
        'panel'       => 'fjp_global_settings',
    ));

    // Setting: Activar Sticky Header Global
    $wp_customize->add_setting('fjp_global_sticky_header', array(
        'default'           => false,
        'sanitize_callback' => 'fjp_sanitize_checkbox',
    ));

    $wp_customize->add_control('fjp_global_sticky_header', array(
        'label'       => __('Activar Header Pegajoso (Global)', 'fjp'),
        'description' => __('Hace que el menú siga al usuario al hacer scroll en todo el sitio.', 'fjp'),
        'section'     => 'fjp_header_options',
        'type'        => 'checkbox',
    ));

    // 3. Sección Pie de Página (Footer)
    $wp_customize->add_section('fjp_footer_options', array(
        'title'       => __('Pie de Página (Footer)', 'fjp'),
        'panel'       => 'fjp_global_settings',
    ));

    // Setting: Texto de Créditos
    $wp_customize->add_setting('fjp_footer_credits', array(
        'default'           => '© ' . date('Y') . ' Fundación Juventud Progresista. Todos los derechos reservados.',
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control('fjp_footer_credits', array(
        'label'       => __('Texto de Créditos', 'fjp'),
        'section'     => 'fjp_footer_options',
        'type'        => 'textarea',
    ));
}
add_action('customize_register', 'fjp_customize_register');

/**
 * Sanitizar Checkbox
 */
function fjp_sanitize_checkbox($checked) {
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Aplicar Ajustes Globales
 */
function fjp_apply_global_customizer_settings() {
    // Aplicar Sticky Header Global si está activo y no deshabilitado por página
    if (get_theme_mod('fjp_global_sticky_header') && !is_admin()) {
        add_filter('body_class', function($classes) {
            $classes[] = 'fjp-sticky-header';
            return $classes;
        });
    }
}
add_action('wp', 'fjp_apply_global_customizer_settings');

/**
 * Reemplazar Créditos del Footer de Astra
 */
function fjp_replace_astra_footer_credits() {
    $credits = get_theme_mod('fjp_footer_credits');
    if ($credits) {
        echo '<div class="ast-footer-copyright"><div class="ast-container">' . wp_kses_post($credits) . '</div></div>';
    }
}
// Hook into Astra footer if needed (requires disabling default footer builder or using hooks)
// add_action('astra_footer_content', 'fjp_replace_astra_footer_credits', 50);
