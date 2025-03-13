<?php

// Add new column in WooCommerce admin product list
add_filter('manage_edit-product_columns', function ($columns) {
    $columns['download_link'] = 'Download Links';
    return $columns;
});

// Make the download links column sortable
add_filter('manage_edit-product_sortable_columns', function ($columns) {
    $columns['download_link'] = 'download_link';
    return $columns;
});

// Display download links in the new column
add_action('manage_product_posts_custom_column', function ($column, $post_id) {
    if ($column === 'download_link') {
        $downloads = get_post_meta($post_id, '_downloadable_files', true);
        if (!empty($downloads) && is_array($downloads)) {
            echo '<div class="download-links-container">';
            foreach ($downloads as $file) {
                $download_url = esc_url($file['file']);
                $file_name = !empty($file['name']) ? esc_html($file['name']) : basename($download_url);
                
                echo '<div class="download-link-item">';
                echo '<span class="file-name">' . $file_name . '</span>';
                echo '<input type="text" class="download-link" value="' . $download_url . '" readonly />';
                echo '<button class="copy-download-link button">Copy</button>';
                echo '<a href="' . $download_url . '" class="button view-link" target="_blank" title="Open in new tab">View</a>';
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo '<em>No Download Links</em>';
        }
    }
}, 10, 2);

// Add filter dropdown in WooCommerce admin panel
add_action('restrict_manage_posts', function () {
    global $typenow;
    if ($typenow === 'product') {
        $selected = isset($_GET['download_status']) ? $_GET['download_status'] : '';
        echo '<select name="download_status">
                <option value="">All Products</option>
                <option value="has_download" ' . selected($selected, 'has_download', false) . '>Has Download Links</option>
                <option value="no_download" ' . selected($selected, 'no_download', false) . '>No Download Links</option>
              </select>';
    }
});

// Filter products based on download links status
add_action('pre_get_posts', function ($query) {
    global $pagenow, $typenow;
    if ($pagenow === 'edit.php' && $typenow === 'product' && isset($_GET['download_status'])) {
        if ($_GET['download_status'] === 'no_download') {
            $meta_query = [
                [
                    'key'     => '_downloadable_files',
                    'compare' => 'NOT EXISTS',
                ],
            ];
            $query->set('meta_query', $meta_query);
        } elseif ($_GET['download_status'] === 'has_download') {
            $meta_query = [
                [
                    'key'     => '_downloadable_files',
                    'compare' => 'EXISTS',
                ],
            ];
            $query->set('meta_query', $meta_query);
        }
    }
});

// Handle sorting by download links
add_filter('request', function ($vars) {
    if (isset($vars['orderby']) && 'download_link' === $vars['orderby']) {
        $vars = array_merge($vars, [
            'meta_key' => '_downloadable_files',
            'orderby'  => 'meta_value_num',
        ]);
    }
    return $vars;
});
