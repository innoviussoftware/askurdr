<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Askurdr</title>
    <link rel="shortcut icon" href="{{ asset('public/logo.png') }}">
    <link rel="stylesheet" href="{!! asset('public/assets/bootstrap/css/bootstrap.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('public/assets/fonts/font-awesome.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('public/assets/fonts/ionicons.min.css') !!}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="{!! asset('public/assets/css/Fixed-navbar-starting-with-transparency1.css') !!}">
    <link rel="stylesheet" href="{!! asset('public/assets/css/Fixed-navbar-starting-with-transparency.css') !!}">
    <link rel="stylesheet" href="{!! asset('public/assets/css/Contact-Form-Clean.css') !!}">
    <link rel="stylesheet" href="{!! asset('public/assets/css/Contact-FormModal-Contact-Form-with-Google-Map.css') !!}">
    <link rel="stylesheet" href="{!! asset('public/assets/css/Features-Blue.css') !!}">
    <link rel="stylesheet" href="{!! asset('public/assets/css/Footer-Clean.css') !!}">
    <link rel="stylesheet" href="{!! asset('public/assets/css/Header-Blue.css') !!}">

    <link rel="stylesheet" href="{!! asset('public/assets/css/Navigation-Clean.css') !!}">
    <link rel="stylesheet" href="{!! asset('public/assets/css/Projects-Clean.css') !!}">
    <link rel="stylesheet" href="{!! asset('public/assets/css/Projects-Horizontal.css') !!}">

    <link rel="stylesheet" href="{!! asset('public/assets/css/styles.css') !!}">
     <link rel="stylesheet" href="{!! asset('public/assets/js/styles.css') !!}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">

        <!-- CSS stylesheet for jcSlider -->
        <link rel="stylesheet" href="{!! asset('public/assets/css/jcslider.css') !!}">
        <!-- animate CSS stylesheet library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.3.0/animate.min.css">


<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  font-size: 20px;
}

#myBtn {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  font-size: 18px;
  border: none;
  outline: none;
  background-color: red;
  color: white;
  cursor: pointer;
  padding: 15px;
  border-radius: 4px;
}

#myBtn:hover {
  background-color: #555;
}



.our-team {
  padding: 30px 0 40px;
  margin-bottom: 30px;
  background-color: #f7f5ec;
  text-align: center;
  overflow: hidden;
  position: relative;
}

.our-team .picture {
  display: inline-block;
  height: 130px;
  width: 130px;
  margin-bottom: 50px;
  z-index: 1;
  position: relative;
}

.our-team .picture::before {
  content: "";
  width: 100%;
  height: 0;
  border-radius: 50%;
  background-color: #1369ce;
  position: absolute;
  bottom: 135%;
  right: 0;
  left: 0;
  opacity: 0.9;
  transform: scale(3);
  transition: all 0.3s linear 0s;
}

.our-team:hover .picture::before {
  height: 100%;
}

.our-team .picture::after {
  content: "";
  width: 100%;
  height: 100%;
  border-radius: 50%;
  background-color: #1369ce;
  position: absolute;
  top: 0;
  left: 0;
  z-index: -1;
}

.our-team .picture img {
  width: 100%;
  height: auto;
  border-radius: 50%;
  transform: scale(1);
  transition: all 0.9s ease 0s;
}

.our-team:hover .picture img {
  box-shadow: 0 0 0 14px #f7f5ec;
  transform: scale(0.7);
}

.our-team .title {
  display: block;
  font-size: 15px;
  color: #4e5052;
  text-transform: capitalize;
}

.our-team .social {
  width: 100%;
  padding: 0;
  margin: 0;
  background-color: #1369ce;
  position: absolute;
  bottom: -100px;
  left: 0;
  transition: all 0.5s ease 0s;
}

.our-team:hover .social {
  bottom: 0;
}

.our-team .social li {
  display: inline-block;
}

.our-team .social li a {
  display: block;
  padding: 10px;
  font-size: 17px;
  color: white;
  transition: all 0.3s ease 0s;
  text-decoration: none;
}

