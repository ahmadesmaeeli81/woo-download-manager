<?php

// Enqueue scripts for WooCommerce admin page
add_action('admin_enqueue_scripts', function ($hook) {
    if ($hook === 'edit.php' && isset($_GET['post_type']) && $_GET['post_type'] === 'product') {
        wp_enqueue_script('download-links-script', plugin_dir_url(__FILE__) . '../assets/js/admin-script.js', array('jquery'), '1.0', true);
    }
});
