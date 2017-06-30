<?php

class WPBakeryShortCode_Insight_Icon_Boxes extends WPBakeryShortCode {
}

$base_name = 'insight_icon_boxes';

vc_map( array(
	'name'                      => esc_html__( 'Icon Box', 'tm-9studio' ),
	'base'                      => $base_name,
	'category'                  => sprintf( esc_html__( 'by %s', 'tm-9studio' ), INSIGHT_THEME_NAME ),
	'icon'                      => 'tm-shortcode-ico default-icon',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'type'        => 'imgradio',
			'admin_label' => true,
			'heading'     => esc_html__( 'Style', 'tm-9studio' ),
			'param_name'  => 'style',
			'value'       => array(
				'small_icon'    => array(
					'img'   => INSIGHT_THEME_URI . '/assets/admin/images/shortcode-style/icon-boxes/icon-on-left.png',
					'title' => 'Small icon',
				),
				'icon_on_left'  => array(
					'img'   => INSIGHT_THEME_URI . '/assets/admin/images/shortcode-style/icon-boxes/icon-on-left.png',
					'title' => 'Icon on Left',
				),
				'icon_on_top'   => array(
					'img'   => INSIGHT_THEME_URI . '/assets/admin/images/shortcode-style/icon-boxes/icon-on-top.png',
					'title' => 'Icon on Top',
				),
				'icon_on_top_2' => array(
					'img'   => INSIGHT_THEME_URI . '/assets/admin/images/shortcode-style/icon-boxes/icon-on-top.png',
					'title' => 'Icon on Top 2',
				),
			),
			'std'         => 'icon_on_left',
		),
		array(
			'type'       => 'toggle',
			'heading'    => esc_html__( 'Display icon', 'tm-9studio' ),
			'param_name' => 'display_icon',
			'value'      => 'yes',
			'options'    => array(
				'yes' => array(
					'label' => '',
					'on'    => esc_html__( 'Yes', 'tm-9studio' ),
					'off'   => esc_html__( 'No', 'tm-9studio' ),
				),
			),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Icon type', 'tm-9studio' ),
			'param_name'  => 'icon_type',
			'value'       => array(
				'Font icons' => 'font-icons',
				'Custom'     => 'custom',
			),
			'description' => '',
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Icon library', 'tm-9studio' ),
			'std'        => 'ionicons',
			'value'      => array(
				esc_html__( 'Font Awesome', 'tm-9studio' ) => 'fontawesome',
				esc_html__( 'Open Iconic', 'tm-9studio' )  => 'openiconic',
				esc_html__( 'Typicons', 'tm-9studio' )     => 'typicons',
				esc_html__( 'Entypo', 'tm-9studio' )       => 'entypo',
				esc_html__( 'Linecons', 'tm-9studio' )     => 'linecons',
				esc_html__( 'Ionicons', 'tm-9studio' )     => 'ionicons',
				esc_html__( '9studio', 'tm-9studio' )      => '9studio',

			),
			'param_name' => 'icon_lib',
			'dependency' => array( 'element' => 'icon_type', 'value' => array( 'font-icons' ) ),
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
			'heading'    => esc_html__( 'Custom icon', 'tm-9studio' ),
			'param_name' => 'custom_icon',
			'dependency' => array( 'element' => 'icon_type', 'value' => array( 'custom' ) ),
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Icon text', 'tm-9studio' ),
			'param_name' => 'icon_text',
			'dependency' => array( 'element' => 'style', 'value' => array( 'icon_on_left' ) ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Title', 'tm-9studio' ),
			'param_name'  => 'title',
			'admin_label' => true,
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Content', 'tm-9studio' ),
			'param_name'  => 'content',
			'admin_label' => true,
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Title element tag', 'tm-9studio' ),
			'param_name'  => 'element_tag',
			'value'       => array(
				'Default' => '',
				'h1'      => 'h1',
				'h2'      => 'h2',
				'h3'      => 'h3',
				'h4'      => 'h4',
				'h5'      => 'h5',
				'h6'      => 'h6',
				'p'       => 'p',
				'div'     => 'div',
			),
			'save_always' => true,
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( '"Read more" link', 'tm-9studio' ),
			'param_name' => 'readmore_link',
			'dependency' => array( 'element' => 'style', 'value' => array( 'icon_on_top', 'icon_on_top_2' ) ),
		),
		array(
			'type'       => 'attach_image',
			'heading'    => esc_html__( 'Icon background', 'tm-9studio' ),
			'param_name' => 'icon_bg',
			'dependency' => array( 'element' => 'style', 'value' => array( 'icon_on_top' ) ),
		),
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'css' ),
		Insight_Helper::get_param( 'note' ),
	),
) );
