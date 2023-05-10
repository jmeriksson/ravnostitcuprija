<?php
/**
 * Module: Featured post
 * 
 * @package Ravnostitcuprija
 */

$featured_post_id = $args['select_post'];
$custom_image_id = $args['image'] ?? false;
$custom_headline = $args['headline'] ?? false;
$custom_excerpt = $args['excerpt'] ?? false;
$read_more_button_text = $args['button_text'] ?? false;

if ( ! $featured_post_id ) {
    return;
}

global $post;
$post = get_post( $featured_post_id, OBJECT );
setup_postdata($post)

?>

<section class="module-section module-section--featured-post-module">
    <div class="container">
        <div class="featured-post">
            <figure class="featured-post__image">
                <?php
                if ($custom_image_id) {
                    echo wp_get_attachment_image($custom_image_id, '548_4_3');
                } else {
                    the_post_thumbnail('548_4_3');
                }
                ?>
            </figure>
            <div class="featured-post__content">
                <?php if ($custom_headline) : ?>
                    <h2><?php echo esc_html($custom_headline); ?></h2>
                <?php else : ?>
                    <h2><?php echo esc_html(the_title()); ?></h2>
                <?php endif; ?>
                <?php if ($custom_excerpt) : ?>
                    <p><?php echo esc_html($custom_excerpt); ?></p>
                <?php else : ?>
                    <?php echo esc_html(the_excerpt()); ?>
                <?php endif; ?>
                <?php if ($read_more_button_text) : ?>
                    <a class="btn btn--primary" href="<?php echo esc_url(the_permalink()); ?>"><?php echo esc_html($read_more_button_text); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
wp_reset_postdata();
