<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access

/**
 * Admin Scripts and styles
 */
if ( ! class_exists( 'KP_PFREE_Admin_Scripts' ) ) {
	class KP_PFREE_Admin_Scripts {

		/**
		 * @var null
		 * @since 1.0
		 */
		protected static $_instance = null;

		/**
		 * @return KP_PFREE_Admin_Scripts
		 * @since 1.0
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		/**
		 * Initialize the class
		 */
		public function __construct() {

			add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
		}

		/**
		 * Enqueue admin scripts
		 */
		public function admin_scripts() {
			wp_enqueue_style( 'pinterest-free-admin', KP_PFREE_URL . 'admin/assets/css/main.css', array(), KP_PFREE_VERSION );
		}

	}
	new KP_PFREE_Admin_Scripts();
}

