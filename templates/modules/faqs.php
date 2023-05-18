<?php
/**
 * Module: FAQs
 * 
 * @package Ravnostitcuprija
 */

$faq_ids = $args['select_posts'];
$headline = $args['headline'] ?? false;
$text_content = $args['text_content'] ?? false;
$link= $args['link'] ?? false;

if ( ! $faq_ids ) {
    return;
}

?>

<section class="module-section module-section--faqs-module">
    <div class="container container--narrow">
        <div class="faqs">
            <?php if ($headline) : ?>
                <h2><?php echo esc_html($headline); ?></h2>
            <?php endif; ?>
            <?php foreach ($faq_ids as $faq_id) : ?>
                <?php
                global $post;
                $post = get_post( $faq_id );
                setup_postdata($post)
                ?>
                <details>
                    <summary><?php the_title(); ?></summary>
                    <span><?php the_content(); ?></span>
                </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
wp_reset_postdata();
