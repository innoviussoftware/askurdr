<!DOCTYPE html>
<html>
<head>
    <title>Askurdr</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
<link href="{!! asset('public/front_assets/css/bootstrap.min.css') !!}" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jqc-1.12.4/dt-1.10.18/datatables.min.css"/>
<link href="{!! asset('public/front_assets/css/datatables.min.css') !!}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ asset('public/js/style.css') }}"/>

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
</style>
<link href="{!! asset('public/front_assets/css/style.css') !!}" rel="stylesheet" type="text/css">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
<script src="{!! asset('public/front_assets/js/jquery-1.11.1.min.js') !!}"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script src="{!! asset('public/front_assets/js/bootstrap.min.js') !!}"></script>
<script src="{!! asset('public/front_assets/js/datatables.min.js') !!}"></script>
<!-- <script src="{{ asset('public/js/sinch.min.js') }}"></script> -->
<script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
<script src="https://cdn.sinch.com/latest/sinch.min.js"></script>
</head>
<body>
<?php
$id = auth()->user()->id;
$notification = App\Notification::with(['from_user' => function($q){
            $q->select('first_name','last_name','id');
        },'to_user' => function($p){
            $p->select('first_name','last_name','id');
        }])->where('to_id',$id)->orderBy('id','desc')->get();

$count =  App\Notification::with(['from_user' => function($q){
            $q->select('first_name','last_name','id');
        },'to_user' => function($p){
            $p->select('first_name','last_name','id');
        }])->where('to_id',$id)->count();
?>
<div class="container col-md-12" style="width: 100%;" >
    <nav class="navbar navbar-icon-top navbar-default" role="navigation" >
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a  href="{{route('front.home.dashboard')}}" style="float: left;height: none; padding: 3px 3px; font-size: 18px; line-height: 20px;"><img src="{!! asset('public/front_assets/images/logo.png') !!}" width="100" class="img-fluid" /></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php
                            $user = App\User::find(Auth::user()->id);
                    ?>
                    @if($user->roles()->first()->id == '3')
                        <li class="{{ Route::currentRouteName() === 'front.home.dashboard' ? 'active' : '' }}">
                            <a href="{{route('front.home.dashboard')}}"><i class="fa  fa-stethoscope"></i> Dashboard</a>
                        </li>
                        <li class="{{ Route::currentRouteName() === 'front.home.upcomingappointment' ? 'active' : '' }}">
                            <a href="{{route('front.home.upcomingappointment')}}">
                                    <i class="fa fa-calendar">
                                    </i>
                                    Up Comming Appointments
                            </a>
                        </li>
                        <li class="{{ Route::currentRouteName() === 'front.home.doctorprofile' ? 'active' : '' }}">
                            <a href="{{route('front.home.doctorprofile')}}">
                                <i class="fa fa-user">
                                    <span class="badge badge-success"></span>
                                </i>
                                Doctor Profile
                            </a>
                        </li>
                        <li class="{{ Route::currentRouteName() === 'front.home.labresults' ? 'active' : '' }}">
                            <a href="{{route('front.home.labresults')}}"><i class="fa fa-list"></i>
                                Lab Results
                            </a>
                        </li>
                        <li class="{{ Route::currentRouteName() === 'front.home.prescription' ? 'active' : '' }}">
                            <a href="{{route('front.home.prescription')}}"><i class="fa fa-list"></i>
                                My Prescriptions
                            </a>
                        </li>
                        <li class="{{ Route::currentRouteName() === 'front.home.uploadcenter' ? 'active' : '' }}">
                            <a href="{{route('front.home.uploadcenter')}}">
                                <i class="fa fa-upload">
                                    <span class="badge badge-success"></span>
                                </i>
                                Upload Center
                            </a>
                        </li>
                        <li class="{{ Route::currentRouteName() === 'front.home.refferal' ? 'active' : '' }}">
                            <a href="{{route('front.home.refferal')}}">
                                <i class="fa fa-user-plus">
                                    <span class="badge badge-success"></span>
                                </i>
                                Referral
                            </a>
                        </li>
                    @else
                        <li class="{{ Route::currentRouteName() === 'front.home.dashboard' ? 'active' : '' }}">
                            <a href="{{route('front.home.dashboard')}}"><i class="fa  fa-stethoscope"></i> Dashboard</a>
                        </li>
                        <li class="{{ Route::currentRouteName() === 'front.home.getappointment' ? 'active' : '' }}">
                            <a href="{{route('front.home.getappointment')}}"><i class="fa fa-calendar"></i>
                                Today's Appointments
                            </a>
                        </li>
                        <li class="{{ Route::currentRouteName() === 'front.home.labresults' ? 'active' : '' }}">
                            <a href="{{route('front.home.labresults')}}"><i class="fa fa-list"></i>
                                Lab Results
                            </a>
                        </li>
                        <li class="{{ Route::currentRouteName() === 'front.home.prescription' ? 'active' : '' }}">
                            <a href="{{route('front.home.prescription')}}"><i class="fa fa-list"></i>
                                My Prescriptions
                            </a>
                        </li>
                        <li class="{{ Route::currentRouteName() === 'front.home.uploadcenter' ? 'active' : '' }}">
                            <a href="{{route('front.home.uploadcenter')}}">
                                <i class="fa fa-upload"></i>
                                Upload Center
                            </a>
                        </li>
                        <li class="{{ Route::currentRouteName() === 'front.home.investigation' ? 'active' : '' }}">
                            <a href="{{route('front.home.investigation')}}">
                                <i class="fa fa-list">
                                </i>
                                Investigations
                            </a>
                        </li>
                    @endif
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown"aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell">
                                <span class="badge badge-danger">{{$count}}</span>
                            </i>
                            Notifications
                        </a>
                        <ul class="dropdown-menu scrollable-menu" role="menu" style="max-width: 380px;">
                            @foreach($notification as $notify)
                            <li><a href="#" style="padding: 10px;">{{$notify->message}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <?php if(auth()->user()->profile_pic!=null){?>
                            <div><img src="{{env('APP_URL_WITHOUT_PUBLIC').'/storage/app/'.auth()->user()->profile_pic}}" style="width: 30px;height: 30px;border-radius: 5em;"></div>
                            <?php }else{?>
                            <div>
                                <i class="fa fa-user-circle-o" style="font-size: 2.2em !important;"></i>
                                <!-- <img src="{{env('APP_URL_WITHOUT_PUBLIC').'storage/app/USER.png'}}" style="width: 25px;height: 25px;border-radius: 5em;"> --></div>
                            <?php }?>
                            Account <span class="caret"></span>
                        </a>
                         <?php if($user->roles()->first()->id == '3'){?>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('front.home.changepassword')}}">Change Password</a></li>
                            <li><a href="{{route('front.home.profile')}}">Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a onclick="logoutsinch()" href="{{route('logout')}}">Logout</a></li>
                        </ul>
                        <?php }else{ ?>
                            <ul class="dropdown-menu">
                            <li><a href="{{route('front.home.changepassword')}}">Change Password</a></li>
                            <li><a href="{{route('front.home.profile')}}">Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a onclick="logoutsinch()" href="{{route('logout')}}">Logout</a></li>
                        </ul>
                            <?php }?>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</div>







