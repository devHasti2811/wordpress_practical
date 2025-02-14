<?php
if (!defined('ABSPATH')) {
    exit;
}

// Add Menu Page
function ccf_create_admin_menu() {
    add_menu_page(
        'Contact Form Submissions',
        'Contact Submissions',
        'manage_options',
        'ccf_submissions',
        'ccf_display_admin_page',
        'dashicons-email',
        20
    );
}
add_action('admin_menu', 'ccf_create_admin_menu');

// Enqueue admin-side scripts (only on our plugin admin page)
function ccf_admin_enqueue_scripts($hook) {
    // Only load scripts on our plugin's admin page.
    if ($hook !== 'toplevel_page_ccf_submissions') {
        return;
    }
    wp_enqueue_script('ccf-admin-script', plugin_dir_url(__FILE__) . '../assets/script.js', ['jquery'], null, true);
    wp_localize_script('ccf-admin-script', 'ccf_ajax', [
        'ajax_url' => admin_url('admin-ajax.php')
    ]);
}
add_action('admin_enqueue_scripts', 'ccf_admin_enqueue_scripts');

// Display Submissions
function ccf_display_admin_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'ccf_submissions';
    $submissions = $wpdb->get_results("SELECT * FROM $table_name ORDER BY submitted_at ASC");

    ?>
    <div class="wrap">
        <h2>Contact Form Submissions</h2>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Submitted At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($submissions as $submission) : ?>
                    <tr id="row-<?php echo $submission->id; ?>">
                        <td><?php echo esc_html($submission->name); ?></td>
                        <td><?php echo esc_html($submission->email); ?></td>
                        <td><?php echo esc_html($submission->message); ?></td>
                        <td><?php echo esc_html($submission->submitted_at); ?></td>
                        <td>
                            <button class="ccf-delete" data-id="<?php echo $submission->id; ?>">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
}

// AJAX Delete Handler
function ccf_delete_submission() {
    global $wpdb;

    $id = intval($_POST['id']);
    $table_name = $wpdb->prefix . 'ccf_submissions';
    $wpdb->delete($table_name, ['id' => $id]);

    wp_send_json_success(['message' => 'Deleted successfully']);
}

add_action('wp_ajax_ccf_delete_submission', 'ccf_delete_submission');
