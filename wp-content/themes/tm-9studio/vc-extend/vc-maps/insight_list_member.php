<?php

class WPBakeryShortCode_Insight_List_Member extends WPBakeryShortCode {
}

$base_name = 'insight_list_member';

vc_map( array(
	'name'                      => esc_html__( 'List Member', 'tm-9studio' ),
	'base'                      => $base_name,
	'category'                  => sprintf( esc_html__( 'by %s', 'tm-9studio' ), INSIGHT_THEME_NAME ),
	'icon'                      => 'tm-shortcode-ico default-icon',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'type'       => 'param_group',
			'heading'    => esc_html__( 'Members', 'tm-9studio' ),
			'param_name' => 'members',
			'params'     => array(
				array(
					'type'        => 'attach_image',
					'heading'     => esc_html__( 'Image', 'tm-9studio' ),
					'param_name'  => 'image',
					'value'       => '',
					'description' => esc_html__( 'Select an image from media library.', 'tm-9studio' ),
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Name', 'tm-9studio' ),
					'param_name'  => 'name',
					'admin_label' => true,
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Tagline', 'tm-9studio' ),
					'param_name'  => 'tagline',
					'admin_label' => true,
				),
			),
		),
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'css' ),
	)
) );
