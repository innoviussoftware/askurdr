@extends('layouts.admin')

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


<div id="content" style="background-color: #ffff !important;">

        <div class="container-fluid">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                   @if(isset($doctors))  
                        <b><li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.doctor.index') }}" class="breadcrumb-item active crumb">Update  :: Doctor</a></li></b>
                    @else
                       <b><li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.doctor.index') }}" class="breadcrumb-item active crumb">Add  :: Doctor</a></li></b> 
                  @endif
                </ol>
            </nav>

          <!-- Page Heading -->
          @if(isset($doctors))  
          <!-- <h1 class="h2 mb-2 text-gray-800" style="padding-left: 0.5em;">Update :: Doctor</h1> -->
          
          <!-- <div class="caption pull-left" style="padding-bottom: 1em;padding-left: 1.1em;">
              <i class="fa fa-th-list"></i> &nbsp;
              <span class="caption-subject sbold uppercase font-dark">Update :: Doctor</span>
          </div> -->
          @else
          <!-- <div class="caption pull-left" style="padding-bottom: 1em;padding-left: 1.1em; ">
              <i class="fa fa-th-list"></i> &nbsp;
              <span class="caption-subject sbold uppercase font-dark">Add :: Doctor</span>
          </div> -->


         <!--  <h1 class="h2 mb-2 text-gray-800" style="padding-left: 0.5em;">Add :: Doctor</h1> -->
          @endif
          


          <!-- DataTales Example -->
          <div class="card">
            <div class="card-body">
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
                </div>
                
                <div class="col-8">
                  
                  

                
                  

                    <form class="form-horizontal"<?php if(isset($doctors)){ ?>action="{{ route('admin.doctor.update',$doctors->id)}}"<?php }?>  action="{{ route('admin.doctor.store') }}"method="post" enctype="multipart/form-data" id="doctor_form">
                      <input type="hidden" name="vatamount" value="{{$vat->vat}}" id="vatamount">
                       @csrf
                       <?php if(isset($doctors)){ ?>
                        {{ method_field('PATCH') }}
                        <input type="text" id="hidden_image" style="display: none;" name="hidden_image" value="{{ $doctors->profile_pic }}" placeholder="Profile Pic">
                        <input type="hidden" name="doctor_id" value="{{$doctors->id}}" id="doctor_id">
                         @if(isset($doctors->countrycode))
                        <input type="hidden" name="code" value="{{$doctors->countrycode}}">

                        @endif
                    <?php }?> 
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Hospital Name<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($doctors))
                        
                          
                          <select class="form-control form-control-sm hospital_id" name="clinic_id" id="hospital_id">
                               <option value="">Select Hospital</option> 
                               @foreach($clinics as $clinic)
                               <option value="{{$clinic->id}}" {{ $doctor_clinic[0]->clinic_id == $clinic->id ? 'selected="selected"' : '' }}>{{$clinic->name}}</option>
                               @endforeach
                          </select>
                        @else
                           <select class="form-control form-control-sm hospital_id" name="clinic_id" id="hospital_id">
                               <option value="">Select Hospital</option> 
                               @foreach($clinics as $clinic)
                               <option value="{{$clinic->id}}" {{ old('clinic_id') == $clinic->id ? 'selected="selected"' : '' }}>{{$clinic->name}}</option>
                               @endforeach
                          </select>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Doctor Name<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($doctors))
                        <input type="hidden" value="{{$ded}}" name="doctor_education" class="doc_edu1">
                      <input type="hidden" value="{{$de}}" name="doctor_experience" class="doc_exp1">
                          <input type="text" name="doctor_name" class="form-control form-control-sm" value="{{ $doctors->first_name }}">
                        @else
                          <input type="text" name="doctor_name" class="form-control form-control-sm" value="{{ old('doctor_name') }}">
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Doctor Name arabic<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($doctors))
                          <input type="text" name="ar_doctor_name" class="form-control form-control-sm" value="{{ $doctors->ar_first_name }}">
                        @else
                          <input type="text" name="ar_doctor_name" class="form-control form-control-sm" value="{{ old('ar_doctor_name') }}">
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">ASK Dr Code<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($doctors))
                          <input type="text" name="ask_id" class="form-control form-control-sm" minlength="2" value="{{ $doctors->ask_id }}" id="ask_id_code">
                        @else
                          <input type="text" name="ask_id" class="form-control form-control-sm" minlength="2" value="{{ old('ask_id') }}" id="ask_id_code"  >
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">ASK Dr Code Arabic<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($doctors))
                          <input type="text" name="ask_id_arabic" class="form-control form-control-sm" minlength="2" value="{{ $doctors->ar_askid }}" id="ask_id_arcode">
                        @else
                          <input type="text" name="ask_id_arabic" class="form-control form-control-sm" minlength="2" value="{{ old('ask_id') }}" id="ask_id_arcode"  >
                        @endif
                      </div>
                    </div>
                    
                    
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Group Code<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($doctors))
                          <input type="text" name="doctor_code" class="form-control form-control-sm doctor_code"  value="{{ $doctors->doctor_code }}" >
                        @else
                          <input type="text" name="doctor_code" class="form-control form-control-sm doctor_code" value="{{ mt_rand(100000,999999) }}">
                        @endif
                      </div>
                    </div>

                     <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Group Code Arabic<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($doctors))
                          <input type="text" name="doctor_code_ar" class="form-control form-control-sm"  value="{{ $doctors->ar_doctorcode }}" id="doctor_code_ar">
                        @else
                          <input type="text" name="doctor_code_ar" class="form-control form-control-sm" value="{{ mt_rand(100000,999999) }}" id="doctor_code_ar">
                        @endif
                      </div>
                    </div>



                    <!-- <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Email<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($doctors))
                          <input type="text" name="email" class="form-control form-control-sm" value="{{ $doctors->email }}">
                        @else
                          <input type="text" name="email" class="form-control form-control-sm" value="{{ old('email') }}">
                        @endif
                      </div>
                    </div> -->

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Mobile<span class="text-danger">*</span></label>
                       <div class="col-sm-2">
                        @if(isset($doctors))
                       
                        
                          <select class="form-control form-control-sm select2" name="code">
                            <option value=" form-control  form-control-sm" >Code</option>
                            @foreach($code as $code)
                            <option value="+{{$code->phonecode}}" <?php if($doctors->countrycode==$code->phonecode){ echo "selected";}?>>+{{$code->phonecode}}</option>
                            @endforeach
                          </select>
                        @else
                         @if(isset($code->phonecode))
                        <input type="hidden" name="code" value="+{{$code->phonecode}}">
                        @endif
                          <select class=" form-control form-control-sm select2">
                            <option class=" form-control form-control-sm" value="" >Code</option>
                            @foreach($code as $code)
                            <option class="form-control" value="+{{$code->phonecode}}">+{{$code->phonecode}}</option>
                            @endforeach
                          </select>
                        @endif
                      </div>
                      <div class="col-sm-4">
                        @if(isset($doctors))
                          <input type="text" name="mobile" class="form-control form-control-sm" onkeypress="javascript:return isNumber(event)" value="{{ $doctors->mobile }}" minlength="9" maxlength="10">
                        @else
                          <input type="text" name="mobile" class="form-control form-control-sm" onkeypress="javascript:return isNumber(event)" value="{{ old('mobile') }}" minlength="9" maxlength="10">
                        @endif
                      </div>
                    </div>
                    
                   

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">National id<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($doctors))
                          <input type="text" name="national_id" minlength="10" onkeypress="javascript:return isNumber(event)"  class="form-control form-control-sm" value="{{ $doctors->national_id }}" maxlength="10" readonly>
                        @else
                          <input type="text" name="national_id" minlength="10" onkeypress="javascript:return isNumber(event)"  class="form-control form-control-sm" value="{{ old('national_id') }}" maxlength="10" >
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Fees(SAR)<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($doctors))
                          <input type="text" name="fees"   class="form-control form-control-sm drfees" value="{{ $doctors->fees }}" maxlength="10" onkeypress="javascript:return isNumber(event)">
                        @else
                          <input type="text" name="fees"   class="form-control form-control-sm drfees" value="{{ old('fees') }}" maxlength="10" onkeypress="javascript:return isNumber(event)">
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Fees(SAR) Arabic<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($doctors))
                          <input type="text" name="fees_arabic"   class="form-control form-control-sm drfees_arabic" value="{{ $doctors->ar_fees }}" maxlength="10" onkeypress="javascript:return isNumber(event)" id="drfees_arabic" readonly>
                        @else
                          <input type="text" name="fees_arabic"   class="form-control form-control-sm drfees_arabic" value="{{ old('fees_arabic') }}" maxlength="10" onkeypress="javascript:return isNumber(event)" id="drfees_arabic" readonly>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Discount(%)</label>
                      <div class="col-sm-9">
                        @if(isset($doctors))
                          <input type="text" name="discount" class="form-control form-control-sm discount" value="{{ $doctors->discount }}" maxlength="3" onkeypress="javascript:return isNumber(event)">
                        @else
                          <input type="text" name="discount"  class="form-control form-control-sm discount" value="0" maxlength="3" onkeypress="javascript:return isNumber(event)">
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Discount Amount</label>
                      <div class="col-sm-9">
                        @if(isset($doctors))
                          <input type="text" name="discountamount" class="form-control form-control-sm" id="discountamount" value="{{ $doctors->discount }}"  onkeypress="javascript:return isNumber(event)" readonly>
                        @else
                          <input type="text" name="discountamount"  class="form-control form-control-sm" id="discountamount" value="0" onkeypress="javascript:return isNumber(event)" readonly>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm" id="commision">Hospital Commission(%)</label>
                      <div class="col-sm-9">
                        @if(isset($doctors))
                          <input type="text" name="commision"   class="form-control form-control-sm commision " value="{{ $doctors->commision }}" maxlength="10" onkeypress="javascript:return isNumber(event)" onchange="handleChange(this);" >
                        @else
                          <input type="text" name="commision"   class="form-control form-control-sm commision" value="{{ old('commision') }}" maxlength="10" onkeypress="javascript:return isNumber(event)" onchange="handleChange(this);" >
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm" id="commision">Commission Amount</label>
                      <div class="col-sm-9">
                        @if(isset($doctors))
                          <input type="text" name="commision"   class="form-control form-control-sm" id="commisionamount" value="{{ $doctors->commision }}" readonly>
                        @else
                          <input type="text" name="commision"   class="form-control form-control-sm" id="commisionamount" value="{{ old('commision') }}" readonly>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Age<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($doctors))
                          <input type="number" name="age" class="form-control form-control-sm" value="{{ $doctors->age }}">
                        @else
                          <input type="number" name="age" class="form-control form-control-sm" value="{{ old('age') }}">
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Gender<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                         @if(isset($doctors))
                         <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" id="inlineCheckbox1" <?php if($doctors->gender=='Male'|| $doctors->gender=='male'){ echo "checked"; }?>  name="gender" value="Male">
                              <label class="form-check-label" for="inlineCheckbox1">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="inlineCheckbox1"  <?php if($doctors->gender=='Female' || $doctors->gender=='female'){ echo "checked";} ?> name="gender" value="Female">
                            <label class="form-check-label" for="inlineCheckbox1">Female</label>
                        </div>
                         @else
                          <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" id="inlineCheckbox1" <?php if(isset($doctor)){ echo "checked"; } ?>  name="gender" value="Male" checked>
                              <label class="form-check-label" for="inlineCheckbox1" >Male</label>
                          </div>
                          <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" id="inlineCheckbox2" <?php if(isset($doctor)){ echo "checked"; } ?> name="gender" value="Female">
                              <label class="form-check-label" for="inlineCheckbox1">Female</label>
                          </div>
                        @endif
                      </div>
                    </div>


                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Grade Level<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                         @if(isset($doctors))
                         <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" id="inlineCheckbox1" <?php if($doctors->consultant=='1'|| $doctors->consultant=='1'){ echo "checked"; }?>  name="consultant" value="1">
                              <label class="form-check-label" for="inlineCheckbox1">Consultant</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="inlineCheckbox1"  <?php if($doctors->consultant=='2' || $doctors->consultant=='2'){ echo "checked";} ?> name="consultant" value="2">
                            <label class="form-check-label" for="inlineCheckbox1">Specialist</label>
                        </div>
                         @else
                          <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" id="inlineCheckbox1" <?php if(isset($doctor)){ echo "checked"; } ?>  name="consultant" value="1" checked>
                              <label class="form-check-label" for="inlineCheckbox1" >Consultant</label>
                          </div>
                          <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" id="inlineCheckbox2" <?php if(isset($doctor)){ echo "checked"; } ?> name="consultant" value="2">
                              <label class="form-check-label" for="inlineCheckbox1">Specialist</label>
                          </div>
                        @endif
                      </div>
                    </div>
                    
                    <!--<div class="form-group row">-->
                    <!--  <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Specialist<span class="text-danger">*</span></label>-->
                    <!--  <div class="col-sm-9">-->
                    <!--     @if(isset($doctors))-->
                    <!--     <div class="form-check form-check-inline">-->
                    <!--          <input class="form-check-input" type="radio" id="inlineCheckbox1" <?php if($doctors->specialist=='0'|| $doctors->specialist=='0'){ echo "checked"; }?>  name="specialist" value="0">-->
                    <!--          <label class="form-check-label" for="inlineCheckbox1">No</label>-->
                    <!--    </div>-->
                    <!--    <div class="form-check form-check-inline">-->
                    <!--        <input class="form-check-input" type="radio" id="inlineCheckbox1"  <?php if($doctors->specialist=='1' || $doctors->specialist=='1'){ echo "checked";} ?> name="specialist" value="1">-->
                    <!--        <label class="form-check-label" for="inlineCheckbox1">Yes</label>-->
                    <!--    </div>-->
                    <!--     @else-->
                    <!--      <div class="form-check form-check-inline">-->
                    <!--          <input class="form-check-input" type="radio" id="inlineCheckbox1" <?php if(isset($doctor)){ echo "checked"; } ?>  name="specialist" value="0" checked>-->
                    <!--          <label class="form-check-label" for="inlineCheckbox1" >No</label>-->
                    <!--      </div>-->
                    <!--      <div class="form-check form-check-inline">-->
                    <!--          <input class="form-check-input" type="radio" id="inlineCheckbox2" <?php if(isset($doctor)){ echo "checked"; } ?> name="specialist" value="1">-->
                    <!--          <label class="form-check-label" for="inlineCheckbox1">Yes</label>-->
                    <!--      </div>-->
                    <!--    @endif-->
                    <!--  </div>-->
                    <!--</div>-->



                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Profile Pic<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($doctors))
                           @if($doctors->profile_pic==null)
                           <img src="{{env('APP_URL_WITHOUT_PUBLIC') .'storage/app/no profile.png'}}" style="width: 100px;height: 100px;">
                           @else
                           <img src="{{env('APP_URL_WITHOUT_PUBLIC') .'storage/app/'.$doctors->profile_pic}}" style="width: 100px;height: 100px;">
                           @endif
                          
                          <input type="file" name="doctor_profile" class="form-control-sm">
                        @else
                          <input type="file" name="doctor_profile" class="form-control-sm">
                        @endif
                      </div>
                    </div>


                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Description<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($doctors))
                          <textarea type="text" name="description" class="form-control form-control-sm" value="{{ $doctors->description }}" maxlength="255">{{ $doctors->description }}</textarea>
                        @else
                          <textarea type="text" name="description" class="form-control form-control-sm" value="" maxlength="255">{{ old('description') }}</textarea>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Description Arabic<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($doctors))
                          <textarea type="text" name="ar_description" class="form-control form-control-sm" value="{{ $doctors->ar_description }}" maxlength="255">{{ $doctors->ar_description }}</textarea>
                        @else
                          <textarea type="text" name="ar_description" class="form-control form-control-sm" value="" maxlength="255">{{ old('ar_description') }}</textarea>
                        @endif
                      </div>
                    </div>


                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Speciality<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                          @if(isset($doctors))
                          <select class="form-control form-control-sm required select2" title="Search Speciality" name="speciality[]" multiple="multiple">
                            @foreach($speciality as $speciality)
                              <option value="{!! $speciality->id !!}" <?php if(in_array($speciality->id,$doctor_speciality)){?>selected="selected"<?php }?>>{!! $speciality->name !!}</option>
                            @endforeach
                          </select>
                          @else
                          <select class="form-control form-control-sm required select2" title="Search Speciality" name="speciality[]" multiple="multiple">
                            @foreach($speciality as $speciality)
                              <option value="{!! $speciality->id !!}">{!! $speciality->name !!}</option>
                            @endforeach
                          </select>
                          @endif
                        </div>
                      </div>
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Language<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                          @if(isset($doctors))
                          <select class="form-control form-control-sm required select2" title="Search Language" name="language[]" multiple="multiple">
                            @foreach($language as $language)
                              <option value="{!! $language->id !!}" <?php if(in_array($language->id,$doctor_language)){?>selected="selected"<?php }?>>{!! $language->name !!}</option>
                            @endforeach
                          </select>
                          @else
                          <select class="form-control form-control-sm required select2" title="Search Language" name="language[]" multiple="multiple">
                            @foreach($language as $language)
                              <option value="{!! $language->id !!}">{!! $language->name !!}</option>
                            @endforeach
                          </select>
                          @endif
                        </div>
                      </div>
                      


                   @if(isset($doctors))  
                   <div class="card mb-3">
                      <div class="card-body">
                        <div class="row">
                            <div class="box box-primary" >
                                <label class="col-form-label col-form-label-sm" style="font-size: 1em;">Edit Education Detail</label>
                                <div class="box-body" id='module_edit'>
                                  <?php if($ded){?>
                                    
                                        
                                   
                                  <?php }else{?>
                                          <div class="col-lg-4" style="float: left">
                                              <div class="form-group">
                                                  <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Institute Name</label>                                        
                                                  <input type="text" class="form-control" name="institute_name[]"  value="">
                                              </div>
                                          </div>

                                          <div class="col-lg-3" style="float: left">
                                              <div class="form-group">
                                                    <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Course </label>                                        
                                                    <input type="text" class="form-control" name="course[]"  value="" >
                                              </div>
                                          </div>
                                          
                                         <div class="col-lg-3" style="float: left">
                                            
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Year </label>                                        
                                                        <input type="text" class="date-own form-control" name="year[]"  value="" autocomplete="off">
                                                    </div>
                                            
                                          </div>

                                          <div class="col-lg-2" style="float: left">
                                            <div class="form-group">
                                                  <button type="button" style="float: right;margin-left:4px;margin-top:30px;" class="add_module1 btn btn-primary"><i class="fa fa-plus"></i></button>

                                            </div>
                                          </div>
                                          <div class="col-lg-4" style="float: left">
                                            <div class="form-group">
                                              <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Institute Name Arabic</label> <input type="text" class="form-control" name="ar_institute_name[]"  value="">
                                            </div>
                                          </div>
                                          <div class="col-lg-3" style="float: left">
                                            <div class="form-group">
                                              <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Course Arabic</label>
                                              <input type="text" class="form-control" name="ar_course[]"  value="" >
                                            </div>
                                          </div>

                                  <?php }?>  
                                   </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    @else 
                    <div class="card mb-3">
                      <div class="card-body">
                        <div class="row">
                            <div class="box box-primary" >
                                <label class="col-form-label col-form-label-sm" style="font-size: 1em;">Add Education Detail</label>
                                    <div class="box-body 777" id='module_div'>
                                          <div class="clearfix"></div>
                                          <div class="col-lg-4" style="float: left">
                                            
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Institute Name</label>                                        
                                                <input type="text" class="form-control" name="institute_name[]"  value="">
                                            </div>
                                            
                                          </div>
                                          <div class="col-lg-3" style="float: left">
                                            
                                              <div class="form-group">
                                                    <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Course </label>                                        
                                                    <input type="text" class="form-control" name="course[]"  value="" >
                                              </div>
                                            
                                          </div>
                                          <div class="col-lg-3" style="float: left">
                                              <div class="form-group">
                                                  <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Year </label><input type="text" class="date-own form-control" name="year[]"  value="{{ old('year.0') }}" autocomplete="off" >
                                              </div>
                                          </div>

                                          <div class="col-lg-2" style="float: left">
                                            <div class="form-group">
                                                <button type="button" style="float: right;margin-left:4px;margin-top:30px;" class="add_module btn btn-primary"><i class="fa fa-plus"></i></button>
                                            </div>
                                          </div>

                                          <div class="col-lg-4" style="float: left">
                                            <div class="form-group">
                                              <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Institute Name Arabic</label> <input type="text" class="form-control" name="ar_institute_name[]"  value="">
                                            </div>
                                          </div>
                                          <div class="col-lg-3" style="float: left">
                                            <div class="form-group">
                                              <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Course Arabic</label>
                                              <input type="text" class="form-control" name="ar_course[]"  value="" >
                                            </div>
                                          </div>
                                          <div class="col-lg-3" style="float: left">
                                            <div class="form-group">
                                            </div>
                                          </div>

                                          <div class="col-lg-2" style="float: left">
                                            <div class="form-group">
                                            </div>
                                          </div>
                                           
                                    </div>
                                    
                                    
                            </div>

                      

                        </div>
                      </div>
                    </div>
                    @endif

                    @if(isset($doctors))  
                    <div class="card mb-3">
                      <div class="card-body">
                        <div class="row">
                            <div class="box box-primary" >
                                <label class="col-form-label col-form-label-sm" style="font-size: 1em;">Edit Experience Detail</label>
                                    <div class="box-body" id='exp_edit'>
                                       <?php if($de){?>
                                    
                                        
                                   
                                       <?php }else{?>
                                         <div class="col-lg-4" style="float: left">
                                            <div class="form-group">
                                              <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Name of Hospital</label>                                        
                                              <input type="text" class="form-control" name="hospital_name[]"  value="" >
                                            </div>
                                          </div>
                                          <div class="col-lg-3" style="float: left">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Position </label>
                                                <input type="text" class="form-control" name="position[]"  value="" >
                                            </div>
                                          </div>
                                          <div class="col-lg-3" style="float: left">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Number of Year </label>
                                                <input type="text" class="form-control" name="number_of_year[]"  value="" onkeypress="javascript:return isNumber(event)">
                                            </div>
                                          </div>
                                          <div class="col-lg-2" style="float: left">
                                            <div class="form-group">
                                                  <button type="button" style="float: right;margin-left:4px;margin-top:30px;" class="add_exp1 btn btn-primary"><i class="fa fa-plus"></i></button>

                                            </div>
                                          </div>
                                          <div class="col-lg-4" style="float: left">
                                              <div class="form-group">
                                                <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Name of Hospital Arabic</label>  
                                                <input type="text" class="form-control" name="ar_hospital_name[]"  value="" >
                                              </div>
                                          </div>
                                          <div class="col-lg-3" style="float: left">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Position Arabic</label>
                                                <input type="text" class="form-control" name="ar_position[]"  value="" >
                                            </div>
                                          </div>
                                          <?php }?>  
                                    </div>
                                    
                            </div>

                        </div>
                      </div>
                    </div>
                    @else 
                    <div class="card mb-3">
                      <div class="card-body">
                        <div class="row">
                            <div class="box box-primary" >
                                <label class="col-form-label col-form-label-sm" style="font-size: 1em;">Add Experience Detail</label>
                                <div class="clearfix"></div>
                                <div class="box-body" id='exp_div'>
                                  <div class="col-lg-4" style="float: left">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Name of Hospital</label>  
                                      <input type="text" class="form-control" name="hospital_name[]"  value="" >
                                    </div>
                                  </div>
                                  <div class="col-lg-3" style="float: left">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Position </label>
                                        <input type="text" class="form-control" name="position[]"  value="" >
                                    </div>
                                  </div>
                                  <div class="col-lg-3" style="float: left">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Number of Year </label>
                                      <input type="text" class="form-control" name="number_of_year[]"  value="{{ old('number_of_year.0') }}" >
                                    </div>
                                  </div>
                                  <div class="col-lg-2" style="float: left">
                                    <div class="form-group">
                                      <button type="button" style="float: right;margin-left:4px;margin-top:30px;" class="add_exp btn btn-primary"><i class="fa fa-plus"></i></button>
                                    </div>
                                  </div>

                                  <div class="col-lg-4" style="float: left">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Name of Hospital Arabic</label>  
                                      <input type="text" class="form-control" name="ar_hospital_name[]"  value="" >
                                    </div>
                                  </div>
                                  <div class="col-lg-3" style="float: left">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Position Arabic</label>
                                        <input type="text" class="form-control" name="ar_position[]"  value="" >
                                    </div>
                                  </div>
                                  <div class="col-lg-3" style="float: left">
                                    <div class="form-group">
                                    </div>
                                  </div>
                                  <div class="col-lg-2" style="float: left">
                                    <div class="form-group">
                                    </div>
                                  </div>
                                </div>
                            </div>

                        </div>
                      </div>
                    </div>
                    @endif
                    
                    <!-- <button type="button" class="btn btn-secondary float-left">Cancel</button> -->

                    @if(isset($doctors))
                    <button type="submit" class="btn btn-warning " style="background-color: #003366 !important;border-color: #003366 !important;">Update</button>
                    @else
                     <button type="submit" class="btn btn-warning" style="background-color: #003366 !important;border-color: #003366 !important;">Submit</button>
                    @endif
                   <a href="{{route('admin.doctor.index')}} " class="btn btn-secondary">Cancel</a>  
                  
                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

