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
    if($('.notifications_count').length > 0){
        var count = $(document).find('.notifications_count')[0].innerText;
        $(document).find('.notifications_count').text(parseInt(count)+1);
        $(document).find('.notification_block').prepend('<li id="order_'+data.order_id+'">'+
                '<a href="'+BASE_URL+'/admin/orders/show/'+data.order_id+'">'+
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
                    '<li id="trainer_' + data.order_id + '">' +
                        '<a href="' + BASE_URL + '/admin/orders/show/' + data.order_id + '">' +
                            '<div>' +
                                '<i class="fa fa-envelope fa-fw"></i> You have new order' +
                            '</div>' +
                        '</a>' +
                    '</li>' +
                    '<li class="divider"></li>' +
                '</div>' +
            '</ul>')
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
