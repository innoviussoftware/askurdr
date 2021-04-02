@extends('layouts.front')

@section('content')
<link href="{{ asset('public/admin_assets/timepicker-master/jquery.ui.timepicker.css') }}" rel="stylesheet">
<link href="{{ asset('public/admin_assets/timepicker-master/include/ui-1.10.0/ui-lightness/jquery-ui-1.10.0.custom.min.css') }}" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="{{ asset('public/admin_assets/timepicker-master/include/jquery-1.9.0.min.js') }}"></script>
<script src="{{ asset('public/admin_assets/timepicker-master/jquery.ui.timepicker.js') }}"></script>

<script src="{{ asset('public/admin_assets/timepicker-master/include/ui-1.10.0/jquery.ui.core.min.js') }}"></script>
<script src="{{ asset('public/admin_assets/timepicker-master/include/ui-1.10.0/jquery.ui.widget.min.js') }}"></script>
<script src="{{ asset('public/admin_assets/timepicker-master/include/ui-1.10.0/jquery.ui.tabs.min.js') }}"></script>
<script src="{{ asset('public/admin_assets/timepicker-master/include/ui-1.10.0/jquery.ui.position.min.js') }}"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>

<div id='content' class="container col-md-10 col-md-offset-1  text well" align="">
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
  		<div class="col-md-8">
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <b>
                      <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('front.home.profile') }}" class="breadcrumb-item active crumb">Edit :: Profile</a></li>
                    </b>
                    
                  </ol>
              </nav>
          <form method="post" action="{{ route('front.home.updateprofile') }}" enctype="multipart/form-data">
            <input type="hidden" name="doctor_id" value="{{$users->id}}" id="doctor_id">
            @csrf
            {{ method_field('POST') }}
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="inputPassword4">Clinic Name</label>
                  <select class="form-control form-control-sm" name="clinic_id">
                               <option value="">Select Clinic</option> 
                               @foreach($clinics as $clinic)
                               <option value="{{$clinic->id}}" {{ $doctor_clinic[0]->clinic_id == $clinic->id ? 'selected="selected"' : '' }}>{{$clinic->name}}</option>
                               @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group col-md-12">
                  <label for="inputPassword4">Name</label>
                  <input type="text" class="form-control" id="inputPassword4" placeholder="Name" value="{{$users->last_name}}" name="lastname">
                </div>

              <div class="form-group col-md-12">
                <label for="inputAddress">Date of Birth</label>
                <input type="text" class="form-control date-own" id="inputAddress" placeholder="Date of Birth" value="{{$users->date_of_birth}}" name="dob" readonly>
              </div>

              <div class="form-group col-md-12">
                <label for="inputAddress">Email</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Email" value="{{$users->email}}" name="email" readonly="">
              </div>

              <div class="form-group col-md-12">
                <label for="inputAddress">Phone Number</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Mobile Number" value="{{$users->mobile}}" name="mobile">
              </div>

              <div class="form-group col-md-12">
                <label for="inputAddress">Age</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Mobile Number" value="{{$users->age}}" name="mobile">
              </div>

              <div class="form-group col-md-12">
                <label for="inputAddress">Postel mail</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Poster Mail" value="{{$users->post_mail}}" name="postermail">
              </div>

              <div class="form-group col-md-12">
                <label for="inputAddress">Speciality</label>
                <select class="form-control form-control-sm required select2" title="Search Speciality" name="speciality[]" multiple="multiple">
                            @foreach($speciality as $speciality)
                              <option value="{!! $speciality->id !!}" <?php if(in_array($speciality->id,$doctor_speciality)){?>selected="selected"<?php }?>>{!! $speciality->name !!}</option>
                            @endforeach
                          </select>
              </div>

              

              

              <div class="form-group col-md-12">
                  <label for="inputAddress2">Gender</label>
                  <label class="radio-inline">
                    <input type="radio" name="optradio" disabled="" <?php if($users->gender=='Male'|| $users->gender=='male'){ echo "checked"; }?>>Male
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="optradio" disabled=""<?php if($users->gender=='Female'|| $users->gender=='female'){ echo "checked"; }?>>Female
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="optradio" disabled=""<?php if($users->gender=='Other'|| $users->gender=='other'){ echo "checked"; }?>>Other
                  </label>
              </div>

               <div class="form-group col-md-12">
                <label for="inputAddress2">Language</label>
                <!--  -->
                <select name="language" class="form-control">
                  <option class="form-control">Preferred Language</option>
                  <option class="form-control" value=""<?php if($users->language=='English'|| $users->language=='english'){ echo "selected"; }?>>English</option>
                  <option class="form-control" value="" <?php if($users->language=='Arabic'|| $users->language=='arabic'){ echo "selected"; }?> >Arabic</option>
                  
                </select>
              </div>

              <div class="form-group col-md-12">
                              
                          <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>Appointment Timing</b>
                            </div>
                            <div class="panel-body">
                              <div class="Investnew" id="newinvestment">
                                          
                                <div class="box-body" id='Timing'>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="float: left">
                                      <div class="form-group">
                                                <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Start Time</label>                                        
                                                <input type="text" class="form-control basicExample" name="starttime"  value="{{$users->start_time}}" id="starttime" autocomplete="off" id="starttime" >
                                               
                                      </div>
                                      <div>
                                        <label for="exampleInputEmail1" class="start_error"></label>
                                      </div>
                                   </div>
                                    
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="float: left">
                                      <div class="form-group">
                                                <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">End Time</label>                                        
                                                <input type="text" class="form-control basicExample" name="endtime"  value="{{$users->end_time}}"autocomplete="off" id="endtime" >
                                      </div>
                                      <div>
                                          <label for="exampleInputEmail1" class="end_error"></label>  
                                      </div>
                                    </div>
                                </div>
                              </div>
                            </div>
                      </div>
              </div>
              <div class="form-group col-md-12">
                <?php if($ded>=0){?>
                  <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>Edit Education</b>
                            </div>
                            <div class="panel-body">
                              <div class="Investnew" id="module_edit">
                                
                              </div>
                            </div>
                      </div>
                 <?php }else{?> 
                <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>Add Education</b>
                            </div>
                            <div class="panel-body">
                              <div class="Investnew" id="module_div">
                                  <div class="form-group row">
                                                <div class="col-xs-3 col-sm-3 col-md-3">
                                                  
                                                      <div class="form-group">
                                                        <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Institute Name</label>                                        
                                                        <input type="text" class="form-control" name="institute_name[]"  value="">
                                                      </div>
                                                </div>
                                                
                                                <div class="col-xs-3 col-sm-4 col-md-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Course</label>                                        
                                                        <input type="text" class="form-control" name="institute_name[]"  value="">
                                                    </div>
                                                </div>

                                                <div class="col-xs-3 col-sm-4 col-md-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Year</label>                                        
                                                        <input type="text" class="form-control" name="institute_name[]"  value="">
                                                    </div>
                                                </div>


                                                <div class="col-xs-3 col-sm-4 col-md-2">
                                                  <div class="form-group">
                                                    
                                                   <button type="button" style="margin-top: 1.6em;" class="add_module btn btn-primary"><i class="fa fa-plus"></i></button>
                                                 </div>
                                                </div>
                                                
                                  </div>
                              </div>
                            </div>
                      </div>
                    <?php }?>
              </div>

              

                <div class="form-group col-md-12">
                  <label for="inputAddress2">Profile</label>
                  <div>
                    <?php if($users->profile_pic!=null){?>
                    <img src="{{ env('APP_URL_WITHOUT_PUBLIC') .'/storage/app/'.$users->profile_pic }}" width="150px" height="150px" alt="no image">  
                  <?php }else{?>
                    <i class="fa fa-user-circle-o" style="font-size: 5em !important;"></i>
                   <?php }?> 
                    <div style="padding-top: 0.5em !important">
                      <input type="file" name="profile" > 
                    </div>
                                 
                  </div>
                </div>              

                 <div class="form-group col-md-12">
                     <button type="submit" class="btn btn-primary">Update</button>
                 </div>
          </form>

      </div>
  	</div>
