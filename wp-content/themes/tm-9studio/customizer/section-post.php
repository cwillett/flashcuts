<?php
$section  = 'post';
$priority = 1;

Kiki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'single_post_author',
	'label'       => esc_html__( 'Show author', 'tm-9studio' ),
	'description' => esc_html__( 'Enable to show the author information in single post.', 'tm-9studio' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 1,
) );

Kiki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'single_post_nav',
	'label'       => esc_html__( 'Show prev/next post', 'tm-9studio' ),
	'description' => esc_html__( 'Enable to show the prev/next post in single post.', 'tm-9studio' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 1,
) );