$(document).ready(function() {

    $('.footable').footable();
    $('.footable2').footable();

    $(".percent").TouchSpin({
        min: 0,
        max: 100,
        step: 0.5,
        decimals: 1,
        boostat: 5,
        maxboostedstep: 10,
        postfix: '%',
        buttondown_class: 'btn btn-white',
        buttonup_class: 'btn btn-white btn_plus'
    });

    if (trainer_is_seen == 0) {
        $.ajax({
            url: BASE_URL + '/admin/trainers/seen/' + trainer_id,
            type: 'get',
            success: function () {
                var count = $('.trainer_alert .count')[0].innerHTML;
                if (count - 1 == 0) {
                    $('.trainer_alert .count').remove();
                    $('.trainer_alert .dropdown-menu').remove();
                }
                else {
                    $('.trainer_alert .count').html(count - 1);
                    $('#trainer_' + trainer_id).next('li').remove();
                    $('#trainer_' + trainer_id).remove();

                }
            }
        });
    }

    $('#tab1').on('click', function () {
        if ($('.message_alert .count')[0])
           paymentsSeen();
    });

    if ($('#tab1').hasClass('active')) {
        if ($('.message_alert .count')[0])
            paymentsSeen();
    }

    function paymentsSeen() {
        $.ajax({
            url: BASE_URL + '/admin/trainer/payments/seen/' + trainer_id,
            type: 'get',
            success: function (data) {
                var count = ($('.message_alert .count')[0]).innerHTML;
                if (data.count != 0) {
                    if (count - data.count == 0)
                        $('.message_alert .count').remove();
                    else
                        $('.message_alert .count').html(count - data.count);

                    $.each(data.payments, function (index, value) {
                        $(document).find('#msg_' + value.id).next('li').remove();
                        $(document).find('#msg_' + value.id).remove();

                        if ($(document).find('.message_alert .dropdown-menu li').length == 0) {
                            $(document).find('.message_alert .dropdown-menu').remove();
                        }
                    })

                }

            }
        });
    }

    var skip_msg = 0;

    $(document).find('.messages_more').on('click', function(){
        skip_msg += 10;
        $.ajax ({
            url: BASE_URL+'/admin/trainers/payments/'+trainer_id+'/'+skip_msg,
            type: 'get',
            success: function(data){
                $.each(data.payments, function(index, value){
                    $('#tab-1 .feed-activity-list').append('<div class="feed-element">' +
                            '<div class="media-body ">'+
                                '<small class="pull-right text-navy">'+value.created_at+'</small>'+
                                '<strong>Trainer</strong> wants to get <strong>'+value.amount+' AMD</strong> from Active Account. <br>'+
                            '</div>'+
                        '</div>'

                    )
                });

                if(data.exist.length == 0){
                    $('.messages_more').hide();
                }
            }
        })
    });


    $('.edit_payment').on('click', function(){

        var status = $(this).data('status');
        var amount = $(this).data('amount');
        var payment_id = $(this).data('id');

        if(status == 0) {
            $(document).find('.pending').prop('checked', true);
        }
        else
            if(status == 1)
                $(document).find('.paid').prop('checked', true);

        $(document).find('#editPaymentModal input[name="amount"] ').val(amount);
        $(document).find('#editPaymentModal input[name="payment_id"]').val(payment_id);
    });

    $('.delete_payment').on('click', function(){
        var payment_id = $(this).data('id');
        swal({
                title: "Delete payment?",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: false,
                animation: "slide-from-top"
            },
            function(isConfirm){
                if(isConfirm) {
                    $.ajax({
                        url: BASE_URL+'/admin/payments/delete/'+payment_id,
                        type: 'post',
                        data: {
                            _token: token
                        },
                        success: function(){
                            swal({
                                    title: "Deleted!",
                                    type: "success",
                                    timer: 2000
                                },
                                function(isConfirm){
                                    location.reload();
                                }
                            );
                        }

                    });
                }
            }
        );
    });

    $('.new_payment').on('click', function(){

        var trainer_id = $(this).data('trainer_id');
        swal({
                title: "New Payment!",
                text: "Amount",
                type: "input",
                showCancelButton: true,
                closeOnConfirm: false,
                animation: "slide-from-top",
                inputPlaceholder: "AMD"
            },
            function(inputValue){
                if (inputValue === false) return false;

                if (inputValue === "") {
                    swal.showInputError("Amount is required!");
                    return false
                }
                if(!$.isNumeric(inputValue)){
                    swal.showInputError("Amount should be number!");
                    return false
                }

                $.ajax({
                    url: BASE_URL+'/admin/payments/new',
                    type: 'post',
                    data: {
                        trainer_id: trainer_id,
                        amount: inputValue,
                        _token: token
                    },
                    success: function(){
                        swal({
                                title: "Success!",
                                text: "Amount: " + inputValue,
                                type: "success"
                            },
                            function(isConfirm){
                                location.reload();
                            }
                        );
                    }

                });
            });

    })

});

