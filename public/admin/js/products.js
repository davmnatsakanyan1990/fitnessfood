$(document).ready(function() {

    $('.footable').footable();

});

// var row = null;
// $('.action .delete').on('click', function(){
//     row = $(this);
//     var product_id = $(this).data('id');
//     $('#modal-form').find('input[name="product_id"]').val(product_id);
// });
//
// $('#modal-form').find('.yes').on('click', function(event){
//     event.preventDefault();
//
//     var product_id = $('input[name="product_id"]').val();
//     var token = $('input[name="_token"]').val();
//     $.ajax({
//         url: BASE_URL+'/admin/products/delete/'+product_id,
//         type: 'post',
//         data: {
//             _token: token
//         },
//         success: function(data){
//             $('#modal-form').modal('hide');
//             row.closest('tr').remove();
//             $('.ibox-content').prepend(
//                 '<div class="alert alert-danger alert-dismissable">'+
//                 '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>'+
//                 '<p>'+data.message+'</p>'+
//                 '</div>');
//         }
//     })
// })
