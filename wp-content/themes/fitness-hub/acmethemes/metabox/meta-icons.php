<?php
/**
 * Custom Metabox
 * Only added icon not special data
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return void
 *
 */
if( !function_exists( 'fitness_hub_meta_add_featured_icon' )):
    function fitness_hub_meta_add_featured_icon() {
        add_meta_box(
            'fitness_hub_meta_fields', // $id
            esc_html__( 'Featured Icon', 'fitness-hub' ), // $title
            'fitness_hub_meta_featured_icon_callback', // $callback
            'page', // $page
            'side', // $context
            'core'// $priority
        );
    }
endif;
add_action('add_meta_boxes', 'fitness_hub_meta_add_featured_icon');

/**
 * Callback function for metabox
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('fitness_hub_meta_featured_icon_callback') ) :
    function fitness_hub_meta_featured_icon_callback(){
        global $post;
        $fitness_hub_featured_icon = get_post_meta( $post->ID, 'fitness-hub-featured-icon', true );
        wp_nonce_field( basename( __FILE__ ), 'fitness_hub_meta_fields_nonce' );
       ?>
        <div class="at-icons-wrapper">
            <div class="icon-preview">
                <?php if( !empty( $fitness_hub_featured_icon ) ) { echo '<i class="fa '. esc_attr( $fitness_hub_featured_icon ) .'"></i>'; } ?>
            </div>
            <div class="icon-toggle">
                <?php echo ( empty( $fitness_hub_featured_icon )? esc_html__('Add Icon','fitness-hub'): esc_html__('Edit Icon','fitness-hub') ); ?>
                <span class="dashicons dashicons-arrow-down"></span>
            </div>
            <div class="icons-list-wrapper hidden">
                <input class="icon-search widefat" type="text" placeholder="<?php esc_attr_e('Search Icon','fitness-hub')?>">
                <?php
                $fa_icon_list_array = fitness_hub_icons_array();
                foreach ( $fa_icon_list_array as $single_icon ) {
                    if( $fitness_hub_featured_icon == $single_icon ) {
                        echo '<span class="single-icon selected"><i class="fa '. esc_attr( $single_icon ) .'"></i></span>';
                    } else {
                        echo '<span class="single-icon"><i class="fa '. esc_attr( $single_icon ) .'"></i></span>';
                    }
                }
                ?>
            </div>
            <input class="widefat at-icon-value" id="fitness-hub-featured-icon" type="hidden" name="fitness-hub-featured-icon" value="<?php echo esc_attr( $fitness_hub_featured_icon ); ?>" placeholder="fa-desktop"/>
        </div>
        <?php
}
endif;

/**
 * Save the custom metabox data
 * @hooked to save_post hook
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('fitness_hub_meta_save_featured_icon') ) :
    function fitness_hub_meta_save_featured_icon( $post_id ) {

        /*
         * A Guide to Writing Secure Themes – Part 4: Securing Post Meta
         *https://make.wordpress.org/themes/2015/06/09/a-guide-to-writing-secure-themes-part-4-securing-post-meta/
         * */
        if (
            !isset( $_POST[ 'fitness_hub_meta_fields_nonce' ] ) ||
            !wp_verify_nonce( $_POST[ 'fitness_hub_meta_fields_nonce' ], basename( __FILE__ ) ) || /*Protecting against unwanted requests*/
            ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || /*Dealing with autosaves*/
            ! current_user_can( 'edit_post', $post_id )/*Verifying access rights*/
        ){
            return;
        }
        //Execute this saving function
        if(isset($_POST['fitness-hub-featured-icon'])){
            $new = sanitize_text_field( $_POST['fitness-hub-featured-icon'] );
            update_post_meta( $post_id, 'fitness-hub-featured-icon', $new );
        }
    }
endif;
add_action('save_post', 'fitness_hub_meta_save_featured_icon' );