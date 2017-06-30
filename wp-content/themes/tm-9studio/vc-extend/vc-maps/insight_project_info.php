<?php

class WPBakeryShortCode_Insight_Project_Info extends WPBakeryShortCode {
}

vc_map( array(
	'name'                      => esc_html__( 'Project Info', 'tm-9studio' ),
	'description'               => esc_html__( 'Project info section only for single project', 'tm-9studio' ),
	'base'                      => 'insight_project_info',
	'category'                  => sprintf( esc_html__( 'by %s', 'tm-9studio' ), INSIGHT_THEME_NAME ),
	'icon'                      => 'tm-shortcode-ico default-icon',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Style', 'tm-9studio' ),
			'param_name'  => 'style',
			'value'       => array(
				'Style 01 (Vertical)'   => 'style01',
				'Style 02 (Horizontal)' => 'style02',
			),
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
			'dependency'  => array( 'element' => 'style', 'value' => array( 'style02' ) ),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Show bullets', 'tm-9studio' ),
			'param_name' => 'display_bullets',
			'value'      => array(
				esc_html__( 'Yes', 'tm-9studio' ) => 'true',
				esc_html__( 'No', 'tm-9studio' )  => 'false'
			),
			'dependency' => array( 'element' => 'style', 'value' => array( 'style02' ) ),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Show arrows', 'tm-9studio' ),
			'param_name' => 'display_arrows',
			'value'      => array(
				esc_html__( 'Yes', 'tm-9studio' ) => 'true',
				esc_html__( 'No', 'tm-9studio' )  => 'false'
			),
			'dependency' => array( 'element' => 'style', 'value' => array( 'style02' ) ),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Enable autoplay', 'tm-9studio' ),
			'param_name' => 'enable_autoplay',
			'value'      => array(
				esc_html__( 'Yes', 'tm-9studio' ) => 'true',
				esc_html__( 'No', 'tm-9studio' )  => 'false'
			),
			'dependency' => array( 'element' => 'style', 'value' => array( 'style02' ) ),
		),
		array(
			'type'       => 'param_group',
			'heading'    => esc_html__( 'Info', 'tm-9studio' ),
			'param_name' => 'info',
			'params'     => array(
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Title', 'tm-9studio' ),
					'param_name'  => 'title',
					'admin_label' => true,
				),
				array(
					'type'        => 'textarea',
					'heading'     => esc_html__( 'Content', 'tm-9studio' ),
					'param_name'  => 'content',
					'admin_label' => true,
				),
			),
		),
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'note' ),
	)
) );
