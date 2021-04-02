@extends('layouts.app')

@section('content')
<!-- Outer Row -->
<div class="row justify-content-center mt-3">

  <div class="col-xl-5 col-lg-12 col-md-9 mt-5">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
              @endif
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">
                  <img src="{!! asset('public/logo.png') !!}" class="img-fluid mb-3" width="150"/>
                  <br>{{ __('Reset Password') }}
                </h1>
              </div>
              <form method="POST" class="user" action="{{ route('change.pwd') }}">
                @if ($errors->any())
                <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                @endif

                

                @if( session('error') )
                <div class="alert alert-danger">
                    <span>{{ session('error') }}</span>
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
                @endif
                <!-- end of error message-->
                @if( session('success') )
                <div class="alert alert-success">
                    <span>{{ session('success') }}</span>
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
                @endif
                  @csrf
                <div class="form-group">
                  <input id="email" type="text" class="form-control-user form-control" name="email" value="{{ $email ?? old('email') }}" required autofocus autocomplete="off" placeholder="Enter National Id" maxlength="10" minlength="9">
                </div>

                <button type="submit" class="btn btn-warning btn-user btn-block" style="font-size: 18px;background-color: #003366 !important;border-color:#003366 !important;">
                    {{ __('Send Password') }}
                </button>
                <hr>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>
@endsection
