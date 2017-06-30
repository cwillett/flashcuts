<?php
$section  = 'copyright';
$priority = 1;

/*--------------------------------------------------------------
# Copyright layout
--------------------------------------------------------------*/
Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'copyright_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Layout', 'tm-9studio' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'copyright_visibility',
	'label'       => esc_html__( 'Visibility', 'tm-9studio' ),
	'description' => esc_html__( 'Enable to show the copyright section.', 'tm-9studio' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 1,
) );

Kiki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => 'copyright_style',
	'label'    => esc_html__( 'Style', 'tm-9studio' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'style02',
	'choices'  => array(
		'style01' => 'Style 01 (Light)',
		'style02' => 'Style 02 (Dark)',
	)
) );

Kiki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => 'copyright_type',
	'label'    => esc_html__( 'Type', 'tm-9studio' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '01',
	'choices'  => array(
		'01' => 'Type 01',
		'02' => 'Type 02',
	)
) );

/*--------------------------------------------------------------
# Copyright spacing
--------------------------------------------------------------*/
Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'copyright_general_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Spacing', 'tm-9studio' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'copyright_padding_top',
	'label'     => esc_html__( 'Padding top', 'tm-9studio' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 40,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.copyright .copyright-container',
			'property' => 'padding-top',

			'units' => 'px',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'copyright_padding_bottom',
	'label'     => esc_html__( 'Padding bottom', 'tm-9studio' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 40,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.copyright .copyright-container',
			'property' => 'padding-bottom',

			'units' => 'px',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'copyright_margin_top',
	'label'     => esc_html__( 'Margin top', 'tm-9studio' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => - 200,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.copyright',
			'property' => 'margin-top',

			'units' => 'px',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'copyright_margin_bottom',
	'label'     => esc_html__( 'Margin bottom', 'tm-9studio' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => - 200,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.copyright',
			'property' => 'margin-bottom',
			'units'    => 'px',
		),
	),
) );

/*--------------------------------------------------------------
# Text typography
--------------------------------------------------------------*/
Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'copyright_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Typography', 'tm-9studio' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'copyright_font_size',
	'label'     => esc_html__( 'Font size', 'tm-9studio' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 14,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.copyright-left',
			'property' => 'font-size',

			'units' => 'px',
		),
	),
) );

/*--------------------------------------------------------------
# Text
--------------------------------------------------------------*/
Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'copyright_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Content', 'tm-9studio' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'        => 'textarea',
	'settings'    => 'copyright_text',
	'label'       => esc_html__( 'Text', 'tm-9studio' ),
	'description' => esc_html__( 'Enter the text that displays in the copyright section. HTML markup can be used.', 'tm-9studio' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => ( 'Copyright &copy; 2017 NineStudio <span>- All Rights Reserved.</span>' ),
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => '.copyright-left',
			'function' => 'html',
		),
	),
) );


Kiki::add_field( 'theme', array(
	'type'        => 'textarea',
	'settings'    => 'copyright_text2',
	'label'       => esc_html__( 'Text 2', 'tm-9studio' ),
	'description' => esc_html__( 'Enter the text that displays in the copyright section. HTML markup can be used.', 'tm-9studio' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => ( 'contact@ninestudio.com <span>(00) 123 00832 990<span>' ),
	'transport'   => 'postMessage',
	'js_vars'     => array(
		array(
			'element'  => '.copyright-right',
			'function' => 'html',
		),
	),
) );
