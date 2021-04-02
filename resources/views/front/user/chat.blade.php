@extends('layouts.front')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('public/semantic/dist/semantic.min.css') }}">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.js"></script> -->
<style type="text/css">
  .ui-autocomplete-loading { background:url(http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/images/ui-anim_basic_16x16.gif) no-repeat right center }
  .ui-autocomplete{
    top: 805px !important;
    left: 191px !important;
  }
  #ui-id-1{
    top: 805px !important;
    left: 191px !important;
  }
</style>

<!-- <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
      <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script> -->
      <link href = "https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.6/chosen.css"
         rel = "stylesheet">
      
      <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.js"></script>
<div id='content' class="container col-md-10 col-md-offset-1  text well" align="">
  	<div class="row">
      <div class="col-6"> 
		
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 


		    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('public/semantic/dist/semantic.min.css') }}">
 -->
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



			                            <firebase-messages user-id="{{ Auth::user()->id }}" chat-id="{{$receiver_id}}-{{ $sender_id }}" receptor-name="{{ $receptorUser->first_name }}" receptor-id="{{$receiver_id}}" sender-name="{{Auth::user()->first_name}}"></firebase-messages>

			                            <!-- <firebase-messages user-id="{{$receiver_id}}" chat-id="{{$chat->id}}" receptor-name="{{ $receptorUser->first_name }}" receptor-id="{{ Auth::user()->id }}" sender-id="{{ Auth::user()->id }}" sender-name="{{ Auth::user()->first_name }}"></firebase-messages> -->
			                        </div>
			                    </div>
			                    
			                </div>
			            </div>
			        </div>
			         <div class="row">
			    	<div class="col-md-12">
			    		

                    <div class="row">
                      <div class="col-12"> 
                                  @if (count($errors) > 0)
                                    <div class="alert alert-danger" id="error">
                                      <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                      <ul>
                                         @foreach ($errors->all() as $error)
                                           <li>{{ $error }}</li>
                                         @endforeach
                                      </ul>
                                    </div>
                                  @endif
                                  @if(session()->has('success'))
                                      <div class="alert alert-success">
                                          {{ session()->get('success') }}
                                      </div>
                                  @endif
                      </div>
                      <div class="col-md-12">
                        <div class="" id="serverMsg"></div>
                      </div>
                      <?php 
                      $id = auth()->user()->id;
                      ?>
                      
                      <form method="post" action="{{ route('front.home.emrChatUserStore') }}" enctype="multipart/form-data" id="emr_form">
                              @csrf
                              <input type="hidden" name="type_visit" value="{{$type_visit}}">
                      <div class="col-md-6">
                        
                              <input type="hidden" name="doctor_id" value="{{$sender_id}}" id="doctor_id">
                              <input type="hidden" name="patient_id" value="{{$receiver_id}}" id="doctor_id">
                                  <div class="form-group col-md-12">
                                    <label for="inputEmail4">EMR Number</label>
                                    <input type="text" class="form-control" id="inputEmail4" placeholder="EMR No" value="{{$emr_number}}" name="emrno" readonly="">
                                  </div>
                                
                                  <div class="col-md-12">
                                     <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <b>{{$type_visit}}</b>
                                            </div>
                                            <div class="panel-body">
                                                 <div class="form-group col-md-12">
                                                    <label for="inputAddress">Physican Note</label>
                                                    <textarea class="form-control" placeholder="Add Note" name="physicannote"></textarea>
                                                  </div>

                                                  <div class="form-group col-md-12">
                                                    <label for="inputAddress">Physican Diagnosis</label>
                                                    <input type="text" class="form-control" id="automplete-1" placeholder="Physican Diagnosis" value="" name="physicandiagnosis">
                                                    <div class="id"></div>
                                                  </div>
                                                  <div class="col-md-12">
                                      <div class="panel panel-default">
                                            <div class="panel-heading">
                                                  <b>Prescriptions</b>
                                            </div>
                                            <div class="panel-body">
                                                  <div class="Prescriptionnew" id="newprsc">
                                                              <div class="form-group row">
                                                                <div class="col-xs-9 -col-sm-6 col-md-10">

                                                                  <!-- selectpicker remove  class -->
                                                                      <select class="form-control form-control-sm required medicines_select chosen" title="Search Medicines" name="medicines[]" id="medicines0" data-count="0" data-live-search="true" data-live-search-style="startsWith">
                                                                        <option value="">Select Medicines</option>
                                                                        <option value="others">Others</option>
                                                                        <?php if(isset($medicines)){?>
                                                                      @foreach($medicines as $medicine)
                                                                        <option value="{{$medicine->id }}">{{ $medicine->name }}</option>
                                                                      @endforeach
                                                                    <?php }?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-xs-3 col-sm-6 col-md-2">
                                                                   <button type="button" style="" class="add_prsc btn btn-primary"><i class="fa fa-plus"></i></button>
                                                                </div>
                                                                <div class="col-xs-9 -col-sm-6 col-md-10" style="display: none;" id="medicines_select_textbox0" data-count="0">
                                                                  <input type="text" name="medicinestext[]" value=""  placeholder="Enter the Medicines">
                                                                </div>
                                                              </div>

                                                              <div class="disprecord dc0">
                                                                <div class="form-group row">
                                                                  
                                                                  <div class="col-sm-6">
                                                                    
                                                                      <input type="text" name="dose[]" class="form-control form-control-sm dose" value="" id="dose0" placeholder="Dose">
                                                                    
                                                                  </div>
                                                                  <div class="col-sm-4">
                                                                    
                                                                       <select class="form-control form-control-sm required dosetype" title="Search Medicines" name="dosetype[]" id="medicines0" data-count="0" >
                                                                        <option value="">Select Dose</option>
                                                                        <option value="mg">Mg</option>
                                                                        <option value="ml/g">ml/g</option>
                                                                        <option value="mcg">mcg</option>
                                                                       </select>
                                                                    
                                                                  </div>
                                                                </div>

                                                                

                                                                <div class="form-group row">
                                                                  <label for="staticEmail" class="col-sm-12 col-form-label col-form-label-sm">Frequency:</label>
                                                                  
                                                                </div>
                                                                <div class="form-group row">
                                                                <div class="col-sm-3">
                                                                    
                                                                      <input type="text" name="frequency1[]" class="form-control form-control-sm frequency1" value="" id="frequency10" placeholder="Morning">
                                                                    
                                                                  </div>
                                                                  <div class="col-sm-3">
                                                                    
                                                                      <input type="text" name="frequency2[]" class="form-control form-control-sm frequency2" value="" id="frequency20" placeholder="Noon">
                                                                  </div>
                                                                  <div class="col-sm-3">
                                                                    
                                                                      <input type="text" name="frequency3[]" class="form-control form-control-sm frequency3" value="" id="frequency30" placeholder="Night">
                                                                    
                                                                  </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                  <div class="col-sm-10">
                                                                    
                                                                      <input type="number" name="duration[]" class="form-control form-control-sm duration" value="" id="duration0" placeholder="Duration">
                                                                    
                                                                  </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                  <div class="col-sm-10">
                                                                      <input type="text" name="route[]" class="form-control form-control-sm route" value="" id="duration0" placeholder="Route">
                                                                  </div>
                                                                </div>

                                                            </div>
                                                      </div>
                                            </div>
                                      </div>

                                      <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <b>Investigation</b>
                                            </div>
                                            <div class="panel-body">
                                              <div class="Investnew" id="newinvestment">
                                                              <div class="form-group row">
                                                                
                                                                <div class="col-xs-9 col-sm-8 col-md-10">
                                                                  
                                                                      <select class="form-control form-control-sm required investigation_select" title="Search Medicines" name="investigation[]" id="investigation" data-count="0">
                                                                        <option value="">Select Investigation</option>
                                                                        <option value="others">Others</option>
                                                                         <?php if(isset($documentType)){?>
                                                                      @foreach($documentType as $document)
                                                                        <option value="{{$document->id }}">{{ $document->name }}</option>
                                                                      @endforeach
                                                                    <?php }?>
                                                                    </select>
                                                                </div>
                                                                
                                                                <div class="col-xs-3 col-sm-4 col-md-2">
                                                                   <button type="button" style="" class="add_invest btn btn-primary"><i class="fa fa-plus"></i></button>

                                                                </div>
                                                                <div class="col-xs-9 -col-sm-6 col-md-10" style="display: none;" id="investigationtext0" data-count="0">
                                                                    <input type="text" name="investigationtext[]" value=""  placeholder="Enter the Investigation">
                                                                </div>
                                                              </div>
                                                              <div class="form-group row">
                                                <div class="col-xs-12 col-sm-12 col-md-10">
                                                  <select class="form-control form-control-sm required select_subinvestigation"  title="Search Investigation" name="subinvestigation[]" id="subinvestigationselectbox0" data-count="0">
                                                        <option value="">Select Subinvestigation</option>
                                                    </select>
                                                </div>
                                              </div>

                                              <div class="form-group row" style="display: none;" id="investigation_select_textbox0" data-count="0">
                                                <div class="col-xs-12 -col-sm-12 col-md-10" style="display: none;" id="subinvestigationtext0" data-count="0">
                                                   <input type="text" name="subinvestigationtext[]" value=""  placeholder="Enter the Subinvestigation">
                                                </div>
                                              </div>
                                                              <div class="form-group  row">
                                                                  <div class="col-xs-9 col-sm-8 col-md-10">
                                                                      
                                                                          
                                                                          <textarea class="form-control notes" placeholder="Add notes" name="notes[]"></textarea>
                                                                    </div>
                                                              </div>
                                              </div>
                                            </div>
                                      </div>

                                      <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <b>Referral</b>
                                            </div>
                                            <div class="panel-body">
                                                <div class="referralnew" id="newreferral">
                                                  <div class="disprecord">
                                                          <div class="form-group row">
                                                                <div class="col-xs-9 col-sm-8 col-md-10">
                                                                      <select class="form-control form-control-sm required medicines_change referral_select" title="Search Medicines" name="referral[]" id="medicines0" data-count="0">
                                                                        <option value="">Select Speciality of doctor</option>
                                                                        <?php if(isset($specialitys)){?>
                                                                        @foreach($specialitys as $speciality)
                                                                          <option value="{{$speciality->id }}">{{ $speciality->name }}</option>
                                                                        @endforeach
                                                                        <?php }?>
                                                                      </select>
                                                                </div>
                                                                <div class="col-xs-3 col-sm-4 col-md-2">
                                                                   <button type="button" style="" class="add_ref btn btn-primary"><i class="fa fa-plus"></i></button>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-xs-12 col-sm-12 col-md-10">
                                                                  <select class="form-control form-control-sm required select_doctor"  title="Search Medicines" name="doctor[]" id="doctordata0" data-count="0">
                                                                        <option value="">Select doctor</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-xs-12 col-sm-12 col-md-10">
                                                                    <textarea class="form-control diagnosis" placeholder="Write diagnosis" name="diagnosis[]"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-xs-12 col-sm-12 col-md-10">
                                                                    <textarea class="form-control reasonreferral" placeholder="Reason for referral" name="referraldetails[]"></textarea>
                                                                </div>
                                                            </div>
                                                  </div>
                                                </div>
                                            </div>
                                      </div>
                                  <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="{{route('front.home.emr')}}" class="btn btn-primary">Cancel</a>
                                      </div>
                                  </div>
                                            </div>
                                      </div>
                                  </div> 
                                  

                                  

                                   
                             
                      </div>
                      </form>
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
<script>
  var availableTutorials2 = [];
        $(function() {
         
            $( "#automplete-1" ).autocomplete({
               source: function( request, response ) {
   
                     $.ajax({
                      url: "<?php echo URL::to('front/icd_record'); ?>",
                      type: 'get',
                      dataType: "json",
                      data: {
                       doctor_id: request.term.split( /,\s*/ ).pop()
                      },
                      success: function( data ) {
                        
                            response( data );
                            setTimeout(function(){handler(request, response);}, 1000);

                      }
                     });
                    },
                   
                    select: function (event, ui) {
                     // Set selectionalert
                      $('#automplete-1').val(ui.item.label); 

                     return false;
                    }

            });
         });

