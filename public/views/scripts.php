<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }  // if direct access

/**
 * Scripts and styles
 */
if ( ! class_exists( 'KP_PFREE_Front_Scripts' ) ) {
	class KP_PFREE_Front_Scripts {

		/**
		 * @var null
		 * @since 1.0
		 */
		protected static $_instance = null;

		/**
		 * @return KP_PFREE_Front_Scripts
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

			add_action( 'wp_enqueue_scripts', array( $this, 'front_scripts' ) );
		}

		/**
		 * Plugin Scripts and Styles
		 */
		function front_scripts() {

			// $layout = $pinterest_data['layout'];

			// CSS Files.
			wp_enqueue_style( 'pfree-style', KP_PFREE_URL . 'public/assets/css/style.css', array(), KP_PFREE_VERSION );
			
			include KP_PFREE_PATH . '/includes/custom-css.php';

			// wp_add_inline_style( 'pfree-style', $pinterest_custom_css );

			// JS Files.
			wp_enqueue_script( 'pfree-pgallery-min', KP_PFREE_URL . 'public/assets/js/jquery.pgallery.min.js', array( 'jquery' ), KP_PFREE_VERSION, true );

			if($kp_allow_popup){
				wp_enqueue_script( 'jquery-magnific-popup.min', KP_PFREE_URL . 'public/assets/js/jquery.magnific-popup.min.js', array( 'jquery'), KP_PFREE_VERSION, true );
			}

			wp_enqueue_script( 'pfree-pgallery-custom', KP_PFREE_URL . 'public/assets/js/pgallery.custom.js', array( 'jquery','pfree-pgallery-min' ), KP_PFREE_VERSION, true );

		}

	}
}
new KP_PFREE_Front_Scripts();