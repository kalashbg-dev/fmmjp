<?php
/**
 * FJP News Grid Template.
 */

$posts_per_page = get_field('posts_per_page') ?: 6;
$selected_cat = get_field('category'); // Taxonomy term ID

$args = array(
    'post_type' => 'noticias',
    'posts_per_page' => $posts_per_page,
    'post_status' => 'publish',
);

if ($selected_cat) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'categoria_noticias',
            'field'    => 'term_id',
            'terms'    => $selected_cat,
        ),
    );
}

$query = new WP_Query($args);
$categories = get_terms(array('taxonomy' => 'categoria_noticias', 'hide_empty' => true));

$classes = 'fjp-news-grid alignwide';
if( !empty($block['className']) ) {
    $classes .= ' ' . $block['className'];
}
?>

<div class="<?php echo esc_attr($classes); ?>">
    <?php if (!$selected_cat && !empty($categories) && !is_wp_error($categories)): ?>
    <div class="fjp-news-filters">
        <button class="fjp-news-filter-btn active" data-filter="all"><?php _e('Todas', 'fjp'); ?></button>
        <?php foreach($categories as $cat): ?>
            <button class="fjp-news-filter-btn" data-filter=".cat-<?php echo esc_attr($cat->slug); ?>"><?php echo esc_html($cat->name); ?></button>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <div class="fjp-news-container">
        <?php if ($query->have_posts()): ?>
            <?php while ($query->have_posts()): $query->the_post();
                $terms = get_the_terms(get_the_ID(), 'categoria_noticias');
                $cat_slugs = '';
                $first_cat_name = '';
                if ($terms && !is_wp_error($terms)) {
                    foreach ($terms as $term) {
                        $cat_slugs .= ' cat-' . $term->slug;
                        if (!$first_cat_name) $first_cat_name = $term->name;
                    }
                }
                $thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
            ?>
            <div class="fjp-news-card mix<?php echo esc_attr($cat_slugs); ?>">
                <div class="fjp-news-img" style="background-image: url('<?php echo esc_url($thumb); ?>');">
                    <?php if ($first_cat_name): ?>
                        <span class="fjp-news-cat-badge"><?php echo esc_html($first_cat_name); ?></span>
                    <?php endif; ?>
                </div>
                <div class="fjp-news-body">
                    <div class="fjp-news-date"><?php echo get_the_date('d M Y'); ?></div>
                    <h3 class="fjp-news-title"><?php the_title(); ?></h3>
                    <div class="fjp-news-excerpt"><?php the_excerpt(); ?></div>
                    <a href="<?php the_permalink(); ?>" class="fjp-news-link"><?php _e('Leer más', 'fjp'); ?> <span class="dashicons dashicons-arrow-right-alt"></span></a>
                </div>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
        <?php else: ?>
            <p class="text-center"><?php _e('No hay noticias disponibles.', 'fjp'); ?></p>
        <?php endif; ?>
    </div>
</div>

<script>
// Simple Filter Logic
document.addEventListener('DOMContentLoaded', function() {
    // Scope to this specific block instance if possible, but class selection is fine for now
    const filterSets = document.querySelectorAll('.fjp-news-grid');

    filterSets.forEach(grid => {
        const filters = grid.querySelectorAll('.fjp-news-filter-btn');
        const items = grid.querySelectorAll('.fjp-news-card');

        filters.forEach(btn => {
            btn.addEventListener('click', function() {
                // Remove active class
                filters.forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const filterValue = this.getAttribute('data-filter');

                items.forEach(item => {
                    if (filterValue === 'all' || item.classList.contains(filterValue.substring(1))) {
                        item.style.display = 'flex';
                        // Add animation class if desired
                        item.style.opacity = '0';
                        setTimeout(() => item.style.opacity = '1', 50);
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    });
});
</script>
