<?php
/*adding sections for category section in front page*/
$wp_customize->add_section( 'fitness-hub-feature-page', array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'title'          => esc_html__( 'Feature Slider Selection', 'fitness-hub' ),
    'panel'          => 'fitness-hub-feature-panel'
) );

/* feature parent all-slides selection */
$slider_pages = array();
$slider_pages_obj = get_pages();
$slider_pages[''] = esc_html__('Select Slider Page','fitness-hub');
foreach ($slider_pages_obj as $page) {
	$slider_pages[$page->ID] = $page->post_title;
}
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-slides-data]', array(
	'sanitize_callback' => 'fitness_hub_sanitize_slider_data',
	'default'           => $defaults['fitness-hub-slides-data']
) );
$wp_customize->add_control(
	new Fitness_Hub_Repeater_Control(
		$wp_customize,
		'fitness_hub_theme_options[fitness-hub-slides-data]',
		array(
			'label'                         => esc_html__('Slider Selection','fitness-hub'),
			'description'                   => esc_html__('Select Page For Slider','fitness-hub'),
			'section'                       => 'fitness-hub-feature-page',
			'settings'                      => 'fitness_hub_theme_options[fitness-hub-slides-data]',
			'repeater_main_label'           => esc_html__('Select Slide of Slider','fitness-hub'),
			'repeater_add_control_field'    => esc_html__('Add New Slide','fitness-hub'),
		),
		array(
			'selectpage' => array(
				'type'        => 'select',
				'label'       => esc_html__( 'Select Page For Slide', 'fitness-hub' ),
				'options'     => $slider_pages
			),
			'button_1_text' => array(
				'type'        => 'text',
				'label'       => esc_html__( 'Button One Text', 'fitness-hub' ),
			),
			'button_1_link' => array(
				'type'        => 'url',
				'label'       => esc_html__( 'Button One Link', 'fitness-hub' ),
			),
			'button_2_text' => array(
				'type'        => 'text',
				'label'       => esc_html__( 'Button Two Text', 'fitness-hub' ),
			),
			'button_2_link' => array(
				'type'        => 'url',
				'label'       => esc_html__( 'Button Two Link', 'fitness-hub' ),
			)
		)
	)
);

/*enable animation*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-feature-slider-enable-animation]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['fitness-hub-feature-slider-enable-animation'],
    'sanitize_callback' => 'fitness_hub_sanitize_checkbox'
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-feature-slider-enable-animation]', array(
    'label'		        => esc_html__( 'Enable Animation', 'fitness-hub' ),
    'section'           => 'fitness-hub-feature-page',
    'settings'          => 'fitness_hub_theme_options[fitness-hub-feature-slider-enable-animation]',
    'type'	  	        => 'checkbox',
) );

/*display-title*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-feature-slider-display-title]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['fitness-hub-feature-slider-display-title'],
    'sanitize_callback' => 'fitness_hub_sanitize_checkbox'
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-feature-slider-display-title]', array(
    'label'		            => esc_html__( 'Display Title', 'fitness-hub' ),
    'section'               => 'fitness-hub-feature-page',
    'settings'              => 'fitness_hub_theme_options[fitness-hub-feature-slider-display-title]',
    'type'	  	            => 'checkbox',
) );

/*display-excerpt*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-feature-slider-display-excerpt]', array(
	'capability'		    => 'edit_theme_options',
	'default'			    => $defaults['fitness-hub-feature-slider-display-excerpt'],
	'sanitize_callback'     => 'fitness_hub_sanitize_checkbox'
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-feature-slider-display-excerpt]', array(
	'label'		            => esc_html__( 'Display Excerpt', 'fitness-hub' ),
	'section'               => 'fitness-hub-feature-page',
	'settings'              => 'fitness_hub_theme_options[fitness-hub-feature-slider-display-excerpt]',
	'type'	  	            => 'checkbox',
) );

/*Image Display Behavior*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-fs-image-display-options]', array(
    'capability'		    => 'edit_theme_options',
    'default'			    => $defaults['fitness-hub-fs-image-display-options'],
    'sanitize_callback'     => 'fitness_hub_sanitize_select'
) );
$choices = fitness_hub_fs_image_display_options();
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-fs-image-display-options]', array(
    'choices'  	            => $choices,
    'label'		            => esc_html__( 'Feature Slider Image Display Options', 'fitness-hub' ),
    'section'               => 'fitness-hub-feature-page',
    'settings'              => 'fitness_hub_theme_options[fitness-hub-fs-image-display-options]',
    'type'	  	            => 'radio',
) );

/*Slider Selection Text Align*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-feature-slider-text-align]', array(
	'capability'		    => 'edit_theme_options',
	'default'			    => $defaults['fitness-hub-feature-slider-text-align'],
	'sanitize_callback'     => 'fitness_hub_sanitize_select',
) );
$choices = fitness_hub_slider_text_align();
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-feature-slider-text-align]', array(
	'choices'  	            => $choices,
	'label'		            => esc_html__( 'Slider Text Align', 'fitness-hub' ),
	'section'               => 'fitness-hub-feature-page',
	'settings'              => 'fitness_hub_theme_options[fitness-hub-feature-slider-text-align]',
	'type'	  	            => 'select',
) );