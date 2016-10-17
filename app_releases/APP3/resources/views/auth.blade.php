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
</head>

<body>
	<header class="header"> <i class="lebox"></i>
  <div class="container">
      <div class="logo">
            <a href="{{url('/')}}">
              <img src="{{ asset('/admin-ui/css/slider/euro_2016.png')}}">
            </a>
      </div>
      <div id='cssmenu'>
          <ul>
              <li class='active'><a href='{{ url('/auth/login') }}'><span>تسجيل دخول</span></a></li>
              <li><a href='{{ url('/auth/register') }}'><span>التسجيل</span></a></li>
          </ul>
      </div>
  </div>
 </header>
 <div id="wowslider-container1">
      <div class="ws_images">
          <ul>
              <li>
                  <img src="{{ asset('/admin-ui/css/slider/slidebg1.jpg')}}" alt="" title="" id="wows1_0"/>
              </li>
              <li>
                  <img src="{{ asset('/admin-ui/css/slider/slidebg2.jpg')}}" alt="" title="" id="wows1_1"/>
              </li>
              <li>
                  <img src="{{ asset('/admin-ui/css/slider/slidebg3.jpg')}}" alt="" title="" id="wows1_2"/>
              </li>
          </ul>
      </div>
</div>
@yield('content')
@yield('scripts')
<script type="text/javascript">
	     $("#cssmenu ul li a").click(function(e)
       {
          $('#cssmenu ul li.active').removeClass('active');
       });
</script>
<script src="{{ asset('/admin-ui/css/auth/jquery.js') }}"></script>
<script src="{{ asset('/admin-ui/css/auth/bootstrap.min.js') }}"></script>
<script src="{{ asset('/admin-ui/css/auth/wowslider.js') }}"></script>
<script src="{{ asset('/admin-ui/css/auth/wow.min.js') }}"></script>
<script src="{{ asset('/admin-ui/css/auth/script.js') }}"></script>
</body>
</html>
