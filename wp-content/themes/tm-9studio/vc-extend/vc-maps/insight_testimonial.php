<?php

class WPBakeryShortCode_Insight_Testimonial extends WPBakeryShortCode {
}

vc_map( array(
	'name'                      => esc_html__( 'Testimonials', 'tm-9studio' ),
	'base'                      => 'insight_testimonial',
	'category'                  => sprintf( esc_html__( 'by %s', 'tm-9studio' ), INSIGHT_THEME_NAME ),
	'icon'                      => 'tm-shortcode-ico default-icon',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
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
			'heading'    => esc_html__( 'Show arrows', 'tm-9studio' ),
			'param_name' => 'display_arrows',
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
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Slides to display', 'tm-9studio' ),
			'param_name' => 'slides_to_display',
			'value'      => Insight_Helper::get_value_num( 1, 6, 1 ),
		),
		array(
			'type'       => 'param_group',
			'heading'    => esc_html__( 'Testimonials', 'tm-9studio' ),
			'param_name' => 'testimonials',
			'params'     => array(
				array(
					'type'        => 'attach_image',
					'heading'     => esc_html__( 'Photo', 'tm-9studio' ),
					'param_name'  => 'photo',
					'admin_label' => true,
					'description' => esc_html__( 'Photo', 'tm-9studio' )
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Title', 'tm-9studio' ),
					'param_name' => 'title',
					'value'      => ''
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Content', 'tm-9studio' ),
					'param_name' => 'content',
					'value'      => ''
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
			),
		),
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'css' ),
		Insight_Helper::get_param( 'note' ),
	)
) );
