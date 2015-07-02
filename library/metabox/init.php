<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */
 
if ( file_exists( dirname( __FILE__ ) . '/meta/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/meta/init.php';
}
 
/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb_box parameter
 *
 * @param  CMB object $cmb CMB2 object
 *
 * @return bool             True if metabox should show
 */
function meet_the_team_theme_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's the front page template
	if ( $cmb->object_id !== get_option( 'page_on_front' ) ) {
		return false;
	}
	
	return true;
}

/**
 * Conditionally displays a message if the $post_id is 2
 *
 * @param  array             $field_args Array of field parameters
 * @param  CMB2_Field object $field      Field object
 */
function meet_the_team_before_row_if_2( $field_args, $field ) {
	if ( 2 == $field->object_id ) {
		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
	} else {
		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
	}
}


add_action( 'cmb2_init', 'meet_the_team_register_user_profile_metabox' );
/**
 * Hook in and add a metabox to add fields to the user profile pages
 */
function meet_the_team_register_user_profile_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_meet_the_team_';

	$templates = wp_get_theme()->get_page_templates();
	$post_template = array();
	
	foreach ( $templates as $template_name => $template_filename ) {
		$post_template[$template_name] = $template_filename;
	}
	
	/**
	 * Metabox for the user profile screen
	 */
	$cmb_people = new_cmb2_box( array(
		'id'               => $prefix . 'edit',
		'title'            => __( 'Team Metabox', 'cmb2' ),
		'object_types'     => array( 'people' ), // Tells CMB2 to use user_meta vs post_meta
		'show_names'       => true,
		'new_user_section' => 'add-new-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
	) );
	
		$cmb_people->add_field( array(
			'name'    => __( 'Job Title', 'cmb2' ),
			'desc'    => __( 'Your current job title.', 'cmb2' ),
			'id'      => $prefix . 'job_title',
			'type'    => 'text',
		) );
		
		$cmb_people->add_field( array(
			'name' => __( 'Email', 'cmb2' ),
			'desc' => __( 'Your primary email address.', 'cmb2' ),
			'id'   => $prefix . 'email',
			'type' => 'text_email',
		) );
		
		$cmb_people->add_field( array(
			'name' => __( 'Phone Number ', 'cmb2' ),
			'desc' => __( 'Your primary phone number.', 'cmb2' ),
			'id'   => $prefix . 'phone_number',
			'type' => 'text',
		) );
		
		
		$cmb_people->add_field( array(
			'name' => __( 'Social Media Profile', 'cmb2' ),
			'desc' => __( 'Add your social profile here if any.', 'cmb2' ),
			'id'   => $prefix . 'title',
			'type' => 'title',
		) );
		
			$cmb_people->add_field( array(
				'name'    => __( 'Facebook Username', 'cmb2' ),
				'desc'    => __( '', 'cmb2' ),
				'id'      => $prefix . 'facebook_username',
				'type'    => 'text',
			) );
			
			$cmb_people->add_field( array(
				'name'    => __( 'Twitter Username', 'cmb2' ),
				'desc'    => __( '', 'cmb2' ),
				'id'      => $prefix . 'twitter_username',
				'type'    => 'text',
			) );
			
			$cmb_people->add_field( array(
				'name'    => __( 'LinkedIn URL', 'cmb2' ),
				'desc'    => __( '', 'cmb2' ),
				'id'      => $prefix . 'linkedin_url',
				'type'    => 'text_url',
			) );
			
			$cmb_people->add_field( array(
				'name'    => __( 'Instagram Username', 'cmb2' ),
				'desc'    => __( '', 'cmb2' ),
				'id'      => $prefix . 'instagram_username',
				'type'    => 'text',
			) );
			
			$cmb_people->add_field( array(
				'name'    => __( 'Google+ URL', 'cmb2' ),
				'desc'    => __( '', 'cmb2' ),
				'id'      => $prefix . 'googleplus_url',
				'type'    => 'text_url',
			) );
			
	/**
	 * Metabox for the user profile screen
	 */
	$cmb_page_template = new_cmb2_box( array(
		'id'               => $prefix . 'page-template',
		'title'            => __( 'Page Templages', 'cmb2' ),
		'object_types'     => array( 'people' ), // Tells CMB2 to use user_meta vs post_meta
		'show_names'       => true,
		'new_user_section' => 'add-new-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
	) );
		
		$cmb_page_template->add_field( array(
			'name'             => __( 'Template', 'cmb2' ),
			'desc'             => __( 'Choose your layout in the box above.', 'cmb2' ),
			'id'               => '_wp_page_template',
			'type'             => 'select',
			'show_option_none' => true,
			'options'          => $post_template
		) );
	
}