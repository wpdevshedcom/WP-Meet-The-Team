<?php
/**
 * Plugin Name: WP Meet The Team
 * Plugin URI: http://wpdevshed.com/
 * Description: Create and provide clean beatifull shortcode.
 * Version: 1.0
 * Author: WP Dev Shed
 * Author URI: http://wpdevshed.com/
 * Requires at least: 4.1
 * Tested up to: 4.4
 * License: GPL2
 *
 * Text Domain: wp-meet-the-team
 * Domain Path: /languages
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Check if class already exist
if( ! class_exists('WP_Meet_The_Team')) :

/**
 * Main Meet The Team
 *
 * @class WP_Meet_The_Team
 * @version	1.0
 */
final class WP_Meet_The_Team {
	
	/**
	 * @var WP_Image_Embeds The single instance of the class
	 * @since 2.1
	 */
	protected static $_instance = null;
	
	/**
	 * Main WP_Image_Embeds Instance
	 *
	 * Ensures only one instance of WP_Image_Embeds is loaded or can be loaded.
	 *
	 * @since 2.1
	 * @static
	 * @see WC()
	 * @return WP_Image_Embeds - Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	/**
	 * Cloning is forbidden.
	 * @since  1.0
	 * @access public
	 * @return void
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'wp-image-embeds' ), '1.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 * @since  1.0
	 * @access public
	 * @return void
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'wp-image-embeds' ), '1.0' );
	}

	/**
	 * Magic method to prevent a fatal error when calling a method that doesn't exist.
	 *
	 * @since  1.0
	 * @access public
	 * @return void
	 */
	public function __call( $method = '', $args = array() ) {
		_doing_it_wrong( "WP_Image_Embeds::{$method}", __( 'Method does not exist.', 'wp-image-embeds' ), '1.0' );
		unset( $method, $args );
		
		return null;
	}
	
	/**
	 * @desc	Construct the plugin object
	 */
	public function __construct()
	{
		$this->define_constants();
		$this->includes();
		$this->init_hooks();
	}
	
	/**
	 * Define Constants
	 */
	private function define_constants() {
		$this->define( 'MTT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		$this->define( 'MTT_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
		$this->define( 'MTT_CSS_DIR', MTT_PLUGIN_URL .'assets/css' );
		$this->define( 'MTT_JS_DIR', MTT_PLUGIN_URL .'assets/js' );
		$this->define( 'MTT_INC_PATH', MTT_PLUGIN_PATH .'includes' );
		$this->define( 'MTT_LIB_PATH', MTT_PLUGIN_PATH .'library' );
	}
	
	/**
	 * Define constant if not already set
	 * @param  string $name
	 * @param  string|bool $value
	 */
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}
	
	/**
	 * Include required core files used in admin and on the frontend.
	 */
	public function includes() {
		include_once( MTT_INC_PATH . '/class-meet-the-team-post-type.php' );
		include_once( MTT_INC_PATH . '/class-meet-the-team-filters.php' );
		include_once( MTT_INC_PATH . '/class-meet-the-team-actions.php' );
		include_once( MTT_INC_PATH . '/class-meet-the-team-query.php' );
		include_once( MTT_INC_PATH . '/class-meet-the-team-shortcodes.php' );
	}
	
	
	/**
	 * Hook into actions and filters
	 * @since  1.0
	 */
	private function init_hooks() {
		// Init classes
		$this->post_types = new Meet_The_Team_Post_Type();
		
		// Actions
		add_action( 'init', array( $this->post_types, 'meet_the_team_register_post_types' ) );
		add_action( 'init', array( $this, 'meet_the_team_init' ) );
		add_action( 'after_setup_theme', array( $this, 'meet_the_team_template_functions' ), 12 );
		add_action( 'wp_enqueue_scripts', array( $this, 'meet_the_team_enqueue_styles_scripts' ) );
		
		register_activation_hook( __FILE__, array( $this->post_types, 'meet_the_theme_rewrite_flush' ) );
	}
	
	
	public function meet_the_team_init() {
		wp_register_style( 'meet-the-team-style', MTT_CSS_DIR . '/meet-the-team.css', false, '1.0', 'all' );
		wp_register_style( 'meet-the-team-layout-style', MTT_CSS_DIR . '/meet-the-team-layout.css', false, '1.0', 'all' );
		
		// font awesome
		wp_register_style( 'meet-the-team-font-awesome-style', MTT_CSS_DIR . '/font-awesome.min.css', false, '4.3.0', 'all' );
	}
	
	public function meet_the_team_enqueue_styles_scripts() {
		wp_enqueue_style( 'meet-the-team-style' );
		wp_enqueue_style( 'meet-the-team-layout-style' );
		
		// font awesome
		wp_enqueue_style( 'meet-the-team-font-awesome-style' );
	}
	
	public function meet_the_team_template_functions() {
		include( MTT_INC_PATH . '/meet-the-team-template.php' );
	}
	
}
	
endif;

/**
 * Returns the main instance of WPIE to prevent the need to use globals.
 *
 * @since  1.0
 * @return WP_Image_Embeds
 */
function Meet_The_Team() {
	return WP_Meet_The_Team::instance();
}

// Global for backwards compatibility.
$GLOBALS['meet_the_team'] = Meet_The_Team();