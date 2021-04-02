@extends('layouts.front')

@section('content')

<div id='content' class="container col-md-10 col-md-offset-1  text well" align="">
	<div class="container-fluid">
  

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Today's Appointments</a></li>
    <li><a data-toggle="tab" href="#menu1">Waiting List</a></li>
  </ul>

  <div class="tab-content">
	    <div id="home" class="tab-pane fade in active">
	      <div class="table-responsive" style="padding-top: 1em;">
	      	<table class="table table-bordered" id="Appointments" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th></th>
                      <th>EMR Number</th>
                      <th>Patient Name</th>
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

	    <div id="menu1" class="tab-pane fade">
	    	<div class="table-responsive" style="padding-top: 1em;">
	      <table class="table table-bordered" id="Waiting" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th></th>
                      <th>EMR Number</th>
                      <th>Patient Name</th>
                      <th>Action</th>
                      
                    </tr>
                  </thead>
                   
                  <tbody>
                  
                  </tbody>
                  
            </table>
        </div>
	    </div>
  </div>
</div>

</div>
<script type="text/javascript">
  $(document).ready(function () {
        var doctordatatable = $('#Appointments').DataTable({
            responsive: true,
            
            "ajax": "{{ route('front.todayappointment.array') }}",
            "language": {
                "emptyTable": "No Appointments available"
            },
            "order": [[0, "desc"]],
        });
        doctordatatable.columns([0]).visible(false, false);
    });
</script>
<script type="text/javascript">
  $(document).ready(function () {
        var doctordatatable = $('#Waiting').DataTable({
            responsive: true,
            
            "ajax": "{{ route('front.waitinglist.array') }}",
            "language": {
                "emptyTable": "No Waiting List available"
            },
            "order": [[0, "desc"]],
        });
        doctordatatable.columns([0]).visible(false, false);
    });
</script>
@endsection
