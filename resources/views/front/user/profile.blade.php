@extends('layouts.front')

@section('content')
<?php 
$user = App\User::find(Auth::user()->id);
?>
<style type="text/css">
  
  input {
     width: auto;
     height: auto;
}

</style>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="{{ asset('public/admin_assets/timepicker/bootstrap-timepicker.min.css') }}">
<script src="{{ asset('public/admin_assets/timepicker/bootstrap-timepicker.min.js') }}"></script>
<link href = "https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.6/chosen.css"
         rel = "stylesheet">
      
      <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.js"></script>

      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css" rel="stylesheet" type="text/css" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.full.min.js"></script>



<style>
.select2-container--default .select2-selection--multiple .select2-selection__choice{
    background-color: black !important;
    color: #fff;
    border-color: transparent;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove{
    color: #fff !important;
}
.select2{
    width: 100% !important;
}
</style>


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
  		<div class="col-md-6">
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <b>
                      <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('front.home.profile') }}" class="breadcrumb-item active crumb">Edit :: Profile</a></li>
                    </b>
                    
                  </ol>
              </nav>
          <form method="post" action="{{ route('front.home.updateprofile') }}" enctype="multipart/form-data" id="doctor_form">
            @csrf
            {{ method_field('POST') }}
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">First Name</label>
                  <input type="text" class="form-control" id="inputEmail4" placeholder="First Name" value="{{$users->first_name}}" name="firstname">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Last Name</label>
                  <input type="text" class="form-control" id="inputPassword4" placeholder="Last Name" value="{{$users->last_name}}" name="lastname">
                </div>
              </div>

              <div class="form-group col-md-12">
                <label for="inputAddress">Age</label>
                <input type="number" class="form-control" id="inputAddress" placeholder="Date of Birth" value="{{$users->age}}" name="dob" >
                <!-- <label for="inputAddress">Date of Birth</label>
                <input type="text" class="form-control datepicker" id="inputAddress" placeholder="Date of Birth" value="{{$users->date_of_birth}}" name="dob" > -->
              </div>

              <div class="form-group col-md-12">
                <label for="inputAddress">National Id</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Email" value="{{$users->email}}" name="email" readonly="">
              </div>

              <div class="form-group col-md-12">
                <label for="inputAddress">fees(SAR)</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Fees" value="{{$users->fees}}" name="fees">
              </div>

              <div class="form-group col-md-12">
                <label for="inputAddress">Discount(%)</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Discount" value="{{$users->discount}}" name="discount">
              </div>

              <div class="form-group col-md-12">
                <label for="inputAddress">Poster mail</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Poster Mail" value="{{$users->post_mail}}" name="postermail">
              </div>
            
              <div class="form-group col-md-3">
                <label for="inputAddress">Code</label>
               
                <select class="form-control form-control-sm chosen" name="countrycode">
                            <option value=" form-control  form-control-sm" >Code</option>
                            @foreach($code as $code)
                            <option value="+{{$code->phonecode}}" <?php if($users->countrycode==$code->phonecode){ echo "selected";}?>>+{{$code->phonecode}}</option>
                            @endforeach
                          </select>
              </div>
              
              <div class="form-group col-md-9">
                <label for="inputAddress">Phone Number</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Mobile Number" value="{{$users->mobile}}" name="mobile" minlength="9" maxlength="10">
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
                <label for="staticEmail">Language<span class="text-danger">*</span></label>
                @if(isset($users))
                  <select class="form-control form-control-sm required select2" title="Search Language" name="language[]" multiple="multiple" id="p1">
                      @foreach($language as $key => $language)
                        <option value="{!! $language->id !!}" <?php if(in_array($language->id,$doctor_language)){?>selected="selected"<?php }?>>{!! $language->name !!}</option>
                      @endforeach
                  </select>
                @endif
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
              @if($user->roles()->first()->id == '112')
              <div class="form-group col-md-12">   
                <label for="inputAddress2">Days</label>
             <div class="panel-group">
                  <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-lg-4" style="float: left">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Days</label>                                        
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="defaultInline1" value="sunday" name="days[]" <?php if(in_array('sunday',$doctor_days_checked)){?> checked<?php }?> >
                                                    <label class="custom-control-label" for="defaultInline1">Sunday</label>
                                                </div>
                                            </div>
                                          </div>
                        <div class="col-lg-3" style="float: left">
                                              <div class="form-group">
                                                    <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Start Time </label>                                        
                                                    <input type="text" class="form-control timepicker" name="sunday_starttime"  value="{{isset($doctor_days['sunday'])?$doctor_days['sunday']:''}}" autocomplete="off" >
                                              </div>
                                            
                        </div>
                        <div class="col-lg-3" style="float: left">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">End Time </label>                                        
                                                        <input type="text" class="form-control timepicker" name="sunday_endtime"  value="{{isset($doctor_daysendtime['sunday'])?$doctor_daysendtime['sunday']:''}}" autocomplete="off">
                                                    </div>
                                            
                                          </div>
                                          <div class="col-lg-4" style="float: left">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Days</label>                                        
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="defaultInline2" value="monday" name="days[]" <?php if(in_array('monday',$doctor_days_checked)){?> checked<?php }?>>
                                                    <label class="custom-control-label" for="defaultInline2">Monday</label>
                                                </div>
                                            </div>
                                          </div>

                                          <div class="col-lg-3" style="float: left">
                                              <div class="form-group">
                                                    <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Start Time </label>                                        
                                                    <input type="text" class="form-control timepicker" name="monday_starttime"  value="{{isset($doctor_days['monday'])?$doctor_days['monday']:''}}" autocomplete="off" >
                                              </div>
                                            
                                          </div>
                                          <div class="col-lg-3" style="float: left">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">End Time </label>                                        
                                                        <input type="text" class="form-control timepicker" name="monday_endtime"  value="{{isset($doctor_daysendtime['monday'])?$doctor_daysendtime['monday']:''}}" autocomplete="off" >
                                                    </div>
                                            
                                          </div>
                                          <div class="col-lg-4" style="float: left">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Days</label>                                        
                                                <div class="custom-control custom-checkbox ">
                                                    <input type="checkbox" class="custom-control-input" id="defaultInline3" value="tuesday" name="days[]" <?php if(in_array('tuesday',$doctor_days_checked)){?> checked<?php }?>>
                                                    <label class="custom-control-label" for="defaultInline3">Tuesday</label>
                                                </div>
                                            </div>
                                          </div>

                                          <div class="col-lg-3" style="float: left">
                                              <div class="form-group">
                                                    <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Start Time </label>                                        
                                                    <input type="text" class="form-control timepicker" name="tuesday_starttime"  value="{{isset($doctor_days['tuesday'])?$doctor_days['tuesday']:''}}" autocomplete="off" >
                                              </div>
                                            
                                          </div>
                                          <div class="col-lg-3" style="float: left">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">End Time </label>                                        
                                                        <input type="text" class="form-control timepicker" name="tuesday_endtime"  value="{{isset($doctor_daysendtime['tuesday'])?$doctor_daysendtime['tuesday']:''}}" autocomplete="off">
                                                    </div>
                                            
                                          </div>
                                          <div class="col-lg-4" style="float: left">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Days</label>                                        
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="defaultInline4" value="wednesday" name="days[]" <?php if(in_array('wednesday',$doctor_days_checked)){?> checked<?php }?>>
                                                    <label class="custom-control-label" for="defaultInline4">Wednesday</label>
                                                </div>
                                            </div>
                                          </div>

                                          <div class="col-lg-3" style="float: left">
                                              <div class="form-group">
                                                    <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Start Time </label>                                        
                                                    <input type="text" class="form-control timepicker" name="wednesday_starttime"  value="{{isset($doctor_days['wednesday'])?$doctor_days['wednesday']:''}}" autocomplete="off" >
                                              </div>
                                            
                                          </div>
                                          <div class="col-lg-3" style="float: left">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">End Time </label>                                        
                                                        <input type="text" class="form-control timepicker" name="wednesday_endtime"  value="{{isset($doctor_daysendtime['wednesday'])?$doctor_daysendtime['wednesday']:''}}" autocomplete="off">
                                                    </div>
                                            
                                          </div>
                                          <div class="col-lg-4" style="float: left">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Days</label>                                        
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="defaultInline5" value="thursday" name="days[]" <?php if(in_array('thursday',$doctor_days_checked)){?> checked<?php }?>>
                                                    <label class="custom-control-label" for="defaultInline5">Thursday</label>
                                                </div>
                                            </div>
                                          </div>

                                          <div class="col-lg-3" style="float: left">
                                              <div class="form-group">
                                                    <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Start Time </label>                                        
                                                    <input type="text" class="form-control timepicker" name="thursday_starttime"  value="{{isset($doctor_days['thursday'])?$doctor_days['thursday']:''}}" autocomplete="off" >
                                              </div>
                                            
                                          </div>
                                          <div class="col-lg-3" style="float: left">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">End Time </label>                                        
                                                        <input type="text" class="form-control timepicker" name="thursday_endtime"  value="{{isset($doctor_daysendtime['thursday'])?$doctor_daysendtime['thursday']:''}}" autocomplete="off" >
                                                    </div>
                                            
                                          </div>
                                          <div class="col-lg-4" style="float: left">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Days</label>                                        
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="defaultInline6" value="friday" name="days[]" <?php if(in_array('friday',$doctor_days_checked)){?> checked<?php }?>>
                                                    <label class="custom-control-label" for="defaultInline6">Friday</label>
                                                </div>
                                            </div>
                                          </div>

                                          <div class="col-lg-3" style="float: left">
                                              <div class="form-group">
                                                    <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Start Time </label>                                        
                                                    <input type="text" class="form-control timepicker" name="friday_starttime"  value="{{isset($doctor_days['friday'])?$doctor_days['friday']:''}}" autocomplete="off" >
                                              </div>
                                            
                                          </div>
                                          <div class="col-lg-3" style="float: left">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">End Time </label>                                        
                                                        <input type="text" class="form-control timepicker" name="friday_endtime"  value="{{isset($doctor_daysendtime['friday'])?$doctor_daysendtime['friday']:''}}" autocomplete="off">
                                                    </div>
                                            
                                          </div>
                                          <div class="col-lg-4" style="float: left">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Days</label>                                        
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="defaultInline7" value="saturday" name="days[]" <?php if(in_array('saturday',$doctor_days_checked)){?> checked<?php }?>>
                                                    <label class="custom-control-label" for="defaultInline7">Saturday</label>
                                                </div>
                                            </div>
                                          </div>

                                          <div class="col-lg-3" style="float: left">
                                              <div class="form-group">
                                                    <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Start Time </label>                                        
                                                   <input type="text" class="form-control timepicker" name="saturday_starttime"  value="{{isset($doctor_days['saturday'])?$doctor_days['saturday']:''}}" autocomplete="off" >
                                              </div>
                                            
                                          </div>
                                          <div class="col-lg-3" style="float: left">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">End Time </label>                                        
                                                        <input type="text" class="form-control timepicker" name="saturday_endtime"  value="{{isset($doctor_daysendtime['saturday'])?$doctor_daysendtime['saturday']:''}}" autocomplete="off">
                                                    </div>
                                            
                                          </div>
                              
                    </div><!--End Panel Body -->
                  </div>
              </div>
            </div>
            @endif
