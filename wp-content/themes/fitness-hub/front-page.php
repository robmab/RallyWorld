<?php
/**
 * The front-page template file.
 *
 * @package Acme Themes
 * @subpackage Fitness Hub
 * @since Fitness Hub 1.0.0
 */
get_header();

/**
 * fitness_hub_action_front_page hook
 * @since Fitness Hub 1.0.0
 *
 * @hooked fitness_hub_featured_slider -  10
 * @hooked fitness_hub_front_page -  20
 */
do_action( 'fitness_hub_action_front_page' );

get_footer();