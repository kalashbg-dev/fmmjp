<?php
/**
 * Template Name: FJP - Ancho Completo (Canvas)
 * Description: Plantilla de ancho completo ideal para los Patrones FJP.
 *
 * @package FJP
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<?php
		if ( have_posts() ) :
			do_action( 'astra_template_parts_content_top' );

			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', 'page' );
			endwhile;

			do_action( 'astra_template_parts_content_bottom' );
		endif;
		?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
