<?php
/*adding header options panel*/
$wp_customize->add_panel( 'fitness-hub-header-panel', array(
    'priority'       => 30,
    'capability'     => 'edit_theme_options',
    'title'          => esc_html__( 'Header Options', 'fitness-hub' ),
    'description'    => esc_html__( 'Customize your awesome site header ', 'fitness-hub' )
) );

/*
* file for header top options
*/
require fitness_hub_file_directory('acmethemes/customizer/header-options/header-top.php');

/*
* file for feature info
*/
require fitness_hub_file_directory('acmethemes/customizer/header-options/feature-info.php');

/*
* file for header logo options
*/
require fitness_hub_file_directory('acmethemes/customizer/header-options/header-logo.php');

/*
 * file for menu options
*/
require fitness_hub_file_directory('acmethemes/customizer/header-options/menu-options.php');

/*
* file for booking form
*/
require fitness_hub_file_directory('acmethemes/customizer/header-options/popup-widgets.php');

/* feature section height*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-header-height]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['fitness-hub-header-height'],
    'sanitize_callback' => 'fitness_hub_sanitize_number'
) );

$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-header-height]', array(
    'type'              => 'range',
    'priority'          => 100,
    'section'           => 'header_image',
    'label'		        => esc_html__( 'Inner Page Header Section Height', 'fitness-hub' ),
    'description'       => esc_html__( 'Control the height of Header section. The minimum height is 100px and maximium height is 500px', 'fitness-hub' ),
    'input_attrs'       => array(
        'min'           => 100,
        'max'           => 500,
        'step'          => 1,
        'class'         => 'fitness-hub-header-height',
        'style'         => 'color: #0a0',
    ),
    'active_callback'   => 'fitness_hub_if_header_bg_image'
) );

/*Header Image Display*/
$choices = fitness_hub_header_image_display();
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-header-image-display]', array(
	'capability'		        => 'edit_theme_options',
	'default'			        => $defaults['fitness-hub-header-image-display'],
	'sanitize_callback'         => 'fitness_hub_sanitize_select'
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-header-image-display]', array(
	'choices'  	                => $choices,
	'priority'                  => 1,
	'label'		                => esc_html__( 'Header Image Display', 'fitness-hub' ),
	'section'                   => 'header_image',
	'settings'                  => 'fitness_hub_theme_options[fitness-hub-header-image-display]',
	'type'	  	                => 'select'
) );

/*check if header bg*/
if ( !function_exists('fitness_hub_if_header_bg_image') ) :
	function fitness_hub_if_header_bg_image() {
		$fitness_hub_customizer_all_values = fitness_hub_get_theme_options();
		if( 'bg-image' == $fitness_hub_customizer_all_values['fitness-hub-header-image-display'] ){
			return true;
		}
		return false;
	}
endif;