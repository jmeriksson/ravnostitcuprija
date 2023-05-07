<?php
/**
 * Main navbar
 *
 * @package ravnostitcuprija
 */

?>

<div class="mobile-menu">
	<div class="mobile-menu__overlay"></div>
	
	<div class="mobile-menu__off-canvas" id="js-mobile-menu">
		<?php
			$mobile_menu_args = [
				'menu'             => 'primary',
				'echo'             => true,
				'add_li_class'     => 'nav-item',
				'add_anchor_class' => 'nav-link',
			];
			wp_nav_menu( $mobile_menu_args );
		?>
	</div>
</div>
