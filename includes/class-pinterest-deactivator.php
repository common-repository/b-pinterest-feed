<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Pinterest
 * @subpackage Pinterest/includes
 */
if ( ! class_exists( 'Pinterest_Deactivator' ) ) {
	class Pinterest_Deactivator {

		/**
		 * Deactivation hook function.
		 */
		public static function deactivate() {

		}

	}
}