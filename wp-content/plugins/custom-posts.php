<?php
/*
Plugin Name: Custom Posts
Description: Used to add custom post types for an easy-to-manage portfolio. This plugin is required with this theme.
*/

/* Projects */
add_action( 'init', 'create_post_type' );
function create_post_type() {
    
	register_post_type( 'projects',
		array(
        'labels' => array(
            'name' => __( 'Projects' ),
            'singular_name' => __( 'Project' ),
            'add_new_item' => __('Add New Project'),
            'add_new' => _x('Add New Project', 'post'),
            'edit_item' => __('Edit Project'),
            'new_item' => __('New Project'),
            'all_items' => __('All Projects'),
            'view_item' => __('View Project'),
            'search_items' => __('Search Projects'),
            'not_found' =>  __('No Projects Found'),
            'not_found_in_trash' => __('No Projects found in trash'),
            'parent_item_colon' => '',
            'menu_name' => 'Portfolio'
        ),
        'supports' => array('title', 'thumbnail'),
		'public' => true,
		'has_archive' => true
		)
	);
    
    register_post_type( 'services',
		array(
        'labels' => array(
            'name' => __( 'Services' ),
            'singular_name' => __( 'Slide' ),
            'add_new_item' => __('Add New Slide'),
            'add_new' => _x('Add New Slide', 'post'),
            'edit_item' => __('Edit Slide'),
            'new_item' => __('New Slide'),
            'all_items' => __('All Slides'),
            'view_item' => __('View Slide'),
            'search_items' => __('Search Slides'),
            'not_found' =>  __('No Slides Found'),
            'not_found_in_trash' => __('No Slides found in trash'),
            'parent_item_colon' => '',
            'menu_name' => 'Services'
        ),
        'supports' => array('title', 'thumbnail'),
		'public' => true,
		'has_archive' => true
		)
	);
    
    register_post_type( 'clients',
		array(
        'labels' => array(
            'name' => __( 'Clients' ),
            'singular_name' => __( 'Client' ),
            'add_new_item' => __('Add New Client'),
            'add_new' => _x('Add New Client', 'post'),
            'edit_item' => __('Edit Client'),
            'new_item' => __('New Client'),
            'all_items' => __('All Clients'),
            'view_item' => __('View Client'),
            'search_items' => __('Search Clients'),
            'not_found' =>  __('No Clients Found'),
            'not_found_in_trash' => __('No Clients found in trash'),
            'parent_item_colon' => '',
            'menu_name' => 'Clients'
        ),
        'supports' => array('title', 'thumbnail'),
		'public' => true,
		'has_archive' => true
		)
	);
    
    register_post_type( 'theme_options',
		array(
        'labels' => array(
            'name' => __( 'Theme Options' ),
            'singular_name' => __( 'Theme Option' ),
            'add_new_item' => __('Add New Option'),
            'add_new' => _x('Add New Option', 'post'),
            'edit_item' => __('Edit Option'),
            'new_item' => __('New Option'),
            'all_items' => __('All Options'),
            'view_item' => __('View Option'),
            'search_items' => __('Search Options'),
            'not_found' =>  __('No Options Found'),
            'not_found_in_trash' => __('No Options found in trash'),
            'parent_item_colon' => '',
            'menu_name' => 'Theme Options'
        ),
        'supports' => array('title', 'thumbnail'),
		'public' => true,
		'has_archive' => true
		)
	);
    
}
        
?>