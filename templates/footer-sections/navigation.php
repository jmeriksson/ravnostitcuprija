<?php
/**
 * Template: Text section for footer
 * 
 * @package Ravnostitcuprija
 */

$headline = $args['headline'] ?? false;

?>

<section class="footer-section footer-section--navigation">
	<?php if ( $headline ) : ?>
		<h4><?php echo esc_html($headline); ?></h4>
	<?php endif; ?>
	<?php
    $menu_args = [
        'theme_location'   => 'footer_menu',
        'echo'             => true,
        'add_li_class'     => 'nav-item',
        'add_anchor_class' => 'nav-link',
    ];
    wp_nav_menu( $menu_args );
	?>
</section>