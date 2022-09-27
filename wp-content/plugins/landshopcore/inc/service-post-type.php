<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Service: Custom Post Types
 *
 *
 */
class landshopcore_service_Post_Types {
	
	public function __construct()
	{
		$this->register_post_type();
	}

	public function register_post_type()
	{
		$args = array();	

		// service
		$args['service-type'] = array(
			'labels' => array(
				'name' => __( 'Services', 'landshopcore' ),
				'singular_name' => __( 'Service', 'landshopcore' ),
				'add_new' => __( 'Add service', 'landshopcore' ),
				'add_new_item' => __( 'Add service', 'landshopcore' ),
				'edit_item' => __( 'Edit service', 'landshopcore' ),
				'new_item' => __( 'New service', 'landshopcore' ),
				'view_item' => __( 'View service', 'landshopcore' ),
				'search_items' => __( 'Search Through service', 'landshopcore' ),
				'not_found' => __( 'No service found', 'landshopcore' ),
				'not_found_in_trash' => __( 'No service found in Trash', 'landshopcore' ),
				'parent_item_colon' => __( 'Parent service:', 'landshopcore' ),
				'menu_name' => __( 'Services', 'landshopcore' ),				
			),		  
			'hierarchical' => false,
	        'description' => __( 'Add a service item', 'landshopcore' ),
	        'supports' => array( 'title', 'editor', 'thumbnail'),
	        'menu_icon' =>  'dashicons-clipboard',
	        'public' => true,
	        'publicly_queryable' => true,
	        'exclude_from_search' => false,
	        'query_var' => true,
	        'rewrite' => array( 'slug' => 'service' ),
	        // This is where we add taxonomies to our CPT
        	'taxonomies'          => array( 'service_category' ),
		);	

		// Register post type: name, arguments
		register_post_type('service', $args['service-type']);
	}
}

function landshopcore_service_types() { new landshopcore_service_Post_Types(); }

add_action( 'init', 'landshopcore_service_types' );

/*-----------------------------------------------------------------------------------*/
/*	Creating Custom Category 
/*-----------------------------------------------------------------------------------*/
// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'landshopcore_create_service_category', 0 );

// create two category, genres and writers for the post type "book"
function landshopcore_create_service_category() {
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
		'rewrite'           => array( 'slug' => 'service_category' ),
	);

	register_taxonomy( 'service_category', array( 'service' ), $args );
}