.our-team .social li a:hover {
  color: #1369ce;
  background-color: #f7f5ec;
}

</style>

</head>

<body>



<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up" aria-hidden="true"></i> Home</button>

    <div>
        <nav class="navbar navbar-light navbar-expand-md fixed-top navbar-transparency" style="background-color:rgba(86,118,180,0.43);height:80px;background-image:url(public/assets/img/navbar-bg.jpg); height: 80px !important;">
            <div class="container"><a class="navbar-brand" href="#" style="width:222px;"><img src="{{ asset('public/assets/img/logoest.png')}}" width='40%' /><strong>&nbsp;AskUrDr.com</strong></a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div
                    class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item" role="presentation"><a class="nav-link" id="clicktogothome" href="#home"><i class="fa fa-home" style="width:14px;height:37px;font-size:19px;"></i><strong>&nbsp; Home</strong></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link active" href="#About">&nbsp;<i class="fa fa-users"></i>&nbsp;About Us</a></li>
                        
                        <li class="nav-item" role="presentation"><a class="nav-link active" href="#Products">&nbsp;<i class="fa fa-upload"></i>&nbsp;Products & Services</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link active" href="#download">&nbsp;<i class="fa fa-download"></i>&nbsp;Dowload</a></li>
                        
						<li class="nav-item" role="presentation"><a class="nav-link active" href="{{route('login')}}">&nbsp;<i class="fa fa-cog fa-spin"></i>&nbsp;Login</a></li>
                        
						<li class="nav-item" role="presentation"><a class="nav-link active" href="#contactus"><i class="fa fa-envelope-o"></i>&nbsp;Contact Us</a></li>
						<li class="nav-item" role="presentation"><a class="nav-link active" href="{{route('arhtmlarabic')}}">&nbsp;لغة&nbsp;عربي&nbsp;<i class="fa fa-language"></i></a></li>
                        
                    </ul>
            </div>
    </div>
    </nav>
    </div>

    <div id="home"></div>
 <br>
 <br>
 <br>
 <br>
 <br>


          
             

             <div class="col-md-6" style="float: right;" >
                <!-- Slider start -->
                <ul class="jc-slider">
                    <li class="jc-animation">
                        <div class="wrap">

                            <br/>
                            <br/>
                            <br/>
                            <br/>

                            <h2>Welcome to <span style="color: red;">E clinic AskUrDr</span>. We have launched our IOS and Android app on the play store.</h2>
<br/>
<br/>

                            <img src="{{ asset('public/assets/img/iosapp.png')}}" width="40%">&nbsp;
                            <a href="https://play.google.com/store/apps/details?id=com.askurdr"><img src="{{ asset('public/assets/img/googleapp.png')}}" width="47%"></a>
                        </div>
                    </li>
                    <li class="jc-animation">
                        <div class="wrap">
                           <h2>
                            <br>
                            <br>
                            <br>
                            <br>
                           <span style="color: red;">E clinic AskUrDr</span> The Excellence in Medical Consultations In Saudi Arabia and GCC .</h2>
                        </div>
                    </li>
                    <li class="jc-animation">
                        <div class="wrap">
                            <h2>
                            <br>
                            <br>
                            <br>
                            <br><span style="color: red;">E clinic AskUrDr</span> Is Your Advisor toward appropriate honest Medical consultations</h2>
                        </div>
                    </li>
					
					
					  <li class="jc-animation">
                        <div class="wrap">
                            <h2>
                            <br>
                            <br>
                            <br>
                            <br><span style="color: red;">Patient Satisfaction</span> We care deeply for our patients</h2>
                        </div>
                    </li>
					

  
	
                </ul>
                <!-- Slider end -->
				
				 
			<!-- navigation buttons -->

<!--<div class="swiper-button-prev"></div>
<div class="swiper-button-next"></div>-->
   
              </div>

