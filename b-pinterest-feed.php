<?php
/**
 * Plugin Name:     B Pinterest Feed
 * Description:     You can easily display Pinterest Feed in wordress post, page, widget area and theme template file. 
 * Version:         1.1.1
 * Author: bPlugins
 * Author URI: http://bplugins.com
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:     pinterest-free
 * Domain Path:     /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

register_activation_hook(__FILE__, function () {
	if ( is_plugin_active('my-social-feeds/my-social-feeds.php')) {
		deactivate_plugins('my-social-feeds/my-social-feeds.php');
	}  
});

if ( ! function_exists( 'activate_pinterest' ) ) {
	/**
	 * The code that runs during plugin activation.
	 * This action is documented in includes/class-pinterest-activator.php
	 */
	function activate_pinterest() {
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-pinterest-activator.php';
		Pinterest_Activator::activate();
	}
}

if ( ! function_exists( 'deactivate_pinterest' ) ) {
	/**
	 * The code that runs during plugin deactivation.
	 * This action is documented in includes/class-pinterest-deactivator.php
	 */
	function deactivate_pinterest() {
		require_once plugin_dir_path( __FILE__ )
		 . 'includes/class-pinterest-deactivator.php';
		Pinterest_Deactivator::deactivate();
	}
}

register_activation_hook( __FILE__, 'activate_pinterest' );
register_deactivation_hook( __FILE__, 'deactivate_pinterest' );

require_once plugin_dir_path( __FILE__ ) . 'admin/views/framework/classes/setup.class.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/views/pinterest-settings.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/views/pinterest-metaboxs.php';

if ( ! class_exists( 'KP_Pinterest_FREE' ) ) {
	 
	class KP_Pinterest_FREE {
		 
		public $version = '1.1.1';
		public $pinterest;
		public $router;
		protected static $_instance = null;
		 
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}
		 
		function __construct() {
			
			$this->define_constants();
			spl_autoload_register( array( $this, 'autoload' ) );
			$this->includes();
			$this->instantiate();
			$this->init_filters();
			$this->init_actions();
		}
		 
		function init_filters() {
			add_filter( 'plugin_action_links', array( $this, 'add_pinterest_plugin_action_links' ), 10, 2 );
			add_filter( 'manage_kpp_pinterest_posts_columns', array( $this, 'add_shortcode_column' ),10 );
			add_filter( 'plugin_row_meta', array( $this, 'after_pinterest_free_row_meta' ), 10, 4 );
		}
		 
		function init_actions() {
			add_action( 'plugins_loaded', array( $this, 'load_text_domain' ) );
			add_action( 'manage_kpp_pinterest_posts_custom_column', array( $this, 'add_pinterest_extra_column' ), 10, 2 );
			add_action( 'activated_plugin', array( $this, 'redirect_help_page' ) );
		}

		 
		public function define_constants() {
			$this->define( 'KP_PFREE_VERSION', $this->version );
			$this->define( 'KP_PFREE_PATH', plugin_dir_path( __FILE__ ) );
			$this->define( 'KP_PFREE_URL', plugin_dir_url( __FILE__ ) );
			$this->define( 'KP_PFREE_BASENAME', plugin_basename( __FILE__ ) );
		}

		 
		public function define( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}
		 
		public function load_text_domain() {
			load_plugin_textdomain( 'pinterest-free', false, KP_PFREE_PATH . '/languages' );
		}

		 
		public function add_pinterest_plugin_action_links( $links, $file ) {
			if ( KP_PFREE_BASENAME === $file ) {
				$links['go_pro'] = sprintf( '<a href="%s" style="%s">%s</a>', '#', 'color:#1dab87;font-weight:bold', __( 'Go Premium!', 'pinterest-free' ) );
			}

			return $links;
		}
		 
		function after_pinterest_free_row_meta( $plugin_meta, $file ) {
			if ( KP_PFREE_BASENAME === $file ) {
				$plugin_meta[] = '<a href="#" target="_blank">' . __( 'Live Demo', 'pinterest-free' ) . '</a>';
			}
			return $plugin_meta;
		}
		 
		function autoload( $class ) {
			$name = explode( '_', $class );
			if ( isset( $name[2] ) ) {
				$class_name = strtolower( $name[2] );
				$filename   = KP_PFREE_PATH . '/class/' . $class_name . '.php';

				if ( file_exists( $filename ) ) {
					require_once $filename;
				}
			}
		}
		 
		function instantiate() {
			$this->pinterest = KP_PFREE_Pinterest::getInstance();

			do_action( 'kp_pfree_pinterest', $this );
		}
		 
		function page() {
			$this->router = KP_PFREE_Router::instance();
			return $this->router;
		}
		 
		function includes() {
			$this->page()->kp_pfree_function();
			$this->router->includes();
		}
		 
		function add_shortcode_column($defaults) {
			$defaults['shortcode'] = __( 'Shortcode', 'pinterest-free' );
			return $defaults;
		}
		 
		function add_pinterest_extra_column( $column, $post_id ) {

			switch ( $column ) {

				case 'shortcode':
					$column_field = '<input type="text" onClick="this.select();" readonly="readonly" value="[pinterest ' . 'id=&quot;' . $post_id . '&quot;' . ']"/>';
					echo $column_field;
					break;
				default:
					break;

			} // end switch
		}
		
		function redirect_help_page( $plugin ) {
			if ( KP_PFREE_BASENAME === $plugin ) {
				exit( wp_redirect( admin_url( 'edit.php?post_type=kpp_pinterest&page=pfree_help' ) ) );
			}
		}

	}

	new KP_Pinterest_FREE();
}
