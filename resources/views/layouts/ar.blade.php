<!DOCTYPE html>
<html >

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Askurdr</title>
    <link rel="shortcut icon" href="{{ asset('public/logo.png') }}">
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css" integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js" integrity="sha384-a9xOd0rz8w0J8zqj1qJic7GPFfyMfoiuDjC9rqXlVOcGO/dmRqzMn34gZYDTel8k" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="{{ asset('public/assets/fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/fonts/ionicons.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="{{ asset('public/assets/css/Fixed-navbar-starting-with-transparency1.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/Fixed-navbar-starting-with-transparency.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/Contact-Form-Clean.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/Contact-FormModal-Contact-Form-with-Google-Map.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/Features-Blue.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/Footer-Clean.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/Header-Blue.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css">
    <link rel="stylesheet" href="{{ asset('public/assets/css/Navigation-Clean.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/Projects-Clean.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/Projects-Horizontal.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/Simple-Slider.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/styles.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/js/styles.css')}}">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans">

        <!-- CSS stylesheet for jcSlider -->
    <link rel="stylesheet" href="{{ asset('public/assets/css/jcslider.css')}}">
        <!-- animate CSS stylesheet library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.3.0/animate.min.css">


<style>

nav{
		  transform:scaleX(-1);
		
	}


</style>


<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  font-size: 20px;
}

#myBtn {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 1150px;
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
</style>




<button onclick="topFunction()" id="myBtn" title="Go to top" style='float:left;'><i class="fa fa-arrow-up" aria-hidden="true"></i> الصفحة الرئيسية</button>

</head>

<body dir="rtl">
    <div>
        <nav class="navbar navbar-light navbar-expand-md fixed-top navbar-transparency" style="background-color:rgba(86,118,180,0.43);height:80px;background-image:url(public/assets/img/navbar-bg.jpg); height: 80px !important; ">
            <div class="container" style="transform:scaleX(-1);"><a class="navbar-brand" href="#" style="width:222px;"><img src="{{ asset('public/assets/img/logoest.png')}}" width='40%' /><strong style="font-size:25px">&nbsp;أستشارة.com</strong></a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div
                    class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item" role="presentation"><a class="nav-link" id="clicktogothome"  href="#home"><i class="fa fa-home" style="width:14px;height:37px;font-size:19px;"></i><strong>&nbsp; الصفحة الرئيسية</strong></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link active" href="#About">&nbsp;<i class="fa fa-users"></i>&nbsp;من نحن</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link active" href="#download">&nbsp;<i class="fa fa-download"></i>&nbsp;تحميل</a></li>
                        
						<li class="nav-item" role="presentation"><a class="nav-link active" href="{{route('login')}}">&nbsp;<i class="fa fa-cog fa-spin"></i>&nbsp;تسجيل الدخول</a></li>
                        
						<li class="nav-item" role="presentation"><a class="nav-link active" href="#contactus"><i class="fa fa-envelope-o"></i>&nbsp;اتصل بنا</a></li>
                       <li class="nav-item" role="presentation"><a class="nav-link active" href="{{route('arhtmlenglish')}}">&nbsp;English&nbsp;<i class="fa fa-language"></i></a></li>
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


          
             

             <div class="col-md-6" style="float: left;" >
                <!-- Slider start -->
                <ul class="jc-slider">
                    <li class="jc-animation">
                        <div class="wrap">

                            <br/>
                            <br/>
                            <br/>
                            <br/>

                            <h2>مرحبا بكم في 
 <span style="color: red;">E clinic Estisharh أستشارة</span>. لقد أطلقنا تطبيقنا IOS وتطبيق أندرويد في متجر Play..</h2>
<br/>
<br/>

                            <img src="{{ asset('public/assets/img/iosapp.png')}}" width="40%"> &nbsp;
                            <a href="https://play.google.com/store/apps/details?id=com.eclinical"><img src="{{ asset('public/assets/img/googleapp.png')}}" width="47%"></a>
                        </div>
                    </li>
                    <li class="jc-animation">
                        <div class="wrap">
                           <h2>
                            <br>
                            <br>
                            <br>
                            <br>
                           <span style="color: red;">E clinic Estisharh أستشارة:</span>   التميز في الاستشارات الطبية في المملكة العربية السعودية ودول الخليج العربية.
 .</h2>
                        </div>
                    </li>
                    <li class="jc-animation">
                        <div class="wrap">
                            <h2>
                            <br>
                            <br>
                            <br>
                            <br><span style="color: red;">E clinic Estisharh أستشارة:</span>  دليلك للوصول إلى خدماتك الطبية – الطب الإتصالي- بأمانة ومصداقية.
</h2>
                        </div>
                    </li>
					
					
					  <li class="jc-animation">
                        <div class="wrap">
                            <h2>
                            <br>
                            <br>
                            <br>
                            <br><span style="color: red;">رضا المرضى:</span> نحن نهتم بعمق لمرضانا</h2>
                        </div>
                    </li>
					
					
                </ul>
                <!-- Slider end -->
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
                    <p style="font-size:27px;margin:44px;"><br>إستشارة دوت كوم  مستشارك الطبي بين يديك لحظة بلحظة.<br><br></p>
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
      <h5 class="card-title">مهمة</h5>
      <p class="card-text">إستشارة دوت كوم

  التميز في الاستشارات الطبية في المملكة العربية السعودية ودول الخليج العربية.
</p>
      <p class="card-text"><small class="text-muted"></small></p>
    </div>
  </div>
  <div class="card">
     <img src="{{ asset('public/assets/img/dr5.jpg')}}" class="card-img-top" alt="Image vision" width="300;" height="300px;">
    <div class="card-body">
      <h5 class="card-title">الرؤية</h5>
      <p class="card-text">استشارة الشركه الرائده  في الطب الاتصالي في دول الخليج العربي</p>
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
	
	
  <area shape="rect" coords="550,900,82,126" href="https://play.google.com/store/apps/details?id=com.eclinical" alt="Google play eclinic">
  <area shape="rect" coords="1200,500,0,0" href="https://www.apple.com/sa/ios/app-store/" alt="apple app store eclinic">
</map>
	
    <a href="#!">
      <div class="mask rgba-white-slight"></div>
    </a>
  </div>

  <!-- Card content -->
  <div class="card-body card-body-cascade text-center">

    <!-- Title -->
    <h4 class="card-title"><strong>ما هو استشاره</strong></h4>
    <!-- Subtitle -->
    <h6 class="font-weight-bold indigo-text py-2"></h6>
    <!-- Text -->
    <p class="card-text" style="font-size:20px;"> 
	
	إن متاهة التنقل بين الاستشاريين في المستشفيات والعيادات الخاصة والعامة ممن لديهم الخبرة التي تتناسب مع احتياجاتك الطبية قد تكون مكلفة وتستغرق وقتا وجهدا مع زحمة المدن ، لذا فإن مركز الطب الإتصالي  - عبر تطبيق <span style='color: blue;'> استشاره دوت كوم للاستشارات الطبية </span>- يوفر استشارات طبية عن بعد بواسطة أطباء استشاريون باحدى وسائل التواصل الحديثة – تطبيق استشارات فديو مباشرة او تلفونية أخرى لدراسة حالتك الصحية ، وبشكل دقيق <span style='color: blue;'>من قبل الاستشاريين المتخصصين في مجال الطب الحديث</span> ، ومن ثَمَّ فإنه يتم  توجيهك المناسب ، و العلاج المناسب وفقا لحالتك
	


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
        
        <form method="post">
            <h2 class="text-center">اتصل بنا</h2>
            <div class="form-group"><input class="form-control" type="text" name="name" placeholder="اسم"></div>
            <div class="form-group"><input class="form-control is-invalid" type="email" name="email" placeholder="البريد الإلكتروني"><small class="form-text text-danger">يرجى إدخال عنوان البريد الإلكتروني الصحيح.</small></div>
            <div class="form-group"><textarea class="form-control" rows="14" name="message" placeholder="رسالة"></textarea></div>
            <div class="form-group"><button class="btn btn-primary" type="submit">إرسال </button></div>
        </form>
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
                    <div class="col-sm-4 col-md-3 item">
                        <h3>خدمات</h3>
                        <ul>
                            <li><a href="#">تطبيق أندرويد</a></li>
                            <li><a href="#">تطبيق أبل IOS</a></li>
                            <li><a href="#">تطبيق الويب</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-md-3 item">
                        <h3>حول</h3>
                        <ul>
                            <li><a href="#">شركة</a></li>
                            <li><a href="#">الفريق</a></li>
                            <li><a href="#">ميراث</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-md-3 item">
                        <h3>وظائف</h3>
                        <ul>
                            <li><a href="#">فرص العمل</a></li>
                            <li><a href="#">نجاح الموظف</a></li>
                            <li><a href="#">فوائد</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a>
                        <p class="copyright">Estisahrh.com © 2019</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>


    <script src="{{ asset('public/assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('public/assets/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('public/assets/js/Fixed-navbar-starting-with-transparency.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
   
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
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <!-- Slider Javascript file -->
        <script src="{{ asset('public/assets/js/jquery.jcslider.js')}}"></script>

        <script>
            $(document).ready(function() {
                $('.jc-slider').jcSlider({
                    animationIn: 'bounceInRight',
                    animationOut: 'bounceOutLeft',
                    stopOnHover: false
                });

                $('.jc-slider2').jcSlider({
                    animationIn: 'zoomInUp',
                    animationOut: 'flipOutX',
                    stopOnHover: false
                });
                $('.jc-slider3').jcSlider({
                    animationIn: 'flipInX',
                    animationOut: 'shake',
                    stopOnHover: false
                });
                $('.jc-slider4').jcSlider({
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