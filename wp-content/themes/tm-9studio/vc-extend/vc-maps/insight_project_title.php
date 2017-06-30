<?php

class WPBakeryShortCode_Insight_Project_Title extends WPBakeryShortCode {
}

vc_map( array(
	'name'                      => esc_html__( 'Project Title', 'tm-9studio' ),
	'description'               => esc_html__( 'Project title section only for single project', 'tm-9studio' ),
	'base'                      => 'insight_project_title',
	'category'                  => sprintf( esc_html__( 'by %s', 'tm-9studio' ), INSIGHT_THEME_NAME ),
	'icon'                      => 'tm-shortcode-ico default-icon',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Style', 'tm-9studio' ),
			'param_name'  => 'style',
			'value'       => array(
				'Style 01 (Align left)'   => 'style01',
				'Style 02 (Align center)' => 'style02',
			),
			'admin_label' => true,
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Title', 'tm-9studio' ),
			'param_name'  => 'title',
			'value'       => array(
				'Current project title' => 'default',
				'Custom title'          => 'custom',
			),
			'admin_label' => true,
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Custom title', 'tm-9studio' ),
			'param_name' => 'custom_title',
			'dependency' => array( 'element' => 'title', 'value' => array( 'custom' ) ),
		),
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'note' ),
	)
) );
