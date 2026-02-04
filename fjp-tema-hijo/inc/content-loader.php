<?php
/**
 * Helper to auto-populate content on theme activation or setup
 *
 * @package FJP
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Insert Default Blocks for Specific Pages if empty
 * This function checks key pages and inserts the "Block Patterns" if they have no content.
 */
function fjp_insert_default_page_content() {
    // Only run this logic in admin to save frontend resources, or specifically on theme activation hook
    // For now, we attach it to admin_init but with a check

    // Page: Voluntariado
    $page_voluntariado = get_page_by_path('voluntariado');
    if ($page_voluntariado && empty($page_voluntariado->post_content)) {
        $content = '<!-- wp:cover {"overlayColor":"fjp-teal","className":"voluntariado-hero fjp-section"} -->
<div class="wp-block-cover voluntariado-hero fjp-section"><span aria-hidden="true" class="wp-block-cover__background has-fjp-teal-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center","level":1} -->
<h1 class="wp-block-heading has-text-align-center">Únete al Voluntariado</h1>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","className":"lead"} -->
<p class="has-text-align-center lead">Tu tiempo puede cambiar vidas.</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:cover -->

<!-- wp:group {"className":"container my-5"} -->
<div class="wp-block-group container my-5"><!-- wp:heading -->
<h2 class="wp-block-heading">Inscríbete</h2>
<!-- /wp:heading -->
<!-- wp:shortcode -->
[fjp_volunteer_form]
<!-- /wp:shortcode --></div>
<!-- /wp:group -->';

        $update_post = array(
            'ID'           => $page_voluntariado->ID,
            'post_content' => $content,
        );
        wp_update_post($update_post);
    }
}
// Uncomment line below to enable auto-population on every admin load (careful)
// add_action('admin_init', 'fjp_insert_default_page_content');
