<?php

class WPBakeryShortCode_Insight_Single_Testimonial extends WPBakeryShortCode {
}

vc_map( array(
	'name'                      => esc_html__( 'Single Testimonial', 'tm-9studio' ),
	'base'                      => 'insight_single_testimonial',
	'category'                  => sprintf( esc_html__( 'by %s', 'tm-9studio' ), INSIGHT_THEME_NAME ),
	'icon'                      => 'tm-shortcode-ico default-icon',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'type'        => 'attach_image',
			'heading'     => esc_html__( 'Photo', 'tm-9studio' ),
			'param_name'  => 'photo',
			'description' => esc_html__( 'Photo', 'tm-9studio' )
		),
		array(
			'type'       => 'textarea',
			'heading'    => esc_html__( 'Content', 'tm-9studio' ),
			'param_name' => 'content',
			'value'      => ''
		),
		array(
			'type'       => 'attach_image',
			'heading'    => esc_html__( 'Sign', 'tm-9studio' ),
			'param_name' => 'sign',
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Name', 'tm-9studio' ),
			'param_name'  => 'name',
			'value'       => '',
			'admin_label' => true
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Tagline', 'tm-9studio' ),
			'param_name'  => 'tagline',
			'value'       => '',
			'admin_label' => true
		),
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'css' ),
		Insight_Helper::get_param( 'note' ),
	)
) );
