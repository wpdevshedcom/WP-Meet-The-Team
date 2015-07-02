<?php
/**
 * Plugin Name: WP Meet The Team
 * Plugin URI: http://wpdevshed.com/
 * Description: Create and provide clean beatifull shortcode.
 * Version: 1.0
 * Author: WP Dev Shed
 * Author URI: http://wpdevshed.com/
 * License: GPL2
 */

 /*  Copyright 2014  Ryan Sutana  (email : ryansutana2010@gmail.com)
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Check if class already exist
if( ! class_exists('WP_Meet_The_Team'))
{
	class WP_Meet_The_Team
	{
		/**
		 * @desc	Construct the plugin object
		 */
		public function __construct()
		{
			// define constants
			define( 'MTT_DOMAIN_NAME', 'wp-meet-the-team' );
			define( 'MTT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
			define( 'MTT_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
			define( 'MTT_CSS_DIR', MTT_PLUGIN_URL .'assets/css' );
			define( 'MTT_JS_DIR', MTT_PLUGIN_URL .'assets/js' );
			define( 'MTT_INC_PATH', MTT_PLUGIN_PATH .'includes' );
			define( 'MTT_LIB_PATH', MTT_PLUGIN_PATH .'library' );
			
			// Includes
			include_once( MTT_LIB_PATH . '/metabox/init.php' );
			include_once( MTT_INC_PATH . '/class-meet-the-team-post-type.php' );
			include_once( MTT_INC_PATH . '/class-meet-the-team-filters.php' );
			include_once( MTT_INC_PATH . '/class-meet-the-team-actions.php' );
			include_once( MTT_INC_PATH . '/class-meet-the-team-query.php' );
			include_once( MTT_INC_PATH . '/class-meet-the-team-shortcodes.php' );
			include_once( MTT_INC_PATH . '/class-meet-the-team-customizer.php' );
			
			// Init classes
			$this->post_types = new Meet_The_Team_Post_Type();
			
			// Actions
			add_action( 'init', array( $this, 'meet_the_team_init' ) );
			add_action( 'init', array( $this->post_types, 'meet_the_team_register_post_types' ) );
			add_action( 'after_setup_theme', array( $this, 'meet_the_team_template_functions' ), 12 );
			add_action( 'wp_enqueue_scripts', array( $this, 'meet_the_team_enqueue_styles_scripts' ) );
			
			register_activation_hook( __FILE__, array( $this->post_types, 'meet_the_theme_rewrite_flush' ) );
		}
		
		function meet_the_team_init() {
			wp_register_style( 'meet-the-team-style', MTT_CSS_DIR . '/meet-the-team.css', false, '1.0', 'all' );
			wp_register_style( 'meet-the-team-layout-style', MTT_CSS_DIR . '/meet-the-team-layout.css', false, '1.0', 'all' );
			
			// font awesome
			wp_register_style( 'meet-the-team-font-awesome-style', MTT_CSS_DIR . '/font-awesome.min.css', false, '4.3.0', 'all' );
		}
		
		function meet_the_team_enqueue_styles_scripts() {
			wp_enqueue_style( 'meet-the-team-style' );
			wp_enqueue_style( 'meet-the-team-layout-style' );
			
			// font awesome
			wp_enqueue_style( 'meet-the-team-font-awesome-style' );
		}
		
		function meet_the_team_template_functions() {
			include( MTT_INC_PATH . '/meet-the-team-template.php' );
		}
		
	}
	
	$GLOBALS['meet_the_team'] = new WP_Meet_The_Team();
}
