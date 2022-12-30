<?php
/*adding sections for breadcrumb */
$wp_customize->add_section( 'fitness-hub-breadcrumb-options', array(
    'priority'          => 20,
    'capability'        => 'edit_theme_options',
    'title'             => esc_html__( 'Breadcrumb Options', 'fitness-hub' ),
    'panel'             => 'fitness-hub-options'
) );

/*show breadcrumb*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-breadcrumb-options]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['fitness-hub-breadcrumb-options'],
    'sanitize_callback' => 'fitness_hub_sanitize_select'
) );
$choices = fitness_hub_breadcrumb_options();

$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-breadcrumb-options]', array(
	'choices'  	        => $choices,
	'label'		        => esc_html__( 'Breadcrumb Options', 'fitness-hub' ),
	'description'		 => sprintf( 'Use any one of the plugin for Breadcrumb. %sBreadcrumb NavXT%s or %sYoast SEO%s', '<a href="https://wordpress.org/plugins/breadcrumb-navxt/" target="_blank">','</a>','<a href="https://wordpress.org/plugins/wordpress-seo/" target="_blank">','</a>' ),
    'section'           => 'fitness-hub-breadcrumb-options',
    'settings'          => 'fitness_hub_theme_options[fitness-hub-breadcrumb-options]',
    'type'	  	        => 'select'
) );