</div>


@endsection

@section('custom_js')


<script>
    $(document).ready(function () {
          

        var count = 1;
        $('body').on('click', '.add_exp', function () {
            
            $('#exp_div').append('<div class="clearfix"></div><div class="box-body" id="exp_div"> <div class="col-lg-4" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Name of Hospital</label> <input type="text" class="form-control" name="hospital_name[]"  value="" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Position </label> <input type="text" class="form-control" name="position[]"  value="" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Number of year </label> <input type="text" class="form-control" name="number_of_year[]"  value="" onkeypress="javascript:return isNumber(event)"> </div> </div> <div class="col-lg-2" style="float: left"> <div class="form-group"><button type="button" style="float: right;margin-left:4px;margin-top:30px;" class="remove_exp btn btn-primary"><i class="fa fa-minus"></i></button></div> </div><div class="col-lg-4" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Name of Hospital Arabic</label> <input type="text" class="form-control" name="ar_hospital_name[]"  value="" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Position Arabic</label> <input type="text" class="form-control" name="ar_position[]"  value="" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"></div> </div> <div class="col-lg-2" style="float: left"> <div class="form-group"></div> </div> </div>');

            count++;
        });

        $('body').on('click', '.remove_exp', function () {            
             $(this).closest('.box-body').remove();
             
        });

         $('body').on('click', '.add_exp1', function () {
            
            $('#exp_edit').append('<div class="clearfix"></div><div class="box-body" id="exp_div"> <div class="col-lg-4" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Name of Hospital</label> <input type="text" class="form-control" name="hospital_name[]"  value="" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Position </label> <input type="text" class="form-control" name="position[]"  value="" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Number of year </label> <input type="text" class="form-control" name="number_of_year[]"  value="" onkeypress="javascript:return isNumber(event)"> </div> </div> <div class="col-lg-2" style="float: left"> <div class="form-group"> <button type="button" style="float: right;margin-left:4px;margin-top:30px;" class="remove_exp btn btn-primary"><i class="fa fa-minus"></i></button></div> </div><div class="col-lg-4" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Name of Hospital Arabic</label> <input type="text" class="form-control" name="ar_hospital_name[]"  value="" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Position Arabic</label> <input type="text" class="form-control" name="ar_position[]"  value="" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"></div> </div> <div class="col-lg-2" style="float: left"> <div class="form-group"></div> </div></div>');

            count++;
        });


        $('body').on('click', '.add_module', function () {
            
            $('#module_div').append('<div class="clearfix"></div><div class="box-body" id="module_div"> <div class="col-lg-4 999" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Institute Name</label> <input type="text" class="form-control" name="institute_name[]"  value="" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Course </label> <input type="text" class="form-control" name="course[]"  value="" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Year </label> <input type="text" class="date-own form-control" name="year[]"  value="" autocomplete="off"> </div> </div> <div class="col-lg-2" style="float: left"> <div class="form-group"> <button type="button" style="float: right;margin-left:4px;margin-top:30px;" class="remove_module btn btn-primary"><i class="fa fa-minus"></i></button></div> </div> <div class="col-lg-4" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Institute Name Arabic</label> <input type="text" class="form-control" name="ar_institute_name[]"  value="" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Course Arabic</label> <input type="text" class="form-control" name="ar_course[]"  value="" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> </div> </div> <div class="col-lg-2" style="float: left"> <div class="form-group"> </div> </div></div>');

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
            
            $('#module_edit').append('<div class="clearfix"></div><div class="box-body" id="module_div"> <div class="col-lg-4" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Institute Name</label> <input type="text" class="form-control" name="institute_name[]"  value="" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Course </label> <input type="text" class="form-control" name="course[]"  value="" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Year </label> <input type="text" class="date-own form-control" name="year[]"  value="" autocomplete="off" > </div> </div> <div class="col-lg-2" style="float: left"> <div class="form-group"><button type="button" style="float: right;margin-left:4px;margin-top:30px;" class="remove_module btn btn-primary"><i class="fa fa-minus"></i></button> </div> </div><div class="col-lg-4" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Institute Name Arabic</label> <input type="text" class="form-control" name="ar_institute_name[]"  value="" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Course Arabic</label> <input type="text" class="form-control" name="ar_course[]"  value="" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> </div> </div> <div class="col-lg-2" style="float: left"> <div class="form-group"> </div> </div></div>');

            $('.date-own').datepicker({
                   minViewMode: 2,
                   format: 'yyyy'
            });
            count++;
        });

        var details = '<?php echo URL::to('admin/getdataeducation'); ?>';
          
        var doctor_id = $('#doctor_id').val();
            
            $.ajax({
                type:'get',
                url:details,
                data: {doctor_id: doctor_id},
                success:function(res){
                  
                  var count = Object.keys(res).length;
                  $.each(res, function(index, value) {
                    $('#module_edit').append('<div class="clearfix"></div><div class="box-body" id="module_edit'+value.id+'"> <div class="col-lg-4" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Institute Name</label><input type="hidden" id="doctor_education_id" class="doctor_education_id" value="'+value.id+'"> <input type="text" class="form-control" name="institute_name[]"  value="'+value.institute_name+'" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Course </label> <input type="text" class="form-control" name="course[]"  value="'+(value.course ? value.course : "") +'" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Year </label> <input type="text" class="date-own form-control" name="year[]"  value="'+(value.year ? value.year : "") +'" > </div> </div> <div class="col-lg-2" style="float: left"> <div class="form-group"> <button type="button" style="float: right;margin-left:4px;margin-top:30px;" class="add_module1 btn btn-primary '+( (index > 0) ? 'd-none' : '' )+'"><i class="fa fa-plus"></i></button></div> </div><div class="col-lg-4" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Institute Name</label> <input type="text" class="form-control" name="ar_institute_name[]"  value="'+value.ar_institute_name+'" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Course </label> <input type="text" class="form-control" name="ar_course[]"  value="'+(value.ar_course ? value.ar_course : "") +'" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> </div> </div> <div class="col-lg-2" style="float: left"> <div class="form-group"></div> </div></div>');
                  });
                 
                }
          });

        $('body').on('click', '.remove_education', function () {            
              $(this).closest('.box-body').remove(); 
              window.location.reload(); 
              var details = '<?php echo URL::to('admin/removeeducation'); ?>';
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
              var details = '<?php echo URL::to('admin/removeexp'); ?>';
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

        var details = '<?php echo URL::to('admin/getdataexpen'); ?>';
          
        var doctor_id = $('#doctor_id').val();
            
            $.ajax({
                type:'get',
                url:details,
                data: {doctor_id: doctor_id},
                success:function(res){
                  
                  var count = Object.keys(res).length;
                  $.each(res, function(index, value) {
                    $('#exp_edit').append('<div class="clearfix"></div><div class="box-body" id="exp_div"> <div class="col-lg-4" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Name of Hospital</label> <input type="text" class="form-control" name="hospital_name[]"  value="'+value.hospital_name+'" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Position </label> <input type="text" class="form-control" name="position[]"  value="'+value.position+'" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Number of year </label> <input type="text" class="form-control" name="number_of_year[]"  value="'+value.year+'" onkeypress="javascript:return isNumber(event)" > </div> </div> <div class="col-lg-2" style="float: left"> <div class="form-group"> <button type="button" style="float: right;margin-left:4px;margin-top:30px;" class="add_exp1 btn btn-primary '+( (index > 0) ? 'd-none' : '' )+'"><i class="fa fa-plus"></i></button></div> </div><div class="col-lg-4" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Name of Hospital Arabic</label> <input type="text" class="form-control" name="ar_hospital_name[]"  value="'+value.ar_hospital_name+'" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"> <label for="exampleInputEmail1" class="col-form-label col-form-label-sm">Position Arabic</label> <input type="text" class="form-control" name="ar_position[]"  value="'+value.ar_position+'" > </div> </div> <div class="col-lg-3" style="float: left"> <div class="form-group"></div> </div> <div class="col-lg-2" style="float: left"> <div class="form-group"></div> </div></div>');
                  });
                }
          });

var val=$('#hospital_id').find('option:selected').text();
if(val=='ASK' || val=='ask' || val=='Ask')
                      {
                          $("#commision").text("");
                          $("#commision").append("ASK Commission(%)");
                      }
                      else
                      {
                          $("#commision").text("");
                          $("#commision").append("Hospital Commission(%)");
                      }

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
                   minViewMode: 2,
                   format: 'yyyy'
            });
           $(function() {
                    $("body").on("change","#hospital_id", function(){

                      var val=$(this).find('option:selected').text();

                      if(val=='ASK' || val=='ask' || val=='Ask')
                      {
                          $("#commision").text("");
                          $("#commision").append("ASK Commission(%)");
                      }
                      else
                      {
                          $("#commision").text("");
                          $("#commision").append("Hospital Commission(%)");
                      }
                      
                    });
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
             
        
String.prototype.toArabic= function() {
      return this.replace(/\d/g, d =>  '٠١٢٣٤٥٦٧٨٩'[d])
    }

          $(function(){
              $("body").on("change",".hospital_id", function(){
                   var elmId = $(this).val();

                   var selectedCountry = $(this).find(':selected').attr('data-value');
                  

                   var details = '<?php echo URL::to('admin/getclinicdoctor'); ?>';
                   
                   $.ajax({
                        type:'get',
                        url:details,
                        data: {elmId: elmId},
                        success:function(res){

                           var code='ASK'+' '+elmId+'-'+res;
                           var arabic_code='طلب'+' '+elmId.toArabic()+'-'+res.toArabic();
                           $('#ask_id_code').val(code);
                           $('#ask_id_arcode').val(arabic_code);


                        }
                    });

                   
              });
           });

          $(document).ready(function () {
             var val=$('.doctor_code').val();
              var arabic=val.toArabic();
              $('#doctor_code_ar').val(arabic);
              $("body").on("blur",".doctor_code", function(){
              var val=$(this).val();
              var arabic=val.toArabic();
              $('#doctor_code_ar').val(arabic);
            });
          });

          $(function(){

            $("body").on("blur",".drfees", function(){
              var val=$(this).val();
              var arabic=val.toArabic();
              $('#drfees_arabic').val(arabic);
            });
          });

          $(document).ready(function () {
                var val=$('.discount').val();
                var fees=$('.drfees').val();
                var discount=fees*val/100;
                var totalprice=fees-discount;
                var vat=$('#vatamount').val();
              var vatprice=totalprice*vat/100;
              var totalvatprice=totalprice+vatprice;
              var totalpriceRound=totalvatprice.toFixed(2)
                $('#discountamount').val(totalpriceRound);
                var commisionval=$('.commision').val();
                var commisionfees=$('#discountamount').val();
                var commisionamount=commisionfees*commisionval/100;
                var commisiontotalprice=commisionfees-commisionamount;
                var priceRound=commisionamount.toFixed(2)
                $('#commisionamount').val(priceRound);
          });
          $(function(){

            $("body").on("blur",".discount", function(){
              var val=$(this).val();
              var fees=$('.drfees').val();
              var discount=fees*val/100;
              var totalprice=fees-discount;
              var vat=$('#vatamount').val();
              var vatprice=totalprice*vat/100;
              var totalvatprice=totalprice+vatprice;
              var totalpriceRound=totalvatprice.toFixed(2)
              $('#discountamount').val(totalpriceRound);
            });

            $("body").on("blur",".commision", function(){
              var commisionval=$(this).val();
              var commisionfees=$('#discountamount').val();
              var commisionamount=commisionfees*commisionval/100;
              var commisiontotalprice=commisionfees-commisionamount;
              var priceRound=commisionamount.toFixed(2)
              $('#commisionamount').val(priceRound);
            });

          });

        </script>
<script>
    // WRITE THE VALIDATION SCRIPT.
    function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }    
</script>
<script>
  function handleChange(input) {
    if (input.value < 0) input.value = 0;
    if (input.value > 100) input.value = 100;
  }
</script>
@endsection
