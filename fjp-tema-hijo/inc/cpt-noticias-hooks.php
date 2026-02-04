<?php
/**
 * Hooks specific to CPT Noticias
 * Refactors the single-noticias.php template to use Astra hooks.
 *
 * @package FJP
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Render Hero Section after Header
 */
function fjp_noticias_hero_section() {
    if ( ! is_singular('noticias') ) {
        return;
    }

    $noticia_id = get_the_ID();
    $titulo = get_the_title();
    $fecha = get_field('fecha_de_publicacion', $noticia_id);
    $fuente = get_field('fuente_noticia', $noticia_id);
    $ubicacion = get_field('ubicacion_geografica', $noticia_id);
    $resumen = get_field('resumen_de_la_noticia', $noticia_id);

    // Categoría
    $categorias = get_the_terms($noticia_id, 'categoria_noticias');
    $categoria_nombre = '';
    if ( ! is_wp_error($categorias) && ! empty($categorias) ) {
        $categoria_nombre = $categorias[0]->name;
    }

    ?>
    <!-- Hero Section -->
    <section class="single-noticia-hero">
        <div class="container">
            <div class="breadcrumb">
                <a href="<?php echo esc_url(home_url()); ?>"><?php _e('Inicio', 'fjp'); ?></a>
                <span class="separator">/</span>
                <a href="<?php echo esc_url(home_url('/noticias')); ?>"><?php _e('Noticias', 'fjp'); ?></a>
                <span class="separator">/</span>
                <span><?php echo esc_html($titulo); ?></span>
            </div>

            <div class="noticia-meta">
                <div class="noticia-meta-item">
                    <i class="far fa-calendar-alt"></i>
                    <span><?php echo $fecha ? esc_html($fecha) : get_the_date('d/m/Y'); ?></span>
                </div>
                <?php if ($fuente): ?>
                <div class="noticia-meta-item">
                    <i class="far fa-newspaper"></i>
                    <span><?php echo esc_html($fuente); ?></span>
                </div>
                <?php endif; ?>
                <?php if ($ubicacion): ?>
                <div class="noticia-meta-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span><?php echo esc_html($ubicacion); ?></span>
                </div>
                <?php endif; ?>
                <div class="noticia-meta-item">
                    <i class="far fa-clock"></i>
                    <span><?php echo get_the_date('d/m/Y', $noticia_id); ?></span>
                </div>
            </div>

            <?php if ($categoria_nombre): ?>
            <div class="noticia-categoria"><?php echo esc_html($categoria_nombre); ?></div>
            <?php endif; ?>

            <h1><?php echo esc_html($titulo); ?></h1>

            <?php if ($resumen): ?>
            <p class="noticia-resumen"><?php echo esc_html($resumen); ?></p>
            <?php endif; ?>
        </div>
    </section>
    <?php
}
add_action('astra_header_after', 'fjp_noticias_hero_section');

/**
 * Inject content at the bottom of the entry (Info, Tags, Share, Nav)
 */
