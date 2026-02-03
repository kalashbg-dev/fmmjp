<?php
/**
 * Plantilla para publicaciones individuales de Noticias
 * Template Name: Single Noticia
 * @package FJP
 */

get_header();

// Obtener datos de la noticia
$noticia_id = get_the_ID();
$titulo = get_the_title();
$contenido = get_the_content();
$fecha = get_field('fecha_de_publicacion', $noticia_id);
// Check new field first, then legacy
$fuente = get_field('fuente_noticia', $noticia_id) ?: get_field('fuente', $noticia_id);
$url_noticia = get_field('url_noticia', $noticia_id) ?: get_field('url_de_noticia', $noticia_id);
$autor = get_field('autor_de_la_noticia', $noticia_id);
$resumen = get_field('resumen_de_la_noticia', $noticia_id);
$categoria_tematica = get_field('categoria_tematica', $noticia_id);
$tipo_noticia = get_field('tipo_de_noticia', $noticia_id);
$ubicacion = get_field('ubicacion_geografica', $noticia_id);
$destacada = get_field('destacar_noticia', $noticia_id);

// Obtener categorías y etiquetas
$categorias = get_the_terms($noticia_id, 'categoria_noticias');
$etiquetas = get_the_terms($noticia_id, 'etiqueta_noticias');

// Obtener imagen destacada
$imagen_destacada = get_the_post_thumbnail_url($noticia_id, 'full');
$imagen_alt = get_post_meta(get_post_thumbnail_id($noticia_id), '_wp_attachment_image_alt', true);

// Traducciones de categorías
$categorias_traducciones = [
    'educacion' => 'Educación y Formación',
    'infancia' => 'Infancia y Adolescencia',
    'comunidad' => 'Desarrollo Comunitario',
    'salud' => 'Salud y Bienestar',
    'deportes' => 'Deportes y Recreación',
    'cultura' => 'Cultura y Arte',
    'medio-ambiente' => 'Medio Ambiente',
    'tecnologia' => 'Tecnología e Innovación',
    'derechos' => 'Derechos Humanos',
    'voluntariado' => 'Voluntariado y Participación',
    'fundacion' => 'Actividades de la Fundación',
    'otros' => 'Otros'
];

$tipo_traducciones = [
    'noticia' => 'Noticia',
    'comunicado' => 'Comunicado de Prensa',
    'entrevista' => 'Entrevista',
    'reportaje' => 'Reportaje',
    'opinion' => 'Opinión',
    'otros' => 'Otros'
];

$categoria_nombre = isset($categorias_traducciones[$categoria_tematica]) ? $categorias_traducciones[$categoria_tematica] : $categoria_tematica;
$tipo_nombre = isset($tipo_traducciones[$tipo_noticia]) ? $tipo_traducciones[$tipo_noticia] : $tipo_noticia;

// Obtener noticias relacionadas
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

// Schema markup para SEO
$schema = [
    "@context" => "https://schema.org",
    "@type" => "NewsArticle",
    "headline" => $titulo,
    "description" => $resumen ?: wp_trim_words($contenido, 30),
    "image" => $imagen_destacada,
    "datePublished" => get_the_date('c', $noticia_id),
    "dateModified" => get_the_modified_date('c', $noticia_id),
    "author" => [
        "@type" => $autor ? "Person" : "Organization",
        "name" => $autor ?: "Fundación Juega y Participa"
    ],
    "publisher" => [
        "@type" => "Organization",
        "name" => "Fundación Juega y Participa",
        "logo" => [
            "@type" => "ImageObject",
            "url" => get_template_directory_uri() . '/assets/img/logo-fjp.png'
        ]
    ],
    "mainEntityOfPage" => [
        "@type" => "WebPage",
        "@id" => get_permalink($noticia_id)
    ]
];

?>

<!-- Schema markup -->
<script type="application/ld+json">
<?php echo json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
</script>

<!-- Hero Section -->
<section class="single-noticia-hero">
    <div class="container">
        <div class="breadcrumb">
            <a href="<?php echo home_url(); ?>">Inicio</a>
            <span class="separator">/</span>
            <a href="<?php echo home_url('/noticias'); ?>">Noticias</a>
            <span class="separator">/</span>
            <span><?php echo esc_html($titulo); ?></span>
        </div>

        <div class="noticia-meta">
            <div class="noticia-meta-item">
                <i class="far fa-calendar-alt"></i>
                <span><?php echo esc_html($fecha); ?></span>
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

