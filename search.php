<?php
/**
* Search results page
*
* @package ravnostitcuprija
*/

get_header();

?>

<main class="main">
	<div class="container">
        <section class="section">
            <h1>
            <?php
                printf(
                    esc_html__('You searched for %s', 'ravnostitcuprija'),
                    '<span class="search-query">' . get_search_query() . '</span>'
                );
            ?>
            </h1>
        </section>
        <section class="section">
        <?php
            if (have_posts()) {
                ?>
                <div class="search-result-list">
                    <?php
                    while(have_posts()) {
                        the_post();
                        $post_thumbnail_id = get_post_thumbnail_id();
                        ?>
                        <div class="search-result">
                            <a href="<?php echo esc_url(the_permalink()); ?>">
                            <?php if ($post_thumbnail_id) : ?>
                                <figure>
                                    <?php echo wp_get_attachment_image($post_thumbnail_id, '548_1_1'); ?>
                                </figure>
                            <?php else : ?>
                                <div class="thumbnail-placeholder"></div>
                            <?php endif; ?>
                            <p class="post-type"><?php echo ucfirst(get_post_type()); ?></p>
                            <h2><?php echo the_title(); ?></h2>
                            </a>
                        </div>
                        <?php
                    }
                ?>
                </div>
                <?php
            }
        ?>
        </section>
        <section class="section">
        <?php
            $pagination_args = [
                'prev_text' => __('Previous', 'ravnostitcuprija'),
                'next_text' => __('Next', 'ravnostitcuprija'),
            ];
            the_posts_pagination($pagination_args);
        ?>
        </section>
    </div>
</main>
<?php

get_footer();
