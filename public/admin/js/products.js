$(document).ready(function () {
    
    $('.footable').footable();

    $('.delete').click(function () {
        var row = $(this);
        
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
                    var product_id = row.data('id');
                    $.ajax({
                        url: BASE_URL+'/admin/products/delete/'+product_id,
                        type: 'post',
                        data: {
                            _token: token
                        },
                        success: function(data){
                            row.closest('tr').remove();
                        }
                    });
                    swal("Deleted!", "Product has been deleted.", "success");
                } else {
//                                swal("Cancelled", "Your imaginary file is safe :)", "error");
                }
            });
    });


});
