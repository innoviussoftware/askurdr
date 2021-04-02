@extends('layouts.front')

@section('content')
<link rel="stylesheet" href="{{ asset('public/admin_assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
        <!-- Bootstrap time Picker -->
<link rel="stylesheet" href="{{ asset('public/admin_assets/timepicker/bootstrap-timepicker.min.css') }}">
<script src="{{ asset('public/admin_assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
 <script src="{{ asset('public/admin_assets/timepicker/bootstrap-timepicker.min.js') }}"></script>
        <!-- datepicker -->

<div id='content' class="container col-md-10 col-md-offset-1  text well" align="">
   
  	<div class="row">
          		  <nav aria-label="breadcrumb">
                        <ol class="breadcrumb" >
                               <b><li class="breadcrumb-item active" aria-current="page"><a href="{{ route('front.home.bookappointment') }}" class="breadcrumb-item active crumb">Book Appointment</a></li></b> 
                        </ol>
                </nav>
                <form class="form-horizontal validate_form" id="filter_form" method="POST">

                  <div class="col-md-4 col-sm-4" style="padding-bottom: 0.3em;">
                      <select id='clinic' class="form-control" >
                         <option value="">Select clinic</option>
                         @foreach($clinics as $clinic)
                         <option value='{{$clinic->id}}'>{{$clinic->name}}</option>
                         @endforeach
                      </select>
                  </div>
                 
                  <div class="col-md-4 col-sm-4" style="padding-bottom: 0.3em;">
                      <select id='doctors' class="form-control" >
                        <option value=''>Select Doctor</option>
                      </select>
                  </div>
                 
                  <div class="col-md-4 col-sm-4" style="padding-bottom: 0.3em;">
                      <button type="button" id="logs_filter_btn" class="btn btn-primary">Submit</button>
                  </div>

                </form>
    </div>

    <div class="row" style="padding-top: 3em;">
      <div class="col-md-12">
        <div class="testiminial-block" id="details">
            
            
         </div>
      </div>

      <div class="row" style="padding-top: 3em;">
        <div class="col-md-12">    
            <div class="testiminial-block" id="previsit_form">

            </div>
        </div>
      </div>
    
          
      
  	</div>
  	

</div>
<script type="text/javascript">
  $(function() {
          
            $("body").on("change","#clinic", function(){
                var id = $(this).val();
                var details = '<?php echo URL::to('front/clinicwisedoctor'); ?>';
                if(id)
                {
                    $.ajax({
                              type:'get',
                                 url:details,
                                 data: {
                                  id:id
                              },
                              success:function(data){
                                  $('#doctors').empty();
                                            var json = $.parseJSON(data);
                                              $('#doctors').append('<option value="">Select Doctor</option>');
                                              $.each(json, function (index, value) {

                                                    $('#doctors').append('<option value="' + value.id + '">'+ value.first_name +'</option>');
                                              });
                              }
                    });
                }
                else
                {
                  $('#doctors').empty();
                  $('#doctors').append('<option value="">Select Doctor</option>');
                }
            });
  });

  $(function() {
            $("body").on("click","#logs_filter_btn", function(){
               var clinic = $('#clinic').val();
               var doctor = $('#doctors').val();
               if(clinic=='')
               {
                  alert('Please Select Clinic');
                  
               }
               else
               {
                   if(doctor=='')
                   {
                      alert('Please Select Doctor');
                   }
                   else
                   {
                      $("#doctors").prop('required',false);
                   }
               }
               
               
               
               var doctor_id= $('#doctors').val();
               var details = '<?php echo URL::to('front/doctordetails'); ?>';
               if(doctor_id)
               {
                    $.ajax({
                              type:'get',
                                 url:details,
                                 data: {
                                  doctor_id:doctor_id
                              },
                              success:function(data){
                                    $('#details').html('');                  
                                    $('#details').append(data);
                                    $('.timepicker').timepicker({
                                      showInputs: false,
                                      defaultTime: ''
                                    });
                                    $('.datepicker').datepicker({
                                        autoclose: true,
                                        format: "dd-mm-yyyy",
                                        orientation: "bottom auto",
                                        startDate: 'd' 
                                    });
                                    
                              }
                    });
               }
               else
               {
                  $('#details').html('');  
               }
            });
  });

  $(function() {
          
            $("body").on("click","#book_isappointment", function(){

                var doctor_id= $('#doctors').val();
                var date=$('#datecurrent').val();
                var time=$('#currenttime').val();
                var details = '<?php echo URL::to('front/book'); ?>';

                $.ajax({
                              type:'get',
                                 url:details,
                                 data: {
                                  doctor_id:doctor_id,
                                  date:date,
                                  time:time,
                              },
                              success:function(data){
                               console.log(data);
                              }
                    });

            });
  });


   $('.timepicker').timepicker({
      showInputs: false,
      defaultTime: ''
   });


   $('.datepicker').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy",
        orientation: "bottom auto",
        startDate: 'd',
        
   });


</script>

@endsection