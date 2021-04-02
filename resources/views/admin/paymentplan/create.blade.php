@extends('layouts.admin')

@section('content')

<div id="content">

        <div class="container-fluid">

          <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  @if(isset($plan))
                  <b>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.plan.index') }}" class="breadcrumb-item active crumb">Update :: Package</a></li>
                  </b>
                  @else
                  <b>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.plan.index') }}" class="breadcrumb-item active crumb">Add :: Package</a></li>
                  </b>
                  @endif
                </ol>
          </nav>

          <div class="row">
            <div class="col-8">
              @if(isset($plan))
            
              @else
            
              @endif
            </div>
            
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
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

                  @if(isset($plan))
                    <form class="form-horizontal" action="{{ route('admin.plan.update') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" value="{{ $plan->id }}" name="id" />
                    <input type="hidden" id='selcted_value' name="selcted_value" value="{{$plan->type}}">
                  @else
                    <form class="form-horizontal" action="{{ route('admin.plan.store') }}" method="post" enctype="multipart/form-data">
                  @endif
                    
                    @csrf

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Type<span class="text-danger">*</span></label>

                      <div class="col-sm-9">
                        @if(isset($plan))
                          <select class="form-control form-control-sm required duration_change" title="Search Medicines" name="type" id="year" data-count="0">
                            <option value="">Select Plan</option>
                            <option value="yearly" <?php if($plan->type=="yearly" || $plan->type=="Yearly"){?>selected="selected"<?php }?>>Yearly</option>
                            <option value="monthly"<?php if($plan->type=="monthly" || $plan->type=="Monthly"){?>selected="selected"<?php }?>>Monthly</option>
                          </select>
                        @else
                          <select class="form-control form-control-sm required duration_change" title="Search Medicines" name="type" id="year" data-count="0">
                            <option value="">Select Plan</option>
                            <option value="yearly">Yearly</option>
                            <option value="monthly">Monthly</option>
                          </select>
                          
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Type arabic<span class="text-danger">*</span></label>

                      <div class="col-sm-9">
                        @if(isset($plan))
                          <select class="form-control form-control-sm required" title="Search Medicines" name="ar_type" id="year" data-count="0">
                            <option value="">Select Plan Arabic</option>
                            <option value="سنوي" <?php if($plan->ar_type=="سنوي" || $plan->ar_type=="سنوي"){?>selected="selected"<?php }?>>سنوي</option>
                            <option value="شهريا"<?php if($plan->ar_type=="شهريا" || $plan->ar_type=="شهريا"){?>selected="selected"<?php }?>>شهريا</option>
                          </select>
                        @else
                          <select class="form-control form-control-sm required" title="Search Medicines" name="ar_type" id="ar_year" data-count="0">
                            <option value="">Select Plan Arabic</option>
                            <option value="سنوي">سنوي</option>
                            <option value="شهريا">شهريا</option>
                          </select>
                          
                        @endif
                      </div>
                    </div>

                    <div class="form-group row" style="display: none;" id="months">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Month<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($plan))
                          <select class="form-control form-control-sm required month_change" title="Search Medicines" name="months" id="year" data-count="0" >
                            <option value="">Select Month</option>
                            <option value="1" <?php if($plan->months=="1"){?>selected="selected"<?php }?>>1</option>
                            <option value="2" <?php if($plan->months=="2"){?>selected="selected"<?php }?>>2</option>
                            <option value="3" <?php if($plan->months=="3"){?>selected="selected"<?php }?>>3</option>
                            <option value="4" <?php if($plan->months=="4"){?>selected="selected"<?php }?>>4</option>
                            <option value="5" <?php if($plan->months=="5"){?>selected="selected"<?php }?>>5</option>
                            <option value="6" <?php if($plan->months=="6"){?>selected="selected"<?php }?>>6</option>
                            <option value="7" <?php if($plan->months=="7"){?>selected="selected"<?php }?>>7</option>
                            <option value="8" <?php if($plan->months=="8"){?>selected="selected"<?php }?>>8</option>
                            <option value="9" <?php if($plan->months=="9"){?>selected="selected"<?php }?>>9</option>
                            <option value="10" <?php if($plan->months=="10"){?>selected="selected"<?php }?>>10</option>
                            <option value="11" <?php if($plan->months=="11"){?>selected="selected"<?php }?>>11</option>
                          </select>
                        @else
                          <select class="form-control form-control-sm required month_change" title="Search Medicines" name="months" id="year" data-count="0" >
                            <option value="">Select Month</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                          </select>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row" style="display: none;" id="years">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Year<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($plan))
                          <select class="form-control form-control-sm required year_change" title="Search Medicines" name="years" id="year" data-count="0" >
                            <option value="">Select Year</option>
                            <option value="1" <?php if($plan->years=="1"){?>selected="selected"<?php }?>>1</option>
                            <option value="2" <?php if($plan->years=="2"){?>selected="selected"<?php }?>>2</option>
                            <option value="3" <?php if($plan->years=="3"){?>selected="selected"<?php }?>>3</option>
                            <option value="4" <?php if($plan->years=="4"){?>selected="selected"<?php }?>>4</option>
                            <option value="5" <?php if($plan->years=="5"){?>selected="selected"<?php }?>>5</option>
                          </select>
                        @else
                          <select class="form-control form-control-sm required year_change" title="Search Medicines" name="years" id="year" data-count="0" >
                            <option value="">Select Year</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                          </select>
                        @endif
                      </div>
                    </div>


                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Price (SAR)<span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        @if(isset($plan))
                          <input type="text" name="price" class="form-control form-control-sm" value="{{ $plan->price }}">
                        @else
                          <input type="text" name="price" class="form-control form-control-sm" value="{{ old('price') }}" maxlength="10">
                        @endif
                      </div>                      
                    </div>

                     @if(isset($plan))
                      <button type="submit" class="btn btn-warning">Update</button>
                     @else
                      <button type="submit" class="btn btn-warning">Submit</button>
                     @endif
                      <a href="{{route('admin.plan.index')}} " class="btn btn-secondary">Cancel</a>
                   
                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

</div>

<script type="text/javascript">
  $(function() {

            $("body").on("change",".duration_change", function(){

                var selectedCountry = $(this).children("option:selected").val();

                if(selectedCountry==='yearly' || selectedCountry==='Monthly')
                {
                    $('#years').show();
                    $('.month_change').prop('selectedIndex',0);
                    $('.year_change').prop('required',true);
                    $('.month_change').prop('required',false);
                    $('#months').hide();
                }
                
                if(selectedCountry==='monthly' || selectedCountry==='Monthly' )
                {
                    $('#months').show();
                    $('.year_change').prop('selectedIndex',0);
                    $('.month_change').prop('required',true);
                    $('.year_change').prop('required',false);
                    $('#years').hide();
                }

                if(selectedCountry==='')
                {
                    $('#months').hide();
                    $('#years').hide();
                    $('.month_change').prop('required',false);
                    $('.year_change').prop('required',false);
                }

            });
  });
</script>
<script type="text/javascript">
 $(document).ready(function () {
    
    var selectedCountry = $('#selcted_value').val();
    if(selectedCountry==='yearly' || selectedCountry==='Yearly')
    {
        $('#years').show();
        $('.year_change').prop('required',true);
    }

     if(selectedCountry==='monthly' || selectedCountry==='Monthly')
    {
        $('#months').show();
        $('.month_change').prop('required',false);
    }

});
</script>
@endsection

@section('custom_js')

@endsection
