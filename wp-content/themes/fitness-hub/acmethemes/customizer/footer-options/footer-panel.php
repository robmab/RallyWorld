<?php
/*adding footer options panel*/
$wp_customize->add_panel( 'fitness-hub-footer-panel', array(
    'priority'       => 80,
    'capability'     => 'edit_theme_options',
    'title'          => esc_html__( 'Footer Options', 'fitness-hub' ),
    'description'    => esc_html__( 'Customize your awesome site footer ', 'fitness-hub' )
) );

/*
* file for background image
*/
require fitness_hub_file_directory('acmethemes/customizer/footer-options/footer-bg-img.php');

/*
* file for footer logo options
*/
require fitness_hub_file_directory('acmethemes/customizer/footer-options/footer-copyright.php');