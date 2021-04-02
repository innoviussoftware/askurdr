<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">

<link href="{!! asset('public/front_assets/css/bootstrap.min.css') !!}" rel="stylesheet" id="bootstrap-css">


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jqc-1.12.4/dt-1.10.18/datatables.min.css"/>
<link href="{!! asset('public/front_assets/css/datatables.min.css') !!}" rel="stylesheet" type="text/css">

<style type="text/css">
   @font-face {
  font-family: 'Glyphicons Halflings';
  src: url('../fonts/glyphicons-halflings-regular.eot');
  src: url('../fonts/glyphicons-halflings-regular.eot?#iefix') format('embedded-opentype'), url('../fonts/glyphicons-halflings-regular.woff') format('woff'), url('../fonts/glyphicons-halflings-regular.ttf') format('truetype'), url('../fonts/glyphicons-halflings-regular.svg#glyphicons-halflingsregular') format('svg');
}
.scrollable-menu {
    height: auto;    
    max-height: 200px;
    overflow-x: hidden;
    
    list-style: none;
}
</style>

<link href="{!! asset('public/front_assets/css/style.css') !!}" rel="stylesheet" type="text/css">

<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('public/admin_assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<script src="{!! asset('public/front_assets/js/jquery-1.11.1.min.js') !!}"></script> 
<script src="{!! asset('public/front_assets/js/bootstrap.min.js') !!}"></script>

<script src="{!! asset('public/front_assets/js/datatables.min.js') !!}"></script> 
<script src="{{ asset('public/admin_assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

</head>
<body>
	<div id='content' class="container col-md-10 col-md-offset-1  text well" align="">
		<div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">
                  <img src="{!! asset('public/logo.png') !!}" class="img-fluid mb-3" width="150"/>
                  <br>{{ __('Register') }}<br><br>
                </h1>
              </div>
               
            </div>
          </div>
        </div>
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
        	<div class="col-lg-6">
        		
  				<form method="post" action="{{ route('home.submit') }}" enctype="multipart/form-data">
            	@csrf
            	
            	<div class="form-row">
            		<div class="form-group col-md-12">
            			<div class="checkbox" id="insurance_details">
				          <label>
				            <input type="checkbox" id="Membership" name="Membership"><b>
				            I Have Insurance Membership</b>
				          </label>
				        </div>
            		</div>
            	</div>
            	
	              <div class="form-row">
	                <div class="form-group col-md-6">
	                  <label for="inputEmail4">First Name</label>
	                  <input type="text" class="form-control" id="inputEmail4" placeholder="First Name" value="" name="first_name">
	                </div>
	                <div class="form-group col-md-6">
	                  <label for="inputPassword4">Last Name</label>
	                  <input type="text" class="form-control" id="inputPassword4" placeholder="Last Name" value="" name="last_name">
	                </div>
	              </div>

	              <div class="form-group col-md-12">
	                <label for="inputAddress">Date of Birth</label>
	                <input type="text" class="form-control date-own" id="inputAddress" placeholder="Date of Birth" value="" name="date_of_birth" autocomplete="off">
	              </div>

	              <div class="form-group col-md-12">
	                <label for="inputAddress">Email</label>
	                <input type="text" class="form-control" id="inputAddress" placeholder="Email Address" value="" name="email">
	              </div>

	              <div class="form-group col-md-12">
	                <label for="inputAddress">Poster mail</label>
	                <input type="text" class="form-control" id="inputAddress" placeholder="Poster Mail" value="" name="post_mail">
	              </div>

	              <div class="form-group col-md-12">
	                <label for="inputAddress">Phone Number</label>
	                <input type="text" class="form-control" id="inputAddress" placeholder="Mobile Number" value="" name="mobile">
	              </div>

	              <div class="form-group col-md-12">
	                <label for="inputAddress">Password</label>
	                <input type="password" class="form-control" id="inputAddress" placeholder="Password" value="" name="password">
	              </div>

	              <div class="form-group col-md-12">
	                <label for="inputAddress">Confirm Password</label>
	                <input type="password" class="form-control" id="inputAddress" placeholder="Confirm Password" value="" name="confirmpassword">
	              </div>
	         		
		         	<div class="form-group col-md-12">
	                  <label for="inputAddress2">Gender</label>
	                  <label class="radio-inline">
	                    <input type="radio" name="gender" value="male">Male
	                  </label>
	                  <label class="radio-inline">
	                    <input type="radio" name="gender" value="female">Female
	                  </label>
	                  <label class="radio-inline">
	                    <input type="radio" name="gender" value="other">Other
	                  </label>
	              	</div>

	               <div class="form-group col-md-12">
	                <label for="inputAddress2">Language</label>
	                <select name="language" class="form-control">
	                  <option class="form-control">Preferred Language</option>
	                  <option class="form-control" value="English">English</option>
	                  <option class="form-control" value="Arabic">Arabic</option>
	                </select>
	              </div>

	              <div class="form-group col-md-12">
            		<div class="captcha">
		               <img src="{{captcha_src('flat')}}" onclick="this.src='/captcha/flat?'+Math.random()" id="captchaCode" alt="" class="captcha">
		               <a rel="nofollow" href="javascript:;" onclick="document.getElementById('captchaCode').src='captcha/flat?'+Math.random()" class="refresh">
		               <button type="button" class="btn btn-success"><i class="fa fa-refresh" id="refresh"></i></button>
		           </a>
               		</div>
            	 </div>

            	 <div class="form-group col-md-12">
            		<div class="captcha">
		               <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
               		</div>
            	 </div>
        

	              <div id="Membership_details" style="display: none;">
		              <div class="form-group col-md-12">
		                <label for="inputAddress2">Insurance Company Name</label>
		                <input type="text" class="form-control" id="inputAddress2" placeholder="Insurance Company Name" value="" name="insurance_company_name">
		               </div>

		               <div class="form-group col-md-12">
		                <label for="inputAddress2">Insurance Company Number</label>
		                <input type="text" class="form-control" id="inputAddress2" placeholder="Insurance Company Number" value="" name="insurance_policy_no">
		               </div>
	          	 </div>

	          	  
		          	<div class="form-group col-md-12">
		                <label for="inputAddress2">We accept following card for payment</label>
		          	</div>

		            <div class="form-group col-md-4">
		                <img src="{!! asset('public/front_assets/images/MADA_CARD.png') !!}" width="120px" height="120px">
		            </div>
		            <div class="form-group col-md-4">
		                <img src="{!! asset('public/front_assets/images/VISA.png') !!}" width="120px" height="120px">
		            </div>
		            <div class="form-group col-md-4">
		                <img src="{!! asset('public/front_assets/images/MASTER CARD.png') !!}" width="120px" height="120px">
		            </div>
	          	

	                <div class="form-group col-md-12">
	                <button type="submit" class="btn btn-primary">Sign Up</button>
	                <a href="{{route('login')}}" class="btn btn-primary">Cancel</a>
	              	</div>
         		 </form>
			</div>
        </div>
        </div>

      </div>
      
    </div>
	</div>
	<script type="text/javascript">
		$('.date-own').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        orientation: "bottom auto",
        
   });
		$(function() {
          $("body").on("click","#Membership", function(){
              var selectedCountry = $(this).is(':checked')            ;
              if(selectedCountry==true)
              {
                $('#Membership_details').show();
              }
              else
              {
               $('#Membership_details').hide(); 
              }
          });
  });
		$('#refresh').click(function(){

  $.ajax({
     type:'GET',
     url:'refreshcaptcha',
     success:function(data){
        $(".captcha span").html(data.captcha);
     }
  });
});
	</script>
</body>
</html>