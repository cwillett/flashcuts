<?php

class WPBakeryShortCode_Insight_Our_Services extends WPBakeryShortCode {
}

vc_map( array(
	'name'                      => esc_html__( 'Our Services', 'tm-9studio' ),
	'base'                      => 'insight_our_services',
	'category'                  => sprintf( esc_html__( 'by %s', 'tm-9studio' ), INSIGHT_THEME_NAME ),
	'icon'                      => 'tm-shortcode-ico default-icon',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Type', 'tm-9studio' ),
			'param_name'  => 'type',
			'std'         => 'icon',
			'value'       => array(
				esc_html__( 'Icon with text', 'tm-9studio' )  => 'icon',
				esc_html__( 'Image with text', 'tm-9studio' ) => 'image',
			),
			'admin_label' => true,
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Style', 'tm-9studio' ),
			'param_name'  => 'style',
			'value'       => array(
				esc_html__( 'Left', 'tm-9studio' )  => 'left',
				esc_html__( 'Right', 'tm-9studio' ) => 'right',
			),
			'admin_label' => true,
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Color', 'tm-9studio' ),
			'param_name'  => 'color',
			'value'       => array(
				esc_html__( 'White', 'tm-9studio' )   => 'white',
				esc_html__( 'Primary', 'tm-9studio' ) => 'primary',
				esc_html__( 'Black', 'tm-9studio' )   => 'black',
			),
			'admin_label' => true,
			'dependency'  => array( 'element' => 'type', 'value' => array( 'icon' ) ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Icon library', 'tm-9studio' ),
			'std'         => '9studio',
			'value'       => array(
				esc_html__( '9studio', 'tm-9studio' )      => '9studio',
				esc_html__( 'Font Awesome', 'tm-9studio' ) => 'fontawesome',
				esc_html__( 'Ionicons', 'tm-9studio' )     => 'ionicons',

			),
			'param_name'  => 'icon_lib',
			'description' => esc_html__( 'Select icon library.', 'tm-9studio' ),
			'dependency'  => array( 'element' => 'type', 'value' => array( 'icon' ) ),
		),
		Insight_Helper::fonticon( '9studio' ),
		Insight_Helper::fonticon( 'fontawesome' ),
		Insight_Helper::fonticon( 'ionicons' ),
		array(
			'type'        => 'attach_image',
			'heading'     => esc_html__( 'Image', 'tm-9studio' ),
			'param_name'  => 'image',
			'admin_label' => true,
			'dependency'  => array( 'element' => 'type', 'value' => array( 'image' ) ),
		),
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
			'value'      => '',
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Link', 'tm-9studio' ),
			'param_name'  => 'link',
			'value'       => '',
			'admin_label' => true,
		),
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'note' ),
	)
) );
