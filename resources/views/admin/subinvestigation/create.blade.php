@extends('layouts.admin')

@section('content')

<div id="content">

        <div class="container-fluid">

          <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  @if(isset($investigation))
                  <b>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.investigation.index') }}" class="breadcrumb-item active crumb">Update :: Investigation</a></li>
                  </b>
                  @else
                    <b>
                          <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.investigation.index') }}" class="breadcrumb-item active crumb">Add :: Investigation</a></li>
                    </b>
                  @endif
                </ol>
            </nav>

          <!-- Page Heading -->
          <div class="row">
            <div class="col-8">
              @if(isset($investigation))
                
                <!-- <div class="caption pull-left" style="padding-bottom: 1em;padding-left: 1.1em;">
                    <i class="fa fa-th-list"></i> &nbsp;
                    <span class="caption-subject sbold uppercase font-dark">Update :: Investigation</span>
                </div> -->

              @else
                

                <!-- <div class="caption pull-left" style="padding-bottom: 1em;padding-left: 1.1em;">
                    <i class="fa fa-th-list"></i> &nbsp;
                    <span class="caption-subject sbold uppercase font-dark">Add :: Investigation</span>
                </div> -->

              @endif
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

                  @if(isset($investigation))
                    <form class="form-horizontal" action="{{ route('admin.investigation.update') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" value="{{ $investigation->id }}" name="id" />
                  @else
                    <form class="form-horizontal" action="{{ route('admin.investigation.store') }}" method="post" enctype="multipart/form-data">
                  @endif
                    
                    @csrf

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Test Name English<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($investigation))
                            <input type="text" name="test_english" class="form-control" value="{{$investigation->testname_english}}">
                        @else
                            <input type="text" name="test_english" class="form-control">
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Test Name Arabic<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($investigation))
                            <input type="text" name="test_arabic" class="form-control" value="{{$investigation->testname_arabic}}">
                        @else
                            <input type="text" name="test_arabic" class="form-control">
                        @endif
                      </div>
                    </div>


                     <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Test Type<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($investigation))
                          <select class="form-control form-control-sm required" title="Search Speciality" name="test_type" >
                            
                            <option value="">Select Type</option>
                            @foreach($doc_types as $doc)
                            <option value="{{$doc->id}}" {{ $investigation->type_id ==$doc->id  ? 'selected="selected"' : '' }}>{{$doc->name}}</option>
                             @endforeach
                          </select>
                          <input type="hidden" name="type_name" value="{{$doc->name}}">
                        @else
                         <select class="form-control form-control-sm required" title="Search Speciality" name="test_type" >
                          
                            <option value="">Select Type</option>
                            @foreach($doc_types as $doc)
                            <option value="{{$doc->id}}">{{$doc->name}}</option>
                            @endforeach
                          </select>
                          <input type="hidden" name="type_name" value="{{$doc->name}}">
                        @endif
                      </div>
                    </div>

                     @if(isset($investigation))
                      <button type="submit" class="btn btn-warning">Update</button>
                     @else
                      <button type="submit" class="btn btn-warning">Submit</button>
                     @endif
                      <a href="{{route('admin.investigation.index')}} " class="btn btn-secondary">Cancel</a>
                   
                  
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
