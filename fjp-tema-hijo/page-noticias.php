<?php
/**
 * Template Name: Página Noticias FJP
 * Description: Plantilla personalizada para mostrar el blog/noticias con el CPT Noticias
 *
 * @package FJP
 */

get_header();

// Configuración de paginación
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$posts_per_page = get_option('posts_per_page', 9);

// Obtener categoría y búsqueda si existen
$current_category = get_query_var('categoria_noticias');
$search_query = get_search_query();

// Construir query de noticias
$args = array(
    'post_type' => 'noticias',
    'posts_per_page' => $posts_per_page,
    'paged' => $paged,
    'orderby' => 'date',
    'order' => 'DESC'
);

// Filtrar por categoría si se seleccionó
if ($current_category) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'categoria_noticias',
            'field' => 'slug',
            'terms' => $current_category
        )
    );
}

// Filtrar por búsqueda si existe
if ($search_query) {
    $args['s'] = $search_query;
}

$noticias = new WP_Query($args);

// Obtener todas las categorías
$categories = get_terms(array(
    'taxonomy' => 'categoria_noticias',
    'hide_empty' => true
));
?>

<div id="primary" <?php astra_primary_class(); ?>>
    <main id="main" class="site-main">

    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            the_content();
        }
    }
    ?>

    <!-- Barra de Búsqueda y Filtros -->
    <section class="fjp-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <!-- Búsqueda -->
                    <form method="get" action="" class="mb-4">
                        <div class="input-group">
                            <input type="text"
                                   name="s"
                                   class="form-control"
                                   placeholder="<?php esc_attr_e('Buscar noticias...', 'fjp'); ?>"
                                   value="<?php echo esc_attr($search_query); ?>">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i> <?php _e('Buscar', 'fjp'); ?>
                            </button>
                        </div>
                    </form>

                    <!-- Filtros por Categoría -->
                    <?php if (!empty($categories) && !is_wp_error($categories)) : ?>
                        <div class="fjp-category-filters text-center mb-4">
                            <div class="btn-group flex-wrap" role="group">
                                <a href="<?php echo get_post_type_archive_link('noticias'); ?>"
                                   class="btn btn-outline-primary <?php echo !$current_category ? 'active' : ''; ?>">
                                    <?php _e('Todas', 'fjp'); ?>
                                </a>
                                <?php foreach ($categories as $category) : ?>
                                    <a href="<?php echo get_term_link($category); ?>"
                                       class="btn btn-outline-primary <?php echo $current_category === $category->slug ? 'active' : ''; ?>">
                                        <?php echo esc_html($category->name); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Grid de Noticias -->
    <section class="fjp-section">
        <div class="container">
            <?php if ($noticias->have_posts()) : ?>
                <div class="row">
                    <?php while ($noticias->have_posts()) : $noticias->the_post();
                        $url_externa = get_field('url_noticia');
                        $fuente = get_field('fuente_noticia');
                        $target = $url_externa ? 'target="_blank" rel="noopener noreferrer"' : '';
                        $permalink = $url_externa ? $url_externa : get_the_permalink();
                        $categories_list = get_the_term_list(get_the_ID(), 'categoria_noticias', '', ', ');
                    ?>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <article class="fjp-blog-card card h-100 border-0 shadow-sm">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php echo esc_url($permalink); ?>" <?php echo $target; ?> class="text-decoration-none">
                                        <?php the_post_thumbnail('fjp-noticia-card', array('class' => 'card-img-top')); ?>
                                    </a>
                                <?php else : ?>
                                    <a href="<?php echo esc_url($permalink); ?>" <?php echo $target; ?> class="text-decoration-none">
                                        <div class="fjp-news-placeholder card-img-top d-flex align-items-center justify-content-center bg-light" style="height: 200px;">
                                            <i class="fas fa-newspaper fa-4x text-muted"></i>
                                        </div>
                                    </a>
                                <?php endif; ?>

                                <div class="card-body d-flex flex-column">
                                    <!-- Meta información -->
                                    <div class="fjp-blog-meta mb-2">
                                        <small class="text-muted">
                                            <i class="far fa-calendar me-1"></i><?php echo get_the_date('d/m/Y'); ?>
                                            <?php if ($fuente) : ?>
                                                | <i class="far fa-newspaper me-1"></i><?php echo esc_html($fuente); ?>
                                            <?php endif; ?>
                                        </small>
                                    </div>

                                    <!-- Categorías -->
                                    <?php if ($categories_list && !is_wp_error($categories_list)) : ?>
                                        <div class="fjp-blog-categories mb-2">
                                            <small class="text-primary">
                                                <i class="far fa-folder me-1"></i><?php echo $categories_list; ?>
                                            </small>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Título -->
                                    <h5 class="card-title mb-2">
                                        <a href="<?php echo esc_url($permalink); ?>" <?php echo $target; ?> class="text-decoration-none text-dark">
                                            <?php the_title(); ?>
                                        </a>
                                    </h5>

                                    <!-- Extracto -->
                                    <p class="fjp-blog-excerpt flex-grow-1 mb-3">
                                        <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                                    </p>

                                    <!-- Botón leer más -->
                                    <div class="mt-auto">
                                        <a href="<?php echo esc_url($permalink); ?>" <?php echo $target; ?> class="btn btn-sm btn-primary">
                                            <?php echo $url_externa ? __('Leer noticia completa', 'fjp') : __('Leer más', 'fjp'); ?>
                                            <?php if ($url_externa) : ?>
                                                <i class="fas fa-external-link-alt ms-1"></i>
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php endwhile; ?>
                </div>

                <!-- Paginación -->
                <?php if ($noticias->max_num_pages > 1) : ?>
                    <div class="row">
                        <div class="col-12">
                            <nav class="fjp-pagination" aria-label="<?php esc_attr_e('Paginación de noticias', 'fjp'); ?>">
                                <?php
                                echo paginate_links(array(
                                    'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                                    'format' => '?paged=%#%',
                                    'current' => max(1, $paged),
                                    'total' => $noticias->max_num_pages,
                                    'prev_text' => '<i class="fas fa-chevron-left"></i> ' . __('Anterior', 'fjp'),
                                    'next_text' => __('Siguiente', 'fjp') . ' <i class="fas fa-chevron-right"></i>',
                                    'type' => 'list',
                                    'end_size' => 3,
                                    'mid_size' => 3
                                ));
                                ?>
                            </nav>
                        </div>
                    </div>
                <?php endif; ?>

            <?php else : ?>
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="fjp-no-results">
                            <i class="fas fa-search fa-4x text-muted mb-4"></i>
                            <h3><?php _e('No se encontraron noticias', 'fjp'); ?></h3>
                            <p class="lead">
                                <?php echo $search_query ?
                                    sprintf(__('No hay noticias que coincidan con tu búsqueda: "%s"', 'fjp'), esc_html($search_query)) :
                                    __('No hay noticias disponibles en este momento.', 'fjp'); ?>
                            </p>
                            <?php if ($search_query) : ?>
                                <a href="<?php echo get_post_type_archive_link('noticias'); ?>" class="btn btn-primary">
                                    <?php _e('Ver todas las noticias', 'fjp'); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>