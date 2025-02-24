<?php
/*
Plugin Name: WooCommerce Download Links Admin
Plugin URI: https://github.com/ahmadesmaeeli81/woocommerce-download-links-admin
Description: Displays downloadable product links in WooCommerce admin, includes copy button and filter for products without download links.
Version: 1.5
Author: Ahmad Esmaeeli
Author URI: https://yourwebsite.com
License: GPL v2 or later
Text Domain: woo-download-links-admin
*/

if (!defined('ABSPATH')) {
    exit;
}

// Include necessary files
require_once plugin_dir_path(__FILE__) . 'includes/functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/admin-styles.php';
require_once plugin_dir_path(__FILE__) . 'includes/admin-scripts.php';
