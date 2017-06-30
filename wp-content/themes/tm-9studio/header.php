<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package tm-9studio
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>  <?php Insight::body_attributes(); ?>>

<div id="page" class="site">

	<?php Insight::slider() ?>
	<?php get_template_part( 'components/' . Insight::setting( 'header_type' ) ); ?>
	<?php get_template_part( 'components/header-mobile' ); ?>
	<?php get_template_part( 'components/open-left' ); ?>
	<?php
	if ( Insight_Helper::get_post_meta( 'header_special' ) == 'minimal' ) {
		get_template_part( 'components/open-right' );
	}
	?>

	<div id="content" class="content">