function fjp_noticias_entry_bottom() {
    if ( ! is_singular('noticias') ) {
        return;
    }

    $noticia_id = get_the_ID();
    $titulo = get_the_title();
    $fecha = get_field('fecha_de_publicacion', $noticia_id);
    $fuente = get_field('fuente_noticia', $noticia_id);
    $url_noticia = get_field('url_noticia', $noticia_id);
    $autor = get_field('autor_de_la_noticia', $noticia_id);
    $tipo_noticia = get_field('tipo_de_noticia', $noticia_id);

    // Etiquetas
    $etiquetas = get_the_terms($noticia_id, 'etiqueta_noticias');

    // Traducir tipo (simple fallback or display raw value)
    $tipo_traducciones = [
        'noticia' => __('Noticia', 'fjp'),
        'comunicado' => __('Comunicado de Prensa', 'fjp'),
        'entrevista' => __('Entrevista', 'fjp'),
        'reportaje' => __('Reportaje', 'fjp'),
        'opinion' => __('Opinión', 'fjp'),
        'otros' => __('Otros', 'fjp')
    ];
    $tipo_nombre = isset($tipo_traducciones[$tipo_noticia]) ? $tipo_traducciones[$tipo_noticia] : $tipo_noticia;

    ?>
    <!-- Información adicional -->
    <div class="noticia-info-adicional">
        <h3><?php _e('Información adicional', 'fjp'); ?></h3>

        <?php if ($fecha): ?>
        <div class="info-item">
            <span class="info-label"><?php _e('Fecha de publicación original:', 'fjp'); ?></span>
            <span class="info-value"><?php echo esc_html($fecha); ?></span>
        </div>
        <?php endif; ?>

        <?php if ($fuente): ?>
        <div class="info-item">
            <span class="info-label"><?php _e('Fuente:', 'fjp'); ?></span>
            <span class="info-value"><?php echo esc_html($fuente); ?></span>
        </div>
        <?php endif; ?>

        <?php if ($autor): ?>
        <div class="info-item">
            <span class="info-label"><?php _e('Autor/a:', 'fjp'); ?></span>
            <span class="info-value"><?php echo esc_html($autor); ?></span>
        </div>
        <?php endif; ?>

        <?php if ($url_noticia): ?>
        <div class="info-item">
            <span class="info-label"><?php _e('Enlace original:', 'fjp'); ?></span>
            <span class="info-value">
                <a href="<?php echo esc_url($url_noticia); ?>" target="_blank" rel="noopener noreferrer">
                    <?php _e('Ver noticia original', 'fjp'); ?> <i class="fas fa-external-link-alt"></i>
                </a>
            </span>
        </div>
        <?php endif; ?>

        <?php if ($tipo_noticia): ?>
        <div class="info-item">
            <span class="info-label"><?php _e('Tipo:', 'fjp'); ?></span>
            <span class="info-value"><?php echo esc_html($tipo_nombre); ?></span>
        </div>
        <?php endif; ?>
    </div>

    <!-- Etiquetas -->
    <?php if ($etiquetas && !is_wp_error($etiquetas)): ?>
    <div class="noticia-etiquetas">
        <h4><i class="fas fa-tags"></i> <?php _e('Etiquetas relacionadas', 'fjp'); ?></h4>
        <div class="etiquetas-lista">
            <?php foreach ($etiquetas as $etiqueta): ?>
            <a href="<?php echo get_term_link($etiqueta); ?>" class="etiqueta-item">
                <?php echo esc_html($etiqueta->name); ?>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Compartir en redes sociales -->
    <div class="noticia-compartir">
        <h4><i class="fas fa-share-alt"></i> <?php _e('Compartir esta noticia', 'fjp'); ?></h4>
        <div class="redes-sociales">
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>"
                target="_blank" rel="noopener noreferrer" class="red-social facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode($titulo); ?>&url=<?php echo urlencode(get_permalink()); ?>"
                target="_blank" rel="noopener noreferrer" class="red-social twitter">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>"
                target="_blank" rel="noopener noreferrer" class="red-social linkedin">
                <i class="fab fa-linkedin-in"></i>
            </a>
            <a href="https://wa.me/?text=<?php echo urlencode($titulo . ' - ' . get_permalink()); ?>"
                target="_blank" rel="noopener noreferrer" class="red-social whatsapp">
                <i class="fab fa-whatsapp"></i>
            </a>
            <a href="mailto:?subject=<?php echo urlencode($titulo); ?>&body=<?php echo urlencode('Te comparto esta noticia: ' . get_permalink()); ?>"
                class="red-social email">
                <i class="fas fa-envelope"></i>
            </a>
        </div>
    </div>

    <!-- Navegación entre noticias -->
    <div class="navegacion-noticias">
        <?php
        $prev_post = get_previous_post();
        $next_post = get_next_post();
        ?>

        <div class="nav-links">
            <?php if ($prev_post): ?>
            <div class="nav-previous">
                <a href="<?php echo get_permalink($prev_post->ID); ?>" rel="prev">
                    <div>
                        <div class="nav-subtitle"><i class="fas fa-chevron-left"></i> <?php _e('Noticia anterior', 'fjp'); ?></div>
                        <div class="nav-title"><?php echo esc_html(get_the_title($prev_post->ID)); ?></div>
                    </div>
                </a>
            </div>
            <?php endif; ?>

            <?php if ($next_post): ?>
            <div class="nav-next">
                <a href="<?php echo get_permalink($next_post->ID); ?>" rel="next">
                    <div>
                        <div class="nav-subtitle"><?php _e('Siguiente noticia', 'fjp'); ?> <i class="fas fa-chevron-right"></i></div>
                        <div class="nav-title"><?php echo esc_html(get_the_title($next_post->ID)); ?></div>
                    </div>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php
}
add_action('astra_entry_bottom', 'fjp_noticias_entry_bottom');

