<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Case Studie: Custom Post Types
 *
 *
 */
class landshopcore_case_studie_Post_Types {
	
	public function __construct()
	{
		$this->register_post_type();
	}

	public function register_post_type()
	{
		$args = array();	

		// Case Studie
		$args['case-studie-type'] = array(
			'labels' => array(
				'name' => __( 'Case Studies', 'landshopcore' ),
				'singular_name' => __( 'Case Studie', 'landshopcore' ),
				'add_new' => __( 'Add Case Studie', 'landshopcore' ),
				'add_new_item' => __( 'Add Case Studie', 'landshopcore' ),
				'edit_item' => __( 'Edit Case Studie', 'landshopcore' ),
				'new_item' => __( 'New Case Studie', 'landshopcore' ),
				'view_item' => __( 'View Case Studie', 'landshopcore' ),
				'search_items' => __( 'Search Through Case Studie', 'landshopcore' ),
				'not_found' => __( 'No Case Studie found', 'landshopcore' ),
				'not_found_in_trash' => __( 'No Case Studie found in Trash', 'landshopcore' ),
				'parent_item_colon' => __( 'Parent Case Studie:', 'landshopcore' ),
				'menu_name' => __( 'Case Studies', 'landshopcore' ),				
			),		  
			'hierarchical' => false,
	        'description' => __( 'Add a Case Studie item', 'landshopcore' ),
	        'supports' => array( 'title', 'editor', 'thumbnail'),
	        'menu_icon' =>  'dashicons-analytics',
	        'public' => true,
	        'publicly_queryable' => true,
	        'exclude_from_search' => false,
	        'query_var' => true,
	        'rewrite' => array( 'slug' => 'case-studie' ),
	        // This is where we add taxonomies to our CPT
        	'taxonomies' => array( 'case-studie-category' ),
		);	

		// Register post type: name, arguments
		register_post_type('case-studie', $args['case-studie-type']);
	}
}

function landshopcore_case_studie_types() { new landshopcore_case_studie_Post_Types(); }

add_action( 'init', 'landshopcore_case_studie_types' );

/*-----------------------------------------------------------------------------------*/
/*	Creating Custom Category 
/*-----------------------------------------------------------------------------------*/
// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'landshopcore_create_case_studie_category', 0 );

// create two category, genres and writers for the post type "book"
function landshopcore_create_case_studie_category() {
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
		'rewrite'           => array( 'slug' => 'case-studie-category' ),
	);

	register_taxonomy( 'case-studie-category', array( 'case-studie' ), $args );
}