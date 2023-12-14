<?php
/**
 * Plugin Name: 		Cryptocurrency Widgets Pack
 * Plugin URI:          http://store.blocksera.com/products/cryptocurrency-widgets-pack/
 * Author: 				Blocksera
 * Author URI:			https://blocksera.com
 * Description: 		Price ticker, table, cards, label widget for all cryptocurrencies using Coingecko API.
 * Requires PHP:        5.6
 * Requires at least:   4.3.0
 * Tested up to:        6.3.1
 * Version: 			2.0.1
 * License: 			GPL v3
 * Text Domain:			cryptocurrency-widgets-pack
 * Domain Path: 		/languages
 *
**/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define('MCWP_VERSION', '2.0.1');
define('MCWP_PATH', plugin_dir_path(__FILE__));
define('MCWP_URL', plugin_dir_url(__FILE__));

require_once MCWP_PATH . 'includes/display.php';
require_once MCWP_PATH . 'includes/shortcodes.php';


if ( ! class_exists( 'MCWP_Crypto' ) ) {
class MCWP_Crypto {

	private static $_instance = null;

	public static function get_instance() {
		if ( ! self::$_instance ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function __construct() {
		global $wpdb;

		if ( self::$_instance ) {
			return;
		}

		self::$_instance = $this;
		$this->wpdb = $wpdb;
		$this->tablename = $this->wpdb->prefix . "mcwp_coins";

		$this->display = new MCWP_Display();
		$this->shortcode = new CryptoPack_Shortcodes();
		
		require_once(MCWP_PATH . 'includes/duplicate.php');
		
		add_action('admin_enqueue_scripts', 			array($this, 'admin_scripts'));
		add_action('wp_enqueue_scripts', 				array($this, 'frontend_scripts'));
		add_shortcode('cryptopack', 					array($this, 'shortcode'));
		add_action('wp_footer',							array($this, 'global_ticker'));
		add_action('wp_ajax_mcwp_table', 				array($this, 'table_data'));
		add_action('wp_ajax_nopriv_mcwp_table', 		array($this, 'table_data'));

		$this->create_post_type();
		$this->upgrade_version();

		register_activation_hook(__FILE__, array($this, 'activate'));
		register_deactivation_hook(__FILE__, array($this, 'deactivate'));
	}

	public static function activate() {
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
		$table_name = $wpdb->prefix . 'mcwp_coins';

		$sql = "CREATE TABLE $table_name (
				`id` mediumint(9) NOT NULL AUTO_INCREMENT,
				`cid` varchar(100) NOT NULL,
				`name` varchar(100) NOT NULL,
				`symbol` varchar(10) NOT NULL,
				`rank` int(5) NOT NULL,
				`img` varchar(150) NOT NULL,
				`price_usd` decimal(20,10) NOT NULL,
				`market_cap_usd` decimal(22,2) NOT NULL,
				`percent_change_24h` decimal(7,2) NOT NULL,
				`weekly` longtext NOT NULL,
				`weekly_not_expire` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
				UNIQUE KEY id (id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}

	public static function deactivate() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'mcwp_coins';
		$wpdb->query("DROP TABLE IF EXISTS " . $table_name);
		delete_transient('mcwp-data-time');
	}

	public function upgrade_version() {

		$mcwp_installed_version = get_transient('mcwp_version');

		if (version_compare($mcwp_installed_version, '1.4', '<')) {

			$mcw_posts = get_posts(array(
				'post_type' => 'mcwp',
				'posts_per_page' => -1,
				'meta_key' => 'crypto_ticker',
				'post_status' => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash')
			));

			foreach($mcw_posts as $post) {
				update_post_meta($post->ID, 'crypto_speed', '100');
			}

			set_transient('mcwp_version', MCWP_VERSION);
		}

		if (version_compare($mcwp_installed_version, '1.6.1', '<')) {
			
			$query = "ALTER TABLE %s ADD COLUMN img VARCHAR(150) NOT NULL AFTER rank";
			$this->wpdb->query($this->wpdb->prepare($query, [$this->tablename]));
			delete_transient('mcwp-data-time');
			set_transient('mcwp_version', MCWP_VERSION);
		}

	}

	public function admin_scripts() {

		$screen = get_current_screen();

		wp_enqueue_style('wp-color-picker');
		wp_enqueue_script('wp-color-picker');
		wp_enqueue_style('mcwpa-crypto-css',		MCWP_URL . 'assets/admin/css/style.css', array(), MCWP_VERSION, 'all');
		wp_enqueue_style('mcwpa-crypto-select-css',	MCWP_URL . 'assets/admin/css/selectize.default.css', array(), MCWP_VERSION, 'all');
		wp_enqueue_script('mcwpa-crypto-es5',		MCWP_URL . 'assets/admin/js/es5.js', array('jquery'), MCWP_VERSION, true);
		wp_script_add_data('mcwpa-crypto-es5',		'conditional', 'lt IE 9' );
		wp_enqueue_script('mcw-autosize',			MCWP_URL . 'assets/admin/js/autosize.min.js', array('jquery'), MCWP_VERSION, true);
		wp_enqueue_script('mcw-crypto-select',		MCWP_URL . 'assets/admin/js/selectize.min.js', array('jquery'), MCWP_VERSION, true);
		wp_enqueue_script('mcwpa-crypto-common',	MCWP_URL . 'assets/admin/js/common.js', array('jquery'), MCWP_VERSION, true);

		if ($screen->post_type === 'mcwp' && $screen->base === 'post') {
			$this->frontend_scripts();
		}
	}

	public function frontend_scripts() {
		wp_enqueue_style('mcwp-crypto-css',				MCWP_URL . 'assets/public/css/style.css',array(), MCWP_VERSION, 'all');
		wp_enqueue_style('mcwp-crypto-datatable-css',	MCWP_URL . 'assets/public/css/datatable-style.css', array(), MCWP_VERSION, 'all');
		wp_enqueue_script('mcwp-crypto-datatable-js',	MCWP_URL . 'assets/public/js/jquery.dataTables.min.js', array('jquery'), MCWP_VERSION, true);
		wp_enqueue_script('mcwp-crypto-datatable-resp',	MCWP_URL . 'assets/public/js/dataTables.responsive.min.js', array('jquery'), MCWP_VERSION, true);
		wp_register_script('mcwp-crypto-common',		MCWP_URL . 'assets/public/js/common.js', array('jquery'), MCWP_VERSION, true);
		wp_localize_script('mcwp-crypto-common',		'mcwpajax', array('url' => MCWP_URL, 'ajax_url' => admin_url('admin-ajax.php')));
		wp_enqueue_script('mcwp-crypto-common');
	}

	public function fetch_coins($cquery) {
		
		$mcwp_data_time = get_transient('mcwp-data-time');

		//update old database
		if($mcwp_data_time === false){
			$mcwp_request 		= wp_remote_get('https://api.blocksera.com/v1/tickers?limit=2000&sort=market_cap_usd');
			$mcwp_body      	= wp_remote_retrieve_body($mcwp_request);
			$mcwp_data 			= json_decode($mcwp_body);
			
			if(!is_wp_error($mcwp_request) && wp_remote_retrieve_response_code($mcwp_request) === 200 && !empty($mcwp_data)){
				$wquery = "SELECT cid, weekly, weekly_not_expire FROM " . $this->tablename;
				$weeklyresult = $this->wpdb->get_results($wquery);
				$output = [];

				foreach($weeklyresult as $eachweek){
					$output[$eachweek->cid] = [
						'weekly' => $eachweek->weekly,
						'weekly_not_expire' => $eachweek->weekly_not_expire,
					];
				}
				$truncate = $this->wpdb->query('TRUNCATE ' . $this->tablename);
				
				if($truncate){
					$prefix = "INSERT INTO `{$this->tablename}` (`cid`, `name`, `symbol`, `rank`, `img`, `price_usd`, `market_cap_usd`, `percent_change_24h`, `weekly`, `weekly_not_expire`) VALUES ";
					
					$numItems = count($mcwp_data);
					$i = 0;
					$qstring = [];
					foreach ( $mcwp_data as $j => $coins ) {
						if (!($coins->market_cap === null || $coins->market_cap_rank === null)) {
							if(array_key_exists($coins->id, $output)){
								$insweekly = $output[$coins->id]['weekly'];
								$insweeklyexpire = $output[$coins->id]['weekly_not_expire'];
							} else {
								$insweekly = '';
								$insweeklyexpire = gmdate("Y-m-d H:i:s");
							}
							
							$coinsid = $coins->id;
							$coinsname = $coins->name;
							$coinssymbol = strtoupper($coins->symbol);
							$coinsrank = $coins->market_cap_rank;
							$coinsimg = (($coins->image != 'missing_large.png') ? explode('?', explode('images/', $coins->image)[1])[0] : 'error');
							$coinspriceusd = floatval($coins->current_price);
							$coinsmarketcapusd = floatval($coins->market_cap);
							$coinspercentchange24h = floatval($coins->price_change_percentage_24h);
							
							$qstring[] = array($coinsid, $coinsname, $coinssymbol, $coinsrank, $coinsimg, $coinspriceusd, $coinsmarketcapusd, $coinspercentchange24h, $insweekly, $insweeklyexpire);
						}
					}
					
					$qstring = array_chunk($qstring, 100, true);

					foreach($qstring as $chunk) {
						$placeholder = "(%s, %s, %s, %d, %s, %0.14f, %0.2f, %0.2f, %s, %s)";
						$query = $prefix . implode(", ", array_fill(0, count($chunk), $placeholder));
						$this->wpdb->query($this->wpdb->prepare($query, call_user_func_array('array_merge', $chunk)));
					}

					set_transient('mcwp-data-time', true, 30*MINUTE_IN_SECONDS);
				}
			} else {
				$this->wpdb->get_results("SELECT cid FROM {$this->tablename}");
				if ($this->wpdb->num_rows > 0) {
					set_transient('mcwp-data-time', time(), 10*MINUTE_IN_SECONDS);
				}
			}
		}

		$mcwp_data = $this->wpdb->get_results($cquery);

		return $mcwp_data;
	}

	public function weekly_chart($postcoins) {
		//check sql
		$query = "SELECT cid, symbol, weekly, weekly_not_expire FROM `{$this->tablename}` WHERE `cid` IN ('" . implode("','", explode(",", $postcoins)) . "')";
		$results = $this->wpdb->get_results($query);
		
		$output = []; $expiredcoins = [];
		foreach($results as $res) {
			array_push($output, $res->cid);
			
			//create list of coins to request and update to sql
			$dateFromDatabase = strtotime($res->weekly_not_expire);
			$dateTwelveHoursAgo = strtotime("-3 hours");
			
			if(($dateFromDatabase < $dateTwelveHoursAgo) || ($res->weekly == '')){
				array_push($expiredcoins, $res->cid);
			}
		}
		
		if(!empty($expiredcoins)){
			$url 			= 'https://api.blocksera.com/v1/tickers/weekly?coins='.strtolower(implode(',', $expiredcoins)).'&limit=24';
			$mcwp_request   = wp_remote_get($url);
			$mcwp_body      = wp_remote_retrieve_body($mcwp_request);
			$mcwp_data 		= json_decode($mcwp_body);
		
			if(!is_wp_error($mcwp_request) && wp_remote_retrieve_response_code($mcwp_request) === 200 && !empty($mcwp_data)){
				foreach($expiredcoins as $j => $sym) {
					$weekquery  = "UPDATE `{$this->tablename}` SET `weekly` = '%s', `weekly_not_expire` = '%s' WHERE `cid` = '%s'";
					$weekresult = $this->wpdb->query($this->wpdb->prepare($weekquery, [implode(',', $mcwp_data->$sym), gmdate("Y-m-d H:i:s"), $expiredcoins[$j]]));
				}
			} else {
				foreach($expiredcoins as $j => $sym) {
					$weekquery  = "UPDATE `{$this->tablename}` SET `weekly_not_expire` = '%s' WHERE `cid` = '%s'";
					$weekresult = $this->wpdb->query($this->wpdb->prepare($weekquery, [gmdate("Y-m-d H:i:s", strtotime("-55 minutes")), $expiredcoins[$j]]));
				}
			}
		}
		
		$newarr = [];
		foreach($results as $res){
			$newarr[$res->cid] = (isset($mcwp_data->{$res->cid})) ? $mcwp_data->{$res->cid} : explode(',', $res->weekly);
		}
		
		return $newarr;
	}

	public function create_post_type() {

		function mcwp_hide_title() {
			remove_post_type_support('mcwp', 'title');
		}

		function mcwp_create_post_type() {

			$labels = array(
				'name'                  => _x( 'Cryptocurrency Widgets Pack', 'Post Type General Name', 'cryptocurrency-widgets-pack' ),
				'singular_name'         => _x( 'Cryptocurrency Widgets Pack', 'Post Type Singular Name', 'cryptocurrency-widgets-pack' ),
				'menu_name'             => __( 'Crypto Widgets', 'cryptocurrency-widgets-pack' ),
				'name_admin_bar'        => __( 'Post Type', 'cryptocurrency-widgets-pack' ),
				'archives'              => __( 'Widget Archives', 'cryptocurrency-widgets-pack' ),
				'attributes'            => __( 'Widget Attributes', 'cryptocurrency-widgets-pack' ),
				'parent_item_colon'     => __( 'Parent Widget:', 'cryptocurrency-widgets-pack' ),
				'all_items'             => __( 'All Widgets', 'cryptocurrency-widgets-pack' ),
				'add_new_item'          => __( 'Add New Crypto Widget', 'cryptocurrency-widgets-pack' ),
				'add_new'               => __( 'Add New', 'cryptocurrency-widgets-pack' ),
				'new_item'              => __( 'New Widget', 'cryptocurrency-widgets-pack' ),
				'edit_item'             => __( 'Edit Widget', 'cryptocurrency-widgets-pack' ),
				'view_item'             => __( 'View Widget', 'cryptocurrency-widgets-pack' ),
				'view_items'            => __( 'View Widgets', 'cryptocurrency-widgets-pack' ),
				'search_items'          => __( 'Search Widget', 'cryptocurrency-widgets-pack' ),
				'not_found'             => __( 'Not found', 'cryptocurrency-widgets-pack' ),
				'not_found_in_trash'    => __( 'Not found in Trash', 'cryptocurrency-widgets-pack' ),
				'featured_image'        => __( 'Featured Image', 'cryptocurrency-widgets-pack' ),
				'set_featured_image'    => __( 'Set featured image', 'cryptocurrency-widgets-pack' ),
				'remove_featured_image' => __( 'Remove featured image', 'cryptocurrency-widgets-pack' ),
				'use_featured_image'    => __( 'Use as featured image', 'cryptocurrency-widgets-pack' ),
				'insert_into_item'      => __( 'Insert into widget', 'cryptocurrency-widgets-pack' ),
				'uploaded_to_this_item' => __( 'Uploaded to this widget', 'cryptocurrency-widgets-pack' ),
				'items_list'            => __( 'Widgets list', 'cryptocurrency-widgets-pack' ),
				'items_list_navigation' => __( 'Widgets list navigation', 'cryptocurrency-widgets-pack' ),
				'filter_items_list'     => __( 'Filter widgets list', 'cryptocurrency-widgets-pack' ),
			);

			$args = array(
				'label'                 => __( 'Cryptocurrency Widgets Pack', 'cryptocurrency-widgets-pack' ),
				'description'           => __( 'Post Type Description', 'cryptocurrency-widgets-pack' ),
				'labels'                => $labels,
				'supports'              => array( 'title' ),
				'taxonomies'            => array(''),
				'hierarchical'          => false,
				'public' 				=> false,
				'show_ui'               => true,
				'show_in_nav_menus' 	=> false,
				'menu_position'         => 5,
				'show_in_admin_bar'     => true,
				'show_in_nav_menus'     => true,
				'can_export'            => true,
				'has_archive' 			=> false,
				'rewrite' 				=> false,
				'exclude_from_search'   => true,
				'publicly_queryable'    => false,
				'query_var'				=> false,
				'menu_icon'           	=> 'data:image/svg+xml;base64,'.base64_encode('<svg width="32" height="32" xmlns="http://www.w3.org/2000/svg"><path xmlns="http://www.w3.org/2000/svg" fill="#FFF" fill-rule="evenodd" d="M16 32C7.163 32 0 24.837 0 16S7.163 0 16 0s16 7.163 16 16-7.163 16-16 16zm7.189-17.98c.314-2.096-1.283-3.223-3.465-3.975l.708-2.84-1.728-.43-.69 2.765c-.454-.114-.92-.22-1.385-.326l.695-2.783L15.596 6l-.708 2.839c-.376-.086-.746-.17-1.104-.26l.002-.009-2.384-.595-.46 1.846s1.283.294 1.256.312c.7.175.826.638.805 1.006l-.806 3.235c.048.012.11.03.18.057l-.183-.045-1.13 4.532c-.086.212-.303.531-.793.41.018.025-1.256-.313-1.256-.313l-.858 1.978 2.25.561c.418.105.828.215 1.231.318l-.715 2.872 1.727.43.708-2.84c.472.127.93.245 1.378.357l-.706 2.828 1.728.43.715-2.866c2.948.558 5.164.333 6.097-2.333.752-2.146-.037-3.385-1.588-4.192 1.13-.26 1.98-1.003 2.207-2.538zm-3.95 5.538c-.533 2.147-4.148.986-5.32.695l.95-3.805c1.172.293 4.929.872 4.37 3.11zm.535-5.569c-.487 1.953-3.495.96-4.47.717l.86-3.45c.975.243 4.118.696 3.61 2.733z"/></svg>'),
				'capability_type'       => 'page',
			);

			register_post_type('mcwp', $args);
		}
		
		add_action('init',	 			'mcwp_create_post_type');
		add_action('admin_init', 		'mcwp_hide_title');
		add_action('admin_menu', 		array($this->display, 'register_menu'), 12);
		add_action('add_meta_boxes', 	array($this, 'widget_box'));
		add_action('save_post', 		array($this, 'save_widget'));

		add_filter('manage_mcwp_posts_columns', 	  array($this, 'posts_columns_content'));
		add_action('manage_mcwp_posts_custom_column', array($this, 'posts_custom_column'), 10, 2);

		load_plugin_textdomain('cryptocurrency-widgets-pack', false, dirname(plugin_basename(__FILE__)) . '/languages' );
	}

	public function widget_box() {
		add_meta_box( 'mcwp_crypto_widget_box', __( 'Cryptocurrency Widgets Pack Settings', 'cryptocurrency-widgets-pack' ), array( $this, 'widget_settings' ), 'mcwp', 'normal', 'high' );
		add_meta_box( 'mcwp_crypto_widget_shortcode', __( 'Crypto Widgets Shortcode', 'cryptocurrency-widgets-pack' ), array( $this->display, 'shortcode' ), 'mcwp', 'side', 'high' );
		add_meta_box( 'mcwp_crypto_widget_pro', __( 'Rate the Plugin & Pro Features', 'cryptocurrency-widgets-pack' ), array( $this->display, 'pro' ), 'mcwp', 'side', 'low' );
	}

	public function posts_columns_content($columns) {
		$newcolumn = array();
		foreach($columns as $key => $title) {
			if ($key=='date') {
				$newcolumn['shortcode'] = __('Shortcode','cryptocurrency-widgets-pack');
				$newcolumn['type'] = __('Widget Type','cryptocurrency-widgets-pack');
			}
			$newcolumn[$key] = $title;
		}
		return $newcolumn;
	}

	public function posts_custom_column($column, $post_id) {
		switch ($column) {
			case 'type':
				$type = get_post_meta($post_id, 'crypto_ticker', true);
				_e(ucfirst($type), 'mcwp');
				break;
			case 'shortcode':
				echo '<code>[cryptopack id="' . $post_id . '"]</code>';
				break;
		}
	}

	public function widget_settings($post) {

		wp_nonce_field(plugin_basename( __FILE__ ), 'mcwp_widget_nonce');
		$data = $this->shortcode->data($post->ID);

		require_once(MCWP_PATH . 'includes/settings.php');
	}

	public function save_widget($post_id) {

		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
		return;

		if (!isset($_POST['mcwp_widget_nonce']) || !wp_verify_nonce($_POST['mcwp_widget_nonce'], plugin_basename( __FILE__ )))
			return;

		if ('page' == $_POST['post_type'] ) {
			if (!current_user_can('edit_page', $post_id))
				return;
		} else {
			if (!current_user_can('edit_post', $post_id))
				return;
		}

		$allpostmetas = $this->shortcode->allpostmetas;
		
		for($k = 0; $k < sizeof($allpostmetas); $k++) {
			
			$temp = $allpostmetas[$k];

			if($temp == 'crypto_ticker_coin' || $temp == 'crypto_ticker_columns' || $temp == 'crypto_card_columns' || $temp == 'crypto_table_columns'){	
				$mcwptags    =  isset( $_POST[$temp] ) ? (array) $_POST[$temp] : array();
				$mcwptags    =  array_map('sanitize_text_field', $mcwptags);
				$value       =  $mcwptags;

			} elseif ($temp ==  'crypto_speed' || $temp == 'crypto_bunch_select') {
				$value       =  intval($_POST[$temp]);

			} elseif ($temp ==  'crypto_text_color' || $temp == 'crypto_background_color') {
				$value       =  sanitize_hex_color($_POST[$temp]);

			} elseif ($temp ==  'crypto_custom_css'){
				$value       =  trim(strip_tags($_POST[$temp]));

			} else {
				$value       =  sanitize_text_field($_POST[$temp]);
			}

			update_post_meta($post_id, $temp, $value);
		}
	}

	public function mcwp_coinsyms() {

		$query = "SELECT cid, name, symbol FROM `{$this->tablename}` ORDER BY `rank` ASC";
		
		$output = array('cid' => array(), 'names' => array(), 'symbols' => array());
		$coins = $this->fetch_coins($query);

		foreach($coins as $coin) {
			$output['cid'][] = strtolower($coin->cid);
			$output['names'][] = strtolower($coin->name);
			$output['symbols'][] = strtolower($coin->symbol);
		}
		
		return $output;
	}

	public function shortcode($atts) {

		$atts = shortcode_atts(array(
			'id' => '',
		), $atts, 'cryptopack');

		$mcwp_post_id  = intval($atts['id']);

		if((get_post_status( $mcwp_post_id ) != 'publish') && (!is_admin())) {
			return '';
		}

		$data = $this->shortcode->data($mcwp_post_id);

		$mcwp_coinsyms = $this->mcwp_coinsyms();
		$mcwp_cid = $mcwp_coinsyms['cid'];
		$selectedcoins = $this->shortcode->selectedCoins($mcwp_cid, $data);

		$custom_css = '';
		if(!empty($selectedcoins)){

			$query = "SELECT * FROM `{$this->tablename}` WHERE `cid` IN (".implode(', ', array_fill(0, count($selectedcoins), '%s')).") ORDER BY `rank` ASC";
			$coins = $this->fetch_coins($this->wpdb->prepare($query, call_user_func_array('array_merge', [$selectedcoins])));
			
			if($data->crypto_custom_css != ''){
				
				$custom_css .= $data->crypto_custom_css;
			}
			
			$output = '<div class="mcwp-crypto" id="mcwp-'.$mcwp_post_id.'">';

			// ticker
			if($data->crypto_ticker == 'ticker')
			{
				if(($data->crypto_ticker_position != 'header') && ($data->crypto_ticker_position != 'footer') || (is_admin()))
				{
					if($data->crypto_text_color !== ''){
						$custom_css .= '#mcwp-'.$mcwp_post_id.'.mcwp-crypto .cc-coin b { color: '.esc_attr($data->crypto_text_color).'; }';
					}

					$output = $this->shortcode->ticker($output, $coins, $data);
				}

			// table
			} elseif($data->crypto_ticker == 'table') {

				$output = $this->shortcode->table($output, $selectedcoins, $data);

			// card
			} elseif($data->crypto_ticker == 'card') {

				if($data->crypto_text_color !== '') {
					$custom_css .= '#mcwp-'.$mcwp_post_id.'.mcwp-crypto div.mcwp-card * { color: '.esc_attr($data->crypto_text_color).'; }';
				}
				
				$output = $this->shortcode->card($output, $selectedcoins, $coins, $data);

			// label
			} elseif($data->crypto_ticker == 'label') {

				if($data->crypto_text_color !== '') {
					$custom_css .= '#mcwp-'.$mcwp_post_id.'.mcwp-crypto div.mcwp-label * { color: '.esc_attr($data->crypto_text_color).'; }';
				}

				$output = $this->shortcode->label($output, $selectedcoins, $coins, $data);
			}

			$output .= '</div>';

		} else {
			$output = $this->display->crypto_four_not_four();
		}
		
		wp_register_style('mcwp-custom', false);
		wp_enqueue_style('mcwp-custom');
		wp_add_inline_style('mcwp-custom', $custom_css);

		return $output;
	}

	public function global_ticker() {
		
		//get your custom posts ids as an array
		$posts = get_posts(array(
			'post_type'   		=> 'mcwp',
			'post_status' 		=> 'publish',
			'posts_per_page' 	=> -1,
			'orderby'          	=> 'date',
			'order'            	=> 'DESC'
			)
		);

		$custom_css = '';
		
		//loop over each post
		foreach($posts as $p) {
			//get the meta you need form each post
			if(get_post_meta($p->ID, 'crypto_ticker', true) != 'ticker') {
				continue;
			}

			$output = '';

			if(in_array(get_post_meta($p->ID, 'crypto_ticker_position', true), ['header', 'footer'])) {

				$data = $this->shortcode->data($p->ID);

				$mcwp_coinsyms = $this->mcwp_coinsyms();
				$mcwp_cid = $mcwp_coinsyms['cid'];
				$selectedcoins = $this->shortcode->selectedCoins($mcwp_cid, $data);


				if(!empty($selectedcoins))
				{
					$query = "SELECT * FROM `{$this->tablename}` WHERE `cid` IN (".implode(', ', array_fill(0, count($selectedcoins), '%s')).") ORDER BY `rank` ASC";
					$coins = $this->fetch_coins($this->wpdb->prepare($query, call_user_func_array('array_merge', [$selectedcoins])));

					if($data->crypto_custom_css != '') {
						$custom_css .= $data->crypto_custom_css;
					}

					$output .= '<div class="mcwp-crypto" id="mcwp-'.$p->ID.'">';

					if($data->crypto_text_color !== ''){
						$custom_css .= '#mcwp-'.$p->ID.'.mcwp-crypto .cc-coin b { color: '.esc_attr($data->crypto_text_color).'; }';
					}

					$output = $this->shortcode->ticker($output, $coins, $data);

					echo apply_filters('cwp_show_ticker', $output);
				}
				break;
			}

			wp_register_style('mcwp-custom-ticker', false);
			wp_enqueue_style('mcwp-custom-ticker');
			wp_add_inline_style('mcwp-custom-ticker', $custom_css);

			echo $output;
		}
	}

	public function table_data() {

		$allowed_orders = [
			'rank',
			'name',
			'price_usd',
			'market_cap_usd',
			'percent_change_24h',
		];
		
		//sanitization
		$mcwp_post_id  = intval($_GET['mcwp_id']);

		$orderby = sanitize_text_field($_GET['columns'][intval($_GET['order'][0]['column'])]['name']);
		$orderdir = sanitize_text_field($_GET['order'][0]['dir']);
		$orderdir = 'DESC' === strtoupper($orderdir) ? 'DESC' : 'ASC';
		
		$orderby = in_array($orderby, $allowed_orders) ? $orderby : 'rank';
		$order = sanitize_sql_orderby("{$orderby} {$orderdir}");

		$start = intval($_GET['start']);
		$length = intval($_GET['length']);

		$data = $this->shortcode->data($mcwp_post_id);
		
		$mcwp_coinsyms = $this->mcwp_coinsyms();
		$mcwp_cid = $mcwp_coinsyms['cid'];
		$selectedcoins = $this->shortcode->selectedCoins($mcwp_cid, $data);
		
		$output = '';
		
		$query = "SELECT * FROM `{$this->tablename}` WHERE `cid` IN (\"" . implode('","', $selectedcoins) . "\") ORDER BY {$order} LIMIT %d, %d";

		$mcwp_names = [];
		$coins = $this->fetch_coins($this->wpdb->prepare($query, [$start, $length]));

		$arr = [];


		$eachcid = [];
		foreach($coins as $coin) {
			array_push($eachcid, $coin->cid);
		}

		$postcoins = implode(',', $eachcid);
		$weekly = $this->weekly_chart($postcoins);

		foreach($coins as $coin) {
			$key = [];
			$key['rank']		= intval($coin->rank);
			$key['name'] 		= esc_html($coin->name);
			$key['symbol'] 		= esc_html($coin->symbol);
			$key['price'] 		= esc_html($coin->price_usd);
			$key['mcap'] 		= esc_html($coin->market_cap_usd);
			$key['change'] 		= esc_html($coin->percent_change_24h);
			$key['weekly'] 		= array_map('esc_html', $weekly[$coin->cid]);
			$key['cid'] 		= esc_html($coin->cid);
			$key['imgpath'] 	= esc_url($this->shortcode->mcwp_image_id($coin->img));

			if(is_array($data->crypto_table_columns) && in_array('coingecko', $data->crypto_table_columns)) {
				$key['link'] 	= true;
			}

			$arr[] = $key;
		}
		
		$output = array(
			'recordsTotal' => sizeof($selectedcoins),
			'recordsFiltered' => sizeof($selectedcoins),
			'draw'=> $_GET['draw'],
			'data'=> $arr
		);

		return wp_send_json($output);
	}

}
}

function MCWP_Crypto() {
    return MCWP_Crypto::get_instance();
}

$GLOBALS['MCWP_Crypto'] = MCWP_Crypto();