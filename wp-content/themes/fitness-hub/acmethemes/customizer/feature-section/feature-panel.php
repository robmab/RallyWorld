<?php
/*adding feature options panel*/
$wp_customize->add_panel( 'fitness-hub-feature-panel', array(
    'priority'       => 40,
    'capability'     => 'edit_theme_options',
    'title'          => esc_html__( 'Featured Section Options', 'fitness-hub' ),
    'description'    => esc_html__( 'Customize your awesome site feature section ', 'fitness-hub' )
) );

/*
* file for feature section enable
*/
require fitness_hub_file_directory('acmethemes/customizer/feature-section/feature-enable.php');

/*
* file for feature slider category
*/
require fitness_hub_file_directory('acmethemes/customizer/feature-section/feature-slider.php');