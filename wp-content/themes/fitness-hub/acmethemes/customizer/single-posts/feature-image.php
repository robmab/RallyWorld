<?php
/*adding sections for feature image selection*/
$wp_customize->add_section( 'fitness-hub-single-feature-image', array(
    'capability'     => 'edit_theme_options',
    'title'          => esc_html__( 'Feature Image Option', 'fitness-hub' ),
    'panel'          => 'fitness-hub-single-post'
) );

/*single image size*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-single-img-size]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['fitness-hub-single-img-size'],
	'sanitize_callback' => 'fitness_hub_sanitize_select'
) );
$choices = fitness_hub_get_image_sizes_options(1);
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-single-img-size]', array(
	'choices'  	=> $choices,
	'label'		=> esc_html__( 'Image Size', 'fitness-hub' ),
	'section'   => 'fitness-hub-single-feature-image',
	'settings'  => 'fitness_hub_theme_options[fitness-hub-single-img-size]',
	'type'	  	=> 'select'
) );