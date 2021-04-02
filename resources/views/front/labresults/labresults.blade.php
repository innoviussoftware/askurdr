@extends('layouts.front')

@section('content')
<div id='content' class="container col-md-10 col-md-offset-1  text well" align="">
   
  	<div class="row">
  		<div class="col-md-12">
        <nav aria-label="breadcrumb" >
                  <ol class="breadcrumb" style="padding:8px 0px !important;">
                    <b>
                      <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('front.home.labresults') }}" class="breadcrumb-item active crumb">Listing :: Lab Reports</a></li>
                    </b>
                    
                  </ol>
              </nav>
              <div class="table-responsive">
				<table class="table table-bordered" id="medicinesdatatable" width="100%" cellspacing="0">
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

<script type="text/javascript">
  $(document).ready(function () {
        var doctordatatable = $('#medicinesdatatable').DataTable({
        
            responsive: true,
            "processing": true,
            "ajax": "{{ route('front.labresults.array') }}",
            "language": {
                "emptyTable": "No Lab Reports available"
            },
            "order": [[0, "desc"]],
        });
        doctordatatable.columns([0]).visible(false, false);
    }); // end of document ready

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
