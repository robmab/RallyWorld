<?php
/*adding theme options panel*/
$wp_customize->add_panel( 'fitness-hub-options', array(
    'priority'       => 90,
    'capability'     => 'edit_theme_options',
    'title'          => esc_html__( 'Theme Options', 'fitness-hub' ),
    'description'    => esc_html__( 'Customize your awesome site with theme options ', 'fitness-hub' )
) );

/*
* file for header breadcrumb options
*/
require fitness_hub_file_directory('acmethemes/customizer/options/breadcrumb.php');

/*
* file for header search options
*/
require fitness_hub_file_directory('acmethemes/customizer/options/search.php');

/*
* file for social options
*/
require fitness_hub_file_directory('acmethemes/customizer/options/social-options.php');