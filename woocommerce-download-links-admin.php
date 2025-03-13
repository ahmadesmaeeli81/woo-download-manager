<?php
/*
Plugin Name: WooCommerce Download Links Admin
Plugin URI: https://github.com/ahmadesmaeeli81/woocommerce-download-links-admin
Description: Displays downloadable product links in WooCommerce admin, includes copy button and filter for products without download links.
Version: 1.6
Author: Ahmad Esmaeeli
Author URI: https://ahmadesmaeeli.ir
License: GPL v2 or later
Text Domain: woo-download-links-admin
*/

if (!defined('ABSPATH')) {
    exit;
}

// Check if WooCommerce is active
function wdla_check_woocommerce_active() {
    if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
        add_action('admin_notices', 'wdla_woocommerce_missing_notice');
        return false;
    }
    return true;
}

// Admin notice for missing WooCommerce
function wdla_woocommerce_missing_notice() {
    ?>
    <div class="error">
        <p><?php _e('WooCommerce Download Links Admin requires WooCommerce to be installed and active.', 'woo-download-links-admin'); ?></p>
    </div>
    <?php
}

// Only load plugin if WooCommerce is active
if (wdla_check_woocommerce_active()) {
    // Include necessary files
    require_once plugin_dir_path(__FILE__) . 'includes/functions.php';
    require_once plugin_dir_path(__FILE__) . 'includes/admin-styles.php';
    require_once plugin_dir_path(__FILE__) . 'includes/admin-scripts.php';
    
    // Plugin activation hook
    register_activation_hook(__FILE__, 'wdla_plugin_activation');
    
    // Plugin deactivation hook
    register_deactivation_hook(__FILE__, 'wdla_plugin_deactivation');
}

// Activation function
function wdla_plugin_activation() {
    // Any setup needed on activation
}

// Deactivation function
function wdla_plugin_deactivation() {
    // Any cleanup needed on deactivation
}
