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

	require plugin_dir_path( __FILE__ ) . 'includes/class-next-previous-button-woocommerce-single-product.php';

	function run_next_previous_button_woocommerce_single_product() {
		$plugin = new Next_Previous_Button_Woocommerce_Single_Product( __FILE__ );
		$plugin->run();
	}

	run_next_previous_button_woocommerce_single_product();
} catch (Exception $e) {
	throw $e;
}
