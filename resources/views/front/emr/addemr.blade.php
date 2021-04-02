@extends('layouts.front')

@section('content')

<div id='content' class="container col-md-10 col-md-offset-1  text well" align="">
   
  	<div class="row">
  		<div class="col-md-12">
       <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                     <a href="{{route('front.home.newaddemr')}}" class="btn btn-primary btn-sm" style="float: right;margin-bottom: 1em;margin-top: 1em;">Add EMR</a>
                  </ol>
          </nav>
      </div>
        <div class="col-md-12">
          <div class="table-responsive">
                  <table class="table table-bordered " id="medicinesdatatable" width="100%" cellspacing="0">
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
        var doctordatatable = $('#medicinesdatatable').DataTable({
            responsive: true,
            
            "ajax": "{{ route('front.emr.array') }}",
            "language": {
                "emptyTable": "No patient available"
            },
           // "order": [[0, "desc"]],
        });
        doctordatatable.columns([0]).visible(false, false);
    });
</script>
@endsection