<?php
$section  = '404';
$priority = 1;

Kiki::add_field( 'theme', array(
	'type'        => 'image',
	'settings'    => '404_background_image',
	'label'       => esc_html__( '404 Background Image', 'tm-9studio' ),
	'description' => esc_html__( 'Select a background image for 404 page.', 'tm-9studio' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => INSIGHT_THEME_URI . '/assets/images/404_bg.jpg',
	'output'      => array(
		array(
			'element'  => 'body.error404',
			'property' => 'background-image',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'        => 'image',
	'settings'    => '404_image',
	'label'       => esc_html__( '404 Image', 'tm-9studio' ),
	'description' => esc_html__( 'Select an image for 404 page.', 'tm-9studio' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => INSIGHT_THEME_URI . '/assets/images/404.png',
) );

Kiki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => '404_contact_url',
	'label'       => esc_html__( 'Contact URL', 'tm-9studio' ),
	'description' => esc_html__( 'Enter the URL for contact button in 404 page.', 'tm-9studio' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => esc_html__( '/contact-us', 'tm-9studio' ),
) );