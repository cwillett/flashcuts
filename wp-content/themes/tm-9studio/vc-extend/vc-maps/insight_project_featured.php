<?php

class WPBakeryShortCode_Insight_Project_Featured extends WPBakeryShortCode {
}

vc_map( array(
	'name'                      => esc_html__( 'Project Featured', 'tm-9studio' ),
	'base'                      => 'insight_project_featured',
	'category'                  => sprintf( esc_html__( 'by %s', 'tm-9studio' ), INSIGHT_THEME_NAME ),
	'icon'                      => 'tm-shortcode-ico default-icon',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
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
			'heading'     => esc_html__( 'Custom Image', 'tm-9studio' ),
			'description' => esc_html__( 'If not set, the project featured image will be used.', 'tm-9studio' ),
			'param_name'  => 'image',
			'admin_label' => true,
		),
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'note' ),
	)
) );
