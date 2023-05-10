<?php
/**
* Single FAQ
*
* @package Ravnostitcuprija
*/

get_header();

$faq_image = get_field('faq_image', 'options') ?? false;
?>

<main class="main">
	<?php if ($faq_image) : ?>
        <div class="container container--narrow">
            <div class="single-faq__hero">
                <figure>
                    <?php echo wp_get_attachment_image( $faq_image, '720_16_9' ); ?>
                </figure>
            </div>
        </div>
	<?php endif; ?>
    <section class="section">
        <div class="single-faq__content entry-content">
            <div class="container container--narrow">
                <h1><?php echo the_title(); ?></h1>
                <?php the_content(); ?>
            </div>
        </div>
    </section>
</main>
<?php

get_footer();
