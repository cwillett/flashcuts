<?php

class WPBakeryShortCode_Insight_Links_Cloud extends WPBakeryShortCode {
}

vc_map( array(
	'name'                      => esc_html__( 'Links Cloud', 'tm-9studio' ),
	'base'                      => 'insight_links_cloud',
	'category'                  => sprintf( esc_html__( 'by %s', 'tm-9studio' ), INSIGHT_THEME_NAME ),
	'icon'                      => 'tm-shortcode-ico default-icon',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'type'       => 'param_group',
			'heading'    => esc_html__( 'Links Cloud', 'tm-9studio' ),
			'param_name' => 'links_cloud',
			'params'     => array(
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Title', 'tm-9studio' ),
					'param_name'  => 'title',
					'value'       => '',
					'admin_label' => true,
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Link', 'tm-9studio' ),
					'param_name' => 'link',
					'value'      => '',
				),
			),
		),
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'css' ),
		Insight_Helper::get_param( 'note' ),
	)
) );
