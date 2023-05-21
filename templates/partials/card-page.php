<?php
/**
 * Card for displaying a page
 *
 * @package Ravnostitcuprija
 */


$page_id = get_post($args['page_id']);
$permalink = get_permalink($page_id);
$thumbnail = get_post_thumbnail_id($page_id);
$title = get_the_title($page_id);
$additional_class = isset($args['additional_class']) && ! empty($args['additional_class']) ? $args['additional_class'] : '';
$wrapper_classes = ["post-card", $additional_class];
$modules = get_field('modules', $page_id) ?? [];
$excerpt = false;

foreach ($modules as $module) {
    if ($module['acf_fc_layout'] === 'excerpt') {
        $excerpt = $module['content'];
    }
}

?>

<div class="<?php echo implode(' ', $wrapper_classes); ?>">
    <a href="<?php echo esc_url($permalink); ?>">
        <?php if ($thumbnail) : ?>
            <figure>
                <?php echo wp_get_attachment_image($thumbnail, 'xs_4_3'); ?>
            </figure>
        <?php else : ?>
            <div class="thumbnail-placeholder"></div>
        <?php endif; ?>
        <div class="post-card__bottom">
            <h2><?php echo esc_html($title); ?></h2>
            <div class="post-card__meta">
                <?php if ($excerpt) : ?>
                    <p><?php echo esc_html(trim(substr($excerpt, 0, 100))); ?><span class="excerpt-fade">...</span></p>
                <?php endif; ?>
            </div>
        </div>
    </a>
</div>
