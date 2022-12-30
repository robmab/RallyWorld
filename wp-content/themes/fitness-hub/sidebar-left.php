<?php
/**
 * The left sidebar containing the main widget area.
 */
if ( ! is_active_sidebar( 'fitness-hub-sidebar' ) ) {
	return;
}
$sidebar_layout = fitness_hub_sidebar_selection();
if( $sidebar_layout == "left-sidebar" || $sidebar_layout == "both-sidebar"  ) : ?>
    <div id="secondary-left" class="at-fixed-width widget-area sidebar secondary-sidebar" role="complementary">
        <div id="sidebar-section-top" class="widget-area sidebar clearfix">
			<?php dynamic_sidebar( 'fitness-hub-sidebar-left' ); ?>
        </div>
    </div>
<?php endif;