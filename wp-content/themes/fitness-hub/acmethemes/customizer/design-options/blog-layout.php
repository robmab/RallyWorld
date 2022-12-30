<?php
/*active callback function for excerpt*/
if ( !function_exists('fitness_hub_active_callback_content_from_excerpt') ) :
	function fitness_hub_active_callback_content_from_excerpt() {
		$fitness_hub_customizer_all_values = fitness_hub_get_theme_options();
		if( 'excerpt' == $fitness_hub_customizer_all_values['fitness-hub-blog-archive-content-from'] ){
			return true;
		}
		return false;
	}
endif;

/*adding sections for blog layout options*/
$wp_customize->add_section( 'fitness-hub-design-blog-layout-option', array(
    'priority'       => 30,
    'capability'     => 'edit_theme_options',
    'title'          => esc_html__( 'Default Blog/Archive Layout', 'fitness-hub' ),
    'panel'          => 'fitness-hub-design-panel'
) );

/*blog layout*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-blog-archive-img-size]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['fitness-hub-blog-archive-img-size'],
    'sanitize_callback' => 'fitness_hub_sanitize_select'
) );
$choices = fitness_hub_get_image_sizes_options(1);
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-blog-archive-img-size]', array(
    'choices'  	    => $choices,
    'label'		    => esc_html__( 'Blog/Archive Feature Image Size', 'fitness-hub' ),
    'section'       => 'fitness-hub-design-blog-layout-option',
    'settings'      => 'fitness_hub_theme_options[fitness-hub-blog-archive-img-size]',
    'type'	  	    => 'select'
) );

/*blog content from*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-blog-archive-content-from]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['fitness-hub-blog-archive-content-from'],
	'sanitize_callback' => 'fitness_hub_sanitize_select'
) );
$choices = fitness_hub_blog_archive_content_from();
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-blog-archive-content-from]', array(
	'choices'  	    => $choices,
	'label'		    => esc_html__( 'Blog/Archive Content From', 'fitness-hub' ),
	'section'       => 'fitness-hub-design-blog-layout-option',
	'settings'      => 'fitness_hub_theme_options[fitness-hub-blog-archive-content-from]',
	'type'	  	    => 'select'
) );

/*Excerpt Length*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-blog-archive-excerpt-length]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['fitness-hub-blog-archive-excerpt-length'],
	'sanitize_callback' => 'absint'
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-blog-archive-excerpt-length]', array(
	'label'		        => esc_html__( 'Except Length', 'fitness-hub' ),
	'section'           => 'fitness-hub-design-blog-layout-option',
	'settings'          => 'fitness_hub_theme_options[fitness-hub-blog-archive-excerpt-length]',
	'type'	  	        => 'number',
	'active_callback'   => 'fitness_hub_active_callback_content_from_excerpt'
) );

/*Read More Text*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-blog-archive-more-text]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['fitness-hub-blog-archive-more-text'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-blog-archive-more-text]', array(
    'label'		=> esc_html__( 'Read More Text', 'fitness-hub' ),
    'section'   => 'fitness-hub-design-blog-layout-option',
    'settings'  => 'fitness_hub_theme_options[fitness-hub-blog-archive-more-text]',
    'type'	  	=> 'text'
) );

/*Pagination Options*/
$wp_customize->add_setting( 'fitness_hub_theme_options[fitness-hub-pagination-option]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['fitness-hub-pagination-option'],
	'sanitize_callback' => 'fitness_hub_sanitize_select'
) );
$choices = fitness_hub_pagination_options();
$wp_customize->add_control( 'fitness_hub_theme_options[fitness-hub-pagination-option]', array(
	'choices'  	    => $choices,
	'label'		    => esc_html__( 'Pagination Options', 'fitness-hub' ),
	'description'   => esc_html__( 'Blog and Archive Pages Pagination', 'fitness-hub' ),
	'section'       => 'fitness-hub-design-blog-layout-option',
	'settings'      => 'fitness_hub_theme_options[fitness-hub-pagination-option]',
	'type'	  	    => 'select'
) );