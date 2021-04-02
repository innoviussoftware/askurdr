@extends('layouts.admin')

@section('content')


<div id="content">

        <div class="container-fluid">

          <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                 @if(isset($patients))
                  <b>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.patientlist.index') }}" class="breadcrumb-item active crumb">Update :: Patient</a></li>
                  </b>
                  @else
                  <b>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.patientlist.index') }}" class="breadcrumb-item active crumb">Add :: Patient</a></li>
                  </b>
                  @endif
                </ol>
          </nav>

          <!-- Page Heading -->
          <div class="row">
              <div class="col-8">
                  <!-- <div class="caption pull-left" style="padding-bottom: 1em;padding-left: 1.1em;">
                      <i class="fa fa-th-list"></i> &nbsp;
                      <span class="caption-subject sbold uppercase font-dark">Update :: Patient</span>
                  </div> -->
              </div>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="row">

                <div class="col-12"> 
                  @if (count($errors) > 0)
                    <div class="alert alert-danger">
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

                  @if(isset($patients))
                    <form class="form-horizontal" action="{{ route('admin.patientlist.update') }}" method="post" enctype="multipart/form-data">
                       <input type="text" id="hidden_image" style="display: none;" name="hidden_image" value="{{ $patients->profile_pic }}" placeholder="Profile Pic">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" value="{{ $patients->id }}" name="patient_id" />
                  @else
                  <form class="form-horizontal" action="{{ route('admin.patientlist.store') }}" method="post" enctype="multipart/form-data">
                  @endif
                  @csrf  

                  @if(isset($patients))
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">First Name<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="firstname" class="form-control form-control-sm" value="{{ $patients->first_name }}">
                        </div>
                    </div>
                  @else
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">First Name<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="firstname" class="form-control form-control-sm" value="">
                        </div>
                    </div>
                  @endif

                  @if(isset($patients))
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Last Name<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="lastname" class="form-control form-control-sm" value="{{ $patients->last_name }}">
                        </div>
                    </div>
                  @else
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Last Name<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="lastname" class="form-control form-control-sm" value="">
                        </div>
                    </div>
                  @endif

                  @if(isset($patients))
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">National Id <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="email" class="form-control form-control-sm" onkeypress="javascript:return isNumber(event)" maxlength="10" minlength="10" value="{{ $patients->email }}" readonly>
                        </div>
                    </div>
                  @else
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">National Id <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="email" class="form-control form-control-sm" onkeypress="javascript:return isNumber(event)" maxlength="10" minlength="10" value="">
                        </div>
                    </div>
                  @endif
                    
                  @if(isset($patients))
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Mobile<span class="text-danger">*</span></label>
                      <div class="col-sm-2">
                        @if(isset($patients))
                          <select class="form-control form-control-sm select2" name="countrycode">
                            <option value=" form-control  form-control-sm" >Code</option>
                            @foreach($code as $code)
                            <option value="+{{$code->phonecode}}" <?php if($patients->countrycode==$code->phonecode){ echo "selected";}?>>+{{$code->phonecode}}</option>
                            @endforeach
                          </select>
                        @else

                          <select class=" form-control form-control-sm select2" name="countrycode">
                            <option class=" form-control form-control-sm" value="" >Code</option>
                            @foreach($code as $code)
                            <option class="form-control" value="+{{$code->phonecode}}">+{{$code->phonecode}}</option>
                            @endforeach
                          </select>
                        @endif
                      </div>
                      <div class="col-sm-4">
                          <input type="text" name="mobile" class="form-control form-control-sm" onkeypress="javascript:return isNumber(event)" maxlength="10" minlength="9" value="{{ $patients->mobile }}" required="required">
                      </div>
                    </div>
                  @else
                     <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Mobile<span class="text-danger">*</span></label>
                      <div class="col-sm-2">
                        @if(isset($patients))
                          <select class="form-control form-control-sm select2" name="countrycode">
                            <option value=" form-control  form-control-sm" >Code</option>
                            @foreach($code as $code)
                            <option value="+{{$code->phonecode}}" <?php if($patients->countrycode==$code->phonecode){ echo "selected";}?>>+{{$code->phonecode}}</option>
                            @endforeach
                          </select>
                        @else

                          <select class=" form-control form-control-sm select2" name="countrycode">
                            <option class=" form-control form-control-sm" value="" >Code</option>
                            @foreach($code as $code)
                            <option class="form-control" value="+{{$code->phonecode}}">+{{$code->phonecode}}</option>
                            @endforeach
                          </select>
                        @endif
                      </div>
                      <div class="col-sm-4">
                          <input type="text" name="mobile" class="form-control form-control-sm" maxlength="10" minlength="9" value="" >
                      </div>
                    </div>
                  @endif

                  <!-- @if(isset($patients))
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Email Address<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                          <input type="email"  name="email_address" class="form-control form-control-sm" value="{{ $patients->email_address }}" required="required">
                      </div>
                    </div>
                  @else
                     <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Email Address<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                          <input type="email" name="email_address" class="form-control form-control-sm"   value="" >
                      </div>
                    </div>
                  @endif -->

                  @if(isset($patients))
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Date of birth<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                          <input type="text"  name="date_of_birth" class="form-control form-control-sm cdatepicker" value="{{ $patients->date_of_birth }}" required="required">
                      </div>
                    </div>
                  @else
                     <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Date of birth<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                          <input type="text" data-date-end-date="0d" name="date_of_birth" class="form-control form-control-sm cdatepicker"   value="" >
                      </div>
                    </div>
                  @endif
                  @if(isset($patients))
                  <div class="form-group row">
                    <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Add Wallet Price(SAR)</label>
                    <div class="col-sm-9">
                        <input type="number" name="walletprice" maxlength="3" class="form-control form-control-sm" value="">
                    </div>
                  </div>
                  @endif
                  @if(isset($patients))
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Gender<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="inlineCheckbox1" <?php if($patients->gender=='Male'|| $patients->gender=='male'){ echo "checked"; }?>  name="gender" value="Male">
                                    <label class="form-check-label" for="inlineCheckbox1">Male</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineCheckbox1"  <?php if($patients->gender=='Female' || $patients->gender=='female'){ echo "checked";} ?> name="gender" value="Female">
                                <label class="form-check-label" for="inlineCheckbox1">Female</label>
                            </div>
                        </div>
                    </div>
                  @else
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Gender<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="inlineCheckbox1"name="gender" value="Male" checked>
                                    <label class="form-check-label" for="inlineCheckbox1">Male</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineCheckbox1" <?php if(isset($patient)){ echo "checked"; } ?>name="gender" value="Female">
                                <label class="form-check-label" for="inlineCheckbox1">Female</label>
                            </div>
                        </div>
                    </div>
                  @endif

                  @if(isset($patients))
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Profile Pic</label>
                      <div class="col-sm-9">
                        
                           @if($patients->profile_pic==null)
                           <img src="{{env('APP_URL_WITHOUT_PUBLIC') .'storage/app/no profile.png'}}" style="width: 100px;height: 100px;">
                           @else
                           <img src="{{env('APP_URL_WITHOUT_PUBLIC') .'storage/app/'.$patients->profile_pic}}" style="width: 100px;height: 100px;">
                           @endif
                          
                          <input type="file" name="patient_profile" class="form-control-sm">
                        
                         
                      </div>
                    </div>
                  @else
                  <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Profile Pic</label>
                      <div class="col-sm-9">
                        
                           
                          <input type="file" name="patient_profile" class="form-control-sm">
                        
                         
                      </div>
                    </div>
                  @endif
                  @if(isset($patients))
                    
                      <button type="submit" class="btn btn-warning">Update</button>
                  @else
                      <button type="submit" class="btn btn-warning">Submit</button>
                  @endif
                      <a href="{{route('admin.patientlist.index')}} " class="btn btn-secondary">Cancel</a>
                  
                  
                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

</div>
<script>
    // WRITE THE VALIDATION SCRIPT.
    function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }    
</script>
<script type="text/javascript">
  $('.cdatepicker').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy',
      endDate: "today"
    })
  $(function() {
  $('.selectpicker').selectpicker();
});
</script>
@endsection

@section('custom_js')

@endsection
