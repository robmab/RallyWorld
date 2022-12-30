<?php
/**
 * Setting global variables for all theme options saved values
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( ! function_exists( 'fitness_hub_set_global' ) ) :
    function fitness_hub_set_global() {
        /*Getting saved values start*/
        $fitness_hub_saved_theme_options = fitness_hub_get_theme_options();
        $GLOBALS['fitness_hub_customizer_all_values'] = $fitness_hub_saved_theme_options;
        /*Getting saved values end*/
    }
endif;
add_action( 'fitness_hub_action_before_head', 'fitness_hub_set_global', 0 );

/**
 * Doctype Declaration
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( ! function_exists( 'fitness_hub_doctype' ) ) :
    function fitness_hub_doctype() {
        ?>
        <!DOCTYPE html><html <?php language_attributes(); ?>>
        <?php
    }
endif;
add_action( 'fitness_hub_action_before_head', 'fitness_hub_doctype', 10 );

/**
 * Code inside head tage but before wp_head funtion
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( ! function_exists( 'fitness_hub_before_wp_head' ) ) :

    function fitness_hub_before_wp_head() {
        ?>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
         <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="profile" href="//gmpg.org/xfn/11">
        <?php
    }
endif;
add_action( 'fitness_hub_action_before_wp_head', 'fitness_hub_before_wp_head', 10 );

/**
 * Add body class
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return array
 *
 */
if ( ! function_exists( 'fitness_hub_body_class' ) ) :

    function fitness_hub_body_class( $fitness_hub_body_classes ) {

        global $fitness_hub_customizer_all_values;
        $fitness_hub_enable_animation = $fitness_hub_customizer_all_values['fitness-hub-enable-animation'];

        $fitness_hub_menu_display_position = $fitness_hub_customizer_all_values['fitness-hub-menu-display-options'];
        $fitness_hub_body_classes[] = esc_attr( $fitness_hub_menu_display_position );

        $fitness_hub_enable_header_top = $fitness_hub_customizer_all_values['fitness-hub-enable-header-top'];
        /*wow animation*/
        if( 1 != $fitness_hub_enable_animation ){
            $fitness_hub_body_classes[] = 'acme-animate';
        }
        $fitness_hub_body_classes[] = fitness_hub_sidebar_selection();

        $fitness_hub_enable_feature = $fitness_hub_customizer_all_values['fitness-hub-enable-feature'];

        if( 1 == $fitness_hub_enable_header_top  ){
             $fitness_hub_body_classes[] = 'header-enable-top';
        }
    
        if ( 1 != $fitness_hub_enable_feature && is_front_page()){
            $fitness_hub_body_classes[] = 'at-front-no-feature';
        }
        return $fitness_hub_body_classes;
    }
endif;
add_action( 'body_class', 'fitness_hub_body_class', 10, 1 );

/**
 * Start site div
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'fitness_hub_site_start' ) ) :

    function fitness_hub_site_start() {
        ?>
        <div class="site" id="page">
        <?php
    }
endif;
add_action( 'fitness_hub_action_before', 'fitness_hub_site_start', 20 );

/**
 * Skip to content
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( ! function_exists( 'fitness_hub_skip_to_content' ) ) :

    function fitness_hub_skip_to_content() {
        ?>
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'fitness-hub' ); ?></a>
        <?php
    }
endif;
add_action( 'fitness_hub_action_before_header', 'fitness_hub_skip_to_content', 10 );

/**
 * Main header
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( ! function_exists( 'fitness_hub_header' ) ) :
    function fitness_hub_header() {
        global $fitness_hub_customizer_all_values;
        $fitness_hub_enable_header_top = $fitness_hub_customizer_all_values['fitness-hub-enable-header-top'];
	    $fitness_hub_nav_class = '';
	    $fitness_hub_enable_sticky = $fitness_hub_customizer_all_values['fitness-hub-enable-sticky'];
	    if( 1 == $fitness_hub_enable_sticky ){
		    $fitness_hub_nav_class .= ' fitness-hub-sticky';
	    }
    
        if( 1 == $fitness_hub_enable_header_top ){
            ?>
            <div class="top-header">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <?php
                                $fitness_hub_header_top_menu_display_selection = $fitness_hub_customizer_all_values['fitness-hub-header-top-menu-display-selection'];
                                $fitness_hub_header_top_info_display_selection = $fitness_hub_customizer_all_values['fitness-hub-header-top-info-display-selection'];
                                $fitness_hub_header_top_social_display_selection = $fitness_hub_customizer_all_values['fitness-hub-header-top-social-display-selection'];

                                if( 'left' == $fitness_hub_header_top_menu_display_selection ){
                                    do_action('fitness_hub_action_top_menu');
                                }
                                if( 'left' == $fitness_hub_header_top_social_display_selection ){
                                    do_action('fitness_hub_action_social_links');
                                }
                                if( 'left' == $fitness_hub_header_top_info_display_selection ){
                                    do_action('fitness_hub_action_feature_info');
                                }
                            ?>
                        </div>
                        <div class="col-sm-6 text-right">
                            <?php
                                if( 'right' == $fitness_hub_header_top_menu_display_selection ){
                                    do_action('fitness_hub_action_top_menu');
                                }
                                if( 'right' == $fitness_hub_header_top_social_display_selection ){
                                    do_action('fitness_hub_action_social_links');
                                }
                                if( 'right' == $fitness_hub_header_top_info_display_selection ){
                                    do_action('fitness_hub_action_feature_info');
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        <div class="navbar at-navbar <?php echo  $fitness_hub_nav_class;?>" id="navbar" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></button>
                    <?php
                    $fitness_hub_display_site_logo = $fitness_hub_customizer_all_values['fitness-hub-display-site-logo'];
	                $fitness_hub_display_site_title = $fitness_hub_customizer_all_values['fitness-hub-display-site-title'];
	                $fitness_hub_display_site_tagline = $fitness_hub_customizer_all_values['fitness-hub-display-site-tagline'];
	                
                    if( 1== $fitness_hub_display_site_logo || 1 == $fitness_hub_display_site_title || 1 == $fitness_hub_display_site_tagline ):
                        if ( 1 == $fitness_hub_display_site_logo && function_exists( 'the_custom_logo' ) ):
                            the_custom_logo();
                        endif;
                        if ( 1== $fitness_hub_display_site_title  ):
                            if ( is_front_page() && is_home() ) : ?>
                                <h1 class="site-title">
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                                </h1>
                            <?php else : ?>
                                <p class="site-title">
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                                </p>
                            <?php endif;
                        endif;
                        if ( 1== $fitness_hub_display_site_tagline  ):
                            $description = get_bloginfo( 'description', 'display' );
                            if ( $description || is_customize_preview() ) : ?>
                                <p class="site-description"><?php echo esc_html( $description ); ?></p>
                            <?php endif;
                        endif;
                    endif;
                    ?>
                </div>
                <div class="at-beside-navbar-header">
	                <?php
	                 fitness_hub_primary_menu();
	                ?>
                </div>
                <!--.at-beside-navbar-header-->
            </div>
        </div>
        <?php
    }
endif;
add_action( 'fitness_hub_action_header', 'fitness_hub_header', 10 );