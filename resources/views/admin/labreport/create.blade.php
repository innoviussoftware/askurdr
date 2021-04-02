@extends('layouts.admin')

@section('content')

<div id="content">

        <div class="container-fluid">

          <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  @if(isset($labreport))
                  <b>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.investigationreport.index') }}" class="breadcrumb-item active crumb">Update :: Investigation</a></li>
                  </b>
                  @else
                    <b>
                          <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.investigationreport.index') }}" class="breadcrumb-item active crumb">Add :: Investigation</a></li>
                    </b>
                  @endif
                </ol>
            </nav>

          <!-- Page Heading -->
          <div class="row">
            <div class="col-8">
             
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

                  @if(isset($labreport))
                    <form class="form-horizontal" action="{{ route('admin.investigationreport.update') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" value="{{ $labreport->id }}" name="id" />
                  @else
                    <form class="form-horizontal" action="{{ route('admin.investigationreport.store') }}" method="post" enctype="multipart/form-data">
                  @endif
                    
                    @csrf

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Investigation Name<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($labreport))
                          <select class="form-control form-control-sm required" title="Search Speciality" name="test_type" >
                            
                            <option value="">Select Investigation</option>
                            @foreach($investigation as $investig)
                            <option value="{{$investig->id}}" {{ $labreport->investigation_id ==$investig->id  ? 'selected="selected"' : '' }}>{{$investig->testname_english}}</option>
                             @endforeach
                          </select>
                        @else
                         <select class="form-control form-control-sm required" title="Search Speciality" name="test_type" >
                            <option value="">Select Investigation</option>
                            @foreach($investigation as $investig)
                            <option value="{{$investig->id}}">{{$investig->testname_english}}</option>
                            @endforeach
                          </select> 
                        @endif
                      </div>
                    </div>

                     <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Patient Name<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($labreport))
                          <select class="form-control form-control-sm required" title="Search Speciality" name="patient_name" >
                            <option value="">Select Patient</option>
                            @foreach($patients as $patient)
                              <option value="{!! $patient->id !!}" {{ $patient->id == $labreport->patient_id ? 'selected="selected"' : '' }}>{!! $patient->first_name !!} {!! $patient->last_name !!}</option>
                            @endforeach
                          </select>
                        @else
                          <select class="form-control form-control-sm required" title="Search Speciality" name="patient_name" >
                            <option value="">Select Patient</option>
                            @foreach($patients as $patient)
                              <option value="{!! $patient->id !!}">{!! $patient->first_name !!} {!! $patient->last_name !!}</option>
                            @endforeach
                          </select>
                        @endif
                      </div>
                    </div>


                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Note<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($labreport))
                            <input type="text" name="note" class="form-control" value="{{$labreport->note}}">
                        @else
                            <input type="text" name="note" class="form-control">
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Result<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($labreport))
                            <input type="text" name="result" class="form-control" value="{{$labreport->result}}">
                        @else
                            <input type="text" name="result" class="form-control">
                        @endif
                      </div>
                    </div>
                     @if(isset($labreport))
                      <button type="submit" class="btn btn-warning">Update</button>
                     @else
                      <button type="submit" class="btn btn-warning">Submit</button>
                     @endif
                      <a href="{{route('admin.investigationreport.index')}} " class="btn btn-secondary">Cancel</a>
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
