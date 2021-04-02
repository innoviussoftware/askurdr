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
                  <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.patient.index') }}" class="breadcrumb-item active crumb">Edit :: Prescription</a></li>
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
                  
                  

                
                  

                    <form class="form-horizontal" action="{{ route('admin.patient.update',$emrdetails->id)}}"method="post" enctype="multipart/form-data">
                        <input type="hidden" name="prescription_id" value="{{$emrdetails->id}}" id="prescription_id">
                        <input type="hidden" name="patient_id" value="{{$patient->id}}" id="doctor_id">
                       @csrf
                       
                        {{ method_field('PATCH') }}
                       
                    
                    <input type="hidden" name="emr_number" value="{{$emrdetails->emr_number}}" id="doctor_id">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Emr Number</label>
                      <div class="col-sm-9">
                        {{$emrdetails->emr_number}}
                      </div>
                    </div>
                     <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Diagnosis<span class="text-danger">*</span></label>
                      <div class="col-sm-7">
                         <input type="text" name="diagnosis" class="form-control form-control-sm" value="{{$emrdetails->physican_diagonis_id}}" id = "automplete-1" required="required">
                      </div>
                    </div>
                    
                    <div class="Prescriptionnew" id="newprscs">
                      <?php if($ped>0){
                        
                      }else{?>
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Medicines Name<span class="text-danger">*</span></label>
                      <div class="col-sm-7">
                        <select class="form-control form-control-sm required medicines_change" title="Search Medicines" name="medicines[]" id="medicines0" data-count="0">
                              <option value="">Select Medicines</option>
                              <?php if(isset($medicines)){?>
                            @foreach($medicines as $medicine)
                              <option value="{{$medicine->id }}">{{ $medicine->name }}</option>
                            @endforeach
                          <?php }?>

                          </select>
                      </div>
                      <div class="col-sm-2">
                         
                         
                         <button type="button" style="" class="addprec btn btn-primary"><i class="fa fa-plus"></i></button>
                      </div>
                    </div>
                    <div class="disprecord">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Dose<span class="text-danger">*</span></label>
                      <div class="col-sm-4">
                        
                          <input type="text" name="dose[]" class="form-control form-control-sm dose" value=""id="dose0" required="required">

                      </div>
                      <div class="col-sm-3">
                        <select class="form-control form-control-sm required" title="Search Medicines" name="units[]" id="units0" data-count="0">
                          <option value="">Select Unit</option>
                          <option value="mg">Mg</option>
                          <option value="ml">Ml</option>
                          <option value="g">G</option>
                          <option value="mcg">Mcg</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Route<span class="text-danger">*</span></label>
                      <div class="col-sm-7">
                        
                          <input type="text" name="route[]" class="form-control form-control-sm route" value=""id="route0" required="required">
                        
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Frequency<span class="text-danger">*</span></label>
                      <div class="col-sm-2">
                          <input type="text" name="frequency1[]" class="form-control form-control-sm frequency1[]" value="" id="frequency10" required="required">
                      </div>
                      <div class="col-sm-2">
                          <input type="text" name="frequency2[]" class="form-control form-control-sm frequency2[]" value="" id="frequency20">
                      </div>
                      <div class="col-sm-2">
                        
                          <input type="text" name="frequency3[]" class="form-control form-control-sm frequency3[] " value="" id="frequency30">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Duration<span class="text-danger">*</span></label>
                      <div class="col-sm-7">
                          <input type="number" name="duration[]" class="form-control form-control-sm duration" value="" id="duration0" required="required">
                        
                      </div>
                    </div>
                  </div>
                  <?php }?>
                    </div>
                  
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Note to Pharmacy<span class="text-danger">*</span></label>
                      <div class="col-sm-7">
                         <textarea class="form-control form-control-sm" name='pharmacy'>{{$emrdetails->physican_note}}</textarea>
                      </div>
                    </div>
                    <!-- <button type="button" class="btn btn-secondary float-left">Cancel</button> -->

                    <button type="submit" class="btn btn-warning" style="background-color: #003366 !important;border-color: #003366 !important;">Update</button>
                    <a href="{{route('admin.patient.index')}} " class="btn btn-secondary">Cancel</a>
                    
                   
                  
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
  $(document).ready(function () {
   var details = '<?php echo URL::to('admin/getprescriptionsmedicines'); ?>';
          
        var prescription_id = $('#prescription_id').val();
          
            $.ajax({
                type:'get',
                url:details,
                data: {prescription_id: prescription_id},
                success:function(res){
                  var count = Object.keys(res).length;
                  $.each(res, function(index, value) {
                    
                     $('#newprscs').append('<div class="box-body"><div class="form-group row"><label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Medicines Name<span class="text-danger">*</span></label><div class="col-sm-7"><select class="form-control form-control-sm required  medicines medicines_change" title="Search Medicines" name="medicines[]"><option value="">Select Medicines</option><?php if(isset($medicines)){foreach($medicines as $medicine){?><option value="<?php echo $medicine->id ;?>" <?php if(in_array($medicine->id,$prescription_medicines)){?>selected="selected"<?php }?>><?php echo $medicine->name; ?></option><?php }}?></select></div><div class="col-sm-2"><button type="button" value="'+value.id+'" style="    margin-right: 0.5em;" class="removeprec btn btn-primary " name="remove_id"><i class="fa fa-minus"></i></button><button type="button" style="" class="addprec btn btn-primary '+( (index > 0) ? 'd-none' : '' )+'" value="'+value.id+'" name="addnew_id" ><i class="fa fa-plus"></i></button></div></div><div class="form-group row"><label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Dose<span class="text-danger">*</span></label><div class="col-sm-4"><input type="text" name="dose[]" class="form-control form-control-sm dose" value="'+value.dose+'" required="required"></div><div class="col-sm-3"><select class="form-control form-control-sm required" title="Search Medicines" name="units[]" id="units" data-count="0"><option value="">Select Unit</option><option value="mg" '+( (value.unit == 'mg') ? 'selected' : '' )+'>Mg</option><option value="ml" '+( (value.unit == 'ml') ? 'selected' : '' )+'>Ml</option><option value="g" '+( (value.unit == 'g') ? 'selected' : '' )+'>G</option><option value="mcg" '+( (value.unit == 'mcg') ? 'selected' : '' )+'>Mcg</option></select></div></div><div class="form-group row"><label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Route<span class="text-danger">*</span></label><div class="col-sm-7"><input type="text" name="route[]" class="form-control form-control-sm route" value="'+value.route+'" required="required"></div></div><div class="form-group row"><label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Frequency<span class="text-danger">*</span></label><div class="col-sm-2"><input type="text" name="frequency1[]" class="form-control form-control-sm frequency1" value="'+value.frequency+'" required="required"></div><div class="col-sm-2"><input type="text" name="frequency2[]" class="form-control form-control-sm frequency2" value="'+value.frequency2+'"></div><div class="col-sm-2"><input type="text" name="frequency3[]" class="form-control form-control-sm frequency3" value="'+value.frequency3+'"></div></div><div class="form-group row"><label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Duration<span class="text-danger">*</span></label><div class="col-sm-7"><input type="number" name="duration[]" class="form-control form-control-sm" value="'+value.duration+'" required="required"><input type="hidden" value="'+value.id+'" name="medicines_pre" id="pre_id"></div></div></div>');
                        $('.select2').select2();
                  });
                  
                 
                }
          });
});


