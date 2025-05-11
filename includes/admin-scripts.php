<?php

// Enqueue scripts for WooCommerce admin page
add_action('admin_enqueue_scripts', function ($hook) {
    if ($hook === 'edit.php' && isset($_GET['post_type']) && $_GET['post_type'] === 'product') {
        wp_enqueue_script('download-links-script', WDM_PLUGIN_URL . 'assets/js/admin-script.js', array('jquery'), '1.0', true);
    }
});

add_action('admin_enqueue_scripts', function () {
    wp_enqueue_script('wdm-admin-scripts', WDM_PLUGIN_URL . 'assets/js/admin.js', array('jquery'), '1.0.0', true);
    
    // Add localization
    wp_localize_script('wdm-admin-scripts', 'wdmData', array(
        'copySuccess' => __('Link copied to clipboard!', 'woo-download-manager'),
        'copyError' => __('Failed to copy link', 'woo-download-manager')
    ));
});
