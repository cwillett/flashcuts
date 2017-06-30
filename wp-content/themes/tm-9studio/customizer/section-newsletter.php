<?php
$section  = 'newsletter';
$priority = 1;

/*--------------------------------------------------------------
# Newsletter
--------------------------------------------------------------*/
Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'newsletter_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'General', 'tm-9studio' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'newsletter_visibility',
	'label'       => esc_html__( 'Visibility', 'tm-9studio' ),
	'description' => esc_html__( 'Show/hide the newsletter section.', 'tm-9studio' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 0,
) );

Kiki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => 'newsletter_style',
	'label'    => esc_html__( 'Style', 'tm-9studio' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'style01',
	'choices'  => array(
		'style01' => 'Style 01',
		'style02' => 'Style 02',
	)
) );

Kiki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'newsletter_text',
	'label'       => esc_html__( 'Text', 'tm-9studio' ),
	'description' => esc_html__( 'Enter the text that displays in the newsletter section.', 'tm-9studio' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => esc_html__( 'Subscribe to our Newsletter', 'tm-9studio' ),
) );

Kiki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'newsletter_shortcode',
	'label'       => esc_html__( 'Shortcode', 'tm-9studio' ),
	'description' => esc_html__( 'Enter the shortcode that displays in the newsletter section.', 'tm-9studio' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => esc_html__( '[mc4wp_form id=130]', 'tm-9studio' ),
) );

Kiki::add_field( 'theme', array(
	'type'        => 'image',
	'settings'    => 'newsletter_background_image',
	'label'       => esc_html__( 'Background Image', 'tm-9studio' ),
	'description' => esc_html__( 'Select an image file for newsletter background.', 'tm-9studio' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => INSIGHT_THEME_URI . '/assets/images/newsletter_bg_01.jpg',
) );
