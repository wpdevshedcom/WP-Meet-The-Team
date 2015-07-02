<?php

if( ! class_exists( 'Meet_The_Team_Post_Type' ) ) {
	class Meet_The_Team_Post_Type {
		
		/**
		 * Constructor
		 */
		function __construct() {
			add_action( 'init', array( $this, 'meet_the_team_register_post_types' ), 0 );
		}
		
		/**
		 * Register a team post type.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/register_post_type
		 */
		function meet_the_team_register_post_types() {
			if ( post_type_exists( "people" ) )
				return;
			
			$labels = array(
				'name'               => _x( 'The Teams', 'post type general name', MTT_DOMAIN_NAME ),
				'singular_name'      => _x( 'The Team', 'post type singular name', MTT_DOMAIN_NAME ),
				'menu_name'          => _x( 'The Team', 'admin menu', MTT_DOMAIN_NAME ),
				'name_admin_bar'     => _x( 'The Team', 'add new on admin bar', MTT_DOMAIN_NAME ),
				'add_new'            => _x( 'Add New', 'add new title', MTT_DOMAIN_NAME ),
				'add_new_item'       => __( 'Add New Team Member', MTT_DOMAIN_NAME ),
				'new_item'           => __( 'New Team', MTT_DOMAIN_NAME ),
				'edit_item'          => __( 'Edit Team', MTT_DOMAIN_NAME ),
				'view_item'          => __( 'View Team', MTT_DOMAIN_NAME ),
				'all_items'          => __( 'People', MTT_DOMAIN_NAME ),
				'search_items'       => __( 'Search Teams', MTT_DOMAIN_NAME ),
				'parent_item_colon'  => __( 'Parent Teams:', MTT_DOMAIN_NAME ),
				'not_found'          => __( 'No teams found.', MTT_DOMAIN_NAME ),
				'not_found_in_trash' => __( 'No teams found in Trash.', MTT_DOMAIN_NAME )
			);

			$args = array(
				'labels'             => $labels,
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'team' ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => null,
				'supports'           => array( 'title', 'editor', 'author', 'thumbnail' ),
				'menu_icon'			 => 'dashicons-admin-users'
			);

			register_post_type( 'people', $args );
		}
		
		function meet_the_theme_rewrite_flush() {
			// First, we "add" the custom post type via the above written function.
			// Note: "add" is written with quotes, as CPTs don't get added to the DB,
			// They are only referenced in the post_type column with a post entry, 
			// when you add a post of this CPT.
			$this->meet_the_team_register_post_types();

			// ATTENTION: This is *only* done during plugin activation hook in this example!
			// You should *NEVER EVER* do this on every page load!!
			flush_rewrite_rules();
		}
		
	}
	
}