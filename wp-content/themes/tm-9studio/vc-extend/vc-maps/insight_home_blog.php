<?php

class WPBakeryShortCode_Insight_Home_Blog extends WPBakeryShortCode {
}

vc_map( array(
	'name'                      => esc_html__( 'Home Blog (4 Posts)', 'tm-9studio' ),
	'base'                      => 'insight_home_blog',
	'category'                  => sprintf( esc_html__( 'by %s', 'tm-9studio' ), INSIGHT_THEME_NAME ),
	'icon'                      => 'tm-shortcode-ico default-icon',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'type'        => 'ajax-search',
			'heading'     => esc_html__( 'Blog 01 (Normal)', 'tm-9studio' ),
			'param_name'  => 'blog_01',
			'ajax_get'    => 'post',
			'ajax_limit'  => 1,
			'admin_label' => true,
		),
		array(
			'type'        => 'attach_image',
			'heading'     => esc_html__( 'Custom Blog 01 Image', 'tm-9studio' ),
			'description' => esc_html__( 'If not set, the blog featured image will be used.', 'tm-9studio' ),
			'param_name'  => 'image_01',
			'admin_label' => true,
		),
		array(
			'type'        => 'ajax-search',
			'heading'     => esc_html__( 'Blog 02 (Normal)', 'tm-9studio' ),
			'param_name'  => 'blog_02',
			'ajax_get'    => 'post',
			'ajax_limit'  => 1,
			'admin_label' => true,
		),
		array(
			'type'        => 'attach_image',
			'heading'     => esc_html__( 'Custom Blog 02 Image', 'tm-9studio' ),
			'description' => esc_html__( 'If not set, the blog featured image will be used.', 'tm-9studio' ),
			'param_name'  => 'image_02',
			'admin_label' => true,
		),
		array(
			'type'        => 'ajax-search',
			'heading'     => esc_html__( 'Blog 03 (Quote)', 'tm-9studio' ),
			'param_name'  => 'blog_03',
			'ajax_get'    => 'post',
			'ajax_limit'  => 1,
			'admin_label' => true,
		),
		array(
			'type'        => 'ajax-search',
			'heading'     => esc_html__( 'Blog 04 (Video)', 'tm-9studio' ),
			'param_name'  => 'blog_04',
			'ajax_get'    => 'post',
			'ajax_limit'  => 1,
			'admin_label' => true,
		),
		array(
			'type'        => 'attach_image',
			'heading'     => esc_html__( 'Custom Blog 04 Image', 'tm-9studio' ),
			'description' => esc_html__( 'If not set, the blog featured image will be used.', 'tm-9studio' ),
			'param_name'  => 'image_04',
			'admin_label' => true,
		),
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'note' ),
	)
) );
