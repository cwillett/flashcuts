<?php

class WPBakeryShortCode_Insight_Button extends WPBakeryShortCode {
}

$base_name = 'insight_button';

vc_map( array(
	'name'                      => esc_html__( 'Button', 'tm-9studio' ),
	'base'                      => $base_name,
	'category'                  => sprintf( esc_html__( 'by %s', 'tm-9studio' ), INSIGHT_THEME_NAME ),
	'icon'                      => 'tm-shortcode-ico default-icon',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Style', 'tm-9studio' ),
			'param_name'  => 'style',
			'std'         => 'style01',
			'value'       => array(
				'Style 01 (Normal button)'     => 'style01',
				'Style 02 (Button with icon)'  => 'style02',
				'Style 03 (Button with image)' => 'style03',
				'Style 04 (Outline button)'    => 'style04',
			),
			'admin_label' => true,
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Icon library', 'tm-9studio' ),
			'std'         => 'ionicons',
			'value'       => array(
				esc_html__( 'Font Awesome', 'tm-9studio' ) => 'fontawesome',
				esc_html__( 'Open Iconic', 'tm-9studio' )  => 'openiconic',
				esc_html__( 'Typicons', 'tm-9studio' )     => 'typicons',
				esc_html__( 'Entypo', 'tm-9studio' )       => 'entypo',
				esc_html__( 'Linecons', 'tm-9studio' )     => 'linecons',
				esc_html__( 'Ionicons', 'tm-9studio' )     => 'ionicons',
				esc_html__( '9studio', 'tm-9studio' )      => '9studio',

			),
			'param_name'  => 'icon_lib',
			'description' => esc_html__( 'Select icon library.', 'tm-9studio' ),
			'dependency'  => array( 'element' => 'style', 'value' => array( 'style02' ) ),
		),
		Insight_Helper::fonticon( 'fontawesome' ),
		Insight_Helper::fonticon( 'openiconic' ),
		Insight_Helper::fonticon( 'typicons' ),
		Insight_Helper::fonticon( 'entypo' ),
		Insight_Helper::fonticon( 'linecons' ),
		Insight_Helper::fonticon( 'ionicons' ),
		Insight_Helper::fonticon( '9studio' ),
		array(
			'type'        => 'attach_image',
			'heading'     => esc_html__( 'Image', 'tm-9studio' ),
			'param_name'  => 'image',
			'admin_label' => true,
			'dependency'  => array( 'element' => 'style', 'value' => array( 'style03' ) ),
		),
		array(
			'type'        => 'vc_link',
			'heading'     => esc_html__( 'Link', 'tm-9studio' ),
			'param_name'  => 'link',
			'admin_label' => true,
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Align', 'tm-9studio' ),
			'param_name'  => 'align',
			'value'       => array(
				'None'   => 'none',
				'Left'   => 'left',
				'Center' => 'center',
				'Right'  => 'right',
			),
			'admin_label' => true,
		),
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'css' ),
		Insight_Helper::get_param( 'note' ),
	)
) );
