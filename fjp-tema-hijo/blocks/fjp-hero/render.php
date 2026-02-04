<?php
/**
 * FJP Hero Block Template.
 */

$title = get_field('title');
$description = get_field('description');
$bg_image = get_field('background_image');
$overlay = get_field('overlay_color'); // fjp-primary, etc.
$buttons = get_field('buttons');

$bg_style = $bg_image ? 'background-image: url(' . esc_url($bg_image) . ');' : '';

// Overlay Class
$overlay_class = '';
if ($overlay && $overlay !== 'none') {
    $overlay_class = 'overlay-' . $overlay;
}

$classes = 'fjp-hero-block alignfull';
if( !empty($block['className']) ) {
    $classes .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $classes .= ' align' . $block['align'];
}
?>
<div class="<?php echo esc_attr($classes); ?>" style="<?php echo esc_attr($bg_style); ?>">
    <div class="fjp-hero-overlay <?php echo esc_attr($overlay_class); ?>"></div>
    <div class="fjp-hero-content container">
        <?php if($title): ?>
            <h1 class="fjp-hero-title animate__animated animate__fadeInUp"><?php echo esc_html($title); ?></h1>
        <?php endif; ?>

        <?php if($description): ?>
            <p class="fjp-hero-desc animate__animated animate__fadeInUp animate__delay-1s"><?php echo esc_html($description); ?></p>
        <?php endif; ?>

        <?php if($buttons): ?>
            <div class="fjp-hero-buttons animate__animated animate__fadeInUp animate__delay-2s">
                <?php foreach($buttons as $btn):
                    $style_class = 'btn-fjp-' . $btn['style'];
                    if($btn['style'] == 'outline') {
                        // Custom inline style for outline if not defined globally
                         $style_class = 'btn btn-outline-light rounded-pill px-4 py-2 fw-bold';
                    }
                ?>
                    <a href="<?php echo esc_url($btn['url']); ?>" class="<?php echo esc_attr($style_class); ?>">
                        <?php echo esc_html($btn['label']); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