<div class="col-md-6">
             
                <!-- Slider start -->
                <ul class="jc-slider4" style="width: 100%;" >
                    <li class="jc-animation">
                        <img src="{{ asset('public/assets/img/mobile.png')}}" alt="1">
                    </li>
                    <li class="jc-animation">
                        <img src="{{ asset('public/assets/img/telemedicine.png')}}" alt="2">
                    </li>
                    <li class="jc-animation">
                        <img src="{{ asset('public/assets/img/dr2.png')}}" alt="3" width="50%">
                    </li>
					 <li class="jc-animation">
                        <img src="{{ asset('public/assets/img/patient.jpg')}}" alt="4" width="100%">
                    </li>
                </ul>
                <!-- Slider end -->
            </div>
            
  



    <div id="About"></div>

      <div class="col-md-12">
                        <br>
                        <br>
                         <br>
                    

                        <br>
                    </div>
    <div class="features-blue" ></div>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p style="font-size:30px;"></p>
                </div>
            </div>


            <div class="row">
                       

                          <div class="col-md-12">
                        <br>
                        <br>
                        <br>
                        <br>

                    </div>

                             
                <div class="col-md-6"><img class="rounded" src="{{ asset('public/assets/img/video call.png')}}" style="width:545px;height:399px;"></div>
                <div class="col-md-6">
                    <p style="font-size:27px;margin:44px;"><br>AskUrDr.com Is Your Medical Consultant at your hands Second by second<br><br></p>
                </div>

                 <div class="col-md-12">
                        <br>
                        <br>
                    </div>

            </div>
        </div>
    </div>
    <div></div>




    <div id="Products"></div>

      <div class="col-md-12">
                        <br>
                        <br>
                         <br>
                    

                        <br>
                    </div>
    <div class="features-blue" ></div>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p style="font-size:30px;"></p>
                </div>
            </div>


            <div class="row">
                       
                       

                          <div class="col-md-12">
                              
                       <br/>
                       <br/>
                        <h2>Product & Services</h2>
                       <br/>
                       
                             <p>We provide Web consultation for all kind of medical issues. On AskUrDr App you can go ahead and select any doctor belonging to various specialities and have a safe video or audio consultation from home. </p>
                      
                              
                              <div class="row">
                                  
     <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="our-team">
        <div class="picture">
          <img class="img-fluid" src="{{ asset('public/images.png') }}">
        </div>
        <div class="team-content">
          <h3 class="name">Dr. Mohammed Al Rowaily </h3>
          <h4 class="title">Consultant Family Medicine</h4>
          <h6>Price: <strike>315</strike> <span style="color:red;">75</span> SAR / Video Consultation</h6>
        </div>
        <ul class="social">
          <li><p style="color:white;">Super Discount: 75 SAR</p></li>
        </ul>
      </div>
    </div>
    
    
    
    
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="our-team">
        <div class="picture">
          <img class="img-fluid" src="{{ asset('public/images.png') }}">
        </div>
         <div class="team-content">
          <h3 class="name">Dr. Thamer Al anizi</h3>
          <br>
          <h4 class="title">Consultant Infectious Disease (Corona)</h4>
          <h6>Price: <strike>315</strike> <span style="color:red;">150</span> SAR / Video Consultation</h6>
        </div>
        <ul class="social">
          <li><p style="color:white;">Super Discount: 150 SAR</p></li>
        </ul>
      </div>
    </div>
    
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="our-team">
        <div class="picture">
          <img class="img-fluid" src="{{ asset('public/images.png') }}">
        </div>
         <div class="team-content">
          <h3 class="name">Dr. Dr Abdulkareem alanizi</h3>
          <h4 class="title">Consultant Family Medicine</h4>
          <h6>Price: <strike>315</strike> <span style="color:red;">75</span> SAR / Video Consultation</h6>
        </div>
        <ul class="social">
          <li><p style="color:white;">Super Discount: 75 SAR</p></li>
        </ul>
      </div>
    </div>
    
    
    
    
    <!-- <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="our-team">
        <div class="picture">
          <img class="img-fluid" src="{{ asset('public/images.png') }}">
        </div>
        <div class="team-content">
          <h3 class="name">Dr. Mazen Ferwana</h3>
          <h4 class="title">Doctor of Family Medicine</h4>
          <h6>Price: <strike>315</strike> <span style="color:red;">75</span> SAR / Video Consultation</h6>
        </div>
        <ul class="social">
          <li><p style="color:white;">Super Discount: 75 SAR</p></li>
        </ul>
      </div>
    </div> 
    
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="our-team">
        <div class="picture">
          <img class="img-fluid" src="{{ asset('public/doc5.png') }}">
        </div>
         <div class="team-content">
          <h3 class="name">Dr. Kinana Ahmed</h3>
          <h4 class="title">Gynecologist</h4>
          <h6>Price: <strike>315</strike> <span style="color:red;">75</span> SAR / Video Consultation</h6>
        </div>
        <ul class="social">
          <li><p style="color:white;">Super Discount: 75 SAR</p></li>
        </ul>
      </div>
    </div>
    
    
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="our-team">
        <div class="picture">
          <img class="img-fluid" src="{{ asset('public/doc5.png') }}">
        </div>
         <div class="team-content">
          <h3 class="name">Dr. Nancy Sameer</h3>
          <h4 class="title">Dermatologist</h4>
          <h6>Price: <strike>315</strike> <span style="color:red;">75</span> SAR / Video Consultation</h6>
        </div>
        <ul class="social">
          <li><p style="color:white;">Super Discount: 75 SAR</p></li>
        </ul>
      </div>
    </div>
  </div>-->
                              
                        <br>
                        <br>
                        <br>
                        <br>

                    </div>

                             
                <div class="col-md-12">
                
                
                
                </div>
                
                 <div class="col-md-12">
                        <br>
                        <br>
                    </div>

            </div>
        </div>
    </div>
    <div></div>








    <div id=""></div>

      <div class="col-md-12">
                        <br>
                        <br>
                         <br>
                    

                        <br>
                    </div>
    <div class="features-blue" ></div>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p style="font-size:30px;"></p>
                </div>
            </div>


            <div class="row">
                       

                          <div class="col-md-12">
                        <br>
                        <br>
                        <br>
                        <br>

                    </div>



