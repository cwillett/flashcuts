<?php
/**
 * Theme Customizer
 *
 * @package tm-9studio
 */

/**
 * Setup configuration
 *
 * @since 0.9
 */
Kiki::add_config( 'theme', array(
	'option_type' => 'theme_mod',
	'capability'  => 'edit_theme_options',
) );

/**
 * Add sections
 *
 * @since 0.9.7
 */
$priority = 1;
Kiki::add_section( 'site', array(
	'title'       => esc_html__( 'Site', 'tm-9studio' ),
	'description' => esc_html__( 'Control the site layout, color and typography.', 'tm-9studio' ),
	'priority'    => $priority ++,
) );

Kiki::add_section( 'header', array(
	'title'       => esc_html__( 'Header', 'tm-9studio' ),
	'description' => esc_html__( 'Control the header style, layout, spacing and color.', 'tm-9studio' ),
	'priority'    => $priority ++,
) );

Kiki::add_section( 'navigation', array(
	'title'       => esc_html__( 'Navigation', 'tm-9studio' ),
	'description' => esc_html__( 'Control the navigation typography, spacing and color.', 'tm-9studio' ),
	'priority'    => $priority ++,
) );

Kiki::add_section( 'title_breadcrumbs', array(
	'title'    => esc_html__( 'Title & Breadcrumbs', 'tm-9studio' ),
	'priority' => $priority ++,
) );

Kiki::add_section( 'newsletter', array(
	'title'       => esc_html__( 'Newsletter', 'tm-9studio' ),
	'description' => esc_html__( 'Control the newsletter section.', 'tm-9studio' ),
	'priority'    => $priority ++,
) );

Kiki::add_section( 'footer', array(
	'title'       => esc_html__( 'Footer', 'tm-9studio' ),
	'description' => esc_html__( 'Control the footer preset, layout, spacing, typography and color.', 'tm-9studio' ),
	'priority'    => $priority ++,
) );

Kiki::add_section( 'copyright', array(
	'title'       => esc_html__( 'Copyright', 'tm-9studio' ),
	'description' => esc_html__( 'Control the copyright layout, spacing, typography, color and content.', 'tm-9studio' ),
	'priority'    => $priority ++,
) );

Kiki::add_section( 'post', array(
	'title'    => esc_html__( 'Post', 'tm-9studio' ),
	'priority' => $priority ++,
) );

Kiki::add_section( 'logo', array(
	'title'       => esc_html__( 'Logo', 'tm-9studio' ),
	'description' => esc_html__( 'Control the default logo, mobile logo and sticky logo.', 'tm-9studio' ),
	'priority'    => $priority ++,
) );

Kiki::add_section( 'socials', array(
	'title'       => esc_html__( 'Socials', 'tm-9studio' ),
	'description' => esc_html__( 'Control the social links for footer and other places.', 'tm-9studio' ),
	'priority'    => $priority ++,
) );

Kiki::add_section( '404', array(
	'title'    => esc_html__( '404 Page', 'tm-9studio' ),
	'priority' => $priority ++,
) );

Kiki::add_section( 'custom_code', array(
	'title'       => esc_html__( 'Custom Code', 'tm-9studio' ),
	'description' => esc_html__( 'Control the custom CSS and JS code.', 'tm-9studio' ),
	'priority'    => $priority ++,
) );

/**
 * Load modules
 *
 * @since 0.9
 */
require_once( get_template_directory() . '/customizer/section-title-breadcrumbs.php' );
require_once( get_template_directory() . '/customizer/section-copyright.php' );
require_once( get_template_directory() . '/customizer/section-custom.php' );
require_once( get_template_directory() . '/customizer/section-navigation.php' );
require_once( get_template_directory() . '/customizer/section-newsletter.php' );
require_once( get_template_directory() . '/customizer/section-footer.php' );
require_once( get_template_directory() . '/customizer/section-header.php' );
require_once( get_template_directory() . '/customizer/section-logo.php' );
require_once( get_template_directory() . '/customizer/section-post.php' );
require_once( get_template_directory() . '/customizer/section-site.php' );
require_once( get_template_directory() . '/customizer/section-socials.php' );
require_once( get_template_directory() . '/customizer/section-404.php' );
