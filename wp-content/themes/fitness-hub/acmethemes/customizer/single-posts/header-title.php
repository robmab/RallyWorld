<?php
/*adding sections for header title*/
$wp_customize->add_section( 'fitness-hub-single-header-title', array(
	'priority'              => 20,
	'capability'            => 'edit_theme_options',
	'title'                 => esc_html__( 'Single Header Title', 'fitness-hub' ),
	'panel'                 => 'fitness-hub-single-post',
) );

/*header title*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-single-header-title]', array(
	'capability'		    => 'edit_theme_options',
	'default'			    => $defaults['fitness-hub-single-header-title'],
	'sanitize_callback'     => 'sanitize_text_field'
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-single-header-title]', array(
	'label'		            => esc_html__( 'Header Title', 'fitness-hub' ),
	'section'               => 'fitness-hub-single-header-title',
	'settings'              => 'fitness_hub_theme_options[fitness-hub-single-header-title]',
	'type'	  	            => 'text'
) );