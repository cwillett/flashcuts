<?php

class WPBakeryShortCode_Insight_Project_Grid extends WPBakeryShortCode {
}

$base_name = 'insight_project_grid';

vc_map( array(
	'name'                      => esc_html__( 'Project Grid', 'tm-9studio' ),
	'base'                      => $base_name,
	'category'                  => sprintf( esc_html__( 'by %s', 'tm-9studio' ), INSIGHT_THEME_NAME ),
	'icon'                      => 'tm-shortcode-ico default-icon',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'type'        => 'ajax-search',
			'heading'     => esc_html__( 'Projects', 'tm-9studio' ),
			'param_name'  => 'projects',
			'ajax_get'    => 'ic_project',
			'ajax_limit'  => 24,
			'admin_label' => true,
		),
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'css' ),
		Insight_Helper::get_param( 'note' ),
	)
) );
