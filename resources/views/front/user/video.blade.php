@extends('layouts.front')

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="{{ asset('public/js/sinch.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('public/js/style.css') }}"/>
<style type="text/css">
    div.frame{
        width: 100%;
    }
    video{
        width: 46%;
        height:auto;
    }
</style>
<body>

       <!--  <form id="authForm" method="post">
            <input type="text" id="username" placeholder="username" value="eclinicapp@gmail.com">
            <input type="password" id="password" placeholder="password" value="eclinic@1234">
            <input type="submit" value="Login" id="login">
            <input type="submit" value="Sign Up" id="signup">
        </form> -->

    <div class="top1">
        <h1>Video calling</h1>
    </div>
    
    <div class="container" style="height:50px;">

        <div id="chromeFileWarning" class="frame big">
            <b style="color: red;">Warning!</b> Protocol "file" used to load page in Chrome.<br><br>
            Please avoid loading files directly from disk when developing WebRTC applications using Chrome.<br>
            Chrome disables access to microphone which prevents proper functionality.<br>
            <br>
            You can allow working with "file:", if you start Chrome with the flag <i>--allow-file-access-from-files</i>
        </div>

        <div class="clearfix"></div>

        <div class="frame small" style="width: 0%;float: left;">
            <div class="inner loginBox" style="display:none;">
                <h3 id="login">Sign in</h3>
                <form id="userForm">
                    <?php
                        $sinchuser = App\User::find(Auth::user()->id);
                        // print_r($mobile);
                    ?>
                    <input type="hidden" value="<?php echo route('front.home.send_request',$sinchuser->mobile); ?>" id="url_details">
                    <input type="hidden" value="<?php echo route('front.home.endcall',$id); ?>" id="endcall_details">
                    
                    <input type="hidden" value="{{Auth::user()->id}}" id="user_id">
                    <input type="hidden" value="{{$id}}" id="id">
                    <input type="hidden" value="{{Auth::user()->id}}" id="role_id">
                    <input id="username" placeholder="USERNAME" value="<?php echo $sinchuser->mobile;  ?>"><br>
                    <input id="password" type="password" placeholder="PASSWORD" value="Welcome@123"><br>
                    <!-- 123456 -->
                    <button id="loginUser">Login</button>
                    <button id="createUser">Create</button>
                </form>
                <div id="userInfo">
                    <h3>Sign in</h3>
                    <h3><span id="username"></span></h3>
                    <button id="logOut">Logout</button>
                </div>
            </div>
        </div>

        <div class="frame"  style="width: 90%;float: left;">
            <h3>Video Call</h3>
            
            <div id="call">
                <form id="newCall">
                    <input id="callUserName" placeholder="Username (alice)" value="<?php echo $mobile; ?>" style="visibility: hidden;" readonly><br>
                    <button id="call">Call</button>
                    <button id="hangup">Hangup</button>
                    <button id="answer">Answer</button>
                </form>
            </div>
            <div class="clearfix"><br></div>
            <div style="width: 100%;float: left;">
                <video id="videooutgoing" autoplay muted ></video>
                <video id="videoincoming" autoplay ></video>
            </div>
            <div id="callLog">
            </div>
            <!-- <div class="error">
            </div> -->
        </div>
        
      <?php
    $user=App\User::where('id',Auth::user()->id)->first();?>
    @if($user->roles()->first()->id=='2')
        
     <style type="text/css">
  .ui-autocomplete-loading { background:url(http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/images/ui-anim_basic_16x16.gif) no-repeat right center }
