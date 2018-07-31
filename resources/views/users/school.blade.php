<!--
	Author: W3layouts
	Author URL: http://w3layouts.com
	License: Creative Commons Attribution 3.0 Unported
	License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
<head>
<title>Narayana School</title>
<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Education Hub Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Meta tag Keywords -->
<!-- css files -->
<link href="{{ URL::asset('assets/schoolcss/css/style.css') }}" rel="stylesheet" type="text/css" media="all">
<link href="{{ URL::asset('assets/schoolcss/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" media="all">
<link href="{{ URL::asset('assets/schoolcss/css/font-awesome.min.css') }}" rel="stylesheet"  type="text/css" media="all">
<!-- //css files -->
<!-- online-fonts -->
<link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i&subset=latin-ext,vietnamese" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900iSource+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
<!-- js -->
<script type="text/javascript" src="{{ URL::asset('assets/schooljs/js/jquery-2.1.4.min.js')}}"></script>
<!-- //js -->
<script type="text/javascript" src="{{ URL::asset('assets/schooljs/js/bootstrap-3.1.1.min.js')}}"></script>

		<script src="{{ URL::asset('assets/schooljs/js/jquery.chocolat.js')}}"></script>
		<link rel="stylesheet" href="{{ URL::asset('assets/schoolcss/css/chocolat.css') }}" type="text/css" media="screen">
		<!--light-box-files -->
		<script>
		$(function() {
			$('.gallery-grid a').Chocolat();
		});
		</script>

<!-- //js -->
<script src="{{ URL::asset('assets/schooljs/js/responsiveslides.min.js')}}"></script>
		<script>
				$(function () {
					$("#slider").responsiveSlides({
						auto: true,
						pager:false,
						nav: true,
						speed: 1000,
						namespace: "callbacks",
						before: function () {
							$('.events').append("<li>before event fired.</li>");
						},
						after: function () {
							$('.events').append("<li>after event fired.</li>");
						}
					});
				});
			</script>
			

<!-- start-smoth-scrolling -->
<script type="text/javascript" src="{{ URL::asset('assets/schooljs/js/move-top.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/schooljs/js/easing.js')}}"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->



</head>
<body>
<div class="header" id="home">
	<div class="logo">
		<a href="#"><h1>Narayana</h1></a>
	</div>
<!-- navigation -->
		<div class="ban-top-con">
			<div class="top_nav_left">
				<nav class="navbar navbar-default">
				  <div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
					  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </button>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse menu--shylock" id="bs-example-navbar-collapse-1">
					  <ul class="nav navbar-nav menu__list">
						<li class="active menu__item menu__item--current"><a class="menu__link" href="http://narayanaschool.vidhyapp.com/">Home <span class="sr-only">(current)</span></a></li>
						<li class=" menu__item"><a class="menu__link scroll" href="#about">About us</a></li>
						<li class=" menu__item"><a class="menu__link scroll" href="#management">Management</a></li>
						<li class=" menu__item"><a class="menu__link scroll" href="#activities">Activities</a></li>
						<li class=" menu__item"><a class="menu__link scroll" href="#faculties">Faculties</a></li>
						<li class=" menu__item"><a class="menu__link scroll" href="#contact">contact</a></li>
                                                <li class=" menu__item"><a class="" href="{{ url('login') }}">Login</a></li>
					  </ul>
					</div>
				  </div>
				</nav>	
				
			</div>
			<div class="clearfix"></div>
			</div>
	<!-- //navigation -->
