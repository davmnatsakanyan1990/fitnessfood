//$(document).find('.edit').on('click', function(){
//    var id = $(this).data('id');
//
//    $.ajax({
//        url : BASE_URL + '/admin/promo/get/' + id,
//        type: 'get',
//        success: function(data){
//            $('#editPromoCode').find('input[name="percent"]').val(data.percent);
//            $('#editPromoCode').find('.trainer_name').text(data.trainer.name);
//            $('#editPromoCode').find('.promo').text(data.code);
//            $('#editPromoCode').find('input[name="id"]').val(data.id)
//        }
//    })
//});

//$('.delete').click(function () {
//    var row = $(this);
//
//    swal({
//            title: "Are you sure?",
//            type: "warning",
//            showCancelButton: true,
//            confirmButtonColor: "#892E6B",
//            confirmButtonText: "Yes, delete it!",
//            cancelButtonText: "No, cancel plx!",
//            closeOnConfirm: false,
//            closeOnCancel: true
//        },
//        function (isConfirm) {
//            if (isConfirm) {
//                var promo_id = row.data('id');
//                $.ajax({
//                    url: BASE_URL + '/admin/promo/delete/' + promo_id,
//                    type: 'post',
//                    data: {
//                        _token: token
//                    },
//                    success: function (data) {
//                        row.closest('tr').remove();
//                    }
//                });
//                swal("Deleted!", "Gym has been deleted.", "success");
//            }
//        });
//});
