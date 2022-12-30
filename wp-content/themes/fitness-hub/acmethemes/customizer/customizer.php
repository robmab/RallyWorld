<?php
/**
 * Fitness Hub Theme Customizer.
 *
 * @package Acme Themes
 * @subpackage Fitness Hub
 */

/*
* file for customizer core functions
*/
require fitness_hub_file_directory('acmethemes/customizer/customizer-core.php');

/*
* file for customizer sanitization functions
*/
require fitness_hub_file_directory('acmethemes/customizer/sanitize-functions.php');

/**
 * Adding different options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function fitness_hub_customize_register( $wp_customize ) {

    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

    /*saved options*/
    $options  = fitness_hub_get_theme_options();

    /*defaults options*/
    $defaults = fitness_hub_get_default_theme_options();

    /*custom controls*/
    require fitness_hub_file_directory('acmethemes/customizer/custom-controls.php');
	require fitness_hub_file_directory('acmethemes/customizer/customizer-repeater/customizer-control-repeater.php');

    /*
     * file for feature panel of home page
     */
    require fitness_hub_file_directory('acmethemes/customizer/feature-section/feature-panel.php');

    /*
    * file for header panel
    */
    require fitness_hub_file_directory('acmethemes/customizer/header-options/header-panel.php');

    /*
    * file for customizer footer section
    */
    require fitness_hub_file_directory('acmethemes/customizer/footer-options/footer-panel.php');

    /*
    * file for design/layout panel
    */
    require fitness_hub_file_directory('acmethemes/customizer/design-options/design-panel.php');

	/*
   * file for single panel
   */
	require fitness_hub_file_directory('acmethemes/customizer/single-posts/single-post-panel.php');

    /*
     * file for options panel
     */
    require fitness_hub_file_directory('acmethemes/customizer/options/options-panel.php');

	/*woocommerce options*/
	if ( fitness_hub_is_woocommerce_active() ) :
		require_once fitness_hub_file_directory('acmethemes/customizer/wc-options/wc-panel.php');
	endif;

    /*sorting core and widget for ease of theme use*/
    $wp_customize->get_section( 'static_front_page' )->priority = 10;
    
    $fitness_hub_home_section = $wp_customize->get_section( 'sidebar-widgets-fitness-hub-home' );
    if ( ! empty( $fitness_hub_home_section ) ) {
        $fitness_hub_home_section->panel         = '';
        $fitness_hub_home_section->title         = esc_html__( 'Home Main Content Area ', 'fitness-hub' );
        $fitness_hub_home_section->priority      = 80;
    }
}
add_action( 'customize_register', 'fitness_hub_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function fitness_hub_customize_preview_js() {
    wp_enqueue_script( 'fitness-hub-customizer', get_template_directory_uri() . '/acmethemes/core/js/customizer.js', array( 'customize-preview' ), '1.0.0', true );
}
add_action( 'customize_preview_init', 'fitness_hub_customize_preview_js' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function fitness_hub_customize_controls_scripts() {
    wp_enqueue_script( 'fitness-hub-customizer-controls', get_template_directory_uri() . '/acmethemes/core/js/customizer-controls.js', array( 'customize-preview' ), '1.0.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'fitness_hub_customize_controls_scripts' );