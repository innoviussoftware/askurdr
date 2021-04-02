@extends('layouts.front')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{ asset('public/js/style.css') }}"/>
<div class="top1">
  <h1>Video calling</h1>
</div>

<div class="container">

  <div id="chromeFileWarning" class="frame big">
    <b style="color: red;">Warning!</b> Protocol "file" used to load page in Chrome.<br><br>
    Please avoid loading files directly from disk when developing WebRTC applications using Chrome.<br>
    Chrome disables access to microphone which prevents proper functionality.<br>
    <br>
    You can allow working with "file:", if you start Chrome with the flag <i>--allow-file-access-from-files</i>
  </div>

  <div class="clearfix"></div>

  <div class="frame small">
    <div class="inner loginBox">
      <h3 id="login">Sign in</h3>
      <form id="userForm">
        <input id="username" placeholder="USERNAME"><br>
        <input id="password" type="password" placeholder="PASSWORD"><br>
        <button id="loginUser">Login</button>
        <button id="createUser">Create</button>
      </form>
      <div id="userInfo">
        <h3><span id="username"></span></h3>
        <!-- <button id="logOut">Logout</button> -->
      </div>
    </div>
  </div>

  <div class="frame">
    <h3>Video Call</h3>
    <div id="call">
      <form id="newCall">
        <input id="callUserName" placeholder="Username (alice)" type="hidden" value="{{ $mobile }}"><br>
        <button id="call">Call</button>
        <button id="hangup">Hangup</button>
        <button id="answer">Answer</button>

      </form>
    </div>
    <div class="clearfix"><br></div>
    <video id="videooutgoing" autoplay muted></video>
    <video id="videoincoming" autoplay></video>

    <div id="callLog">
    </div>
    <div class="error">
    </div>
  </div>
</div>

<script src="{{ asset('public/js/sinch.min.js') }}"></script>
<script src="{!! asset('public/js/VIDEOsample.js') !!}"></script>
<script type="text/javascript">
    // $( "#logOut" ).trigger( "click" );
    //console.log(sessionObj.userId);
// $(document).ready(function () {
//     $( "button#call" ).trigger( "click" );
// });
</script>
@endsection
