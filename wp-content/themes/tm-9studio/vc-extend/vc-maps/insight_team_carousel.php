<?php

class WPBakeryShortCode_Insight_Team_Carousel extends WPBakeryShortCode {
}

$base_name = 'insight_team_carousel';

vc_map( array(
	'name'                      => esc_html__( 'Team Carousel', 'tm-9studio' ),
	'base'                      => $base_name,
	'category'                  => sprintf( esc_html__( 'by %s', 'tm-9studio' ), INSIGHT_THEME_NAME ),
	'icon'                      => 'tm-shortcode-ico default-icon',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'type'        => 'ajax-search',
			'heading'     => esc_html__( 'Team members', 'tm-9studio' ),
			'param_name'  => 'members',
			'ajax_get'    => 'ic_our_team',
			'ajax_limit'  => 24,
			'admin_label' => true,
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Style', 'tm-9studio' ),
			'param_name'  => 'style',
			'std'         => 'style01',
			'value'       => array(
				esc_html__( 'Style 01', 'tm-9studio' ) => 'style01',
				esc_html__( 'Style 02', 'tm-9studio' ) => 'style02',
			),
			'admin_label' => true,
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Image size', 'tm-9studio' ),
			'param_name'  => 'image_size',
			'std'         => '01',
			'value'       => array(
				esc_html__( 'Size 01', 'tm-9studio' ) => '01',
				esc_html__( 'Size 02', 'tm-9studio' ) => '02',
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
			'heading'    => esc_html__( 'Enable autoplay', 'tm-9studio' ),
			'param_name' => 'enable_autoplay',
			'value'      => array(
				esc_html__( 'Yes', 'tm-9studio' ) => 'true',
				esc_html__( 'No', 'tm-9studio' )  => 'false'
			),
		),
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'css' ),
		Insight_Helper::get_param( 'note' ),
	)
) );
