

@extends('layouts.admin')

@section('content')

<div id="content">

        <div class="container-fluid">

          <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  @if(isset($Vat))
                  <b>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.vat.index') }}" class="breadcrumb-item active crumb">Update :: Vat</a></li>
                  </b>
                  @else
                  <b>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.vat.index') }}" class="breadcrumb-item active crumb">Add :: Vat</a></li>
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
                
                <div class="col-8">

                  @if(isset($Vat))
                    <form class="form-horizontal" action="{{ route('admin.vat.update') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" value="{{ $Vat->id }}" name="id" />
                  @else
                    <form class="form-horizontal" action="{{ route('admin.vat.store') }}" method="post" enctype="multipart/form-data">
                  @endif
                    
                    @csrf

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Price<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($Vat))
                          <input type="text" name="vatprice" class="form-control form-control-sm" value="{{ $Vat->vat }}" >
                        @else
                          <input type="text" name="vatprice" class="form-control form-control-sm" value="{{ old('vatprice') }}">
                        @endif
                      </div>
                    </div>
                    
                    @if(isset($Vat))
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