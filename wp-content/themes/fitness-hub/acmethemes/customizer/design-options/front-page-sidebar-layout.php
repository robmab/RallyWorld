<?php
/*adding sections for default layout options panel*/
$wp_customize->add_section( 'fitness-hub-front-page-sidebar-layout', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'title'          => esc_html__( 'Front/Home Sidebar Layout', 'fitness-hub' ),
    'panel'          => 'fitness-hub-design-panel'
) );

/*Sidebar Layout*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-front-page-sidebar-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['fitness-hub-front-page-sidebar-layout'],
    'sanitize_callback' => 'fitness_hub_sanitize_select'
) );
$choices = fitness_hub_sidebar_layout();
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-front-page-sidebar-layout]', array(
    'choices'  	        => $choices,
    'label'		        => esc_html__( 'Front/Home Sidebar Layout', 'fitness-hub' ),
    'section'           => 'fitness-hub-front-page-sidebar-layout',
    'settings'          => 'fitness_hub_theme_options[fitness-hub-front-page-sidebar-layout]',
    'type'	  	        => 'select'
) );