</script>
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

              const messaging = firebase.messaging();

              // messaging.setBackgroundMessageHandler(function(payload) {
              //   console.log('[firebase-messaging-sw.js] Received background message ', payload);
              //   // Customize notification here
              //   const notificationTitle = 'Background Message Title';
              //   const notificationOptions = {
              //     body: 'Background Message body.',
              //     icon: '/itwonders-web-logo.png'
              //   };

              //   return self.registration.showNotification(notificationTitle,
              //       notificationOptions);
              // });

              messaging.onMessage(function(payload) {
                  console.log("onMessage: ", payload);
                  navigator.serviceWorker.getRegistration('/firebase-cloud-messaging-push-scope').then(registration => {
                      registration.showNotification(
                          payload.notification.title,
                          payload.notification
                      )
                  });
              });

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

<script type="text/javascript">
   $(function() {
    $("body").on("submit","#emr_form",function (e){
      e.preventDefault();
      var datastring = $(this).serialize();
      $(".btn-primary").prop('disabled', true);
      $.ajax({
        url:"{{ route('front.home.emrChatUserStore') }}",
        type:'post',
        data:datastring,
        success: function(e){
          $("#serverMsg").removeClass('alert alert-danger');
          $("#serverMsg").addClass('alert alert-success');
          $("#serverMsg").html("<p>Successfully submitted.</p>");
          $("#emr_form")[0].reset();
          window.scrollTo(0, 0);
           $(".btn-primary").removeAttr("disabled"); 
        },
        error: function(e){
          console.log("error");
          console.log(e);
          if(e.status == 422){
            var html = "";
            for(var i = 0; i < e.responseJSON.errors.length; i++ ){
              html += "<p>"+e.responseJSON.errors[i]+"</p>";
            }
          }
          $("#serverMsg").removeClass('alert alert-success');
          $("#serverMsg").addClass('alert alert-danger');
          $("#serverMsg").html(html);
          $(".btn-primary").prop('disabled', false);
          window.scrollTo(0, 0);
        }
      });
    });
  });
     var count = 1;   

        $('body').on('click', '.add_ref', function () {

          // $('#newreferral').append('<div class="disprecord"><div class="box-body"><div class="form-group row"><div class="col-xs-9 col-sm-8 col-md-10"><select class="form-control form-control-sm required medicines_change referral_select" title="Search Medicines" name="referral[]" id="medicines'+count+'" data-count="'+count+'"><option value="">Select Speciality of doctor</option> <?php if(isset($specialitys)){?>@foreach($specialitys as $speciality)<option value="{{$speciality->id }}">{{ $speciality->name }}</option>@endforeach<?php }?></select></div><div class="col-xs-3 col-sm-4 col-md-2"><button type="button" style="" class="remove_ref btn btn-primary"><i class="fa fa-minus"></i></button></div></div><div class="form-group row"><div class="col-xs-12 col-sm-12 col-md-10"><select class="form-control form-control-sm required select_doctor" title="Search Medicines" name="doctor[]" id="doctordata'+count+'" data-count="0"><option value="">Select doctor</option></select></div></div><div class="form-group row"><div class="col-xs-12 col-sm-12 col-md-10"><textarea class="form-control diagnosis" placeholder="Write diagnosis" name="diagnosis[]"></textarea></div></div><div class="form-group row"><div class="col-xs-12 col-sm-12 col-md-10"><textarea class="form-control reasonreferral" placeholder="Reason for referral" name="referraldetails[]"></textarea></div></div></div></div>');
            count ++;
        });

        $('body').on('click', '.remove_ref', function (e) {            
             $(this).closest('.box-body').remove();
             
        });


        $('body').on('click', '.add_invest', function () {

          // $('#newinvestment').append('<div class="box-body"><div class="form-group row"><div class="col-xs-9 col-sm-8 col-md-10"><select class="form-control form-control-sm required investigation_select" title="Search Medicines" name="investigation[]" id="medicines0" data-count="0"><option value="">Select Investigation</option><?php if(isset($investigations)){?>@foreach($investigations as $investigation)<option value="{{$investigation->id }}">{{ $investigation->testname_english }}</option>@endforeach<?php }?></select></div><div class="col-xs-3 col-sm-4 col-md-2"><button type="button" style="" class="remove_invest btn btn-primary"><i class="fa fa-minus"></i></button></div></div><div class="form-group  row"><div class="col-xs-9 col-sm-8 col-md-10"><textarea class="form-control notes" placeholder="Add notes" name="notes[]"></textarea></div></div></div>');
            
            count ++;
        });

        $('body').on('click', '.remove_invest', function (e) {            
             $(this).closest('.box-body').remove();
             
        });
        
        
        $('body').on('click', '.add_prsc', function () {

          // $('#newprsc').append('<div class="box-body"><div class="form-group row"><div class="col-xs-9 -col-sm-6 col-md-10"><select class="form-control form-control-sm required medicines_select chosen" title="Search Medicines" name="medicines[]" id="medicines'+count+'" data-count="'+count+'"><option value="">Select Medicines</option><?php if(isset($medicines)){?>@foreach($medicines as $medicine)<option value="{{$medicine->id }}">{{ $medicine->name }}</option>@endforeach<?php }?></select></div><div class="col-xs-3 col-sm-6 col-md-2"><button type="button" style="" class="remove_prsc btn btn-primary"><i class="fa fa-minus"></i></button></div></div><div class="disprecord dc'+count+'"><div class="form-group row"><div class="col-sm-6"><input type="text" name="dose[]" class="form-control form-control-sm dose" value="" id="dose0" placeholder="Dose"></div><div class="col-sm-4"><select class="form-control form-control-sm required dosetype" title="Search Medicines" name="dosetype[]" id="medicines0" data-count="0" ><option value="">Select Dose</option><option value="mg">Mg</option><option value="ml/g">ml/g</option><option value="mcg">mcg</option></select></div></div><div class="form-group row"><label for="staticEmail" class="col-sm-12 col-form-label col-form-label-sm">Frequency:</label></div><div class="form-group row"><div class="col-sm-3"><input type="text" name="frequency1[]" class="form-control form-control-sm frequency1" value="" id="frequency10" placeholder="Morning" ></div><div class="col-sm-3"><input type="text" name="frequency2[]" class="form-control form-control-sm frequency2" value="" id="frequency20" placeholder="Noon"></div><div class="col-sm-3"><input type="text" name="frequency3[]" class="form-control form-control-sm frequency3" value="" id="frequency30" placeholder="Night" ></div></div><div class="form-group row"><div class="col-sm-10"><input type="number" name="duration[]" class="form-control form-control-sm duration" value="" id="duration0" placeholder="Duration" ></div></div><div class="form-group row"><div class="col-sm-10"><input type="text" name="route[]" class="form-control form-control-sm route" value="" id="duration0" placeholder="route" ></div></div></div></div>');
            
            count ++;
        });
        $('body').on('click', '.remove_prsc', function (e) {            
             $(this).closest('.box-body').remove();
             
        });

        $(function() {
          
            $("body").on("change",".medicines_change", function(){
             
                      var id=$(this).attr('id');
                      
                      $('.disprecord').addClass(id);

                      var speciality_id = $(this).val();

                      
                      var count=$(this).data('count');
 
                      var details = '<?php echo URL::to('front/specialitywisedoctor'); ?>';
                      if(speciality_id)
                      {
                        $.ajax({
                               type:'get',
                               url:details,
                               data: {
                                speciality_id: speciality_id,
                                count:count,
                                id:id
                              },
                               success:function(data){
                                    $('#doctordata'+count).empty();
                                    $('#doctordata'+count).append('<option value="">Select Doctor</option>');
                                     $.each(data, function( index, value ) {
                                        
                                              $('#doctordata'+count).append('<option value="' + value.doctor_id + '">'+ value.first_name +'</option>');
                                     });
                              }
                      });
                      }
                      else
                      {
                         $('#doctordata'+count).empty();
                          $('#doctordata'+count).append('<option value="">Select Doctor</option>');
                      }
                      
            });
      });
        
