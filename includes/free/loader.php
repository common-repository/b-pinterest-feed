<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * The Free Loader Class
 *
 * @package Pinterest-free
 *
 * @since 1.0
 */
if ( ! class_exists( 'KP_PFREE_Loader' ) ) {
	class KP_PFREE_Loader {

		function __construct() {
			require_once KP_PFREE_PATH . 'admin/views/scripts.php';

			// public folder
			require_once KP_PFREE_PATH . 'public/views/shortcodes.php';
			require_once KP_PFREE_PATH . 'public/views/scripts.php';
		}

	}
}

new KP_PFREE_Loader();