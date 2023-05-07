<?php
/**
 * Module: Hero
 * 
 * @package ravnostitcuprija
 */

$wrapper_classes    = [];
$wrapper_classes[]  = 'hero hero--' . $args['hero_size'];
$mobile_background  = $args['background_image'] ?? false;
$headline           = $args['headline'] ?? false;
$headline_size      = $args['headline_size'] ?? 'h2';
$text_content       = $args['text_content'] ?? false;
$primary_button     = $args['primary_button'] ?? false;
$secondary_button   = $args['secondary_button'] ?? false;

?>

<section class="module-section module-section--hero-module">
    <div class="<?php echo implode( ' ', $wrapper_classes ); ?>">
        <figure class="hero__mobile-background">
            <?php echo wp_get_attachment_image( $args['background_image'], 'full' ); ?>
            <div class="hero__overlay">

            </div>
        </figure>
        <div class="hero__content">
            <div class="container">
                <?php
                if ($headline) {
                    if ('h1' === $headline_size) {
                        echo '<h1>' . esc_html($headline) . '</h1>';
                    } else {
                        echo '<h2>' . esc_html($headline) . '</h2>';
                    }
                }
                ?>
                <?php if ($text_content) : ?>
                    <p><?php echo wp_kses_post($text_content); ?></p>
                <?php endif; ?>
                <?php if ($primary_button || $secondary_button) : ?>
                    <div class="hero__buttons">
                    <?php endif; ?>
                    <?php if ($primary_button) : ?>
                        <a
                        class="btn btn--primary"
                        href="<?php echo esc_attr($primary_button['url']); ?>"
                        target="<?php echo esc_attr($primary_button['target']) ?>">
                            <?php echo esc_html( $primary_button['title'] ); ?>
                        </a>
                    <?php endif; ?>
                    <?php if ($secondary_button) : ?>
                        <a
                        class="btn btn--secondary"
                        href="<?php echo esc_attr($secondary_button['url']); ?>"
                        target="<?php echo esc_attr($secondary_button['target']) ?>">
                            <?php echo esc_html( $secondary_button['title'] ); ?>
                        </a>
                    <?php endif; ?>
                <?php if ($primary_button || $secondary_button) : ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
