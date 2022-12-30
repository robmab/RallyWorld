<?php
/*adding sections for design options panel*/
$wp_customize->add_section( 'fitness-hub-animation', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'title'          => esc_html__( 'Animation', 'fitness-hub' ),
    'panel'          => 'fitness-hub-design-panel'
) );

/*enable disable animation*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-enable-animation]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['fitness-hub-enable-animation'],
    'sanitize_callback' => 'fitness_hub_sanitize_checkbox'
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-enable-animation]', array(
    'label'		        => esc_html__( 'Disable animation', 'fitness-hub' ),
    'description'       => esc_html__( 'Check this to disable overall site animation effect provided by theme', 'fitness-hub' ),
    'section'           => 'fitness-hub-animation',
    'settings'          => 'fitness_hub_theme_options[fitness-hub-enable-animation]',
    'type'	  	        => 'checkbox'
) );