<?php
/**
 * Module: Text and image
 * 
 * @package Ravnostitcuprija
 */

$content = $args['content'] ?? false;
$image = $args['image'] ?? false;
$image_position = $args['image_position'] ?? "left";

if (! $content) {
    return;
}
?>

<section class="module-section module-section--text-and-image-module">
    <div class="entry-content">
        <div class="container">
            <div class="text-and-image-wrapper image-<?php echo esc_attr($image_position); ?>">
                <?php if (isset($image) && ! empty($image)) : ?>
                    <div class="image-wrapper">
                        <figure>
                            <?php echo wp_get_attachment_image( $image, 'sm_4_3' ); ?>
                        </figure>
                    </div>
                <?php endif; ?>
                <?php if (isset($content) && ! empty($content)) : ?>
                <div class="content-wrapper">
                    <?php echo wp_kses_post($content); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>