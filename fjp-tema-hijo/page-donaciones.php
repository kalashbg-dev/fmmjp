<?php
/**
 * Template Name: Página Donaciones FJP
 * Description: Plantilla personalizada para la página de donaciones
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
