<?php
/**
 * Fitness Hub  Template Builder Options
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return array
 *
 */
if ( !function_exists('fitness_hub_template_builder_header_options') ) :
	function fitness_hub_template_builder_header_options() {
		$fitness_hub_template_builder_header_options = array(
			'display-header' => array(
				'value'     => 'display-header',
				'title'     => esc_html__( 'Display Header', 'fitness-hub' )
			),
			'hide-header' => array(
				'value'     => 'hide-header',
				'title'     => esc_html__( 'Hide Header', 'fitness-hub' )
			)
		);
		return apply_filters( 'fitness_hub_template_builder_header_options', $fitness_hub_template_builder_header_options );
	}
endif;

/**
 * Custom Metabox
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return void
 *
 */
if( !function_exists( 'fitness_hub_template_builder_metabox' )):
	function fitness_hub_template_builder_metabox() {
		add_meta_box(
			'fitness_hub_template_builder_metabox', // $id
			esc_html__( ' Template Builder Options', 'fitness-hub' ), // $title
			'fitness_hub_template_builder_callback', // $callback
			'post', // $page
			'normal', // $context
			'high'
		); // $priority

		add_meta_box(
			'fitness_hub_template_builder_metabox', // $id
			esc_html__( ' Template Builder Options', 'fitness-hub' ), // $title
			'fitness_hub_template_builder_callback', // $callback
			'page', // $page
			'normal', // $context
			'high'
		); // $priority
	}
endif;
add_action('add_meta_boxes', 'fitness_hub_template_builder_metabox');

/**
 * Callback function for metabox
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('fitness_hub_template_builder_callback') ) :
	function fitness_hub_template_builder_callback(){
		global $post;
		$fitness_hub_template_builder_header_options = fitness_hub_template_builder_header_options();
		$fitness_hub_default_header = 'display-header';
		$fitness_hub_template_builder_header_options_meta = get_post_meta( $post->ID, 'fitness_hub_template_builder_header_options', true );
		if( !fitness_hub_is_null_or_empty($fitness_hub_template_builder_header_options_meta) ){
			$fitness_hub_default_header = $fitness_hub_template_builder_header_options_meta;
		}
		wp_nonce_field( basename( __FILE__ ), 'fitness_hub_template_builder_meta_nonce' );
		?>
		<table class="form-table page-meta-box">
			<tr>
				<td colspan="4"><h4><?php esc_html_e( ' Header Option', 'fitness-hub' ); ?></h4></td>
			</tr>
			<tr>
				<td>
					<?php
					foreach ($fitness_hub_template_builder_header_options as $key=>$field) {
						?>
						<div>
							<input class="fitness_hub_template_builder_header_options" id="<?php echo esc_attr($key); ?>" type="radio" name="fitness_hub_template_builder_header_options" value="<?php echo esc_attr($key); ?>" <?php checked( $key, $fitness_hub_default_header ); ?> />
							<label class="description" for="<?php echo esc_attr($key); ?>">
								<?php echo esc_html( $field['title']); ?>
							</label>
						</div>
					<?php } // end foreach
					?>
					<div class="clear"></div>
				</td>
			</tr>
		</table>

	<?php }
endif;

/**
 * save the custom metabox data
 * @hooked to save_post hook
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return mixed
 *
 */
if ( !function_exists('fitness_hub_save_template_builder_options') ) :
	function fitness_hub_save_template_builder_options( $post_id ) {

		if (
			!isset( $_POST[ 'fitness_hub_template_builder_meta_nonce' ] ) ||
			!wp_verify_nonce( $_POST[ 'fitness_hub_template_builder_meta_nonce' ], basename( __FILE__ ) ) || /*Protecting against unwanted requests*/
			( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || /*Dealing with autosaves*/
			! current_user_can( 'edit_post', $post_id )/*Verifying access rights*/
		){
			return;
		}
		if ('page' == $_POST['post_type']) {
			if (!current_user_can( 'edit_page', $post_id ) )
				return $post_id;
		} elseif (!current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

		//Execute this saving function
		if( isset( $_POST['fitness_hub_template_builder_header_options'] )){
			$old = get_post_meta( $post_id, 'fitness_hub_template_builder_header_options', true );
			$new = esc_attr( $_POST['fitness_hub_template_builder_header_options'] );
			if ($new && $new != $old) {
				update_post_meta( $post_id, 'fitness_hub_template_builder_header_options', $new );
			} elseif ('' == $new && $old) {
				delete_post_meta( $post_id,'fitness_hub_template_builder_header_options', $old );
			}
		}
	}
endif;
add_action('save_post', 'fitness_hub_save_template_builder_options');