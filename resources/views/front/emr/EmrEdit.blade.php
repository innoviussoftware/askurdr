@extends('layouts.front')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.css" />
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.js"></script>
    
<style type="text/css">
  .ui-autocomplete-loading { background:url(http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/images/ui-anim_basic_16x16.gif) no-repeat right center }
</style>
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
      <!-- <script src = "https://code.jquery.com/jquery-1.10.2.js"></script> -->
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
      <link href = "https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.6/chosen.css"
         rel = "stylesheet">
<div id='content' class="container col-md-10 col-md-offset-1  text well" align="">
    <div class="row">
      <div class="col-12"> 
                  @if (count($errors) > 0)
                    <div class="alert alert-danger" id="error">
                      <strong>Whoops!</strong> There were some problems with your input.<br><br>
                      <ul>
                         @foreach ($errors->all() as $error)
                           <li>{{ $error }}</li>
                         @endforeach
                      </ul>
                    </div>
                  @endif
                  @if(session()->has('success'))
                      <div class="alert alert-success">
                          {{ session()->get('success') }}
                      </div>
                  @endif
      </div>
      <div class="col-md-12">
        <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                   
                        <b><li class="breadcrumb-item active" aria-current="page"><a href="{{ route('front.home.emr') }}" class="breadcrumb-item active crumb">Update  :: EMR</a></li></b>
                    
                </ol>
        </nav>
      </div>
      <?php 
      $id = auth()->user()->id;
      ?>
      <form method="post" action="{{ route('front.home.emrupdate') }}" enctype="multipart/form-data">
              <input type="hidden" name="_method" value="PATCH">                    
              <input type="hidden" name="type_visit" value="{{isset($EmrDetails->type_visit)?$EmrDetails->type_visit:''}}">
          
               @csrf
      <div class="col-md-6">
        <input type="hidden" name="id" value="{{isset($EmrDetails)?$EmrDetails->id:'' }}" />
              <input type="hidden" name="doctor_id" value="{{$id}}" id="doctor_id">
              <input type="hidden" name="emr_id" value="{{isset($EmrDetails)?$EmrDetails->id:''}}" id="emr_id">
              <input type="hidden" name="patient_id" value="{{isset($EmrDetails)?$EmrDetails->patient_id:''}}" id="doctor_id">

                  <div class="form-group col-md-12">
                    <label for="inputEmail4">EMR Number</label>
                    <input type="text" class="form-control" id="inputEmail4" placeholder="EMR No" value="{{isset($EmrDetails)?$EmrDetails->emr_no:''}}" name="emrno" readonly="">
                  </div>
                  <?php if(isset($previsit)){?>
                  <div class="col-md-12">
                     <div class="panel panel-default">
                      
                            <div class="panel-heading">
                                <b>Previsit Detail</b>
                            </div>
                            <div class="panel-body">
                              <div class="Investnew" id="newinvest">
                                
                                <input type="hidden" name="bookingform_id" value="{{$previsit->id}}">
                                              <div class="form-group row">
                                                
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                  <label>Reason for consultation:-</label>
                                                  {{$previsit->reason}}   
                                                </div>
                                                
                                                
                                              </div>
                                              <div class="form-group  row">
                                                  <div class="col-xs-12 col-sm-12 col-md-12">
                                                      <label>Details:-</label>
                                                      {{$previsit->description}} 
                                                  </div>
                                              </div>
                                              <div class="form-group  row">
                                                  <div class="col-xs-9 col-sm-8 col-md-10">
                                                      <label>Medical Report:-</label>  
                                                      <?php if($previsit->report_file){
                                                        $reports_file=explode("| ",$previsit->report_file);?>
                                                      @foreach($reports_file as $reports)  
                                                      <img src="{{env('STORAGE_FILE_PATH').'/'.$reports}}" alt="aaa" width="50px" height="auto" class="img-responsive">
                                                      @endforeach
                                                      <?php }?>
                                                      <img src="">
                                                  </div>
                                              </div>
                              </div>
                            </div>
                           
                      </div>
                  </div>
                   <?php }?>
                  <div class="col-md-12">
                     <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>{{isset($EmrDetails)?$EmrDetails->type_visit:''}}</b>
                            </div>
                            <div class="panel-body">
                                 <div class="form-group col-md-12">
                                    <label for="inputAddress">Physican Note</label>
                                    <textarea class="form-control" placeholder="Add Note" name="physicannote">{{isset($EmrDetails)?$EmrDetails->physican_note:''}}</textarea>
                                  </div>

                                  <div class="form-group col-md-12">
                                    <label for="inputAddress">Physican Diagnosis</label>
                                    <input type="text" class="form-control" id="automplete-1" placeholder="Physican Diagnosis" value="{{isset($EmrDetails)?$EmrDetails->physican_diagonis_id:''}}" name="physicandiagnosis">
                                  </div>
                    <div class="col-md-12">
               
                      <div class="panel panel-default">
                            <div class="panel-heading">
                                  <b>Prescriptions</b>
                            </div>
                            <div class="panel-body">
                                  <div class="Prescriptionnew" id="newprsc">
                                              <div class="form-group row">
                                                <div class="col-xs-9 -col-sm-6 col-md-10">
                                                  <!-- selectpicker remove  class -->
                                                      <select class="form-control form-control-sm required medicines_select chosen" title="Search Medicines" name="medicines[]" id="medicines0" data-count="0" data-live-search="true" data-live-search-style="startsWith">
                                                        <option value="">Select Medicines</option>
                                                        <option value="others">Others</option>
                                                        <?php if(isset($medicines)){?>
                                                      @foreach($medicines as $medicine)
                                                        <option value="{{$medicine->id }}">{{ $medicine->name }}</option>
                                                      @endforeach
                                                    <?php }?>
                                                    </select>
                                                </div>
                                                <div class="col-xs-3 col-sm-6 col-md-2">
                                                   <button type="button" style="" class="add_prsc btn btn-primary"><i class="fa fa-plus"></i></button>
                                                </div>
                                                <div class="col-xs-9 -col-sm-6 col-md-10" style="display: none;" id="medicines_select_textbox0" data-count="0">
                                                   <input type="text" name="medicinestext[]" value=""  placeholder="Enter the Medicines">
                                                </div>
                                              </div>

                                              <div class="disprecord dc0">
                                                <div class="form-group row">
                                                  
                                                  <div class="col-sm-6">
                                                    
                                                      <input type="text" name="dose[]" class="form-control form-control-sm dose" value="" id="dose0" placeholder="Dose">
                                                    
                                                  </div>
                                                  <div class="col-sm-4">
                                                    
                                                       <select class="form-control form-control-sm required dosetype" title="Search Medicines" name="dosetype[]" id="medicines0" data-count="0">
                                                        <option value="">Select Dose</option>
                                                        <option value="mg">Mg</option>
                                                        <option value="ml/g">ml/g</option>
                                                        <option value="mcg">mcg</option>
                                                       </select>
                                                    
                                                  </div>
                                                </div>

                                                

                                                <div class="form-group row">
                                                  <label for="staticEmail" class="col-sm-12 col-form-label col-form-label-sm">Frequency:</label>
                                                  
                                                </div>
                                                <div class="form-group row">
                                                <div class="col-sm-3">
                                                    
                                                      <input type="text" name="frequency1[]" class="form-control form-control-sm frequency1" value="" id="frequency10" placeholder="Morning">
                                                    
                                                  </div>
                                                  <div class="col-sm-3">
                                                    
                                                      <input type="text" name="frequency2[]" class="form-control form-control-sm frequency2" value="" id="frequency20" placeholder="Noon">
                                                  </div>
                                                  <div class="col-sm-3">
                                                    
                                                      <input type="text" name="frequency3[]" class="form-control form-control-sm frequency3" value="" id="frequency30" placeholder="Night">
                                                    
                                                  </div>
                                                </div>
                                                <div class="form-group row">
                                                  <div class="col-sm-10">
                                                    
                                                      <input type="number" name="duration[]" class="form-control form-control-sm duration" value="" id="duration0" placeholder="Duration">
                                                    
                                                  </div>
                                                </div>
                                                <div class="form-group row">
                                                  <div class="col-sm-10">
                                                    
                                                      <input type="text" name="route[]" class="form-control form-control-sm route" value="" id="duration0" placeholder="Route">
                                                    
                                                  </div>
                                                </div>

                                            </div>
                                      </div>
                            </div>
                            
                            <div class="panel-panel-default">
                                  <div class="panel-body" id="prescriptiondata">
                                        
                                  </div>
                            </div>
                      </div>
                  
                      <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>Investigation</b>
                            </div>
                            <div class="panel-body">
                              <div class="Investnew" id="add_investigation">
                                              <div class="form-group row">
                                                
                                                <div class="col-xs-9 col-sm-8 col-md-10">
                                                  
                                                      <select class="form-control form-control-sm required investigation_select" title="Search Medicines" name="investigation[]" id="investigation" data-count="0">
                                                        <option value="">Select Investigation</option>
                                                        <option value="others">Others</option>
                                                         <?php if(isset($documentType)){?>
                                                      @foreach($documentType as $document)
                                                        <option value="{{$document->id }}">{{ $document->name }}</option>
                                                      @endforeach
                                                    <?php }?>
                                                    </select>
                                                </div>
                                                
                                                <div class="col-xs-3 col-sm-4 col-md-2">
                                                   <button type="button" style="" class="add_invest btn btn-primary"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="col-xs-9 -col-sm-6 col-md-10" style="display: none;" id="investigationtext0" data-count="0">
                                                   <input type="text" name="investigationtext[]" value=""  placeholder="Enter the Investigation">
                                                </div>

                                              </div>
                                              <div class="form-group row">
                                                <div class="col-xs-12 col-sm-12 col-md-10">
                                                  <select class="form-control form-control-sm required select_subinvestigation"  title="Search Investigation" name="subinvestigation[]" id="subinvestigationselectbox0" data-count="0">
                                                        <option value="">Select Subinvestigation</option>
                                                    </select>
                                                </div>
                                              </div>
                                              <div class="form-group row" style="display: none;" id="investigation_select_textbox0" data-count="0">
                                                <div class="col-xs-12 -col-sm-12 col-md-10" style="display: none;" id="subinvestigationtext0" data-count="0">
                                                   <input type="text" name="subinvestigationtext[]" value=""  placeholder="Enter the Subinvestigation">
                                                </div>
                                              </div>
                                              <div class="form-group  row">
                                                  <div class="col-xs-9 col-sm-8 col-md-10">
                                                      
                                                          
                                                          <textarea class="form-control notes" placeholder="Add notes" name="notes[]"></textarea>
                                                    </div>
                                              </div>
                              </div>
                            </div>
                            <div class="panel-panel-default">
                                  <div class="panel-body" id="investigationdata">
                                        
                                  </div>
                            </div>
                      </div>
 
                      <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>Referral</b>
                            </div>
                            <div class="panel-body">
                                <div class="referralnew" id="newreferral">
                                  <div class="disprecord">
                                          <div class="form-group row">
                                                <div class="col-xs-9 col-sm-8 col-md-10">
                                                      <select class="form-control form-control-sm required referral_select medicines_change" title="Search Medicines" name="referral[]" id="medicines0" data-count="0">
                                                        <option value="">Select Speciality of doctor</option>
                                                        <?php if(isset($specialitys)){?>
                                                        @foreach($specialitys as $speciality)
                                                          <option value="{{$speciality->id }}">{{ $speciality->name }}</option>
                                                        @endforeach
                                                        <?php }?>
                                                      </select>
                                                </div>
                                                <div class="col-xs-3 col-sm-4 col-md-2">
                                                   <button type="button" style="" class="add_ref btn btn-primary"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-xs-12 col-sm-12 col-md-10">
                                                  <select class="form-control form-control-sm required select_doctor"  title="Search Medicines" name="doctor[]" id="doctordata0" data-count="0">
                                                        <option value="">Select doctor</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-xs-12 col-sm-12 col-md-10">
                                                    <textarea class="form-control diagnosis" placeholder="Write diagnosis" name="diagnosis[]"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-xs-12 col-sm-12 col-md-10">
                                                    <textarea class="form-control reasonreferral" placeholder="Reason for referral" name="referraldetails[]"></textarea>
                                                </div>
                                            </div>
                                  </div>
                                </div>
                            </div>
                            <div class="panel-panel-default">
                                  <div class="panel-body" id="referraldata">
                                        
                                  </div>
                            </div>
                      </div>
                      <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{route('front.home.emr')}}" class="btn btn-primary">Cancel</a>
                      </div>

                  </div>
                            </div>
                      </div>
                  </div> 
                  

                  

                   
             
      </div>
      </form>
    </div>
