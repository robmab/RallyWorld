<?php
/*adding sections for sidebar options */
$wp_customize->add_section( 'fitness-hub-design-sidebar-layout-option', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'title'          => esc_html__( 'Default Page/Post Sidebar Layout', 'fitness-hub' ),
    'panel'          => 'fitness-hub-design-panel'
) );

/*Sidebar Layout*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-single-sidebar-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['fitness-hub-single-sidebar-layout'],
    'sanitize_callback' => 'fitness_hub_sanitize_select'
) );
$choices = fitness_hub_sidebar_layout();
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-single-sidebar-layout]', array(
    'choices'  	        => $choices,
    'label'		        => esc_html__( 'Default Page/Post Sidebar Layout', 'fitness-hub' ),
    'description'       => esc_html__( 'Single Page/Post Sidebar', 'fitness-hub' ),
    'section'           => 'fitness-hub-design-sidebar-layout-option',
    'settings'          => 'fitness_hub_theme_options[fitness-hub-single-sidebar-layout]',
    'type'	  	        => 'select'
) );