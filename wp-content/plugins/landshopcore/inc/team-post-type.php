<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * team: Custom Post Types
 *
 *
 */
class landshopcore_team_Post_Types {
	
	public function __construct()
	{
		$this->register_post_type();
	}

	public function register_post_type()
	{
		$args = array();	

		// team
		$args['team-type'] = array(
			'labels' => array(
				'name' => __( 'Team Members', 'landshopcore' ),
				'singular_name' => __( 'Team Members', 'landshopcore' ),
				'add_new' => __( 'Add team', 'landshopcore' ),
				'add_new_item' => __( 'Add team', 'landshopcore' ),
				'edit_item' => __( 'Edit team', 'landshopcore' ),
				'new_item' => __( 'New team', 'landshopcore' ),
				'view_item' => __( 'View team', 'landshopcore' ),
				'search_items' => __( 'Search Through team', 'landshopcore' ),
				'not_found' => __( 'No team found', 'landshopcore' ),
				'not_found_in_trash' => __( 'No team found in Trash', 'landshopcore' ),
				'parent_item_colon' => __( 'Parent team:', 'landshopcore' ),
				'menu_name' => __( 'Team Members', 'landshopcore' ),				
			),		  
			'hierarchical' => false,
	        'description' => __( 'Add a team Members', 'landshopcore' ),
	        'supports' => array( 'title', 'editor', 'thumbnail'),
	        'menu_icon' =>  'dashicons-businessperson',
	        'public' => true,
	        'publicly_queryable' => true,
	        'exclude_from_search' => false,
	        'query_var' => true,
	        'rewrite' => array( 'slug' => 'team' ),
	        // This is where we add taxonomies to our CPT
        	'taxonomies'          => array( 'team_category' ),
		);	

		// Register post type: name, arguments
		register_post_type('team', $args['team-type']);
	}
}

function landshopcore_team_types() { new landshopcore_team_Post_Types(); }

add_action( 'init', 'landshopcore_team_types' );

/*-----------------------------------------------------------------------------------*/
/*	Creating Custom Category 
/*-----------------------------------------------------------------------------------*/
// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'landshopcore_create_team_category', 0 );

// create two category, genres and writers for the post type "book"
function landshopcore_create_team_category() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name', 'landshopcore' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name', 'landshopcore' ),
		'search_items'      => __( 'Search Categories', 'landshopcore' ),
		'all_items'         => __( 'Categories', 'landshopcore' ),
		'parent_item'       => __( 'Parent Category', 'landshopcore' ),
		'parent_item_colon' => __( 'Parent Category:', 'landshopcore' ),
		'edit_item'         => __( 'Edit Category', 'landshopcore' ),
		'update_item'       => __( 'Update Category', 'landshopcore' ),
		'add_new_item'      => __( 'Add New Category', 'landshopcore' ),
		'new_item_name'     => __( 'New Category', 'landshopcore' ),
		'menu_name'         => __( 'Categories', 'landshopcore' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'team_category' ),
	);

	register_taxonomy( 'team_category', array( 'team' ), $args );
}