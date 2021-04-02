@extends('layouts.admin')

@section('content')

<div id="content">

        <div class="container-fluid">

          <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  @if(isset($MasterAdminSetting))
                  <b>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.mastersettings.index') }}" class="breadcrumb-item active crumb">Update :: Setting</a></li>
                  </b>
                  @else
                  <b>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.mastersettings.index') }}" class="breadcrumb-item active crumb">Add :: Setting</a></li>
                  </b>
                  @endif
                </ol>
            </nav>
          <!-- Page Heading -->
          <div class="row">
            <div class="col-8">
            

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
                
                <div class="col-12">

                  @if(isset($MasterAdminSetting))
                    <form class="form-horizontal" action="{{ route('admin.mastersettings.update') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" value="{{ $MasterAdminSetting->id }}" name="id" />
                  @else
                    <form class="form-horizontal" action="{{ route('admin.mastersettings.store') }}" method="post" enctype="multipart/form-data">
                  @endif
                    
                    @csrf

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Mobile<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($MasterAdminSetting))
                          <input type="text" name="mobile" class="form-control form-control-sm" value="{{ $MasterAdminSetting->mobile }}" >
                        @else
                          <input type="text" name="mobile" class="form-control form-control-sm" value="{{ old('mobile') }}">
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Arabic Mobile<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($MasterAdminSetting))
                          <input type="text" name="ar_mobile" class="form-control form-control-sm" value="{{ $MasterAdminSetting->ar_mobile }}" >
                        @else
                          <input type="text" name="ar_mobile" class="form-control form-control-sm" value="{{ old('ar_mobile') }}">
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Email<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($MasterAdminSetting))
                          <input type="text" name="email" class="form-control form-control-sm" value="{{ $MasterAdminSetting->email }}" >
                        @else
                          <input type="text" name="email" class="form-control form-control-sm" value="{{ old('email') }}">
                        @endif
                      </div>
                    </div>

                     <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Arabic Email<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($MasterAdminSetting))
                          <input type="text" name="ar_email" class="form-control form-control-sm" value="{{ $MasterAdminSetting->ar_email }}" >
                        @else
                          <input type="text" name="ar_email" class="form-control form-control-sm" value="{{ old('ar_email') }}">
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Description<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($MasterAdminSetting))
                          <textarea class="form-control" name="ar_description">{{ $MasterAdminSetting->description }}</textarea>
                        @else
                          <textarea class="form-control" name="ar_description"></textarea>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Arabic Description<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($MasterAdminSetting))
                          <textarea class="form-control" name="ar_description">{{ $MasterAdminSetting->ar_description }}</textarea>
                        @else
                          <textarea class="form-control" name="ar_description"></textarea>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Price<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($MasterAdminSetting))
                          <input type="text" name="price" class="form-control form-control-sm" value="{{ $MasterAdminSetting->price }}" >
                        @else
                          <input type="text" name="price" class="form-control form-control-sm" value="{{ old('price') }}">
                        @endif
                      </div>
                    </div>
                    
                    @if(isset($MasterAdminSetting))
                    <button type="submit" class="btn btn-warning ">Update</button>
                    @else
                    <button type="submit" class="btn btn-warning">Submit</button>
                    @endif
                    <a href="{{route('admin.vat.index')}} " class="btn btn-secondary">Cancel</a>
                    
                  
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