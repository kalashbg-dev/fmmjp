<?php
/**
 * Template Name: Página Home FJP
 * Description: Plantilla personalizada para la página principal de FJP
 *
 * @package FJP
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php
    while (have_posts()) :
        the_post();
        the_content();
    endwhile;
    ?>
</main>

<?php get_footer(); ?>
