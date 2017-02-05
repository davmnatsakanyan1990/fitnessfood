$(document).ready(function () {

    if (order_is_seen == 0) {
        $.ajax({
            url: BASE_URL + '/admin/order/seen/' + order_id,
            type: 'get',
            success: function () {
                var count = ($('.order_alert .count'))[0].innerHTML;
                if (count - 1 == 0) {
                    $('.order_alert .count').remove();
                    $('.order_alert ul').remove();
                }
                else {
                    $('.order_alert .count').html(count - 1);
                    $('#order_' + order_id).next('li').remove();
                    $('#order_' + order_id).remove();
                }
            }
        });
    }

    $('select[name="status"]').on('change', function () {

        var status = $(this).val();

        $.ajax({
            url: BASE_URL + '/admin/orders/' + order_id + '/status/update',
            type: 'post',
            data: {
                status: status,
                _token: token
            },
            success: function (data) {

            }
        })
    })

});
