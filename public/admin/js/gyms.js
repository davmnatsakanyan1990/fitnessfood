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
                var gym_id = row.data('id');
                $.ajax({
                    url: BASE_URL + '/admin/gyms/delete/' + gym_id,
                    type: 'post',
                    data: {
                        _token: token
                    },
                    success: function (data) {
                        row.closest('tr').remove();
                    }
                });
                swal("Deleted!", "Gym has been deleted.", "success");
            }
        });
});

$(document).find('#add').on('click', function () {
    var name = $(document).find('#new_gym input[name="name"]').val();

    if (name == '') {
        $(document).find('#addGym .errors').html('');
        $(document).find('#addGym .errors').append('' +
            '<div class="alert alert-danger">' +
            '<ul>' +
            '<li>Name field is required</li>' +
            '</ul>' +
            '</div>');
    }
    else {
        $.ajax({
            url: BASE_URL + '/admin/gyms/create',
            type: 'post',
            data: {
                name: name,
                _token: token
            },
            success: function () {
                location.reload();
            }
        })
    }
});

$(document).find('.edit').on('click', function () {
    var id = $(this).data('id');

    $.ajax({
        url: BASE_URL + '/admin/gyms/get/' + id,
        type: 'get',
        success: function (data) {
            $(document).find('#edit_gym input[name="name"]').val(data.name);

            $(document).on('click', '#save', function () {
                var name = $(document).find('#edit_gym input[name="name"]').val();

                if (name == '') {
                    $(document).find('#editGym .errors').html('');
                    $(document).find('#editGym .errors').append('' +
                        '<div class="alert alert-danger">' +
                        '<ul>' +
                        '<li>Name field is required</li>' +
                        '</ul>' +
                        '</div>');
                }
                else {
                    $.ajax({
                        url: BASE_URL + '/admin/gyms/update/' + id,
                        type: 'post',
                        data: {
                            name: name,
                            _token: token
                        },
                        success: function () {
                            location.reload();
                        }

                    })
                }
            })
        }
    })
});