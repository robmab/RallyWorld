<?php
/**
 * Adds Fitness Hub Theme Widgets in SiteOrigin Pagebuilder Tabs
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return null
 *
 */
function fitness_hub_siteorigin_widgets($widgets) {
    $theme_widgets = array(
        'Fitness_Hub_About',
        'Fitness_Hub_Class',
        'Fitness_Hub_Posts_Col',
        'Fitness_Hub_Contact',
	    'Fitness_Hub_Gallery',
	    'Fitness_Hub_Feature',
	    'Fitness_Hub_Service',
        'Fitness_Hub_Social',
        'Fitness_Hub_Team',
        'Fitness_Hub_Testimonial',
    );
    foreach($theme_widgets as $theme_widget) {
        if( isset( $widgets[$theme_widget] ) ) {
            $widgets[$theme_widget]['groups'] = array('fitness-hub');
            $widgets[$theme_widget]['icon']   = 'dashicons dashicons-screenoptions';
        }
    }
    return $widgets;
}
add_filter('siteorigin_panels_widgets', 'fitness_hub_siteorigin_widgets');

/**
 * Add a tab for the theme widgets in the page builder
 *
 * @since Fitness Hub 1.0.0
 *
 * @param null
 * @return null
 *
 */
function fitness_hub_siteorigin_widgets_tab($tabs){
    $tabs[] = array(
        'title'  => esc_html__('AT Fitness Hub Widgets', 'fitness-hub'),
        'filter' => array(
            'groups' => array('fitness-hub')
        )
    );
    return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'fitness_hub_siteorigin_widgets_tab', 20 );