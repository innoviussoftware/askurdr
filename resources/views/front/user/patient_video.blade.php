@extends('layouts.front')

@section('content')

    <style type="text/css">
      video {
  background-color: #ddd;
  border-radius: 7px;
  margin: 10px 0px 0px 10px;  width: 320px;
  height: 240px;
}
button {
  margin: 5px 0px 0px 10px !important;
  width: 654px;
}
    </style>
  </head>
<div id='content' class="container col-md-10 col-md-offset-1  text well" align="">
    <body>
    <!-- <video id="localVideo" autoplay playsinline></video>
    <video id="remoteVideo" autoplay playsinline></video> -->
    <div>
      <input type="text" name="" id="txt-roomid">
      <input type="hidden" name="userid" id="userid" value="{{$user_id}}">
    </div>
    <div>
          <button id="btn-open-room">Open Room</button>
          <button id="btn-join-room">Join Room</button><hr>
    </div>

    <script src="https://rtcmulticonnection.herokuapp.com/dist/RTCMultiConnection.min.js"></script>
    <script src="https://rtcmulticonnection.herokuapp.com/socket.io/socket.io.js"></script>
    <script src="{!! asset('public/js/main-2.js') !!}"></script>

    </body>
</div>
<script type="text/javascript">
   

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

    var details = "<?php echo URL::to('front/call'); ?>";
    var userid =$('#userid').val();
    
    $.ajax({
          type:'get',
          url: details,
          data: {
              room_number: room_number,
              user_id:userid,
          },
          success:function(data){
              console.log(data)
          }
    });
};

document.getElementById('btn-join-room').onclick = function() {
    this.disabled = true;
    connection.join(RoomId.value|| ' predefinedRoomId ');
};
</script>
@endsection