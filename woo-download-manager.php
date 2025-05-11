<?php
/*
Plugin Name: WooDownload Manager
Plugin URI: https://github.com/ahmadesmaeeli81/woo-download-manager
Description: A powerful download management tool for WooCommerce that displays and manages downloadable product links in admin panel with copy button and filtering options.
Version: 1.1
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
    // Define plugin constants
    define('WDM_PLUGIN_DIR', plugin_dir_path(__FILE__));
    define('WDM_PLUGIN_URL', plugin_dir_url(__FILE__));
    
    // Load plugin text domain
    add_action('plugins_loaded', function() {
        load_plugin_textdomain('woo-download-manager', false, dirname(plugin_basename(__FILE__)) . '/languages');
    });
    
    // Include necessary files with error checking
    $required_files = array(
        'includes/functions.php',
        'includes/admin-styles.php',
        'includes/admin-scripts.php'
    );
    
    foreach ($required_files as $file) {
        $file_path = WDM_PLUGIN_DIR . $file;
        if (file_exists($file_path)) {
            require_once $file_path;
        } else {
            add_action('admin_notices', function() use ($file) {
                ?>
                <div class="error">
                    <p><?php printf(__('WooDownload Manager: Required file %s is missing.', 'woo-download-manager'), $file); ?></p>
                </div>
                <?php
            });
        }
    }
    
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
