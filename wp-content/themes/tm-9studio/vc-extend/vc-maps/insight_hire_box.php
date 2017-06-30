<?php

class WPBakeryShortCode_Insight_Hire_Box extends WPBakeryShortCode {
}

$base_name = 'insight_hire_box';

vc_map( array(
	'name'                      => esc_html__( 'Hire Box', 'tm-9studio' ),
	'base'                      => $base_name,
	'category'                  => sprintf( esc_html__( 'by %s', 'tm-9studio' ), INSIGHT_THEME_NAME ),
	'icon'                      => 'tm-shortcode-ico default-icon',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Style', 'tm-9studio' ),
			'param_name'  => 'style',
			'value'       => array(
				'Style 01' => 'style01',
				'Style 02' => 'style02',
			),
			'admin_label' => true,
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Title', 'tm-9studio' ),
			'param_name'  => 'title',
			'admin_label' => true,
		),
		array(
			'type'       => 'textarea',
			'heading'    => esc_html__( 'Text', 'tm-9studio' ),
			'param_name' => 'text',
		),
		array(
			'type'        => 'vc_link',
			'heading'     => esc_html__( 'Link', 'tm-9studio' ),
			'param_name'  => 'link',
			'admin_label' => true,
		),
		array(
			'type'       => 'attach_image',
			'heading'    => esc_html__( 'Image', 'tm-9studio' ),
			'param_name' => 'image',
			'dependency' => array( 'element' => 'style', 'value' => array( 'style02' ) ),
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Text on image', 'tm-9studio' ),
			'param_name' => 'image_text',
			'std'        => '#teamleaders',
			'dependency' => array( 'element' => 'style', 'value' => array( 'style02' ) ),
		),
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'note' ),
	)
) );

