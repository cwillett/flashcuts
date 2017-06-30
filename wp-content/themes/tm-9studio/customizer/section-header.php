<?php
$section  = 'header';
$priority = 1;

/*--------------------------------------------------------------
# General
--------------------------------------------------------------*/
Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'header_general_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'General', 'tm-9studio' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => 'header_type',
	'label'    => esc_html__( 'Header Type', 'tm-9studio' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'header-01',
	'choices'  => array(
		'header-01' => esc_html__( 'Header 01', 'tm-9studio' ),
		'header-02' => esc_html__( 'Header 02', 'tm-9studio' ),
		'header-03' => esc_html__( 'Header 03', 'tm-9studio' ),
	)
) );

/*--------------------------------------------------------------
# Header layout
--------------------------------------------------------------*/
Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'header_main_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Layout', 'tm-9studio' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'     => 'toggle',
	'settings' => 'header_visibility',
	'label'    => esc_html__( 'Visibility', 'tm-9studio' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 1,
) );

Kiki::add_field( 'theme', array(
	'type'     => 'toggle',
	'settings' => 'header_sticky_enable',
	'label'    => esc_html__( 'Sticky', 'tm-9studio' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 1,
) );

Kiki::add_field( 'theme', array(
	'type'     => 'toggle',
	'settings' => 'header_search_enable',
	'label'    => esc_html__( 'Search', 'tm-9studio' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 0,
) );

Kiki::add_field( 'theme', array(
	'type'     => 'toggle',
	'settings' => 'header_right_panel_enable',
	'label'    => esc_html__( 'Right slide panel', 'tm-9studio' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 1,
) );

/*--------------------------------------------------------------
# Header spacing
--------------------------------------------------------------*/
Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'header_general_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Spacing', 'tm-9studio' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'header_padding_top',
	'label'     => esc_html__( 'Padding top', 'tm-9studio' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.header > .wrapper',
			'property' => 'padding-top',
			'units'    => 'px',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'header_padding_bottom',
	'label'     => esc_html__( 'Padding bottom', 'tm-9studio' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.header > .wrapper',
			'property' => 'padding-bottom',
			'units'    => 'px',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'header_margin_top',
	'label'     => esc_html__( 'Margin top', 'tm-9studio' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.header',
			'property' => 'margin-top',
			'units'    => 'px',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'header_margin_bottom',
	'label'     => esc_html__( 'Margin bottom', 'tm-9studio' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.header',
			'property' => 'margin-bottom',
			'units'    => 'px',
		),
	),
) );

/*--------------------------------------------------------------
# Header color
--------------------------------------------------------------*/
Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'header_main_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Color', 'tm-9studio' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'      => 'color-alpha',
	'settings'  => 'header_bg_color',
	'label'     => esc_html__( 'Background color', 'tm-9studio' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => 'rgba(255, 255, 255, 0)',
	'output'    => array(
		array(
			'element'  => '.header',
			'property' => 'background-color',
		),
	),
) );
