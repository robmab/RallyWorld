<?php
/*check for fitness-hub-menu-right-button-options*/
if ( !function_exists('fitness_hub_menu_right_button_if_not_disable') ) :
	function fitness_hub_menu_right_button_if_not_disable() {
		$fitness_hub_customizer_all_values = fitness_hub_get_theme_options();
		if( 'disable' != $fitness_hub_customizer_all_values['fitness-hub-menu-right-button-options'] ){
			return true;
		}
		return false;
	}
endif;

if ( !function_exists('fitness_hub_menu_right_button_if_booking') ) :
	function fitness_hub_menu_right_button_if_booking() {
		$fitness_hub_customizer_all_values = fitness_hub_get_theme_options();
		if( 'booking' == $fitness_hub_customizer_all_values['fitness-hub-menu-right-button-options'] ){
			return true;
		}
		return false;
	}
endif;

if ( !function_exists('fitness_hub_menu_right_button_if_link') ) :
	function fitness_hub_menu_right_button_if_link() {
		$fitness_hub_customizer_all_values = fitness_hub_get_theme_options();
		if( 'link' == $fitness_hub_customizer_all_values['fitness-hub-menu-right-button-options'] ){
			return true;
		}
		return false;
	}
endif;

/*Button Link Options*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-menu-display-options]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['fitness-hub-menu-display-options'],
	'sanitize_callback' => 'fitness_hub_sanitize_select'
) );
$choices = fitness_hub_menu_display_options();
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-menu-display-options]', array(
	'choices'  	    => $choices,
	'label'		    => esc_html__( 'Menu Display Options', 'fitness-hub' ),
	'section'       => 'fitness-hub-menu-options',
	'settings'      => 'fitness_hub_theme_options[fitness-hub-menu-display-options]',
	'type'	  	    => 'select'
) );

/*Menu Section*/
$wp_customize->add_section( 'fitness-hub-menu-options', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'title'          => esc_html__( 'Menu Options', 'fitness-hub' ),
    'panel'          => 'fitness-hub-header-panel'
) );

/*enable sticky*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-enable-sticky]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['fitness-hub-enable-sticky'],
    'sanitize_callback' => 'fitness_hub_sanitize_checkbox'
) );

$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-enable-sticky]', array(
    'label'		=> esc_html__( 'Enable Sticky Menu', 'fitness-hub' ),
    'section'   => 'fitness-hub-menu-options',
    'settings'  => 'fitness_hub_theme_options[fitness-hub-enable-sticky]',
    'type'	  	=> 'checkbox'
) );

if( fitness_hub_is_woocommerce_active() ){
	/*enable cart*/
	$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-enable-cart-icon]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['fitness-hub-enable-cart-icon'],
		'sanitize_callback' => 'fitness_hub_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-enable-cart-icon]', array(
		'label'		=> esc_html__( 'Enable Cart', 'fitness-hub' ),
		'section'   => 'fitness-hub-menu-options',
		'settings'  => 'fitness_hub_theme_options[fitness-hub-enable-cart-icon]',
		'type'	  	=> 'checkbox'
	) );
}

/*Button Right Message*/
$wp_customize->add_setting('fitness_hub_theme_options[fitness-hub-menu-right-button-message]', array(
	'capability'		=> 'edit_theme_options',
	'sanitize_callback' => 'wp_kses_post'
));

$wp_customize->add_control(
	new Fitness_Hub_Customize_Message_Control(
		$wp_customize,
		'fitness_hub_theme_options[fitness-hub-menu-right-button-message]',
		array(
			'section'       => 'fitness-hub-menu-options',
			'description'   => "<hr /><h2>".esc_html__('Special Button On Menu Right','fitness-hub')."</h2>",
			'settings'      => 'fitness_hub_theme_options[fitness-hub-menu-right-button-message]',
			'type'	  	    => 'message'
		)
	)
);

/*Button Link Options*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-menu-right-button-options]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['fitness-hub-menu-right-button-options'],
	'sanitize_callback' => 'fitness_hub_sanitize_select'
) );
$choices = fitness_hub_menu_right_button_link_options();
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-menu-right-button-options]', array(
	'choices'  	    => $choices,
	'label'		    => esc_html__( 'Button Options', 'fitness-hub' ),
	'section'       => 'fitness-hub-menu-options',
	'settings'      => 'fitness_hub_theme_options[fitness-hub-menu-right-button-options]',
	'type'	  	    => 'select'
) );

/*Button title*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-menu-right-button-title]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['fitness-hub-menu-right-button-title'],
	'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-menu-right-button-title]', array(
	'label'		        => esc_html__( 'Button Title', 'fitness-hub' ),
	'section'           => 'fitness-hub-menu-options',
	'settings'          => 'fitness_hub_theme_options[fitness-hub-menu-right-button-title]',
	'type'	  	        => 'text',
	'active_callback'   => 'fitness_hub_menu_right_button_if_not_disable'
) );

/*Button Right booking Message*/
$wp_customize->add_setting('fitness_hub_theme_options[fitness-hub-menu-right-button-booking-message]', array(
	'capability'		=> 'edit_theme_options',
	'sanitize_callback' => 'wp_kses_post'
));
$description = sprintf( esc_html__( '%1$sAdd Popup Widget from here%2$s ', 'fitness-hub' ), '<a class="at-customizer" data-section="sidebar-widgets-popup-widget-area" style="cursor: pointer">','</a>' );
$wp_customize->add_control(
	new Fitness_Hub_Customize_Message_Control(
		$wp_customize,
		'fitness_hub_theme_options[fitness-hub-menu-right-button-booking-message]',
		array(
			'section'           => 'fitness-hub-menu-options',
			'description'       => $description,
			'settings'          => 'fitness_hub_theme_options[fitness-hub-menu-right-button-booking-message]',
			'type'	  	        => 'message',
			'active_callback'   => 'fitness_hub_menu_right_button_if_booking',
            'priority'	  	    => 100
		)
	)
);

/*Button link*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-menu-right-button-link]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['fitness-hub-menu-right-button-link'],
	'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-menu-right-button-link]', array(
	'label'		        => esc_html__( 'Button Link', 'fitness-hub' ),
	'section'           => 'fitness-hub-menu-options',
	'settings'          => 'fitness_hub_theme_options[fitness-hub-menu-right-button-link]',
	'type'	  	        => 'url',
	'active_callback'   => 'fitness_hub_menu_right_button_if_link'
) );