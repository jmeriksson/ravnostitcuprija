<?php
/**
 * Template: Text section for footer
 * 
 * @package ravnostitcuprija
 */

$headline = $args['headline'] ?? false;
$menu = $args['menu'] ?? false;

?>

<section class="footer-section footer-section--navigation">
	<?php if ( $headline ) : ?>
		<h4><?php echo esc_html($headline); ?></h4>
	<?php endif; ?>
	<?php
	if ( $menu ) {
		$menu_args = [
			'menu'             => $menu,
			'echo'             => true,
			'add_li_class'     => 'nav-item',
			'add_anchor_class' => 'nav-link',
		];
		wp_nav_menu( $menu_args );
	}
	?>
</section>