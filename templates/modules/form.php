<?php
/**
 * Module: Columns
 * 
 * @package ravnostitcuprija
 */

$shortcode = $args['shortcode'] ?? false;
$layout = $args['layout'] ?? false;
$headline = $args['headline'] && $layout === 'form_and_text' ? $args['headline'] : false;
$headline_size = $args['headline_size'] && $layout === 'form_and_text' ? $args['headline_size'] : 'h2';
$text_content = $args['text_content'] && $layout === 'form_and_text' ? $args['text_content'] : false;

$container_classes = ["container"];
if ($layout === "form_only") {
    $container_classes[] = "container--narrow";
}

?>

<section class="module-section module-section--form-module">
    <div class="<?php echo implode(' ', $container_classes); ?>">
        <div class="form-wrapper">
            <?php if ($layout === 'form_and_text') : ?>
                <div class="text-content">
                    <?php if ($headline) : ?>
                        <?php
                            switch ($headline_size) {
                                case 'h1':
                                    echo '<h1>' . esc_html($headline) . '</h1>';
                                    break;
                                case 'h2';
                                    echo '<h2>' . esc_html($headline) . '</h2>';
                                    break;
                            }
                        ?>
                    <?php endif; ?>
                    <?php if ($text_content) : ?>
                        <div class="entry-content">
                            <?php echo wp_kses_post($text_content); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <?php if ($shortcode) : ?>
                <div class="form">
                    <?php echo do_shortcode($shortcode); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>