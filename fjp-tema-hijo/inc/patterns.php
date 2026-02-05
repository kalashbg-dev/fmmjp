<?php
/**
 * FJP - Block Patterns System
 *
 * @package FJP
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Pattern Categories
 */
function fjp_register_pattern_categories() {
    register_block_pattern_category(
        'fjp-pages',
        array('label' => __('FJP Páginas (Layouts Completos)', 'fjp'))
    );
    register_block_pattern_category(
        'fjp-sections',
        array('label' => __('FJP Secciones', 'fjp'))
    );
}
add_action('init', 'fjp_register_pattern_categories');

/**
 * Register Patterns
 */
function fjp_register_patterns() {

    // 1. HOME PAGE COMPLETE
    register_block_pattern(
        'fjp/page-home',
        array(
            'title'       => __('Home - Layout Completo', 'fjp'),
            'description' => 'Estructura completa para la página de inicio.',
            'categories'  => array('fjp-pages'),
            'content'     => <<<HTML
<!-- wp:acf/fjp-hero {"name":"acf/fjp-hero","data":{"title":"Juntos construyendo un futuro mejor","_title":"field_hero_title","description":"La Fundación Juventud Progresista trabaja incansablemente para el desarrollo sostenible de nuestra comunidad.","_description":"field_hero_description","overlay_color":"fjp-primary","_overlay_color":"field_hero_overlay_color","buttons":2,"_buttons":"field_hero_buttons","buttons_0_label":"Donar Ahora","_buttons_0_label":"field_hero_btn_label","buttons_0_url":"#donar","_buttons_0_url":"field_hero_btn_url","buttons_0_style":"primary","_buttons_0_style":"field_hero_btn_style","buttons_1_label":"Ser Voluntario","_buttons_1_label":"field_hero_btn_label","buttons_1_url":"/voluntariado","_buttons_1_url":"field_hero_btn_url","buttons_1_style":"secondary","_buttons_1_style":"field_hero_btn_style"},"align":"full","mode":"preview"} /-->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl"}}},"backgroundColor":"fjp-background","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-fjp-background-background-color has-background" style="padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl)">
    <!-- wp:shortcode -->
    [fjp_contador_impacto]
    <!-- /wp:shortcode -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxl","bottom":"var:preset|spacing|xxl"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--xxl);padding-bottom:var(--wp--preset--spacing--xxl)">
    <!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|xl","left":"var:preset|spacing|xl"}}}} -->
    <div class="wp-block-columns alignwide">
        <!-- wp:column {"verticalAlignment":"center"} -->
        <div class="wp-block-column is-vertically-aligned-center">
            <!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"is-style-default rounded-3 shadow"} -->
            <figure class="wp-block-image size-large is-style-default rounded-3 shadow"><img src="https://via.placeholder.com/800x600" alt="Nuestra Misión"/></figure>
            <!-- /wp:image -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center"} -->
        <div class="wp-block-column is-vertically-aligned-center">
            <!-- wp:heading {"textColor":"fjp-primary"} -->
            <h2 class="wp-block-heading has-fjp-primary-color has-text-color">Nuestra Misión</h2>
            <!-- /wp:heading -->
            <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.1rem"}}} -->
            <p style="font-size:1.1rem">Somos una organización sin fines de lucro dedicada a empoderar a la juventud y fomentar el desarrollo integral de las comunidades más vulnerables de la República Dominicana.</p>
            <!-- /wp:paragraph -->
            <!-- wp:buttons -->
            <div class="wp-block-buttons">
                <!-- wp:button {"backgroundColor":"fjp-primary","style":{"border":{"radius":"50px"}}} -->
                <div class="wp-block-button"><a class="wp-block-button__link has-fjp-primary-background-color has-background wp-element-button" style="border-radius:50px">Leer más</a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->

<!-- wp:heading {"textAlign":"center","level":2,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|lg"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--lg)">Últimas Noticias</h2>
<!-- /wp:heading -->

<!-- wp:acf/fjp-news-grid {"name":"acf/fjp-news-grid","data":{"posts_per_page":"3","_posts_per_page":"field_news_count"},"align":"wide","mode":"preview"} /-->

<!-- wp:acf/fjp-testimonials {"name":"acf/fjp-testimonials","align":"full","mode":"preview"} /-->

<!-- wp:acf/fjp-volunteer-cta {"name":"acf/fjp-volunteer-cta","data":{"title":"¿Listo para hacer la diferencia?","_title":"field_cta_title","text":"Únete a nuestro equipo de voluntarios y sé parte del cambio.","_text":"field_cta_text","button_label":"Inscríbete Hoy","_button_label":"field_cta_btn_label","button_url":"/voluntariado","_button_url":"field_cta_btn_url"},"align":"wide","mode":"preview"} /-->
HTML
,
        )
    );

    // 2. VOLUNTEERING PAGE
    register_block_pattern(
        'fjp/page-voluntariado',
        array(
            'title'       => __('Voluntariado - Layout Completo', 'fjp'),
            'description' => 'Estructura para la página de voluntarios.',
            'categories'  => array('fjp-pages'),
            'content'     => <<<HTML
<!-- wp:acf/fjp-hero {"name":"acf/fjp-hero","data":{"title":"Únete al Voluntariado","_title":"field_hero_title","description":"Tu tiempo y talento pueden transformar vidas. Súmate a nuestra causa.","_description":"field_hero_description","overlay_color":"fjp-teal","_overlay_color":"field_hero_overlay_color","buttons":1,"_buttons":"field_hero_buttons","buttons_0_label":"Inscribirme","_buttons_0_label":"field_hero_btn_label","buttons_0_url":"#formulario","_buttons_0_url":"field_hero_btn_url","buttons_0_style":"primary","_buttons_0_style":"field_hero_btn_style"},"align":"full","mode":"preview"} /-->

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl"}}}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl)">
    <!-- wp:heading {"textAlign":"center","level":2,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|lg"}}}} -->
    <h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--lg)">Beneficios de ser Voluntario</h2>
    <!-- /wp:heading -->

    <!-- wp:columns {"style":{"spacing":{"blockGap":"var:preset|spacing|lg"}}} -->
    <div class="wp-block-columns">
        <!-- wp:column {"className":"has-text-align-center fjp-card p-4"} -->
        <div class="wp-block-column has-text-align-center fjp-card p-4">
            <!-- wp:heading {"level":4} -->
            <h4 class="wp-block-heading">Desarrollo Personal</h4>
            <!-- /wp:heading -->
            <!-- wp:paragraph -->
            <p>Adquiere nuevas habilidades y experiencias valiosas para tu futuro profesional.</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"className":"has-text-align-center fjp-card p-4"} -->
        <div class="wp-block-column has-text-align-center fjp-card p-4">
            <!-- wp:heading {"level":4} -->
            <h4 class="wp-block-heading">Impacto Social</h4>
            <!-- /wp:heading -->
            <!-- wp:paragraph -->
            <p>Contribuye directamente al bienestar de comunidades vulnerables.</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"className":"has-text-align-center fjp-card p-4"} -->
        <div class="wp-block-column has-text-align-center fjp-card p-4">
            <!-- wp:heading {"level":4} -->
            <h4 class="wp-block-heading">Networking</h4>
            <!-- /wp:heading -->
            <!-- wp:paragraph -->
            <p>Conecta con personas apasionadas que comparten tus mismos valores.</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->

<!-- wp:acf/fjp-testimonials {"name":"acf/fjp-testimonials","align":"full","mode":"preview"} /-->

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl"}}},"backgroundColor":"fjp-light-gray"} -->
<div class="wp-block-group alignwide has-fjp-light-gray-background-color has-background" style="padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl)">
    <!-- wp:heading {"textAlign":"center","level":2} -->
    <h2 class="wp-block-heading has-text-align-center">Inscríbete Ahora</h2>
    <!-- /wp:heading -->

    <!-- wp:shortcode -->
    [fjp_volunteer_form]
    <!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
HTML
,
        )
    );
}
add_action('init', 'fjp_register_patterns');
