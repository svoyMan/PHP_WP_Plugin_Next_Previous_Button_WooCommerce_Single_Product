<?php
/*
 * Plugin Name: Next Previous Button Woocommerce Single Product
 * Plugin URI: https://github.com/svoyMan/PHP_WP_Plugin_Next_Previous_Button_WooCommerce_Single_Product.git
 * Description: Shows next and previous woocommerce product in single product view.
 * Version: 1.0
 * Requires at least: 5.0
 * Requires PHP: 5.6
 * Author: My Master
 * Author URI: http://my-master.net.ua/
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: npbwsp_domain
 */

try {
	require plugin_dir_path( __FILE__ ) . 'includes/class-next-previous-button-woocommerce-single-product-settings.php';
	require plugin_dir_path( __FILE__ ) . 'includes/class-next-previous-button-woocommerce-single-product.php';

	$settings = Next_Previous_Button_Woocommerce_Single_Product_Settings::getInstance();
	$settings->set_plugin_url( __FILE__ );
	$settings->set_plugin_path( __FILE__ );
	$settings->set_options_menu_page(array(
		'page_title' => __( 'Settings Next Previous Button Woocommerce Single Product' , 'npbwsp_domain' ),
		'menu_title' => __( 'Next Previous Button', 'npbwsp_domain' ),
		'capability' => 'manage_options',
		'menu_slug' => 'npbwsp',
		'position' => 99,
	));
	$settings->run();

	$plugin = new Next_Previous_Button_Woocommerce_Single_Product( __FILE__ );
	$plugin->run();
} catch (Exception $e) {
	throw $e;
}
