<?php
/*adding sections for enabling feature section in front page*/
$wp_customize->add_section( 'fitness-hub-enable-feature', array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'title'          => esc_html__( 'Enable Feature Section', 'fitness-hub' ),
    'panel'          => 'fitness-hub-feature-panel'
) );

/*enable feature section*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-enable-feature]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['fitness-hub-enable-feature'],
    'sanitize_callback' => 'fitness_hub_sanitize_checkbox'
) );

$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-enable-feature]', array(
    'label'		        => esc_html__( 'Enable Feature Section', 'fitness-hub' ),
    'description'	    => sprintf( esc_html__( 'Feature section will display on front/home page. Feature Section includes Feature Slider and Feature Column.%1$s Note : Please go to %2$s "Static Front Page"%3$s setting, Select "A static page" then "Front page" and "Posts page" to enable it', 'fitness-hub' ), '<br />','<b><a class="at-customizer" data-section="static_front_page"> ','</a></b>' ),
    'section'           => 'fitness-hub-enable-feature',
    'settings'          => 'fitness_hub_theme_options[fitness-hub-enable-feature]',
    'type'	  	        => 'checkbox'
) );