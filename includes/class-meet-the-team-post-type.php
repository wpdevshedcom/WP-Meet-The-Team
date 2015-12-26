<?php

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

if( ! class_exists( 'Meet_The_Team_Post_Type' ) ) :
	
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
			'name'               => _x( 'The Teams', 'post type general name', 'wp-meet-the-team' ),
			'singular_name'      => _x( 'The Team', 'post type singular name', 'wp-meet-the-team' ),
			'menu_name'          => _x( 'The Team', 'admin menu', 'wp-meet-the-team' ),
			'name_admin_bar'     => _x( 'The Team', 'add new on admin bar', 'wp-meet-the-team' ),
			'add_new'            => _x( 'Add New', 'add new title', 'wp-meet-the-team' ),
			'add_new_item'       => __( 'Add New Team Member', 'wp-meet-the-team' ),
			'new_item'           => __( 'New Team', 'wp-meet-the-team' ),
			'edit_item'          => __( 'Edit Team', 'wp-meet-the-team' ),
			'view_item'          => __( 'View Team', 'wp-meet-the-team' ),
			'all_items'          => __( 'People', 'wp-meet-the-team' ),
			'search_items'       => __( 'Search Teams', 'wp-meet-the-team' ),
			'parent_item_colon'  => __( 'Parent Teams:', 'wp-meet-the-team' ),
			'not_found'          => __( 'No teams found.', 'wp-meet-the-team' ),
			'not_found_in_trash' => __( 'No teams found in Trash.', 'wp-meet-the-team' )
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
	
endif;