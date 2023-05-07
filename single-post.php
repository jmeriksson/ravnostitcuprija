<?php
/**
* Single post
*
* @package ravnostitcuprija
*/

get_header();
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
                <p><span><?php echo get_the_date(); ?></span></p>
                <?php the_content(); ?>
            </div>
        </div>
    </section>
</main>
<?php

get_footer();
