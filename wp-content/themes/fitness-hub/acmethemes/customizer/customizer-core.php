<?php
/**
 * Header Image Display Options
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return array $fitness_hub_menu_display_options
 *
 */
if ( !function_exists('fitness_hub_menu_display_options') ) :
	function fitness_hub_menu_display_options() {
		$fitness_hub_menu_display_options =  array(
			'menu-default'      => esc_html__( 'Default', 'fitness-hub' ),
			'menu-classic'      => esc_html__( 'Classic', 'fitness-hub' ),
			'header-transparent'      => esc_html__( 'Transparent', 'fitness-hub' )
		);
		return apply_filters( 'fitness_hub_menu_display_options', $fitness_hub_menu_display_options );
	}
endif;

/**
 * Menu and Logo Display Options
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return array $fitness_hub_header_image_display
 *
 */
if ( !function_exists('fitness_hub_header_image_display') ) :
	function fitness_hub_header_image_display() {
		$fitness_hub_header_image_display =  array(
			'hide'              => esc_html__( 'Hide', 'fitness-hub' ),
			'bg-image'          => esc_html__( 'Background Image', 'fitness-hub' ),
			'normal-image'      => esc_html__( 'Normal Image', 'fitness-hub' )
		);
		return apply_filters( 'fitness_hub_header_image_display', $fitness_hub_header_image_display );
	}
endif;

/**
 * Menu Right Button Link Options
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return array $fitness_hub_menu_right_button_link_options
 *
 */
if ( !function_exists('fitness_hub_menu_right_button_link_options') ) :
	function fitness_hub_menu_right_button_link_options() {
		$fitness_hub_menu_right_button_link_options =  array(
			'disable'       => esc_html__( 'Disable', 'fitness-hub' ),
			'booking'       => esc_html__( 'Popup Widgets ( Booking Form )', 'fitness-hub' ),
			'link'          => esc_html__( 'One Link', 'fitness-hub' )
		);
		return apply_filters( 'fitness_hub_menu_right_button_link_options', $fitness_hub_menu_right_button_link_options );
	}
endif;

/**
 * Header top display options of elements
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return array $fitness_hub_header_top_display_selection
 *
 */
if ( !function_exists('fitness_hub_header_top_display_selection') ) :
	function fitness_hub_header_top_display_selection() {
		$fitness_hub_header_top_display_selection =  array(
			'hide'          => esc_html__( 'Hide', 'fitness-hub' ),
			'left'          => esc_html__( 'on Top Left', 'fitness-hub' ),
			'right'         => esc_html__( 'on Top Right', 'fitness-hub' )
		);
		return apply_filters( 'fitness_hub_header_top_display_selection', $fitness_hub_header_top_display_selection );
	}
endif;

/**
 * Feature slider text align
 *
 * @since Mercantile 1.0.0
 *
 * @param null
 * @return array $fitness_hub_slider_text_align
 *
 */
if ( !function_exists('fitness_hub_slider_text_align') ) :
	function fitness_hub_slider_text_align() {
		$fitness_hub_slider_text_align =  array(
			'alternate'     => esc_html__( 'Alternate', 'fitness-hub' ),
			'text-left'     => esc_html__( 'Left', 'fitness-hub' ),
			'text-right'    => esc_html__( 'Right', 'fitness-hub' ),
			'text-center'   => esc_html__( 'Center', 'fitness-hub' )
		);
		return apply_filters( 'fitness_hub_slider_text_align', $fitness_hub_slider_text_align );
	}
endif;

/**
 * Featured Slider Image Options
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return array $fitness_hub_fs_image_display_options
 *
 */
if ( !function_exists('fitness_hub_fs_image_display_options') ) :
	function fitness_hub_fs_image_display_options() {
		$fitness_hub_fs_image_display_options =  array(
			'full-screen-bg' => esc_html__( 'Full Screen Background', 'fitness-hub' ),
			'responsive-img' => esc_html__( 'Responsive Image', 'fitness-hub' )
		);
		return apply_filters( 'fitness_hub_fs_image_display_options', $fitness_hub_fs_image_display_options );
	}
endif;

/**
 * Feature Info number
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return array $fitness_hub_feature_info_number
 *
 */
if ( !function_exists('fitness_hub_feature_info_number') ) :
	function fitness_hub_feature_info_number() {
		$fitness_hub_feature_info_number =  array(
			1               => esc_html__( '1', 'fitness-hub' ),
			2               => esc_html__( '2', 'fitness-hub' ),
			3               => esc_html__( '3', 'fitness-hub' ),
			4               => esc_html__( '4', 'fitness-hub' ),
		);
		return apply_filters( 'fitness_hub_feature_info_number', $fitness_hub_feature_info_number );
	}
endif;