</div>
<script>
  var availableTutorials2 = [];
        $(function() {
         
            $( "#automplete-1" ).autocomplete({
               source: function( request, response ) {
   
                     $.ajax({
                      url: "<?php echo URL::to('front/icd_record'); ?>",
                      type: 'get',
                      dataType: "json",
                      data: {
                       doctor_id: request.term.split( /,\s*/ ).pop()
                      },
                      success: function( data ) {
                        
                            response( data );
                            setTimeout(function(){handler(request, response);}, 1000);

                      }
                     });
                    },
                    select: function (event, ui) {
                     // Set selectionalert
                      $('#automplete-1').val(ui.item.label); 
                     return false;
                    }

            });
         });

</script>
<script type="text/javascript">
   
var count = 1;

//Add Prescription Form
$('body').on('click', '.add_prsc', function () {
        // $('#newprsc').append('<div class="box-body"><div class="form-group row"><div class="col-xs-9 -col-sm-6 col-md-10"><select class="form-control form-control-sm required medicines_select chosen" title="Search Medicines" name="medicines[]" id="medicines'+count+'" data-count="'+count+'"><option value="">Select Medicines</option><?php if(isset($medicines)){?>@foreach($medicines as $medicine)<option value="{{$medicine->id }}">{{ $medicine->name }}</option>@endforeach<?php }?></select></div><div class="col-xs-3 col-sm-6 col-md-2"><button type="button" style="" class="remove_prsc btn btn-primary"><i class="fa fa-minus"></i></button></div></div><div class="disprecord dc'+count+'"><div class="form-group row"><div class="col-sm-6"><input type="text" name="dose[]" class="form-control form-control-sm dose" value="" id="dose0" placeholder="Dose" ></div><div class="col-sm-4"><select class="form-control form-control-sm required dosetype " title="Search Medicines" name="dosetype[]" id="medicines0" data-count="0"><option value="">Select Dose</option><option value="mg">Mg</option><option value="ml/g">ml/g</option><option value="mcg">mcg</option></select></div></div><div class="form-group row"><label for="staticEmail" class="col-sm-12 col-form-label col-form-label-sm">Frequency</label></div><div class="form-group row"><div class="col-sm-3"><input type="text" name="frequency1[]" class="form-control form-control-sm frequency1" value="" id="frequency10" placeholder="Morning"></div><div class="col-sm-3"><input type="text" name="frequency2[]" class="form-control form-control-sm frequency2" value="" id="frequency20" placeholder="Noon"></div><div class="col-sm-3"><input type="text" name="frequency3[]" class="form-control form-control-sm frequency3" value="" id="frequency30" placeholder="Night"></div></div><div class="form-group row"><div class="col-sm-10"><input type="number" name="duration[]" class="form-control form-control-sm duration" value="" id="duration0" placeholder="Duration"></div></div><div class="form-group row"><div class="col-sm-10"><input type="text" name="route[]" class="form-control form-control-sm route" value="" id="duration0" placeholder="route"></div></div></div></div>');
          count ++;
});
$('body').on('click', '.remove_prsc', function (e) {            
             $(this).closest('.box-body').remove();
             
});
//Add Referral Form       
$('body').on('click', '.add_ref', function () {

          // $('#newreferral').append('<div class="disprecord"><div class="box-body"><div class="form-group row"><div class="col-xs-9 col-sm-8 col-md-10"><select class="form-control form-control-sm required medicines_change" title="Search Medicines" name="referral[]" id="medicines'+count+'" data-count="'+count+'"><option value="">Select Speciality of doctor</option> <?php if(isset($specialitys)){?>@foreach($specialitys as $speciality)<option value="{{$speciality->id }}">{{ $speciality->name }}</option>@endforeach<?php }?></select></div><div class="col-xs-3 col-sm-4 col-md-2"><button type="button" style="" class="remove_ref btn btn-primary"><i class="fa fa-minus"></i></button></div></div><div class="form-group row"><div class="col-xs-12 col-sm-12 col-md-10"><select class="form-control form-control-sm required select_doctor" title="Search Medicines" name="doctor[]" id="doctordata'+count+'" data-count="0"><option value="">Select doctor</option></select></div></div><div class="form-group row"><div class="col-xs-12 col-sm-12 col-md-10"><textarea class="form-control diagnosis" placeholder="Write diagnosis" name="diagnosis[]"></textarea></div></div><div class="form-group row"><div class="col-xs-12 col-sm-12 col-md-10"><textarea class="form-control reasonreferral" placeholder="Reason for referral" name="referraldetails[]"></textarea></div></div></div></div>');
            count ++;
});
$('body').on('click', '.remove_ref', function (e) {            
             $(this).closest('.box-body').remove();             
});
        
