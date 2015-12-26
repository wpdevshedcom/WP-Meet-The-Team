<?php

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly


if( ! class_exists( 'Meet_The_Team_Query' ) ) :
	
class Meet_The_Team_Query extends WP_Query {
	
	function __construct( $args = array() ) {
		
		$defaults = array(
			'post_type' 		=> 'people',
			'posts_per_page' 	=> -1
		);
		
		/**
		 * Parse incoming $args into an array and merge it with $defaults
		 */ 
		$args = wp_parse_args( $args, $defaults );
		
		$the_query = parent::__construct( $args );
		
		return $the_query;
	}
	
}
	
endif;