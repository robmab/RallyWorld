<?php
/**
 * Fitness Hub functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Acme Themes
 * @subpackage Fitness Hub
 */


/**
 * Default Theme layout options
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return array $fitness_hub_theme_layout
 *
 */
if ( !function_exists('fitness_hub_get_default_theme_options') ) :
    function fitness_hub_get_default_theme_options() {

        $default_theme_options = array(

            /*logo and site title*/
            'fitness-hub-display-site-logo'      => '',
            'fitness-hub-display-site-title'     => 1,
            'fitness-hub-display-site-tagline'   => 1,

            /*header height*/
            'fitness-hub-header-height'          => 300,
            'fitness-hub-header-image-display'   => 'normal-image',

            /*header top*/
            'fitness-hub-enable-header-top'       => '',
            'fitness-hub-header-top-menu-display-selection'      => 'right',
            'fitness-hub-header-top-info-display-selection'      => 'left',
            'fitness-hub-header-top-social-display-selection'    => 'right',

            /*menu options*/
            'fitness-hub-menu-display-options'      => 'menu-default',
            'fitness-hub-enable-sticky'                  => '',
            'fitness-hub-menu-right-button-options'      => 'disable',
            'fitness-hub-menu-right-button-title'        => esc_html__('Request a Quote','fitness-hub'),
            'fitness-hub-menu-right-button-link'         => '',
            'fitness-hub-enable-cart-icon'               => '',

            /*feature section options*/
            'fitness-hub-enable-feature'                         => '',
            'fitness-hub-slides-data'                            => '',
            'fitness-hub-feature-slider-enable-animation'        => 1,
            'fitness-hub-feature-slider-display-title'           => 1,
            'fitness-hub-feature-slider-display-excerpt'         => 1,
            'fitness-hub-fs-image-display-options'               => 'full-screen-bg',
            'fitness-hub-feature-slider-text-align'              => 'text-left',

            /*basic info*/
            'fitness-hub-feature-info-number'    => 4,
            'fitness-hub-first-info-icon'        => 'fa-calendar',
            'fitness-hub-first-info-title'       => esc_html__('Send Us a Mail', 'fitness-hub'),
            'fitness-hub-first-info-desc'        => esc_html__('domain@example.com ', 'fitness-hub'),
            'fitness-hub-second-info-icon'       => 'fa-map-marker',
            'fitness-hub-second-info-title'      => esc_html__('Our Location', 'fitness-hub'),
            'fitness-hub-second-info-desc'       => esc_html__('Elmonte California', 'fitness-hub'),
            'fitness-hub-third-info-icon'        => 'fa-phone',
            'fitness-hub-third-info-title'       => esc_html__('Call Us', 'fitness-hub'),
            'fitness-hub-third-info-desc'        => esc_html__('01-23456789-10', 'fitness-hub'),
            'fitness-hub-forth-info-icon'        => 'fa-envelope-o',
            'fitness-hub-forth-info-title'       => esc_html__('Office Hours', 'fitness-hub'),
            'fitness-hub-forth-info-desc'        => esc_html__('8 hours per day', 'fitness-hub'),

            /*footer options*/
            'fitness-hub-footer-copyright'                       => esc_html__( '&copy; All right reserved', 'fitness-hub' ),
            'fitness-hub-footer-copyright-beside-option'         => 'footer-menu',
            'fitness-hub-enable-footer-power-text'               => 1,
            'fitness-hub-footer-bg-img'                          => '',

            /*layout/design options*/
            'fitness-hub-pagination-option'      => 'numeric',

            'fitness-hub-enable-animation'       => '',

            'fitness-hub-single-sidebar-layout'                  => 'right-sidebar',
            'fitness-hub-front-page-sidebar-layout'              => 'right-sidebar',
            'fitness-hub-archive-sidebar-layout'                 => 'right-sidebar',

            'fitness-hub-blog-archive-img-size'                  => 'full',
            'fitness-hub-blog-archive-content-from'              => 'excerpt',
            'fitness-hub-blog-archive-excerpt-length'            => 42,
            'fitness-hub-blog-archive-more-text'                 => esc_html__( 'Read More', 'fitness-hub' ),

            'fitness-hub-primary-color'          => '#e83d47',
            'fitness-hub-header-top-bg-color'    => '#191919',
            'fitness-hub-footer-bg-color'        => '#1f1f1f',
            'fitness-hub-footer-bottom-bg-color' => '#2d2d2d',
            'fitness-hub-link-color'             => '#e83d47',
            'fitness-hub-link-hover-color'       => '#d6111e',

            /*Front Page*/
            'fitness-hub-hide-front-page-content' => '',
            'fitness-hub-hide-front-page-header'  => '',

            /*woocommerce*/
            'fitness-hub-wc-shop-archive-sidebar-layout'     => 'no-sidebar',
            'fitness-hub-wc-product-column-number'           => 4,
            'fitness-hub-wc-shop-archive-total-product'      => 16,
            'fitness-hub-wc-single-product-sidebar-layout'   => 'no-sidebar',

            /*single post*/
            'fitness-hub-single-header-title'            => esc_html__( 'Blog', 'fitness-hub' ),
            'fitness-hub-single-img-size'                => 'full',

            /*theme options*/
            'fitness-hub-popup-widget-title'     => esc_html__( 'Request a Quote', 'fitness-hub' ),
            'fitness-hub-breadcrumb-options'        => 'hide',
            'fitness-hub-search-placeholder'     => esc_html__( 'Search', 'fitness-hub' ),
            'fitness-hub-social-data'            => '',
        );
        return apply_filters( 'fitness_hub_default_theme_options', $default_theme_options );
    }
endif;

/**
 * Get theme options
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return array fitness_hub_theme_options
 *
 */
if ( !function_exists('fitness_hub_get_theme_options') ) :
    function fitness_hub_get_theme_options() {

        $fitness_hub_default_theme_options = fitness_hub_get_default_theme_options();
        $fitness_hub_get_theme_options = get_theme_mod( 'fitness_hub_theme_options');
        if( is_array( $fitness_hub_get_theme_options )){
            return array_merge( $fitness_hub_default_theme_options ,$fitness_hub_get_theme_options );
        }
        else{
            return $fitness_hub_default_theme_options;
        }
    }
endif;

$fitness_hub_saved_theme_options = fitness_hub_get_theme_options();
$GLOBALS['fitness_hub_customizer_all_values'] = $fitness_hub_saved_theme_options;

/**
 * Require init.
 */
require trailingslashit( get_template_directory() ).'acmethemes/init.php';