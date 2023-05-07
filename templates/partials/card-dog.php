<?php
/**
 * Card for displaying the dog post type
 *
 * @package ravnostitcuprija
 */


$dog_id = get_post($args['post_id']);
$sex = get_the_terms($dog_id, 'sex');
$weight = get_the_terms($dog_id, 'weight');
$date_of_birth = get_field('date_of_birth', $dog_id);
$age = ravnostit_calculate_dog_age($date_of_birth, 'Y');
$permalink = get_permalink($dog_id);
$thumbnail = get_post_thumbnail_id($dog_id);
$title = get_the_title($dog_id);
$additional_class = isset($args['additional_class']) && ! empty($args['additional_class']) ? $args['additional_class'] : '';
$wrapper_classes = ["dog-card", $additional_class];
$reserved = get_field('reserved', $dog_id) ?? false;

?>

<div class="<?php echo implode(' ', $wrapper_classes); ?>">
    <a href="<?php echo esc_url($permalink); ?>">
        <?php if ($thumbnail) : ?>
            <figure>
                <?php echo wp_get_attachment_image($thumbnail, 'xs_4_3'); ?>
                <?php if ($reserved) : ?>
                    <div class="reserved-image-banner"><?php esc_html_e('Reserved', 'ravnostitcuprija'); ?></div>
                <?php endif; ?>
            </figure>
        <?php else : ?>
            <div class="thumbnail-placeholder"></div>
        <?php endif; ?>
        <div class="dog-card__bottom">
            <h2><?php echo esc_html($title); ?></h2>
            <div class="dog-card__meta">
                <p>
                    <?php if ($sex && ! $sex instanceof WP_Error) : ?>
                        <span><?php echo esc_html($sex[0]->name); ?></span>
                    <?php endif; ?>
                    <?php if ($age) : ?>
                        <span><?php echo esc_html($age); ?></span>
                    <?php endif; ?>
                    <?php if ($weight && ! $weight instanceof WP_Error) : ?>
                        <span>
                            <?php
                            printf(
                                esc_html__('Weight: %s', 'ravnostitcuprija'),
                                $weight[0]->name,
                            );
                            ?>
                        </span>
                    <?php endif; ?>
                </p>
            </div>
        </div>
    </a>
</div>
