<?php
/* Fire our meta box setup function on the post editor screen. */
add_action( 'load-post.php', 'wpmtt_post_meta_boxes_setup' );
add_action( 'load-post-new.php', 'wpmtt_post_meta_boxes_setup' );

/* Meta box setup function. */
function wpmtt_post_meta_boxes_setup() {
	/* Add meta boxes on the 'add_meta_boxes' hook. */
	add_action( 'add_meta_boxes', 'wpmtt_add_post_meta_boxes' );
	
	/* Save post meta on the 'save_post' hook. */
	add_action( 'save_post', 'wpmtt_save_meta_box_data' );
}

/* Create one or more meta boxes to be displayed on the post editor screen. */
function wpmtt_add_post_meta_boxes() {
	$screens = array( 'people' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'wpmtt_sectionid',
			__( 'Meet The Team', 'wp-meet-the-team' ),
			'wpmtt_meta_box_callback',
			$screen
		);
		
		add_meta_box(
			'wpmtt_page_templae',
			__( 'Page Templates', 'wp-meet-the-team' ),
			'wpmtt_page_template_meta_box_callback',
			$screen,
			'side'
		);
		
	}
}


/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function wpmtt_meta_box_callback( $post ) {

	// Add a nonce field so we can check for it later.
	wp_nonce_field( 'wpmtt_save_meta_box_data', '_cmb_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$job_title 		= get_post_meta( $post->ID, '_meet_the_team_job_title', true );
	$email 			= get_post_meta( $post->ID, '_meet_the_team_email', true );
	$phone_number 	= get_post_meta( $post->ID, '_meet_the_team_phone_number', true );
	
	$facebook_username 	= get_post_meta( $post->ID, '_meet_the_team_facebook_username', true );
	$twitter_username 	= get_post_meta( $post->ID, '_meet_the_team_twitter_username', true );
	$linkedin_url 		= get_post_meta( $post->ID, '_meet_the_team_linkedin_url', true );
	$instagram_username = get_post_meta( $post->ID, '_meet_the_team_instagram_username', true );
	$googleplus_url 	= get_post_meta( $post->ID, '_meet_the_team_googleplus_url', true );
	
	?>
	
	<div class="cmb2-wrap form-table">
		<div id="cmb2-metabox-_meet_the_team_edit" class="cmb2-metabox cmb-field-list">
			
			<div class="cmb-row cmb-type-text cmb2-id--meet-the-team-job-title table-layout">
				<div class="cmb-th"><label for="_meet_the_team_job_title"><?php _e( 'Job Title', 'wp-meet-the-team' ); ?></label></div>
				<div class="cmb-td">
					<input type="text" class="regular-text" name="_meet_the_team_job_title" id="_meet_the_team_job_title" value="<?php echo esc_attr( $job_title ); ?>" />
					<p class="cmb2-metabox-description"><?php _e( 'Your current job title', 'wp-meet-the-team' ); ?>.</p>
				</div>
			</div>
			
			<div class="cmb-row cmb-type-text-email cmb2-id--meet-the-team-email">
				<div class="cmb-th"><label for="_meet_the_team_email"><?php _e( 'Email', 'wp-meet-the-team' ); ?></label></div>
				<div class="cmb-td">
					<p class="cmb2-metabox-description"><?php _e( 'Your primary email address', 'wp-meet-the-team' ); ?>.</p>
					<input type="email" class="regular-text" name="_meet_the_team_email" id="_meet_the_team_email" value="<?php echo esc_attr( $email ); ?>" />
				</div>
			</div>
			
			
			<div class="cmb-row cmb-type-text cmb2-id--meet-the-team-phone-number table-layout">
				<div class="cmb-th"><label for="_meet_the_team_phone_number"><?php _e( 'Phone Number', 'wp-meet-the-team' ); ?> </label></div>
				<div class="cmb-td">
					<input type="text" class="regular-text" name="_meet_the_team_phone_number" id="_meet_the_team_phone_number" value="<?php echo esc_attr( $phone_number ); ?>" />
					<p class="cmb2-metabox-description"><?php _e( 'Your primary phone number', 'wp-meet-the-team' ); ?>.</p>
				</div>
			</div>

			<div class="cmb-row cmb-type-title cmb2-id--meet-the-team-title">
				<div class="cmb-td">
			<h5 class="cmb2-metabox-title"><?php _e( 'Social Media Profile', 'wp-meet-the-team' ); ?></h5>
			<p class="cmb2-metabox-description"><?php _e( 'Add your social profile here if any', 'wp-meet-the-team' ); ?>.</p>

				</div>
			</div>

			<div class="cmb-row cmb-type-text cmb2-id--meet-the-team-facebook-username table-layout">
				<div class="cmb-th"><label for="_meet_the_team_facebook_username"><?php _e( 'Facebook Username', 'wp-meet-the-team' ); ?></label></div>
				<div class="cmb-td">
					<input type="text" class="regular-text" name="_meet_the_team_facebook_username" id="_meet_the_team_facebook_username" value="<?php echo esc_attr( $facebook_username ); ?>" />
				</div>
			</div>

			<div class="cmb-row cmb-type-text cmb2-id--meet-the-team-twitter-username table-layout">
				<div class="cmb-th"><label for="_meet_the_team_twitter_username"><?php _e( 'Twitter Username', 'wp-meet-the-team' ); ?></label></div>
				<div class="cmb-td">
					<input type="text" class="regular-text" name="_meet_the_team_twitter_username" id="_meet_the_team_twitter_username" value="<?php echo esc_attr( $twitter_username ); ?>" />
				</div>
			</div>

			<div class="cmb-row cmb-type-text-url cmb2-id--meet-the-team-linkedin-url table-layout">
				<div class="cmb-th"><label for="_meet_the_team_linkedin_url"><?php _e( 'LinkedIn URL', 'wp-meet-the-team' ); ?>, </label></div>
				<div class="cmb-td">
					<input type="text" class="regular-text" name="_meet_the_team_linkedin_url" id="_meet_the_team_linkedin_url" value="<?php echo esc_url( $linkedin_url ); ?>" />
				</div>
			</div>

			<div class="cmb-row cmb-type-text cmb2-id--meet-the-team-instagram-username table-layout">
				<div class="cmb-th"><label for="_meet_the_team_instagram_username"><?php _e( 'Instagram Username', 'wp-meet-the-team' ); ?></label></div>
				<div class="cmb-td">
					<input type="text" class="regular-text" name="_meet_the_team_instagram_username" id="_meet_the_team_instagram_username" value="<?php echo esc_attr( $instagram_username ); ?>" />
				</div>
			</div>

			<div class="cmb-row cmb-type-text-url cmb2-id--meet-the-team-googleplus-url table-layout">
				<div class="cmb-th"><label for="_meet_the_team_googleplus_url"><?php _e( 'Google+ URL', 'wp-meet-the-team' ); ?></label></div>
				<div class="cmb-td">
					<input type="text" class="regular-text" name="_meet_the_team_googleplus_url" id="_meet_the_team_googleplus_url" value="<?php echo esc_url( $googleplus_url ); ?>" />
				</div>
			</div>
			
		</div>
	</div>
	
	<?php
}

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function wpmtt_page_template_meta_box_callback( $post ) {
	
	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$page_template 	= get_post_meta( $post->ID, '_wp_page_template', true );
	
	$post_template = array();
	$templates = wp_get_theme()->get_page_templates();
	
	foreach ( $templates as $template_name => $template_filename ) {
		$post_template[$template_name] = $template_filename;
	}
	?>
	
	<div class="cmb2-wrap form-table">
		<div id="cmb2-metabox-_meet_the_team_edit" class="cmb2-metabox cmb-field-list">
		
			<div class="cmb-row cmb-type-text-url cmb2-id--meet-the-team-googleplus-url table-layout">
				<div class="cmb-td">
					
					<select class="cmb2_select" name="_wp_page_template" id="_wp_page_template">
						<option value=''><?php _e( 'Default Template', 'wp-meet-the-team' ); ?></option>
						<?php
							foreach( $post_template as $template_value => $template_name ) {
								echo "<option value='$template_value' ". selected( $page_template, $template_value ) .">$template_name</option>";
							}
						?>
					</select>
					<p class="cmb2-metabox-description"><?php _e( 'Choose your layout in the box above', 'wp-meet-the-team' ); ?>.</p>
					
				</div>
			</div>
			
		</div>
	</div>
	<?php
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function wpmtt_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['_cmb_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['_cmb_meta_box_nonce'], 'wpmtt_save_meta_box_data' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'people' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Sanitize user input.
	$metas['job_title'] 			= sanitize_text_field( $_POST['_meet_the_team_job_title'] );
	$metas['email'] 				= sanitize_text_field( $_POST['_meet_the_team_email'] );
	$metas['phone_number'] 			= sanitize_text_field( $_POST['_meet_the_team_phone_number'] );
	$metas['facebook_username'] 	= sanitize_text_field( $_POST['_meet_the_team_facebook_username'] );
	$metas['twitter_username'] 		= sanitize_text_field( $_POST['_meet_the_team_twitter_username'] );
	$metas['linkedin_url'] 			= sanitize_text_field( $_POST['_meet_the_team_linkedin_url'] );
	$metas['instagram_username'] 	= sanitize_text_field( $_POST['_meet_the_team_instagram_username'] );
	$metas['googleplus_url'] 		= sanitize_text_field( $_POST['_meet_the_team_googleplus_url'] );
	
	// page template meta
	$page_template 					= sanitize_text_field( $_POST['_wp_page_template'] );
	
	// Update the meta field in the database.
	foreach( $metas as $meta_name => $meta_value ) {	
		update_post_meta( $post_id, '_meet_the_team_' . $meta_name, $meta_value );
	}
	
	// update page template meta
	update_post_meta( $post_id, '_wp_page_template', $page_template );
}


/**
 * Add new options settings for WP Image Embeds
 */
function wpmtt_admin_add_page() {
	add_options_page(
		__( 'Meet The Team Settings', 'wp-meet-the-team' ),
		__( 'Meet The Team', 'wp-meet-the-team' ),
		'manage_options',
		'wpie_settings',
		'wpmtt_options_page'
	);
}
add_action( 'admin_menu', 'wpmtt_admin_add_page' );


function wpmtt_options_page() {
	?>
		<form action="options.php" method="post">
			<?php settings_fields( 'wpie_plugin_options' ); ?>
			<?php do_settings_sections( 'wpmtt_section' ); ?>
		 
			<input name="Submit" type="submit" class="button button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
		</form> 
	<?php
}

function wpmtt_settings_api_init() {	
	register_setting( 'wpie_plugin_options', 'meet_the_team_enable_profile_page', 'intval' );
 	register_setting( 'wpie_plugin_options', 'meet_the_team_customizer_column' );
 	register_setting( 'wpie_plugin_options', 'meet_the_team_customizer_order' );
	
	add_settings_section(
		'wpmtt_setting_section',
		__( 'Meet The Team Settings', 'wp-meet-the-team' ),
		false,
		'wpmtt_section'
	);
	
 	add_settings_field( 'wpie_setting-id', __( 'Profile Page', 'wp-meet-the-team' ), 'wpmtt_profile_page_callback_function', 'wpmtt_section', 'wpmtt_setting_section' );
 	add_settings_field( 'wpie_number_of_column-id', __( 'Number of Columns', 'wp-meet-the-team' ), 'wpmtt_number_of_column_fallback_function', 'wpmtt_section', 'wpmtt_setting_section'	);
 	add_settings_field( 'wpie_grid_order-id', __( 'Grid Order', 'wp-meet-the-team' ), 'wpmtt_grid_order_fallback_function', 'wpmtt_section', 'wpmtt_setting_section' );
} 
add_action( 'admin_init', 'wpmtt_settings_api_init' );

function wpmtt_profile_page_callback_function() {
	echo '
		<p>
			<label><input type="checkbox" name="meet_the_team_enable_profile_page" id="meet_the_team_enable_profile_page" value="1" ' . checked( 1, get_option( 'meet_the_team_enable_profile_page' ), false ) . ' /> '. __( 'Link grid pages to profile page', 'wp-meet-the-team' ) .' </label>
		</p>
		<p class="description" id="tagline-description">'. __( 'This will link individual profile pages to single profile item page', 'wp-meet-the-team' ) . '.</p>
	';
}

function wpmtt_number_of_column_fallback_function() {
	echo '
		<p>	
			<select name="meet_the_team_customizer_column" id="meet_the_team_customizer_column">
				<option value="1" ' . selected( 1, get_option( 'meet_the_team_customizer_column' ), false ) . '>1</option>
				<option value="2" ' . selected( 2, get_option( 'meet_the_team_customizer_column' ), false ) . '>2</option>
				<option value="3" ' . selected( 3, get_option( 'meet_the_team_customizer_column' ), false ) . '>3</option>
				<option value="4" ' . selected( 4, get_option( 'meet_the_team_customizer_column' ), false ) . '>4</option>
				<option value="6" ' . selected( 6, get_option( 'meet_the_team_customizer_column' ), false ) . '>6</option>
			</select>
		</p>
		<p class="description" id="tagline-description">'. __( 'The number of columns displayed on each row', 'wp-meet-the-team' ) . '.</p>
	';
}

function wpmtt_grid_order_fallback_function() {
	echo '
		<p>	
			<select name="meet_the_team_customizer_order" id="meet_the_team_customizer_order">
				<option value="title" ' . selected( 'title', get_option( 'meet_the_team_customizer_order' ), false ) . '>'. __( 'Alphabetical', 'wp-meet-the-team' ) . '</option>
				<option value="date" ' . selected( 'date', get_option( 'meet_the_team_customizer_order' ), false ) . '>'. __( 'Date', 'wp-meet-the-team' ) . '</option>
			</select>
		</p>
		<p class="description" id="tagline-description">'. __( 'How the items are displayed in order', 'wp-meet-the-team' ) . '</p>
	';
}