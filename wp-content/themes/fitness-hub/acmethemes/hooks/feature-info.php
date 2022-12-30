<?php
/**
 * Display Feature Columns
 * @since Fitness Hub 1.0.0
 *
 * @return void
 *
 */
if ( !function_exists('fitness_hub_feature_info') ) :
	function fitness_hub_feature_info() {
		global $fitness_hub_customizer_all_values;
		$fitness_hub_feature_info_number = $fitness_hub_customizer_all_values['fitness-hub-feature-info-number'];
		echo '<div class="info-icon-box-wrapper">';
		$number = $fitness_hub_feature_info_number;

		$fitness_hub_basic_info_data = array();

		$fitness_hub_first_info_icon = $fitness_hub_customizer_all_values['fitness-hub-first-info-icon'] ;
		$fitness_hub_first_info_title = $fitness_hub_customizer_all_values['fitness-hub-first-info-title'];
		$fitness_hub_first_info_desc = $fitness_hub_customizer_all_values['fitness-hub-first-info-desc'];
		$fitness_hub_basic_info_data[] = array(
			"icon"  => $fitness_hub_first_info_icon,
			"title" => $fitness_hub_first_info_title,
			"desc"  => $fitness_hub_first_info_desc
		);

		$fitness_hub_second_info_icon = $fitness_hub_customizer_all_values['fitness-hub-second-info-icon'] ;
		$fitness_hub_second_info_title = $fitness_hub_customizer_all_values['fitness-hub-second-info-title'];
		$fitness_hub_second_info_desc = $fitness_hub_customizer_all_values['fitness-hub-second-info-desc'];
		$fitness_hub_basic_info_data[] = array(
			"icon"  => $fitness_hub_second_info_icon,
			"title" => $fitness_hub_second_info_title,
			"desc"  => $fitness_hub_second_info_desc
		);

		$fitness_hub_third_info_icon = $fitness_hub_customizer_all_values['fitness-hub-third-info-icon'] ;
		$fitness_hub_third_info_title = $fitness_hub_customizer_all_values['fitness-hub-third-info-title'];
		$fitness_hub_third_info_desc = $fitness_hub_customizer_all_values['fitness-hub-third-info-desc'];
		$fitness_hub_basic_info_data[] = array(
			"icon"  => $fitness_hub_third_info_icon,
			"title" => $fitness_hub_third_info_title,
			"desc"  => $fitness_hub_third_info_desc
		);

		$fitness_hub_forth_info_icon = $fitness_hub_customizer_all_values['fitness-hub-forth-info-icon'] ;
		$fitness_hub_forth_info_title = $fitness_hub_customizer_all_values['fitness-hub-forth-info-title'];
		$fitness_hub_forth_info_desc = $fitness_hub_customizer_all_values['fitness-hub-forth-info-desc'];
		$fitness_hub_basic_info_data[] = array(
			"icon"  => $fitness_hub_forth_info_icon,
			"title" => $fitness_hub_forth_info_title,
			"desc"  => $fitness_hub_forth_info_desc
		);

		$col = " init-animate zoomIn";

		$i=0;
		foreach ( $fitness_hub_basic_info_data as $base_basic_info_data) {
			if( $i >= $number ){
				break;
			}
			?>
            <div class="info-icon-box <?php echo $col;?>">
				<?php
				if( !empty( $base_basic_info_data['icon'])){
					?>
                    <div class="info-icon">
                        <i class="fa <?php echo esc_attr( $base_basic_info_data['icon'] );?>"></i>
                    </div>
					<?php
				}
				if( !empty( $base_basic_info_data['title']) || !empty( $base_basic_info_data['desc']) ){
					?>
                    <div class="info-icon-details">
						<?php
						if( !empty( $base_basic_info_data['title']) ){
							echo '<h6 class="icon-title">'.esc_html( $base_basic_info_data['title'] ).'</h6>';
						}
						if( !empty( $base_basic_info_data['desc']) ){
							echo '<span class="icon-desc">'.wp_kses_post( $base_basic_info_data['desc'] ).'</span>';
						}
						?>
                    </div>
					<?php
				}
				?>
            </div>
			<?php
			$i++;
		}
		echo "</div>";/*.infowrapper*/
	}
endif;
add_action( 'fitness_hub_action_feature_info', 'fitness_hub_feature_info', 20 );