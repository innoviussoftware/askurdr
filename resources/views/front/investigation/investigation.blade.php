@extends('layouts.front')

@section('content')

<div id='content' class="container col-md-10 col-md-offset-1  text well" align="">
	<div class="container-fluid">
  

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Lab Reports</a></li>
    <li><a data-toggle="tab" href="#menu1">X-Ray Reports</a></li>
  </ul>

  <div class="tab-content">
	    <div id="home" class="tab-pane fade in active">
	      <div class="table-responsive" style="padding-top: 1em;">
	      	<table class="table table-bordered" id="labreports" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Report No</th>
                      <th>Patient Name</th>
                      <th>EMR Number</th>
                      <th>Status</th>
                      <th>Date</th>
                      <th>Action</th>
                      
                    </tr>
                  </thead>
                   
                  <tbody>
                  
                  </tbody>
                  
            </table>
	      </div>
	    </div>
      <div class="modal fade" id="yourModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body" id="lab_reports">
                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  
                </div>
              </div>
            </div>
      </div>

	    <div id="menu1" class="tab-pane fade">
	    	<div class="table-responsive" style="padding-top: 1em;">
	      <table class="table table-bordered" id="xrayreports" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Report No</th>
                      <th>Patient Name</th>
                      <th>EMR Number</th>
                      <th>Status</th>
                      <th>Date</th>
                      <th>Action</th>
                      
                    </tr>
                  </thead>
                   
                  <tbody>
                  
                  </tbody>
                  
            </table>
        </div>
	    </div>
      <div class="modal fade" id="yourModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body" id="lab_reports">
                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  
                </div>
              </div>
            </div>
      </div>
  </div>
</div>

</div>
<script type="text/javascript">
  $(document).ready(function () {
        var doctordatatable = $('#labreports').DataTable({
            responsive: true,
            
            "ajax": "{{ route('front.labreports.array') }}",
            "language": {
                "emptyTable": "No Lab Reports available"
            },
            "order": [[0, "desc"]],
        });
        doctordatatable.columns([0]).visible(false, false);
    });
</script>
<script type="text/javascript">
  $(document).ready(function () {
        var doctordatatable = $('#xrayreports').DataTable({
            responsive: true,
            
            "ajax": "{{ route('front.xrayreports.array') }}",
            "language": {
                "emptyTable": "No X-Ray Reports available"
            },
            "order": [[0, "desc"]],
        });
        doctordatatable.columns([0]).visible(false, false);
    });

</script>
<script type="text/javascript">
  $('body').on('click', '.reports', function () {

         var reports_id = $(this).attr("value");
         var details = '<?php echo URL::to('front/reportsdetails'); ?>';
         if(reports_id)
         {
              $.ajax({
                        type:'get',
                        url:details,
                        data: {reports_id: reports_id},
                        success:function(res){
                            $('#lab_reports').html('');
                            $('#lab_reports').append(res);
                        }
              });
         }
         else
         {
              $('#lab_reports').html();
         }
});
</script>
@endsection