</style>
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
      <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<div id='content' class="container col-md-10 col-md-offset-1  text well" align="" style="background-color:none !important;border:none !important;height:500px;overflow:scroll;">
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
        <nav aria-label="breadcrumb" style="background-color:none !important;">
                <ol class="breadcrumb">
                   @if(isset($doctors))  
                        <b><li class="breadcrumb-item active" aria-current="page"><a href="{{ route('front.home.emr') }}" class="breadcrumb-item active crumb">Update  :: EMR</a></li></b>
                    @else
                       <b><li class="breadcrumb-item active" aria-current="page"><a href="{{ route('front.home.emr') }}" class="breadcrumb-item active crumb">Add :: EMR</a></li></b> 
                  @endif
                </ol>
        </nav>
      </div>
      <?php 
      $id = auth()->user()->id;
      ?>
      <form method="post" action="{{ route('front.home.emrStore') }}" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="type_visit" value="{{$type_visit}}">
      <div class="col-md-6">
        
              <input type="hidden" name="doctor_id" value="{{$id}}" id="doctor_id">
              <input type="hidden" name="patient_id" value="{{$patient_id}}" id="doctor_id">
                  <div class="form-group col-md-12">
                    <label for="inputEmail4">EMR Number</label>
                    <input type="text" class="form-control" id="inputEmail4" placeholder="EMR No" value="{{$emr_number}}" name="emrno" readonly="">
                  </div>
                  <?php if(isset($previsit)){?>
                  <div class="col-md-12">
                     <div class="panel panel-default">
                      
                            <div class="panel-heading">
                                <b>Previsit Detail</b>
                            </div>
                            <div class="panel-body">
                              <div class="Investnew" id="newinvest">
                                
                                <input type="hidden" name="bookingform_id" value="{{$previsit->id}}">
                                              <div class="form-group row">
                                                
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                  <label>Reason for consultation:-</label>
                                                  {{$previsit->reason}}   
                                                </div>
                                                
                                                
                                              </div>
                                              <div class="form-group  row">
                                                  <div class="col-xs-12 col-sm-12 col-md-12">
                                                      <label>Details:-</label>
                                                      {{$previsit->description}} 
                                                  </div>
                                              </div>
                                              <div class="form-group  row">
                                                  <div class="col-xs-9 col-sm-8 col-md-10">
                                                      <label>Medical Report:-</label>  
                                                      <?php if($previsit->report_file){
                                                        $reports_file=explode("| ",$previsit->report_file);?>
                                                      @foreach($reports_file as $reports)  
                                                      <img src="{{env('STORAGE_FILE_PATH').'/'.$reports}}" alt="aaa" width="50px" height="auto" class="img-responsive">
                                                      @endforeach
                                                      <?php }?>
                                                      <img src="">
                                                  </div>
                                              </div>
                              </div>
                            </div>
                           
                      </div>
                  </div>
                   <?php }?>
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
                                                      <select class="form-control form-control-sm required medicines_select" title="Search Medicines" name="medicines[]" id="medicines0" data-count="0" >
                                                        <option value="">Select Medicines</option>
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
                                              </div>

                                              <div class="disprecord">
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
                                                         <?php if(isset($investigations)){?>
                                                      @foreach($investigations as $investigation)
                                                        <option value="{{$investigation->id }}">{{ $investigation->testname_english }}</option>
                                                      @endforeach
                                                    <?php }?>
                                                    </select>
                                                </div>
                                                
                                                <div class="col-xs-3 col-sm-4 col-md-2">
                                                   <button type="button" style="" class="add_invest btn btn-primary"><i class="fa fa-plus"></i></button>

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
                        <a href="{{route('front.home.emr')}}" class="btn btn-primary" style="margin-top:0.2em;">Cancel</a>
                      </div>
                  </div>
                            </div>
                      </div>
                  </div> 
                  

                  

                   
             
      </div>
      </form>
    </div>
