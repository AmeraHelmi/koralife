<!DOCTYPE html>
<html class="no-js" lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Koralife</title>
    <meta name="description" content="Pro Soccer - Football Club Template. It is built using bootstrap 3.3.2 framework, works totally responsive, easy to customise, well commented codes and seo friendly.">
    <meta name="keywords" content="prosoccer, football, club, soccer, bootstrap">
    <meta name="author" content="rudhisasmito.com">


	<link rel="shortcut icon" href="{{ asset('/admin-ui/main_images/favicon.ico')}}">
	<link rel="apple-touch-icon" href="{{ asset('/admin-ui/main_images/apple-touch-icon.png') }}">
	<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('/admin-ui/main_images/apple-touch-icon-72x72.png')}}">
	<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/admin-ui/main_images/apple-touch-icon-114x114.png')}}">

	<link rel="stylesheet" href="{{ asset('/admin-ui/main_css/bootstrap.css') }}" />
  <link rel="stylesheet" href="{{ asset('/admin-ui/css/main.css') }}" />
  <link rel="stylesheet" href="{{ asset('/admin-ui/css/demo.css') }}" />
	<link rel="stylesheet" href="{{ asset('/admin-ui/css/mashable-menu.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('/admin-ui/css/preset17035.css') }}" />
	<link rel="stylesheet"  href="{{ asset('/admin-ui/main_css/font-awesome.min.css') }}">
	<link rel="stylesheet"  href="{{ asset('/admin-ui/main_css/owl.carousel.css') }}">
	<link rel="stylesheet"  href="{{ asset('/admin-ui/main_css/owl.theme.css') }}">
	<link rel="stylesheet"  href="{{ asset('/admin-ui/main_css/magnific-popup.css') }}">
	<link rel='stylesheet' href="{{ asset('/admin-ui/css/bootstrap.min.css') }}">
	<link rel='stylesheet' href="{{ asset('/bower_components/fontawesome/css/font-awesome.min.css') }}">



	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>


	<link rel="stylesheet" type="text/css" href="{{ asset('/admin-ui/main_css/style.css') }}" />



    <script type="text/javascript" src="{{ asset('/admin-ui/main_js/modernizr.min.js') }}"></script>


@yield('styles')
<style>
.drop-down li a:hover{
    color: #fff;
  background-color: #039fe5;

}
</style>
</head>

<body>



	<!-- NAVBAR SECTION -->
	<div class="navbar navbar-main navbar-fixed-top"  style="background-color:rgba(44, 125, 162, 0.68);">
		<div class="container" style="width: 100% !important;">
      <nav class="mash-menu" data-color="">
          <section class="mash-menu-inner-container"style="padding:0px;background: rgba(44, 125, 162, 0.68) none repeat scroll 0% 0%;">
              <!-- list items -->
              <ul class="mash-list-items" style="float:right;">
                  <!-- active -->
                  <li  style="float:right;"><a href="{{ url('/koralife') }}">الصفحه الرئيسيه </a></li>
              </ul>
          </section>
      </nav>
		</div>
    </div>
		<div class="content-wrapper" style="position: absolute; top: 31%; left: 27%; font-size: 31px; background-color: rgb(65, 137, 170); height: 186px; color: white; padding: 56px;">
			<div class="container-fluid">
<h2 class="form-title form-title-first" style="text-transform: none;"><i class="fa fa-lock"></i> تم تسجيل التعديلات بنجــــــــــــــــــاح .</h3>


</div>
</div>




	<script type="text/javascript" src="{{ asset('/admin-ui/main_js/jquery.min.js') }}"></script>
	<script type='text/javascript' src='https://maps.google.com/maps/api/js?sensor=false&amp;ver=4.1.5'></script>
	<script type="text/javascript" src="{{ asset('/admin-ui/main_js/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/admin-ui/main_js/owl.carousel.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/admin-ui/main_js/bootstrap-hover-dropdown.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/admin-ui/main_js/jquery.magnific-popup.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/admin-ui/main_js/script.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/admin-ui/main_js/jqBootstrapValidation.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/admin-ui/js/jquery.1.7.2.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/admin-ui/js/jquery.syotimer.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/admin-ui/js/demo.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/admin-ui/js/matchMedia.addListener.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/admin-ui/js/material.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/admin-ui/js/mashable-menu.min.js') }}"></script>

	@yield('scripts')


</body>

<!-- Mirrored from rudhisasmito.com/demo/prosoccer/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 May 2016 10:56:54 GMT -->
</html>
