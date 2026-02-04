<?php
/**
 * FJP - Sistema de Patrones de Bloques (Block Patterns)
 * Permite insertar secciones pre-diseñadas fácilmente.
 *
 * @package FJP
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Registrar Categorías de Patrones
 */
function fjp_register_pattern_categories() {
    register_block_pattern_category(
        'fjp-secciones',
        array('label' => __('FJP Secciones', 'fjp'))
    );
    register_block_pattern_category(
        'fjp-paginas',
        array('label' => __('FJP Páginas Completas', 'fjp'))
    );
}
add_action('init', 'fjp_register_pattern_categories');

/**
 * Registrar Patrones Individuales
 */
function fjp_register_patterns() {

    // 1. HERO HOME
    register_block_pattern(
        'fjp/hero-home',
        array(
            'title'       => __('Hero Principal (Home)', 'fjp'),
            'description' => 'Sección principal con imagen de fondo y llamada a la acción.',
            'categories'  => array('fjp-secciones', 'header'),
            'content'     => '<!-- wp:cover {"url":"https://via.placeholder.com/1920x800","dimRatio":50,"overlayColor":"fjp-primary","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|huge","bottom":"var:preset|spacing|huge"}}}} -->
<div class="wp-block-cover alignfull has-fjp-primary-background-color-has-background-dim-50 has-background-dim" style="padding-top:var(--wp--preset--spacing--huge);padding-bottom:var(--wp--preset--spacing--huge)"><img class="wp-block-cover__image-background" alt="" src="https://via.placeholder.com/1920x800" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"3.5rem"}},"textColor":"fjp-white"} -->
<h1 class="wp-block-heading has-text-align-center has-fjp-white-color has-text-color" style="font-size:3.5rem">Juntos construyendo un futuro mejor</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.5rem"}},"textColor":"fjp-white"} -->
<p class="has-text-align-center has-fjp-white-color has-text-color" style="font-size:1.5rem">La Fundación Juventud Progresista trabaja incansablemente para el desarrollo sostenible.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"fjp-secondary","style":{"border":{"radius":"50px"}}} -->
<div class="wp-block-button"><a class="wp-block-button__link has-fjp-secondary-background-color has-background wp-element-button" style="border-radius:50px">Donar Ahora</a></div>
<!-- /wp:button -->

<!-- wp:button {"style":{"border":{"radius":"50px"}},"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" style="border-radius:50px">Ser Voluntario</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:cover -->',
        )
    );

    // 2. CONTADORES DE IMPACTO
    register_block_pattern(
        'fjp/impact-counters',
        array(
            'title'       => __('Contadores de Impacto', 'fjp'),
            'description' => 'Tres columnas con iconos y contadores animados.',
            'categories'  => array('fjp-secciones'),
            'content'     => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl"}}},"backgroundColor":"fjp-light-gray","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-fjp-light-gray-background-color has-background" style="padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl)"><!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"className":"has-text-align-center"} -->
<div class="wp-block-column has-text-align-center"><!-- wp:shortcode -->
[fjp_contador_impacto libras="50000" voluntarios="1000" provincias="32"]
<!-- /wp:shortcode --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
        )
    );

    // 3. SECCIÓN SOBRE NOSOTROS
    register_block_pattern(
        'fjp/about-section',
        array(
            'title'       => __('Sección Sobre Nosotros', 'fjp'),
            'description' => 'Imagen a la izquierda y texto a la derecha.',
            'categories'  => array('fjp-secciones'),
            'content'     => '<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|lg","left":"var:preset|spacing|lg"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"is-style-default rounded-3 shadow"} -->
<figure class="wp-block-image size-large is-style-default rounded-3 shadow"><img src="https://via.placeholder.com/600x400" alt=""/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"textColor":"fjp-primary"} -->
<h2 class="wp-block-heading has-fjp-primary-color has-text-color">Nuestra Misión</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"1.1rem"}}} -->
<p style="font-size:1.1rem">Somos una organización sin fines de lucro dedicada a empoderar a la juventud y fomentar el desarrollo integral de las comunidades más vulnerables.</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><!-- wp:list-item -->
<li>Educación de calidad</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>Salud y bienestar</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>Medio ambiente y sostenibilidad</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:button {"backgroundColor":"fjp-primary","style":{"border":{"radius":"50px"}}} -->
<div class="wp-block-button"><a class="wp-block-button__link has-fjp-primary-background-color has-background wp-element-button" style="border-radius:50px">Conoce más</a></div>
<!-- /wp:button --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->',
        )
    );

    // 4. GRID DE NOTICIAS
    register_block_pattern(
        'fjp/news-grid',
        array(
            'title'       => __('Grid de Últimas Noticias', 'fjp'),
            'description' => 'Muestra las últimas 3 noticias usando el shortcode.',
            'categories'  => array('fjp-secciones'),
            'content'     => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl)"><!-- wp:shortcode -->
[fjp_news_loop posts="3" title="Últimas Noticias"]
<!-- /wp:shortcode --></div>
<!-- /wp:group -->',
        )
    );

    // 5. PÁGINA HOME COMPLETA
    register_block_pattern(
        'fjp/full-home',
        array(
            'title'       => __('Página Home Completa', 'fjp'),
            'description' => 'Plantilla completa para la página de inicio.',
            'categories'  => array('fjp-paginas'),
            'content'     => '<!-- wp:pattern {"slug":"fjp/hero-home"} /-->
<!-- wp:pattern {"slug":"fjp/impact-counters"} /-->
<!-- wp:pattern {"slug":"fjp/about-section"} /-->
<!-- wp:pattern {"slug":"fjp/news-grid"} /-->
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl"}}},"backgroundColor":"fjp-dark-blue","textColor":"fjp-white","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-fjp-white-color has-fjp-dark-blue-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl)"><!-- wp:heading {"textAlign":"center","textColor":"fjp-white"} -->
<h2 class="wp-block-heading has-text-align-center has-fjp-white-color has-text-color">¿Listo para unirte al cambio?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.2rem"}}} -->
<p class="has-text-align-center" style="font-size:1.2rem">Tu apoyo hace posible nuestra misión.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"fjp-secondary","width":50,"style":{"border":{"radius":"50px"}}} -->
<div class="wp-block-button has-custom-width wp-block-button__width-50"><a class="wp-block-button__link has-fjp-secondary-background-color has-background wp-element-button" style="border-radius:50px">Haz tu aporte hoy</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->',
        )
    );
}
add_action('init', 'fjp_register_patterns');
