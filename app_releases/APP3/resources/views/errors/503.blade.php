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
<link rel='stylesheet' href="{{ asset('/admin-ui/css/auth/style.css') }}">
<link rel='stylesheet' href="{{ asset('/admin-ui/css/auth/bootstrap.min.css') }}">
<link rel='stylesheet' href="{{ asset('/admin-ui/css/auth/bootstrap-rtl.css') }}">
<link rel='stylesheet' href="{{ asset('/admin-ui/css/auth/settings.css') }}">
<link rel='stylesheet' href="{{ asset('/admin-ui/css/auth/font-awesome.min.css') }}">
  <link rel='stylesheet' href="{{ asset('/bower_components/fontawesome/css/font-awesome.min.css') }}">

@yield('styles')
</style>
</head>

<body>
	<header class="header"> <i class="lebox"></i>
  <div class="container">
    <div class="logo"><a href="{{url('/')}}"><img src="{{ asset('/admin-ui/css/slider/euro_2016.png')}}"></a></div>

    <!--//.cssmenu--> 
  </div>
  <!--//.container--> 
 </header>
<!--//.header-->

<div id="wowslider-container1">
  <div class="ws_images">
    <ul>
      <li><img src="{{ asset('/admin-ui/css/slider/slidebg1.jpg')}}" alt="" title="" id="wows1_0"/></li>
      <li><img src="{{ asset('/admin-ui/css/slider/slidebg2.jpg')}}" alt="" title="" id="wows1_1"/></li>
      <li><img src="{{ asset('/admin-ui/css/slider/slidebg3.jpg')}}" alt="" title="" id="wows1_2"/></li>
    </ul>
  </div>
</div>


<div class="ie-clear"></div>
<div class="container center">
<div style="text-align: center; position: absolute; left: 31%; margin-top: 10%; background: rgba(0, 0, 0, 0.75) none repeat scroll 0% 0%; border-radius: 5px; width: 439px; padding: 30px;">
<h2 class="form-title form-title-first" style="text-transform: none; color:#fff;"> هذا الصفحه غير متاحه    <i class="fa fa-lock"></i></h3>
<script>
  document.write('<a style="font-size: 22px;" href="javascript:history.back()">الذهاب الى الصفحه السابقه. </a>');
</script>
<i class="fa fa-arrow-circle-left" style="font-size:22px;color: #fff;">
</i>
</div>
</div>

<script src="{{ asset('/admin-ui/css/auth/jquery.js') }}"></script>
<script src="{{ asset('/admin-ui/css/auth/bootstrap.min.js') }}"></script>
<script src="{{ asset('/admin-ui/css/auth/wowslider.js') }}"></script>
<script src="{{ asset('/admin-ui/css/auth/wow.min.js') }}"></script>
<script src="{{ asset('/admin-ui/css/auth/script.js') }}"></script>
</body>
</html>

