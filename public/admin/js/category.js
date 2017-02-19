//$(document).find('#add').on('click', function () {
//    var name = {};
//    name.am = $(document).find('#new_cat input[name="name[am]"]').val();
//    name.ru = $(document).find('#new_cat input[name="name[ru]"]').val();
//    name.en = $(document).find('#new_cat input[name="name[en]"]').val();
//
//    $.ajax({
//        url: BASE_URL + '/admin/categories/new',
//        type: 'post',
//        data: {
//            name: name,
//            _token: token
//        },
//        success: function () {
//            location.reload();
//        },
//        error: function(error){
//            console.log(error);
//        }
//    })
//});
$(document).find('.edit').on('click', function () {
    var id = $(this).data('id');

    $.ajax({
        url: BASE_URL + '/admin/categories/get/' + id,
        type: 'get',
        success: function (data) {
            $(document).find('#edit_cat input[name="name[am]"]').val(JSON.parse(data.name).am);
            $(document).find('#edit_cat input[name="name[ru]"]').val(JSON.parse(data.name).ru);
            $(document).find('#edit_cat input[name="name[en]"]').val(JSON.parse(data.name).en);

            $(document).find('#edit_cat input[name="cat_id"]').val(data.id);

        }
    })
});

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
            closeOnCancel: true
        },
        function (isConfirm) {
            if (isConfirm) {
                var cat_id = row.data('id');
                $.ajax({
                    url: BASE_URL + '/admin/categories/delete/' + cat_id,
                    type: 'post',
                    data: {
                        _token: token
                    },
                    success: function (data) {
                        row.closest('tr').remove();
                    }
                });
                swal("Deleted!", "category has been deleted.", "success");
            }
        });
});