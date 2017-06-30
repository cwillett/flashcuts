<?php

class WPBakeryShortCode_Insight_Gallery_Carousel extends WPBakeryShortCode {
}

$base_name = 'insight_gallery_carousel';

vc_map( array(
	'name'                      => esc_html__( 'Gallery Carousel', 'tm-9studio' ),
	'base'                      => $base_name,
	'category'                  => sprintf( esc_html__( 'by %s', 'tm-9studio' ), INSIGHT_THEME_NAME ),
	'icon'                      => 'tm-shortcode-ico default-icon',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'type'        => 'attach_images',
			'heading'     => 'Images',
			'param_name'  => 'images',
			'save_always' => true,
			'admin_label' => true,
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Slides to display', 'tm-9studio' ),
			'param_name'  => 'slides_to_display',
			'std'         => '4',
			'value'       => array(
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
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
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'css' ),
		Insight_Helper::get_param( 'note' ),
	)
) );
