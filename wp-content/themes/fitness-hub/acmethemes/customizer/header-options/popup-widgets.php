<?php
/*Title*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-popup-widget-title]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['fitness-hub-popup-widget-title'],
	'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-popup-widget-title]', array(
	'label'		        => esc_html__( 'Main Title', 'fitness-hub' ),
	'section'           => 'fitness-hub-menu-options',
	'settings'          => 'fitness_hub_theme_options[fitness-hub-popup-widget-title]',
	'type'	  	        => 'text',
	'priority'	  	    => 1,
) );
$fitness_hub_popup_widget_area = $wp_customize->get_section( 'sidebar-widgets-popup-widget-area' );
if ( ! empty( $fitness_hub_popup_widget_area ) ) {
	$fitness_hub_popup_widget_area->panel = 'fitness-hub-header-panel';
	$fitness_hub_popup_widget_area->title = esc_html__( 'Popup Widgets', 'fitness-hub' );
	$fitness_hub_popup_widget_area->priority = 999;

	$fitness_hub_popup_widget_title = $wp_customize->get_control( 'fitness_hub_theme_options[fitness-hub-popup-widget-title]' );
	if ( ! empty( $fitness_hub_popup_widget_title ) ) {
		$fitness_hub_popup_widget_title->section  = 'sidebar-widgets-popup-widget-area';
		$fitness_hub_popup_widget_title->priority = -1;
	}
}