<?php
/**
 * FJP Volunteer CTA Template.
 */

$title = get_field('title');
$text = get_field('text');
$btn_label = get_field('button_label');
$btn_url = get_field('button_url');

$classes = 'fjp-volunteer-cta alignwide';
if( !empty($block['className']) ) {
    $classes .= ' ' . $block['className'];
}
?>
<div class="<?php echo esc_attr($classes); ?>">
    <div class="fjp-cta-content">
        <?php if($title): ?>
            <h2 class="fjp-cta-title"><?php echo esc_html($title); ?></h2>
        <?php endif; ?>

        <?php if($text): ?>
            <div class="fjp-cta-text"><?php echo esc_html($text); ?></div>
        <?php endif; ?>

        <?php if($btn_label && $btn_url): ?>
            <a href="<?php echo esc_url($btn_url); ?>" class="fjp-cta-btn">
                <?php echo esc_html($btn_label); ?>
            </a>
        <?php endif; ?>
    </div>
</div>