/**
 * Render Related News after Content
 */
function fjp_noticias_related_section() {
    if ( ! is_singular('noticias') ) {
        return;
    }

    $noticia_id = get_the_ID();
    $categorias = get_the_terms($noticia_id, 'categoria_noticias');

    if ( ! $categorias || is_wp_error($categorias) ) {
        return;
    }

    $args_relacionadas = [
        'post_type' => 'noticias',
        'posts_per_page' => 3,
        'post__not_in' => [$noticia_id],
        'tax_query' => [
            [
                'taxonomy' => 'categoria_noticias',
                'field' => 'slug',
                'terms' => wp_list_pluck($categorias, 'slug')
            ]
        ],
        'orderby' => 'date',
        'order' => 'DESC'
    ];

    $noticias_relacionadas = new WP_Query($args_relacionadas);

    if ( $noticias_relacionadas->have_posts() ):
    ?>
    <!-- Noticias Relacionadas -->
    <section class="noticias-relacionadas">
        <div class="container">
            <h2><?php _e('Noticias relacionadas', 'fjp'); ?></h2>
            <div class="row">
                <?php while ($noticias_relacionadas->have_posts()): $noticias_relacionadas->the_post(); ?>
                <div class="col-lg-4 mb-4">
                    <div class="noticia-card">
                        <?php if (has_post_thumbnail()): ?>
                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="noticia-imagen">
                        <?php endif; ?>

                        <div class="noticia-contenido">
                            <?php
                            $categoria_post = get_the_terms(get_the_ID(), 'categoria_noticias');
                            if ($categoria_post && !is_wp_error($categoria_post)):
                                $cat_nombre = $categoria_post[0]->name;
                            ?>
                            <div class="noticia-categoria"><?php echo esc_html($cat_nombre); ?></div>
                            <?php endif; ?>

                            <h3 class="noticia-titulo"><?php the_title(); ?></h3>
                            <div class="noticia-fecha">
                                <i class="far fa-calendar"></i>
                                <?php echo get_the_date('d/m/Y'); ?>
                            </div>
                            <p class="noticia-resumen"><?php echo wp_trim_words(get_the_content(), 20); ?></p>
                            <a href="<?php the_permalink(); ?>" class="noticia-leer-mas"><?php _e('Leer más', 'fjp'); ?></a>
                        </div>
                    </div>
                </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php
    endif;
}
add_action('astra_content_after', 'fjp_noticias_related_section');

/**
 * Remove default Astra Post Navigation on Noticias
 */
function fjp_disable_astra_navigation( $post_nav ) {
    if ( is_singular( 'noticias' ) ) {
        return '';
    }
    return $post_nav;
}
add_filter( 'astra_single_post_navigation_markup', 'fjp_disable_astra_navigation' );

/**
 * Disable default Astra title on Noticias since we use a custom Hero
 */
function fjp_disable_astra_title( $title_enabled ) {
    if ( is_singular( 'noticias' ) ) {
        return false;
    }
    return $title_enabled;
}
add_filter( 'astra_the_title_enabled', 'fjp_disable_astra_title' );
