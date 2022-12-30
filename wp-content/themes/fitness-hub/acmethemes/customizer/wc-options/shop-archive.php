<?php
/*adding sections for sidebar options */
$wp_customize->add_section( 'fitness-hub-wc-shop-archive-option', array(
	'priority'       => 20,
	'capability'     => 'edit_theme_options',
	'title'          => esc_html__( 'Shop Archive Sidebar Layout', 'fitness-hub' ),
	'panel'          => 'fitness-hub-wc-panel'
) );

/*Sidebar Layout*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-wc-shop-archive-sidebar-layout]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['fitness-hub-wc-shop-archive-sidebar-layout'],
	'sanitize_callback' => 'fitness_hub_sanitize_select'
) );
$choices = fitness_hub_sidebar_layout();
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-wc-shop-archive-sidebar-layout]', array(
	'choices'  	=> $choices,
	'label'		=> esc_html__( 'Shop Archive Sidebar Layout', 'fitness-hub' ),
	'section'   => 'fitness-hub-wc-shop-archive-option',
	'settings'  => 'fitness_hub_theme_options[fitness-hub-wc-shop-archive-sidebar-layout]',
	'type'	  	=> 'select'
) );

/*wc-product-column-number*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-wc-product-column-number]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['fitness-hub-wc-product-column-number'],
	'sanitize_callback' => 'absint'
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-wc-product-column-number]', array(
	'label'		=> esc_html__( 'Products Per Row', 'fitness-hub' ),
	'section'   => 'fitness-hub-wc-shop-archive-option',
	'settings'  => 'fitness_hub_theme_options[fitness-hub-wc-product-column-number]',
	'type'	  	=> 'number'
) );

/*wc-shop-archive-total-product*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-wc-shop-archive-total-product]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['fitness-hub-wc-shop-archive-total-product'],
	'sanitize_callback' => 'absint'
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-wc-shop-archive-total-product]', array(
	'label'		=> esc_html__( 'Total Products Per Page', 'fitness-hub' ),
	'section'   => 'fitness-hub-wc-shop-archive-option',
	'settings'  => 'fitness_hub_theme_options[fitness-hub-wc-shop-archive-total-product]',
	'type'	  	=> 'number'
) );