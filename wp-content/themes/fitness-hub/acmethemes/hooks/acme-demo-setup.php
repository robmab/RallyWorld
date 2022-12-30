<?php
/**
 * Acme Demo Setup Data
 * Don't confuse they dont need translations
 *
 * @since Fitness Hub 1.0.0
 *
 */
if( !function_exists( 'fitness_hub_demo_nav_data') ){
    function fitness_hub_demo_nav_data(){
        $demo_navs = array(
            'primary'       => 'Primary Menu',
            'footer-menu'   => 'Footer Menu'
        );
        return $demo_navs;
    }
}
add_filter('acme_demo_setup_nav_data','fitness_hub_demo_nav_data');

if( !function_exists( 'fitness_hub_demo_wp_options_data') ){
    function fitness_hub_demo_wp_options_data(){
        $wp_options = array(
            'page_on_front'     => 'Home',
            'page_for_posts'    => 'Blog',
        );
        return $wp_options;
    }
}
add_filter('acme_demo_setup_wp_options_data','fitness_hub_demo_wp_options_data');