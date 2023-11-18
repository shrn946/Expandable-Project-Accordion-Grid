<?php

// Add this function to your theme's project-info.php file or in a custom plugin


function custom_projects_post_type() {
    register_post_type('projects', array(
        'labels' => array(
            'name' => __('Projects'),
            'singular_name' => __('Project'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'rewrite' => array('slug' => 'projects'),
    ));

    // Add custom fields
    add_action('add_meta_boxes', 'add_projects_custom_fields');
    add_action('save_post', 'save_projects_custom_fields');

    // Add icon
    add_action('admin_head', 'add_projects_icon');
}

add_action('init', 'custom_projects_post_type');

// Add custom fields
function add_projects_custom_fields() {
    add_meta_box('sub_title', 'Sub Title', 'sub_title_callback', 'projects', 'normal', 'high');
    add_meta_box('website_link', 'Website Link', 'website_link_callback', 'projects', 'normal', 'high');
    add_meta_box('extra_info', 'Extra Info', 'extra_info_callback', 'projects', 'normal', 'high');
}

function sub_title_callback($post) {
    $sub_title = get_post_meta($post->ID, 'sub_title', true);
    echo '<div class="custom-field">';
    echo '<label for="sub_title">Sub Title:</label>';
    echo '<input type="text" id="sub_title" name="sub_title" value="' . esc_attr($sub_title) . '" size="50" />';
    echo '</div>';
}

function website_link_callback($post) {
    $website_link = get_post_meta($post->ID, 'website_link', true);
    echo '<div class="custom-field">';
    echo '<label for="website_link">Website Link:</label>';
    echo '<input type="url" id="website_link" name="website_link" value="' . esc_url($website_link) . '" size="50" />';
    echo '</div>';
}

function extra_info_callback($post) {
    $extra_info = get_post_meta($post->ID, 'extra_info', true);
    echo '<div class="custom-field">';
    echo '<label for="extra_info">Extra Info:</label>';
    echo '<textarea id="extra_info" name="extra_info" rows="4" cols="50">' . esc_textarea($extra_info) . '</textarea>';
    echo '</div>';
}

function save_projects_custom_fields($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (isset($_POST['sub_title'])) {
        update_post_meta($post_id, 'sub_title', sanitize_text_field($_POST['sub_title']));
    }

    if (isset($_POST['website_link'])) {
        update_post_meta($post_id, 'website_link', esc_url($_POST['website_link']));
    }

    if (isset($_POST['extra_info'])) {
        update_post_meta($post_id, 'extra_info', sanitize_textarea_field($_POST['extra_info']));
    }
}

// Add icon
function add_projects_icon() {
    ?>
    <style>
        #menu-posts-projects .wp-menu-image:before {
            content: '\f161'; /* Change this to the desired Dashicons code for your icon */
        }

        .custom-field {
            margin-bottom: 15px;
        }

        .custom-field label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .custom-field input,
        .custom-field textarea {
            width: 100%;
            box-sizing: border-box;
        }
    </style>
    <?php
}