<!-- Slider -->
		<div class="slider">
			<div class="callbacks_container">
				<ul class="rslides" id="slider">
					<li>
						<div class="slider-img">
							<img src="{{ URL::asset('assets/schoolimages/images/bg2.jpg')}}" class="img-responsive" alt="education">
						</div>
						<div class="slider-info">
							<h3>Education</h3>
							<p>Education is the most powerful weapon which you can use to change the world.</p>
						</div>
					</li>
					<li>
						<div class="slider-img">
							<img src="{{ URL::asset('assets/schoolimages/images/bg3.jpg')}}" class="img-responsive" alt="education">
						</div>
						<div class="slider-info">
							<h3>Education</h3>
							<p>The purpose of education is to replace   an empty mind with an open one.</p>
						</div>
					</li>
					<li>
						<div class="slider-img">
							<img src="{{ URL::asset('assets/schoolimages/images/bg1.jpg')}}" class="img-responsive" alt="education">
						</div>
						<div class="slider-info">
							<h3>Education</h3>
							<p>Education is the most powerful weapon which you can use to change the world.</p>
						</div>
					</li>
					<li>
						<div class="slider-img">
							<img src="{{ URL::asset('assets/schoolimages/images/bg4.jpg')}}" class="img-responsive" alt="education">
						</div>
						<div class="slider-info">
							<h3>Education</h3>
							<p>The purpose of education is to replace   an empty mind with an open one.</p>
						</div>
					</li>
					<li>
						<div class="slider-img">
							<img src="{{ URL::asset('assets/schoolimages/images/bg5.jpg')}}" class="img-responsive" alt="education">
						</div>
						<div class="slider-info">
							<h3>Education</h3>
							<p>The goal of education is the advancement of knowledge and the dissemination of truth.</p>
						</div>
					</li
				</ul>
			</div>
			<div class="clearfix"></div>
		</div>
		<!-- //Slider -->
</div>
<!--main-content-->
<div class="agile-main" id="about">
	<div class="container">
	<!--about-->
		<div class="about">
			<h2>about us</h2>
			<h4>A school is an institution designed to provide learning spaces and learning environments for the teaching of students under the direction of teachers. Generally include primary school for young children and secondary school for teenagers who have completed primary education.</h4>
			<img src="{{ URL::asset('assets/schoolimages/images/su.jpg')}}" alt="sucess">
			<p>"Education is the process of facilitating learning, or the acquisition of knowledge, skills, values, beliefs, and habits. Educational methods include storytelling, discussion, teaching, training, and directed research.Education".</p>		
			<p>"Education can take place in formal or informal settings and any experience that has a formative effect on the way one thinks, feels, or acts may be considered educational. The methodology of teaching is called pedagogy.Education". </p>
		</div>
		<div class="clearfix"></div>
	<!--//about-->
	</div>
</div>
<!--meet our management-->
<div class="team" id="management">
	<div class="container">
		<h3>meet our management</h3>
		<p>Group of young and dynamic members,with lot of expirence,in education.</p>
		<div class="w3grids">
			<div class="w3grid col-md-3">
				<img src="{{ URL::asset('assets/schoolimages/images/t5.jpg')}}" alt="team1" class="img1-w3l">
				<h5>Baharath Reddy</h5>
				<p>Mathmatics Teacher having five years experience.</p>
<!--				<div class="socialw3-icons">
					<i class=" so1 fa fa-facebook" aria-hidden="true"></i>
					<i class=" so2 fa fa-twitter" aria-hidden="true"></i>
					<i class=" so3 fa fa-google" aria-hidden="true"></i>
				</div>-->
			</div>
			<div class="w3grid col-md-3">
				<img src="{{ URL::asset('assets/schoolimages/images/t2.jpg')}}" alt="team1" class="img2-w3l">
				<h5>Jade Doe</h5>
				<p>Etiam id sollicitudin ligula. Curabitur eget eros ulmcorper.</p>
<!--				<div class="socialw3-icons">
					<i class=" so1 fa fa-facebook" aria-hidden="true"></i>
					<i class=" so2 fa fa-twitter" aria-hidden="true"></i>
					<i class=" so3 fa fa-google" aria-hidden="true"></i>
				</div>-->
			</div>
			<div class="w3grid col-md-3">
				<img src="{{ URL::asset('assets/schoolimages/images/t3.jpg')}}" alt="team1" class="img3-w3l">
				<h5>James Doe</h5>
				<p>Commodo id dolor eu, fringilla mauris. Etiam id ligula.</p>
