<?php

if( ! class_exists( 'Meet_The_Team_Customizer' ) ) {
	class Meet_The_Team_Customizer {
		
		function __construct() {
			add_action( 'customize_register', array( $this, 'meet_the_team_customize_register' ) );
		}
		
		function meet_the_team_customize_register( $wp_customize ) {
			// section
			$wp_customize->add_section( 'meet_the_team_customizer_section' , array(
				'title'			=> __( 'Meet The Team', 'meet-the-team' ),
				'priority'		=> 34
			) );
			
			
			// Enable Profile
			$wp_customize->add_setting( 'meet_the_team_enable_profile_page' , array(
				'default'     		=> 0,
				'transport'   		=> 'refresh'
			) );
			
			$wp_customize->add_control( 'meet_the_team_customizer_profile_control', array(
				'label'		=> __( 'Link grid pages to profile page', 'meet-the-team' ),
				'section'	=> 'meet_the_team_customizer_section',
				'settings'	=> 'meet_the_team_enable_profile_page',
				'type'		=> 'checkbox'
			) );
			
			
			// Number of Column
			$wp_customize->add_setting( 'meet_the_team_customizer_column' , array(
				'default'     		=> 4,
				'transport'   		=> 'refresh'
			) );
			
			$wp_customize->add_control( 'meet_the_team_customizer_column_control', array(
				'label'		=> __( 'Number of columns', 'meet-the-team' ),
				'section'	=> 'meet_the_team_customizer_section',
				'settings'	=> 'meet_the_team_customizer_column',
				'type'		=> 'select',
				'choices'	=> array(
					'1'		=> '1',
					'2'		=> '2',
					'3'		=> '3',
					'4'		=> '4',
					'6'		=> '6'
				)
			) );
			
			
			// Team's Order
			$wp_customize->add_setting( 'meet_the_team_customizer_order' , array(
				'default'     		=> 'title',
				'transport'   		=> 'refresh'
			) );
			
			$wp_customize->add_control( 'meet_the_team_customizer_column_order', array(
				'label'		=> __( 'Grid Order', 'meet-the-team' ),
				'section'	=> 'meet_the_team_customizer_section',
				'settings'	=> 'meet_the_team_customizer_order',
				'type'		=> 'select',
				'choices'	=> array(
					'title'	=> 'Alphabetical',
					'date'	=> 'Date'
				)
			) );
		}
		
	}
	
	new Meet_The_Team_Customizer();
}