<!-- Contenido Principal -->
<section class="single-noticia-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <article class="contenido-principal">
                    <?php if ($imagen_destacada): ?>
                    <img src="<?php echo esc_url($imagen_destacada); ?>" alt="<?php echo esc_attr($imagen_alt ?: $titulo); ?>" class="imagen-destacada">
                    <?php endif; ?>

                    <div class="contenido-texto">
                        <?php echo wp_kses_post($contenido); ?>
                    </div>

                    <!-- Información adicional -->
                    <div class="noticia-info-adicional">
                        <h3>Información adicional</h3>

                        <?php if ($fecha): ?>
                        <div class="info-item">
                            <span class="info-label">Fecha de publicación original:</span>
                            <span class="info-value"><?php echo esc_html($fecha); ?></span>
                        </div>
                        <?php endif; ?>

                        <?php if ($fuente): ?>
                        <div class="info-item">
                            <span class="info-label">Fuente:</span>
                            <span class="info-value"><?php echo esc_html($fuente); ?></span>
                        </div>
                        <?php endif; ?>

                        <?php if ($autor): ?>
                        <div class="info-item">
                            <span class="info-label">Autor/a:</span>
                            <span class="info-value"><?php echo esc_html($autor); ?></span>
                        </div>
                        <?php endif; ?>

                        <?php if ($url_noticia): ?>
                        <div class="info-item">
                            <span class="info-label">Enlace original:</span>
                            <span class="info-value">
                                <a href="<?php echo esc_url($url_noticia); ?>" target="_blank" rel="noopener noreferrer">
                                    Ver noticia original <i class="fas fa-external-link-alt"></i>
                                </a>
                            </span>
                        </div>
                        <?php endif; ?>

                        <?php if ($tipo_noticia): ?>
                        <div class="info-item">
                            <span class="info-label">Tipo:</span>
                            <span class="info-value"><?php echo esc_html($tipo_nombre); ?></span>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Etiquetas -->
                    <?php if ($etiquetas && !is_wp_error($etiquetas)): ?>
                    <div class="noticia-etiquetas">
                        <h4><i class="fas fa-tags"></i> Etiquetas relacionadas</h4>
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
                        <h4><i class="fas fa-share-alt"></i> Compartir esta noticia</h4>
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
                </article>

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
                                    <div class="nav-subtitle"><i class="fas fa-chevron-left"></i> Noticia anterior</div>
                                    <div class="nav-title"><?php echo esc_html(get_the_title($prev_post->ID)); ?></div>
                                </div>
                            </a>
                        </div>
                        <?php endif; ?>

                        <?php if ($next_post): ?>
                        <div class="nav-next">
                            <a href="<?php echo get_permalink($next_post->ID); ?>" rel="next">
                                <div>
                                    <div class="nav-subtitle">Siguiente noticia <i class="fas fa-chevron-right"></i></div>
                                    <div class="nav-title"><?php echo esc_html(get_the_title($next_post->ID)); ?></div>
                                </div>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <aside class="sidebar">
                    <!-- Búsqueda -->
                    <div class="sidebar-widget">
                        <h3>Buscar noticias</h3>
                        <form role="search" method="get" action="<?php echo home_url('/noticias'); ?>">
                            <div class="form-group">
                                <input type="search" class="form-control" placeholder="Buscar noticias..." name="s" value="<?php echo get_search_query(); ?>">
                                <button type="submit" class="btn btn-primary mt-2 w-100">
                                    <i class="fas fa-search"></i> Buscar
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Categorías -->
                    <div class="sidebar-widget">
                        <h3>Categorías</h3>
                        <ul class="categorias-lista">
                            <?php
                            $categorias_lista = get_terms([
                                'taxonomy' => 'categoria_noticias',
                                'hide_empty' => true
                            ]);
                            foreach ($categorias_lista as $categoria_item):
                                $nombre_traducido = isset($categorias_traducciones[$categoria_item->slug]) ? $categorias_traducciones[$categoria_item->slug] : $categoria_item->name;
                            ?>
                            <li>
                                <a href="<?php echo get_term_link($categoria_item); ?>">
                                    <?php echo esc_html($nombre_traducido); ?>
                                    <span class="count">(<?php echo $categoria_item->count; ?>)</span>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <!-- Noticias destacadas -->
                    <div class="sidebar-widget">
                        <h3>Noticias destacadas</h3>
                        <?php
                        $args_destacadas = [
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
            </div>
        </div>
    </div>
</section>

<!-- Noticias Relacionadas -->
<?php if ($noticias_relacionadas->have_posts()): ?>
<section class="noticias-relacionadas">
    <div class="container">
        <h2>Noticias relacionadas</h2>
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
                            $cat_slug = $categoria_post[0]->slug;
                            $cat_nombre = isset($categorias_traducciones[$cat_slug]) ? $categorias_traducciones[$cat_slug] : $categoria_post[0]->name;
                        ?>
                        <div class="noticia-categoria"><?php echo esc_html($cat_nombre); ?></div>
                        <?php endif; ?>

                        <h3 class="noticia-titulo"><?php the_title(); ?></h3>
                        <div class="noticia-fecha">
                            <i class="far fa-calendar"></i>
                            <?php echo get_the_date('d/m/Y'); ?>
                        </div>
                        <p class="noticia-resumen"><?php echo wp_trim_words(get_the_content(), 20); ?></p>
                        <a href="<?php the_permalink(); ?>" class="noticia-leer-mas">Leer más</a>
                    </div>
                </div>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animación suave al hacer clic en enlaces internos
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Compartir en redes sociales con animación
    document.querySelectorAll('.red-social').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.href;
            const width = 600;
            const height = 400;
            const left = (screen.width - width) / 2;
            const top = (screen.height - height) / 2;

            window.open(url, 'compartir', `width=${width},height=${height},left=${left},top=${top}`);

            // Animación de éxito
            this.style.transform = 'scale(1.1)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 200);
        });
    });

    // Lazy loading para imágenes
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src || img.src;
                    img.classList.add('loaded');
                    observer.unobserve(img);
                }
            });
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }

    // Navegación responsive
    const navLinks = document.querySelector('.nav-links');
    if (navLinks && window.innerWidth <= 768) {
        navLinks.style.flexDirection = 'column';
    }
});
</script>

<?php get_footer(); ?>