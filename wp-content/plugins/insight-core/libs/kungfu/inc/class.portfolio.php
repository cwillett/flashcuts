<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Kungfu_Portfolio' ) ) {
	class Kungfu_Portfolio {
		function __construct() {
			add_action( 'init', array( $this, 'register_post_types' ), 1 );
		}

		function register_post_types() {

			$slug = apply_filters( 'insight_core_portfolio_slug', 'portfolio' );

			$labels = array(
				'name'               => __( 'Portfolio', 'insight-core' ),
				'singular_name'      => __( 'Portfolio Item', 'insight-core' ),
				'view_item'          => __( 'View Portfolios', 'insight-core' ),
				'add_new_item'       => __( 'Add New Portfolio', 'insight-core' ),
				'add_new'            => _x( 'Add New', 'insight-core' ),
				'new_item'           => __( 'Add New Portfolio Item', 'insight-core' ),
				'edit_item'          => __( 'Edit Portfolio Item', 'insight-core' ),
				'update_item'        => __( 'Update Portfolio', 'insight-core' ),
				'all_items'          => __( 'All Portfolios', 'insight-core' ),
				'parent_item_colon'  => __( 'Parent Portfolio Item:', 'insight-core' ),
				'search_items'       => __( 'Search Portfolio', 'insight-core' ),
				'not_found'          => __( 'No portfolio items found', 'insight-core' ),
				'not_found_in_trash' => __( 'No portfolio items found in trash', 'insight-core' )
			);

			$supports = array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
				'comments',
				'author',
				'revisions',
				'custom-fields'
			);

			register_post_type(
				'portfolio',
				array(
					'labels'      => $labels,
					'supports'    => $supports,
					'public'      => true,
					'has_archive' => true,
					'rewrite'     => array(
						'slug' => $slug
					),
					'can_export'  => true,
					'menu_icon'   => ( version_compare( $GLOBALS['wp_version'], '3.8', '>=' ) ) ? 'dashicons-portfolio' : false,
				)
			);

			//flush_rewrite_rules( false );

			register_taxonomy(
				'portfolio_category',
				'portfolio',
				array(
					'hierarchical'      => true,
					'label'             => __( 'Categories', 'insight-core' ),
					'query_var'         => true,
					'rewrite'           => true,
					'show_admin_column' => true,
				)
			);

			register_taxonomy(
				'portfolio_tags',
				'portfolio',
				array(
					'hierarchical'      => false,
					'label'             => __( 'Tags', 'insight-core' ),
					'query_var'         => true,
					'rewrite'           => true,
					'show_admin_column' => true,
				)
			);
		}
	}

	new Kungfu_Portfolio;
}