//Add Investigation Form
$('body').on('click', '.add_invest', function () {

          // $('#add_investigation').append('<div class="box-body"><div class="form-group row"><div class="col-xs-9 col-sm-8 col-md-10"><select class="form-control form-control-sm required investigation_select" title="Search Medicines" name="investigation[]" id="medicines0" data-count="0"><option value="">Select Investigation</option><?php if(isset($investigations)){?>@foreach($investigations as $investigation)<option value="{{$investigation->id }}">{{ $investigation->testname_english }}</option>@endforeach<?php }?></select></div><div class="col-xs-3 col-sm-4 col-md-2"><button type="button" style="" class="remove_invest btn btn-primary"><i class="fa fa-minus"></i></button></div></div><div class="form-group  row"><div class="col-xs-9 col-sm-8 col-md-10"><textarea class="form-control notes" placeholder="Add notes" name="notes[]"></textarea></div></div></div>');
            
            count ++;
});
$('body').on('click', '.remove_invest', function (e) {            
             $(this).closest('.box-body').remove();             
});

//On Change Event Of Speciality Wise Doctor
$(function() {
      $("body").on("change",".medicines_change", function(){
              var id=$(this).attr('id');
              $('.disprecord').addClass(id);
              var speciality_id = $(this).val();
              var count=$(this).data('count');
              var details = '<?php echo URL::to('front/specialitywisedoctor'); ?>';
              if(speciality_id)
              {
                  $.ajax({
                        type:'get',
                        url:details,
                        data: {
                            speciality_id: speciality_id,
                            count:count,
                            id:id
                        },
                        success:function(data){
                            $('#doctordata'+count).empty();
                            $('#doctordata'+count).append('<option value="">Select Doctor</option>');
                            $.each(data, function( index, value ) {
                                  $('#doctordata'+count).append('<option value="' + value.doctor_id + '">'+ value.first_name +'</option>');
                            });        
                        }
                  });
              }
              else
              {
                  $('#doctordata'+count).empty();
                  $('#doctordata'+count).append('<option value="">Select Doctor</option>');
              }
            });
      });
        
