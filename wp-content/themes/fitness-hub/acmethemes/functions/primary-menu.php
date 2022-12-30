<?php
/**
 * Display Primary Menu
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('fitness_hub_primary_menu') ) :

	function fitness_hub_primary_menu() {
		global $fitness_hub_customizer_all_values;
		?>
        <div class="search-woo">
			<?php
			$fitness_hub_menu_right_button_link_options = $fitness_hub_customizer_all_values['fitness-hub-menu-right-button-options'];
			$fitness_hub_button_title = $fitness_hub_customizer_all_values['fitness-hub-menu-right-button-title'];
			$fitness_hub_button_link = $fitness_hub_customizer_all_values['fitness-hub-menu-right-button-link'];
			if( 'disable' != $fitness_hub_menu_right_button_link_options ){
				$fitness_hub_button_title = !empty( $fitness_hub_button_title )?$fitness_hub_button_title:esc_html__('Request a Quote','fitness-hub');
				if( 'booking' == $fitness_hub_menu_right_button_link_options ){
					?>
                    <a class="featured-button btn btn-primary" href="#" data-toggle="modal" data-target="#at-shortcode-bootstrap-modal"><?php echo esc_html( $fitness_hub_button_title ); ?></a>
					<?php
				}
				else{
					?>
                    <a class="featured-button btn btn-primary" href="<?php echo esc_url( $fitness_hub_button_link ); ?>"><?php echo esc_html( $fitness_hub_button_title ); ?></a>
					<?php
				}
			}
			$fitness_hub_enable_woo_cart = $fitness_hub_customizer_all_values['fitness-hub-enable-cart-icon'];

			if( 1 == $fitness_hub_enable_woo_cart && class_exists( 'WooCommerce' ) ) {
				$cart_url = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : WC()->cart->get_cart_url();
				?>
                <div class="cart-wrap desktop-only">
                    <div class="acme-cart-views">
                        <a href="<?php echo esc_url( $cart_url ); ?>" class="cart-contents">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="cart-value"><?php echo wp_kses_post ( WC()->cart->cart_contents_count ); ?></span>
                        </a>
                    </div>
					<?php the_widget( 'WC_Widget_Cart', '' ); ?>
                </div>
				<?php
			}
			?>
        </div>
		<div class="main-navigation navbar-collapse collapse">
			<?php
			if( is_front_page() && !is_home() && has_nav_menu( 'one-page') ){
				wp_nav_menu(
					array(
						'theme_location' => 'one-page',
						'menu_id' => 'primary-menu',
						'menu_class' => 'nav navbar-nav  acme-one-page',
						'container' => false,
					)
				);
			}
			else{
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id' => 'primary-menu',
						'menu_class' => 'nav navbar-nav  acme-normal-page',
						'container' => false
					)
				);
			}
			?>
		</div><!--/.nav-collapse -->
		<?php
	}
endif;