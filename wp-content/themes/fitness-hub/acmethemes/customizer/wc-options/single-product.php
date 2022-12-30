<?php
/*adding sections for sidebar options */
$wp_customize->add_section( 'fitness-hub-wc-single-product-options', array(
	'priority'       => 20,
	'capability'     => 'edit_theme_options',
	'title'          => esc_html__( 'Single Product', 'fitness-hub' ),
	'panel'          => 'fitness-hub-wc-panel'
) );

/*Sidebar Layout*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-wc-single-product-sidebar-layout]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['fitness-hub-wc-single-product-sidebar-layout'],
	'sanitize_callback' => 'fitness_hub_sanitize_select'
) );
$choices = fitness_hub_sidebar_layout();
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-wc-single-product-sidebar-layout]', array(
	'choices'  	=> $choices,
	'label'		=> esc_html__( 'Single Product Sidebar Layout', 'fitness-hub' ),
	'section'   => 'fitness-hub-wc-single-product-options',
	'settings'  => 'fitness_hub_theme_options[fitness-hub-wc-single-product-sidebar-layout]',
	'type'	  	=> 'select'
) );