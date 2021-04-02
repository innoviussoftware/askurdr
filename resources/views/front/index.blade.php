@extends('layouts.front')

@section('content')
<style type="text/css">
	.card{
		text-align: center;
		padding: 1em 3em;
	}


	.box-part{
	    background:#FFF;
	    border-radius:10px;
	    padding:20px 5px;
	    margin:5px 0px;
	}

	.box-part:hover{
	    background:#4183D7;
	}

	.box-part:hover .fa ,
	.box-part:hover .title ,
	.box-part:hover .text ,
	.box-part:hover a{
	    color:#FFF;
	    -webkit-transition: all 1s ease-out;
	    -moz-transition: all 1s ease-out;
	    -o-transition: all 1s ease-out;
	    transition: all 1s ease-out;
	}

</style>
<div id='content' class="container col-md-10 col-md-offset-1  text well" align="">
   <?php
   			 $user = App\User::find(Auth::user()->id);
   			 $date = date('Y-m-d');
        	 $time = date('g A');
        	 $labreport=App\Visit_Investigation::where('patient_id',Auth::user()->id)->count();

            $prescription=App\Visit_Prescription::where('patient_id',Auth::user()->id)->count();

            $patient_appointment = App\DoctorBooking::with(['doctor' => function($q){
                $q->select('id','first_name','last_name','mobile');
                $q->with(['clinic' => function($p){
                    $p->with(['clinic']);
                }]);
            }])->where('date','>=',$date)->where('patient_id',Auth::user()->id)->count();

            $date = date('Y-m-d');

			$time = date('H');


$doctor_appointment = App\DoctorBooking::with(['patient' => function($q){
            $q->select('id','first_name','last_name','mobile','emr_number','profile_pic');
        }])->where('date','=',$date)->where('doctor_id',$user->id)->count();


   ?>
@if($user->roles()->first()->id == '2')
		<div class="col-md-12 col-sm-12 col-xs-12 text-center" style="margin-bottom: 60px;margin-top: 60px;">
  			<?php
  				if(Auth::check()){
  				 $doctor_avoi = App\DoctorAvailability::where("doctor_id",Auth::user()->id)->first();
  				if($doctor_avoi->status){
  				 ?>
  				<p><b>Welcome Dr.<?php echo Auth::user()->first_name ?> Your status is set to (<span class="dravstatus">Unavailable</span>)</b></p>
  				<a href="#">
					<button type="button" class="btn btn-primary dravstatus">Unavailable</button>
				</a>
			<?php }else{ ?>
				<p><b>Welcome Dr.<?php echo Auth::user()->first_name ?> Your status is set to (<span class="dravstatus">Available</span>)</b></p>
				<a href="#">
					<button type="button" class="btn btn-primary dravstatus">Available</button>
				</a>
			<?php } } ?>
  		</div>
  	<div class="row" style="max-width: 50%;margin: auto;">
  		
  		<!-- <div class="col-md-12 col-sm-12 col-xs-12">
				<a href="{{route('front.home.getappointment')}}" style="list-style: none;text-decoration: none;color: #fff;">
					<div class="box-part text-center" style="background-color: #ff6666!important;margin-top:6em !important;margin-bottom: 1em !important;">
		                        <img src="{!! asset('public/front_assets/images/ic_today_app.png') !!}" alt="aaa" width="30px" height="30px">

								<div class="title" style="margin-top: 0.5em;">
									<h4>{{$doctor_appointment}}</h4>
								</div>
								<div class="title">
									<h4>Today's Appointment</h4>
								</div>
					</div>
				</a>
  		</div> -->

  		<div class="col-md-12 col-sm-12 col-xs-12">
				<a href="{{route('front.home.emr')}}" style="list-style:none;text-decoration: none;color: #fff;">
					<div class="box-part text-center" style="background-color: #3385ff!important;margin-top:1em !important;margin-bottom: 6em !important;">
		                        <img src="{!! asset('public/front_assets/images/ic_emr_white.png') !!}" alt="aaa" width="30px" height="30px">
		                        <div class="title" style="margin-top: 0.5em;">
									<h4>&nbsp</h4>
								</div>
								<div class="title">
									<h4>EMR</h4>
								</div>
					</div>
				</a>
  		</div>

  	</div>

@else

  	<div class="row" style="max-width: 55%;margin: auto;margin-bottom: 2em;">
  		<div class="col-md-6 col-sm-12 col-xs-12">
				<a href="{{route('front.home.bookappointment')}}" style="list-style: none;text-decoration: none;color: #fff;">
					<div class="box-part text-center" style="background-color: #ff6666!important;">
								<img src="{!! asset('public/front_assets/images/ic_book_appointment_white.png') !!}" alt="aaa" width="30px" height="auto">
								<div class="title" style="margin-top: 0.5em;">
									<h4>&nbsp</h4>
								</div>
								<div class="title">
									<h4>Book Appointment</h4>
								</div>
					</div>
				</a>
  		</div>
  		<div class="col-md-6 col-sm-12 col-xs-12">
				<a href="{{route('front.home.upcomingappointment')}}" style="list-style: none;text-decoration: none;color: #fff;">
					<div class="box-part text-center" style="background-color: #7da8ed!important;">
		                        <img src="{!! asset('public/front_assets/images/ic_schedule_app_white.png') !!}" alt="aaa" width="30px" height="auto">
		                        <div class="title" style="margin-top: 0.5em;">
									<h4>{{$patient_appointment}}</h4>
								</div>
								<div class="title">
									<h4>Upcoming Appointment</h4>
								</div>
					</div>
				</a>
  		</div>
  	</div>

  	<div class="row" style="max-width: 55%;margin: auto;">
  		<div class="col-md-6 col-sm-12 col-xs-12">
  			<a href="{{route('front.home.prescription')}}" style="list-style: none;text-decoration: none;color: #fff;">

				<div class="box-part text-center" style="background-color: #f2943c!important;">
	                        <img src="{!! asset('public/front_assets/images/ic_view_report_white.png') !!}" alt="aaa" width="30px" height="auto">
	                        <div class="title" style="margin-top: 0.5em;">
								<h4>{{$prescription}}</h4>
							</div>
							<div class="title">
								<h4>View Prescription</h4>
							</div>
				</div>
			</a>
  		</div>
  		<div class="col-md-6 col-sm-12 col-xs-12">

			<a href="{{route('front.home.labresults')}}" style="list-style: none;text-decoration: none;color: #fff;">
				<div class="box-part text-center" style="background-color: #2ad68b !important;">
	                        <img src="{!! asset('public/front_assets/images/ic_investigation_menu.png') !!}" alt="aaa" width="30px" height="auto">
	                        <div class="title" style="margin-top: 0.5em;">
								<h4>{{$labreport}}</h4>
							</div>
							<div class="title">
								<h4>Investigation</h4>
							</div>
				</div>
			</a>

  		</div>
  	</div>
@endif
<script>
    $(document).ready(function() {
        $(".dravstatus").click(function(e) {
		    e.preventDefault();
		    $.ajax({
		        type: "get",
		        url: "{{route('front.doctor.avoilabble')}}",
		        data: { 
		            id: $(this).val(), // < note use of 'this' here
		            access_token: $("#access_token").val() 
		        },
		        success: function(result) {
		        	$('.dravstatus').text(result);
		        },
		        error: function(result) {
		            alert('error');
		        }
		    });
		});
    });
    </script>
</div>
@endsection
