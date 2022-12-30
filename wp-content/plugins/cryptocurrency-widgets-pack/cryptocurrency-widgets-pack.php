<?php
/**
 * Plugin Name: 		Cryptocurrency Widgets Pack
 * Plugin URI:          https://massivecryptopro.blocksera.com
 * Author: 				Blocksera
 * Author URI:			https://blocksera.com
 * Description: 		Price ticker, table, cards, label widget for all cryptocurrencies using coinmarketcap API.
 * Version: 			1.5.3
 * Requires at least:   4.0
 * Tested up to:        4.9.8
 * License: 			GPL v3
 * Text Domain:			cryptocurrency-widgets-pack
 * Domain Path: 		/languages
 *
**/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define('MCWP_VERSION', '1.5.3');
define('MCWP_PATH', plugin_dir_path(__FILE__));
define('MCWP_URL', plugin_dir_url(__FILE__));

register_activation_hook(__FILE__, array('MCWP_Crypto','activate'));
register_deactivation_hook(__FILE__, array('MCWP_Crypto','deactivate'));

if ( ! class_exists( 'MCWP_Crypto' ) ) {
class MCWP_Crypto {
	
    private static $_instance = null;
	public $allpostmetas = array('crypto_ticker','crypto_ticker_coin','crypto_ticker_position','crypto_bunch_select','crypto_speed','crypto_ticker_columns','crypto_card_columns','crypto_background_color','crypto_text_color','crypto_custom_css');

	public static function get_instance() {
		if ( ! self::$_instance ) {
			self::$_instance = new self();
		}

		return self::$_instance;
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
		delete_transient('mcwp-imageid');
    }
	
	public function __construct() {
        global $wpdb;
        
		if ( self::$_instance ) {
			return;
        }
        
        self::$_instance = $this;
        $this->wpdb = $wpdb;
        $this->tablename = $this->wpdb->prefix . "mcwp_coins";
		$this->mcwp_includes();
		$this->upgrade_version();
		
		$this->image_id = $this->mcwp_image_id();
		
		require_once(MCWP_PATH . 'includes/duplicate.php');
		
		add_action('admin_init',                        array($this, 'mcwp_admin_hooks'));
		add_action('admin_enqueue_scripts', 			array($this,'mcwp_scripts'));
		add_action('admin_enqueue_scripts', 			array($this,'mcwp_frontend_scripts'));
		add_action('wp_enqueue_scripts', 				array($this,'mcwp_frontend_scripts'));
		add_shortcode('cryptopack', 					array($this,'mcwp_shortcode'));
		add_action('wp_footer',							array($this,'mcwp_tickerHeadFooter'));
		add_action('wp_ajax_mcwp_table', 				array($this,'mcwp_tables'));
		add_action('wp_ajax_nopriv_mcwp_table', 		array($this,'mcwp_tables'));
	}

	public function mcwp_admin_hooks() {
		add_filter('plugin_action_links', 				array($this,'mcwp_action_links'), 10, 2 );
		add_filter('plugin_row_meta',   				array($this,'mcwp_row_meta'), 10, 2 );

		if(!get_option('mcwp-notice')){
			add_option('mcwp-notice','1');
		}
		if(get_option('mcwp-notice') && get_option('mcwp-notice') != 0) {
			add_action('wp_ajax_mcwp_notice', 			array($this,'mcwp_notice_dismiss'));
		}

		if(!get_option('mcwp-top-notice')){
			add_option('mcwp-top-notice',strtotime(current_time('mysql')));
		}
		if(get_option('mcwp-top-notice') && get_option('mcwp-top-notice') != 0) {
			if( get_option('mcwp-top-notice') < strtotime('-3 days')) { //if greater than 3 days
				add_action('admin_notices', 			array($this,'mcwp_top_admin_notice'));
				add_action('wp_ajax_mcwp_top_notice',	array($this,'mcwp_top_notice_dismiss'));
			}
		}
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

	}
	
	public function mcwp_scripts(){
		wp_enqueue_style(	'wp-color-picker');
		wp_enqueue_script(	'wp-color-picker');
		wp_enqueue_style(	'mcwpa-crypto-css', 		MCWP_URL . 'assets/admin/css/style.css',array(),MCWP_VERSION,'all');
		wp_enqueue_style(	'mcwpa-crypto-select-css', 	MCWP_URL . 'assets/admin/css/selectize.default.css',array(),MCWP_VERSION,'all');
		wp_enqueue_script(	'mcwpa-crypto-es5',			MCWP_URL . 'assets/admin/js/es5.js',array('jquery'), MCWP_VERSION,true);
		wp_script_add_data(	'mcwpa-crypto-es5', 		'conditional', 'lt IE 9' );
		wp_enqueue_script(	'mcw-crypto-select', 		MCWP_URL . 'assets/admin/js/selectize.min.js',array('jquery'), MCWP_VERSION,true);
		wp_enqueue_script(	'mcwpa-crypto-common', 		MCWP_URL . 'assets/admin/js/common.js',array('jquery'), MCWP_VERSION,true);
	}
	
	public function mcwp_frontend_scripts(){
		
		
		wp_enqueue_style(	'mcwp-crypto-css', 				MCWP_URL . 'assets/public/css/style.css',array(),MCWP_VERSION,'all');
		wp_enqueue_style(	'mcwp-crypto-datatable-css',	MCWP_URL . 'assets/public/css/datatable-style.css',array(),MCWP_VERSION,'all');
		wp_enqueue_script(	'mcwp-crypto-datatable-js',		MCWP_URL . 'assets/public/js/jquery.dataTables.min.js',array('jquery'), MCWP_VERSION, true);
		wp_enqueue_script(	'mcwp-crypto-datatable-resp',	MCWP_URL . 'assets/public/js/dataTables.responsive.min.js',array('jquery'), MCWP_VERSION, true);
		wp_register_script(	'mcwp-crypto-common', 			MCWP_URL . 'assets/public/js/common.js',array('jquery'), MCWP_VERSION,true);
		wp_localize_script( 'mcwp-crypto-common', 			'mcwpajax', array('url' => MCWP_URL, 'ajax_url' => admin_url('admin-ajax.php')));
		wp_enqueue_script(	'mcwp-crypto-common');
	}
	
	public function mcwp_all_collection($cquery) {
		
		$values = '';
		$mcwp_data_time = get_transient('mcwp-data-time');
		
		if(empty($mcwp_data_time)){
			$mcwp_request   	= wp_remote_get('https://api.coinmarketcap.com/v1/ticker/?limit=2000');
			$mcwp_body      	= wp_remote_retrieve_body($mcwp_request);
			$mcwp_data 			= json_decode($mcwp_body);
			
			if (!empty($mcwp_data)) {
				$wquery = "SELECT cid, weekly, weekly_not_expire FROM " . $this->tablename;
				$weeklyresult = $this->wpdb->get_results($wquery);
				$output = [];
				foreach($weeklyresult as $eachweek){
					$output[$eachweek->cid] = [
						'weekly' => $eachweek->weekly,
						'weekly_not_expire' => $eachweek->weekly_not_expire,
					];
				}
				$truncate = $this->wpdb->query('TRUNCATE '.$this->tablename);
				
				if($truncate){
					$query = "INSERT INTO `".$this->tablename."` (`cid`, `name`, `symbol`, `rank`, `price_usd`, `market_cap_usd`, `percent_change_24h`, `weekly`, `weekly_not_expire`) VALUES ";
					
					$numItems = count($mcwp_data);
					$i = 0;
					foreach ( $mcwp_data as $j => $coins ) {
						
						if(array_key_exists($coins->id, $output)){
							$insweekly = '"'.$output[$coins->id]['weekly'].'"';
							$insweeklyexpire = '"'.$output[$coins->id]['weekly_not_expire'].'"';
						} else {
							$insweekly = '""';
							$insweeklyexpire = '"'.gmdate("Y-m-d H:i:s").'"';
						}
						
						$coinsid = $coins->id;
						$coinsname = $coins->name;
						$coinsrank = $coins->rank;
						$coinssymbol = $coins->symbol;
						$coinspriceusd = floatval($coins->price_usd);
						$coinsmarketcapusd = floatval($coins->market_cap_usd);
						$coinspercentchange24h = floatval($coins->percent_change_24h);
						
						
						$values .= '("'.$coinsid.'", "'.$coinsname.'", "'.$coinssymbol.'", '.$coinsrank.', '.$coinspriceusd.', '.$coinsmarketcapusd.', '.$coinspercentchange24h.', '.$insweekly.', '.$insweeklyexpire.')';
						if(++$i !== $numItems) {
							$values .= ', ';
						}
					}
					$query = $query.$values;
					$result = $this->wpdb->query($query);
					if($result){
						set_transient('mcwp-data-time', true, 30*MINUTE_IN_SECONDS);
					}
				}
			}
		}
		
		$mcwp_data = $this->wpdb->get_results($cquery);

		return $mcwp_data;
	}
	
	public function mcwp_image_id() {
		$mcwp_data = get_transient('mcwp-imageid');
		if(empty($mcwp_data)){
			$mcwp_request   	= wp_remote_get('https://api.coinmarketcap.com/v2/listings/');
			$mcwp_body      	= wp_remote_retrieve_body($mcwp_request);
			$mcwp_data 			= json_decode($mcwp_body);
			
			$outputmcwp = [];
			foreach($mcwp_data->data as $mcwpimageid){
				$outputmcwp[$mcwpimageid->website_slug] = $mcwpimageid->id;
			}
			
			if (!empty($mcwp_data)) {
				set_transient('mcwp-imageid', $outputmcwp, DAY_IN_SECONDS);
			}
			$mcwp_data = $outputmcwp;
		}
		return $mcwp_data;
    }
    
    public function mcwp_coinsyms() {	
		$query = "SELECT cid, name, symbol FROM " . $this->tablename;
		$mcwp_coinsyms = array('cid' => array(), 'names' => array(), 'symbols' => array());
		$mcwp_data = $this->mcwp_all_collection($query);
		foreach($mcwp_data as $mcwp_each_data) {
			$mcwp_coinsyms['cid'][] = strtolower($mcwp_each_data->cid);
			$mcwp_coinsyms['names'][] = strtolower($mcwp_each_data->name);
			$mcwp_coinsyms['symbols'][] = strtolower($mcwp_each_data->symbol);
		}
		return $mcwp_coinsyms;
    }
	
	public function mcwp_tables_updates(){
		
		$mcwp_post_id  = intval($_GET['mcwp_id']);
		$allpostmetas = $this->allpostmetas;
		for($k=0;$k<sizeof($allpostmetas);$k++){
			$temp = $allpostmetas[$k];
			${$temp} = get_post_meta( $mcwp_post_id, $temp, true );
		}
		
		$mcwp_coinsyms = $this->mcwp_coinsyms();
		$mcwp_cid = $mcwp_coinsyms['cid'];
        $selectedcoins = array();
		
		if($crypto_bunch_select > 0){
			for($k=0;$k<sizeof($mcwp_cid);$k++){
				if($k < $crypto_bunch_select) {
					array_push($selectedcoins,$mcwp_cid[$k]);
				}
			}
		} else {
			for($k=0;$k<sizeof($mcwp_cid);$k++){
				if(is_array($crypto_ticker_coin) && in_array($mcwp_cid[$k],$crypto_ticker_coin)){
					array_push($selectedcoins,$mcwp_cid[$k]);
				}
			}
		}
		
		$ORDERBY = $_GET['columns'][$_GET['order'][0]['column']]['name'];
		$ORDERDIR = $_GET['order'][0]['dir'];
		$START = $_GET['start'];
		$LENGTH = $_GET['length'];
		
		$query = 'SELECT * FROM `' . $this->tablename . '` WHERE `cid` IN ("' . implode('","', $selectedcoins) . '") ORDER BY '.$ORDERBY.' ' . $ORDERDIR . ' LIMIT '.$START.', '.$LENGTH;

		$mcwp_names = array();
		$mcwp_data = $this->mcwp_all_collection($query);
		
		$arr = [];
		
		
		$eachcid = [];
		foreach($mcwp_data as $mcwp_each_data) {
			array_push($eachcid,$mcwp_each_data->cid);
		}
		$postcoins = implode(',',$eachcid);
		$weekly = $this->mcwp_weekly_chart($postcoins);
		
		foreach($mcwp_data as $mcwp_each_data) {
			$key=array();
			$key['id'] 			= intval($mcwp_each_data->id);
			$key['name'] 		= $mcwp_each_data->name;
			$key['symbol'] 		= $mcwp_each_data->symbol;
			$key['price'] 		= $mcwp_each_data->price_usd;
			$key['mcap'] 		= $mcwp_each_data->market_cap_usd;
			$key['change'] 		= $mcwp_each_data->percent_change_24h;
			$key['weekly'] 		= $weekly[$mcwp_each_data->cid];
			$key['cid'] 		= $mcwp_each_data->cid;
			$key['imgpath'] 	= $this->image_id[$mcwp_each_data->cid];
			
			$arr[] = $key;
			
		}
		
		$output = array(
			'recordsTotal' => sizeof($selectedcoins),
			'recordsFiltered' => sizeof($selectedcoins),
			'draw'=> $_GET['draw'],
			'data'=> $arr
		);
  
		return $output;
	}
	public function mcwp_tables() {
		
		$success = $this->mcwp_tables_updates();
		
		if($success){
			if ( !empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' ) {
				$result = $success;
				echo json_encode($result);
			} else {
				header( "location:" . $_SERVER["HTTP_REFERER"] );
			}
			exit;
		}
	}
	public function mcwp_weekly_chart($postcoins){
		//check sql
		$query = "SELECT cid, symbol, weekly, weekly_not_expire FROM `" . $this->tablename . "` WHERE `cid` IN ('" . implode("','", explode(",",$postcoins)) . "')";
		$results = $this->wpdb->get_results($query);
		
		$output = []; $expiredcoins = [];
		foreach($results as $res) {
			array_push($output,$res->cid);
			
			//create list of coins to request and update to sql
			$dateFromDatabase = strtotime($res->weekly_not_expire);
			$dateTwelveHoursAgo = strtotime("-3 hours");
			
			if(($dateFromDatabase < $dateTwelveHoursAgo) || ($res->weekly == '')){
				array_push($expiredcoins,$res->cid);
			}
		}
		
		$mcwp_data = '';
		if(!empty($expiredcoins)){
			$url 			= 'https://crypto.blocksera.com/getprice?coins='.strtolower(implode(',',$expiredcoins)).'&limit=24';
			$mcwp_request   = wp_remote_get($url);
			$mcwp_body      = wp_remote_retrieve_body($mcwp_request);
			$mcwp_data 		= json_decode($mcwp_body);
		
			foreach($expiredcoins as $j=>$sym){
				
				$weekquery  = "UPDATE `".$this->tablename."` SET `weekly` = '" . implode(',', array_reverse($mcwp_data->$sym)) . "', `weekly_not_expire` = '" . gmdate("Y-m-d H:i:s") . "' WHERE `cid` = '".$expiredcoins[$j]."'";
				$weekresult = $this->wpdb->query($weekquery);
			}
		}
		
		$newarr = [];
		foreach($results as $res){
			$newarr[$res->cid] = ($mcwp_data->{$res->cid} == NULL) ? explode(',',$res->weekly) : $mcwp_data->{$res->cid};
		}
		
		return $newarr;
	}
	public function mcwp_includes() {
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
			register_post_type( 'mcwp', $args );
		}
		
		add_action('init',	 			'mcwp_create_post_type' );
		add_action('admin_init', 		'mcwp_hide_title');
		add_action('admin_menu', 		array( $this, 'mcwp_register_menu'), 12 );
		add_action('add_meta_boxes', 	array( $this, 'mcwp_crypto_widget_box' ) );
		add_action('save_post', 		array( $this, 'mcwp_crypto_widget_box_save' ) );
		add_filter('manage_mcwp_posts_columns', 	  array($this,'mcwp_columns_content'));
		add_action('manage_mcwp_posts_custom_column', array($this,'mcwp_custom_column'), 10, 2);
		load_plugin_textdomain('cryptocurrency-widgets-pack', false, dirname(plugin_basename(__FILE__)) . '/languages' );
	}

	public function mcwp_notice_dismiss(){
		update_option('mcwp-notice','0');
		exit();
	}

	public function mcwp_top_notice_dismiss(){
		update_option('mcwp-top-notice','0');
		exit();
	}
	
	public function mcwp_top_admin_notice(){
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
	
	public function mcwp_action_links($actions, $plugin_file){
		if( false === strpos( $plugin_file, basename(__FILE__) ) ) return $actions;
		
		$settings_link = '<a href="'.admin_url().'post-new.php?post_type=mcwp" style="font-weight:bold;">' . __('Add Widgets','cryptocurrency-widgets-pack') . '</a>';
		$faq_link = '<a target="_blank" href="https://massivecryptopro.blocksera.com/#faq" style="color:#eda600;font-weight:bold;">' . __('FAQ','cryptocurrency-widgets-pack') . '</a>';
		$gopro_link = '<a target="_blank" href="https://massivecryptopro.blocksera.com" style="color:#39b54a;font-weight:bold;">' . __('Go Pro','cryptocurrency-widgets-pack') . '</a>';
		
		array_unshift( $actions, $gopro_link );
		array_unshift( $actions, $faq_link );
		array_unshift( $actions, $settings_link );

		return $actions;
	}

	public function mcwp_row_meta( $meta, $plugin_file ){
		if( false === strpos( $plugin_file, basename(__FILE__) ) ) return $meta;

		$meta[] = '<a href="https://blocksera.com/contact/" target="_blank">' . __('Support','cryptocurrency-widgets-pack') . '</a>';
		return $meta;
	}

	public function mcwp_register_menu() {

		// Register plugin premium page
		add_submenu_page(
			'edit.php?post_type=mcwp',
			__('Upgrade To PRO - Massive Cryptocurrency Widgets','cryptocurrency-widgets-pack'),
			'<span style="color:greenyellow;">'.__('Upgrade to PRO&nbsp;&nbsp;&#x27a4;', 'cryptocurrency-widgets-pack').'</span>',
			'manage_options',
			'mcwp-premium',
			array($this, 'mcwp_premium_page')
		);
	}

	public function mcwp_premium_page() {
		include_once( MCWP_PATH . '/includes/mcwp-premium.php' );
	}

	public function mcwp_columns_content($columns) {
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
	
	public function mcwp_custom_column($column, $post_id) {
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
	
	public function mcwp_crypto_widget_box() {
		add_meta_box( 'mcwp_crypto_widget_box', __( 'Cryptocurrency Widgets Pack Settings', 'cryptocurrency-widgets-pack' ),	array( $this, 'mcwp_crypto_widget_box_content' ), 'mcwp', 'normal', 'high' );
		add_meta_box( 'mcwp_crypto_widget_shortcode', __( 'Crypto Widgets Shortcode', 'cryptocurrency-widgets-pack' ), array( $this, 'mcwp_crypto_shortcode_content' ), 'mcwp', 'side', 'high' );
		add_meta_box( 'mcwp_crypto_widget_pro', __( 'Rate the Plugin & Pro Features', 'cryptocurrency-widgets-pack' ), array( $this, 'mcwp_crypto_shortcode_pro' ), 'mcwp', 'side', 'low' );
	}
	
	public function mcwp_crypto_shortcode_pro( $post ) {
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
			<h3><?php _e('Pro Features:','cryptocurrency-widgets-pack'); ?></h3>
			<ul>
			<li><?php _e('Advanced Ticker, Tables and List Widgets','cryptocurrency-widgets-pack'); ?></li>
			<li><?php _e('Line and Candlestick charts','cryptocurrency-widgets-pack'); ?></li>
			<li><?php _e('Cryptocurrency Converters','cryptocurrency-widgets-pack'); ?></li>
			<li><?php _e('Beautiful Designs','cryptocurrency-widgets-pack'); ?></li>
			<li><?php _e('Advance Customizations','cryptocurrency-widgets-pack'); ?></li>
			</ul>
			<div class="buy"><a target="_blank" href="https://massivecryptopro.blocksera.com"><?php _e('Buy Now','cryptocurrency-widgets-pack'); ?></a></div>
			<img style="max-width: 100%;" src="http://d1.blocksera.com/wp-content/uploads/2018/09/metasale.png" />
		</div>
		<?php
	}
	
	public function mcwp_crypto_shortcode_content( $post ) {
		$dynamic_attr = '[cryptopack id=&quot;'.get_the_id().'&quot;]';
		
		echo '<div class="mcwp-shortcode">' . __('Paste this shortcode anywhere like page, post or widgets','cryptocurrency-widgets-pack');
		
		echo '<br/><br/><div>'.$dynamic_attr.'</div></div>';
		echo '<div class="mcwp-pro-add"><a href="https://massivecryptopro.blocksera.com" target="_blank">' . __("Add Massive Cryptocurrency Widgets", "cryptocurrency-widgets-pack") . '</a></div>';
	}
	
	public function mcwp_crypto_widget_box_content( $post ) {
		wp_nonce_field( plugin_basename( __FILE__ ), 'mcwp_crypto_widget_box_content_nonce' );
		
		$allpostmetas = $this->allpostmetas;
		for($k=0;$k<sizeof($allpostmetas);$k++){
			$temp = $allpostmetas[$k];
			${$temp} = get_post_meta( $post->ID, $temp, true );	
		}
		
		require_once(MCWP_PATH . 'includes/mcwp-settings.php');
	}

	public function mcwp_crypto_widget_box_save( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return;

		if ( !isset($_POST['mcwp_crypto_widget_box_content_nonce']) || !wp_verify_nonce( $_POST['mcwp_crypto_widget_box_content_nonce'], plugin_basename( __FILE__ ) ) )
			return;

		if ( 'page' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id ) )
				return;
		} else {
			if ( !current_user_can( 'edit_post', $post_id ) )
				return;
		}
		$allpostmetas = $this->allpostmetas;
		for($k=0;$k<sizeof($allpostmetas);$k++){
			$temp = $allpostmetas[$k];

			if($temp == 'crypto_ticker_coin' || $temp == 'crypto_ticker_columns' || $temp == 'crypto_card_columns'){	
				$mcwptags    =  isset( $_POST[$temp] ) ? (array) $_POST[$temp] : array();
				$mcwptags    =  array_map( 'esc_attr', $mcwptags );				
				${$temp}     =  $mcwptags;
	
			} elseif ($temp ==  'crypto_speed' || $temp == 'crypto_bunch_select') {
				${$temp}     =  (int) $_POST[$temp];

			} elseif ($temp ==  'crypto_text_color' || $temp == 'crypto_background_color') {
				${$temp}     =  sanitize_hex_color($_POST[$temp]);

			} elseif ($temp ==  'crypto_custom_css'){
				${$temp}     =  trim( strip_tags($_POST[$temp] ) );

			} else {
				${$temp}     =  sanitize_text_field($_POST[$temp]);
			}

			update_post_meta( $post_id, $temp, ${$temp} );
		}
	}

	public function is_edit_page($new_edit = null){
		global $pagenow;
		//make sure we are on the backend
		if (!is_admin()) return false;


		if($new_edit == "edit")
			return in_array( $pagenow, array( 'post.php',  ) );
		elseif($new_edit == "new") //check for new post page
			return in_array( $pagenow, array( 'post-new.php' ) );
		else //check for either new or edit
			return in_array( $pagenow, array( 'post.php', 'post-new.php' ) );
	}

	public function mcwp_shortcode($atts){
		$atts = shortcode_atts(array(
            'id' => '',
        ), $atts, 'cryptopack');

		$mcwp_post_id  = esc_attr((int) $atts['id']);

		if((get_post_status( $mcwp_post_id ) != 'publish') && (!is_admin())) {
			return '';
		}

		$allpostmetas = $this->allpostmetas;
		for($k=0;$k<sizeof($allpostmetas);$k++){
			$temp = $allpostmetas[$k];
			${$temp} = get_post_meta( $mcwp_post_id, $temp, true );
		}

		$mcwp_coinsyms = $this->mcwp_coinsyms();
		$mcwp_cid = $mcwp_coinsyms['cid'];
		$selectedcoins = array();

		$output = '';

		if($crypto_bunch_select > 0){
			for($k=0;$k<sizeof($mcwp_cid);$k++){
				if($k < $crypto_bunch_select) {
					array_push($selectedcoins,$mcwp_cid[$k]);
				}
			}
		} else {
			for($k=0;$k<sizeof($mcwp_cid);$k++){
				if(is_array($crypto_ticker_coin) && in_array($mcwp_cid[$k],$crypto_ticker_coin)){
					array_push($selectedcoins,$mcwp_cid[$k]);
				}
			}
		}


		if(!empty($selectedcoins)){

			$query = 'SELECT * FROM `' . $this->tablename . '` WHERE `cid` IN ("' . implode('","', $selectedcoins) . '") ORDER BY `rank` ASC';
			$mcwp_data = $this->mcwp_all_collection($query);
			
			if($crypto_custom_css != ''){
				$output .= '<style type="text/css">'."\n".$crypto_custom_css."\n".'</style>';
			}
			$output .= '<div class="cryptoboxes" id="mcwp-'.$mcwp_post_id.'">';

			// ticker
			if($crypto_ticker == 'ticker'){
				if(($crypto_ticker_position != 'header') && ($crypto_ticker_position != 'footer') || (is_admin())) {
					$output .= '<div class="mcwp-ticker mcwp-'. $crypto_ticker_position .'" data-speed="'.$crypto_speed.'">';

					if($crypto_text_color !== ''){
						$output .= '<style type="text/css">
                                #mcwp-'.$mcwp_post_id.'.cryptoboxes .cc-coin b {
                                    color: '.$crypto_text_color.';
                                }
                            </style>';
                            
                        $crypto_background_color = ($crypto_background_color == '') ? '#fff' : $crypto_background_color;
					}
					
						$output .= '<div class="cc-ticker cc-white-color"';	
					if($crypto_background_color !== ''){
						$output .= ' style="background-color:'.$crypto_background_color.';"';
					}
					$output .= '><ul class="cc-stats">';
					foreach($mcwp_data as $j=>$coins) {
						$imagename 	= esc_attr($this->image_id[$coins->cid]);
						$coinscid 	= esc_attr($coins->cid);
						$coinsname 	= esc_attr($coins->name);
						$coinssymbol= esc_attr($coins->symbol);
						$price 		= esc_attr($this->mcwp_currency_convert($coins->price_usd));
						
						$output .= '<li class="cc-coin"><div><img src="//s2.coinmarketcap.com/static/img/coins/32x32/'.$imagename.'.png" alt="'.$coinscid.'">';
						$output .= '<b>'.$coinsname . ' <div>('.$coinssymbol.')</div> <span>'.$price.'</span>';
						if(is_array($crypto_ticker_columns) && in_array('changes',$crypto_ticker_columns)) {
							$output .= $this->mcwp_24h_percentage(esc_attr($coins->percent_change_24h),'span');
						}
						$output .= '</b></div></li>';
					}
					$output .= '</ul></div>';
					$output .= '</div>';
				}
				
			// table
			} elseif($crypto_ticker == 'table') {

				$tablecoins = (sizeof($selectedcoins) > 50) ? 50 : sizeof($selectedcoins);

				$theme = ($crypto_background_color !== '') ? 'custom' : 'light';
				$output .= '<table class="mcwp-datatable table-processing '.$theme.'" data-theme="'.$theme.'" data-color="'.$crypto_text_color.'" data-bgcolor="'.$crypto_background_color.'" data-length="'.$tablecoins.'"><thead><tr>';
				$output .= '<th>#</th><th>' . __('Name','cryptocurrency-widgets-pack') . '</th><th>' . __('Price','cryptocurrency-widgets-pack') . '</th><th>' . __('Market Cap','cryptocurrency-widgets-pack') . '</th><th>' . __('Change','cryptocurrency-widgets-pack') . '</th><th>' . __('Price Graph (24h)','cryptocurrency-widgets-pack') . '</th>';
                $output .= '</tr></thead><tbody>';

				for( $i = 0; $i < $tablecoins; $i++ ) {
					$output .= '<tr><td colspan="56" height="30"><span></span></td></tr>';
				}

				$output .= '</tbody></table>';

			// card
			} elseif($crypto_ticker == 'card') {

				if($crypto_text_color !== '') {
					$output .= '<style type="text/css">
						#mcwp-'.$mcwp_post_id.'.cryptoboxes div.mcwp-card * {
							color: '.$crypto_text_color.';
						}
					</style>';
				}

				foreach($mcwp_data as $j=>$coins) {
					if(in_array(strtolower($coins->cid),$selectedcoins)) {
						$imagename 	= esc_attr($this->image_id[$coins->cid]);
						$coinscid 	= esc_attr($coins->cid);
						$coinsname 	= esc_attr($coins->name);
						$coinssymbol= esc_attr($coins->symbol);
						$price 		= esc_attr($this->mcwp_currency_convert($coins->price_usd));

						$output .= (is_array($crypto_card_columns) && in_array('fullwidth',$crypto_card_columns)) ? '' : '<div class="cc-card-col">';
						$output .= '<div class="mcwp-card mcwp-card-1 mcwp-card-white"';
						if($crypto_background_color !== '') {
							$output .= ' style="background-color:'.$crypto_background_color.';"';
						}
						$output .= '><div class="bg"><img src="//s2.coinmarketcap.com/static/img/coins/128x128/'.$imagename.'.png" alt="'.$coinscid.'"></div>';
						$output .= '<div class="mcwp-card-head"><div><img src="//s2.coinmarketcap.com/static/img/coins/32x32/'.$imagename.'.png" alt="'.$coinscid.'">';
						$output .= '<p>'.$coinsname.' ('.$coinssymbol.')</p>';
						$output .= '</div></div><div class="mcwp-pricelabel">Price</div>';
						$output .= '<div class="mcwp-price">'.$price.'</div>';
						$output .= '</div>';
						$output .= (is_array($crypto_card_columns) && in_array('fullwidth',$crypto_card_columns)) ? '' : '</div>';
					}
				}
			// label
			} elseif($crypto_ticker == 'label') {

				if($crypto_text_color !== '') {
					$output .= '<style type="text/css">
						#mcwp-'.$mcwp_post_id.'.cryptoboxes div.mcwp-label * {
							color: '.$crypto_text_color.';
						}
					</style>';
				}
				
				foreach($mcwp_data as $j=>$coins) {
					if(in_array(strtolower($coins->cid),$selectedcoins)) {
						$imagename 	= esc_attr($this->image_id[$coins->cid]);
						$coinscid 	= esc_attr($coins->cid);
						$coinsname 	= esc_attr($coins->name);
						$coinssymbol= esc_attr($coins->symbol);
						$price 		= esc_attr($this->mcwp_currency_convert($coins->price_usd));
						
						$output .= (is_array($crypto_card_columns) && in_array('fullwidth',$crypto_card_columns)) ? '' : '<div class="cc-label-col">';
						$output .= '<div class="mcwp-label mcwp-label-1 mcwp-label-white"';
						if($crypto_background_color !== '') {
							$output .= '" style="background-color:'.$crypto_background_color.';"';
						}
						$output .= '><div class="mcwp-label-dn1-head"><div class="mcwp-card-head"><div><img src="//s2.coinmarketcap.com/static/img/coins/32x32/'.$imagename.'.png" alt="'.$coinscid.'">';
						$output .= '<p>'.$coinsname.' ('.$coinssymbol.')</p>';
						$output .= '</div></div></div><div class="mcwp-label-dn1-body"><b>'.$price.'</b>';
						$output .= '</div></div>';
						$output .= (is_array($crypto_card_columns) && in_array('fullwidth',$crypto_card_columns)) ? '' : '</div>';
					}
				}
			}
			$output .= '</div>';
		} else {
			$output .= $this->crypto_four_not_four();
		}
		return $output;
	}

	public function mcwp_tickerHeadFooter(){
		
		//get your custom posts ids as an array
		$posts = get_posts(array(
			'post_type'   		=> 'mcwp',
			'post_status' 		=> 'publish',
			'posts_per_page' 	=> -1,
			'orderby'          	=> 'date',
			'order'            	=> 'DESC'
			)
		);
		
		//loop over each post
		foreach($posts as $p){
			//get the meta you need form each post
			
			$crypto_ticker 			 = esc_attr(get_post_meta($p->ID,"crypto_ticker",true));
			$crypto_ticker_coin 	 =array_map('esc_attr',get_post_meta($p->ID,"crypto_ticker_coin",true) );
			$crypto_ticker_position  = esc_attr(get_post_meta($p->ID,"crypto_ticker_position",true));
			$crypto_speed			 = esc_attr(get_post_meta($p->ID,"crypto_speed",true));
			$crypto_ticker_columns	 =array_map('esc_attr',get_post_meta($p->ID,"crypto_ticker_columns",true) );
			$crypto_text_color		 = esc_attr(get_post_meta($p->ID,"crypto_text_color",true));
			$crypto_background_color = esc_attr(get_post_meta($p->ID,"crypto_background_color",true));
			$crypto_bunch_select     = esc_attr(get_post_meta($p->ID,"crypto_bunch_select",true));
			$crypto_custom_css       = esc_attr(get_post_meta($p->ID,"crypto_custom_css",true));
			
			$output = '';
			
			if($crypto_ticker == 'ticker') {
				if(($crypto_ticker_position == 'header') || ($crypto_ticker_position == 'footer')) {
					
					$mcwp_coinsyms = $this->mcwp_coinsyms();
                    $mcwp_cid = $mcwp_coinsyms['cid'];
					$selectedcoins = array();
					

					if($crypto_bunch_select > 0){
						for($k=0;$k<sizeof($mcwp_cid);$k++){
							if($k < $crypto_bunch_select) {
								array_push($selectedcoins,$mcwp_cid[$k]);
							}
						}
					} else {
						for($k=0;$k<sizeof($mcwp_cid);$k++){
							if(is_array($crypto_ticker_coin) && in_array($mcwp_cid[$k],$crypto_ticker_coin)){
								array_push($selectedcoins,$mcwp_cid[$k]);
							}
						}
					}
			

					if(!empty($selectedcoins)){

						$query = 'SELECT * FROM `' . $this->tablename . '` WHERE `cid` IN ("' . implode('","', $selectedcoins) . '") ORDER BY `rank` ASC';
						$mcwp_data = $this->mcwp_all_collection($query);

						if($crypto_custom_css != ''){
							$output .= '<style type="text/css">'."\n".$crypto_custom_css."\n".'</style>';
						}
						
						$output .= '<div class="cryptoboxes" id="mcwp-'.$p->ID.'">';
						$output .= '<div class="mcwp-ticker mcwp-'. $crypto_ticker_position .'" data-speed="'.$crypto_speed.'">';
						if ($crypto_text_color !== '') {
							$output .= '<style type="text/css">
									#mcwp-'.$p->ID.'.cryptoboxes .cc-coin b {
										color: '.$crypto_text_color.';
									}
								</style>';

							$crypto_background_color = ($crypto_background_color == '') ? '#fff' : $crypto_background_color;
						}
						$output .= '<div class="cc-ticker cc-white-color"';
						if ($crypto_background_color !== '') {
							$output .= ' style="background-color:'.$crypto_background_color.';"';
						}
						$output .= '><ul class="cc-stats">';
						foreach($mcwp_data as $j=>$coins) {
							$imagename 	= esc_attr($this->image_id[$coins->cid]);
							$coinscid 	= esc_attr($coins->cid);
							$coinsname 	= esc_attr($coins->name);
							$coinssymbol= esc_attr($coins->symbol);
							$price 		= esc_attr($this->mcwp_currency_convert($coins->price_usd));
							
							$output .= '<li class="cc-coin"><div><img src="//s2.coinmarketcap.com/static/img/coins/32x32/'.$imagename.'.png" alt="'.$coinscid.'">';
							$output .= '<b>'.$coinsname . ' <div>('.$coinssymbol.')</div> <span>'.$price.'</span>';
							if(is_array($crypto_ticker_columns) && in_array('changes',$crypto_ticker_columns)) {
								$output .= $this->mcwp_24h_percentage(esc_attr($coins->percent_change_24h),'span');
							}
							$output .= '</b></div></li>';
						}
						$output .= '</ul></div></div></div>';
						echo $output;
					}
					break;
				}
			}
			echo $output;
		}
	}
	
	public function mcwp_24h_percentage($percent,$tag){
		$up = ($percent > 0) ? 'mcwpup' : 'mcwpdown';
		$output = '';
		$output .= '<'.$tag.' class="'.$up.'"> '.abs($percent).'%</'.$tag.'>';

		return $output;
	}
	
	public function mcwp_currency_convert($price){
		
		if(($price >= 1) || ($price == 0)){
			$price = number_format((float)$price,'2');
		} else {
			$count = strspn(number_format($price,'10'), "0", strpos($price, ".")+1);
			$count = ($count > 5) ? 8 : 6;
			$price = number_format($price,$count);
		}
		
		$output = '$ '.$price;
		return substr($output, -1) == '.' ? substr($output,0,-1) : $output;
	}
	
	public function crypto_four_not_four(){
		return '<div class="crypto-404">No Coins Selected</div>';
	}
}

}
function MCWP_Crypto() {
    return MCWP_Crypto::get_instance();
}

$GLOBALS['MCWP_Crypto'] = MCWP_Crypto();