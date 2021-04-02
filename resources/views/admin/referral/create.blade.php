@extends('layouts.admin')

@section('content')

<div id="content">

        <div class="container-fluid">

          <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  @if(isset($referral))
                  <b>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.refreal.index') }}" class="breadcrumb-item active crumb">Update :: Referral</a></li>
                  </b>
                   @else
                   <b>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.refreal.index') }}" class="breadcrumb-item active crumb">Add :: Referral</a></li>
                  </b>
                    @endif
                </ol>
            </nav>

          <!-- Page Heading -->
          <div class="row">
            <div class="col-8">
              @if(isset($referral))
                
                <!-- <div class="caption pull-left" style="padding-bottom: 1em;padding-left: 1.1em;">
                    <i class="fa fa-th-list"></i> &nbsp;
                    <span class="caption-subject sbold uppercase font-dark">Update :: Referral</span>
                </div> -->

              @else
                

                <!-- <div class="caption pull-left" style="padding-bottom: 1em;padding-left: 1.1em;">
                    <i class="fa fa-th-list"></i> &nbsp;
                    <span class="caption-subject sbold uppercase font-dark">Add :: Referral</span>
                </div> -->

              @endif
            </div>
            <!-- <div class="col-4 text-right">
              <a href="{{ route('admin.refreal.index') }}" class="btn btn-secondary btn-sm rounded-circle"><i class="fa fa-arrow-left"></i></a>
            </div> -->
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

                  @if(isset($referral))
                    <form class="form-horizontal" action="{{ route('admin.refreal.update') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" value="{{ $referral->id }}" name="id" />
                  @else
                    <form class="form-horizontal" action="{{ route('admin.refreal.store') }}" method="post" enctype="multipart/form-data">
                  @endif
                    
                    @csrf

                    
                     <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Speciality<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($referral))
                          <select class="form-control form-control-sm required" title="Search Speciality" name="speciality" >
                            <option value="">Select Speciality</option>
                            @foreach($speciality as $speciality)
                              <option value="{!! $speciality->id !!}" {{ $speciality->id == $referral->speciality_id ? 'selected="selected"' : '' }}>{!! $speciality->name !!}</option>
                            @endforeach
                          </select>
                        @else
                          <select class="form-control form-control-sm required" title="Search Speciality" name="speciality">
                            <option value="">Select Speciality</option>
                            @foreach($speciality as $speciality)
                              <option value="{!! $speciality->id !!}">{!! $speciality->name !!}</option>
                            @endforeach
                          </select>
                        @endif
                      </div>
                    </div>

                     <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Doctor Name<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($referral))
                          <select class="form-control form-control-sm required" title="Search Speciality" name="doctor_name" >
                            <option value="">Select Doctor</option>
                            @foreach($doctors as $doctor)
                              <option value="{!! $doctor->id !!}" {{ $doctor->id == $referral->user_id ? 'selected="selected"' : '' }}>{!! $doctor->first_name !!} {!! $doctor->last_name !!}</option>
                            @endforeach
                          </select>
                        @else
                          <select class="form-control form-control-sm required" title="Search Speciality" name="doctor_name" >
                            <option value="">Select Doctor</option>
                            @foreach($doctors as $doctor)
                              <option value="{!! $doctor->id !!}">{!! $doctor->first_name !!} {!! $doctor->last_name !!}</option>
                            @endforeach
                          </select>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Patient Name<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($referral))
                          <select class="form-control form-control-sm required" title="Search Speciality" name="patient_name" >
                            <option value="">Select Patient</option>
                            @foreach($patients as $patient)
                              <option value="{!! $patient->id !!}" {{ $patient->id == $referral->patient_id ? 'selected="selected"' : '' }}>{!! $patient->first_name !!} {!! $doctor->last_name !!}</option>
                            @endforeach
                          </select>
                        @else
                          <select class="form-control form-control-sm required" title="Search Speciality" name="patient_name" >
                            <option value="">Select Patient</option>
                            @foreach($patients as $patient)
                              <option value="{!! $patient->id !!}">{!! $patient->first_name !!} {!! $doctor->last_name !!}</option>
                            @endforeach
                          </select>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Diagnosis<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($referral))
                          <textarea class="form-control" name="diagonis">{{$referral->diagnosis}}</textarea>
                        @else
                          <textarea class="form-control" name="diagonis"></textarea>
                        @endif
                      </div>
                    </div>

                     <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Reason of Referral<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($referral))
                          <textarea class="form-control" name="reason_refreal">{{$referral->reason_of_refreal}}</textarea>
                        @else
                          <textarea class="form-control" name="reason_refreal"></textarea>
                        @endif
                      </div>
                    </div>


                     
                     @if(isset($referral))
                      <button type="submit" class="btn btn-warning">Update</button>
                     @else
                      <button type="submit" class="btn btn-warning">Submit</button>
                     @endif
                      <a href="{{route('admin.refreal.index')}} " class="btn btn-secondary">Cancel</a>
                   
                  
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

@endsection
