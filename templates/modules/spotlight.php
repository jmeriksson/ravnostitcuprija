<?php
/**
 * Module: Spotlight
 * 
 * @package ravnostitcuprija
 */

$headline = $args['headline'] ?? false;
$content = $args['content'] ?? false;
$posts = $args['select_posts'] ?? [];
$footer = $args['footer'] ?? false;

?>

<section class="module-section module-section--spotlight-module">
    <div class="entry-content">
        <div class="container">
            <?php if ($headline) : ?>
                <h2><?php echo esc_html($headline); ?></h2>
            <?php endif; ?>
            <?php if ($content) : ?>
                <p><?php echo esc_html($content); ?></p>
            <?php endif; ?>
            <?php if (count($posts) > 0) : ?>
                <div class="posts-grid swiper swiper-1223">
                    <div class="swiper-wrapper">
                        <?php
                        foreach ($posts as $id) {
                            //$post = get_post($post_id);
                            $post_type = get_post_type($id);
                            if ($post_type === "dog") {
                                get_template_part(
                                    '/templates/partials/card-dog',
                                    '',
                                    [
                                        'post_id' => $id,
                                        'additional_class' => 'swiper-slide'
                                    ]
                                );
                            } else {
                                get_template_part(
                                    '/templates/partials/card-post',
                                    '',
                                    [
                                        'post_id' => $id,
                                        'additional_class' => 'swiper-slide'
                                    ]
                                );
                            }
                        }
                        ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            <?php endif; ?>
            <?php
            if ($footer) {
                echo wp_kses_post($footer);
            }
            ?>
        </div>
    </div>
</section>