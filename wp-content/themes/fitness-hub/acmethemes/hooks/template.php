<?php
if ( ! function_exists( 'fitness_hub_posts_navigation' ) ) :
	/**
	 * Post navigation
	 *
	 * @since Fitness Hub 1.0.0
	 *
	 * @return void
	 */
	function fitness_hub_posts_navigation() {
		global $fitness_hub_customizer_all_values;
		$fitness_hub_pagination_option = $fitness_hub_customizer_all_values['fitness-hub-pagination-option'];
		if( 'default' == $fitness_hub_pagination_option ){
			// Previous/next page navigation.
			the_posts_navigation();
		}
		else {
			// Previous/next page navigation.
			the_posts_pagination();
		}
	}
endif;
add_action( 'fitness_hub_action_posts_navigation', 'fitness_hub_posts_navigation' );

/**
 * Feature Options
 *
 * @since Medical Circle 1.0.0
 *
 * @param null
 * @return string
 *
 */
if ( !function_exists('fitness_hub_featured_image_display') ) :
	function fitness_hub_featured_image_display( ) {
		global $fitness_hub_customizer_all_values;
		$fitness_hub_single_image_layout = $fitness_hub_customizer_all_values['fitness-hub-single-img-size'];

		return $fitness_hub_single_image_layout;
	}
endif;