<?php
/**
 * FJP Testimonials Template.
 */

$count = get_field('posts_per_page') ?: 5;
$args = array(
    'post_type' => 'testimonios',
    'posts_per_page' => $count,
    'post_status' => 'publish',
);
$query = new WP_Query($args);

$classes = 'fjp-testimonials-block alignfull';
if( !empty($block['className']) ) {
    $classes .= ' ' . $block['className'];
}
?>

<div class="<?php echo esc_attr($classes); ?>">
    <div class="fjp-testimonials-slider">
        <?php if ($query->have_posts()): ?>
            <?php while ($query->have_posts()): $query->the_post();
                $cargo = get_field('cargo_testimonio');
                $org = get_field('organizacion_testimonio');
                $thumb = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
            ?>
            <div class="fjp-testimonial-item">
                <div class="fjp-testimonial-quote-icon">“</div>
                <div class="fjp-testimonial-text"><?php echo get_the_excerpt(); ?></div>
                <div class="fjp-testimonial-meta">
                    <?php if($thumb): ?>
                        <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title(); ?>" class="fjp-testimonial-avatar">
                    <?php else: ?>
                        <div class="fjp-testimonial-avatar" style="background: #eee; display:flex; align-items:center; justify-content:center; color:#ccc;">
                            <span class="dashicons dashicons-admin-users"></span>
                        </div>
                    <?php endif; ?>
                    <div class="fjp-testimonial-author">
                        <div class="fjp-testimonial-name"><?php the_title(); ?></div>
                        <?php if($cargo || $org): ?>
                            <div class="fjp-testimonial-role">
                                <?php echo esc_html($cargo); ?>
                                <?php if($cargo && $org) echo ' - '; ?>
                                <?php echo esc_html($org); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
        <?php else: ?>
            <div class="fjp-testimonial-item">
                <p><?php _e('No hay testimonios aún.', 'fjp'); ?></p>
            </div>
        <?php endif; ?>
    </div>
</div>
