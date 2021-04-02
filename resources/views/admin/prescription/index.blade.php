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
                  <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.doctor.index') }}" class="breadcrumb-item active crumb">Prescription</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.doctor.index') }}" class="breadcrumb-item active">Prescription Management</a></li>
                </ol>
          </nav>
          <!-- Page Heading -->
          <!-- <h1 class="h3 mb-2 text-gray-800">Patient Management</h1> -->


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              
              <div class="row">
                <div class="col-lg-8">
                <div class="caption font-dark">
                      <i class="fa fa-th-list"></i>
                      <span class="caption-subject bold uppercase" style="">Prescription Listing</span>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="row text-right">
                    <div class="col-lg-8">
                      
                    </div>
                    <div class="col-lg-4">
                      <a href="{{ route('admin.prescription.create') }}">
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
                
                <table class="table table-bordered" id="doctordatatable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Patient Name</th>
                      <th>Medicine Name</th>
                      <th>Dose</th>
                      <th>Unit</th>
                      <th>Route</th>
                      <th>Duration</th>
                      <th>Strength</th>
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
        var doctordatatable = $('#doctordatatable').DataTable({
            responsive: true,
            "processing": true,
            "ajax": "{{ route('admin.prescription.prescription_array') }}",
            "language": {
                "emptyTable": "No Prescription available"
            },
            "order": [[0, "desc"]],
        });
        doctordatatable.columns([0]).visible(false, false);
    }); // end of document ready
</script>
@endsection
