<?php
/*check if enable header top*/
if ( !function_exists('fitness_hub_is_enable_header_top') ) :
	function fitness_hub_is_enable_header_top() {
		$fitness_hub_customizer_all_values = fitness_hub_get_theme_options();
		if( 1 == $fitness_hub_customizer_all_values['fitness-hub-enable-header-top'] ){
			return true;
		}
		return false;
	}
endif;

/*adding sections for header options*/
$wp_customize->add_section( 'fitness-hub-header-top-option', array(
    'priority'                  => 10,
    'capability'                => 'edit_theme_options',
    'title'                     => esc_html__( 'Header Top', 'fitness-hub' ),
    'panel'                     => 'fitness-hub-header-panel',
) );

/*header top enable*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-enable-header-top]', array(
    'capability'		        => 'edit_theme_options',
    'default'			        => $defaults['fitness-hub-enable-header-top'],
    'sanitize_callback'         => 'fitness_hub_sanitize_checkbox',
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-enable-header-top]', array(
    'label'		                => esc_html__( 'Enable Header Top Options', 'fitness-hub' ),
    'section'                   => 'fitness-hub-header-top-option',
    'settings'                  => 'fitness_hub_theme_options[fitness-hub-enable-header-top]',
    'type'	  	                => 'checkbox'
) );

/*header top message*/
$wp_customize->add_setting('fitness_hub_theme_options[fitness-hub-header-top-message]', array(
	'capability'		        => 'edit_theme_options',
	'sanitize_callback'         => 'wp_kses_post'
));

$wp_customize->add_control(
	new Fitness_Hub_Customize_Message_Control(
		$wp_customize,
		'fitness_hub_theme_options[fitness-hub-header-top-message]',
		array(
			'section'           => 'fitness-hub-header-top-option',
			'description'       => "<hr /><h2>".esc_html__('Display Different Element on Top Right or Left','fitness-hub')."</h2>",
			'settings'          => 'fitness_hub_theme_options[fitness-hub-header-top-message]',
			'type'	  	        => 'message',
			'active_callback'   => 'fitness_hub_is_enable_header_top'
		)
	)
);

/*Top Menu Display*/
$choices = fitness_hub_header_top_display_selection();
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-header-top-menu-display-selection]', array(
	'capability'		        => 'edit_theme_options',
	'default'			        => $defaults['fitness-hub-header-top-menu-display-selection'],
	'sanitize_callback'         => 'fitness_hub_sanitize_select'
) );
$description = sprintf( esc_html__( 'Add/Edit Menu Items from %1$s here%2$s and select Menu Location : Top Menu ( Support First Level Only ) ', 'fitness-hub' ), '<a class="at-customizer button button-primary" data-panel="nav_menus" style="cursor: pointer">','</a>' );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-header-top-menu-display-selection]', array(
	'choices'  	                => $choices,
	'label'		                => esc_html__( 'Top Menu Display', 'fitness-hub' ),
	'description'		        => $description,
	'section'                   => 'fitness-hub-header-top-option',
	'settings'                  => 'fitness_hub_theme_options[fitness-hub-header-top-menu-display-selection]',
	'type'	  	                => 'select',
	'active_callback'           => 'fitness_hub_is_enable_header_top'
) );

/*Top Info display*/
$description = sprintf( esc_html__( 'Add/Edit Info Items from %1$s here%2$s', 'fitness-hub' ), '<a class="at-customizer button button-primary" data-section="fitness-hub-feature-info" style="cursor: pointer">','</a>' );
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-header-top-info-display-selection]', array(
	'capability'		        => 'edit_theme_options',
	'default'			        => $defaults['fitness-hub-header-top-info-display-selection'],
	'sanitize_callback'         => 'fitness_hub_sanitize_select'
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-header-top-info-display-selection]', array(
	'choices'  	                => $choices,
	'label'		                => esc_html__( 'Top Info Display', 'fitness-hub' ),
	'description'		        => $description,
	'section'                   => 'fitness-hub-header-top-option',
	'settings'                  => 'fitness_hub_theme_options[fitness-hub-header-top-info-display-selection]',
	'type'	  	                => 'select',
	'active_callback'           => 'fitness_hub_is_enable_header_top'
) );

/*Social Display*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-header-top-social-display-selection]', array(
	'capability'		        => 'edit_theme_options',
	'default'			        => $defaults['fitness-hub-header-top-social-display-selection'],
	'sanitize_callback'         => 'fitness_hub_sanitize_select'
) );
$description = sprintf( esc_html__( 'Add/Edit Social Items from %1$s here%2$s ', 'fitness-hub' ), '<a class="at-customizer button button-primary" data-section="fitness-hub-social-options" style="cursor: pointer">','</a>' );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-header-top-social-display-selection]', array(
	'choices'  	                => $choices,
	'label'		                => esc_html__( 'Social Display', 'fitness-hub' ),
	'description'               => $description,
	'section'                   => 'fitness-hub-header-top-option',
	'settings'                  => 'fitness_hub_theme_options[fitness-hub-header-top-social-display-selection]',
	'type'	  	                => 'select',
	'active_callback'           => 'fitness_hub_is_enable_header_top'
) );