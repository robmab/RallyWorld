<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Acme Themes
 * @subpackage Fitness Hub
 */

/**
 * fitness_hub_action_after_content hook
 * @since Fitness Hub 1.0.0
 *
 * @hooked null
 */
do_action( 'fitness_hub_action_after_content' );

/**
 * fitness_hub_action_before_footer hook
 * @since Fitness Hub 1.0.0
 *
 * @hooked null
 */
do_action( 'fitness_hub_action_before_footer' );

/**
 * fitness_hub_action_footer hook
 * @since Fitness Hub 1.0.0
 *
 * @hooked fitness_hub_footer - 10
 */
do_action( 'fitness_hub_action_footer' );

/**
 * fitness_hub_action_after_footer hook
 * @since Fitness Hub 1.0.0
 *
 * @hooked null
 */
do_action( 'fitness_hub_action_after_footer' );

/**
 * fitness_hub_action_after hook
 * @since Fitness Hub 1.0.0
 *
 * @hooked fitness_hub_page_end - 10
 */
do_action( 'fitness_hub_action_after' );

wp_footer();
?>
</body>
</html>