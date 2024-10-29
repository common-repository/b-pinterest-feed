<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * The KP_PFREE_Pinterest class.
 */
if ( ! class_exists( 'KP_PFREE_Pinterest' ) ) {
	class KP_PFREE_Pinterest {

		/**
		 * The class instance.
		 *
		 * @var $_instance
		 * @since 1.0
		 */
		private static $_instance;

		/**
		 * The method to get instance.
		 *
		 * @return $_instance
		 * @since 1.0
		 */
		public static function getInstance() {
			if ( ! self::$_instance ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		/**
		 * The class constructor.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_filter( 'init', array( $this, 'register_post_type' ) );
		}

		/**
		 * Register post type
		 *
		 * @since 1.0
		 */
		public function register_post_type() {

			if ( post_type_exists( 'kpp_pinterest' ) ) {
				return;
			}

			$labels = apply_filters(
				'kp_pinterest_post_type_labels',
				array(
					'name'                  => esc_html__( 'Pinterests', 'pinterest-free' ),
					'singular_name'         => esc_html__( 'Pinterest', 'pinterest-free' ),				
					'add_new'               => esc_html__( 'Add Pinterest', 'pinterest-free' ),
					'add_new_item'          => esc_html__( 'Add Pinterest', 'pinterest-free' ),
					'edit'                  => esc_html__( 'Edit', 'pinterest-free' ),
					'edit_item'             => esc_html__( 'Edit Pinterest', 'pinterest-free' ),
					'new_item'              => esc_html__( 'New Pinterest', 'pinterest-free' ),
					'view_item' 			=> esc_html__( 'View Pinterest Feed', 'pinterest-free' ),
					'search_items'          => esc_html__( 'Search Pinterests', 'pinterest-free' ),
					'not_found' 			=> esc_html__( 'Sorry, we couldn\'t find the Pinterest Feed file you are looking for.', 'pinterest-free' )
				)
			);

			$args = apply_filters(
				'kp_pinterest_post_type_args',
				array(
					'label'              => esc_html__( 'Pinterest', 'pinterest-free' ),
					'description'        => esc_html__( 'Pinterest custom post type.', 'pinterest-free' ),
					'taxonomies'         => array(),
					'public'             => false,
					'has_archive'        => false,
					'publicly_queryable' => true,
					'query_var'          => false,
					'show_ui'            => current_user_can( 'manage_options' ) ? true : false,
					'show_in_menu'       => true,
					'menu_icon'          => 'dashicons-share',
					'show_in_nav_menus'  => true,
					'show_in_admin_bar'  => true,
					'hierarchical'       => false,
					'menu_position'      => 20,
					'supports'           => array('title'),
					'capability_type'    => 'post',
					'labels'             => $labels,
					'rewrite' 			 => array( 'slug' => 'pinterest-free' )
				)
			);

			register_post_type( 'kpp_pinterest', $args );
		}

	}
}