<?php
/*
Plugin Name: WooDownload Manager
Plugin URI: https://github.com/ahmadesmaeeli81/woocommerce-download-links-admin
Description: A powerful download management tool for WooCommerce that displays and manages downloadable product links in admin panel with copy button and filtering options.
Version: 1.0.7
Author: Ahmad Esmaeeli
Author URI: https://ahmadesmaeeli.ir
License: GPL v2 or later
Text Domain: woo-download-manager
*/

if (!defined('ABSPATH')) {
    exit;
}

// Check if WooCommerce is active
function wdm_check_woocommerce_active() {
    if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
        add_action('admin_notices', 'wdm_woocommerce_missing_notice');
        return false;
    }
    return true;
}

// Admin notice for missing WooCommerce
function wdm_woocommerce_missing_notice() {
    ?>
    <div class="error">
        <p><?php _e('WooDownload Manager requires WooCommerce to be installed and active.', 'woo-download-manager'); ?></p>
    </div>
    <?php
}

// Only load plugin if WooCommerce is active
if (wdm_check_woocommerce_active()) {
    // Include necessary files
    require_once plugin_dir_path(__FILE__) . 'includes/functions.php';
    require_once plugin_dir_path(__FILE__) . 'includes/admin-styles.php';
    require_once plugin_dir_path(__FILE__) . 'includes/admin-scripts.php';
    
    // Plugin activation hook
    register_activation_hook(__FILE__, 'wdm_plugin_activation');
    
    // Plugin deactivation hook
    register_deactivation_hook(__FILE__, 'wdm_plugin_deactivation');
}

// Activation function
function wdm_plugin_activation() {
    // Any setup needed on activation
}

// Deactivation function
function wdm_plugin_deactivation() {
    // Any cleanup needed on deactivation
}
