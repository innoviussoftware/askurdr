@extends('layouts.front')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('public/semantic/dist/semantic.min.css') }}">

<div id='content' class="container col-md-10 col-md-offset-1  text well" align="">
  	<div class="row">
      <div class="col-6"> 
		
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 


		    <link rel="stylesheet" type="text/css" href="{{ asset('public/semantic/dist/semantic.min.css') }}">

		    <style type="text/css">
		    
		    [v-cloak] {
		      display: none;
		    }
		    </style>

		    </script>
			</head>

			<body>

			    <div id="app" class="ui main container">
			         <div class="ui grid">
			            <div class="row">
			                <div class="col-xs-12">
			                    <div class="ui segment" style="padding: 1.5em 1.5em;">
			                        <div class="ui comments" style="max-width: 100%;">
			                            <h3 class="ui dividing header"><i class="talk outline icon"></i> Conversion with {{ $receptorUser->first_name }} {{ $receptorUser->last_name }}</h3>
			                            <!-- <firebase-messages user-id="{{ Auth::user()->id }}" chat-id="{{ Auth::user()->id }}-{{$receiver_id}}" receptor-id="{{$receiver_id}}" receptor-name="{{ $receptorUser->first_name }}" ></firebase-messages> -->
			                            <!-- <firebase-messages user-id="{{ Auth::user()->id }}" chat-id="{{$chat->id}}" receptor-name="{{ $receptorUser->first_name }}" receptor-id="{{$receiver_id}}" sender-id="{{$user->id}}" sender-name="{{$user->first_name}}"></firebase-messages> -->



			                            <!-- <firebase-messages user-id="{{ Auth::user()->id }}" chat-id="{{ $sender_id }}-{{$receiver_id}}" receptor-name="{{ $receptorUser->first_name }}" receptor-id="{{$receiver_id}}"sender-name="{{$sender_name}}"></firebase-messages> -->

			                            <firebase-messages user-id="{{$receiver_id}}" chat-id="{{$chat->id}}" receptor-name="{{ $receptorUser->first_name }}" receptor-id="{{ Auth::user()->id }}" sender-id="{{ Auth::user()->id }}" sender-name="{{ Auth::user()->first_name }}"></firebase-messages>
			                        </div>
			                    </div>
			                    
			                </div>
			            </div>
			        </div>
			    </div>

			    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
			    <script src="{{ asset('semantic/dist/semantic.min.js') }}"></script>
			    <script>
			        $(document).ready(function(){
			            $('.special.cards .image').dimmer({
			                on: 'hover'
			            });
			            $('#logoutButton').click(function(){
			                $('#logoutModal').modal('show');
			            })
			        });
			        
			    </script>

			    <script src="https://www.gstatic.com/firebasejs/4.5.0/firebase.js"></script>

			    <!-- <script>
			        // Initialize Firebase
			        var config = {
			          apiKey: "AIzaSyCoh6HJW49zKA1QKoRl8slr1ZlIDqqZNZI",
			          authDomain: "e-clinic-5e825.firebaseapp.com",
			          databaseURL: "https://e-clinic-5e825.firebaseio.com",
			          projectId: "e-clinic-5e825",
			          storageBucket: "e-clinic-5e825.appspot.com",
			          messagingSenderId: "299960919376"
			        };
			        console.log(config);
			        firebase.initializeApp(config);

			        const database = firebase.database();
			    </script> -->
			    <script>
			        // Initialize Firebase
			        var config = {
			          apiKey: "AIzaSyDpnCc8oZlCbasRi_WZnHbcQ2khqLaBzIM",
			          authDomain: "askurdr-21669.firebaseio.com",
			          databaseURL: "https://askurdr-21669.firebaseio.com",
			          projectId: "askurdr-21669",
			          storageBucket: "askurdr-21669.appspot.com",
			          messagingSenderId: "511461187867"
			        };
			        console.log(config);
			        firebase.initializeApp(config);

			        const database = firebase.database();
			    </script>
			    <script src="{{ asset('public/js/myapp.js') }}"></script>

			</body>
			


      </div>

  	</div>

  </div>
</div>
<script>
    $(document).ready(function() {
        $(".ui.blue.labeled.submit.icon.button").click(function(e) {
		    // e.preventDefault();
		    // alert("Asd");
		    var receiveris = "{{$receiver_id}}";
		    $.ajax({
		        type: "get",
		        url: "{{ Route('front.home.sendpushnotification') }}",
		        data: { 
		            id: receiveris
		        },
		        success: function(result) {
		        	// $('.dravstatus').text(result);
		        },
		        error: function(result) {
		            // alert('error');
		        }
		    });
		});
    });
    </script>

@endsection
