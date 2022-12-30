<?php
/*adding sections for default layout options panel*/
$wp_customize->add_section( 'fitness-hub-archive-sidebar-layout', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'title'          => esc_html__( 'Category/Archive Sidebar Layout', 'fitness-hub' ),
    'panel'          => 'fitness-hub-design-panel'
) );

/*Sidebar Layout*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-archive-sidebar-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['fitness-hub-archive-sidebar-layout'],
    'sanitize_callback' => 'fitness_hub_sanitize_select'
) );
$choices = fitness_hub_sidebar_layout();
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-archive-sidebar-layout]', array(
    'choices'  	        => $choices,
    'label'		        => esc_html__( 'Category/Archive Sidebar Layout', 'fitness-hub' ),
    'description'       => esc_html__( 'Sidebar Layout for listing pages like category, author etc', 'fitness-hub' ),
    'section'           => 'fitness-hub-archive-sidebar-layout',
    'settings'          => 'fitness_hub_theme_options[fitness-hub-archive-sidebar-layout]',
    'type'	  	        => 'select'
) );