</div>

<script>
    $(document).ready(function () {
           
        var count = 1;
        $('body').on('click', '.add_exp', function () {
            
            $('#exp_div').append('<div class="box-body" id="exp_div"> <div class="col-lg-4" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Name of Hospital</label> <input type="text" class="form-control" name="hospital_name[]"  value="" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Position </label> <input type="text" class="form-control" name="position[]"  value="" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Number of year </label> <input type="text" class="form-control" name="number_of_year[]"  value="" > </div> </div> <div class="col-lg-2" style="float: left"> <div class="form-group"><button type="button" style="float: right;margin-left:4px;margin-top:30px;" class="remove_exp btn btn-primary"><i class="fa fa-minus"></i></button></div> </div> </div>');

            count++;
        });

        $('body').on('click', '.remove_exp', function () {            
             $(this).closest('.box-body').remove();
             
        });

         $('body').on('click', '.add_exp1', function () {
            
            $('#exp_edit').append('<div class="box-body" id="exp_div"> <div class="col-lg-4" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Name of Hospital</label> <input type="text" class="form-control" name="hospital_name[]"  value="" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Position </label> <input type="text" class="form-control" name="position[]"  value="" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Number of year </label> <input type="text" class="form-control" name="number_of_year[]"  value="" > </div> </div> <div class="col-lg-2" style="float: left"> <div class="form-group"> <button type="button" style="float: right;margin-left:4px;margin-top:30px;" class="remove_exp btn btn-primary"><i class="fa fa-minus"></i></button></div> </div> </div>');

            count++;
        });


        $('body').on('click', '.add_module', function () {
            alert('here');
            $('#module_div').append('<div class="box-body" id="module_div"> <div class="col-lg-4" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Institute Name</label> <input type="text" class="form-control" name="institute_name[]"  value="" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Course </label> <input type="text" class="form-control" name="course[]"  value="" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Year </label> <input type="text" class="date-own form-control" name="year[]"  value="" autocomplete="off"> </div> </div> <div class="col-lg-2" style="float: left"> <div class="form-group"> <button type="button" style="float: right;margin-left:4px;margin-top:30px;" class="remove_module btn btn-primary"><i class="fa fa-minus"></i></button></div> </div> </div>');

            $('.date-own').datepicker({
                   minViewMode: 2,
                   format: 'yyyy'
            });
            count++;
        });
         $('body').on('click', '.remove_module', function () {            
             $(this).closest('.box-body').remove();
             
         });

         $('body').on('click', '.add_module1', function () {
            
            $('#module_edit').append('<div class="box-body" id="module_div"> <div class="col-lg-4" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Institute Name</label> <input type="text" class="form-control" name="institute_name[]"  value="" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Course </label> <input type="text" class="form-control" name="course[]"  value="" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Year </label> <input type="text" class="date-own form-control" name="year[]"  value="" autocomplete="off" > </div> </div> <div class="col-lg-2" style="float: left"> <div class="form-group"><button type="button" style="float: right;margin-left:4px;margin-top:30px;" class="remove_module btn btn-primary"><i class="fa fa-minus"></i></button> </div> </div> </div>');

            $('.date-own').datepicker({
                   minViewMode: 2,
                   format: 'yyyy'
            });
            count++;
        });

        var details = '<?php echo URL::to('Front/getdataeducation'); ?>';
          
        var doctor_id = $('#doctor_id').val();
            
            $.ajax({
                type:'get',
                url:details,
                data: {doctor_id: doctor_id},
                success:function(res){
                  
                  var count = Object.keys(res).length;
                  $.each(res, function(index, value) {
                    $('#module_edit').append('<div class="box-body" id="module_edit'+value.id+'"> <div class="col-lg-4" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Institute Name</label><input type="hidden" id="doctor_education_id" class="doctor_education_id" value="'+value.id+'"> <input type="text" class="form-control" name="institute_name[]"  value="'+value.institute_name+'" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Course </label> <input type="text" class="form-control" name="course[]"  value="'+(value.course ? value.course : "") +'" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Year </label> <input type="text" class="date-own form-control" name="year[]"  value="'+(value.year ? value.year : "") +'" > </div> </div> <div class="col-lg-2" style="float: left"> <div class="form-group"> <button type="button" style="float: right;margin-left:4px;margin-top:30px;" class="add_module1 btn btn-primary '+( (index > 0) ? 'd-none' : '' )+'"><i class="fa fa-plus"></i></button></div> </div> </div>');
                  });
                 
                }
          });

        $('body').on('click', '.remove_education', function () {            
              $(this).closest('.box-body').remove(); 
              window.location.reload(); 
              var details = '<?php echo URL::to('Front/removeeducation'); ?>';
              var doctor_id = $(this).attr("value");

                    $.ajax({
                      type:'get',
                      url:details,
                      data: {doctor_id: doctor_id},
                      success:function(res){
                        
                        if(res==0)
                        {

                          $(this).closest('.box-body').remove();

                        }
                        else
                        {

                        }
                        
                       
                      }
                    });
         });

        $('body').on('click', '.remove_exp1', function () {            
              $(this).closest('.box-body').remove();  
              window.location.reload(); 
              var details = '<?php echo URL::to('Front/removeexp'); ?>';
              var doctor_id = $(this).attr("value");

                    $.ajax({
                      type:'get',
                      url:details,
                      data: {doctor_id: doctor_id},
                      success:function(res){
                        
                        if(res==0)
                        {

                          $(this).closest('.box-body').remove();

                        }
                        else
                        {

                        }
                        
                       
                      }
                    });
         });

        var details = '<?php echo URL::to('Front/getdataexpen'); ?>';
          
        var doctor_id = $('#doctor_id').val();
            
            $.ajax({
                type:'get',
                url:details,
                data: {doctor_id: doctor_id},
                success:function(res){
                  
                  var count = Object.keys(res).length;
                  $.each(res, function(index, value) {
                    $('#exp_edit').append('<div class="box-body" id="exp_div"> <div class="col-lg-4" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Name of Hospital</label> <input type="text" class="form-control" name="hospital_name[]"  value="'+value.hospital_name+'" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Position </label> <input type="text" class="form-control" name="position[]"  value="'+value.position+'" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Number of year </label> <input type="text" class="form-control" name="number_of_year[]"  value="'+value.year+'" > </div> </div> <div class="col-lg-2" style="float: left"> <div class="form-group"> <button type="button" style="float: right;margin-left:4px;margin-top:30px;" class="add_exp1 btn btn-primary '+( (index > 0) ? 'd-none' : '' )+'"><i class="fa fa-plus"></i></button></div> </div> </div>');
                  });
                }
          });

    })
