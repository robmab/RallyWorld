<?php
/*Site Logo*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-display-site-logo]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['fitness-hub-display-site-logo'],
	'sanitize_callback' => 'fitness_hub_sanitize_checkbox'
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-display-site-logo]', array(
	'label'		=> esc_html__( 'Display Logo', 'fitness-hub' ),
	'section'   => 'title_tagline',
	'settings'  => 'fitness_hub_theme_options[fitness-hub-display-site-logo]',
	'type'	  	=> 'checkbox'
) );

/*Site Title*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-display-site-title]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['fitness-hub-display-site-title'],
	'sanitize_callback' => 'fitness_hub_sanitize_checkbox'
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-display-site-title]', array(
	'label'		=> esc_html__( 'Display Site Title', 'fitness-hub' ),
	'section'   => 'title_tagline',
	'settings'  => 'fitness_hub_theme_options[fitness-hub-display-site-title]',
	'type'	  	=> 'checkbox'
) );

/*Site Tagline*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-display-site-tagline]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['fitness-hub-display-site-tagline'],
	'sanitize_callback' => 'fitness_hub_sanitize_checkbox'
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-display-site-tagline]', array(
	'label'		=> esc_html__( 'Display Site Tagline', 'fitness-hub' ),
	'section'   => 'title_tagline',
	'settings'  => 'fitness_hub_theme_options[fitness-hub-display-site-tagline]',
	'type'	  	=> 'checkbox'
) );