<div class="card-deck">
  <div class="card">
    <img src="{{ asset('public/assets/img/kid.jpg')}}" class="card-img-top" alt="Image Mission" width="300px;" height="300px;">
    <div class="card-body">
      <h5 class="card-title">Our Mission</h5>
      <p class="card-text">AskUrDr.com: The Excellence in Medical Consultations In Saudi Arabia and GCC.</p>
      <p class="card-text"><small class="text-muted"></small></p>
    </div>
  </div>
  <div class="card">
     <img src="{{ asset('public/assets/img/vision-exercise-1.jpg')}}" class="card-img-top" alt="Image vision" height="300px;">
    <div class="card-body">
      <h5 class="card-title">Our Vision</h5>
      <p class="card-text">AskUrDr The leading company in Tele-Medicine field at GCC region</p>
      <p class="card-text"><small class="text-muted"></small></p>
    </div>
  </div>
 
</div>


                 <div class="col-md-12">
                        <br>
                        <br>
                    </div>	 

            </div>
        </div>
    </div>
    <div></div>






    <div id="main"></div>

      <div class="col-md-12">
                        <br>
                        <br>
                         <br>
                    

                        <br>
                    </div>
    <div class="features-blue" ></div>
	 <div id="download"></div>
	
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p style="font-size:30px;"></p>
                </div>
            </div>



                       

                          <div class="col-md-12">
                        <br>
                        <br>
                        <br>
                        <br>

                    </div>


<!-- Card -->



 
 
