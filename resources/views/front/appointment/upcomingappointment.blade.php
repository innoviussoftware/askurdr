@extends('layouts.front')

@section('content')

<div id='content' class="container col-md-10 col-md-offset-1  text well" align="">
   
  	<div class="row">
  		<div class="col-md-12">
        <nav aria-label="breadcrumb">
                  <ol class="breadcrumb" style="padding:8px 0px !important;">
                    <b>
                      <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('front.home.upcomingappointment') }}" class="breadcrumb-item active crumb">Listing :: Upcoming Appointments</a></li>
                    </b>
                    
                  </ol>
              </nav>
				<table class="table table-bordered" id="medicinesdatatable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Doctor Name</th>
                      <th>Clinic Name</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  	
                  </tbody>
                </table>
            </div>
  		
  	</div>
  	<div class="row">
  		

  	</div>

</div>
<script type="text/javascript">
  $(document).ready(function () {
        var doctordatatable = $('#medicinesdatatable').DataTable({
        
            responsive: true,
            "processing": true,
            "ajax": "{{ route('front.upcomingappointment.array') }}",
            "language": {
                "emptyTable": "No upcoming appointment available"
            },
            "order": [[0, "desc"]],
        });
        doctordatatable.columns([0]).visible(false, false);
    }); // end of document ready
</script>
@endsection