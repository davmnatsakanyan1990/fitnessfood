// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('3230f3f47c09953e1b4f', {
    encrypted: true
});

// New Card Order channel
var channel = pusher.subscribe('new-card-order');
channel.bind('App\\Events\\NewCardOrderEvent', function(data) {
console.log(data);

    // alert sound
    document.getElementById('xyz').play();
    if(data.card_order.promo_code.trainer.image == null){
        var image = 'profile-icon.png';
    }
    else{
        var image = data.card_order.promo_code.trainer.image.name;
    }

    if($('.card_order_alert .count').length > 0){
        var count = $(document).find('.card_order_alert .count')[0].innerText;
        $(document).find('.card_order_alert .count').text(parseInt(count)+1);
        $(document).find('.card_order_alert ul').prepend('<li id="card_order_'+data.card_order.id+'">'+
            '<a href="/admin/promo_card/orders" class="pull-left">'+
            '<img alt="image" width="30" class="img-circle" src="/images/trainerImages/'+image+'">'+
            '</a>'+
            '<div class="media-body">'+
            '<strong>'+data.card_order.promo_code.trainer.name+'</strong> <br>'+
            '<p>New Card Order</p>'+
            '<small class="text-muted">'+data.card_order.created_at+'</small>'+
            '</div>'+
            '</li>'+
            '<li class="divider"></li>'
        );
    }
    else{
        $(document).find('.card_order_alert .count-info').append('<span class="label label-primary count">1</span>');

        $(document).find('.card_order_alert').append('<ul class="dropdown-menu dropdown-messages">'+
            '<li id="card_order_'+data.card_order.id+'">'+
            '<a href="/admin/promo_card/orders" class="pull-left">'+
            '<img alt="image" width="30" class="img-circle" src="/images/trainerImages/'+image+'">'+
            '</a>'+
            '<div class="media-body">'+
            '<strong>'+data.card_order.promo_code.trainer.name+'</strong> <br>'+
            '<p>New Card Order</p>'+
            '<small class="text-muted">'+data.card_order.created_at+'</small>'+
            '</div>'+

            '</li>'+
            '<li class="divider"></li>'+
            '</ul>'
        )
    }

});


// New Payment channel
var channel = pusher.subscribe('new-payment');
channel.bind('App\\Events\\NewPaymentEvent', function(data) {
    // alert sound
    document.getElementById('xyz').play();
    if(data.sender.image == null){
        var image = 'profile-icon.png';
    }
    else{
        var image = data.sender.image.name;
    }

    if($('.message_alert .count').length > 0){
        var count = $(document).find('.message_alert .count')[0].innerText;
        $(document).find('.message_alert .count').text(parseInt(count)+1);
        $(document).find('.message_alert ul').prepend('<li id="msg_'+data.payment.id+'">'+
                '<a href="/admin/trainers/show/'+data.sender.id+'" class="pull-left view_message">'+
                    '<img alt="image" width="30" class="img-circle" src="/images/trainerImages/'+image+'">'+
                '</a>'+
                '<div class="media-body">'+
                    '<strong>'+data.sender.name+'</strong> <br>'+
                    '<p>New Payment Request</p>'+
                    '<small class="text-muted">'+data.payment.created_at+'</small>'+
                '</div>'+
            '</li>'+
            '<li class="divider"></li>'
        );
    }
    else{
        $(document).find('.message_alert .count-info').append('<span class="label label-primary count">1</span>');

        $(document).find('.message_alert').append('<ul class="dropdown-menu dropdown-messages">'+
                '<li id="msg_'+data.payment.id+'">'+
                    '<a href="/admin/trainers/show/'+data.sender.id+'" class="pull-left view_message">'+
                        '<img alt="image" width="30" class="img-circle" src="/images/trainerImages/'+image+'">'+
                    '</a>'+
                    '<div class="media-body">'+
                        '<strong>'+data.sender.name+'</strong> <br>'+
                        '<p>New Payment Request</p>'+
                        '<small class="text-muted">'+data.payment.created_at+'</small>'+
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

    // alert sound
    document.getElementById('xyz').play();

    if($('.order_alert .count').length > 0){
        var count = $(document).find('.order_alert .count')[0].innerText;
        $(document).find('.order_alert .count').text(parseInt(count)+1);
        $(document).find('.order_alert ul').prepend('<li id="order_'+data.order.id+'">'+
                '<a href="'+BASE_URL+'/admin/orders/show/'+data.order.id+'">'+
                    '<div>'+
                        '<i class="fa fa-envelope fa-fw"></i> New order'+
                        '<span class="pull-right text-muted small">'+data.order.created_at+'</span>'+
                    '</div>'+
                '</a>'+
            '</li>'+
            '<li class="divider"></li>');
    }
    else{
        $(document).find('.order_alert .count-info').append('<span class="label label-primary count">1</span>');

        $(document).find('.order_alert').append('<ul class="dropdown-menu dropdown-alerts" style="overflow-y: scroll; max-height: 300px">'+
                '<li id="order_' + data.order.id + '">' +
                    '<a href="' + BASE_URL + '/admin/orders/show/' + data.order.id + '">' +
                        '<div>' +
                            '<i class="fa fa-envelope fa-fw"></i> New order' +
                            '<span class="pull-right text-muted small">'+data.order.created_at+'</span>'+
                        '</div>' +
                    '</a>' +
                '</li>' +
                '<li class="divider"></li>' +
            '</ul>')
    }

    if(current == BASE_URL+'/admin/orders'){
        console.log(data.order);
        if( data.order.counselor == null){
            var counselor = '';
        }
        else{
            var counselor = data.order.counselor.name ;
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
    
    // alert sound
    document.getElementById('xyz').play();

    if($('.trainer_alert .count').length > 0){

        var count = $(document).find('.trainer_alert .count')[0].innerText;
        $(document).find('.trainer_alert .count').text(parseInt(count)+1);

        $(document).find('.trainer_alert ul').prepend('<li id="trainer_'+data.trainer.id+'">'+
                '<a href="'+BASE_URL+'/admin/trainers/show/'+data.trainer.id+'" class="pull-left">'+
                    '<img alt="image" width="30" class="img-circle" src="/images/trainerImages/profile-icon.png">'+
                '</a>'+
                '<div class="media-body">'+
                    '<strong>'+data.trainer.name+'</strong>'+
                    '<p>New Trainer</p>'+
                    '<small class="text-muted">'+data.trainer.created_at+'</small>'+
                '</div>'+
            '</li>'+
            '<li class="divider"></li>');
    }
    else{
        $(document).find('.trainer_alert .count-info').append('<span class="label label-primary count">1</span>');

        $(document).find('.trainer_alert').append('<ul class="dropdown-menu dropdown-messages">'+
                '<div class="notification_block" style="overflow-y: scroll; max-height: 300px" >'+
                    '<li id="trainer_'+data.trainer.id+'">'+
                        '<a href="'+BASE_URL+'/admin/trainers/show/'+data.trainer.id+'" class="pull-left">'+
                            '<img alt="image" width="30" class="img-circle" src="/images/trainerImages/profile-icon.png">'+
                        '</a>'+
                        '<div class="media-body">'+
                            '<strong>'+data.trainer.name+'</strong>'+
                            '<p>New Trainer</p>'+
                            '<small class="text-muted">'+data.trainer.created_at+'</small>'+
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
                        '<a href="'+BASE_URL+'/admin/trainers/show/'+data.trainer.id+'"><h3><strong>'+data.trainer.name+'</strong></h3> </a>'+
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
