<?php

class WPBakeryShortCode_Insight_Title extends WPBakeryShortCode {
}

$base_name = 'insight_title';

vc_map( array(
	'name'                      => esc_html__( 'Title', 'tm-9studio' ),
	'base'                      => $base_name,
	'category'                  => sprintf( esc_html__( 'by %s', 'tm-9studio' ), INSIGHT_THEME_NAME ),
	'icon'                      => 'tm-shortcode-ico default-icon',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Title', 'tm-9studio' ),
			'param_name'  => 'title',
			'admin_label' => true,
		),
		array(
			'type'       => 'toggle',
			'heading'    => esc_html__( 'Title uppercase', 'tm-9studio' ),
			'param_name' => 'uppercase',
			'value'      => '',
			'std'        => 'on',
			'options'    => array(
				'yes' => array(
					'label' => '',
					'on'    => esc_html__( 'Yes', 'tm-9studio' ),
					'off'   => esc_html__( 'No', 'tm-9studio' )
				)
			),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Title font family', 'tm-9studio' ),
			'param_name' => 'font_family',
			'std'        => 'secondary',
			'value'      => array(
				esc_html__( 'Primary', 'tm-9studio' )   => 'primary',
				esc_html__( 'Secondary', 'tm-9studio' ) => 'secondary',
			),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Title font size', 'tm-9studio' ),
			'param_name' => 'font_size',
			'std'        => '40',
			'value'      => array(
				esc_html__( '40px', 'tm-9studio' ) => '40',
				esc_html__( '48px', 'tm-9studio' ) => '48',
				esc_html__( '56px', 'tm-9studio' ) => '56',
			),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Font weight', 'tm-9studio' ),
			'param_name' => 'font_weight',
			'std'        => '700',
			'value'      => array(
				'100' => '100',
				'200' => '200',
				'300' => '300',
				'400' => '400',
				'500' => '500',
				'600' => '600',
				'700' => '700',
				'800' => '800',
				'900' => '900',
			),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Font style', 'tm-9studio' ),
			'param_name' => 'font_style',
			'std'        => 'normal',
			'value'      => array(
				'normal'  => 'normal',
				'italic'  => 'italic',
				'oblique' => 'oblique',
				'initial' => 'initial',
				'inherit' => 'inherit',
			),
		),
		array(
			'type'       => 'toggle',
			'heading'    => esc_html__( 'Sub title enable', 'tm-9studio' ),
			'param_name' => 'sub_title_enable',
			'value'      => '',
			'options'    => array(
				'yes' => array(
					'label' => '',
					'on'    => esc_html__( 'Yes', 'tm-9studio' ),
					'off'   => esc_html__( 'No', 'tm-9studio' )
				)
			),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Sub title', 'tm-9studio' ),
			'param_name'  => 'sub_title',
			'admin_label' => true,
			'dependency'  => array( 'element' => 'sub_title_enable', 'value' => array( 'yes' ) ),
		),
		array(
			'type'       => 'toggle',
			'heading'    => esc_html__( 'Description enable', 'tm-9studio' ),
			'param_name' => 'description_enable',
			'value'      => '',
			'options'    => array(
				'yes' => array(
					'label' => '',
					'on'    => esc_html__( 'Yes', 'tm-9studio' ),
					'off'   => esc_html__( 'No', 'tm-9studio' )
				)
			),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Description', 'tm-9studio' ),
			'param_name'  => 'description',
			'admin_label' => true,
			'dependency'  => array( 'element' => 'description_enable', 'value' => array( 'yes' ) ),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Align', 'tm-9studio' ),
			'param_name' => 'align',
			'value'      => array(
				esc_html__( 'Center', 'tm-9studio' ) => 'text-center',
				esc_html__( 'Left', 'tm-9studio' )   => 'text-left',
				esc_html__( 'Right', 'tm-9studio' )  => 'text-right',
			),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Color', 'tm-9studio' ),
			'param_name' => 'color',
			'value'      => array(
				esc_html__( 'Black text', 'tm-9studio' ) => 'black',
				esc_html__( 'White text', 'tm-9studio' ) => 'white',
			),
		),
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'css' ),
	)
) );
