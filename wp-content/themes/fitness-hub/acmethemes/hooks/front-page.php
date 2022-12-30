<?php
/**
 * Front page hook for all WordPress Conditions
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( ! function_exists( 'fitness_hub_featured_slider' ) ) :

    function fitness_hub_featured_slider() {
        global $fitness_hub_customizer_all_values;

        $fitness_hub_enable_feature = $fitness_hub_customizer_all_values['fitness-hub-enable-feature'];
        if( is_front_page() && 1 == $fitness_hub_enable_feature && !is_home() ) :
	        do_action( 'fitness_hub_action_feature_slider' );
	
        endif;
    }
endif;
add_action( 'fitness_hub_action_front_page', 'fitness_hub_featured_slider', 10 );

if ( ! function_exists( 'fitness_hub_front_page' ) ) :

    function fitness_hub_front_page() {
        global $fitness_hub_customizer_all_values;

        $fitness_hub_hide_front_page_content = $fitness_hub_customizer_all_values['fitness-hub-hide-front-page-content'];

        /*show widget in front page, now user are not force to use front page*/
        if( is_active_sidebar( 'fitness-hub-home' ) && !is_home() ){
            dynamic_sidebar( 'fitness-hub-home' );
        }
        if ( 'posts' == get_option( 'show_on_front' ) ) {
            include( get_home_template() );
        }
        else {
            if( 1 != $fitness_hub_hide_front_page_content ){
                include( get_page_template() );
            }
        }
    }
endif;
add_action( 'fitness_hub_action_front_page', 'fitness_hub_front_page', 20 );