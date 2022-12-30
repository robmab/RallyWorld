<?php
/**
 * Sanitize choices
 * @since Fitness Hub 1.0.0
 * @param null
 * @return string $fitness_hub_about_column_number
 *
 */
if ( ! function_exists( 'fitness_hub_sanitize_choice_options' ) ) :
	function fitness_hub_sanitize_choice_options( $value, $choices, $default ) {
		$input = wp_kses_post( $value );
		$output = array_key_exists( $input, $choices ) ? $input : $default;
		return $output;
	}
endif;

/**
 * Common functions for widgets
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 *
 * @return array $fitness_hub_about_column_number
 *
 */
if ( ! function_exists( 'fitness_hub_background_options' ) ) :
	function fitness_hub_background_options() {
		$fitness_hub_about_column_number = array(
			'default'   => esc_html__( 'Default', 'fitness-hub' ),
			'gray'      => esc_html__( 'Gray', 'fitness-hub' )
		);

		return apply_filters( 'fitness_hub_background_options', $fitness_hub_about_column_number );
	}
endif;

/**
 * Column Number
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 *
 * @return array $fitness_hub_about_column_number
 *
 */
if ( ! function_exists( 'fitness_hub_widget_column_number' ) ) :
	function fitness_hub_widget_column_number() {
		$fitness_hub_about_column_number = array(
			1 => esc_html__( '1', 'fitness-hub' ),
			2 => esc_html__( '2', 'fitness-hub' ),
			3 => esc_html__( '3', 'fitness-hub' ),
			4 => esc_html__( '4', 'fitness-hub' )
		);
		return apply_filters( 'fitness_hub_widget_column_number', $fitness_hub_about_column_number );
	}
endif;

/**
 * Widget Image Popup Type
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return array $fitness_hub_gallery_image_popup
 *
 */
if ( !function_exists('fitness_hub_gallery_image_popup') ) :
	function fitness_hub_gallery_image_popup() {
		$fitness_hub_gallery_image_popup =  array(
			'gallery'   => esc_html__( 'Gallery', 'fitness-hub' ),
			'single'    => esc_html__( 'Single', 'fitness-hub' ),
			'disable'   => esc_html__( 'Disable', 'fitness-hub' ),
		);
		return apply_filters( 'fitness_hub_gallery_image_popup', $fitness_hub_gallery_image_popup );
	}
endif;

/**
 * Content From
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 *
 * @return array $fitness_hub_content_from
 *
 */
if ( ! function_exists( 'fitness_hub_content_from' ) ) :
	function fitness_hub_content_from() {
		$fitness_hub_about_column_number = array(
			'excerpt' => esc_html__( 'Excerpt', 'fitness-hub' ),
			'content' => esc_html__( 'Content', 'fitness-hub' )
		);
		return apply_filters( 'fitness_hub_content_from', $fitness_hub_about_column_number );
	}
endif;

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fitness_hub_widgets_init() {
	register_sidebar( array(
        'name'          => esc_html__( 'Right Sidebar', 'fitness-hub' ),
        'id'            => 'fitness-hub-sidebar',
        'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    if ( is_customize_preview() ) {
        $fitness_hub_home_description = sprintf( esc_html__( 'Displays widgets on home page main content area.%1$s Note : Please go to %2$s "Static Front Page"%3$s setting, Select "A static page" then "Front page" and "Posts page" to show added widgets', 'fitness-hub' ), '<br />','<b><a class="at-customizer" data-section="static_front_page" style="cursor: pointer">','</a></b>' );
    }
    else{
        $fitness_hub_home_description = esc_html__( 'Displays widgets on Front/Home page. Note : Please go to Setting => Reading, Select "A static page" then "Front page" and "Posts page" to show added widgets', 'fitness-hub' );
    }
    register_sidebar(array(
        'name'          => esc_html__('Home Main Content Area', 'fitness-hub'),
        'id'            => 'fitness-hub-home',
        'description'	=> $fitness_hub_home_description,
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title init-animate zoomIn"><span>',
        'after_title'   => '</span></h2>',
    ));

	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'fitness-hub' ),
		'id'            => 'fitness-hub-sidebar-left',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

    register_sidebar(array(
        'name'          => esc_html__('Footer Column One', 'fitness-hub'),
        'id'            => 'footer-col-one',
        'description'   => esc_html__('Displays items on top footer section.', 'fitness-hub'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title"><span>',
        'after_title'   => '</span></h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Column Two', 'fitness-hub'),
        'id'            => 'footer-col-two',
        'description'   => esc_html__('Displays items on top footer section.', 'fitness-hub'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title"><span>',
        'after_title'   => '</span></h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Column Three', 'fitness-hub'),
        'id'            => 'footer-col-three',
        'description'   => esc_html__('Displays items on top footer section.', 'fitness-hub'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title"><span>',
        'after_title'   => '</span></h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Column Four', 'fitness-hub'),
        'id'            => 'footer-col-four',
        'description'   => esc_html__('Displays items on top footer section.', 'fitness-hub'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title"><span>',
        'after_title'   => '</span></h3>',
    ));

	register_sidebar(array(
		'name'          => esc_html__('Popup Widget Area', 'fitness-hub'),
		'id'            => 'popup-widget-area',
		'description'   => esc_html__('Displays items on Pop up', 'fitness-hub'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));

    /*Widgets*/
	register_widget( 'Fitness_Hub_About' );
	register_widget( 'Fitness_Hub_Posts_Col' );
	register_widget( 'Fitness_Hub_Contact' );
	register_widget( 'Fitness_Hub_Service' );
	register_widget( 'Fitness_Hub_Gallery' );
	register_widget( 'Fitness_Hub_Social' );
	register_widget( 'Fitness_Hub_Team' );
	register_widget( 'Fitness_Hub_Testimonial' );
	register_widget( 'Fitness_Hub_Feature' );
	register_widget( 'Fitness_Hub_Class' );
}
add_action( 'widgets_init', 'fitness_hub_widgets_init' );

/* ajax callback for get_edit_post_link*/
add_action( 'wp_ajax_at_get_edit_post_link', 'fitness_hub_get_edit_post_link' );
function fitness_hub_get_edit_post_link(){
    if( isset( $_GET['id'] ) ){
	    $id = absint( $_GET['id'] );
	    if( get_edit_post_link( $id ) ){
		    ?>
            <a class="button button-link at-postid alignright" target="_blank" href="<?php echo esc_url( get_edit_post_link( $id ) ); ?>">
			    <?php esc_html_e('Full Edit','fitness-hub');?>
            </a>
		    <?php
	    }
	    else{
		    echo 0;
	    }
	    exit;
    }
}