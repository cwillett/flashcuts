<?php

class WPBakeryShortCode_Insight_One_Page extends WPBakeryShortCode {
}

vc_map( array(
	'name'                      => esc_html__( 'One Page', 'tm-9studio' ),
	'base'                      => 'insight_one_page',
	'category'                  => sprintf( esc_html__( 'by %s', 'tm-9studio' ), INSIGHT_THEME_NAME ),
	'icon'                      => 'tm-shortcode-ico default-icon',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'type'       => 'param_group',
			'heading'    => esc_html__( 'Pages', 'tm-9studio' ),
			'param_name' => 'pages',
			'params'     => array(
				array(
					'type'        => 'attach_image',
					'heading'     => esc_html__( 'Background image', 'tm-9studio' ),
					'param_name'  => 'background_image',
					'admin_label' => true,
				),
				array(
					'type'        => 'ajax-search',
					'heading'     => esc_html__( 'Project', 'tm-9studio' ),
					'param_name'  => 'project',
					'ajax_get'    => 'ic_project',
					'ajax_limit'  => 1,
					'admin_label' => true,
				),
				array(
					'type'        => 'attach_image',
					'heading'     => esc_html__( 'Custom image', 'tm-9studio' ),
					'description' => esc_html__( 'If not set, the project featured image will be used.', 'tm-9studio' ),
					'param_name'  => 'image',
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Video URL', 'tm-9studio' ),
					'param_name'  => 'video',
					'description' => esc_html__( 'Enter your video url (Youtube/Vimeo) here', 'tm-9studio' ),
					'value'       => 'http://vimeo.com/92033601',
				),
			),
		),
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'note' ),
	)
) );