$('.tab').on('click', function(){
    var id = $(this).attr('id');
    localStorage.setItem('trainer_profile_tab', id);
});

$('.delete').on('click', function(){
    var _this = $(this);
    swal({
            title: "Are you sure?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#892E6B",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: true },
        function (isConfirm) {
            if (isConfirm) {
                var trainer_id = _this.data('id');
                $.ajax({
                    url: BASE_URL+'/admin/trainers/delete/'+trainer_id,
                    type: 'post',
                    data: {
                        _token: token
                    },
                    success: function(data){
                        window.location.href = BASE_URL+'/admin/trainers'
                    }
                });

            } else {

            }
        });

});

if(localStorage.getItem('trainer_profile_tab')){
    switch (localStorage.getItem('trainer_profile_tab')){
        case 'tab1':
            if(!$('#tab1').hasClass('active')){
                $('#tab1').addClass('active');
                $('#tab2').removeClass('active');
                $('#tab-1').addClass('active');
                $('#tab-2').removeClass('active')
            }
            $('#tab1')
            break;
        case 'tab2':
            if(!$('#tab2').hasClass('active')){
                $('#tab2').addClass('active');
                $('#tab1').removeClass('active');
                $('#tab-2').addClass('active');
                $('#tab-1').removeClass('active')
            }
            break
        case 'tab3' :
            if(!$('#tab3').hasClass('active')){
                $('#tab3').addClass('active');
                $('#tab1').removeClass('active');
                $('#tab-3').addClass('active');
                $('#tab-1').removeClass('active')
            }
    }
}

$(document).find('.export').on('click', function(){
    var id = $(this).data('id');

    $.ajax({
        url: BASE_URL+'/admin/promo_card/'+id,
        type: 'get',
        success: function(data){

            $('#exportData').find('.trainer_name span').html(data.trainer.name);
            $('#exportData').find('input[name="trainer"]').val(data.trainer.name);

            $('#exportData').find('.trainer_phone span').html(data.trainer.phone);
            $('#exportData').find('input[name="phone"]').val(data.trainer.phone);

            if(data.trainer.gym) {
                $('#exportData').find('.gym').html(data.trainer.gym.name);
                $('#exportData').find('input[name="gym"]').val(data.trainer.gym.name);
            }
            else {
                $('#exportData').find('.gym').html('Null');
                $('#exportData').find('input[name="gym"]').val('');
            }

            $('#exportData').find('.promo_code').html(data.code);
            $('#exportData').find('input[name="promo_code"]').val(data.code);

            $('#exportData').find('.percent').html(data.percent);
            $('#exportData').find('input[name="percent"]').val(data.percent);

            $('#exportData').find('.trainer_img').attr('src', '/images/trainerImages/'+data.trainer.image.name);

            $('#exportData').find('input[name="image_name"]').val(data.trainer.image.name);
        }
    })
});

$('#exportData').on('click', '.edit', function(){
    var parent = $(this).closest('dd');
    var value = $(this).closest('dd').find('span')[0].innerText;
    $(this).closest('dd').html('<input type="text" class="form-control" value="'+value+'">');
    parent.find('input').focus();
    parent.find('input')[0].setSelectionRange(value.length, value.length);

});

$(document).find('#exportData').on('focus', 'input', function() {

}).on('blur', 'input', function() {
    var value = $(this).val();
    var parent = $(this).closest('dd');

    $(this).closest('dd').html('<span>'+value+'</span>'+' <i class="fa fa-pencil edit"></i>')
    parent.next('input').val(value);

});