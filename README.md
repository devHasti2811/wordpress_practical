
## Installation

1. **Download or Clone the Plugin:**
   - Place the entire `custom-contact-form` folder in your `wp-content/plugins/` directory.

2. **Activate the Plugin:**
   - Log in to your WordPress admin panel.
   - Navigate to **Plugins** and activate **Custom Contact Form**.

3. **Add the Contact Form to Your Site:**
   - Use the shortcode `[custom_contact_form]` in any page or post to display the contact form.

4. **If Whole projects clone then Databse also given into `wp-content/database` directory.**
    -username : admin
    -password : hxJ&b38w%K!RVGV4ee

## Usage

### Frontend Form

- The form displays fields for Name, Email, and Message.
- A hidden honeypot field (`ccf_hp_field`) is included for spam protection.
- AJAX is used to submit the form data to WordPress without reloading the page.
- On successful submission, data is saved to the database and an email notification is sent to the admin.

### Admin Panel

- An admin menu item named **Contact Submissions** is added to the dashboard.
- This page displays a list of form submissions along with a **Delete** button for each entry.
- The delete functionality is implemented via AJAX, so entries are removed without reloading the page.

## Customization

- **Email Notification:**  
  Modify the email subject and body in `form-handler.php` to suit your needs.
  
- **Spam Protection:**  
  The plugin uses a basic honeypot field. If you need a more robust solution, consider integrating Google reCAPTCHA.
  
- **Styling:**  
  Edit `assets/style.css` to customize the look and feel of the contact form.

## Uninstallation

- **Deactivation:**  
  Deactivating the plugin does not remove data from the database.
  

## Troubleshooting

- **Honeypot Issues:**  
  If you encounter a "Spam detected" error even with legitimate submissions, ensure that the hidden honeypot field (`ccf_hp_field`) is not being auto-filled by your browser or an extension.
  
- **AJAX Errors:**  
  Use your browser’s developer console (F12) to check for JavaScript or AJAX errors if the form or delete actions do not work as expected.
