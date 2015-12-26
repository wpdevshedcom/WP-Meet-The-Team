<?php

/**
 * Meet_The_Team_Shortcodes class.
 *
 * @class 		Meet_The_Team_Shortcodes
 * @version		1.0
 * @author 		Ryan Sutana
 */
 
if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly
 
// Check if class already exist
if( ! class_exists('Meet_The_Team_Shortcodes')) :
	
class Meet_The_Team_Shortcodes {
	
	/**
	 * Init shortcodes
	 */
	public function __construct() {
		// Define shortcodes
		$shortcodes = array(
			'team' 		=> __CLASS__ . '::team',
			'people' 	=> __CLASS__ . '::people'
		);
		
		foreach ( $shortcodes as $shortcode => $function ) {
			add_shortcode( apply_filters( "meet_the_team_{$shortcode}_shortcode_tag", $shortcode ), $function );
		}
	}
	
	public static function team( $atts ) {
		extract( shortcode_atts( array(
			'column' => '4'
		), $atts ) );
		
		ob_start();
		
		// Get Order from Customizer
		$orderby = get_option( 'meet_the_team_customizer_order', 'title' );
		
		$args = array(
			'order'		=> 'ASC',
			'orderby'	=> $orderby
		);
		
		// query lists of people
		$peoples = new Meet_The_Team_Query( $args );
		
		get_meet_the_team_template( 'meet-the-team-item-start.php' );
			// The Loop
			if ( $peoples->have_posts() ) {
			
				while ( $peoples->have_posts() ) { $peoples->the_post();
					get_meet_the_team_template_part( 'content', 'people' );
				}
				
			} else {
				// no posts found
				get_meet_the_team_template_part( 'content', 'no-team-found' );
			}

			/* Restore original Post Data */
			wp_reset_postdata();

		get_meet_the_team_template( 'meet-the-team-item-end.php' );
		
		
		return ob_get_clean();
	}
	
	public function people( $atts ) {
		extract( shortcode_atts( array(
			'id' => ''
		), $atts ) );
		
		ob_start();
		
		$args = array(
			'page_id' => $id
		);
		
		// query lists of people
		$peoples = new Meet_The_Team_Query( $args );
		
		get_meet_the_team_template( 'meet-the-team-item-start.php' );
			// The Loop
			if ( $peoples->have_posts() ) {
			
				while ( $peoples->have_posts() ) { $peoples->the_post();
					get_meet_the_team_template_part( 'content-single', 'people' );
				}
				
			} else {
				// no posts found
				get_meet_the_team_template_part( 'content', 'no-team-found' );
			}

			/* Restore original Post Data */
			wp_reset_postdata();

		get_meet_the_team_template( 'meet-the-team-item-end.php' );
		
		
		return ob_get_clean();
	}
	
}

return new Meet_The_Team_Shortcodes();
	
endif;
// end if checking class Meet_The_Team_Shortcodes() not exist