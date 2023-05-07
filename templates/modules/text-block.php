<?php
/**
 * Module: Text block
 * 
 * @package ravnostitcuprija
 */

$content = $args['content'];

if (! $content) {
    return;
}
?>

<section class="module-section module-section--text-block-module">
    <div class="entry-content">
        <div class="container container--narrow">
            <?php echo wp_kses_post($content); ?>
        </div>
    </div>
</section>