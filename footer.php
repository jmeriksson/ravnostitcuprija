<?php
/**
 * Footer template.
 *
 * @package ravnostitcuprija
 */

$footer_sections = get_field('footer_flexible_content', 'options') ?? [];
$no_of_sections = count( $footer_sections );

?>

<footer class="site-footer">
	<div class="container">
		<div class="footer-wrapper">
			<?php 
			if ($footer_sections) {
				foreach ($footer_sections as $footer_section) {
					$template_name = 'templates/footer-sections/' . str_replace( '_', '-', $footer_section['acf_fc_layout'] );
					get_template_part( $template_name, '', $footer_section );
				}
			}
			?>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