<!--				<div class="socialw3-icons">
					<i class=" so1 fa fa-facebook" aria-hidden="true"></i>
					<i class=" so2 fa fa-twitter" aria-hidden="true"></i>
					<i class=" so3 fa fa-google" aria-hidden="true"></i>
				</div>-->
			</div>
			<div class="w3grid col-md-3">
				<img src="{{ URL::asset('assets/schoolimages/images/t4.jpg')}}" alt="team1" class="img4-w3l">
				<h5>Hailey joy</h5>
				<p>Donec sollicitudin lacus in felis luctus blandit id mattis tismk.</p>
<!--				<div class="socialw3-icons">
					<i class=" so1 fa fa-facebook" aria-hidden="true"></i>
					<i class=" so2 fa fa-twitter" aria-hidden="true"></i>
					<i class=" so3 fa fa-google" aria-hidden="true"></i>
				</div>-->
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!--//meet our management-->

<!--welcome-->
<div class="w3l-welcome">
	<div class="container">
		<div class=" agile-welcome">
			<div class="text-w3">
				<h4>welcome to our School</h4>
				<p>Learn the joy of education</p>
			</div>
			<div class="grids">
				<div class="grid">
					<div class="icons">
						<i class="fa fa-book" aria-hidden="true"></i>
					</div>
					<div class="text">
						<h5>SKILLED Teachers</h5>
						<p>The teachers in this school are the best in industry.</p>
					</div>
				</div>
				<div class="grid">
					<div class="icons">
						<i class="fa fa-thumbs-up" aria-hidden="true"></i>
					</div>
					<div class="text">
						<h5>Career Growth</h5>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
					</div>
				</div>
				<div class="grid">
					<div class="icons">
						<i class="fa fa-table" aria-hidden="true"></i>
					</div>
					<div class="text">
						<h5>BIG LIBRARY</h5>
						<p>School is having huge library with more than 1000 volumes  .</p>
					</div>
				</div>
				
				<div class="grid">
					<div class="icons">
						<i class="fa fa-laptop" aria-hidden="true"></i>
					</div>
					<div class="text">
						<h5>WELL EQUIPPED LABS</h5>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
					</div>
				</div>
			</div>
			<div class="w3-img">
				<img src="{{ URL::asset('assets/schoolimages/images/man2.jpg')}}" alt="image" />
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<!--//welcome-->

