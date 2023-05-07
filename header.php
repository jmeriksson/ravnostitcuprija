<?php
/**
 * Theme header.
 *
 * @package ravnostitcuprija
 */

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php echo esc_html( get_bloginfo( 'name' ) ); ?></title>
	<meta name="description" content="<?php echo esc_attr( get_bloginfo( 'description' ) ); ?>">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php get_template_part( '/templates/partials/navbar' ); ?>
<?php get_template_part( '/templates/partials/mobile-menu' ); ?>