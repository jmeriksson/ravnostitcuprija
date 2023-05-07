<?php
/**
 * Module: Headline and content
 * 
 * @package ravnostitcuprija
 */

$headline = $args['headline'] ?? false;
$content = $args['content'] ?? false;

?>

<section class="module-section module-section--headline-and-content-module">
    <div class="entry-content">
        <div class="container">
            <div class="headline-and-content">
                <div class="headline">
                    <?php if ($headline) : ?>
                        <h2><?php echo esc_html($headline); ?></h2>
                    <?php endif; ?>
                </div>
                <div class="content">
                    <?php if ($headline) : ?>
                        <?php echo wp_kses_post($content); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>