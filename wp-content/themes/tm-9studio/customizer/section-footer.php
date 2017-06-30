<?php
$section  = 'footer';
$priority = 1;

/*--------------------------------------------------------------
# Footer layout
--------------------------------------------------------------*/
Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'footer_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Layout', 'tm-9studio' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'footer_visibility',
	'label'       => esc_html__( 'Visibility', 'tm-9studio' ),
	'description' => esc_html__( 'Show/hide the footer.', 'tm-9studio' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 1,
) );

Kiki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => 'footer_style',
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
	'type'        => 'image',
	'settings'    => 'footer_logo',
	'label'       => esc_html__( 'Footer logo', 'tm-9studio' ),
	'description' => esc_html__( 'Select an image file for your footer logo.', 'tm-9studio' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => INSIGHT_THEME_URI . '/assets/images/logo_footer_02.png',
) );

Kiki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'footer_social_enable',
	'label'       => esc_html__( 'Social links', 'tm-9studio' ),
	'description' => esc_html__( 'Enable to show the social links in footer.', 'tm-9studio' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 1
) );

Kiki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'footer_gmap_enable',
	'label'       => esc_html__( 'Google map', 'tm-9studio' ),
	'description' => esc_html__( 'Enable to show the Google map in footer.', 'tm-9studio' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 1
) );

Kiki::add_field( 'theme', array(
	'type'     => 'code',
	'settings' => 'footer_gmap_iframe',
	'label'    => esc_html__( 'Google map iframe code', 'tm-9studio' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '',
	'choices'  => array(
		'language' => 'html',
		'theme'    => 'monokai',
	),
) );

/*--------------------------------------------------------------
# Footer spacing
--------------------------------------------------------------*/
Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'footer_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Spacing', 'tm-9studio' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'footer_padding_top',
	'label'     => esc_html__( 'Padding top', 'tm-9studio' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 80,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.footer',
			'property' => 'padding-top',
			'units'    => 'px',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'footer_padding_bottom',
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
			'element'  => '.footer',
			'property' => 'padding-bottom',
			'units'    => 'px',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'footer_margin_top',
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
			'element'  => '.footer',
			'property' => 'margin-top',
			'units'    => 'px',
		),
	),
) );

Kiki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'footer_margin_bottom',
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
			'element'  => '.footer',
			'property' => 'margin-bottom',
			'units'    => 'px',
		),
	),
) );

/*--------------------------------------------------------------
# Footer typography
--------------------------------------------------------------*/
Kiki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => 'footer_group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Typography', 'tm-9studio' ) . '</div>',
) );

Kiki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'footer_font_size',
	'label'     => esc_html__( 'Font size', 'tm-9studio' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 15,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.footer',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );
