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