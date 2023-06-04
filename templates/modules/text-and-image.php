<?php
/**
 * Module: Text and image
 * 
 * @package Ravnostitcuprija
 */

$content = $args['content'] ?? false;
$image = $args['image'] ?? false;
$image_position = $args['image_position'] ?? "left";
$cta_button = $args['cta_button'] ?? false;

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
                    <?php if ($cta_button) : ?>
                        <a
                        class="btn btn--primary"
                        href="<?php echo esc_url($cta_button['url']); ?>"
                        target=<?php echo esc_attr($cta_button['target']); ?>>
                            <?php echo esc_html($cta_button['title']); ?>
                        </a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>