@yield('content')



<script type="text/javascript">
  $(document).ready(function () {
    timer = setTimeout(function () {
        $('.alert-success').hide();
    }, 3000);
    timer = setTimeout(function () {
        $('.alert-danger').hide();
    }, 3000);
});
</script>
<div class=" videocall_screen_loader" ><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>
<div class="container videocall_screen" style="display:none;">
<div class="text-right"><button type="button" id="close_videoscreen">Close</button></div>
  <div id="chromeFileWarning" class="frame big">
    <b style="color: red;">Warning!</b> Protocol "file" used to load page in Chrome.<br><br>
    Please avoid loading files directly from disk when developing WebRTC applications using Chrome.<br>
    Chrome disables access to microphone which prevents proper functionality.<br>
    <br>
    You can allow working with "file:", if you start Chrome with the flag <i>--allow-file-access-from-files</i>
  </div>

  <div class="clearfix"></div>

  <div class="frame small">
    <div class="inner loginBox">
      <h3 id="login">Waiting ..</h3>
      <form id="userForm">
        <input id="sinch_ticket" type="hidden" value="<?php echo isset($sinch_ticket) ? $sinch_ticket : "" ?>" >
      </form>
      <div id="userInfo">
        <h3><span id="username"></span></h3>
        <!-- <button id="logOut">Logout</button> -->
      </div>
    </div>
  </div>

  <div class="frame">
    <h3 class="call_heading">Video Call</h3>
    <div id="call">
      <form id="newCall">
        <!-- <input id="callUserName" placeholder="Username (alice)"><br> -->
        <!-- <button id="call">Call</button> -->
        <button id="hangup" class="btn btn-danger">Hangup</button>
        <button id="answer" class="btn btn-success">Answer</button>

      </form>
    </div>
    <div class="clearfix"><br></div>
    <div class="row">
      <div class="col-md-6">
        <video id="videooutgoing" autoplay muted></video>
      </div>
      <div class="col-md-6">
        <video id="videoincoming" autoplay></video>
      </div>
    </div>



    <div id="callLog">
    </div>
    <div class="error">
    </div>
  </div>
  @if($user->roles()->first()->id=='2')
    @include('include.emr_form')
  @endif
</div>


 <script src="{!! asset('public/js/VIDEOsample.js') !!}"></script>
 <script>
 function logoutsinch(){
 	sinchClient.terminate();
 	delete localStorage[sessionName];
 }
 </script>

</body>

</html>
