<?php

class WPBakeryShortCode_Insight_Video extends WPBakeryShortCode {
}

vc_map( array(
	'name'     => esc_html__( 'Video', 'tm-9studio' ),
	'base'     => 'insight_video',
	'category' => sprintf( esc_html__( 'by %s', 'tm-9studio' ), INSIGHT_THEME_NAME ),
	'icon'     => 'tm-shortcode-ico default-icon',
	'params'   => array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Style', 'tm-9studio' ),
			'param_name'  => 'style',
			'std'         => 'style01',
			'value'       => array(
				'Style 01 (Has shadow)' => 'style01',
				'Style 02 (No shadow)'  => 'style02',
			),
			'admin_label' => true,
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Video URL', 'tm-9studio' ),
			'admin_label' => true,
			'param_name'  => 'url',
			'description' => esc_html__( 'Enter your video url (Youtube/Vimeo) here', 'tm-9studio' ),
			'value'       => 'http://vimeo.com/92033601',
		),
		array(
			'type'        => 'attach_image',
			'heading'     => esc_html__( 'Poster', 'tm-9studio' ),
			'param_name'  => 'poster',
			'save_always' => true,
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Time', 'tm-9studio' ),
			'param_name'  => 'time',
			'value'       => '14:09',
			'admin_label' => true,
		),
		array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Auto play when open popup?', 'tm-9studio' ),
			'param_name' => 'auto_play',
		),
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'css' ),
		Insight_Helper::get_param( 'note' ),
	),
) );