</script>
<script type="text/javascript">
             let getTime = (m) => {
                 return m.minutes() + m.hours() * 60;
              }


           $('.basicExample').timepicker({
                  showPeriod: true,
                  showLeadingZero: true


           });

           $('.date-own').datepicker({
                   minViewMode: 3,
                   format: 'dd-mm-yyyy'
            });
           
            $(function() {
                    $("body").on("change","#endtime", function(){


                        let timeFrom = $('input[name=starttime]').val().trim(),
                            timeTo = $('input[name=endtime]').val().trim();

                        timeFrom = moment(timeFrom, 'hh:mm a');
                        timeTo = moment(timeTo, 'hh:mm a');
                        console.log(timeFrom);
                        console.log(timeTo);
                        if(timeFrom.length==0)
                        {                            
                            
                        }
                        else
                        {
                            if (getTime(timeFrom) >= getTime(timeTo)) {
                               $('.end_error').css('display','block');
                               $('.end_error').css('font-size','13px');
                               $('.end_error').css('color','red');
                               $('.end_error').text('End time should not be greater than start time.');
                               $('.start_error').css('display','none');
                            }
                            else 
                            {
                                $('.end_error').css('display','none');
                                $('.start_error').css('display','none');
                            }
                        }
                    });


             });

             $(function() {
                    $("body").on("change","#starttime", function(){

                        let timeFrom =   $('input[name=starttime]').val().trim(),
                            timeTo   =   $('input[name=endtime]').val().trim();
                        timeFrom = moment(timeFrom, 'hh:mm a');
                        timeTo = moment(timeTo, 'hh:mm a');
                        console.log(timeFrom);
                        console.log(timeTo);
                        if(timeTo.length==0)
                        {
                         
                        }
                        else
                        {
                            if (getTime(timeFrom) >= getTime(timeTo) ) {
                              
                              $('.start_error').css('display','block');
                              $('.start_error').css('font-size','13px');
                              $('.start_error').css('color','red');
                              $('.start_error').text('Start time should be less than End time.');
                              $('.end_error').css('display','none');
                            }   
                            else 
                            {
                                $('.start_error').css('display','none');
                                $('.end_error').css('display','none');
                                
                            }
                        }
                    });


             });
             
           
              
             
         
        </script>

@endsection