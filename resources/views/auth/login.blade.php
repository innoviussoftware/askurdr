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

                  <br>{{ __('Login') }}

                </h1>

              </div>

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

                <div class="alert alert-danger alert-dismissable fade in alert_msg">

                    <span>{{ session('error') }}</span>

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

                @if (session('status'))



                <div class="alert alert-success" role="alert">

                    {{ session('status') }}

                </div>

              @endif

              <form method="POST" class="user" action="{{ route('login') }}">

                  @csrf



                <div class="form-group">

                  <input id="email" type="text" class="form-control-user form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="National Id/Iqama Id" autocomplete="off" oninvalid="this.setCustomValidity('Enter email')"oninput="setCustomValidity('')">

                  @if ($errors->has('email'))

                    <span class="invalid-feedback" role="alert">

                        <strong>{{ $errors->first('email') }}</strong>

                    </span>

                  @endif

                </div>

                <div class="form-group">

                  <input id="password" type="password" class="form-control-user form-control" name="password" required placeholder="Password" autocomplete="off"  oninvalid="this.setCustomValidity('Enter password')" oninput="setCustomValidity('')">

                  @if ($errors->has('password'))

                    <span class="invalid-feedback" role="alert">

                        <strong>{{ $errors->first('password') }}</strong>

                    </span>

                  @endif

                </div>

                

                <button type="submit" class="btn btn-warning btn-user btn-block" style="font-size: 18px;text-align: left;background-color: #003366 !important;border-color:#003366 !important;">

                    {{ __('Login') }}<i class="pt-1 float-right fas fa-sign-in-alt"></i>

                </button>



                <hr>

              </form>

              <div class="text-center">

                @if (Route::has('password.request'))

                  <a class="small" href="{{ route('password.request') }}" style="color: blue;">

                    {{ __('Forgot Your Password?') }}

                  </a>

                @endif

                

              </div>

              <!-- <div class="text-center">

                

                <a class="small" href="{{route('home.register_patient')}}" style="color: blue;">

                  {{ __('New User? Sign Up') }}

                </a>

              </div> -->

            </div>

          </div>

        </div>

      </div>

    </div>



  </div>



</div>

@endsection

