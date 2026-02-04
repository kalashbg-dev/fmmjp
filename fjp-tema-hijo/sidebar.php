<?php
/**
 * The sidebar containing the main widget area.
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

        <?php if ( is_singular('noticias') || is_post_type_archive('noticias') ) : ?>

            <aside class="sidebar-noticias">
                <!-- Búsqueda -->
                <div class="sidebar-widget">
                    <h3><?php _e('Buscar noticias', 'fjp'); ?></h3>
                    <form role="search" method="get" action="<?php echo esc_url(home_url('/noticias')); ?>">
                        <div class="form-group">
                            <input type="search" class="form-control" placeholder="<?php esc_attr_e('Buscar noticias...', 'fjp'); ?>" name="s" value="<?php echo get_search_query(); ?>">
                            <button type="submit" class="btn btn-primary mt-2 w-100">
                                <i class="fas fa-search"></i> <?php _e('Buscar', 'fjp'); ?>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Categorías -->
                <div class="sidebar-widget">
                    <h3><?php _e('Categorías', 'fjp'); ?></h3>
                    <ul class="categorias-lista">
                        <?php
                        $categorias_lista = get_terms([
                            'taxonomy' => 'categoria_noticias',
                            'hide_empty' => true
                        ]);
                        if ( ! is_wp_error( $categorias_lista ) && ! empty( $categorias_lista ) ) {
                            foreach ($categorias_lista as $categoria_item) {
                                echo '<li>';
                                echo '<a href="' . esc_url(get_term_link($categoria_item)) . '">';
                                echo esc_html($categoria_item->name);
                                echo '<span class="count">(' . $categoria_item->count . ')</span>';
                                echo '</a>';
                                echo '</li>';
                            }
                        }
                        ?>
                    </ul>
                </div>

                <!-- Noticias destacadas -->
                <div class="sidebar-widget">
                    <h3><?php _e('Noticias destacadas', 'fjp'); ?></h3>
                    <?php
                    // Intentar obtener noticias destacadas por ACF o por metabox personalizado
                    $args_destacadas = [
                        'post_type' => 'noticias',
                        'posts_per_page' => 3,
                        'meta_query' => [
                            'relation' => 'OR',
                            [
                                'key' => 'destacar_noticia', // ACF
                                'value' => '1',
                                'compare' => '='
                            ],
                            [
                                'key' => '_fjp_destacado', // Custom Metabox
                                'value' => '1',
                                'compare' => '='
                            ]
                        ]
                    ];
                    $noticias_destacadas = new WP_Query($args_destacadas);

                    if ($noticias_destacadas->have_posts()):
                        while ($noticias_destacadas->have_posts()):
                            $noticias_destacadas->the_post();
                            $imagen = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
                    ?>
                    <div class="noticia-destacada-mini">
                        <?php if ($imagen): ?>
                        <img src="<?php echo esc_url($imagen); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                        <?php endif; ?>
                        <div class="noticia-destacada-contenido">
                            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <span class="fecha"><?php echo get_the_date('d/m/Y'); ?></span>
                        </div>
                    </div>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </aside>

        <?php else : ?>

            <?php
            if ( is_active_sidebar( $astra_sidebar ) ) {
                    dynamic_sidebar( $astra_sidebar );
            }
            ?>

        <?php endif; ?>

		<?php astra_sidebars_after(); ?>

	</div><!-- .sidebar-main -->
</div><!-- #secondary -->
