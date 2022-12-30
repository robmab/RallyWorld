<?php
/*adding sections for footer options*/
$wp_customize->add_section( 'fitness-hub-footer-copyright-option', array(
    'priority'              => 20,
    'capability'            => 'edit_theme_options',
    'title'                 => esc_html__( 'Bottom Copyright Section', 'fitness-hub' ),
    'panel'                 => 'fitness-hub-footer-panel',
) );

/*copyright*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-footer-copyright]', array(
    'capability'		    => 'edit_theme_options',
    'default'			    => $defaults['fitness-hub-footer-copyright'],
    'sanitize_callback'     => 'wp_kses_post'
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-footer-copyright]', array(
    'label'		            => esc_html__( 'Copyright Text', 'fitness-hub' ),
    'section'               => 'fitness-hub-footer-copyright-option',
    'settings'              => 'fitness_hub_theme_options[fitness-hub-footer-copyright]',
    'type'	  	            => 'text'
) );

/*footer copyright beside*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-footer-copyright-beside-option]', array(
	'capability'		    => 'edit_theme_options',
	'default'			    => $defaults['fitness-hub-footer-copyright-beside-option'],
	'sanitize_callback'     => 'fitness_hub_sanitize_select'
) );
$choices = fitness_hub_footer_copyright_beside_option();
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-footer-copyright-beside-option]', array(
	'choices'  	            => $choices,
	'label'		            => esc_html__( 'Footer Copyright Beside Option', 'fitness-hub' ),
	'section'               => 'fitness-hub-footer-copyright-option',
	'settings'              => 'fitness_hub_theme_options[fitness-hub-footer-copyright-beside-option]',
	'type'	  	            => 'select'
) );

/*footer got to top enable-disable */
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-enable-footer-power-text]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['fitness-hub-enable-footer-power-text'],
	'sanitize_callback' => 'fitness_hub_sanitize_checkbox'
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-enable-footer-power-text]', array(
	'label'		=> esc_html__( ' Enable Theme Name And Powered By Text ', 'fitness-hub' ),
	'section'   => 'fitness-hub-footer-copyright-option',
	'settings'  => 'fitness_hub_theme_options[fitness-hub-enable-footer-power-text]',
	'type'	  	=> 'checkbox'
) );