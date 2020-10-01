<?php

/**
 * Define constants
 *
 * @since 1.0
 */
$lezada_theme = wp_get_theme();

if ( ! empty( $lezada_theme['Template'] ) ) {
	$lezada_theme = wp_get_theme( $lezada_theme['Template'] );
}

if ( ! defined( 'DS' ) ) {
	define( 'DS', DIRECTORY_SEPARATOR );
}

define( 'LEZADA_THEME_NAME', $lezada_theme['Name'] );
define( 'LEZADA_THEME_SLUG', $lezada_theme['Template'] );
define( 'LEZADA_THEME_VERSION', $lezada_theme['Version'] );
define( 'LEZADA_THEME_DIR', get_template_directory() );
define( 'LEZADA_THEME_URI', get_template_directory_uri() );
define( 'LEZADA_CHILD_THEME_URI', get_stylesheet_directory_uri() );
define( 'LEZADA_CHILD_THEME_DIR', get_stylesheet_directory() );

define( 'LEZADA_LIBS_URI', LEZADA_THEME_URI . '/assets/libs' );

define( 'LEZADA_IMAGES', LEZADA_THEME_URI . '/assets/images' );
define( 'LEZADA_ADMIN_IMAGES', LEZADA_THEME_URI . '/assets/admin/images' );

define( 'LEZADA_INC_DIR', LEZADA_THEME_DIR . DS . 'includes' );
define( 'LEZADA_INC_URI', LEZADA_THEME_URI . '/includes' );
define( 'LEZADA_FRAMEWORK_DIR', LEZADA_THEME_DIR . DS . 'framework' );
define( 'LEZADA_FRAMEWORK_URI', LEZADA_THEME_URI . '/framework' );

define( 'LEZADA_OPTIONS_DIR', LEZADA_INC_DIR . DS . 'theme-options' );

/**
 * Load Insight Framework.
 *
 * @since 1.0
 */
require_once( LEZADA_FRAMEWORK_DIR . DS . 'class-coming-soon.php' );
require_once( LEZADA_FRAMEWORK_DIR . DS . 'class-compatible.php' );
require_once( LEZADA_FRAMEWORK_DIR . DS . 'class-enqueue.php' );
require_once( LEZADA_FRAMEWORK_DIR . DS . 'class-extras.php' );
require_once( LEZADA_FRAMEWORK_DIR . DS . 'class-helper.php' );
require_once( LEZADA_FRAMEWORK_DIR . DS . 'class-import.php' );
require_once( LEZADA_FRAMEWORK_DIR . DS . 'class-init.php' );
require_once( LEZADA_FRAMEWORK_DIR . DS . 'class-instagram.php' );
require_once( LEZADA_FRAMEWORK_DIR . DS . 'class-metabox.php' );
require_once( LEZADA_FRAMEWORK_DIR . DS . 'class-tgm-plugin-activation.php' );
require_once( LEZADA_FRAMEWORK_DIR . DS . 'class-plugins.php' );
require_once( LEZADA_FRAMEWORK_DIR . DS . 'class-sercurity.php' );
require_once( LEZADA_FRAMEWORK_DIR . DS . 'class-templates.php' );
require_once( LEZADA_FRAMEWORK_DIR . DS . 'class-walker-nav-menu.php' );
require_once( LEZADA_FRAMEWORK_DIR . DS . 'class-walker-nav-menu-edit.php' );

if ( class_exists( 'Redux' ) ) {
	require_once( LEZADA_FRAMEWORK_DIR . DS . 'class-redux.php' );
}

if ( class_exists( 'WooCommerce' )  ) {
	require_once( LEZADA_FRAMEWORK_DIR . DS . 'class-woo.php' );
}

/**
 * Get option from Theme Options
 */
if ( ! function_exists( 'lezada_get_option' ) ) {
	function lezada_get_option( $option ) {
		return Lezada_Helper::get_option( $option );
	}
}


// only run if Polylang is loaded
if ( function_exists('pll_languages_list') ) {
	add_action('wpml_loaded', '__return_true', 10, 0);
	do_action('wpml_loaded');
}

add_action('init', function() {
    pll_register_string('breadcrumb-home', 'Home');

    pll_register_string('lk-login', 'Login');
    pll_register_string('lk-gthyb', 'Great to have you back!');
    pll_register_string('lk-username-or-email', 'Username or email address');
    pll_register_string('lk-password', 'Password');
    pll_register_string('lk-remember', 'Remember me');
    pll_register_string('lk-lost-password', 'Lost your password?');
    pll_register_string('lk-register', 'Register');
    pll_register_string('lk-no-account', 'If you don’t have an account, register now!');
    pll_register_string('lk-username', 'Username');
    pll_register_string('lk-email', 'Email address');

    pll_register_string('product-quantity', 'Quantity');
    pll_register_string('product-category', 'Category:');
    pll_register_string('product-categories', 'Categories:');
    pll_register_string('product-share', 'Share on:');

    pll_register_string('cart-product', 'Product');
    pll_register_string('cart-price', 'Price');
    pll_register_string('cart-quantity', 'Quantity');
    pll_register_string('cart-total', 'Total');
    pll_register_string('cart-coupon', 'Coupon:');
    pll_register_string('cart-enter-coupon', 'Enter your coupon code');
    pll_register_string('cart-apply-coupon', 'Apply Coupon');
    pll_register_string('cart-update', 'Update Cart');

    pll_register_string('search-categories', 'All Categories');
    pll_register_string('search-type', '# Type at least %s %s to search');
    pll_register_string('search-esc', '# Hit enter to search or ESC to close');
    pll_register_string('search-products', 'Search Products...');
    pll_register_string('search-posts', 'Search Posts...');
    pll_register_string('search-character', 'character');
    pll_register_string('search-characters', 'characters');
    pll_register_string('search-empty-search', 'Sorry, but nothing matched your search terms. Please try again with different keywords');

    pll_register_string('widget-checkout', 'Checkout');
    pll_register_string('widget-view-cart', 'View Cart');
    pll_register_string('widget-subtotal', 'Subtotal');
    pll_register_string('widget-remove', 'Remove this item');
    pll_register_string('widget-undo', 'Undo');
    pll_register_string('widget-removed', 'Item removed.');
    pll_register_string('widget-cart', 'Cart');
    pll_register_string('header-order-online', 'Order Online Call Us');
});

