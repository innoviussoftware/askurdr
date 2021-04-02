@extends('layouts.front')

@section('content')
<div id='content' class="container col-md-10 col-md-offset-1  text well" align="">
   
  	<div class="row">
  		<div class="col-md-6 col-sm-6">
 <nav aria-label="breadcrumb">
                <ol class="breadcrumb" >
                  
                       <b><li class="breadcrumb-item active" aria-current="page"><a href="{{ route('front.home.bookappointment') }}" class="breadcrumb-item active crumb">Book Appointment</a></li></b> 
                  
                </ol>
        </nav>
  				
                
                <form class="" id="filter_form" method="POST" action="{{route('front.home.bookingappointment')}}" enctype="multipart/form-data">

                  @csrf
                  <input type="hidden" name="doctor_id" value="{{$doctor_id}}">
                  <input type="hidden" name="date" value="{{$date}}">
                  <input type="hidden" name="time" value="{{$time}}">
                  <div class="col-md-12 col-sm-12">
                		<h3>Pre-Visit Form</h3>
                  </div>
                  <div class="col-md-12 col-sm-12" style="padding-bottom: 0.5em;">
                  	  <label>Select the reason for consultation</label>
                  	  <select id="reason" class="form-control" name="reason" required>
                  	  	<option class="form-control" value="">Select reason</option>
                  	  	<option class="form-control" value="Asking For medications refill">Asking For medications refill</option>
                  	  	<option class="form-control" value="Asking For laboratory test">Asking For laboratory test</option>
                  	  	<option class="form-control" value="Having medical questions or complaints">Having medical questions or complaints</option>
                  	  </select>
                      
                  </div>
                 
                  <div class="col-md-12 col-sm-12" style="padding-bottom: 0.5em;">
                      <textarea class="form-control" rows="5" placeholder="Enter detail information" name="description"></textarea>
                  </div>

                  <div class="col-md-12 col-sm-12"  style="padding-bottom: 0.5em;">
                      <label>Do you have any medical reports?</label>
                      <select id="reports" class="form-control" name="report" required="true">
                      	<option class="form-control" value="">Select</option>
                      	<option class="form-control" value="1">Yes</option>
                  	  	<option class="form-control" selected value="0">No</option>
                  	  </select>
                  </div>

                  <div class="col-md-12 col-sm-12" style="padding-bottom: 0.5em;display: none;" id="reports_file">
                      <input type="file" name="report_file[]" multiple="" class="reports_file">
                  </div>
                 
                  <div class="col-md-12 col-sm-12" style="padding-bottom: 0.5em;">
                      <button type="submit" id="logs_filter_btn" class="btn btn-primary">Book Appointment</button>
                  </div>

                </form>
              </div>

  	</div>
</div>


<script type="text/javascript">

  $(function() {
          $("body").on("change","#reports", function(){
              var selectedCountry = $(this).children("option:selected").val();              
              if(selectedCountry=='1')
              {
                $('#reports_file').show();
                $(".reports_file").prop('required',true);
              }
              else
              {
                $('#reports_file').hide(); 
                $(".reports_file").prop('required',false);
              }
          });
  });
</script>

@endsection