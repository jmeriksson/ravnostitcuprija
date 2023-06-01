<?php
/**
 * Module: Icon row
 * 
 * @package Ravnostitcuprija
 */

$icons = $args['icons'] ?? [];
$icon_style = $args['icon_style'] ?? '';

?>

<section class="module-section module-section--icon-row-module">
    <div class="entry-content">
        <div class="container">
            <?php if (count($icons) > 0) : ?>
                <div class="icons">
                    <?php foreach ($icons as $icon) : ?>
                        <div class="icon">
                            <div class="image">
                                <?php
                                if (isset($icon['link']) && !empty($icon['link'])) {
                                    printf(
                                        '<a href="%s" target="%s">',
                                        esc_url($icon['link']['url']),
                                        esc_attr($icon['link']['target'])
                                    );
                                }
                                echo file_get_contents( get_template_directory() . "/assets/images/icons/" . $icon['icon'] . '-' . $icon_style . ".svg");
                                if (isset($icon['link']) && !empty($icon['link'])) {
                                    echo '</a>';
                                }
                                ?>
                            </div>
                            <?php if ($icon['text_content']) : ?>
                                <div class="content">
                                    <p><?php echo $icon['text_content'] ; ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
