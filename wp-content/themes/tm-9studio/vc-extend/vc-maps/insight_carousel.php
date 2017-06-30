<?php

class WPBakeryShortCode_Insight_Carousel extends WPBakeryShortCode {
}

$base_name = 'insight_carousel';

vc_map( array(
	'name'                      => esc_html__( 'Carousel', 'tm-9studio' ),
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
			'type'        => 'toggle',
			'heading'     => esc_html__( 'Custom image size', 'tm-9studio' ),
			'param_name'  => 'custom_image_size',
			'value'       => '',
			'options'     => array(
				'yes' => array(
					'label' => '',
					'on'    => esc_html__( 'Yes', 'tm-9studio' ),
					'off'   => esc_html__( 'No', 'tm-9studio' )
				)
			),
			'admin_label' => true,
		),
		array(
			'type'        => 'number',
			'heading'     => esc_html__( 'Width', 'tm-9studio' ),
			'param_name'  => 'width',
			'value'       => 500,
			'min'         => 10,
			'step'        => 1,
			'suffix'      => 'px',
			'dependency'  => array( 'element' => 'custom_image_size', 'value' => array( 'yes' ) ),
			'admin_label' => true,
		),
		array(
			'type'        => 'number',
			'heading'     => esc_html__( 'Height', 'tm-9studio' ),
			'param_name'  => 'height',
			'value'       => 500,
			'min'         => 10,
			'step'        => 1,
			'suffix'      => 'px',
			'dependency'  => array( 'element' => 'custom_image_size', 'value' => array( 'yes' ) ),
			'admin_label' => true,
		),
		array(
			'type'        => 'toggle',
			'heading'     => esc_html__( 'Auto play', 'tm-9studio' ),
			'param_name'  => 'autoplay',
			'value'       => '',
			'options'     => array(
				'yes' => array(
					'label' => '',
					'on'    => esc_html__( 'Yes', 'tm-9studio' ),
					'off'   => esc_html__( 'No', 'tm-9studio' )
				)
			),
			'admin_label' => true,
		),
		array(
			'type'        => 'toggle',
			'heading'     => esc_html__( 'Show dots', 'tm-9studio' ),
			'param_name'  => 'dots',
			'value'       => '',
			'options'     => array(
				'yes' => array(
					'label' => '',
					'on'    => esc_html__( 'Yes', 'tm-9studio' ),
					'off'   => esc_html__( 'No', 'tm-9studio' )
				)
			),
			'admin_label' => true,
		),
		array(
			'type'        => 'number',
			'heading'     => esc_html__( 'Slides per row', 'tm-9studio' ),
			'param_name'  => 'slides_per_row',
			'value'       => 6,
			'min'         => 1,
			'max'         => 12,
			'step'        => 1,
			'suffix'      => 'slide(s)',
			'admin_label' => true,
		),
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'css' ),
		Insight_Helper::get_param( 'note' ),
	)
) );
