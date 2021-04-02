@extends('layouts.front')

@section('content')

<style type="text/css">
	#doctordatatable_filter label{
		display: none !important;
	}
</style>
<div id='content' class="container col-md-10 col-md-offset-1  text well" align="">
   
  	<div class="row">
  		<div class="col-md-12">
				<nav aria-label="breadcrumb">
	                <ol class="breadcrumb" style="padding:8px 0px !important;">
	                  <b>
	                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('front.home.doctorprofile') }}" class="breadcrumb-item active crumb">Listing :: Doctor Profile</a></li>
	                  </b>
	                  
	                </ol>
            	</nav>
					<table class="table" width="100%" cellspacing="0" style="border:none;">
	                	{!! Form::open(array('method'=>'POST','class'=>'form-horizontal validate_form','id'=>'filter_form')) !!}
					     <tr>
					       
					       <td>
					         <select id='speciality' class="form-control">
					           <option value=''>-- Select speciality of doctor--</option>
					           @foreach($response as $res)
					           <option value='{{$res->id}}'>{{$res->name}}</option>
					           @endforeach
					         </select>
					       </td>
					       <td>
					         <input type='text' id='searchByDoctor' placeholder='Search Doctor' class="form-control">
					       </td>
					       <td>
					       	<button type="button" id="logs_filter_btn" class="btn btn-primary">Submit</button>
					       </td>
					       
					     </tr>
					    {!! Form::close() !!}
   					</table>
	            <div class="table-responsive">
	                
	                 <table class="table table-bordered" id="doctordatatable" width="100%" cellspacing="0">
	
	                  <thead>
	                    <tr>
	                      <th></th>
	                      <th>Name</th>
	                      <th>Appointment Time</th>
	                      <th>Education</th>
	                      <th>Speciality</th>
	                      <th>Experience</th>
	                      <th>Profile</th>
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
        var doctordatatable = $('#doctordatatable').DataTable({
            responsive: true,
            
            'ajax': {
			       'url':'{{ route("front.doctorprofile.array") }}',
			       'data': function(data){

			          var speciality = $('#speciality').val();
			          var searchByDoctor = $('#searchByDoctor').val();
			          // Append to data
			          data.speciality = speciality;
			          data.searchByDoctor = searchByDoctor;
			       }
			    },
            "language": {
                "emptyTable": "No doctor available"
            },
            "order": [[0, "desc"]],
        });
        doctordatatable.columns([0]).visible(false, false);
         $("body").on("click", "#logs_filter_btn", function (e) {

              var speciality = $("#speciality").val();

              var searchByDoctor = $("#searchByDoctor").val();

              $.ajax({
                  url: "{{ route('front.doctorprofile.array') }}",
                  type: 'get',
                  data: {
                      speciality: speciality,
                      searchByDoctor:searchByDoctor,
                  }
	              }).done(function (result) {
	                  doctordatatable.clear().draw();
	                  result = $.parseJSON(result);
	                  var rowNode = doctordatatable.rows.add(result.data).draw().nodes();
	              }).fail(function (jqXHR, textStatus, errorThrown) {
                  
              });
        });
         $('body').on('click','.reset-btn',function (e) {
           doctordatatable.ajax.reload(null, false);
        });
         
    });

    
  

</script>

</script>
@endsection





