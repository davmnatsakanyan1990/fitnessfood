// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('f099d8275bf3d94c6bf9', {
    encrypted: true
});

// New Message channel
var channel = pusher.subscribe('new-message');
channel.bind('App\\Events\\NewMessageEvent', function(data) {
    console.log(data);
    if(data.sender.image == "null"){
        var image = 'profile-icon.png';
    }
    else{
        var image = data.sender.image.name;
    }

    if($('.new_messages_count').length > 0){
        var count = $(document).find('.new_messages_count')[0].innerText;
        $(document).find('.new_messages_count').text(parseInt(count)+1);
        $(document).find('.dropdown-messages').prepend('<li class="msg_'+data.message.id+'">'+
                '<div class="dropdown-messages-box">'+
                    '<a href="/admin/trainers/show/'+data.sender.id+'" class="pull-left view_message">'+
                        '<img alt="image" class="img-circle" src="/images/trainerImages/'+image+'">'+
                    '</a>'+
                    '<div class="media-body">'+
                        '<strong>'+data.sender.first_name+' '+data.sender.last_name+'</strong> <br>'+
                        '<p>New Message</p>'+
                        '<small class="text-muted">'+data.message.created_at+'</small>'+
                    '</div>'+
                '</div>'+
            '</li>'+
            '<li class="divider"></li>'
        );
    }
    else{
        $(document).find('.message_notifi').append('<span class="label label-primary new_messages_count">1</span>');

        $(document).find('.drp_msg').append('<ul class="dropdown-menu dropdown-messages">'+
                '<li class="msg_'+data.message.id+'">'+
                    '<div class="dropdown-messages-box">'+
                        '<a href="/admin/trainers/show/'+data.sender.id+'" class="pull-left view_message">'+
                            '<img alt="image" class="img-circle" src="/images/trainerImages/'+image+'">'+
                        '</a>'+
                        '<div class="media-body">'+
                            '<strong>'+data.sender.first_name+' '+data.sender.last_name+'</strong> <br>'+
                            '<p>New Message</p>'+
                            '<small class="text-muted">'+data.message.created_at+'</small>'+
                        '</div>'+
                    '</div>'+
                '</li>'+
                '<li class="divider"></li>'+
            '</ul>'
        )
    }

});

// New Order Channel
var channel = pusher.subscribe('new-order');
channel.bind('App\\Events\\NewOrderEvent', function(data) {

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

        $(document).find('.drp_noti').append('<ul class="dropdown-menu dropdown-alerts">'+
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
        if( data.order.counselor == "null"){
            var counselor = '';
        }
        else{
            var counselor = data.order.counselor.first_name+' '+data.order.counselor.last_name ;
        }

        $(document).find('.order-table tbody').prepend('<tr class="new_order">'+
                '<td>'+data.order.customer_name+'</td>'+
                '<td>'+data.order.customer_phone+'</td>'+
                '<td>'+counselor+'</td>'+
                '<td>'+data.order.amount+'</td>'+
                '<td>'+data.order.created_at+'</td>'+
                '<td><span class="label label-warning">Pending</span></td>'+
                '<td class="text-right">'+
                    '<div class="btn-group">'+
                        '<a href="'+BASE_URL+'/admin/orders/show/'+data.order.id+'"><button class="btn-white btn btn-xs">View</button></a>'+
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
        $(document).find('.notification_block').prepend('<li id="trainer_'+data.trainer.id+'">'+
                '<a href="'+BASE_URL+'/admin/trainers/show/'+data.trainer.id+'">'+
                    '<div>'+
                        '<i class="fa fa-envelope fa-fw"></i> You have new trainer'+
                    '</div>'+
                '</a>'+
            '</li>'+
            '<li class="divider"></li>');
    }
    else{
        $(document).find('.order_notifi').append('<span class="label label-primary new_messages_count">1</span>');

        $(document).find('.drp_noti').append('<ul class="dropdown-menu dropdown-alerts">'+
                '<div class="notification_block" style="overflow-y: scroll; max-height: 300px" >'+
                    '<li id="trainer_'+data.trainer.id+'">'+
                        '<a href="'+BASE_URL+'/admin/trainers/show/'+data.trainer.id+'">'+
                            '<div>'+
                                '<i class="fa fa-envelope fa-fw"></i> You have new trainer'+
                            '</div>'+
                        '</a>'+
                    '</li>'+
                    '<li class="divider"></li>'+
                '</div>'+
            '</ul>')
    }

    if(current == BASE_URL+'/admin/trainers'){

        $(document).find('.trainers').prepend('<div class="col-lg-4">'+
                '<div class="contact-box">'+
                    '<div class="col-sm-4">'+
                        '<a href="'+BASE_URL+'/admin/trainers/show/'+data.trainer.id+'">'+
                            '<div class="text-center">'+
                                '<img alt="image" style="margin-bottom: 10px" class="img-circle m-t-xs img-responsive center-block" src="/images/profile-icon.png">'+
                                '<div class="label label-danger">Pending</div>'+
                            '</div>'+
                        '</a>'+
                    '</div>'+
                    '<div class="col-sm-8">'+
                        '<a href="'+BASE_URL+'/admin/trainers/show/'+data.trainer.id+'"><h3><strong>'+data.trainer.first_name+' '+data.trainer.last_name+'</strong></h3> </a>'+
                        '<p><i class="fa fa-map-marker"></i>'+data.trainer.address+'</p>'+
                        '<address>'+
                            '<i class="fa fa-envelope"></i>'+data.trainer.email+'<br>'+
                            '<i class="fa fa-phone"></i>'+data.trainer.phone+'<br>'+
                            '<i class="fa fa-building"> </i> '+data.trainer.workplace+
                        '</address>'+
                        '<div class="hr-line-dashed"></div>'+
                        '<p>Active: 0 AMD<br></p>'+
                    '</div>'+
                    '<div class="clearfix"></div>'+
                '</div>'+
            '</div>'
    );
    }
});