var count = 1;
$('body').on('click', '.addprec', function () {

          $('#newprscs').append('<div class="box-body"><div class="form-group row"><label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Medicines Name<span class="text-danger">*</span></label><div class="col-sm-7"><select class="form-control form-control-sm required  medicines_change" title="Search Medicines" name="medicines[]" id="medicines'+count+'" data-count="'+count+'"><option value="">Select Medicines</option><?php if(isset($medicines)){foreach($medicines as $medicine){?><option value="<?php echo $medicine->id ;?>"><?php echo $medicine->name; ?></option><?php }}?></select></div><div class="col-sm-2"><button type="button" style="" class="remove_module btn btn-primary"><i class="fa fa-minus"></i></button></div></div><div class="disprecord"><div class="form-group row"><label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Dose<span class="text-danger">*</span></label><div class="col-sm-4"><input type="text" name="dose[]" class="form-control form-control-sm" value="<?php  old('doctor_name') ?>" id="dose'+count+'" required="required"></div><div class="col-sm-3"><select class="form-control form-control-sm required" title="Search Medicines" name="units[]" id="units'+count+'"><option value="">Select Unit</option><option value="mg">Mg</option><option value="ml">Ml</option><option value="g">G</option><option value="mcg">Mcg</option></select></div></div><div class="form-group row"><label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Route<span class="text-danger">*</span></label><div class="col-sm-7"><input type="text" name="route[]" class="form-control form-control-sm" value="<?php old('email') ?>" id="route'+count+'" required="required"></div></div><div class="form-group row"><label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Frequency<span class="text-danger">*</span></label><div class="col-sm-2"><input type="text" name="frequency1[]" class="form-control form-control-sm" value="<?php old('mobile') ?>" id="frequency1'+count+'" required="required"></div><div class="col-sm-2"><input type="text" name="frequency2[]" class="form-control form-control-sm" value="<?php old('mobile') ?>" id="frequency2'+count+'"></div><div class="col-sm-2"><input type="text" name="frequency3[]" class="form-control form-control-sm" value="<?php old('mobile') ?>" id="frequency3'+count+'"></div></div><div class="form-group row"><label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Duration<span class="text-danger">*</span></label><div class="col-sm-7"><input type="number" name="duration[]" class="form-control form-control-sm" value="<?php old('age') ?>" id="duration'+count+'" required="required"></div></div></div></div>');

            $('.select2').select2();

            count ++;
});

$('body').on('click', '.remove_module', function () {            
             $(this).closest('.box-body').remove();
             
});

$(function() {
         
            $( "#automplete-1" ).autocomplete({
               source: function( request, response ) {
   
                     $.ajax({
                      url: "<?php echo URL::to('admin/icd_record'); ?>",
                      type: 'get',
                      dataType: "json",
                      data: {
                       doctor_id: request.term.split( /,\s*/ ).pop()
                      },
                      success: function( data ) {
                        
                            response( data );
                            setTimeout(function(){handler(request, response);}, 1500);

                      }
                     });
                    },
                    select: function (event, ui) {
                     
                      $('#automplete-1').val(ui.item.label); 
                     return false;
                    }

            });
         });

  

 $('body').on('click', '.removeprec', function () {  

              $(this).closest('.box-body').remove(); 
              window.location.reload(); 
              var details = '<?php echo URL::to('admin/removeprescriptions'); ?>';
              var prescription_id = $(this).attr("value");

              $.ajax({
                        type:'get',
                        url:details,
                        data: {prescription_id: prescription_id},
                        success:function(res){
                            
                            if(res==0)
                            {

                              $(this).closest('.box-body').remove();

                            }
                            else
                            {

                            }
                        }
              });
});
</script>



@endsection
