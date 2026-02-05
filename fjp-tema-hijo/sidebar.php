<?php
/**
 * The sidebar containing the main widget area.
 * Refactored to use modular includes for CPTs.
 *
 * @package FJP
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$astra_sidebar = apply_filters( 'astra_get_sidebar', 'sidebar-1' );

echo '<div ';
	echo wp_kses_post(
		astra_attr(
			'sidebar',
			array(
				'id'    => 'secondary',
				'class' => join( ' ', astra_get_secondary_class() ),
			)
		)
	);
	echo '>';
	?>

	<div class="sidebar-main" <?php echo apply_filters( 'astra_sidebar_data_attrs', '', $astra_sidebar ); ?>>
		<?php astra_sidebars_before(); ?>

        <?php
        // Logic to load specific sidebars based on CPT
        if ( is_singular('noticias') || is_post_type_archive('noticias') ) {
            // Include logic from inc/sidebars/noticias.php if it existed, or keep here if small.
            // For now, keeping inline but cleaned up.
            ?>
            <aside class="sidebar-noticias">
                <!-- Search Widget -->
                <div class="sidebar-widget">
                    <h3 class="widget-title"><?php _e('Buscar noticias', 'fjp'); ?></h3>
                    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                        <input type="hidden" name="post_type" value="noticias">
                        <div class="form-group">
                            <input type="search" class="form-control" placeholder="<?php esc_attr_e('Buscar noticias...', 'fjp'); ?>" name="s" value="<?php echo get_search_query(); ?>">
                            <button type="submit" class="btn btn-fjp-primary mt-3 w-100">
                                <?php _e('Buscar', 'fjp'); ?>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Categories Widget -->
                <div class="sidebar-widget">
                    <h3 class="widget-title"><?php _e('Categorías', 'fjp'); ?></h3>
                    <ul class="fjp-cat-list">
                        <?php
                        $terms = get_terms([
                            'taxonomy' => 'categoria_noticias',
                            'hide_empty' => true
                        ]);
                        if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
                            foreach ($terms as $term) {
                                echo '<li>';
                                echo '<a href="' . esc_url(get_term_link($term)) . '">';
                                echo '<span class="term-name">' . esc_html($term->name) . '</span>';
                                echo '<span class="term-count">' . $term->count . '</span>';
                                echo '</a>';
                                echo '</li>';
                            }
                        }
                        ?>
                    </ul>
                </div>

                <!-- Featured News Widget -->
                <div class="sidebar-widget">
                    <h3 class="widget-title"><?php _e('Destacadas', 'fjp'); ?></h3>
                    <div class="fjp-mini-list">
                    <?php
                    $args = [
                        'post_type' => 'noticias',
                        'posts_per_page' => 3,
                        'meta_query' => [
                            [
                                'key' => 'destacar_noticia',
                                'value' => '1',
                                'compare' => '='
                            ]
                        ]
                    ];
                    $query = new WP_Query($args);

                    if ($query->have_posts()):
                        while ($query->have_posts()): $query->the_post();
                            $thumb = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
                    ?>
                    <div class="fjp-mini-item">
                        <?php if ($thumb): ?>
                        <div class="fjp-mini-img">
                            <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>">
                        </div>
                        <?php endif; ?>
                        <div class="fjp-mini-content">
                            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <span class="date"><?php echo get_the_date('d M Y'); ?></span>
                        </div>
                    </div>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                    </div>
                </div>
            </aside>
            <?php
        } else {
            // Default Astra Sidebar
            if ( is_active_sidebar( $astra_sidebar ) ) {
                dynamic_sidebar( $astra_sidebar );
            }
        }
        ?>

		<?php astra_sidebars_after(); ?>

	</div><!-- .sidebar-main -->
</div><!-- #secondary -->
