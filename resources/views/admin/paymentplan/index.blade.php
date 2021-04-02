@extends('layouts.admin')

@section('content')

<style type="text/css">
  .no-sort::after {
    display: none !important;
  }
</style>
<div id="content">

        <div class="container-fluid">
           <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <b>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.plan.index') }}" class="breadcrumb-item active crumb">Listing :: Package </a></li>
                  </b>
                </ol>
            </nav>
          
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              
              <div class="row">
                <div class="col-lg-8">
          
                </div>
                <div class="col-lg-4">
                  <div class="row text-right">
                    <div class="col-lg-8">
                      
                    </div>
                    <div class="col-lg-4">
                      <a href="{{ route('admin.plan.create') }}">
                  <button class="btn btn-warning float-right btn-sm"><i class="fa fa-plus"></i> Add New</button>
                </a>
                    </div>
                  </div>
                </div>
              </div>
            
            </div>
            <div class="card-body">
              
              @if ($message = Session::get('success'))
              <div class="alert alert-success alert_msg">            
                    <span>{{ $message }}</span>
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
              @endif


              <div class="table-responsive">
                
                <table class="table table-bordered" id="medicinesdatatable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Type</th>
                      <th>Months</th>
                      <th>Years</th>
                      <th>Price</th>
                      <th>Status</th>
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
        <!-- /.container-fluid -->

</div>

@endsection

@section('custom_js')
<script>
    $(document).ready(function () {
        var medicinesdatatable = $('#medicinesdatatable').DataTable({
            responsive: true,
            "processing": true,
            "ajax": "{{ route('admin.plan.packagearray') }}",
            "language": {
                "emptyTable": "No Package available"
            },
            "order": [[0, "desc"]],
        });
        medicinesdatatable.columns([0]).visible(false, false);
    }); // end of document ready
</script>
@endsection
