<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Pinterest
 * @subpackage Pinterest/includes
 */
if ( ! class_exists( 'Pinterest_Activator' ) ) {
	class Pinterest_Activator {
		/**
		 * Activation hook function.
		 */
		public static function activate() {
			//deactivate_plugins( 'pinterest-pro/pinterest-pro.php' );
		}

	}
}