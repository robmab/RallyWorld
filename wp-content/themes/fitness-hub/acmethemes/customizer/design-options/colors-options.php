<?php
/*Primary color*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-primary-color]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['fitness-hub-primary-color'],
    'sanitize_callback' => 'sanitize_hex_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'fitness_hub_theme_options[fitness-hub-primary-color]',
        array(
            'label'		=> esc_html__( 'Primary Color', 'fitness-hub' ),
            'section'   => 'colors',
            'settings'  => 'fitness_hub_theme_options[fitness-hub-primary-color]',
            'type'	  	=> 'color'
        ) )
);

/*Header TOP color*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-header-top-bg-color]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['fitness-hub-header-top-bg-color'],
    'sanitize_callback' => 'sanitize_hex_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'fitness_hub_theme_options[fitness-hub-header-top-bg-color]',
        array(
            'label'		=> esc_html__( 'Header Top Background Color', 'fitness-hub' ),
            'description'=> esc_html__( 'Also used as secondary color', 'fitness-hub' ),
            'section'   => 'colors',
            'settings'  => 'fitness_hub_theme_options[fitness-hub-header-top-bg-color]',
            'type'	  	=> 'color'
        )
    )
);

/* Footer Background Color*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-footer-bg-color]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['fitness-hub-footer-bg-color'],
    'sanitize_callback' => 'sanitize_hex_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'fitness_hub_theme_options[fitness-hub-footer-bg-color]',
        array(
            'label'		=> esc_html__( 'Footer Background Color', 'fitness-hub' ),
            'section'   => 'colors',
            'settings'  => 'fitness_hub_theme_options[fitness-hub-footer-bg-color]',
            'type'	  	=> 'color'
        )
    )
);

/*Footer Bottom Background Color*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-footer-bottom-bg-color]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['fitness-hub-footer-bottom-bg-color'],
    'sanitize_callback' => 'sanitize_hex_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'fitness_hub_theme_options[fitness-hub-footer-bottom-bg-color]',
        array(
            'label'		=> esc_html__( 'Footer Bottom Background Color', 'fitness-hub' ),
            'section'   => 'colors',
            'settings'  => 'fitness_hub_theme_options[fitness-hub-footer-bottom-bg-color]',
            'type'	  	=> 'color'
        )
    )
);

/*Link color*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-link-color]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['fitness-hub-link-color'],
	'sanitize_callback' => 'sanitize_hex_color'
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-link-color]', array(
	'label'		=> esc_html__( 'Link Color', 'fitness-hub' ),
	'section'   => 'colors',
	'settings'  => 'fitness_hub_theme_options[fitness-hub-link-color]',
	'type'	  	=> 'color'
) );

/*Link Hover color*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-link-hover-color]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['fitness-hub-link-hover-color'],
	'sanitize_callback' => 'sanitize_hex_color'
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-link-hover-color]', array(
	'label'		=> esc_html__( 'Link Hover Color', 'fitness-hub' ),
	'section'   => 'colors',
	'settings'  => 'fitness_hub_theme_options[fitness-hub-link-hover-color]',
	'type'	  	=> 'color'
) );