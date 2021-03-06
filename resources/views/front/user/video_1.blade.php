@extends('layouts.front')

@section('content')

    <style type="text/css">
      video {
  background-color: #ddd;
  border-radius: 7px;
  margin: 10px 0px 0px 10px;
  width: 320px;
  height: 240px;
}
button {
  margin: 5px 0px 0px 10px !important;
  width: 654px;
}
    </style>
  
  <script type="text/javascript" src="https://api.bistri.com/bistri.conference.min.js"></script>
  <script type="text/javascript">
    /*
    JS library reference:
    http://developers.bistri.com/webrtc-sdk/js-library-reference
*/

var room;
var members;
var localStream;

// when Bistri API client is ready, function
// "onBistriConferenceReady" is invoked
onBistriConferenceReady = function () {

    // test if the browser is WebRTC compatible
    if ( !bc.isCompatible() ) {
        // if the browser is not compatible, display an alert
        alert( "your browser is not WebRTC compatible !" );
        // then stop the script execution
        return;
    }

    // initialize API client with application keys
    // if you don't have your own, you can get them at:
    // https://api.developers.bistri.com/login
    bc.init( {
        "appId": "500f03c8",
        "appKey": "f3099079122e50669848cf39a7085fa9"
    } );
    
    /* Set events handler */

    // when local user is connected to the server
    bc.signaling.bind( "onConnected", function () {
        // show pane with id "pane_1"
        showPanel( "pane_1" );
    } );

    // when an error occured on the server side
    bc.signaling.bind( "onError", function ( error ) {
        // display an alert message
        alert( error.text + " (" + error.code + ")" );
    } );

    // when the user has joined a room
    bc.signaling.bind( "onJoinedRoom", function ( data ) {
        // set the current room name
        room = data.room;
        members = data.members;
        // ask the user to access to his webcam
        bc.startStream( "webcam-sd", function( stream ){
            // affect stream to "localStream" var
            localStream = stream;
            // when webcam access has been granted
            // show pane with id "pane_2"
            showPanel( "pane_2" );
            // insert the local webcam stream into div#video_container node
            bc.attachStream( stream, q( "#video_container" ), { mirror: true } );
            // then, for every single members present in the room ...
            for ( var i=0, max=members.length; i<max; i++ ) {
                // ... request a call
                bc.call( members[ i ].id, room, { "stream": stream } );
            }
        } );
    } );

    // when an error occurred while trying to join a room
    bc.signaling.bind( "onJoinRoomError", function ( error ) {
        // display an alert message
       alert( error.text + " (" + error.code + ")" );
    } );
    
    // when the local user has quitted the room
    bc.signaling.bind( "onQuittedRoom", function( room ) {
        // stop the local stream
        bc.stopStream( localStream, function(){
            // remove the stream from the page
            bc.detachStream( localStream );
            // show pane with id "pane_1"
            showPanel( "pane_1" );
        } );
    } );
    
    // when a new remote stream is received
    bc.streams.bind( "onStreamAdded", function ( remoteStream ) {
        // insert the new remote stream into div#video_container node
        bc.attachStream( remoteStream, q( "#video_container_2" ) );
    } );
    
    // when a remote stream has been stopped
    bc.streams.bind( "onStreamClosed", function ( stream ) {
        // remove the stream from the page
        bc.detachStream( stream );
    } );
    
    // when a local stream cannot be retrieved
    bc.streams.bind( "onStreamError", function( error ){   
        switch( error.name ){
            case "PermissionDeniedError":
                alert( "Webcam access has not been allowed" );
                bc.quitRoom( room );
                break
            case "DevicesNotFoundError":
                if( confirm( "No webcam/mic found on this machine. Process call anyway ?" ) ){
                    // show pane with id "pane_2"
                    showPanel( "pane_2" );
                    for ( var i=0, max=members.length; i<max; i++ ) {
                        // ... request a call
                        bc.call( members[ i ].id, room );
                    }
                }
                else{
                    bc.quitRoom( room );  
                }
                break
        }
    } );

    // bind function "joinConference" to button "Join Conference Room"
    q( "#join" ).addEventListener( "click", joinConference );
    
    // bind function "quitConference" to button "Quit Conference Room"
    q( "#quit" ).addEventListener( "click", quitConference );
    
    // open a new session on the server
    bc.connect();
}

// when button "Join Conference Room" has been clicked
function joinConference(){
    //var roomToJoin = "123";
    var user_id  =  $('#user_id'). val();
    var login_id =  $('#login_id').val();
    var roomToJoin= login_id.concat(user_id);
    
    if(user_id==login_id)
    {
       bc.joinRoom( roomToJoin );
    }
    else if(user_id!=login_id)
    {
      bc.joinRoom( roomToJoin );
    }
    else{
      alert( "you must enter a room name !" )
    }

    // // if "Conference Name" field is not empty ...
    // if( roomToJoin ){
    //     // ... join the room
    //     bc.joinRoom( roomToJoin );
    // }
    // else{
    //     // otherwise, display an alert
    //     alert( "you must enter a room name !" )
    // }  
}

// when button "Quit Conference Room" has been clicked
function quitConference(){
    // quit the current conference room
    bc.quitRoom( room );
}

function showPanel( id ){ 

    var panes = document.querySelectorAll( ".pane" );
    // for all nodes matching the query ".pane"
    for( var i=0, max=panes.length; i<max; i++ ){
        // hide all nodes except the one to show
        panes[ i ].style.display = panes[ i ].id == id ? "block" : "none";
    };
}

function q( query ){
    // return the DOM node matching the query
    return document.querySelector( query );
}
  </script>
  <div id='content' class="container col-md-10 col-md-offset-1  text well" align="">

        <div class="pane" id="pane_1" style="display: block">
            <br>
            <input type="button" value="Join Video Call" id="join" class="btn btn-lg btn-success">
        </div>
        <?php $id=Auth::user()->id?>
      
        <input type="hidden" name="user_id" id="login_id" value="{{$id}}">
      <input type="hidden" name="id" id="user_id" value="{{$user_id}}">
        <div class=" pane" id="pane_2" style="display: none">
            <div id="video_container"></div>
            <div id="video_container_2"></div>
            <input type="button" value="Quit Conference Room" id="quit" class="btn btn-danger btn-default btn-block">
            <iframe src="https://example.com" allow="geolocation"></iframe>
        </div>
</div>
@endsection