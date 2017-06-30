<?php
$section  = 'socials';
$priority = 1;

/*--------------------------------------------------------------
# Social links
--------------------------------------------------------------*/
Kiki::add_field( 'theme', array(
	'type'        => 'repeater',
	'settings'    => 'social_link',
	'description' => wp_kses( esc_html__( 'You can find icon class <a target="_blank" href="http://fontawesome.io/cheatsheet/">here</a>.', 'tm-9studio' ), array(
		'a' => array(
			'target' => array(),
			'href'   => array(),
		)
	) ),
	'section'     => $section,
	'priority'    => $priority ++,
	'row_label'   => array(
		'type'  => 'field',
		'field' => 'tooltip',
	),
	'default'     => array(
		array(
			'tooltip'    => 'Facebook',
			'icon_class' => 'fa-facebook',
			'link_url'   => 'https://facebook.com',
		),
		array(
			'tooltip'    => 'Twitter',
			'icon_class' => 'fa-twitter',
			'link_url'   => 'https://twitter.com',
		),
		array(
			'tooltip'    => 'Pinterest',
			'icon_class' => 'fa-pinterest',
			'link_url'   => 'https://pinterest.com',
		),
		array(
			'tooltip'    => 'Instagram',
			'icon_class' => 'fa-instagram',
			'link_url'   => 'https://www.instagram.com',
		),
	),
	'fields'      => array(
		'tooltip'    => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Tooltip', 'tm-9studio' ),
			'description' => esc_html__( 'Enter your hint text for your icon', 'tm-9studio' ),
			'default'     => '',
		),
		'icon_class' => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Font Awesome Class', 'tm-9studio' ),
			'description' => esc_html__( 'This will be the icon class for your link', 'tm-9studio' ),
			'default'     => '',
		),
		'link_url'   => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Link URL', 'tm-9studio' ),
			'description' => esc_html__( 'This will be the link URL', 'tm-9studio' ),
			'default'     => '',
		),
	),
) );
