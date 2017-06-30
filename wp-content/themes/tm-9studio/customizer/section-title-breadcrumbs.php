<?php
$section  = 'title_breadcrumbs';
$priority = 1;

/*--------------------------------------------------------------
# Visibility
--------------------------------------------------------------*/
Kiki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'title_visibility',
	'label'       => esc_html__( 'Title visibility', 'tm-9studio' ),
	'description' => esc_html__( 'Show/hide the title by default. You also can show/hide the title for each page by settings in Page Options.', 'tm-9studio' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 1,
) );

Kiki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'breadcrumbs_visibility',
	'label'       => esc_html__( 'Breadcrumbs visibility', 'tm-9studio' ),
	'description' => esc_html__( 'Show/hide the breadcrumbs by default. You also can show/hide the breadcrumbs for each page by settings in Page Options.', 'tm-9studio' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 1,
) );

/*--------------------------------------------------------------
# Style
--------------------------------------------------------------*/
Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'page_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Style', 'tm-9studio' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'      => 'typography',
	'settings'  => 'page_title_typo',
	'label'     => esc_html__( 'Font family', 'tm-9studio' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => array(
		'font-family'    => Insight::FONT_THIRD,
		'variant'        => '400',
		'color'          => '#333333',
		'font-size'      => '56px',
		'line-height'    => '1',
		'letter-spacing' => '0',
	),
	'output'    => array(
		array(
			'element' => '.page-title .title, .page-title-style',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'page_title_padding_top',
	'label'     => esc_html__( 'Padding top', 'tm-9studio' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 145,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-title',
			'property' => 'padding-top',
			'units'    => 'px',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'page_title_padding_bottom',
	'label'     => esc_html__( 'Padding bottom', 'tm-9studio' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 125,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-title',
			'property' => 'padding-bottom',
			'units'    => 'px',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'page_title_bg_color',
	'label'       => esc_html__( 'Background', 'tm-9studio' ),
	'description' => esc_html__( 'Controls the color of title background.', 'tm-9studio' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '#f6f7f7',
	'output'      => array(
		array(
			'element'  => '.page-title',
			'property' => 'background-color',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'        => 'image',
	'settings'    => 'page_title_bg_img',
	'label'       => esc_html__( 'Background Image', 'tm-9studio' ),
	'description' => esc_html__( 'Select an image file for title background.', 'tm-9studio' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => INSIGHT_THEME_URI . '/assets/images/page_title_bg_01.jpg',
	'transport'   => 'postMessage',
	'output'      => array(
		array(
			'element'  => '.page-title',
			'property' => 'background-image'
		),
	),
) );
