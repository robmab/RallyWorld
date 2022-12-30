<?php
/*active callback function for front-page-header*/
if ( !function_exists('fitness_hub_active_callback_front_page_header') ) :
    function fitness_hub_active_callback_front_page_header() {
        $fitness_hub_customizer_all_values = fitness_hub_get_theme_options();
        if( 1 != $fitness_hub_customizer_all_values['fitness-hub-hide-front-page-content'] ){
            return true;
        }
        return false;
    }
endif;

/*adding sections for front page content */
$wp_customize->add_section( 'fitness-hub-front-page-content', array(
    'priority'          => 10,
    'capability'        => 'edit_theme_options',
    'title'             => esc_html__( 'Front Page Content Options', 'fitness-hub' ),
    'panel'             => 'fitness-hub-design-panel'

) );

/*hide front page content*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-hide-front-page-content]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['fitness-hub-hide-front-page-content'],
    'sanitize_callback' => 'fitness_hub_sanitize_checkbox',
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-hide-front-page-content]', array(
    'label'		        => esc_html__( 'Hide Front Page Content', 'fitness-hub' ),
    'description'       => esc_html__( 'You may want to hide front page content and want to show only Feature section and Home Widgets. Check this to hide front page content.', 'fitness-hub' ),
    'section'           => 'fitness-hub-front-page-content',
    'settings'          => 'fitness_hub_theme_options[fitness-hub-hide-front-page-content]',
    'type'	  	        => 'checkbox'
) );

/*hide front page header*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-hide-front-page-header]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['fitness-hub-hide-front-page-header'],
    'sanitize_callback' => 'fitness_hub_sanitize_checkbox',
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-hide-front-page-header]', array(
    'label'		        => esc_html__( 'Hide Front Page Header', 'fitness-hub' ),
    'description'       => esc_html__( 'You may want to hide front page header and want to show only Feature section and Home Widgets. Check this to hide front page Header.', 'fitness-hub' ),
    'section'           => 'fitness-hub-front-page-content',
    'settings'          => 'fitness_hub_theme_options[fitness-hub-hide-front-page-header]',
    'type'	  	        => 'checkbox',
    'active_callback'   => 'fitness_hub_active_callback_front_page_header'
) );