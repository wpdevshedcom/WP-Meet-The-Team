<?php
/**
 * Template Functions
 *
 * Template functions specifically created for wp meet the team
 *
 * @author 		Ryan Sutana
 * @category 	Core
 * @package 	Meet The Team/Template
 * @version     1.20.0
 */

/**
 * Get and include template files.
 *
 * @param mixed $template_name
 * @param array $args (default: array())
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return void
 */
function get_meet_the_team_template( $template_name, $args = array(), $template_path = 'meet_the_team', $default_path = '' ) {
	if ( $args && is_array( $args ) ) {
		extract( $args );
	}
	
	include( locate_meet_the_team_template( $template_name, $template_path, $default_path ) );
}

/**
 * Locate a template and return the path for inclusion.
 *
 * This is the load order:
 *
 *		yourtheme		/	$template_path	/	$template_name
 *		yourtheme		/	$template_name
 *		$default_path	/	$template_name
 *
 * @param string $template_name
 * @param string $template_path (default: 'meet_the_team')
 * @param string|bool $default_path (default: '') False to not load a default
 * @return string
 */
function locate_meet_the_team_template( $template_name, $template_path = 'meet_the_team', $default_path = '' ) {
	// Look within passed path within the theme - this is priority
	$template = locate_template(
		array(
			trailingslashit( $template_path ) . $template_name,
			$template_name
		)
	);

	// Get default template
	if ( ! $template && $default_path !== false ) {
		$default_path = $default_path ? $default_path : MTT_PLUGIN_PATH . '/templates/';
		
		if ( file_exists( trailingslashit( $default_path ) . $template_name ) ) {
			$template = trailingslashit( $default_path ) . $template_name;
		}
	}

	// Return what we found
	return apply_filters( 'meet_the_team_locate_template', $template, $template_name, $template_path );
}

/**
 * Get template part (for templates in loops).
 *
 * @param string $slug
 * @param string $name (default: '')
 * @param string $template_path (default: 'meet_the_team')
 * @param string|bool $default_path (default: '') False to not load a default
 */
function get_meet_the_team_template_part( $slug, $name = '', $template_path = 'meet_the_team', $default_path = '' ) {
	$template = '';

	if ( $name ) {
		$template = locate_meet_the_team_template( "{$slug}-{$name}.php", $template_path, $default_path );
	}

	// If template file doesn't exist, look in yourtheme/slug.php and yourtheme/meet_the_team/slug.php
	if ( ! $template ) {
		$template = locate_meet_the_team_template( "{$slug}.php", $template_path, $default_path );
	}

	if ( $template ) {
		load_template( $template, false );
	}
}