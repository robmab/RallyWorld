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