<!--activities-->
<div class="gallery" id="activities">
	<div class="container">
	  <div class="gallery-main">
	  	<div class="gallery-top">
	  		<h3>our activities</h3>
	  	</div>
		<div class="gallery-bott">
			<div class="col-md-4 col1 gallery-grid">
				<a href="{{ URL::asset('assets/schoolimages/images/g1.jpg')}}" class="b-link-stripe b-animate-go  thickbox">

						<figure class="effect-bubba">
							<img class="img-responsive" src="{{ URL::asset('assets/schoolimages/images/g1.jpg')}}" alt="">
							<figcaption>
								<h4 class="gal">Education Hub</h4>
								<p class="gal1">“Live as if you were to die tomorrow. Learn as if you were to live forever.” </p>	
							</figcaption>			
						</figure>
					</a>
					</div>
					<div class="col-md-4 col1 gallery-grid">
						<a href="{{ URL::asset('assets/schoolimages/images/g2.jpg')}}" class="b-link-stripe b-animate-go  thickbox">
						<figure class="effect-bubba">
							<img class="img-responsive" src="{{ URL::asset('assets/schoolimages/images/g2.jpg')}}" alt="">
							<figcaption>
								<h4 class="gal">Education Hub</h4>
								<p class="gal1">“Live as if you were to die tomorrow. Learn as if you were to live forever.” </p>	
							</figcaption>			
						</figure>
						</a>
					</div>
					<div class="col-md-4 col1 gallery-grid">
						<a href="{{ URL::asset('assets/schoolimages/images/g3.jpg')}}" class="b-link-stripe b-animate-go  thickbox">
						<figure class="effect-bubba">
							<img class="img-responsive" src="{{ URL::asset('assets/schoolimages/images/g3.jpg')}}" alt="">
							<figcaption>
								<h4 class="gal">Education Hub</h4>
								<p class="gal1">“Live as if you were to die tomorrow. Learn as if you were to live forever.” </p>	
							</figcaption>			
						</figure>
						</a>
					</div>
			     <div class="col-md-4 col1 gallery-grid">
				  <a href="{{ URL::asset('assets/schoolimages/images/g4.jpg')}}" class="b-link-stripe b-animate-go  thickbox">
						<figure class="effect-bubba">
							<img class="img-responsive" src="{{ URL::asset('assets/schoolimages/images/g4.jpg')}}" alt="">
							<figcaption>
								<h4 class="gal">Education Hub</h4>
								<p class="gal1">“Live as if you were to die tomorrow. Learn as if you were to live forever.” </p>	
							</figcaption>			
						</figure>
					</a>
					</div>
					<div class="col-md-4 col1 gallery-grid">
						<a href="{{ URL::asset('assets/schoolimages/images/g5.jpg')}}" class="b-link-stripe b-animate-go  thickbox">
						<figure class="effect-bubba">
							<img class="img-responsive" src="{{ URL::asset('assets/schoolimages/images/g5.jpg')}}" alt="">
							<figcaption>
								<h4 class="gal">Education Hub</h4>
								<p class="gal1">“Live as if you were to die tomorrow. Learn as if you were to live forever.” </p>	
							</figcaption>			
						</figure>
						</a>
					</div>
					<div class="col-md-4 col1 gallery-grid">
						<a href="{{ URL::asset('assets/schoolimages/images/g6.jpg')}}" class="b-link-stripe b-animate-go  thickbox">
						<figure class="effect-bubba">
							<img class="img-responsive" src="{{ URL::asset('assets/schoolimages/images/g6.jpg')}}" alt="">
							<figcaption>
								<h4 class="gal">Education Hub</h4>
								<p class="gal1">“Live as if you were to die tomorrow. Learn as if you were to live forever.” </p>	
							</figcaption>			
						</figure>
						</a>
					</div>
					<div class="col-md-4 col1 gallery-grid">
						<a href="{{ URL::asset('assets/schoolimages/images/g7.jpg')}}" class="b-link-stripe b-animate-go  thickbox">
						<figure class="effect-bubba">
							<img class="img-responsive" src="{{ URL::asset('assets/schoolimages/images/g7.jpg')}}" alt="">
							<figcaption>
								<h4 class="gal">Education Hub</h4>
								<p class="gal1">“Live as if you were to die tomorrow. Learn as if you were to live forever.” </p>	
							</figcaption>			
						</figure>
						</a>
					</div>
					<div class="col-md-4 col1 gallery-grid">
						<a href="{{ URL::asset('assets/schoolimages/images/g8.jpg')}}" class="b-link-stripe b-animate-go  thickbox">
						<figure class="effect-bubba">
							<img class="img-responsive" src="{{ URL::asset('assets/schoolimages/images/g8.jpg')}}" alt="">
							<figcaption>
								<h4 class="gal">Education Hub</h4>
								<p class="gal1">“Live as if you were to die tomorrow. Learn as if you were to live forever.” </p>	
							</figcaption>			
						</figure>
						</a>
					</div>
					<div class="col-md-4 col1 gallery-grid">
						<a href="{{ URL::asset('assets/schoolimages/images/g9.jpg')}}" class="b-link-stripe b-animate-go  thickbox">
						<figure class="effect-bubba">
							<img class="img-responsive" src="{{ URL::asset('assets/schoolimages/images/g9.jpg')}}" alt="">
							<figcaption>
								<h4 class="gal">Education Hub</h4>
								<p class="gal1">“Live as if you were to die tomorrow. Learn as if you were to live forever.” </p>	
							</figcaption>			
						</figure>
						</a>
					</div>
			     <div class="clearfix"> </div>
			</div>
		</div>
	</div>