<div class="card card-cascade wider reverse">

  <!-- Card image -->
  <div class="view view-cascade overlay">
    <img class="card-img-top" src="{{asset('public/assets/img/banner2.jpg')}}" alt="Card image cap" style="height: 400px; " usemap="#linkmap"> 
	
	<map name="linkmap">
	
	
  <area shape="rect" coords="550,900,82,126" href="https://play.google.com/store/apps/details?id=com.askurdr" alt="Google play eclinic">
  <area shape="rect" coords="1200,500,0,0" href="https://www.apple.com/sa/ios/app-store/" alt="apple app store eclinic">
</map>
	
    <a href="#!">
      <div class="mask rgba-white-slight"></div>
    </a>
  </div>

  <!-- Card content -->
  <div class="card-body card-body-cascade text-center">

    <!-- Title -->
    <h4 class="card-title"><strong>What is askurdr</strong></h4>
    <!-- Subtitle -->
    <h6 class="font-weight-bold indigo-text py-2"></h6>
    <!-- Text -->
    <p class="card-text">Navigating the maze of Hospital consultants who have the expertise to match your particular medical needs can be tricky and time consuming in Crowded streets . Your <span style='color: blue;'>AskUrDr.com</span> <span style='color: red;'>(apps)</span>  for Tele - Medical Consultations (EMC)  Provides U with Direct consultations ( Video , Text , and <span style='color: blue;'>WhatsApp</span>.) Our consultant will make the initial assessment and then provide  you with the most appropriate action( Advice , Prescription , Lab request or Referral ). Our Consultant Guide makes it easy for EMC to pinpoint the right consultant you need.

    </p>

    
  </div>

