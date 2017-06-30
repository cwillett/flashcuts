<?php

class WPBakeryShortCode_Insight_Team_Filter extends WPBakeryShortCode {
}

$base_name = 'insight_team_filter';

vc_map( array(
	'name'                      => esc_html__( 'Team Filter', 'tm-9studio' ),
	'base'                      => $base_name,
	'category'                  => sprintf( esc_html__( 'by %s', 'tm-9studio' ), INSIGHT_THEME_NAME ),
	'icon'                      => 'tm-shortcode-ico default-icon',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		Insight_Helper::get_param( 'our_team_group' ),
		array(
			'type'       => 'dropdown',
			'heading'    => 'Order by',
			'param_name' => 'order_by',
			'value'      => array(
				'Default' => '',
				'Title'   => 'title',
				'Date'    => 'date',
			),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => 'Order',
			'param_name' => 'order',
			'value'      => array(
				'Default' => '',
				'ASC'     => 'ASC',
				'DESC'    => 'DESC',
			),
		),
		array(
			'type'        => 'number',
			'heading'     => esc_html__( 'Number', 'tm-9studio' ),
			'param_name'  => 'number',
			'min'         => 1,
			'value'       => 8,
			'max'         => 24,
			'admin_label' => true,
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Number per row', 'tm-9studio' ),
			'param_name'  => 'number_per_row',
			'std'         => '4',
			'value'       => array(
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'6' => '6',
			),
			'admin_label' => true,
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Image size', 'tm-9studio' ),
			'param_name'  => 'image_size',
			'std'         => '02',
			'value'       => array(
				esc_html__( 'Size 01', 'tm-9studio' ) => '01',
				esc_html__( 'Size 02', 'tm-9studio' ) => '02',
			),
			'admin_label' => true,
		),
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'css' ),
		Insight_Helper::get_param( 'note' ),
	)
) );
