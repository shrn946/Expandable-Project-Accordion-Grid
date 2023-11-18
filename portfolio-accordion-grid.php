<?php
/*
Plugin Name: Expandable Project Accordion Grid
Description: A plugin designed to feature an expandable Project & Portfolio Accordion Grid.

Version: 1.0
Author: Hassan Naqvi
Youtube: https://www.youtube.com/channel/UCqGzcfYv6AdaV0OsXVWIkew
*/

// Plugin code will go here
include_once(plugin_dir_path(__FILE__) . '/includes/project-info.php');
include_once(plugin_dir_path(__FILE__) . '/includes/shortcode.php');


// Enqueue styles and scripts
function custom_portfolio_enqueue_scripts() {
    // Enqueue fonts.css
    wp_enqueue_style('custom-portfolio-fonts', plugins_url('css/fonts.css', __FILE__));

    // Enqueue card-grid.css
    wp_enqueue_style('custom-portfolio-card-grid', plugins_url('css/card-grid.css', __FILE__));

    // Enqueue jQuery
    wp_enqueue_script('jquery');

    // Enqueue card-grid.js and depend on jQuery
    wp_enqueue_script('custom-portfolio-card-grid', plugins_url('js/card-grid.js', __FILE__), array('jquery'), '1.0', true);
}

add_action('wp_enqueue_scripts', 'custom_portfolio_enqueue_scripts');


// Function to display the Expandable Project Accordion Grid settings page
function expandable_project_accordion_grid_settings_page() {
    ?>
    <div class="wrap">
        <h1>Expandable Project Accordion Grid Settings</h1>
        <p>Welcome to the Expandable Project Accordion Grid plugin settings page.</p>
        <h2>How to Use Shortcode</h2>
        <p>To display the Expandable Project Accordion Grid on your site, you can use the following shortcode:</p>
        <pre>[projects]</pre>
        
        <h3>Video Link</h3>

        <iframe width="560" height="315" src="https://www.youtube.com/embed/L_UFOW0kxcI?si=ynD3DXibhivZ1WcZ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        
      
    </div>
    <?php
}

// Function to add Expandable Project Accordion Grid settings page to the admin menu
function expandable_project_accordion_grid_menu() {
    add_options_page(
        'Expandable Project Accordion Grid Settings',
        'Expandable Accordion Grid',
        'manage_options',
        'expandable-accordion-grid-settings',
        'expandable_project_accordion_grid_settings_page'
    );
}

// Hook to add the Expandable Project Accordion Grid menu item
add_action('admin_menu', 'expandable_project_accordion_grid_menu');

// Function for the shortcode generator (add your code here)
function expandable_project_accordion_grid_shortcode_generator() {
    // Add your shortcode generator code here
}

// Hook to add the shortcode generator to the admin menu
add_action('admin_menu', 'expandable_project_accordion_grid_shortcode_generator');

// Function for handling the Expandable Project Accordion Grid shortcode
function expandable_project_accordion_grid_shortcode($atts) {
    // Add your shortcode handling code here
}

// Hook to add the Expandable Project Accordion Grid shortcode
add_shortcode('expandable_project_accordion_grid', 'expandable_project_accordion_grid_shortcode');

// Function to add a settings link on the Plugins page
function expandable_project_accordion_grid_settings_link($links) {
    $settings_link = '<a href="options-general.php?page=expandable-accordion-grid-settings">Settings</a>';
    array_unshift($links, $settings_link);
    return $links;
}

// Variable to get the plugin basename
$plugin = plugin_basename(__FILE__);

// Hook to add the settings link to the Plugins page
add_filter("plugin_action_links_$plugin", 'expandable_project_accordion_grid_settings_link');













