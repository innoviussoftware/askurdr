@extends('layouts.front')

@section('content')
<div id='content' class="container col-md-10 col-md-offset-1  text well" align="">
  	<div class="row">
  		<div class="col-md-12">
        <nav aria-label="breadcrumb">
                  <ol class="breadcrumb" style="padding:8px 0px !important;">
                    <b>
                      <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('front.home.prescription') }}" class="breadcrumb-item active crumb">Listing :: Prescription</a></li>
                    </b>
                    
                  </ol>
              </nav>
              <div class="table-responsive">
          				<table class="table table-bordered" id="medicinesdatatable" width="100%" cellspacing="0">
                            <thead>
                              <tr>
                                <th></th>
                                <th>Prescription No</th>
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
<script type="text/javascript">
  $(document).ready(function () {
        var doctordatatable = $('#medicinesdatatable').DataTable({
            responsive: true,
            
            "ajax": "{{ route('front.prescription.array') }}",
            "language": {
                "emptyTable": "No Prescription available"
            },
            "order": [[0, "desc"]],
        });
        doctordatatable.columns([0]).visible(false, false);
    });
</script>
@endsection