</script>
<script type="text/javascript">
  $(document).ready(function () {  
// Get Investigation Record Edit Form
        var details = '<?php echo URL::to('front/getinvestigation'); ?>';
        var emr_id = $('#emr_id').val();
        $.ajax({
                type:'get',
                url:details,
                data: {emr_id: emr_id},
                success:function(res){
                  
                  var count = Object.keys(res).length;
                  $.each(res, function(index, value) {
                    var i=1;
                    $('#investigationdata').append('<div class="box-body"><input type="hidden" name="investigation[]" value="'+value.investigation_id+'"><input type="hidden" name="subinvestigation[]" value="'+value.type_id+'"><input type="hidden" name="notes[]" value="'+value.note+'"><div class="form-group row"><div class="col-xs-9 -col-sm-6 col-md-10"><b>'+value.type_name+'</b></div><div class="col-xs-3 col-sm-6 col-md-2"><button type="button" style="background-color: #44729C;color:#fff;" class="remove_invest btn btn-xs" value="'+value.id+'"><i class="fa fa-minus" ></i></button></div><div class="col-xs-9 -col-sm-6 col-md-10"><b>'+value.investigation_name+'</b></div> <div class="col-xs-9 -col-sm-6 col-md-10"><b>'+value.note+'</b></div></div></div>');

                  });
                }
          });
// Get Prescription Record Edit Form
        var details = '<?php echo URL::to('front/getprescription'); ?>';
        var emr_id = $('#emr_id').val();
        $.ajax({
                type:'get',
                url:details,
                data: {emr_id: emr_id},
                success:function(res){
                  var count = Object.keys(res).length;
                  $.each(res, function(index, value) { 
                    
                    var i=1;
                    $('#prescriptiondata').append('<div class="box-body"><input type="hidden" name="medicines[]" value="'+value.medicine_id+'"><input type="hidden" name="dose[]" value="'+value.dose+'"><input type="hidden" value="'+value.unit+'" name="dosetype[]"><input type="hidden" value="'+value.frequency+'" name="frequency1[]"><input type="hidden" value="'+value.frequency2+'" name="frequency2[]"><input type="hidden" value="'+value.frequency3+'" name="frequency3[]"><input type="hidden" value="'+value.duration+'" name="duration[]"><input type="hidden" value="'+value.route+'" name="route[]"><div class="form-group row"><div class="col-xs-9 -col-sm-6 col-md-10">'+i+'. '+value.medicine_name+'</div><div class="col-xs-3 col-sm-6 col-md-2"><button type="button" style="background-color: #44729C;color:#fff;" class="remove_prsc btn btn-xs" value="'+value.id+'"><i class="fa fa-minus"></i></button></div><div class="col-xs-9 -col-sm-6 col-md-10"><b>Dose: '+value.dose+'</b></div><div class="col-xs-9 -col-sm-6 col-md-10"><b>Frequency: '+value.frequency+'-'+value.frequency2+'-'+value.frequency3+'</b></div><div class="col-xs-9 -col-sm-6 col-md-10"><b>Route: '+value.route+'</b></div><div class="col-xs-9 -col-sm-6 col-md-10"><b>Duration: '+value.duration+'</b></div></div></div>');
                    i++;
                  });
                 
                }
          });
// Get Refferal Record Edit Form
var details = '<?php echo URL::to('front/getrefferal'); ?>';
var emr_id = $('#emr_id').val();
    $.ajax({
          type:'get',
          url:details,
          data: {emr_id: emr_id},
          success:function(res){
                var count = Object.keys(res).length;
                $.each(res, function(index, value) {
                   $('#referraldata').append('<div class="box-body"><input type="hidden" name="referral[]" value="'+value.speciality_id+'"><input type="hidden" name="doctor[]" value="'+value.doctor_id+'"><input type="hidden" value="'+value.diagnosis+'" name="diagnosis[]"><input type="hidden" value="'+value.reason+'" name="referraldetails[]"><div class="form-group row"><div class="col-xs-9 -col-sm-6 col-md-10"><b>Doctor: '+value.doctor_name+'</b></div><div class="col-xs-3 col-sm-6 col-md-2"><button type="button" style="background-color: #44729C;color:#fff;" class="remove_ref btn btn-xs" value="'+value.id+'"><i class="fa fa-minus"></i></button></div><div class="col-xs-9 -col-sm-6 col-md-10"></div><div class="col-xs-9 -col-sm-6 col-md-10"><b>Speciality: '+value.speciality_name+'</b></div><div class="col-xs-9 -col-sm-6 col-md-10"><b>Diagnosis: '+value.diagnosis+'</b></div><div class="col-xs-9 -col-sm-6 col-md-10"><b>Reason for referral: '+value.reason+'</b></div></div></div>');
                });
          }
    });
});
// Remove Refferal Record
$('body').on('click', '.remove_ref', function () {  
          $(this).closest('.box-body').remove(); 
          var details = '<?php echo URL::to('front/removerefferal'); ?>';
          var referral_id = $(this).attr("value");
          $.ajax({
                  type:'get',
                  url:details,
                  data: {referral_id: referral_id},
                  success:function(res){
                          if(res==0)
                          {
                              $(this).closest('.box-body').remove();
                              window.location.reload(); 
                          }
                          else
                          {

                          }
                  }
          });
});
// Remove Investigation Record
$('body').on('click', '.remove_invest', function () {  
    $(this).closest('.box-body').remove(); 
    var details = '<?php echo URL::to('front/removeinvestigation'); ?>';
    var invest_id = $(this).attr("value");
    $.ajax({
            type:'get',
            url:details,
            data: {invest_id: invest_id},
            success:function(res){
                    if(res==0)
                    {
                          $(this).closest('.box-body').remove();
                          window.location.reload(); 
                    }
                    else
                    {

                    }
            }
    });
});
// Remove Prescription Record
$('body').on('click', '.remove_prsc', function () {  
        $(this).closest('.box-body').remove();        
        var details = '<?php echo URL::to('front/removeprescription'); ?>';
        var prescription_id = $(this).attr("value");
        $.ajax({
                type:'get',
                url:details,
                data: {prescription_id: prescription_id},
                success:function(res){
                                          
                      if(res==0)
                      {

                          $(this).closest('.box-body').remove();
                          window.location.reload(); 
                      }
                      else
                      {

                      }
                }
        });
});           
//Medicines Select
$(function() {
            $("body").on("change",".medicines_select", function(){

                    var selected = $(this).val();
                    var dc = $(this).attr("data-count");
                    if(selected)
                    {

                      var mdetails = '<?php echo URL::to('front/medicalrecord'); ?>';
                          $.ajax({
                            type:'get',
                            url:mdetails,
                            data: {
                              medicines: selected
                            },
                            success:function(data){
                              console.log(data.dose);
                              $(".dc"+dc+" .dose").val(data.dose);
                              $(".dc"+dc+" .route").val(data.route);
                            }
                          });
                          $(".dose").prop('required',true);
                          $(".dosetype").prop('required',true);
                          $(".frequency1").prop('required',true);
                          $(".frequency2").prop('required',true);
                          $(".frequency3").prop('required',true);
                          $(".duration").prop('required',true);
                          $(".route").prop('required',true);
                    }
                    else
                    {
                          $(".dose").prop('required',false);
                          $(".dosetype").prop('required',false);
                          $(".frequency1").prop('required',false);
                          $(".frequency2").prop('required',false);
                          $(".frequency3").prop('required',false);
                          $(".duration").prop('required',false);
                          $(".route").prop('required',false);
                    }
                    
            });
});
//Investigation Select
$(function() {
            $("body").on("change",".investigation_select", function(){

                    var selected = $(this).val();
                    if(selected)
                    {
                        $(".notes").prop('required',true);  
                    }
                    else
                    {
                        $(".notes").prop('required',false);
                    }

                    
            });
});
//Refferal Select
$(function() {
            $("body").on("change",".referral_select", function(){
                    var selected = $(this).val();
                    if(selected)
                    {
                        $(".select_doctor").prop('required',true);
                        $(".diagnosis").prop('required',true);
                        $(".reasonreferral").prop('required',true);
                    }
                    else
                    {
                        $(".select_doctor").prop('required',false);
                        $(".diagnosis").prop('required',false);
                        $(".reasonreferral").prop('required',false);
                    }
                    
            });
});
$(function() {
            $(".chosen").chosen();
});
</script>
@endsection