

var connection = new RTCMultiConnection();

// this line is VERY_important
connection.socketURL = 'https://rtcmulticonnection.herokuapp.com:443/';

// all below lines are optional; however recommended.

connection.session = {
    audio: true,
    video: true
};

connection.sdpConstraints.mandatory = {
    OfferToReceiveAudio: true,
    OfferToReceiveVideo: true
};

connection.onstream = function(event) {
    document.body.appendChild( event.mediaElement );
};

var RoomId = document.getElementById('txt-roomid');

RoomId.value=connection.token();

document.getElementById('btn-open-room').onclick = function() {
    this.disabled = true;
    connection.open( RoomId.value|| 'predefinedRoomId' );
    var room_number=RoomId.value;

    // var details = "<?php echo URL::to('front/call'); ?>";
    // alert(details);
    $.ajax({
                                 type:'get',
                                 url: url('/front/call'),
                                 data: {
                                  room_number: room_number,
                                },
                                 success:function(data){
                                  
                                  }
    });
};

document.getElementById('btn-join-room').onclick = function() {
    this.disabled = true;
    connection.join(RoomId.value|| ' predefinedRoomId ');
};