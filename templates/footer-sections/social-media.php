<?php
/**
 * Template: Social section for footer
 * 
 * @package ravnostitcuprija
 */

$headline = $args['headline'] ?? false;
$social_media = get_field('social_media', 'options') ?? [];

?>

<section class="footer-section footer-section--social-media">
	<?php if ( $headline ) : ?>
		<h4><?php echo esc_html($headline); ?></h4>
	<?php endif; ?>
	<?php
	if ( $social_media ) {
		?>
		<div class="social-media-wrapper">
			<?php
			foreach ( $social_media as $social ) {
				if ($social['acf_fc_layout'] === 'instagram') {
					?>
					<a class="social-media-icon social-media-icon--instagram" target="_blank" href="<?php echo esc_url($social['url']); ?>" title="<?php echo esc_attr($social['alt_text']); ?>"><?php echo file_get_contents( get_template_directory_uri() . '/assets/images/icons/instagram.svg' ); ?></a>
					<?php
				}
				if ($social['acf_fc_layout'] === 'facebook') {
					?>
					<a class="social-media-icon social-media-icon--facebook" target="_blank" href="<?php echo esc_url($social['url']); ?>" title="<?php echo esc_attr($social['alt_text']); ?>"><?php echo file_get_contents( get_template_directory_uri() . '/assets/images/icons/facebook.svg' ); ?></a>
					<?php
				}
			}
			?>
		</div>
		<?php
	}
	?>
</section>

