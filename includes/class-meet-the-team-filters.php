<?php

if( ! class_exists( 'Meet_The_Team_Filters' ) ) {
	class Meet_The_Team_Filters {
		
		function __construct() {
			add_filter( 'body_class', array( $this, 'meet_the_team_body_class' ) );
			add_filter( 'single_template', array( $this, 'get_custom_post_type_template' ), 20 );
			add_filter( 'the_content', array( $this, 'meet_the_team_the_content' ) );
			add_filter( 'loop_columns', array( $this, 'meet_the_team_loop_columns' ) );
			add_filter( 'meet_the_team_people_loop_item_thumbnail_size', array( $this, 'meet_the_team_people_loop_thumbnail_size' ) );
			
			add_filter( 'enter_title_here', array( $this, 'meet_the_team_change_title_text' ) );
		}
		
		// Add specific CSS class by filter
		function meet_the_team_body_class( $classes ) {
			global $post;
			
			if( has_shortcode( $post->post_content, 'team' ) )
				$classes[] = 'meet-the-team';
			
			if( has_shortcode( $post->post_content, 'people' ) )
				$classes[] = 'meet-the-team-single-item';
			
			// return the $classes array
			return $classes;
		}
		
		function meet_the_team_the_content( $content ) {
			
			global $post;
			
			$people_content = '';

			if ( is_single() && $post->post_type == 'people' ) {
				
				$people_content = get_meet_the_team_template_part( 'content', 'single-people' );
				
				return $people_content . $content;
				
			}
			
			return $content;
			
		}
		
		function get_custom_post_type_template( $single_template ) {
			global $post;

			$page_template = get_post_meta( $post->ID, '_wp_page_template', true );
			
			if ( $page_template && $post->post_type == 'people' ) {
				//$single_template = locate_meet_the_team_template( 'single-people.php' );
				$single_template = get_stylesheet_directory() . "/{$page_template}";
			}
			
			return $single_template;
		}
		
		/*
		 * @desc	Filter the number of people item to display
		 * @default 3
		 */
		function meet_the_team_loop_columns() {
			
			$number_column = get_theme_mod( 'meet_the_team_customizer_column' );
			
			if( $number_column )
				return $number_column;
			else
				return 3;
			
		}
		
		/*
		 * @desc	Filter the thumbnail size in people loop
		 * @default 'thumbnail'
		 */
		function meet_the_team_people_loop_thumbnail_size() {
			
			if( is_single() ) {
				return 'thumbnail';
			} else {
				$thumbnail_size = '';
				$number_column = get_theme_mod( 'meet_the_team_customizer_column' );
				
				
				if( 1 == $number_column ) {
					$thumbnail_size = 'full';
				} else if( 2 == $number_column ) {
					$thumbnail_size = 'large';
				} else if( 3 == $number_column ) {
					$thumbnail_size = 'medium';
				} else {
					$thumbnail_size = 'thumbnail';
				}
				
				return $thumbnail_size;
			}
		}
		
		
		function meet_the_team_change_title_text( $title ){
			$screen = get_current_screen();

			if  ( 'people' == $screen->post_type ) {
				$title = 'Enter name here';
			}

			return $title;
		}

		

		

	}
	
	new Meet_The_Team_Filters();
}