//Medicines Select
$(function() {
            $("body").on("change",".medicines_select", function(){

                    var selected = $(this).val();
                    var dc = $(this).attr("data-count");

                    if(selected)
                    {
                          var mdetails = '<?php echo URL::to('front/medicalrecord'); ?>';
                          $.ajax({
                            type:'get',
                            url:mdetails,
                            data: {
                              medicines: selected
                            },
                            success:function(data){
                              console.log(data.dose);
                              $(".dc"+dc+" .dose").val(data.dose);
                              $(".dc"+dc+" .route").val(data.route);
                            }
                          });
                          $(".dose").prop('required',true);
                          $(".dosetype").prop('required',true);
                          $(".frequency1").prop('required',true);
                          $(".frequency2").prop('required',true);
                          $(".frequency3").prop('required',true);
                          $(".duration").prop('required',true);
                          $(".route").prop('required',true);
                    }
                    else
                    {
                          $(".dose").prop('required',false);
                          $(".dosetype").prop('required',false);
                          $(".frequency1").prop('required',false);
                          $(".frequency2").prop('required',false);
                          $(".frequency3").prop('required',false);
                          $(".duration").prop('required',false);
                          $(".route").prop('required',false);
                    }
                    
            });
});
//Investigation Select
$(function() {
            $("body").on("change",".investigation_select", function(){

                    var selected = $(this).val();
                    if(selected)
                    {
                        $(".notes").prop('required',true);  
                    }
                    else
                    {
                        $(".notes").prop('required',false);
                    }

                    
            });
});
//Refferal Select
$(function() {
            $("body").on("change",".referral_select", function(){
                    var selected = $(this).val();
                    if(selected)
                    {
                        $(".select_doctor").prop('required',true);
                        $(".diagnosis").prop('required',true);
                        $(".reasonreferral").prop('required',true);
                    }
                    else
                    {
                        $(".select_doctor").prop('required',false);
                        $(".diagnosis").prop('required',false);
                        $(".reasonreferral").prop('required',false);
                    }
                    
            });
});
$(function() {
            $(".chosen").chosen();
});
 $(function() {
          
            $("body").on("change",".investigation_select", function(){
             
                      var id=$(this).attr('id');
                      
                      $('.disprecord').addClass(id);

                      var investigation_id = $(this).val();

                      
                      var count=$(this).data('count');
 
                      var details = '<?php echo URL::to('front/subinvestigation'); ?>';
                      if(investigation_id)
                      {
                        $.ajax({
                               type:'get',
                               url:details,
                               data: {
                                investigation_id: investigation_id,
                                count:count,
                                id:id
                              },
                               success:function(data){
                                    $('#subinvestigation'+count).empty();
                                    $('#subinvestigation'+count).append('<option value="">Select Subinvestigation</option>');
                                     $.each(data, function( index, value ) {
                                        
                                              $('#subinvestigation'+count).append('<option value="' + value.investigation_id + '">'+ value.testname_english +'</option>');
                                     });
                              }
                      });
                      }
                      else
                      {
                         $('#subinvestigation'+count).empty();
                          $('#subinvestigation'+count).append('<option value="">Select Subinvestigation</option>');
                      }
                      
            });
});

</script>
@endsection
