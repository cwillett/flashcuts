<?php

class WPBakeryShortCode_Insight_Project_Video extends WPBakeryShortCode {
}

vc_map( array(
	'name'        => esc_html__( 'Project Video', 'tm-9studio' ),
	'description' => esc_html__( 'Project video section only for single project', 'tm-9studio' ),
	'base'        => 'insight_project_video',
	'category'    => sprintf( esc_html__( 'by %s', 'tm-9studio' ), INSIGHT_THEME_NAME ),
	'icon'        => 'tm-shortcode-ico default-icon',
	'params'      => array(
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
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'note' ),
	),
) );
