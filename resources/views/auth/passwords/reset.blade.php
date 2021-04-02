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
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">
                  <img src="{!! asset('public/logo.png') !!}" class="img-fluid mb-3" width="150"/>
                  <br>{{ __('Reset Password') }}
                </h1>
              </div>
              @if (session('danger'))

                <div class="alert alert-danger" role="alert">
                    {{ session('danger') }}
                </div>
              @endif

              @if (session('status'))

                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
              @endif
              <form method="POST" class="user" action="{{ route('password.update') }}">
                  @if ($errors->any())
                <div class="alert alert-danger">
                            <ul style="list-style-type: none;">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                @endif

                @if( session('danger') )
                <div class="alert alert-danger alert-dismissable fade in alert_msg">
                    <span>{{ session('danger') }}</span>
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
                @endif
                <!-- end of error message-->
                @if( session('success') )
                <div class="alert alert-success alert-dismissable fade in alert_msg">
                    <span>{{ session('success') }}</span>
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
                @endif
                @csrf
              <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">

                  <input id="email" type="email" class="form-control-user form-control" name="email" value="{{ $email ?? old('email') }}" required autofocus autocomplete="off" placeholder="Email address" oninvalid="this.setCustomValidity('Enter email')"oninput="setCustomValidity('')">
                  
                </div>
                <div class="form-group">
                  <input id="password" type="password" class="form-control-user form-control" name="password" required autocomplete="off" placeholder="New password" oninvalid="this.setCustomValidity('Enter password')"oninput="setCustomValidity('')">
                  
                </div>
                <div class="form-group">
                  <input id="password-confirm" type="password" class="form-control-user form-control" name="password_confirmation" required autocomplete="off" placeholder="Confirm password" oninvalid="this.setCustomValidity('Enter password')"oninput="setCustomValidity('')">
                </div>

                <button type="submit" class="btn btn-warning btn-user btn-block" style="font-size: 18px;background-color: #003366 !important;border-color:#003366 !important;">
                    {{ __('Reset Password') }}
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
