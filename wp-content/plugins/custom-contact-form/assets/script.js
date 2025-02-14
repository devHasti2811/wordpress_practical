jQuery(document).ready(function ($) {
    // Handle Form Submission
    $('#ccf-form').submit(function (e) {
        e.preventDefault();
        let formData = $(this).serialize();

        $.post(ccf_ajax.ajax_url, formData, function (response) {
            if (response.success) {
                $('#ccf-response').text(response.message).css('color', 'green');
                $('#ccf-form')[0].reset();
            } else {
                $('#ccf-response').text(response.message).css('color', 'red');
            }
        }).fail(function (xhr) {
            console.log('Error:', xhr.responseText);
        });
    });

    // Handle Delete Submission
    $('.ccf-delete').click(function () {
        let id = $(this).data('id');
        let row = $('#row-' + id);

        if (confirm('Are you sure?')) {
            $.post(ccf_ajax.ajax_url, { action: 'ccf_delete_submission', id: id }, function (response) {
                if (response.success) row.fadeOut();
                else alert(response.message);
            });
        }
    });
});
