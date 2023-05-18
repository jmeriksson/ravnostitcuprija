<?php
/**
 * Module: Columns
 * 
 * @package Ravnostitcuprija
 */

$columns = $args['repeater'] ?? false;
$mobile_layout = $args['mobile_no_of_columns'] ?? "1";
$tablet_layout = $args['tablet_no_of_columns'] ?? "2";
$desktop_layout = $args['desktop_no_of_columns'] ?? "4";
$image_ratio = $args['image_ratio'] ?? "4_3";

if (!$columns) {
    return;
}

$wrapper_classes = "columns-wrapper mobile-$mobile_layout tablet-$tablet_layout desktop-$desktop_layout";
$container_classes = ["container"];
if ($desktop_layout === "1") {
    $container_classes[] = "container--narrow";
}

?>

<section class="module-section module-section--columns-module">
    <div class="<?php echo implode(" ", $container_classes); ?>">
        <div class="<?php echo esc_attr($wrapper_classes); ?>">
            <?php foreach($columns as $column): ?>
                <div class="column">
                    <?php if ($column['image']) : ?>
                        <figure>
                            <?php echo wp_get_attachment_image($column['image'], "720_$image_ratio"); ?>
                        </figure>
                    <?php endif; ?>
                    <?php if ($column['content']): ?>
                        <div>
                            <?php echo wp_kses_post($column['content']); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>