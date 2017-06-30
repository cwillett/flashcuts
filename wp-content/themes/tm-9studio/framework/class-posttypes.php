<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Content Block Class
 *
 * @package Core
 */
class Insight_Posttypes {

	/**
	 * The constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'init' ), 9 );
	}

	public function init() {
		add_filter( 'insight_posttypes', array( $this, 'insight_posttypes' ) );
		add_filter( 'insight_taxonomy', array( $this, 'insight_taxonomy' ) );
	}

	public function insight_posttypes() {

		if ( empty( $posttypes ) ) {
			$posttypes = array();
		}

		// Gallery
		$posttypes['ic_gallery'] = array(
			'labels'        => array(
				'name'          => esc_html__( 'Gallery Image', 'tm-9studio' ),
				'singular_name' => esc_html__( 'Gallery Image Item', 'tm-9studio' ),
				'add_item'      => esc_html__( 'New Gallery Image Item', 'tm-9studio' ),
				'add_new_item'  => esc_html__( 'Add New Gallery Image Item', 'tm-9studio' ),
				'edit_item'     => esc_html__( 'Edit Gallery Image Item', 'tm-9studio' )
			),
			'public'        => false,
			'has_archive'   => false,
			'menu_position' => 4,
			'show_ui'       => true,
			'supports'      => array( 'title', 'thumbnail' )
		);

		// Our team
		$posttypes['ic_our_team'] = array(
			'labels'        => array(
				'name' => apply_filters( 'ic_our_team_name', esc_html__( 'Our Team', 'tm-9studio' ) ),
			),
			'public'        => true,
			'has_archive'   => true,
			'rewrite'       => array( 'slug' => apply_filters( 'ic_our_team_slug', 'our-team' ) ),
			'menu_position' => 4,
			'show_ui'       => true,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt' )
		);

		// Project
		$posttypes['ic_project'] = array(
			'labels'        => array(
				'name' => apply_filters( 'ic_project_name', esc_html__( 'Project', 'tm-9studio' ) ),
			),
			'public'        => true,
			'has_archive'   => true,
			'rewrite'       => array( 'slug' => apply_filters( 'ic_project_slug', 'project' ) ),
			'menu_position' => 4,
			'show_ui'       => true,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' )
		);

		return $posttypes;
	}

	public function insight_taxonomy() {

		if ( empty( $taxonomy ) ) {
			$taxonomy = array();
		}

		// Gallery category
		$taxonomy['ic_gallery_category'] = array(
			array( 'ic_gallery' ),
			array(
				'hierarchical' => false,
				'labels'       => array(
					'name'              => esc_html__( 'Gallery Categories', 'tm-9studio' ),
					'singular_name'     => esc_html__( 'Gallery Category', 'tm-9studio' ),
					'search_items'      => esc_html__( 'Search Gallery Categories', 'tm-9studio' ),
					'all_items'         => esc_html__( 'All Gallery Categories', 'tm-9studio' ),
					'parent_item'       => esc_html__( 'Parent Gallery Category', 'tm-9studio' ),
					'parent_item_colon' => esc_html__( 'Parent Gallery Category:', 'tm-9studio' ),
					'edit_item'         => esc_html__( 'Edit Gallery Category', 'tm-9studio' ),
					'update_item'       => esc_html__( 'Update Gallery Category', 'tm-9studio' ),
					'add_new_item'      => esc_html__( 'Add New Gallery Category', 'tm-9studio' ),
					'new_item_name'     => esc_html__( 'New Gallery Category Name', 'tm-9studio' ),
					'menu_name'         => esc_html__( 'Gallery Categories', 'tm-9studio' ),
				),
				'show_ui'      => true,
				'query_var'    => true,
			),
		);

		// Our team group
		$taxonomy['ic_our_team_group'] = array(
			array( 'ic_our_team' ),
			array(
				'hierarchical' => true,
				'labels'       => array(
					'name' => apply_filters( 'ic_our_team_group_name', esc_html__( 'Our Team Group', 'tm-9studio' ) ),
				),
				'show_ui'      => true,
				'query_var'    => true,
			)
		);

		// Project category
		$taxonomy['ic_project_category'] = array(
			array( 'ic_project' ),
			array(
				'hierarchical' => true,
				'labels'       => array(
					'name' => apply_filters( 'ic_project_category_name', esc_html__( 'Project Category', 'tm-9studio' ) ),
				),
				'show_ui'      => true,
				'query_var'    => true,
				'rewrite'      => array( 'slug' => apply_filters( 'ic_project_category_slug', 'project-category' ) ),
			)
		);

		return $taxonomy;
	}

}

new Insight_Posttypes;
