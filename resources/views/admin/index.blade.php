@extends('layouts.admin')



@section('content')

<!-- Main Content -->

<div id="content">



  <!-- Begin Page Content -->

  <div class="container-fluid">



    <!-- Page Heading -->

    <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">

      <h1 class="h3 mb-0 text-gray-800">Coming Soon...</h1>

    </div> -->

    <div class="row" >

    	<div class="col-sm-4">

	        <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">

			  <div class="card-body">

			    <h5 class="card-title">Total Doctors</h5>

			    <?php   $response = App\User::whereHas('roles', function ($q) {

               			 $q->where('id', 2);

			            })->where('status',1)->count();

			            if(isset($response)){?>

						    <p class="card-text">{{$response}}</p>

						<?php }else{?>

							 <p class="card-text">0</p>

						<?php }?>	

			  </div>

			</div>

		</div>



		<div class="col-sm-4">

			<div class="card text-white bg-primary mb-3" style="max-width: 18rem;">

			  <div class="card-body">

			    <h5 class="card-title">Total Patients</h5>

			    <?php   $response1 = App\User::whereHas('roles', function ($q) {

               			 $q->where('id', 3);

			            })->where('status',1)->count();

			            if(isset($response1)){?>

						    <p class="card-text">{{$response1}}</p>

						<?php }else{?>

							 <p class="card-text">0</p>

						<?php }?>	

			  </div>

			</div>

		</div>



		<div class="col-sm-4" style="display: none;">

			<div class="card text-white bg-primary mb-3" style="max-width: 18rem;">

			  <div class="card-body">

			    <h5 class="card-title">Total Income</h5>

			    <?php   

						$payment_details=DB::table('payment_detail')->select('payment_detail.*','paymentplan.type as paymenttype','paymentplan.price as paymentprice','users.*')->where('payment_detail.type',1)->join('users','payment_detail.user_id','=','users.id')->join('paymentplan','payment_detail.package_id','=','paymentplan.id')

						->sum('paymentplan.price');



			            if(isset($payment_details)){?>

						    <p class="card-text">{{$payment_details}}</p>

						<?php }else{?>

							 <p class="card-text">0</p>

						<?php }?>	

			  </div>

			</div>

		</div>

	</div>
<!--   <?php 
              $DoctorSpeciality=App\User::select('users.*','role_user.*','clinic.*','doctor_availability.status as DoctorStatus',DB::raw("count(emrdetails.id) as count"))
                ->join('role_user', 'role_user.user_id', '=', 'users.id')
                ->join('doctor_clinic', 'doctor_clinic.user_id', '=', 'users.id')
                ->join('clinic', 'clinic.id', '=', 'doctor_clinic.clinic_id')
                ->join('doctor_availability', 'doctor_availability.doctor_id', '=', 'users.id')
                ->leftjoin('emrdetails', 'emrdetails.doctor_id', '=', 'users.id')
                ->groupBy('users.id')
                ->where('role_user.role_id',2)
                ->get();   
                      
  ?>

  <div class="row">

      @foreach($DoctorSpeciality as $dc)
      <div class="col-sm-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                        <p class="card-text">{{$dc->first_name .''.$dc->last_name}}</p>
                        <p class="card-text">{{$dc->name}}</p>
                        @if($dc->consultant == '1')
                            <p class="card-text">Specialist  {{$dc->gender}}</p>
                        @elseif($dc->consultant == '2')
                            <p class="card-text">Consultant  {{$dc->gender}}</p>
                        @endif

                        <?php 
                            $DoctorSpecialitys=App\EmrDetails::select('emrdetails.*')
                            ->where('emrdetails.doctor_id','=',$dc->id)
                            ->count(); 

                            $regular=App\EmrDetails::select('emrdetails.*')
                            ->where('emrdetails.doctor_id','=',$dc->id)
                            ->where('emrdetails.call_type','=','regular')
                            ->count(); 

                            $followup=App\EmrDetails::select('emrdetails.*')
                            ->where('emrdetails.doctor_id','=',$dc->id)
                            ->where('emrdetails.call_type','=','followup')
                            ->count(); 
                        ?>
                        <p class="card-text">Number Of Visit: {{$DoctorSpecialitys}}</p>
                        <p class="card-text">Followup Visit: {{$followup}} Paid Visit: {{$regular}}</p>
                        @if($dc->DoctorStatus == '0')
                              <span class="btn btn-success 'btn-xs" data-toggle="tooltip" title="click here to inactive">Available</span>
                        @elseif($dc->DoctorStatus == '1')
                              <span class="btn btn-danger 'btn-xs" data-toggle="tooltip" title="click here to inactive">Unavailable</span>
                        @elseif($dc->DoctorStatus == '2')
                              <span class="btn btn-info 'btn-xs" data-toggle="tooltip" title="click here to inactive">Waiting</span>
                        @endif
                </div>
            </div>
      </div>
      @endforeach

  </div> -->

	<nav aria-label="breadcrumb" style="display: none;">

                <ol class="breadcrumb">

                 <b>

                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.paymentdetails.index') }}" class="breadcrumb-item active crumb">Listing :: Payment Details</a></li>

                  </b>

                </ol>

            </nav>

	<div class="table-responsive">

                

                <table class="table table-bordered" id="medicinesdatatable" width="100%" cellspacing="0">

                  <thead>

                    <tr>

                      <th></th>

                      <th>Doctor Name</th>

                      <th>Hostipal Name</th>

                      <th>Specialist/Consultant</th>

                      <th>Gender</th>

                      <th>Number Of Visit</th>

                      <th>Number Of PaidVisit</th>

                       <th>Number Of FollowupVisit</th>

                      <th>Status</th>

                    </tr>

                  </thead>

                  <tbody>

                  </tbody>

                </table>

              </div>

  </div>

  <!-- /.container-fluid -->



</div>

<!-- End of Main Content -->

@endsection



@section('custom_js')

<!-- Page level plugins -->

<script src="{!! asset('admin_assets/vendor/chart.js/Chart.min.js') !!}"></script>

<!-- Page level custom scripts -->

<script src="{!! asset('admin_assets/js/demo/chart-area-demo.js') !!}"></script>

<script src="{!! asset('admin_assets/js/demo/chart-pie-demo.js') !!}"></script>

<script>

    $(document).ready(function () {

        var medicinesdatatable = $('#medicinesdatatable').DataTable({

            responsive: true,

            "processing": true,

            "ajax": "{{ route('admin.status.array') }}",

            "language": {

                "emptyTable": "No doctors available"

            },

            "order": [[0, "desc"]],

        });
        setInterval( function () {
          medicinesdatatable.ajax.reload(null, false);
        }, 5000 );
        medicinesdatatable.columns([0]).visible(false, false);

    }); // end of document ready

</script>

@endsection

