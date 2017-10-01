jQuery(document).ready(function($) {
    'use strict';

    $('.widget_coupon_detail_button_get_the_code').on('click', function(e) {
        e.preventDefault();
        var code = $(this).data('code');
        $(this).text(code);
    });

    $('.widget_coupon_detail_button_generate_code').on('click', function(e) {
        e.preventDefault();
        var el = $(this);
        var url = $(this).attr('href');
        var id = $(this).data('coupon-id');
        var admin_email = $('#admin_email').val();
        console.log(id);
        $.ajax({
            url: url,
            data: {
                id: id,
                admin_email: admin_email,
                action: 'inventor_coupons_generate_code'
            },
            success: function(data) {
                if (!data.status) {
                    alert(data.message);
                } else if (data.status) {
                    el.text(data.code);
                    console.log(data);
                    alert(data.mail);
                }
            }
        });
    });
});