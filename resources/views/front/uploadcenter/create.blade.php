@extends('layouts.front')



@section('content')

<div id='content' class="container col-md-10 col-md-offset-1  text well" align="">

  	<div class="row">



  		<div class="col-md-6">

  			

  			@if(session()->has('success'))

				    <div class="alert alert-success">

				        {{ session()->get('success') }}

				    </div>

			@endif

			@if(session()->has('danger'))

				    <div class="alert alert-danger">

				        {{ session()->get('danger') }}

				    </div>

			@endif

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



  			<form action="{{ route('front.documenttype.store') }}" enctype="multipart/form-data"  method="post">

  				@csrf

				  <div class="form-group">

				    <label for="exampleInputEmail1">Type Of Document</label>

				    <select class="form-control" id="documentid" required="required">

				    	<option class="form-control" value="">Select Document Type</option>

				    	@foreach($dt as $d)

				    	<option class="form-control" value="{{$d->id}}">{{$d->name}}</option>

				    	@endforeach

				    </select>

				  </div>

				  <div class="form-group">

				    <label for="exampleInputPassword1">Report</label>

				    <select class="form-control  " id="reportid" required="required" name="reportid">

				    	<option class="form-control" value="">Select Report no</option>

				    	

				    </select>

				  </div>

				  <div class="form-group">

				    <label for="exampleInputPassword1">Select Document</label>

				    <input type="file" class="reportselect" id="exampleInputPassword1" placeholder="Password"  name='documents[]'>

				    <!-- <input type="file" class="reportselect" id="exampleInputPassword1" placeholder="Password" multiple="multiple" name='documents[]'> -->



				  </div>

				  <button type="submit" class="btn btn-primary">Submit</button>

			</form>

  		</div>

  	</div>

</div>

<script type="text/javascript">

	$(function() {

          

            $("body").on("change","#documentid", function(){

				

            	var document_id = $(this).val();

            	var details = '<?php echo URL::to('front/documenttype'); ?>';

            	if(document_id)

            	{

            		

	            	$.ajax({

	                               type:'get',

	                               url:details,

	                               data: {

	                                document_id: document_id,

	                              },

	                               success:function(data){

	                                $('#reportid').empty();

	                                	var json = $.parseJSON(data);

	                                	console.log(json);

	                                	$('#reportid').append('<option value="">Select Report no</option>');

	                                	 $.each(json, function (index, value) {



	                    					$('#reportid').append('<option value="' + value.id + '">Reportno '+ value.id + '</option>');

	               						 });

	                              	}

	                });

                }

                else

                {

                	$('#reportid').empty();

                	$('#reportid').append('<option value="">Select Report no</option>');

                }



            });



            $("body").on("change","#reportid", function(){

				var selectedCountry = $(this).children("option:selected").val();   

            	//var selectedCountry = $('#reportid').val(); 



	            if(selectedCountry=null)

	            {

	            	$(".reportselect").prop('required',false);

	            }

	            else

	            {

	            	$(".reportselect").prop('required',true);

	            }



            });	

                

            

    });

</script>

@endsection