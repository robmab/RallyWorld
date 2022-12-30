<?php
add_action( 'tgmpa_register', 'fitness_hub_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function fitness_hub_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
    // Include Acme Demo Setup as recommended
    $plugins = array(
        array(
            'name'      => esc_html__('Acme Demo Setup','fitness-hub'),
            'slug'      => 'acme-demo-setup',
            'required'  => false,
        ),
	    array(
		    'name'      => esc_html__('Page Builder by SiteOrigin','fitness-hub'),
		    'slug'      => 'siteorigin-panels',
		    'required'  => false,
	    ),
    );
	tgmpa( $plugins );
}