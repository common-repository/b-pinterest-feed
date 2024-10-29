<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access

//
// Set a unique slug-like ID.
//
$prefix = '_kp_pinterest_options';

//
// Review text.
//
$url  = 'https://wordpress.org/support/plugin/b-pinterest-feed/reviews/?filter=5#new-post';
$text = sprintf(
	__( 'If you like <strong>B Pinterest Feed</strong> Plugin please leave us a <a href="%s" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> rating. Your Review is very important to us as it helps us to grow more. ', 'pinterest-free' ),
	$url
);

//
// Create a settings page.
//
CSF::createOptions(
	$prefix, array(
		'menu_title'       => esc_html__( 'Pinterest Settings', 'pinterest-free' ),
		'menu_parent'      => 'edit.php?post_type=kpp_pinterest',
		'menu_type'        => 'submenu', // menu, submenu, options, theme, etc.
		'menu_slug'        => 'kpp_settings',
		'theme'            => 'light',
		'class'            => 'kpp-main-class',
		'show_all_options' => false,
		'show_search'      => false,
		'show_footer'      => false,
		'footer_credit'    => $text,
		'framework_title'  => esc_html__( 'Pinterest Settings', 'pinterest-free' ),
	)
);

//
// Custom CSS section.
//
CSF::createSection(
	$prefix, array(
		'name'   => 'pinterest_custom_css_section',
		'title'  => esc_html__( 'Custom CSS', 'pinterest-free' ),
		'icon'   => 'fa fa-css3',

		'fields' => array(
			array(
		        'id'       => 'kp-pinterest-allow-popup',
		        'type'     => 'switcher',
		        'title'    => esc_html__( 'Allow Popup', 'pinterest-free' ),
		        'subtitle' => esc_html__( 'On/Off popup.', 'pinterest-free' ),
		        'default'  => true,
		    )
		),
	)
);
