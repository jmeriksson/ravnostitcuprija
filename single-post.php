<?php
/**
* Single post
*
* @package Ravnostitcuprija
*/

get_header();
global $post;
$author_id = $post->post_author;
$author = get_the_author_meta('display_name', $author_id);
?>

<main class="main">
    <?php if (get_post_thumbnail_id()) : ?>
        <div class="single-post__hero">
            <figure>
                <?php echo get_the_post_thumbnail(); ?>
            </figure>
        </div>
    <?php endif; ?>
    <section class="section">
        <div class="single-post__content entry-content">
            <div class="container container--narrow">
                <h1><?php echo the_title(); ?></h1>
                <?php if (isset($author) && !empty($author)) : ?>
                    <p><small><?php echo esc_html__('by', 'ravnostitcuprija') . ' ' . esc_html($author); ?></small></p>
                <?php endif; ?>
                <?php the_content(); ?>
            </div>
        </div>
    </section>
</main>
<?php

get_footer();
