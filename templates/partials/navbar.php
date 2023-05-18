<?php
/**
 * Main navbar
 *
 * @package Ravnostitcuprija
 */

?>

<nav class="navigation navigation--fixed">
	<div class="container">
		<div class="navigation__content">
            <div class="navigation__brand">
                <a href="<?php echo esc_url( get_home_url() ); ?>">
                    <?php echo file_get_contents( get_template_directory() . '/assets/images/logo.svg' ); ?>
                </a>
            </div>
			<div class="navigation__desktop-menu" role="menu">
				<?php
					$desktop_menu_args = [
						'menu'             => 'primary',
						'echo'             => true,
						'add_li_class'     => 'nav-item',
						'add_anchor_class' => 'nav-link',
					];
					wp_nav_menu( $desktop_menu_args );
				?>
			</div>
            <div class="navigation__search">
                <button class="search-bar-toggle" id="js-search-bar-toggle" aria-label="<?php esc_attr__('Search', 'ravnostitcuprija') ?>">
                    <?php echo file_get_contents( get_template_directory() . '/assets/images/icons/search.svg' ); ?>
                </button>
                <div class="search-bar">
                    <?php get_search_form(); ?>
                </div>
            </div>
			<button class="navigation__mobile-menu-toggle" id="js-navigation__mobile-menu-toggle" type="button" aria-label="<?php esc_attr__('Mobile menu', 'ravnostitcuprija') ?>">
				<span class="navigation-mobile-toggle"></span>
				<span class="navigation-mobile-toggle"></span>
				<span class="navigation-mobile-toggle"></span>
			</button>
		</div>
	</div>
</nav>
