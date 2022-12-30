<?php
/**
 * Select sidebar according to the options saved
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return string
 *
 */
if ( !function_exists('fitness_hub_sidebar_selection') ) :
	function fitness_hub_sidebar_selection( ) {
		wp_reset_postdata();
		$fitness_hub_customizer_all_values = fitness_hub_get_theme_options();
		global $post;
		if(
			isset( $fitness_hub_customizer_all_values['fitness-hub-single-sidebar-layout'] ) &&
			(
				'left-sidebar' == $fitness_hub_customizer_all_values['fitness-hub-single-sidebar-layout'] ||
				'both-sidebar' == $fitness_hub_customizer_all_values['fitness-hub-single-sidebar-layout'] ||
				'middle-col' == $fitness_hub_customizer_all_values['fitness-hub-single-sidebar-layout'] ||
				'no-sidebar' == $fitness_hub_customizer_all_values['fitness-hub-single-sidebar-layout']
			)
		){
			$fitness_hub_body_global_class = $fitness_hub_customizer_all_values['fitness-hub-single-sidebar-layout'];
		}
		else{
			$fitness_hub_body_global_class= 'right-sidebar';
		}

		if ( fitness_hub_is_woocommerce_active() && ( is_product() || is_shop() || is_product_taxonomy() )) {
			if( is_product() ){
				$post_class = get_post_meta( $post->ID, 'fitness_hub_sidebar_layout', true );
				$fitness_hub_wc_single_product_sidebar_layout = $fitness_hub_customizer_all_values['fitness-hub-wc-single-product-sidebar-layout'];

				if ( 'default-sidebar' != $post_class ){
					if ( $post_class ) {
						$fitness_hub_body_classes = $post_class;
					} else {
						$fitness_hub_body_classes = $fitness_hub_wc_single_product_sidebar_layout;
					}
				}
				else{
					$fitness_hub_body_classes = $fitness_hub_wc_single_product_sidebar_layout;

				}
			}
			else{
				if( isset( $fitness_hub_customizer_all_values['fitness-hub-wc-shop-archive-sidebar-layout'] ) ){
					$fitness_hub_archive_sidebar_layout = $fitness_hub_customizer_all_values['fitness-hub-wc-shop-archive-sidebar-layout'];
					if(
						'right-sidebar' == $fitness_hub_archive_sidebar_layout ||
						'left-sidebar' == $fitness_hub_archive_sidebar_layout ||
						'both-sidebar' == $fitness_hub_archive_sidebar_layout ||
						'middle-col' == $fitness_hub_archive_sidebar_layout ||
						'no-sidebar' == $fitness_hub_archive_sidebar_layout
					){
						$fitness_hub_body_classes = $fitness_hub_archive_sidebar_layout;
					}
					else{
						$fitness_hub_body_classes = $fitness_hub_body_global_class;
					}
				}
				else{
					$fitness_hub_body_classes= $fitness_hub_body_global_class;
				}
			}
		}
		elseif( is_front_page() ){
			if( isset( $fitness_hub_customizer_all_values['fitness-hub-front-page-sidebar-layout'] ) ){
				if(
					'right-sidebar' == $fitness_hub_customizer_all_values['fitness-hub-front-page-sidebar-layout'] ||
					'left-sidebar' == $fitness_hub_customizer_all_values['fitness-hub-front-page-sidebar-layout'] ||
					'both-sidebar' == $fitness_hub_customizer_all_values['fitness-hub-front-page-sidebar-layout'] ||
					'middle-col' == $fitness_hub_customizer_all_values['fitness-hub-front-page-sidebar-layout'] ||
					'no-sidebar' == $fitness_hub_customizer_all_values['fitness-hub-front-page-sidebar-layout']
				){
					$fitness_hub_body_classes = $fitness_hub_customizer_all_values['fitness-hub-front-page-sidebar-layout'];
				}
				else{
					$fitness_hub_body_classes = $fitness_hub_body_global_class;
				}
			}
			else{
				$fitness_hub_body_classes= $fitness_hub_body_global_class;
			}
		}

		elseif ( is_singular() && isset( $post->ID ) ) {
			$post_class = get_post_meta( $post->ID, 'fitness_hub_sidebar_layout', true );
			if ( 'default-sidebar' != $post_class ){
				if ( $post_class ) {
					$fitness_hub_body_classes = $post_class;
				} else {
					$fitness_hub_body_classes = $fitness_hub_body_global_class;
				}
			}
			else{
				$fitness_hub_body_classes = $fitness_hub_body_global_class;
			}

		}
		elseif ( is_archive() ) {
			if( isset( $fitness_hub_customizer_all_values['fitness-hub-archive-sidebar-layout'] ) ){
				$fitness_hub_archive_sidebar_layout = $fitness_hub_customizer_all_values['fitness-hub-archive-sidebar-layout'];
				if(
					'right-sidebar' == $fitness_hub_archive_sidebar_layout ||
					'left-sidebar' == $fitness_hub_archive_sidebar_layout ||
					'both-sidebar' == $fitness_hub_archive_sidebar_layout ||
					'middle-col' == $fitness_hub_archive_sidebar_layout ||
					'no-sidebar' == $fitness_hub_archive_sidebar_layout
				){
					$fitness_hub_body_classes = $fitness_hub_archive_sidebar_layout;
				}
				else{
					$fitness_hub_body_classes = $fitness_hub_body_global_class;
				}
			}
			else{
				$fitness_hub_body_classes= $fitness_hub_body_global_class;
			}
		}
		else {
			$fitness_hub_body_classes = $fitness_hub_body_global_class;
		}
		return $fitness_hub_body_classes;
	}
endif;