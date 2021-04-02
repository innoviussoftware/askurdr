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
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.payment.index') }}" class="breadcrumb-item active crumb">Listing :: Payment</a></li>
                  </b>
                </ol>
            </nav>
          <!-- Page Heading -->
          <!-- <h1 class="h3 mb-2 text-gray-800">Clinic Management</h1> -->


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              
              <div class="row">
                <div class="col-lg-8">
                  <!-- <div class="caption font-dark">
                      <i class="fa fa-th-list"></i>
                      <span class="caption-subject bold uppercase" style="">Clinic Listing</span>
                  </div> -->
                </div>
                <div class="col-lg-4">
                  <div class="row text-right">
                    <div class="col-lg-8">
                      
                    </div>
                    <div class="col-lg-4">
                     
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
                
                <table class="table table-bordered" id="clinicdatatable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Patient Name</th>
                      <th>Amount(SAR)</th>
                      <th>Date Time</th>
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
        var clinicdatatable = $('#clinicdatatable').DataTable({
            responsive: true,
            "processing": true,
            "ajax": "{{ route('admin.payment.array') }}",
            "language": {
                "emptyTable": "No payment available"
            },
            "order": [[0, "desc"]],
        });
        clinicdatatable.columns([0]).visible(false, false);
    }); // end of document ready
</script>
@endsection
