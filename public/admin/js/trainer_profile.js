$(document).ready(function() {

    $('.footable').footable();
    $('.footable2').footable();

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
    }
}