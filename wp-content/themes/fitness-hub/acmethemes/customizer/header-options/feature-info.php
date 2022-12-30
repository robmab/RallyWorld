<?php
/*adding sections for feature info options */
$wp_customize->add_section( 'fitness-hub-feature-info', array(
	'priority'       => 20,
	'capability'     => 'edit_theme_options',
	'title'          => esc_html__( 'Feature Info', 'fitness-hub' ),
	'panel'          => 'fitness-hub-header-panel'
) );

/* basic info number*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-feature-info-number]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['fitness-hub-feature-info-number'],
	'sanitize_callback' => 'fitness_hub_sanitize_select'
) );
$choices = fitness_hub_feature_info_number();
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-feature-info-number]', array(
	'choices'  	        => $choices,
	'label'		        => esc_html__( 'Basic Info Number Display', 'fitness-hub' ),
	'section'           => 'fitness-hub-feature-info',
	'settings'          => 'fitness_hub_theme_options[fitness-hub-feature-info-number]',
	'type'	  	        => 'select',
) );

/*first info*/
$wp_customize->add_setting('fitness_hub_theme_options[fitness-hub-first-info-message]', array(
	'capability'		=> 'edit_theme_options',
	'sanitize_callback' => 'wp_kses_post'
));

$wp_customize->add_control(
	new Fitness_Hub_Customize_Message_Control(
		$wp_customize,
		'fitness_hub_theme_options[fitness-hub-first-info-message]',
		array(
			'section'      => 'fitness-hub-feature-info',
			'description'  => "<hr /><h2>".esc_html__('First Info','fitness-hub')."</h2>",
			'settings'     => 'fitness_hub_theme_options[fitness-hub-first-info-message]',
			'type'	  	   => 'message',
		)
	)
);
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-first-info-icon]', array(
	'capability'		    => 'edit_theme_options',
	'default'			    => $defaults['fitness-hub-first-info-icon'],
	'sanitize_callback'     => 'fitness_hub_sanitize_allowed_html'
) );

$wp_customize->add_control(
	new Fitness_Hub_Customize_Icons_Control(
		$wp_customize,
		'fitness_hub_theme_options[fitness-hub-first-info-icon]',
		array(
			'label'		    => esc_html__( 'Icon', 'fitness-hub' ),
			'section'       => 'fitness-hub-feature-info',
			'settings'      => 'fitness_hub_theme_options[fitness-hub-first-info-icon]',
			'type'	  	    => 'text'
		)
	)
);

$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-first-info-title]', array(
	'capability'		    => 'edit_theme_options',
	'default'			    => $defaults['fitness-hub-first-info-title'],
	'sanitize_callback'     => 'fitness_hub_sanitize_allowed_html'
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-first-info-title]', array(
	'label'		            => esc_html__( 'Title', 'fitness-hub' ),
	'section'               => 'fitness-hub-feature-info',
	'settings'              => 'fitness_hub_theme_options[fitness-hub-first-info-title]',
	'type'	  	            => 'text'
) );

$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-first-info-desc]', array(
	'capability'		    => 'edit_theme_options',
	'default'			    => $defaults['fitness-hub-first-info-desc'],
	'sanitize_callback'     => 'fitness_hub_sanitize_allowed_html'
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-first-info-desc]', array(
	'label'		            => esc_html__( 'Very Short Description', 'fitness-hub' ),
	'section'               => 'fitness-hub-feature-info',
	'settings'              => 'fitness_hub_theme_options[fitness-hub-first-info-desc]',
	'type'	  	            => 'text'
) );

/*Second Info*/
$wp_customize->add_setting('fitness_hub_theme_options[fitness-hub-second-info-message]', array(
	'capability'		    => 'edit_theme_options',
	'sanitize_callback'     => 'wp_kses_post'
));

$wp_customize->add_control(
	new Fitness_Hub_Customize_Message_Control(
		$wp_customize,
		'fitness_hub_theme_options[fitness-hub-second-info-message]',
		array(
			'section'       => 'fitness-hub-feature-info',
			'description'   => "<hr /><h2>".esc_html__('Second Info','fitness-hub')."</h2>",
			'settings'      => 'fitness_hub_theme_options[fitness-hub-second-info-message]',
			'type'	  	    => 'message',
		)
	)
);
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-second-info-icon]', array(
	'capability'		    => 'edit_theme_options',
	'default'			    => $defaults['fitness-hub-second-info-icon'],
	'sanitize_callback'     => 'fitness_hub_sanitize_allowed_html'
) );
$wp_customize->add_control(
	new Fitness_Hub_Customize_Icons_Control(
		$wp_customize,
		'fitness_hub_theme_options[fitness-hub-second-info-icon]',
		array(
			'label'		    => esc_html__( 'Icon', 'fitness-hub' ),
			'section'       => 'fitness-hub-feature-info',
			'settings'      => 'fitness_hub_theme_options[fitness-hub-second-info-icon]',
			'type'	  	    => 'text'
		)
	)
);

$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-second-info-title]', array(
	'capability'		    => 'edit_theme_options',
	'default'			    => $defaults['fitness-hub-second-info-title'],
	'sanitize_callback'     => 'fitness_hub_sanitize_allowed_html'
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-second-info-title]', array(
	'label'		            => esc_html__( 'Title', 'fitness-hub' ),
	'section'               => 'fitness-hub-feature-info',
	'settings'              => 'fitness_hub_theme_options[fitness-hub-second-info-title]',
	'type'	  	            => 'text'
) );