/**
 * Footer copyright beside options
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return array $fitness_hub_footer_copyright_beside_option
 *
 */
if ( !function_exists('fitness_hub_footer_copyright_beside_option') ) :
	function fitness_hub_footer_copyright_beside_option() {
		$fitness_hub_footer_copyright_beside_option =  array(
			'hide'          => esc_html__( 'Hide', 'fitness-hub' ),
			'social'        => esc_html__( 'Social Links', 'fitness-hub' ),
			'footer-menu'   => esc_html__( 'Footer Menu', 'fitness-hub' )
		);
		return apply_filters( 'fitness_hub_footer_copyright_beside_option', $fitness_hub_footer_copyright_beside_option );
	}
endif;

/**
 * Sidebar layout options
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return array $fitness_hub_sidebar_layout
 *
 */
if ( !function_exists('fitness_hub_sidebar_layout') ) :
    function fitness_hub_sidebar_layout() {
        $fitness_hub_sidebar_layout =  array(
	        'right-sidebar' => esc_html__( 'Right Sidebar', 'fitness-hub' ),
	        'left-sidebar'  => esc_html__( 'Left Sidebar' , 'fitness-hub' ),
	        'both-sidebar'  => esc_html__( 'Both Sidebar' , 'fitness-hub' ),
	        'middle-col'    => esc_html__( 'Middle Column' , 'fitness-hub' ),
	        'no-sidebar'    => esc_html__( 'No Sidebar', 'fitness-hub' )
        );
        return apply_filters( 'fitness_hub_sidebar_layout', $fitness_hub_sidebar_layout );
    }
endif;


/**
 * Blog content from
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return array $fitness_hub_blog_archive_content_from
 *
 */
if ( !function_exists('fitness_hub_blog_archive_content_from') ) :
	function fitness_hub_blog_archive_content_from() {
		$fitness_hub_blog_archive_content_from =  array(
			'excerpt'    => esc_html__( 'Excerpt', 'fitness-hub' ),
			'content'    => esc_html__( 'Content', 'fitness-hub' )
		);
		return apply_filters( 'fitness_hub_blog_archive_content_from', $fitness_hub_blog_archive_content_from );
	}
endif;

/**
 * Image Size
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return array $fitness_hub_get_image_sizes_options
 *
 */
if ( !function_exists('fitness_hub_get_image_sizes_options') ) :
	function fitness_hub_get_image_sizes_options( $add_disable = false ) {
		global $_wp_additional_image_sizes;
		$choices = array();
		if ( true == $add_disable ) {
			$choices['disable'] = esc_html__( 'No Image', 'fitness-hub' );
		}
		foreach ( array( 'thumbnail', 'medium', 'large' ) as $key => $_size ) {
			$choices[ $_size ] = $_size . ' ('. get_option( $_size . '_size_w' ) . 'x' . get_option( $_size . '_size_h' ) . ')';
		}
		$choices['full'] = esc_html__( 'full (original)', 'fitness-hub' );
		if ( ! empty( $_wp_additional_image_sizes ) && is_array( $_wp_additional_image_sizes ) ) {

			foreach ($_wp_additional_image_sizes as $key => $size ) {
				$choices[ $key ] = $key . ' ('. $size['width'] . 'x' . $size['height'] . ')';
			}
		}
		return apply_filters( 'fitness_hub_get_image_sizes_options', $choices );
	}
endif;

/**
 * Pagination Options
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return array fitness_hub_pagination_options
 *
 */
if ( !function_exists('fitness_hub_pagination_options') ) :
	function fitness_hub_pagination_options() {
		$fitness_hub_pagination_options =  array(
			'default'  => esc_html__( 'Default', 'fitness-hub' ),
			'numeric'  => esc_html__( 'Numeric', 'fitness-hub' )
		);
		return apply_filters( 'fitness_hub_pagination_options', $fitness_hub_pagination_options );
	}
endif;

/**
 * Breadcrumb Options
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return array fitness_hub_breadcrumb_options
 *
 */
if ( !function_exists('fitness_hub_breadcrumb_options') ) :
	function fitness_hub_breadcrumb_options() {
		$fitness_hub_breadcrumb_options =  array(
			'hide'  => esc_html__( 'Hide', 'fitness-hub' ),
		);
		if ( function_exists('yoast_breadcrumb') ) {
			$fitness_hub_breadcrumb_options['yoast'] = esc_html__( 'Yoast', 'fitness-hub' );
		}
		if ( function_exists('bcn_display') ) {
			$fitness_hub_breadcrumb_options['bcn'] = esc_html__( 'Breadcrumb NavXT', 'fitness-hub' );
		}
		return apply_filters( 'fitness_hub_pagination_options', $fitness_hub_breadcrumb_options );
	}
endif;

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