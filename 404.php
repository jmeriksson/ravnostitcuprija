<?php
/**
 * Page template for page: 404.
 *
 * @package Ravnostitcuprija
 */

get_header();

$page_title = get_field( '404_headline', 'options' ) ?? false;
$page_content = get_field( '404_page_content', 'options' ) ?? false;
$button = get_field( '404_button', 'options' ) ?? false;

?>

<main class="main">
	<div class="container">
		<div class="row justify-content-end mb-3 mb-sm-5">
			<div class="col-12 col-md-11 col-lg-9">
				<section class="section section-404">
					<?php if ( $page_title ) : ?>
						<h1><?php echo esc_html( $page_title ); ?></h1>
					<?php endif; ?>
					<?php if ( $page_content ) : ?>
						<?php echo wp_kses_post( $page_content ); ?>
					<?php endif; ?>
                    <?php if ( $button ) : ?>
                        <a class="btn btn--primary" target="<?php echo esc_attr($button['target']) ?>" href="<?php echo esc_url( $button['url'] ); ?>"><?php echo esc_html( $button['title'] ); ?></a>
                    <?php endif; ?>
				</section>
			</div>
		</div>
	</div>
</main>



<?php get_footer(); ?>