$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-second-info-desc]', array(
	'capability'		    => 'edit_theme_options',
	'default'			    => $defaults['fitness-hub-second-info-desc'],
	'sanitize_callback'     => 'fitness_hub_sanitize_allowed_html'
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-second-info-desc]', array(
	'label'		            => esc_html__( 'Very Short Description', 'fitness-hub' ),
	'section'               => 'fitness-hub-feature-info',
	'settings'              => 'fitness_hub_theme_options[fitness-hub-second-info-desc]',
	'type'	  	            => 'text'
) );

/*third info*/
$wp_customize->add_setting('fitness_hub_theme_options[fitness-hub-third-info-message]', array(
	'capability'		    => 'edit_theme_options',
	'sanitize_callback'     => 'wp_kses_post'
));

$wp_customize->add_control(
	new Fitness_Hub_Customize_Message_Control(
		$wp_customize,
		'fitness_hub_theme_options[fitness-hub-third-info-message]',
		array(
			'section'       => 'fitness-hub-feature-info',
			'description'   => "<hr /><h2>".esc_html__('Third Info','fitness-hub')."</h2>",
			'settings'      => 'fitness_hub_theme_options[fitness-hub-third-info-message]',
			'type'	  	    => 'message',
		)
	)
);
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-third-info-icon]', array(
	'capability'		    => 'edit_theme_options',
	'default'			    => $defaults['fitness-hub-third-info-icon'],
	'sanitize_callback'     => 'fitness_hub_sanitize_allowed_html'
) );
$wp_customize->add_control(
	new Fitness_Hub_Customize_Icons_Control(
		$wp_customize,
		'fitness_hub_theme_options[fitness-hub-third-info-icon]',
		array(
			'label'		    => esc_html__( 'Icon', 'fitness-hub' ),
			'section'       => 'fitness-hub-feature-info',
			'settings'      => 'fitness_hub_theme_options[fitness-hub-third-info-icon]',
			'type'	  	    => 'text'
		)
	)
);

$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-third-info-title]', array(
	'capability'		    => 'edit_theme_options',
	'default'			    => $defaults['fitness-hub-third-info-title'],
	'sanitize_callback'     => 'fitness_hub_sanitize_allowed_html'
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-third-info-title]', array(
	'label'		            => esc_html__( 'Title', 'fitness-hub' ),
	'section'               => 'fitness-hub-feature-info',
	'settings'              => 'fitness_hub_theme_options[fitness-hub-third-info-title]',
	'type'	  	            => 'text'
) );

$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-third-info-desc]', array(
	'capability'		    => 'edit_theme_options',
	'default'			    => $defaults['fitness-hub-third-info-desc'],
	'sanitize_callback'     => 'fitness_hub_sanitize_allowed_html'
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-third-info-desc]', array(
	'label'		            => esc_html__( 'Very Short Description', 'fitness-hub' ),
	'section'               => 'fitness-hub-feature-info',
	'settings'              => 'fitness_hub_theme_options[fitness-hub-third-info-desc]',
	'type'	  	            => 'text'
) );

/*forth info*/
$wp_customize->add_setting('fitness_hub_theme_options[fitness-hub-forth-info-message]', array(
	'capability'		    => 'edit_theme_options',
	'sanitize_callback'     => 'wp_kses_post'
));

$wp_customize->add_control(
	new Fitness_Hub_Customize_Message_Control(
		$wp_customize,
		'fitness_hub_theme_options[fitness-hub-forth-info-message]',
		array(
			'section'       => 'fitness-hub-feature-info',
			'description'   => "<hr /><h2>".esc_html__('Forth Info','fitness-hub')."</h2>",
			'settings'      => 'fitness_hub_theme_options[fitness-hub-forth-info-message]',
			'type'	  	    => 'message',
		)
	)
);
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-forth-info-icon]', array(
	'capability'		    => 'edit_theme_options',
	'default'			    => $defaults['fitness-hub-forth-info-icon'],
	'sanitize_callback'     => 'fitness_hub_sanitize_allowed_html'
) );
$wp_customize->add_control(
	new Fitness_Hub_Customize_Icons_Control(
		$wp_customize,
		'fitness_hub_theme_options[fitness-hub-forth-info-icon]',
		array(
			'label'		    => esc_html__( 'Icon', 'fitness-hub' ),
			'section'       => 'fitness-hub-feature-info',
			'settings'      => 'fitness_hub_theme_options[fitness-hub-forth-info-icon]',
			'type'	  	    => 'text'
		)
	)
);

$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-forth-info-title]', array(
	'capability'		    => 'edit_theme_options',
	'default'			    => $defaults['fitness-hub-forth-info-title'],
	'sanitize_callback'     => 'fitness_hub_sanitize_allowed_html'
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-forth-info-title]', array(
	'label'		            => esc_html__( 'Title', 'fitness-hub' ),
	'section'               => 'fitness-hub-feature-info',
	'settings'              => 'fitness_hub_theme_options[fitness-hub-forth-info-title]',
	'type'	  	            => 'text'
) );

$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-forth-info-desc]', array(
	'capability'		    => 'edit_theme_options',
	'default'			    => $defaults['fitness-hub-forth-info-desc'],
	'sanitize_callback'     => 'fitness_hub_sanitize_allowed_html'
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-forth-info-desc]', array(
	'label'		            => esc_html__( 'Very Short Description', 'fitness-hub' ),
	'section'               => 'fitness-hub-feature-info',
	'settings'              => 'fitness_hub_theme_options[fitness-hub-forth-info-desc]',
	'type'	  	            => 'text'
) );