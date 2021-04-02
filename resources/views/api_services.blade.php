<html>
	<title>Eclinic API Services</title>
	<head>
		<link href="{!! asset('assets/plugins/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet" type="text/css" />
		<script src="{!! asset('assets/js/jquery.min.js') !!}" type="text/javascript"></script>
  		<script src="{!! asset('assets/plugins/bootstrap/js/bootstrap.min.js') !!}" type="text/javascript"></script>
	</head>
	<style type="text/css">
		html,body{
			font-size: 10px;
			letter-spacing: 0.8px;
		}
		table,th,td,tr{
			color: #000;
			font-size: 12px;
		}
	.header{
		background: black;
		height: auto;
		text-align: left;
		color: white;
		padding:10px 10px;
	}
	.header label{
		font-size: 16px;
	}
	small {
		font-size: 15px;
	}
</style>
<?php
$api_list = DB::table('api_services')->get();
?>
	<body>
		<section class="header">
			<label>Omnee API Services - (<small>URL : {{ $_SERVER['HTTP_HOST'] }}</small>)</label><br>
			<label>Omnee Storage - (<small>URL : {{ $_SERVER['HTTP_HOST'].'/storage/app/' }}</small>)</label>
		</section>
		<section class="content">
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>API Name</th>
						<th>API URL</th>
						<th>Method</th>
						<th>Headers</th>
						<th>Parameter</th>
						<th>Description</th>
						<!-- <th style="width: 10%">
							Status <br>
							Android | IOS
						</th> -->
					</tr>
				</thead>
				<tbody>
					@foreach($api_list as $key => $api)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td><b>{{ $api->name }}</b></td>
							<td>{{ $api->url }}</td>
							<td>{{ $api->method }}</td>
							<td>{{ ($api->headers) ? $api->headers : '-' }}</td>
							<td>{{ ($api->parameter) ? $api->parameter : '-' }}</td>
							<td>{{ ($api->description) ? $api->description : '-' }}</td>
							<!-- <td>
								Pending | Done
							</td> -->
						</tr>
					@endforeach
				</tbody>
			</table>
		</section>
	</body>

</html>
