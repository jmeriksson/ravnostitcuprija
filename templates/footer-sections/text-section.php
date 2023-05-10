<?php
/**
 * Template: Navigation section for footer
 * 
 * @package Ravnostitcuprija
 */

$headline = $args['headline'] ?? false;
$text_content = $args['text_content'] ?? false;

?>

<section class="footer-section footer-section--text-section">
	<?php if ( $headline ) : ?>
		<h4><?php echo esc_html($headline); ?></h4>
	<?php endif; ?>
	<?php if ( $text_content ) : ?>
		<p><?php echo wp_kses($text_content, 'br'); ?></p>
	<?php endif; ?>
</section>
