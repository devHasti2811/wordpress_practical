<?php
/**
 * Plugin Name: Custom Contact Form
 * Description: A simple contact form plugin with AJAX and admin panel.
 * Version: 1.0
 * Author: Your Name
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Include necessary files
require_once plugin_dir_path(__FILE__) . 'includes/form-handler.php';
require_once plugin_dir_path(__FILE__) . 'includes/admin-page.php';

// Create Database Table on Plugin Activation
function ccf_create_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'ccf_submissions';

    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        message TEXT NOT NULL,
        submitted_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'ccf_create_table');


// Enqueue scripts
function ccf_enqueue_scripts() {
    wp_enqueue_style('ccf-style', plugin_dir_url(__FILE__) . 'assets/style.css');
    wp_enqueue_script('ccf-script', plugin_dir_url(__FILE__) . 'assets/script.js', ['jquery'], null, true);
    wp_localize_script('ccf-script', 'ccf_ajax', ['ajax_url' => admin_url('admin-ajax.php')]);
}

add_action('wp_enqueue_scripts', 'ccf_enqueue_scripts');

// Shortcode for frontend form
function ccf_contact_form() {
    if (!function_exists('ccf_handle_form_submission')) {
        return '<p style="color: red;">The contact form is unavailable because the plugin is inactive.</p>';
    }

    ob_start();
    ?>
    <form id="ccf-form">
        <input type="hidden" name="action" value="ccf_submit_form">
        <!-- Honeypot field for spam protection (hidden with CSS) -->
        <div style="display:none;">
            <label>Leave this field empty</label>
            <input type="text" name="ccf_honeypot" value="">
        </div>
        
        <label>Name:</label>
        <input type="text" name="name" required>
        
        <label>Email:</label>
        <input type="email" name="email" required>
        
        <label>Message:</label>
        <textarea name="message" required minlength="10"></textarea>
        
        <button type="submit">Submit</button>
    </form>
    <div id="ccf-response"></div>
    <?php
    return ob_get_clean();
}

add_shortcode('custom_contact_form', 'ccf_contact_form');
