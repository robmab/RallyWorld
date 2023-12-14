<?php
/*Title*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-popup-widget-title]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['fitness-hub-popup-widget-title'],
	'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-popup-widget-title]', array(
	'label'		        => esc_html__( 'Popup Main Title', 'fitness-hub' ),
	'section'           => 'fitness-hub-menu-options',
	'settings'          => 'fitness_hub_theme_options[fitness-hub-popup-widget-title]',
	'type'	  	        => 'text',
    'active_callback'   => 'fitness_hub_menu_right_button_if_booking'
) );