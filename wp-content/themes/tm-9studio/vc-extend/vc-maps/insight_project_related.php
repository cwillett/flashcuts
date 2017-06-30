<?php

class WPBakeryShortCode_Insight_Project_Related extends WPBakeryShortCode {
}

vc_map( array(
	'name'        => esc_html__( 'Project Related', 'tm-9studio' ),
	'description' => esc_html__( 'Related projects section only for single project', 'tm-9studio' ),
	'base'        => 'insight_project_related',
	'category'    => sprintf( esc_html__( 'by %s', 'tm-9studio' ), INSIGHT_THEME_NAME ),
	'icon'        => 'tm-shortcode-ico default-icon',
	'params'      => array(
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Title', 'tm-9studio' ),
			'param_name'  => 'title',
			'value'       => esc_html__( 'Related Projects', 'tm-9studio' ),
			'admin_label' => true,
		),
		array(
			'type'        => 'number',
			'heading'     => esc_html__( 'Number', 'tm-9studio' ),
			'param_name'  => 'number',
			'min'         => 1,
			'value'       => 8,
			'max'         => 24,
			'admin_label' => true,
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Slides to display', 'tm-9studio' ),
			'param_name'  => 'slides_to_display',
			'std'         => '4',
			'value'       => array(
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
			),
			'admin_label' => true,
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Show bullets', 'tm-9studio' ),
			'param_name' => 'display_bullets',
			'value'      => array(
				esc_html__( 'Yes', 'tm-9studio' ) => 'true',
				esc_html__( 'No', 'tm-9studio' )  => 'false'
			),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Show arrows', 'tm-9studio' ),
			'param_name' => 'display_arrows',
			'value'      => array(
				esc_html__( 'Yes', 'tm-9studio' ) => 'true',
				esc_html__( 'No', 'tm-9studio' )  => 'false'
			),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Enable autoplay', 'tm-9studio' ),
			'param_name' => 'enable_autoplay',
			'value'      => array(
				esc_html__( 'Yes', 'tm-9studio' ) => 'true',
				esc_html__( 'No', 'tm-9studio' )  => 'false'
			),
		),
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'note' ),
	),
) );
