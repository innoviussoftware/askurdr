

@extends('layouts.admin')

@section('content')

<div id="content">

        <div class="container-fluid">

          <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                 
                  <b>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.hospital.index') }}" class="breadcrumb-item active crumb">Change  Password</a></li>
                  </b>
                  
                </ol>
            </nav>
          <!-- Page Heading -->
          <div class="row">
            <div class="col-8">
              @if(isset($clinic))
              @else
              @endif
            </div>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
            	 @if ($message = Session::get('success'))
		              <div class="alert alert-success alert_msg">            
		                    <span>{{ $message }}</span>
		                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		              </div>
              	@endif
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
              <div class="row">

               
                
                <div class="col-8">

                  
                    <form class="form-horizontal" action="{{ route('admin.update.password') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" value="{{ $profile->id }}" name="id" />
                    <input type="text" id="hidden_image" style="display: none;" name="hidden_image" value="{{ $profile->profile_pic }}" placeholder="Profile Pic">
                 

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Old Password<span class="text-danger">*</span></label>
                      <div class="col-sm-9">                        
                          <input type="password" name="oldpassword" class="form-control form-control-sm" value="">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">New Password<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                          <input type="password" name="newpassword" class="form-control form-control-sm" value="">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Confirm Password<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                          <input type="password" name="confirmpassword" class="form-control form-control-sm" value="">
                      </div>
                    </div>

                    
                    <button type="submit" class="btn btn-warning ">Update</button>
                    <a href="{{route('admin.home')}} " class="btn btn-secondary">Cancel</a>
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