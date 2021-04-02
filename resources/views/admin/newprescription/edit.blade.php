@extends('layouts.admin')

@section('content')
<style type="text/css">
  .ui-autocomplete-loading { background:url(http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/images/ui-anim_basic_16x16.gif) no-repeat right center }
</style>
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
      <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<div id="content" style="background-color: #ffff !important;">

        <div class="container-fluid">

          <!-- Page Heading -->
           <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                   <b>
                  <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.prescriptionreport.index') }}" class="breadcrumb-item active crumb">Edit :: Prescription</a></li>
                </b>
                </ol>
            </nav>
         <!--  <div class="caption pull-left" style="padding-bottom: 1em;padding-left: 1.1em;">
              <i class="fa fa-th-list"></i> &nbsp;
              <span class="caption-subject sbold uppercase font-dark">Update :: Prescription</span>
          </div> -->
          
          


          <!-- DataTales Example -->
          <div class="card">
            <div class="card-body">
              <div class="row">

                <div class="col-12"> 
                  @if (count($errors) > 0)
                    <div class="alert alert-danger">
                      <strong>Whoops!</strong> There were some problems with your input.<br><br>
                      <ul>
                         @foreach ($errors->all() as $error)
                           <li>{{ $error }}</li>
                         @endforeach
                      </ul>
                    </div>
                  @endif
                </div>
                
                <div class="col-8">
                  
                  

                
                  

                    <form class="form-horizontal" action="{{ route('admin.prescriptionreport.update')}}"method="post" enctype="multipart/form-data">
                        <input type="hidden" value="{{$prescription->id}}" name="id" />
                        
                       @csrf
                       
                        {{ method_field('PATCH') }}
                       
                    
                   
                     <div class="Prescriptionnew" id="newprsc">
                   <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Patients Name<span class="text-danger">*</span></label>
                      <div class="col-sm-7">
                        
                          <select class="form-control form-control-sm required medicines_change " title="Search Medicines" name="patients" id="medicines0" data-count="0" required>
                              <option value="">Select Patients</option>
                              <?php if(isset($patients)){?>
                            @foreach($patients as $patient)
                              <option value="{{$patient->id }}" {{ $prescription->patient_id == $patient->id ? 'selected="selected"' : ''}}>{{ $patient->first_name }} {{ $patient->last_name }}</option>
                            @endforeach
                          <?php }?>
                          </select>

                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Medicines Name<span class="text-danger">*</span></label>
                      <div class="col-sm-7">
                        
                            <select class="form-control form-control-sm required medicines_change" title="Search Medicines" name="medicines" id="medicines0" data-count="0" required>
                             <option value="">Select Medicine</option>
                              <?php if(isset($medicines)){?>
                            @foreach($medicines as $medicine)
                              <option value="{{$medicine->id }}" {{ $prescription->medicine_id == $medicine->id ? 'selected="selected"' : ''}}>{{ $medicine->name }}</option>
                            @endforeach
                          <?php }?>

                          </select>

                      </div>
                    </div>
                    <div class="disprecord">
                      <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Dose<span class="text-danger">*</span></label>
                        <div class="col-sm-4">
                          
                            <input type="text" name="dose" class="form-control form-control-sm dose" value="{{$prescription->dose}}" id="dose0" required="required">
                          
                        </div>

                        <div class="col-sm-3">
                            <select class="form-control form-control-sm required" title="Search Medicines" name="units" id="units0" required >
                                  <option value="">Select Unit</option>
                                  <option value="mg" {{$prescription->unit=="mg" ? 'selected="selected"' : ''}}>Mg</option>
                                  <option value="ml" {{$prescription->unit=="ml" ? 'selected="selected"' : ''}}>Ml</option>
                                  <option value="g" {{$prescription->unit=="g" ? 'selected="selected"' : ''}}>G</option>
                                  <option value="mcg" {{$prescription->unit=="mcg" ? 'selected="selected"' : ''}}>Mcg</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Route<span class="text-danger">*</span></label>
                        <div class="col-sm-7">
                            <input type="text" name="route" class="form-control form-control-sm route" value="{{$prescription->route}}" id="route0" required="required">
                          
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Frequency<span class="text-danger">*</span></label>
                        <div class="col-sm-2">
                          
                            <input type="text" name="frequency1" class="form-control form-control-sm frequency1" value="{{$prescription->frequency}}" id="frequency10" required="required">
                          
                        </div>
                        <div class="col-sm-2">
                          
                            <input type="text" name="frequency2" class="form-control form-control-sm frequency2" value="{{$prescription->frequency2}}" id="frequency20">
                        </div>
                        <div class="col-sm-2">
                          
                            <input type="text" name="frequency3" class="form-control form-control-sm frequency3" value="{{$prescription->frequency3}}" id="frequency30">
                          
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Duration<span class="text-danger">*</span></label>
                        <div class="col-sm-7">
                          
                            <input type="text" name="duration" class="form-control form-control-sm duration" value="{{$prescription->duration}}" id="duration0" required="required">
                          
                        </div>
                      </div>
                    </div>
</div>
                    <button type="submit" class="btn btn-warning" style="background-color: #003366 !important;border-color: #003366 !important;">Update</button>
                    <a href="{{route('admin.prescriptionreport.index')}} " class="btn btn-secondary">Cancel</a>
                    
                   
                  
                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

</div>


@endsection

@section('custom_js')
<script type="text/javascript">
  $('.select2').select2();
</script>
@endsection
