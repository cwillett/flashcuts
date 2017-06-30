<?php

class WPBakeryShortCode_Insight_Project_Comment extends WPBakeryShortCode {
}

vc_map( array(
	'name'        => esc_html__( 'Project Comment', 'tm-9studio' ),
	'description' => esc_html__( 'Comment list and form section only for single project', 'tm-9studio' ),
	'base'        => 'insight_project_comment',
	'category'    => sprintf( esc_html__( 'by %s', 'tm-9studio' ), INSIGHT_THEME_NAME ),
	'icon'        => 'tm-shortcode-ico default-icon',
	'params'      => array(
		Insight_Helper::get_param( 'el_class' ),
		Insight_Helper::get_param( 'note' ),
	),
) );
