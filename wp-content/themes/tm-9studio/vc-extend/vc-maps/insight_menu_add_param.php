<?php

class WPBakeryShortCode_Insight_Menu_Add_Param extends WPBakeryShortCode {
}

$base_name = 'insight_menu_add_param';

vc_map( array(
	'name'                      => esc_html__( 'Menu Add Param', 'tm-9studio' ),
	'base'                      => $base_name,
	'category'                  => sprintf( esc_html__( 'by %s', 'tm-9studio' ), INSIGHT_THEME_NAME ),
	'icon'                      => 'tm-shortcode-ico default-icon',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'type'       => 'param_group',
			'heading'    => esc_html__( 'Menu Add Param', 'tm-9studio' ),
			'param_name' => 'menu_add_param',
			'params'     => array(
				array(
					'type'        => 'dropdown',
					'heading'     => 'Icon type',
					'param_name'  => 'icon_type',
					'value'       => array(
						'Font icons' => 'font-icons',
						'Custom'     => 'custom',
					),
					'description' => '',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Icon library', 'tm-9studio' ),
					'std'         => 'ionicons',
					'value'       => array(
						esc_html__( 'Font Awesome', 'tm-9studio' ) => 'fontawesome',
						esc_html__( 'Open Iconic', 'tm-9studio' )  => 'openiconic',
						esc_html__( 'Typicons', 'tm-9studio' )     => 'typicons',
						esc_html__( 'Entypo', 'tm-9studio' )       => 'entypo',
						esc_html__( 'Linecons', 'tm-9studio' )     => 'linecons',
						esc_html__( 'Ionicons', 'tm-9studio' )     => 'ionicons',
						esc_html__( '9studio', 'tm-9studio' )      => '9studio',

					),
					'param_name'  => 'icon_lib',
					'description' => esc_html__( 'Select icon library.', 'tm-9studio' ),
					'dependency'  => array( 'element' => 'icon_type', 'value' => array( 'font-icons' ) ),
				),
				Insight_Helper::fonticon( 'fontawesome' ),
				Insight_Helper::fonticon( 'openiconic' ),
				Insight_Helper::fonticon( 'typicons' ),
				Insight_Helper::fonticon( 'entypo' ),
				Insight_Helper::fonticon( 'linecons' ),
				Insight_Helper::fonticon( 'ionicons' ),
				Insight_Helper::fonticon( '9studio' ),
				array(
					'type'       => 'attach_image',
					'heading'    => 'Custom Icon',
					'param_name' => 'custom_icon',
					'dependency' => array( 'element' => 'icon_type', 'value' => array( 'custom' ) ),
				),
				Insight_Helper::get_param( 'post_categories_select' ),
			),
		),
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'css' ),
	)
) );
