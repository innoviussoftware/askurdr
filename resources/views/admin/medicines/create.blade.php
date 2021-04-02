@extends('layouts.admin')

@section('content')

<div id="content">

        <div class="container-fluid">

          <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  @if(isset($medicine))
                  <b>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.medicines.index') }}" class="breadcrumb-item active crumb">Update :: Medicine</a></li>
                  </b>
                  @else
                  <b>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.medicines.index') }}" class="breadcrumb-item active crumb">Add :: Medicine</a></li>
                  </b>
                  @endif
                </ol>
          </nav>

          <!-- Page Heading -->
          <div class="row">
            <div class="col-8">
              @if(isset($medicine))
                
                <!-- <div class="caption pull-left" style="padding-bottom: 1em;padding-left: 1.1em;">
                    <i class="fa fa-th-list"></i> &nbsp;
                    <span class="caption-subject sbold uppercase font-dark">Update :: Medicine</span>
                </div> -->

              @else
                

               <!--  <div class="caption pull-left" style="padding-bottom: 1em;padding-left: 1.1em;">
                    <i class="fa fa-th-list"></i> &nbsp;
                    <span class="caption-subject sbold uppercase font-dark">Add :: Medicine</span>
                </div> -->

              @endif
            </div>
            <!-- <div class="col-4 text-right">
              <a href="{{ route('admin.medicines.index') }}" class="btn btn-secondary btn-sm rounded-circle"><i class="fa fa-arrow-left"></i></a>
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

                  @if(isset($medicine))
                    <form class="form-horizontal" action="{{ route('admin.medicines.update') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" value="{{ $medicine->id }}" name="id" />
                  @else
                    <form class="form-horizontal" action="{{ route('admin.medicines.store') }}" method="post" enctype="multipart/form-data">
                  @endif
                    
                    @csrf

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Medicine Name<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($medicine))
                          <input type="text" name="name" class="form-control form-control-sm" value="{{ $medicine->name }}">
                        @else
                          <input type="text" name="name" class="form-control form-control-sm" value="{{ old('name') }}">
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Dosage <span class="text-danger">*</span></label>
                      <div class="col-sm-4">
                        @if(isset($medicine))
                          <input type="text" name="dose" class="form-control form-control-sm" value="{{ $medicine->dose }}">
                        @else
                          <input type="text" name="dose" class="form-control form-control-sm" value="{{ old('dose') }}">
                        @endif
                      </div>
                      <div class="col-sm-4">
                        @if(isset($medicine))
                           <select class="form-control form-control-sm required medicines_change" title="Search Medicines" name="units" id="medicines0" data-count="0">
                            <option value="">Select Unit</option>
                            <option value="mg"  <?php if($medicine->unit=="mg"){?>selected="selected"<?php }?>>Mg</option>
                            <option value="ml"  <?php if($medicine->unit=="ml"){?>selected="selected"<?php }?>>Ml</option>
                            <option value="g"   <?php if($medicine->unit=="g"){?>selected="selected"<?php }?>>G</option>
                            <option value="mcg" <?php if($medicine->unit=="mcg"){?>selected="selected"<?php }?>>Mcg</option>
                        </select>  
                        @else
                          <select class="form-control form-control-sm required medicines_change" title="Search Medicines" name="units" id="medicines0" data-count="0">
                            <option value="">Select Unit</option>
                            <option value="mg">Mg</option>
                            <option value="ml">Ml</option>
                            <option value="g">G</option>
                            <option value="mcg">Mcg</option>
                          </select>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Route<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($medicine))
                          <input type="text" name="route" class="form-control form-control-sm" value="{{ $medicine->route }}">
                        @else
                          <input type="text" name="route" class="form-control form-control-sm" value="{{ old('route') }}">
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Frequency<span class="text-danger">*</span></label>
                      @if(isset($medicine))
                      <div class="col-sm-2">
                        
                          <input type="text" name="frequency" class="form-control form-control-sm" value="{{ $medicine->frequency }}">
                        
                      </div>
                      <div class="col-sm-2">
                        
                          <input type="text" name="frequency2" class="form-control form-control-sm" value="{{ $medicine->frequency2 }}">
                      </div>
                      <div class="col-sm-2">
                        
                          <input type="text" name="frequency3" class="form-control form-control-sm" value="{{ $medicine->frequency3 }}">
                        
                      </div>
                      @else
                      <div class="col-sm-2">
                        
                          <input type="text" name="frequency" class="form-control form-control-sm" value="{{ old('frequency') }}">
                        
                      </div>
                      <div class="col-sm-2">
                        
                          <input type="text" name="frequency2" class="form-control form-control-sm" value="{{ old('frequency2') }}">
                      </div>
                      <div class="col-sm-2">
                        
                          <input type="text" name="frequency3" class="form-control form-control-sm" value="{{ old('frequency3') }}">
                        
                      </div>
                      @endif
                    </div>
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Duration<span class="text-danger">*</span></label>

                      <div class="col-sm-9">
                        @if(isset($medicine))
                          <input type="text" name="duration" class="form-control form-control-sm" value="{{ $medicine->duration }}">
                        @else
                          <input type="text" name="duration" class="form-control form-control-sm" value="{{ old('duration') }}">
                        @endif
                      </div>
                    </div>
                     @if(isset($medicine))
                      <button type="submit" class="btn btn-warning">Update</button>
                     @else
                      <button type="submit" class="btn btn-warning">Submit</button>
                     @endif
                      <a href="{{route('admin.medicines.index')}} " class="btn btn-secondary">Cancel</a>
                   
                  
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
