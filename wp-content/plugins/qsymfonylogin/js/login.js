jQuery(function ($) {
    $('#q-symfony-login-form').on('submit', function (e) {
        e.preventDefault();
        var $form = $(this);
        var $message = $('#q-symfony-login-message');
        $message.html('');
        $.ajax({
            url: q_symfony_login_vars.ajax_url,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'q_symfony_login',
                nonce: q_symfony_login_vars.nonce,
                username: $form.find('#username').val(),
                password: $form.find('#password').val()
            },
            beforeSend: function () {
                $form.find('input[type="submit"]').attr('disabled', 'disabled');
            },
            success: function (response) {
                if (response.success) {
                    $message.html('Access token retrieved successfully.');
                    // Do something with the access token.
                } else {
                    $message.html(response.data.message);
                }
            },
            error: function (xhr) {
                $message.html('An error occurred. Please try again later.');
            },
            complete: function () {
                $form.find('input[type="submit"]').removeAttr('disabled');
            }
        });
    });
});