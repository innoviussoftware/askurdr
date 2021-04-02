<!DOCTYPE html>
<html>
<head>
    <title>Payment Plan</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">

<link href="{!! asset('public/front_assets/css/bootstrap.min.css') !!}" rel="stylesheet" id="bootstrap-css">


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jqc-1.12.4/dt-1.10.18/datatables.min.css"/>
<link href="{!! asset('public/front_assets/css/datatables.min.css') !!}" rel="stylesheet" type="text/css">

<style type="text/css">
   @font-face {
  font-family: 'Glyphicons Halflings';
  src: url('../fonts/glyphicons-halflings-regular.eot');
  src: url('../fonts/glyphicons-halflings-regular.eot?#iefix') format('embedded-opentype'), url('../fonts/glyphicons-halflings-regular.woff') format('woff'), url('../fonts/glyphicons-halflings-regular.ttf') format('truetype'), url('../fonts/glyphicons-halflings-regular.svg#glyphicons-halflingsregular') format('svg');
}

.scrollable-menu {
    height: auto;    
    max-height: 200px;
    overflow-x: hidden;
    
    list-style: none;
}
*{ font-family:"Open Sans"; }
*, *:before, *:after{ 
    box-sizing: border-box; 
    -moz-box-sizing: border-box; 
    -webkit-box-sizing: border-box; 
} 
h1{ text-align: center; }
.small-meta{font-size:12px;}
.dim{opacity:0.4}
.image{ width: 72px; height:90px; background: #CCC; margin-left: auto; margin-right: auto;}

*,
*:before,
*:after {
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
}
h1 {
  text-align: center;
}
.small-meta {
  font-size: 12px;
}
.dim {
  opacity: 0.4;
}
.image {
  width: 180px;
  height: 120px;
  background: #CCC;
  margin-left: auto;
  margin-right: auto;
}
.grid-wrapper {
  margin: 0 13px;
  width: 80%;
  vertical-align: middle;
  position: relative;
}
.card-content {
  border: 1px solid #CCC;
  border-radius: 3px;
  padding: 25px 25px 10px 25px;
}
.card-content * {
  cursor: pointer;
}
.card-wrapper {
  position: relative;
  width: 235px;
  float: left;
  margin-right: 50px;
  margin-bottom: 50px;
}
.c-card {
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
  visibility: hidden;
}
.c-card ~ .card-content {
  transition: all 500ms ease-out;
}
.c-card ~ .card-content .card-state-icon {
  position: absolute;
  top: 5px;
  right: 5px;
  z-index: 2;
  width: 20px;
  height: 20px;
  background-position: 0 0;
  transition: all 100ms ease-out;
}
.c-card ~ .card-content:before {
  position: absolute;
  top: 1px;
  right: 1px;
  width: 0;
  height: 0;
  border-top: 52px solid #47cf73;
  border-left: 52px solid transparent;
  transition: all 200ms ease-out;
}
.c-card ~ .card-content:after {
  position: absolute;
  top: 1px;
  right: 1px;
  content: "";
  width: 0;
  height: 0;
  border-top: 50px solid #FFF;
  border-left: 50px solid transparent;
  transition: all 200ms ease-out;
}
.c-card ~ .card-content:hover {
  border: 1px solid #6dc5dc;
}
.c-card ~ .card-content:hover .card-state-icon {
  background-position: -30px 0;
}
.c-card ~ .card-content:hover:before {
  border-top: 52px solid #47cf73;
}
.c-card:checked ~ .card-content {
  border: 1px solid #6dc5dc;
}
.c-card:checked ~ .card-content .card-state-icon {
  background-position: -90px 2px;
}
.c-card:checked ~ .card-content:before {
  border-top: 52px solid #47cf73;
      background: url("https://www.shareicon.net/download/2016/08/20/817721_check.svg") no-repeat;
}
.c-card:checked ~ .card-content:after {
  border-top: 52px solid #47cf73;
  
}
.c-card:checked:hover ~ .card-content .card-state-icon {
  background-position: -60px 2px;
}
.c-card:checked:hover ~ .card-content:before {
  border-top: 52px solid #47cf73;
}
.c-card:checked:hover ~ .card-content:after {
  border-top: 52px solid #47cf73;
}



</style>

<link href="{!! asset('public/front_assets/css/style.css') !!}" rel="stylesheet" type="text/css">

<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('public/admin_assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<script src="{!! asset('public/front_assets/js/jquery-1.11.1.min.js') !!}"></script> 
<script src="{!! asset('public/front_assets/js/bootstrap.min.js') !!}"></script>

<script src="{!! asset('public/front_assets/js/datatables.min.js') !!}"></script> 
<script src="{{ asset('public/admin_assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

</head>
<body>
  <div id='content' class="container col-md-10 col-md-offset-1  text well" align="">
    <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">
                  <img src="{!! asset('public/logo.png') !!}" class="img-fluid mb-3" width="150"/>
                  <br>{{ __('Payment Plan') }}<br><br>
                </h1>
              </div>
               
            </div>
          </div>
        </div>
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
                    <b>
                      <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('front.home.changepassword') }}" class="breadcrumb-item active crumb">Payment :: Plan </a></li>
                    </b>
                    
                  </ol>
              </nav>
          <form method="post" action="{{ route('front.home.password') }}" enctype="multipart/form-data">
            @csrf

                <div class="form-group col-md-12" style="width: 60% !important;">
                  <label for="inputAddress2">Select Payment Type</label>
                  <select name="payment" class="form-control" id="payment_type">
                    <option class="form-control" value="">Select Type</option>
                    <option class="form-control" value="1">Self Payment</option>
                    <option class="form-control" value="2">Insurance</option>
                  </select>
                </div>
                <div id="payment_details" style="display: none;">
                    @foreach($packages as $package)
                    <div class="form-group">
                      <div class="grid-wrapper">
                          <div class="card-wrapper" data-id="{{$package->id}}" data-value="{{$package->id}}">
                            
                            <input class="c-card" type="radio" id="checkSurfaceEnvironment{{$package->id}}" value="{{$package->id}}" >
                            <div class="card-content">
                              <div class="card-state-icon"></div>
                              <label for="1">
                              
                                <?php if($package->type=='monthly' || $package->type=='Monthly'){?>
                                <h5>
                                  Monthly
                                </h5>
                                <?php }?>                              

                                <?php if($package->type=='yearly' || $package->type=='Yearly'){?>
                                <h5>
                                  Yearly
                                </h5>
                                <?php }?>
                                
                                <p class="small-meta dim">Price:-{{$package->price}}</p>
                              </label>
                            </div>
                          </div>  
                      </div>
                    </div>
                    @endforeach
                </div>

                <div class="row" id="insurance_details" style="display: none;margin: 0 !important;width: 60% !important;">

                  <div class="form-group col-md-12" style="">
                      <label for="inputPassword4">Insurance Name</label>
                      <input type="password" class="form-control" id="password2" placeholder="Insurance Name" name='newpassword'>
                  </div>

                  <div class="form-group col-md-12">
                          <label for="inputAddress">Insurance Number</label>
                          <input type="password" class="form-control" id="password3" placeholder="Insurance Number" name='repassword'>
                   </div>

                   <div class="form-group col-md-12">
                          <label for="inputAddress">Insurance Document</label>
                          <input type="file" name='insurance_document[]' multiple="multiple" >
                   </div>

                </div>

                <div class="form-group col-md-12">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <a href="{{route('login')}}" class="btn btn-primary">Cancel</a>
                </div>

          </form>

      </div>
        
</div>
<script type="text/javascript">
  $(function() {
    $("body").on("change","#payment_type", function(){

              var selectedCountry = $(this).children("option:selected").val();               
              if(selectedCountry=='1')
              {
                    $('#insurance_details').hide();
                    $('#payment_details').show();
              }
             

              if(selectedCountry=='2')
              {
                   $('#payment_details').hide();
                   $('#insurance_details').show();
              }
              
              if(selectedCountry=='')
              {
                   $('#payment_details').hide();
                   $('#insurance_details').hide();
              }
    });
    $("body").on("click",".card-wrapper", function(){

        var id=$(this).attr('data-id');
        
        if($('#checkSurfaceEnvironment'+id).not(':checked').length){      
                $('#checkSurfaceEnvironment'+id).prop("checked",true);

        }else{
           $('#checkSurfaceEnvironment'+id).prop('checked', false); 
        } 
    });
    
  });
  
</script>
</body>
</html>