</div>
<!--//activities-->

<!-- opening -->
<div class="agile-open">
	<div class="open-head">
		<h6>our School opening in</h6>
		<p>“A School is just a group of classes gathered around a library.” </p>
	</div>
<!-- Countdown-timer -->

				<div class="examples">
					<div class="simply-countdown-losange" id="simply-countdown-losange"></div>
				</div>
		
			<div class="clearfix"></div>
	
<!-- //Countdown-timer -->

	<!-- Custom-JavaScript-File-Links -->
	<!-- Countdown-Timer-JavaScript -->
			<script src="{{ URL::asset('assets/schooljs/js/simplyCountdown.js')}}"></script>
			<script>
				var d = new Date(new Date().getTime() + 48 * 120 * 120 * 2000);

				// default example
				simplyCountdown('.simply-countdown-one', {
					year: d.getFullYear(),
					month: d.getMonth() + 1,
					day: d.getDate()
				});

				// inline example
				simplyCountdown('.simply-countdown-inline', {
					year: d.getFullYear(),
					month: d.getMonth() + 1,
					day: d.getDate(),
					inline: true
				});

				//jQuery example
				$('#simply-countdown-losange').simplyCountdown({
					year: d.getFullYear(),
					month: d.getMonth() + 1,
					day: d.getDate(),
					enableUtc: false
				});
			</script>
			
		<!-- //Countdown-Timer-JavaScript -->
	<!-- //Custom-JavaScript-File-Links -->
</div>	
<!--// opening -->

<!--faculty-->
<div class="w3-faculty" id="faculties">
	<div class="container">
		<div class="faculty-head">
			<h5>our great faculties</h5>
			<p>“Books are the quietest and most constant of friends; they are the most accessible and wisest of counselors, and the most patient of teachers.” </p>
		</div>
		<div class="main-faculty">
			<div class="f1 col-md-3 faculty1">
				<ul class="demo-2 effect">
					<li>
					   <h3 class="zero">COMPUTER SCIENCE</h3>
					   <p class="zero">Lorem ipsum dolor sit amet.</p>
					</li>
					 <li><img class="top" src="{{ URL::asset('assets/schoolimages/images/f1.jpg')}}" alt=""/></li>
				</ul>
				<h4>John Roy</h4>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
<!--				<div class="social-icons">
					<i class="s1 fa fa-facebook" aria-hidden="true"></i>
					<i class="s2 fa fa-twitter" aria-hidden="true"></i>
					<i class="s3 fa fa-google" aria-hidden="true"></i>
				</div>-->
			</div>
			<div class="f2 col-md-3 faculty1">
				<ul class="demo-2 effect">
					<li>
					   <h3 class="zero">COMMUNICATION SKILLS</h3>
					   <p class="zero">Lorem ipsum dolor sit amet.</p>
					</li>
					 <li><img class="top" src="{{ URL::asset('assets/schoolimages/images/f6.jpg')}}" alt=""/></li>
				</ul>
				<h4>Jesse Roy</h4>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
<!--				<div class="social-icons">
					<i class=" s1 fa fa-facebook" aria-hidden="true"></i>
					<i class=" s2 fa fa-twitter" aria-hidden="true"></i>
					<i class=" s3 fa fa-google" aria-hidden="true"></i>
				</div>-->
			</div>
			<div class="f3 col-md-3 faculty1">
				<ul class="demo-2 effect">
					<li>
					   <h3 class="zero">GENERAL SCIENCE</h3>
					   <p class="zero">Lorem ipsum dolor sit amet.</p>
					</li>
					 <li><img class="top" src="{{ URL::asset('assets/schoolimages/images/f3.jpg')}}" alt=""/></li>
				</ul>
				<h4>Xena Wob</h4>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
