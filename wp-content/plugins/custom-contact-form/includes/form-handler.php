<?php
if (!defined('ABSPATH')) {
    exit;
}

// Handle AJAX Form Submission
function ccf_handle_form_submission() {
    global $wpdb;
    
    // Validate input
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $message = sanitize_textarea_field($_POST['message']);

     // Check for the honeypot field (if it's filled, assume it's spam)
     if (!empty($_POST['ccf_honeypot'])) {
        wp_send_json_error(['message' => 'Spam detected.']);
    }

    if (empty($name) || empty($email) || empty($message)) {
        wp_send_json_error(['message' => 'All fields are required.']);
    }

    if (!is_email($email)) {
        wp_send_json_error(['message' => 'Invalid email format.']);
    }

    if (strlen($message) < 10) {
        wp_send_json_error(['message' => 'Message must be at least 10 characters long.']);
    }

    // Store in database
    $table_name = $wpdb->prefix . 'ccf_submissions';
    $wpdb->insert($table_name, [
        'name' => $name,
        'email' => $email,
        'message' => $message,
        'submitted_at' => current_time('mysql')
    ]);

    if (!$inserted) {
        wp_send_json_error(['message' => 'Database error, please try again later.']);
    }

    // Send an email notification to the admin
    $admin_email = get_option('admin_email');
    $subject = 'New Contact Form Submission';
    $body = "You have received a new contact form submission:\n\n" .
            "Name: $name\n" .
            "Email: $email\n" .
            "Message: $message\n";
    // You can add headers if needed
    wp_mail($admin_email, $subject, $body);

    wp_send_json_success(['message' => 'Form submitted successfully!']);
}

add_action('wp_ajax_ccf_submit_form', 'ccf_handle_form_submission');
add_action('wp_ajax_nopriv_ccf_submit_form', 'ccf_handle_form_submission');