</div>
<!-- Card -->

                 <div class="col-md-12">
                        <br>
                        <br>
                    </div>

            
        </div>
    </div>
    <div></div>





    <div class="projects-horizontal"></div>
    <div class="projects-clean">
        <div class="container">

            <div class="intro" id="contactus"></div>
        </div>
    </div>
    <div class="features-blue">
        <div class="col-md-12">
            <p style="font-size:30px;"></p>
        </div>
    </div>
    
    
    
        
            <div class="contact-clean" >



 <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p style="font-size:30px;"></p>
                </div>
            </div>


            <div class="row">
                       

                          <div class="col-md-12">
                              <h2 class="text-center left">
           <p><i class="fa fa-envelope"></i> You can Email Customer Support at <a href="mailto:contactus@askurdr.com">contactus@askurdr.com</a> </p>
           
           <p><i class="fa fa-phone"></i> Call customer support at: 920033181</p>
            
    </h2>
                        <br>
                        <br>
                        <br>
                        <br>

                    </div>

                             
                <div class="col-md-6">
                    
                    <h2 class="text-center left">
           <p><i class="fa fa-map-marker"></i> Locate Us</p>
    </h2>
    
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3621.643452550004!2d46.612220915001714!3d24.80765968407878!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjTCsDQ4JzI3LjYiTiA0NsKwMzYnNTEuOSJF!5e0!3m2!1sen!2ssa!4v1584431055139!5m2!1sen!2ssa"
        width="400" height="380" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
                <div class="col-md-6">
                    <p style="font-size:27px;">
                    <form method="post"    >
            <h2 class="text-center"><i class="fa fa-support"></i> Contact us</h2>
            
         
            <div class="form-group"><input class="form-control" type="text" name="name" placeholder="Name"></div>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email"></div>
            <div class="form-group"><textarea class="form-control" rows="14" name="message" placeholder="Message"></textarea></div>
            <div class="form-group"><button class="btn btn-primary" type="submit">send </button></div>
        </form></p>
                </div>

                 <div class="col-md-12">
                        <br>
                        <br>
                    </div>

            </div>
        </div>
    </div>



    </div>
    <div class="features-blue">
        <div class="col-md-12">
            <p style="font-size:30px;"></p>
        </div>
    </div>
    <div class="footer-clean">
        <footer>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-4 col-md-2 item">
                        <h3>Services</h3>
                        <ul>
                            <li><a href="#">Android App</a></li>
                            <li><a href="#">iOS App</a></li>
                            <li><a href="#">Web App</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-md-2 item">
                        <h3>About</h3>
                        <ul>
                            <li><a href="#">Company</a></li>
                            <li><a href="#">Team</a></li>
                            <li><a href="#">Legacy</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-md-2 item">
                        <h3>Policies</h3>
                        <ul>
                            <!--<li><a href="{{ asset('public/t&c.pdf') }}">Terms & Conditions</a></li>-->
                            <li><a href="https://askurdr.com/devaskurdr/storage/pdf/terms_condition/TermsandConditions.pdf" target="_blank">Terms & Conditions</a></li>
                            <li><a href="{{ asset('public/privacy_policy.pdf') }}">Privacy Policy</a></li>
                            <li><a href="{{ asset('public/refund_policy.pdf') }}">Refund Policy</a></li>
                         
                        </ul>
                    </div>
                    
                    <div class="col-sm-4 col-md-2 item">
                        <h3>We Accept</h3>
                        <ul>
                            <li> <img src="{{ asset('public/Visa-icon.png') }}" class="" alt="Visa" width="100px;" height="60px;"></li>
                             <li> <img src="{{ asset('public/MasterCard_1979_logo.svg.png') }}"  style='' class="" alt="Mastercard" width="100px;" height="50px;"></li>
                          
                         
                        </ul>
                    </div>
                    
                    
                    
                    <div class="col-lg-3 item social">
                        <a href="#"><i class="icon ion-social-facebook"></i></a>
                        <a href="#"><i class="icon ion-social-twitter"></i></a>
                        <a href="#"><i class="icon ion-social-snapchat"></i></a>
                        <a href="#"><i class="icon ion-social-instagram"></i></a>
                        <p class="copyright"></p>
                        <img class="col-lg-8 right" src="{{ asset('public/download.png') }}"  style='' class="" alt="ssl" width="100px;" height="50px;">
                    </div>
                </div>
                
                <div class="row justify-content-center">
                    
                    <div class="col-lg-12"><br/></div>
                    
                    
                    <div class="item social">
              
                        <p class="copyright">AskUrDr.com © 2020 - Corporate: ALTIB ALRAQMI Co. - CR No.: 1010572835</p>
                        
                       
                    </div>
                    
                    
                    </div>
            </div>
        </footer>
    </div>


    <script src="{!! asset('public/assets/js/jquery.min.js')!!}"></script>
    <script src="{!! asset('public/assets/bootstrap/js/bootstrap.min.js')!!}"></script>
    <script src="{!! asset('public/assets/js/Fixed-navbar-starting-with-transparency.js')!!}"></script>

   
<script type="text/javascript">
    
    $('a[href^="#"]').on('click', function(event) {
  var target = $(this.getAttribute('href'));
  if (target.length) {
    event.preventDefault();
    $('html, body').animate({
      scrollTop: target.offset().top
    }, 1000);
  }
});

</script>
 <!-- jQuery library (served from Google) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <!-- Slider Javascript file -->
        <script src="{!! asset('public/assets/js/jquery.jcslider.js')!!}"></script>

        <script>
            $(document).ready(function() {
                $('.jc-slider').jcSlider({
                
	autoplay: {
        delay: 50000,
        disableOnInteraction: false,
      },
	  animationIn: 'bounceInRight',
                    animationOut: 'bounceOutLeft',
                    stopOnHover: false,
					nextButton: '.swiper-button-next',
                    prevButton: '.swiper-button-prev',
				
					
					
                });

             
                $('.jc-slider4').jcSlider({
					
						autoplay: {
        delay: 50000,
        disableOnInteraction: false,
      },
                    animationIn: 'zoomIn',
                    animationOut: 'zoomOut',
                    stopOnHover: false
			
                });
            });
        </script>


<script>
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) {
    document.getElementById("myBtn").style.display = "block";
  } else {
    document.getElementById("myBtn").style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {

document.getElementById('clicktogothome').click();
}
</script>

</body>

</html>