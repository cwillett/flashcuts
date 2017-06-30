<?php

class WPBakeryShortCode_Insight_Blog_Carousel extends WPBakeryShortCode {
}

vc_map( array(
	'name'                      => esc_html__( 'Blog Carousel', 'tm-9studio' ),
	'base'                      => 'insight_blog_carousel',
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
				'Style 01' => 'style01',
				'Style 02' => 'style02',
			),
			'admin_label' => true,
		),
		array(
			'type'        => 'number',
			'heading'     => esc_html__( 'Number posts', 'tm-9studio' ),
			'param_name'  => 'number_posts',
			'value'       => 8,
			'min'         => 1,
			'max'         => 24,
			'admin_label' => true,
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Order by', 'tm-9studio' ),
			'param_name'  => 'order_by',
			'value'       => array(
				'Date'               => 'date',
				'Title'              => 'title',
				'Random'             => 'rand',
				'Comment count'      => 'comment_count',
				'Slug'               => 'slug',
				'ID'                 => 'id',
				'Last modified date' => 'modified',
				'Author'             => 'author',
			),
			'admin_label' => true,
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Order', 'tm-9studio' ),
			'param_name'  => 'order',
			'value'       => array(
				'DESC' => 'DESC',
				'ASC'  => 'ASC',
			),
			'admin_label' => true,
		),
		array(
			'type'        => 'number',
			'heading'     => esc_html__( 'Slides to display', 'tm-9studio' ),
			'param_name'  => 'slides_to_display',
			'value'       => 4,
			'min'         => 1,
			'max'         => 6,
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
			'heading'    => esc_html__( 'Enable autoplay', 'tm-9studio' ),
			'param_name' => 'enable_autoplay',
			'value'      => array(
				esc_html__( 'Yes', 'tm-9studio' ) => 'true',
				esc_html__( 'No', 'tm-9studio' )  => 'false'
			),
		),
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'note' ),
	)
) );
