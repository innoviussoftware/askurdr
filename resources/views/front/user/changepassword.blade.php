@extends('layouts.front')

@section('content')
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
                      <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('front.home.changepassword') }}" class="breadcrumb-item active crumb">Change Password </a></li>
                    </b>
                    
                  </ol>
              </nav>
          <form method="post" action="{{ route('front.home.password') }}" enctype="multipart/form-data">
            @csrf

                <div class="form-group col-md-12">
                  <label for="inputEmail4">Old Password</label>
                  	<div class="input-group">
						<input type="password" class="form-control" id="password1" placeholder="Old Password" name='oldpassword'>
						<span class="input-group-addon show_password" id="show_password"><i class="fa fa-fw fa-eye-slash field_icon toggle-password1"></i></span>
				 	</div>
                </div>

                <div class="form-group col-md-12">
                  <label for="inputPassword4">New Password</label>
                  <div class="input-group">
						<input type="password" class="form-control" id="password2" placeholder="New Password" name='newpassword'>
						<span class="input-group-addon" id="show_password"><i class="fa fa-fw fa-eye-slash field_icon toggle-password2"></i></span>
				 	</div>
                </div>

	            <div class="form-group col-md-12">
	                <label for="inputAddress">Retype Password</label>
	                <div class="input-group">
						<input type="password" class="form-control" id="password3" placeholder="Retype Password" name='repassword'>
						<span class="input-group-addon show_password" id="show_password"><i class="fa fa-fw fa-eye-slash field_icon toggle-password3"></i></span>
				 	</div>
	            </div>

               	<div class="form-group col-md-12">
                	<button type="submit" class="btn btn-primary">Submit</button>
              	</div>

          </form>

      </div>
  	</div>
</div>
<script type="text/javascript">
	$(function() {
          
            $("body").on("click",".toggle-password1", function(){
            	$(this).toggleClass("fa-eye fa-eye-slash");
					  var input = $("#password1");
					  if (input.attr("type") === "password") {
					    input.attr("type", "text");
					  } else {
					    input.attr("type", "password");
					  }

            });

            $("body").on("click",".toggle-password2", function(){
            	$(this).toggleClass("fa-eye fa-eye-slash");
					  var input = $("#password2");
					  if (input.attr("type") === "password") {
					    input.attr("type", "text");
					  } else {
					    input.attr("type", "password");
					  }

            });

            $("body").on("click",".toggle-password3", function(){
            	$(this).toggleClass("fa-eye fa-eye-slash");
					  var input = $("#password3");
					  if (input.attr("type") === "password") {
					    input.attr("type", "text");
					  } else {
					    input.attr("type", "password");
					  }

            });
    });
</script>
@endsection
