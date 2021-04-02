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
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.document_type.index') }}" class="breadcrumb-item active crumb">Listing :: Document Type</a></li>
                  </b>
                </ol>
          </nav>
          <!-- Page Heading -->
          


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              
              <div class="row">
                <div class="col-lg-8">
                 <!--  <div class="caption font-dark">
                      <i class="fa fa-th-list"></i>
                      <span class="caption-subject bold uppercase" style="">Document Type Listing</span>
                  </div> -->
                </div>
                <div class="col-lg-4">
                  <div class="row text-right">
                    <div class="col-lg-8">
                      
                    </div>
                    <div class="col-lg-4">
                      <a href="{{ route('admin.document_type.create') }}">
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
                
                <table class="table table-bordered" id="documenttypedatatable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Type</th>
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
        var documenttypedatatable = $('#documenttypedatatable').DataTable({
            responsive: true,
            "processing": true,
            "ajax": "{{ route('admin.document_type.documenttypearray') }}",
            "language": {
                "emptyTable": "No Document type available"
            },
            "order": [[0, "desc"]],
        });
        documenttypedatatable.columns([0]).visible(false, false);
    }); // end of document ready
</script>
@endsection
