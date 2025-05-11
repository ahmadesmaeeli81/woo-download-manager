<?php

// Enqueue styles for WooCommerce admin page
add_action('admin_enqueue_scripts', function ($hook) {
    if ($hook === 'edit.php' && isset($_GET['post_type']) && $_GET['post_type'] === 'product') {
        wp_enqueue_style('download-links-style', plugin_dir_url(__FILE__) . '../assets/css/admin-style.css');
    }
});

add_action('admin_enqueue_scripts', function () {
    wp_enqueue_style('wdla-admin-styles', plugins_url('/assets/css/admin.css', dirname(__FILE__)));
});
