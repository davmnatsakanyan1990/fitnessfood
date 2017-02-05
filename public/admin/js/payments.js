$('.edit_payment').on('click', function(){
    var payment_id = $(this).data('id');
    var amount = $(this).data('amount');

    swal({
            title: "Edit Payment!",
            text: "Amount",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "AMD",
            inputValue: amount
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
                url: BASE_URL+'/admin/payments/update/'+payment_id,
                type: 'post',
                data: {
                    amount: inputValue,
                    _token: token
                },
                success: function(){
                    swal({
                            title: "Payment Updated!",
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