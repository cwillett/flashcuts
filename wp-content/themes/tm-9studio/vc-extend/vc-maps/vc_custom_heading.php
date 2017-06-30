<?php
vc_add_params( 'vc_custom_heading', array(
	array(
		'type'       => 'dropdown',
		'heading'    => esc_html__( 'Select color', 'tm-9studio' ),
		'param_name' => 'cst_color',
		'value'      => array(
			esc_html__( 'Default', 'tm-9studio' )         => '',
			esc_html__( 'Primary color', 'tm-9studio' )   => 'pri-color',
			esc_html__( 'Secondary color', 'tm-9studio' ) => 'nd-color',
		),
	),
	array(
		'type'       => 'dropdown',
		'heading'    => esc_html__( 'Extending style', 'tm-9studio' ),
		'param_name' => 'extending_style',
		'value'      => array(
			esc_html__( 'None', 'tm-9studio' )            => '',
			esc_html__( 'Has bottom line', 'tm-9studio' ) => 'bottom-line',
		),
	),
	array(
		'type'       => 'dropdown',
		'heading'    => esc_html__( 'Text transform', 'tm-9studio' ),
		'param_name' => 'text_transform',
		'value'      => array(
			esc_html__( 'None', 'tm-9studio' )       => 'none',
			esc_html__( 'Capitalize', 'tm-9studio' ) => 'capitalize',
			esc_html__( 'Uppercase', 'tm-9studio' )  => 'uppercase',
			esc_html__( 'Lowercase', 'tm-9studio' )  => 'lowercase',
			esc_html__( 'Initial', 'tm-9studio' )    => 'initial',
			esc_html__( 'Inherit', 'tm-9studio' )    => 'inherit',
		),
	),
	array(
		'type'       => 'dropdown',
		'heading'    => esc_html__( 'Font weight', 'tm-9studio' ),
		'param_name' => 'font_weight',
		'value'      => array(
			esc_html__( 'Default', 'tm-9studio' ) => '',
			100                                   => 100,
			200                                   => 200,
			300                                   => 300,
			400                                   => 400,
			500                                   => 500,
			600                                   => 600,
			700                                   => 700,
			800                                   => 800,
			900                                   => 900,
		),
	),
	array(
		'type'       => 'textfield',
		'heading'    => esc_html__( 'Letter spacing', 'tm-9studio' ),
		'param_name' => 'letter_spacing',
	),
) );

vc_map_update( 'vc_custom_heading', array(
	'category' => sprintf( esc_html__( 'by %s', 'tm-9studio' ), INSIGHT_THEME_NAME ),
	'name'     => esc_html__( 'Custom Heading', 'tm-9studio' ),
	'icon'     => 'tm-shortcode-ico default-icon',
) );
