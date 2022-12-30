<?php
/*adding sections for Search Placeholder*/
$wp_customize->add_section( 'fitness-hub-search', array(
    'priority'          => 20,
    'capability'        => 'edit_theme_options',
    'title'             => esc_html__( 'Search', 'fitness-hub' ),
    'panel'             => 'fitness-hub-options'
) );

/*Search Placeholder*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-search-placeholder]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['fitness-hub-search-placeholder'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-search-placeholder]', array(
    'label'		        => esc_html__( 'Search Placeholder', 'fitness-hub' ),
    'section'           => 'fitness-hub-search',
    'settings'          => 'fitness_hub_theme_options[fitness-hub-search-placeholder]',
    'type'	  	        => 'text'
) );