@if($user->roles()->first()->id == '3')
               <div class="form-group col-md-12">
                <label for="inputAddress2">Insurance Company Name</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="Insurance Company Name" value="{{$users->insurance_company_name}}" name="insurance_company_name">
              </div>

              <div class="form-group col-md-12">
                <label for="inputAddress2">Insurance Company Number</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="Insurance Company Number" value="{{$users->insurance_policy_no}}" name="insurance_policy_no">
              </div>

              <div class="form-group col-md-12">

                <?php if(isset($paymentdetails->paymentplan)){

                if($paymentdetails->paymentplan->months!='-'){?>
                <label for="inputAddress2">Subscribed plan for 
                {{($paymentdetails->paymentplan->months)?$paymentdetails->paymentplan->months:''}} Months</label>
                <label for="inputAddress2">From: {{($paymentdetails->paymentplan->months)?date('d-m-Y',strtotime($paymentdetails->plan_startdate)):'-'}}</label>
                <label for="inputAddress2">To: {{($paymentdetails->paymentplan->months)?date('d-m-Y',strtotime($paymentdetails->plan_enddate)):'-'}}</label>
                <?php }
                
                if($paymentdetails->paymentplan->years!='-' ){?>
                <label for="inputAddress2">Subscribed plan for 
                {{($paymentdetails->paymentplan->years)?$paymentdetails->paymentplan->years:''}} Years</label>
                <label for="inputAddress2">From: {{($paymentdetails->paymentplan->years)?date('d-m-Y',strtotime($paymentdetails->plan_startdate)):'-'}}</label>
                <label for="inputAddress2">To: {{($paymentdetails->paymentplan->years)?date('d-m-Y',strtotime($paymentdetails->plan_enddate)):'-'}}</label>
                <?php }
                }?>
              </div>
@endif




              

               <div class="form-group col-md-12">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
          </form>

      </div>
  	</div>
</div>

<script type="text/javascript">
  $('.datepicker').datepicker({
        minViewMode: 3,
                   format: 'dd-mm-yyyy'
        
        
   });
    $('.timepicker').timepicker({
      showInputs: false,
      defaultTime: ''
   });

// $("#doctor_form").submit(function(){
//      if(!$('#doctor_form input[type="checkbox"]').is(':checked')){
//             alert("Please select days at least one.");
//              return false;
//             }
//      });
$(function() {
  $(".chosen").chosen();
});

        $('.select2').select2();
</script>

@endsection