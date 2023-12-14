<?php

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('MCWP_Display')) {

class MCWP_Display {

    public function __construct() {
        add_action('admin_init', array($this, 'mcwp_admin_hooks'));
    }

    public function mcwp_admin_hooks() {
        add_filter('plugin_action_links', array($this, 'mcwp_action_links'), 10, 2 );
        add_filter('plugin_row_meta', array($this, 'mcwp_row_meta'), 10, 2 );

        if(!get_option('mcwp-notice')) {
            add_option('mcwp-notice', '1');
        }

        if(get_option('mcwp-notice') && get_option('mcwp-notice') != 0) {
            add_action('wp_ajax_mcwp_notice', array($this, 'mcwp_notice_dismiss'));
        }

        if(!get_option('mcwp-top-notice')) {
            add_option('mcwp-top-notice', strtotime(current_time('mysql')));
        }

        if(get_option('mcwp-top-notice') && get_option('mcwp-top-notice') != 0) {
            if( get_option('mcwp-top-notice') < strtotime('-3 days')) { //if greater than 3 days
                add_action('admin_notices', array($this, 'mcwp_top_admin_notice'));
                add_action('wp_ajax_mcwp_top_notice', array($this, 'mcwp_top_notice_dismiss'));
            }
        }
    }

    public function mcwp_notice_dismiss() {
        update_option('mcwp-notice','0');
        exit();
    }

    public function mcwp_top_notice_dismiss() {
        update_option('mcwp-top-notice','0');
        exit();
    }

    public function mcwp_top_admin_notice() {
        ?>
            <div class="mcwp-notice notice notice-success is-dismissible">
                <img class="mcwp-iconimg" src="<?php echo MCWP_URL; ?>assets/admin/images/icon.png" style="float:left;" />
                <p style="width:80%;"><?php _e('Enjoying our <strong>Cryptocurrency Widgets Pack?</strong> We hope you liked it! If you feel this plugin helped you, You can give us a 5 star rating!<br>It will motivate us to serve you more !','cryptocurrency-widgets-pack'); ?> </p>
                <a href="https://wordpress.org/support/plugin/cryptocurrency-widgets-pack/reviews/#new-post" class="button button-primary" style="margin-right: 10px !important;color: black;background: white;box-shadow: none !important;text-shadow: none !important;border: 0 none !important;" target="_blank"><?php _e('Rate the Plugin!','cryptocurrency-widgets-pack'); ?> &#11088;&#11088;&#11088;&#11088;&#11088;</a>
                <a href="https://massivecryptopro.blocksera.com" class="button button-secondary" target="_blank"><?php _e('Go Pro','cryptocurrency-widgets-pack'); ?></a>
                <span class="mcwp-done"><?php _e('Already Done','cryptocurrency-widgets-pack'); ?></span>
            </div>
        <?php
    }

    public function mcwp_action_links($actions, $plugin_file) {
        if( false === strpos( $plugin_file, basename(__FILE__) ) ) return $actions;
        
        $settings_link = '<a href="'.admin_url().'post-new.php?post_type=mcwp" style="font-weight:bold;">' . __('Add Widgets','cryptocurrency-widgets-pack') . '</a>';
        $faq_link = '<a target="_blank" href="https://massivecryptopro.blocksera.com/#faq" style="color:#eda600;font-weight:bold;">' . __('FAQ','cryptocurrency-widgets-pack') . '</a>';
        $gopro_link = '<a target="_blank" href="https://massivecryptopro.blocksera.com" style="color:#39b54a;font-weight:bold;">' . __('Go Pro','cryptocurrency-widgets-pack') . '</a>';
        
        array_unshift($actions, $gopro_link);
        array_unshift($actions, $faq_link);
        array_unshift($actions, $settings_link);

        return $actions;
    }

    public function mcwp_row_meta($meta, $plugin_file) {
        if( false === strpos( $plugin_file, basename(__FILE__) ) ) return $meta;

        $meta[] = '<a href="https://blocksera.com/contact/" target="_blank">' . __('Support','cryptocurrency-widgets-pack') . '</a>';
        return $meta;
    }

    public function register_menu() {

        // Register plugin premium page
        add_submenu_page(
            'edit.php?post_type=mcwp',
            __('Upgrade To PRO - Massive Cryptocurrency Widgets','cryptocurrency-widgets-pack'),
            '<span style="color:greenyellow;">'.__('Upgrade to PRO&nbsp;&nbsp;&#x27a4;', 'cryptocurrency-widgets-pack').'</span>',
            'manage_options',
            'mcwp-premium',
            array($this, 'premium_page')
        );
    }

    public function premium_page() {
        include_once( MCWP_PATH . '/includes/premium.php' );
    }

    public function shortcode($post) {
        $dynamic_attr = '[cryptopack id=&quot;' . get_the_id() . '&quot;]';
        
        echo '<div class="mcwp-shortcode">' . __('Paste this shortcode anywhere like page, post or widgets','cryptocurrency-widgets-pack');
        
        echo '<br/><br/><div>' . $dynamic_attr . '</div></div>';
        echo '<div class="mcwp-pro-add"><a href="https://coinpress.blocksera.com" target="_blank">' . __("Create 5,000+ coin pages instantly", "cryptocurrency-widgets-pack") . '</a></div>';
    }

    public function pro($post) {
        ?>
        <div class="mcwp-pro">
            <h3><b><?php _e('Plugin Rating:','cryptocurrency-widgets-pack'); ?></b></h3>
            <div class="mcwp-anime">
                <a href="https://wordpress.org/support/plugin/cryptocurrency-widgets-pack/reviews/#new-post" target="_blank">
                    <span><img src="<?php echo MCWP_URL . 'assets/admin/images/star.png'; ?>" /></span>
                    <span><img src="<?php echo MCWP_URL . 'assets/admin/images/star.png'; ?>" /></span>
                    <span><img src="<?php echo MCWP_URL . 'assets/admin/images/star.png'; ?>" /></span>
                    <span><img src="<?php echo MCWP_URL . 'assets/admin/images/star.png'; ?>" /></span>
                    <span><img src="<?php echo MCWP_URL . 'assets/admin/images/star.png'; ?>" /></span>
                </a>
            </div>
            <p><?php _e('Did Cryptocurrency Widgets Pack help you out? Please leave us a 5 star review.<br/>Thank you!','cryptocurrency-widgets-pack'); ?></p>
            <div class="buy"><a target="_blank" href="https://wordpress.org/support/plugin/cryptocurrency-widgets-pack/reviews/#new-post"><?php _e('Write a Review','cryptocurrency-widgets-pack'); ?></a></div>
            <hr>
            <h3><?php _e('Massive Cryptocurrency Widgets | Crypto Plugin','cryptocurrency-widgets-pack'); ?></h3>
            <a target="_blank" href="https://massivecryptopro.blocksera.com"><img style="max-width: 100%;" src="https://massivecryptopro.blocksera.com/wp-content/uploads/2020/08/mcw-banner.jpg" /></a>
            <ul>
                <li><?php _e('5,000+ Cryptocurrencies','cryptocurrency-widgets-pack'); ?></li>
                <li><?php _e('Powered by Coingecko','cryptocurrency-widgets-pack'); ?></li>
                <li><?php _e('Stylish crypto widgets','cryptocurrency-widgets-pack'); ?></li>
                <li><?php _e('Feature-rich widget editor','cryptocurrency-widgets-pack'); ?></li>
                <li><?php _e('Unlimited customizations','cryptocurrency-widgets-pack'); ?></li>
            </ul>
            <hr/>
            <h3><?php _e('Coinpress - Cryptocurrency Pages for WordPress','cryptocurrency-widgets-pack'); ?></h3>
            <a target="_blank" href="https://coinpress.blocksera.com"><img style="max-width: 100%;" src="https://massivecryptopro.blocksera.com/wp-content/uploads/2020/08/coinpress-banner.jpg" /></a>
            <ul>
                <li><?php _e('5,000+ Coin detail pages','cryptocurrency-widgets-pack'); ?></li>
                <li><?php _e('Search, Currency Changer, Watchlist','cryptocurrency-widgets-pack'); ?></li>
                <li><?php _e('Line & Candlestick charts','cryptocurrency-widgets-pack'); ?></li>
                <li><?php _e('Historical Data & Markets','cryptocurrency-widgets-pack'); ?></li>
                <li><?php _e('Social Feed & Comments','cryptocurrency-widgets-pack'); ?></li>
                <li><?php _e('News section & Responsive Design','cryptocurrency-widgets-pack'); ?></li>
            </ul>
            <hr/>
            <h3><?php _e('Massive Stock Market & Forex Widgets','cryptocurrency-widgets-pack'); ?></h3>
            <a target="_blank" href="https://stockwidgets.blocksera.com"><img style="max-width: 100%;" src="https://massivecryptopro.blocksera.com/wp-content/uploads/2020/08/msf-banner.jpg" /></a>
            <ul>
                <li><?php _e('Global stock exchanges','cryptocurrency-widgets-pack'); ?></li>
                <li><?php _e('Powered by Yahoo API','cryptocurrency-widgets-pack'); ?></li>
                <li><?php _e('Up to 100,000 companies list','cryptocurrency-widgets-pack'); ?></li>
                <li><?php _e('Powerful search option','cryptocurrency-widgets-pack'); ?></li>
                <li><?php _e('Stylish widgets','cryptocurrency-widgets-pack'); ?></li>
                <li><?php _e('Feature-rich widget editor','cryptocurrency-widgets-pack'); ?></li>
                <li><?php _e('Unlimited customizations','cryptocurrency-widgets-pack'); ?></li>
            </ul>
        </div>
        <?php
    }

    public function crypto_four_not_four(){
        return '<div class="crypto-404">No Coins Selected</div>';
    }

}
}