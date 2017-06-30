<?php

class WPBakeryShortCode_Insight_Our_Services_List extends WPBakeryShortCode {
}

vc_map( array(
	'name'                      => esc_html__( 'Our Services List', 'tm-9studio' ),
	'base'                      => 'insight_our_services_list',
	'category'                  => sprintf( esc_html__( 'by %s', 'tm-9studio' ), INSIGHT_THEME_NAME ),
	'icon'                      => 'tm-shortcode-ico default-icon',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Big title', 'tm-9studio' ),
			'param_name'  => 'big_title',
			'value'       => '',
			'admin_label' => true,
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Link', 'tm-9studio' ),
			'param_name'  => 'link',
			'value'       => '',
			'admin_label' => true,
		),
		array(
			'type'       => 'param_group',
			'heading'    => esc_html__( 'Services', 'tm-9studio' ),
			'param_name' => 'services',
			'params'     => array(
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Title', 'tm-9studio' ),
					'param_name'  => 'title',
					'value'       => '',
					'admin_label' => true,
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Content', 'tm-9studio' ),
					'param_name' => 'content',
					'value'      => ''
				),
			),
		),
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'note' ),
	)
) );
