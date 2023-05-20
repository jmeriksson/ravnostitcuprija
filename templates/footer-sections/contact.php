<?php
/**
 * Template: Contact section for footer
 * 
 * @package Ravnostitcuprija
 */

$headline = $args['headline'] ?? false;
$display_social_media = $args['display_social_media'] ?? false;
$display_email = $args['display_email'] ?? false;
$display_phone = $args['display_phone'] ?? false;
$social_media = get_field('social_media', 'options') ?? [];
$email = get_field('email', 'options') ?? [];
$phone = get_field('phone_number', 'options') ?? [];

?>

<section class="footer-section footer-section--contact">
	<?php if ( $headline ) : ?>
		<h4><?php echo esc_html($headline); ?></h4>
	<?php endif; ?>
	<?php
	if ( $display_social_media && $social_media ) {
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
    if ( $display_email && $email ) {
        ?>
        <div class="email-wrapper">
            <a href="mailto:<?php echo esc_attr($email); ?>" target="_blank"><?php echo esc_html($email); ?></a>
        </div>
        <?php
    }
    if ( $display_phone && $phone ) {
        ?>
        <div class="phone-wrapper">
            <a href="tel:<?php echo esc_attr($phone); ?>" target="_blank"><?php echo esc_html($phone); ?></a>
        </div>
        <?php
    }
	?>
</section>