</div>
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
<script type="text/javascript">
   
        var count = 1;

        $('body').on('click', '.add_ref', function () {

          $('#newreferral').append('<div class="disprecord"><div class="box-body"><div class="form-group row"><div class="col-xs-9 col-sm-8 col-md-10"><select class="form-control form-control-sm required medicines_change referral_select" title="Search Medicines" name="referral[]" id="medicines'+count+'" data-count="'+count+'"><option value="">Select Speciality of doctor</option> <?php if(isset($specialitys)){?>@foreach($specialitys as $speciality)<option value="{{$speciality->id }}">{{ $speciality->name }}</option>@endforeach<?php }?></select></div><div class="col-xs-3 col-sm-4 col-md-2"><button type="button" style="" class="remove_ref btn btn-primary"><i class="fa fa-minus"></i></button></div></div><div class="form-group row"><div class="col-xs-12 col-sm-12 col-md-10"><select class="form-control form-control-sm required select_doctor" title="Search Medicines" name="doctor[]" id="doctordata'+count+'" data-count="0"><option value="">Select doctor</option></select></div></div><div class="form-group row"><div class="col-xs-12 col-sm-12 col-md-10"><textarea class="form-control diagnosis" placeholder="Write diagnosis" name="diagnosis[]"></textarea></div></div><div class="form-group row"><div class="col-xs-12 col-sm-12 col-md-10"><textarea class="form-control reasonreferral" placeholder="Reason for referral" name="referraldetails[]"></textarea></div></div></div></div>');
            count ++;
        });

        $('body').on('click', '.remove_ref', function (e) {            
             $(this).closest('.box-body').remove();
             
        });


        $('body').on('click', '.add_invest', function () {

          $('#newinvestment').append('<div class="box-body"><div class="form-group row"><div class="col-xs-9 col-sm-8 col-md-10"><select class="form-control form-control-sm required investigation_select" title="Search Medicines" name="investigation[]" id="medicines0" data-count="0"><option value="">Select Investigation</option><?php if(isset($investigations)){?>@foreach($investigations as $investigation)<option value="{{$investigation->id }}">{{ $investigation->testname_english }}</option>@endforeach<?php }?></select></div><div class="col-xs-3 col-sm-4 col-md-2"><button type="button" style="" class="remove_invest btn btn-primary"><i class="fa fa-minus"></i></button></div></div><div class="form-group  row"><div class="col-xs-9 col-sm-8 col-md-10"><textarea class="form-control notes" placeholder="Add notes" name="notes[]"></textarea></div></div></div>');
            
            count ++;
        });

        $('body').on('click', '.remove_invest', function (e) {            
             $(this).closest('.box-body').remove();
             
        });
        
        
        $('body').on('click', '.add_prsc', function () {

          $('#newprsc').append('<div class="box-body"><div class="form-group row"><div class="col-xs-9 -col-sm-6 col-md-10"><select class="form-control form-control-sm required medicines_select" title="Search Medicines" name="medicines[]" id="medicines0" data-count="0"><option value="">Select Medicines</option><?php if(isset($medicines)){?>@foreach($medicines as $medicine)<option value="{{$medicine->id }}">{{ $medicine->name }}</option>@endforeach<?php }?></select></div><div class="col-xs-3 col-sm-6 col-md-2"><button type="button" style="" class="remove_prsc btn btn-primary"><i class="fa fa-minus"></i></button></div></div><div class="disprecord"><div class="form-group row"><div class="col-sm-6"><input type="text" name="dose[]" class="form-control form-control-sm dose" value="" id="dose0" placeholder="Dose"></div><div class="col-sm-4"><select class="form-control form-control-sm required dosetype" title="Search Medicines" name="dosetype[]" id="medicines0" data-count="0" ><option value="">Select Dose</option><option value="mg">Mg</option><option value="ml/g">ml/g</option><option value="mcg">mcg</option></select></div></div><div class="form-group row"><label for="staticEmail" class="col-sm-12 col-form-label col-form-label-sm">Frequency:</label></div><div class="form-group row"><div class="col-sm-3"><input type="text" name="frequency1[]" class="form-control form-control-sm frequency1" value="" id="frequency10" placeholder="Morning" ></div><div class="col-sm-3"><input type="text" name="frequency2[]" class="form-control form-control-sm frequency2" value="" id="frequency20" placeholder="Noon"></div><div class="col-sm-3"><input type="text" name="frequency3[]" class="form-control form-control-sm frequency3" value="" id="frequency30" placeholder="Night" ></div></div><div class="form-group row"><div class="col-sm-10"><input type="number" name="duration[]" class="form-control form-control-sm duration" value="" id="duration0" placeholder="Duration" ></div></div><div class="form-group row"><div class="col-sm-10"><input type="text" name="route[]" class="form-control form-control-sm route" value="" id="duration0" placeholder="route" ></div></div></div></div>');
            
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
                    if(selected)
                    {
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
</script>   
    @endif
    </div>

  

<script src="{!! asset('public/js/VIDEOsample.js') !!}"></script> 

<script type="text/javascript">
    // $( "#logOut" ).trigger( "click" );
    //console.log(sessionObj.userId);
$(document).ready(function () {
    $( "#createUser" ).trigger( "click" );
    $( "#loginUser" ).trigger( "click" );
    logoutuser();
});

function logoutuser(){
    if(sessionStorage.getItem("logouts") == 1){

    }else{
      $( "#loginUser" ).trigger( "click" ); 
      sessionStorage.setItem("logouts", "1");
      var lastname = sessionStorage.getItem("logouts");
      console.log(lastname);
    }
}

</script>
</body>



@endsection