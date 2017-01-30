// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('f099d8275bf3d94c6bf9', {
    encrypted: true
});

var channel = pusher.subscribe('new-message');
channel.bind('App\\Events\\NewMessageEvent', function(data) {
    alert('new message');
});

// New Order Channel
var channel = pusher.subscribe('new-order');
channel.bind('App\\Events\\NewOrderEvent', function(data) {
    console.log(data);

    if($('.notifications_count').length > 0){
        var count = $(document).find('.notifications_count')[0].innerText;
        $(document).find('.notifications_count').text(parseInt(count)+1);
        $(document).find('.notification_block').prepend('<li id="order_'+data.order.id+'">'+
                '<a href="'+BASE_URL+'/admin/orders/show/'+data.order.id+'">'+
                    '<div>'+
                        '<i class="fa fa-envelope fa-fw"></i> You have new order'+
                    '</div>'+
                '</a>'+
            '</li>'+
            '<li class="divider"></li>');
    }
    else{
        $(document).find('.order_notifi').append('<span class="label label-primary new_messages_count">1</span>');

        $(document).find('.dropdown').append('<ul class="dropdown-menu dropdown-alerts">'+
                '<div class="notification_block" style="overflow-y: scroll; max-height: 300px" >' +
                    '<li id="trainer_' + data.order.id + '">' +
                        '<a href="' + BASE_URL + '/admin/orders/show/' + data.order.id + '">' +
                            '<div>' +
                                '<i class="fa fa-envelope fa-fw"></i> You have new order' +
                            '</div>' +
                        '</a>' +
                    '</li>' +
                    '<li class="divider"></li>' +
                '</div>' +
            '</ul>')
    }

    if(current == BASE_URL+'/admin/orders'){
        $(document).find('.order-table tbody').prepend('<tr class="new_order">'+
                '<td>'+data.order.customer_name+'</td>'+
                '<td>'+data.order.customer_phone+'</td>'+
                '<td>'+data.order.counselor=='null' ? data.order.counselor.first_name+' '+data.order.counselor.last_name : ''+'</td>'+
                '<td>'+data.order.amount+'</td>'+
                '<td>'+data.order.created_at+'</td>'+
                '<td><span class="label label-warning">Pending</span></td>'+
                '<td class="text-right">'+
                    '<div class="btn-group">'+
                        '<a href="'+BASE_URL+'admin/orders/show/'+data.order.id+'"><button class="btn-white btn btn-xs">View</button></a>'+
                    '</div>'+
                '</td>'+
            '</tr>'
        )
    }
});

// New Trainer Channel
var channel = pusher.subscribe('new-trainer');
channel.bind('App\\Events\\NewTrainerEvent', function(data) {
    if($('.notifications_count').length > 0){
        var count = $(document).find('.notifications_count')[0].innerText;
        $(document).find('.notifications_count').text(parseInt(count)+1);
        $(document).find('.notification_block').prepend('<li id="trainer_'+data.trainer_id+'">'+
                '<a href="'+BASE_URL+'/admin/trainers/show/'+data.trainer_id+'">'+
                    '<div>'+
                        '<i class="fa fa-envelope fa-fw"></i> You have new trainer'+
                    '</div>'+
                '</a>'+
            '</li>'+
            '<li class="divider"></li>');
    }
    else{
        $(document).find('.order_notifi').append('<span class="label label-primary new_messages_count">1</span>');

        $(document).find('.dropdown').append('<ul class="dropdown-menu dropdown-alerts">'+
                '<div class="notification_block" style="overflow-y: scroll; max-height: 300px" >'+
                    '<li id="trainer_'+data.trainer_id+'">'+
                        '<a href="'+BASE_URL+'/admin/trainers/show/'+data.trainer_id+'">'+
                            '<div>'+
                                '<i class="fa fa-envelope fa-fw"></i> You have new trainer'+
                            '</div>'+
                        '</a>'+
                    '</li>'+
                    '<li class="divider"></li>'+
                '</div>'+
            '</ul>')
    }
});
