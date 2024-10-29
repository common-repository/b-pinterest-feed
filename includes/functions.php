<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access

/**
 * Functions
 */
if ( !class_exists( 'KP_Pinterest_Free_Functions' ) ) {
	class KP_Pinterest_Free_Functions {

		/**
		 * Initialize the class
		 */
		public function __construct() {
			add_filter( 'post_updated_messages', array( $this, 'kp_pfree_change_default_post_update_message' ) );
			add_filter( 'admin_footer_text', array( $this, 'admin_footer' ), 1, 2 );
			add_action( 'admin_menu', array( $this, 'admin_menu' ), 100 );
		}

		/**
		 * Post update messages
		 */
		function kp_pfree_change_default_post_update_message( $message ) {
			$screen = get_current_screen();
			if ( 'kpp_pinterest' == $screen->post_type ) {
				$message['post'][1]  = $title = esc_html__( 'Pinterest updated.', 'pinterest-free' );
				$message['post'][4]  = $title = esc_html__( 'Pinterest updated.', 'pinterest-free' );
				$message['post'][6]  = $title = esc_html__( 'Pinterest published.', 'pinterest-free' );
				$message['post'][8]  = $title = esc_html__( 'Pinterest submitted.', 'pinterest-free' );
				$message['post'][10] = $title = esc_html__( 'Pinterest draft updated.', 'pinterest-free' );
			}

			return $message;
		}

		/**
		 * Review Text
		 *
		 * @param $text
		 *
		 * @return string
		 */
		public function admin_footer( $text ) {
			$screen = get_current_screen();
			if ( 'kpp_pinterest' == get_post_type() || $screen->id == 'kpp_pinterest_page_pfree_help' ) {
				$url  = 'https://wordpress.org/support/plugin/b-pinterest-feed/reviews/?filter=5#new-post';
				$text = sprintf(
					__( 'If you like <strong>B Pinterest Feed</strong> Plugin please leave us a <a href="%s" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> rating. Your Review is very important to us as it helps us to grow more. ', 'pinterest-free' ),
					$url
				);
			}

			return $text;
		}

		/**
		 * Admin Menu
		 */
		public function admin_menu() {
/* 			add_submenu_page(
				'edit.php?post_type=kpp_pinterest', __( 'Pinterest Pro', 'pinterest-free' ), __( 'Premium', 'pinterest-free' ), 'manage_options', 'pinterest_premium', array(
					$this,
					'premium_page_callback',
				)
			); */
			add_submenu_page(
				'edit.php?post_type=kpp_pinterest', __( 'Pinterest Help', 'pinterest-free' ), __( 'Help', 'pinterest-free' ), 'manage_options', 'pfree_help', array(
					$this,
					'help_page_callback',
				)
			);
		}

		/**
		 * Help Page Callback
		 */
		public function help_page_callback() {
			?>
			<div class="wrap about-wrap kp-pfree-help">
				<h1><?php echo esc_html__( 'Welcome to B Pinterest!', 'pinterest-free' ); ?></h1>
				<p class="about-text">
					<?php
						echo esc_html__(
							'Thank you for installing Pinterest! You\'re now running the most popular Pinterest plugin.
			This video playlist will help you get started with the plugin.', 'pinterest-free'
						);
					?>
				</p>
				<div class="wp-badge"></div>

				<hr>

				<div class="headline-feature feature-video">
					<iframe width="560" height="315" src="https://www.youtube.com/embed/XyPDxhMZ8CE	" frameborder="0" allowfullscreen></iframe>
				</div>			

				<hr>

				<div class="feature-section help-section three-col">
					<div class="col">
						<div class="kp-pfree-feature text-center">
							<i class="kp-pfree-font-icon fa fa-life-ring"></i>
							<h3><?php echo esc_html__( 'Need any Assistance?', 'pinterest-free' ); ?></h3>
							<p><?php echo esc_html__( 'Our Expert Support Team is always ready to help you out promptly.', 'pinterest-free' ); ?></p>
							<a href="http://bplugins.com" target="_blank" class="button
							button-primary"><?php echo esc_html__( 'Contact Support', 'pinterest-free' ); ?></a>
						</div>
					</div>
					<div class="col">
						<div class="kp-pfree-feature text-center">
							<i class="kp-pfree-font-icon fa fa-file-text"></i>
							<h3><?php echo esc_html__( 'Looking for Documentation?', 'pinterest-free' ); ?></h3>
							<p><?php echo esc_html__( 'We have detailed documentation on every aspects of Pinterest.', 'pinterest-free' ); ?></p>
							<a href="https://pinterest-feed.bplugins.com" target="_blank" class="button button-primary"><?php echo esc_html__( 'Documentation', 'pinterest-free' ); ?></a>
						</div>
					</div>
					<div class="col">
						<div class="kp-pfree-feature text-center">
							<i class="kp-pfree-font-icon fa fa-thumbs-up"></i>
							<h3><?php echo esc_html__( 'Like This Plugin?', 'pinterest-free' ); ?></h3>
							<p><?php echo esc_html__( 'If you like This Plugin, please leave us a 5 star rating.', 'pinterest-free' ); ?></p>
							<a href="https://wordpress.org/support/plugin/b-pinterest-feed/reviews/?filter=5#new-post" target="_blank" class="button button-primary">
								<?php echo esc_html__( 'Rate the Plugin', 'pinterest-free' ); ?>
							</a>
						</div>
					</div>
				</div>

			</div>
			<?php
		}


	}
}

new KP_Pinterest_Free_Functions();

/**
 *
 * Multi Language Support
 *
 * @since 1.0
 */

// Polylang plugin support for multi language support.
if ( class_exists( 'Polylang' ) ) {

	add_filter( 'pll_get_post_types', 'kp_pfree_pinterest_polylang', 10, 2 );

	function kp_pfree_pinterest_polylang( $post_types, $is_settings ) {
		if ( $is_settings ) {			
			unset( $post_types['kpp_pinterest'] );
		} else {
			$post_types['kpp_pinterest']     = 'kpp_pinterest';
		}
		return $post_types;
	}
}
