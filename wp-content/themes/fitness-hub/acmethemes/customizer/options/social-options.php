<?php
/*adding sections for header social options */
$wp_customize->add_section( 'fitness-hub-social-options', array(
    'priority'              => 20,
    'capability'            => 'edit_theme_options',
    'title'                 => esc_html__( 'Social Options', 'fitness-hub' ),
    'panel'                 => 'fitness-hub-options'
) );

/*repeater social data*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-social-data]', array(
	'sanitize_callback'     => 'fitness_hub_sanitize_social_data',
	'default'               => $defaults['fitness-hub-social-data']
) );
$wp_customize->add_control(
	new Fitness_Hub_Repeater_Control(
		$wp_customize,
		'fitness_hub_theme_options[fitness-hub-social-data]',
		array(
			'label'                         => esc_html__('Social Options Selection','fitness-hub'),
			'description'                   => esc_html__('Select Social Icons and enter link','fitness-hub'),
			'section'                       => 'fitness-hub-social-options',
			'settings'                      => 'fitness_hub_theme_options[fitness-hub-social-data]',
			'repeater_main_label'           => esc_html__('Social Icon','fitness-hub'),
			'repeater_add_control_field'    => esc_html__('Add New Icon','fitness-hub')
		),
		array(
			'icon' => array(
				'type'        => 'icons',
				'label'       => esc_html__( 'Select Icon', 'fitness-hub' ),
			),
			'link' => array(
				'type'        => 'url',
				'label'       => esc_html__( 'Enter Link', 'fitness-hub' ),
			),
			'checkbox' => array(
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Open in New Window', 'fitness-hub' ),
			)
		)
	)
);