<!--				<div class="social-icons">
					<i class=" s1 fa fa-facebook" aria-hidden="true"></i>
					<i class=" s2 fa fa-twitter" aria-hidden="true"></i>
					<i class=" s3 fa fa-google" aria-hidden="true"></i>
				</div>-->
			</div>
			<div class="f4 col-md-3 faculty1">
				<ul class="demo-2 effect">
					<li>
					   <h3 class="zero">MATHEMATICS</h3>
					   <p class="zero">Lorem ipsum dolor sit amet.</p>
					</li>
					 <li><img class="top" src="{{ URL::asset('assets/schoolimages/images/f4.jpg')}}" alt=""/></li>
				</ul>
				<h4>Victor Hi</h4>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
<!--				<div class="social-icons">
					<i class="s1 fa fa-facebook" aria-hidden="true"></i>
					<i class="s2 fa fa-twitter" aria-hidden="true"></i>
					<i class="s3 fa fa-google" aria-hidden="true"></i>
				</div>-->
			</div>
			
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<!--//faculty-->

<!--contact-->
<div class="agile-contact" id="contact">
	<div class="left-contact">

			<h6>contact us</h6>
			<ul>
				<li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:narayanaschool@gmail.com">narayana@school.com</a></li>
				<li><i class="fa fa-phone" aria-hidden="true"></i>+2158 85467</li>
				<li><i class="fa fa-map-marker" aria-hidden="true"></i>BD 2 Mars, N° 136, Morocco Casablanca</li>
			</ul>
	
	</div>
	<div class="right-contact">
		<div class="map">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5662244.714693903!2d-2.279153484594319!3d46.13545249359953!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd54a02933785731%3A0x6bfd3f96c747d9f7!2sFrance!5e0!3m2!1sen!2sin!4v1471606088687" frameborder="0" style="border:0" allowfullscreen></iframe>
			<form action="#" method="post">
				<input placeholder="Name" name="Name" class="name" type="text" required=""><br>
				<input placeholder="E-mail" name="Name" class="name" type="text" required=""><br>
				<textarea placeholder="Message"></textarea><br>
				<input type="submit" value="send message">
			</form>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
<!--//contact-->
<!--//main-content-->

<!--footer-->
<div class="w3l-footer">
	<div class="container">
		<div class="left-w3">
			<a href="#">Narayana School</a>
		</div>
<!--		<div class="right-social">
			<i class="fa fa-facebook-square" aria-hidden="true"></i>
			<i class="fa fa-twitter-square" aria-hidden="true"></i>
			<i class="fa fa-google-plus-square" aria-hidden="true"></i>
		</div>-->
		<div class="clearfix"></div>
		<div class="footer-nav">
			<ul>
				<li><a class="menu__link" href="http://narayanaschool.vidhyapp.com/">home</a></li>
				<li><a class="menu__link scroll" href="#about">about</a></li>
				<li><a class="menu__link scroll" href="#management">management</a></li>
				<li><a class="menu__link scroll" href="#activities">activities</a></li>
				<li><a class="menu__link scroll" href="#faculties">faculties</a></li>
				<li><a class="menu__link scroll" href="#contact">contact</a></li>
			</ul>
		</div>
		<div class="copyright-agile">
			<p>&copy; 2017 VidhyApp. All rights reserved | Design by <a href="http://omnavitechsol.com">Omnavi Tech Sol Pvt. Ltd.</a></p>
		</div>
	</div>
</div>
<!--//footer-->
<!-- smooth scrolling -->
	<script type="text/javascript">
		$(document).ready(function() {
		/*
			var defaults = {
			containerID: 'toTop', // fading element id
			containerHoverID: 'toTopHover', // fading element hover id
			scrollSpeed: 1200,
			easingType: 'linear' 
			};
		*/								
		$().UItoTop({ easingType: 'easeOutQuart' });
		});
	</script>
	<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
<!-- //smooth scrolling -->
</body>
</html>