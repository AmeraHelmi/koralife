<!DOCTYPE html>
<html class="no-js" lang="en">
	<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title>Koralife</title>
			<meta name="description" content="Pro Soccer - Football Club Template. It is built using bootstrap 3.3.2 framework, works totally responsive, easy to customise, well commented codes and seo friendly.">
			<meta name="keywords" content="prosoccer, football, club, soccer, bootstrap">
			<meta name="author" content="rudhisasmito.com">
			<link rel="shortcut icon" href="{{ asset('/admin-ui/front/main_images/favicon.ico')}}">
			<link rel="apple-touch-icon" href="{{ asset('/admin-ui/front/main_images/apple-touch-icon.png') }}">
			<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('/admin-ui/front/main_images/apple-touch-icon-72x72.png')}}">
			<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/admin-ui/front/main_images/apple-touch-icon-114x114.png')}}">
			<link rel="stylesheet" href="{{ asset('/admin-ui/front/main_css/main.css') }}" />
			<link rel="stylesheet" href="{{ asset('/admin-ui/front/main_css/demo.css') }}" />
			<link rel="stylesheet" href="{{ asset('/admin-ui/front/main_css/custom.css') }}" />
			<link rel="stylesheet" href="{{ asset('/admin-ui/front/main_css/force-custom.css') }}" />
			<link rel="stylesheet" href="{{ asset('/admin-ui/front/main_css/mashable-menu.min.css') }}" />
			<link rel="stylesheet" href="{{ asset('/admin-ui/front/main_css/preset17035.css') }}" />
			<link rel="stylesheet" href="{{ asset('/admin-ui/front/main_css/bootstrap.css') }}" />
			<link rel="stylesheet" href="{{ asset('/admin-ui/front/main_css/font-awesome.min.css') }}">
			<link rel="stylesheet" href="{{ asset('/admin-ui/front/main_css/owl.carousel.css') }}">
			<link rel="stylesheet" href="{{ asset('/admin-ui/front/main_css/owl.theme.css') }}">
			<link rel="stylesheet" href="{{ asset('/admin-ui/front/main_css/magnific-popup.css') }}">
			<link rel="stylesheet" href="{{ asset('/admin-ui/front/main_css/style.css') }}" />
			<link rel='stylesheet' href="{{ asset('/admin-ui/css/bootstrap.min.css') }}">
			<link rel='stylesheet' href="{{ asset('/bower_components/fontawesome/css/font-awesome.min.css') }}">
			<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
			@yield('styles')
			<style>
					.drop-down li a:hover
					{
									background-color: #039fe5;
									padding: 10px;
					}
					.group li a:hover
					{
									background-color: #039fe5;
									padding: 10px;
					}
				</style>
		</head>
		<body>
				<div class="row">
						<div class="col-sm-12 text-center ad-con">
									<img class="img-responsive" src="/admin-ui/images/728-90-ad.gif"/>
						</div>
      	</div>
				<div class="body-container">
						<div id="RightFloatAds" >
								<img src="admin-ui/images/ad.gif"/>
						</div>
						<div id="LeftFloatAds" >
								<img src="admin-ui/images/ad.gif"/>
						</div>
						<div class="container main-container">
								<div class="row">
										<div class="navbar navbar-main" >
  												<nav class="mash-menu" data-color="">
    														<section class="mash-menu-inner-container">
																				<ul class="mash-brand">
        																		<li>
																								<a href="#"><span>Koralife</span> </a>
          																			<button class="mash-mobile-button"> <span></span> </button>
																						</li>
      																	</ul>
																				<ul class="mash-list-items" style="float:right;">
																						<li class="active" style="float:right;"><a style="font-size: 14px;font-weight: bold;" href="{{ url('/') }}"> الصفحه الرئيسيه</a></li>
																						<li style="float:right;"><a style="font-size: 14px;font-weight: bold;" href="{{ url('/about_champion') }}">بطولة الأتحاد الأوربي<i class="fa fa-caret-down fa-indicator"></i> </a>
																								<ul class="drop-down" style="display: none; opacity: 1; background: rgba(44, 125, 162, 0.68) none repeat scroll 0% 0%;display: none;display: none;">
		            																		<li><a style="font-weight: bold;text-align: right;" href="{{ url('/coaches_champion') }}">المدربين</a></li>
																										<li><a style="font-weight: bold;text-align: right;" href="{{ url('/referees_champion') }}">الحكام</a></li>
																										<li><a style="font-weight: bold;text-align: right;" href="{{ url('/stadium_champion') }}">الأستادات</a></li>
																										<li><a style="font-weight: bold;text-align: right;" href="{{ url('/anlyzing') }}">التحليل الفنى</a></li>
																								</ul>
        																		</li>
        																		<li style="float:right;">
																								<a style="font-size: 14px;font-weight: bold;" href="#"> المنتخبات <i class="fa fa-caret-down fa-indicator"></i>
          																					<div class="ripple-wrapper"></div>
          																			</a>
          																			<div class="drop-down-medium" >
            																				<div class="container-fluid">
              																					<div class="row">
                																						<div class="col-sm-4"  style="float: right;">
                  																							<ul class="list-items space-0 group">
                    																								<h4 style="text-align:right; font-weight:bold;color: rgb(212, 212, 5);">المجموعة الاولى</h4>
                    																										<li><a style=" text-align:right;font-weight: bold;border-top: 1px solid rgba(242, 239, 9, 0.1);" href="{{ url('/Tplayers',26) }}"> البانيا</a></li>
                    																										<li><a style=" text-align:right;font-weight: bold;border-top: 1px solid rgba(242, 239, 9, 0.1);" href="{{ url('/Tplayers',4) }}"> فرنسا</a></li>
                    																										<li><a style=" text-align:right;font-weight: bold;border-top: 1px solid rgba(242, 239, 9, 0.1);" href="{{ url('/Tplayers',13) }}"> رومانيا</a></li>
																																				<li><a style=" text-align:right;font-weight: bold;border-top: 1px solid rgba(242, 239, 9, 0.1);" href="{{ url('/Tplayers',11) }}"> سويسرا</a></li>
																																</ul>
                																						</div>
																														<div class="col-sm-4"  style="float: right;">
																																<ul class="list-items space-0 group">
																																		<h4 style="text-align:right; font-weight:bold;color: rgb(212, 212, 5);">المجموعة الثانية</h4>
																																				<li><a style="  text-align:right;font-weight: bold;border-top: 1px solid rgba(242, 239, 9, 0.1);" href="{{ url('/Tplayers',15) }}"> انجلترا</a></li>
																																				<li><a style="  text-align:right;font-weight: bold;border-top: 1px solid rgba(242, 239, 9, 0.1);" href="{{ url('/Tplayers',17) }}"> روسيا</a></li>
																																				<li><a style="  text-align:right;font-weight: bold;border-top: 1px solid rgba(242, 239, 9, 0.1);" href="{{ url('/Tplayers',23) }}"> سولفكيا</a></li>
																																				<li><a style="  text-align:right;font-weight: bold;border-top: 1px solid rgba(242, 239, 9, 0.1);" href="{{ url('/Tplayers',20) }}"> ويلز</a></li>
																																</ul>
                																						</div>
                																						<div class="col-sm-4"  style="float: right;">
                  																							<ul class="list-items space-0 group">
                    																								<h4 style="text-align:right; font-weight:bold;color: rgb(212, 212, 5);">المجموعة الثالثة</h4>
                    																								<li><a style="text-align:right;font-weight: bold;border-top: 1px solid rgba(242, 239, 9, 0.1);" href="{{ url('/Tplayers',5) }}"> المانيا</a></li>
                    																								<li><a style="text-align:right;font-weight: bold;border-top: 1px solid rgba(242, 239, 9, 0.1);" href="{{ url('/Tplayers',8) }}"> ايرلندا الشمالية</a></li>
                    																								<li><a style="text-align:right;font-weight: bold;border-top: 1px solid rgba(242, 239, 9, 0.1);" href="{{ url('/Tplayers',9) }}"> بولندا</a></li>
                    																								<li><a style="text-align:right;font-weight: bold;border-top: 1px solid rgba(242, 239, 9, 0.1);" href="{{ url('/Tplayers',6) }}"> اوكرانيا</a></li>
                  																							</ul>
                																						</div>
                																						<div class="col-sm-4"  style="float: right;">
                  																							<ul class="list-items space-0 group">
                    																								<h4 style="text-align:right; font-weight:bold;color: rgb(212, 212, 5);">المجموعة الرابعة</h4>
                    																								<li><a style="text-align:right;font-weight: bold;border-top: 1px solid rgba(242, 239, 9, 0.1);" href="{{ url('/Tplayers',16) }}"> كرواتيا </a></li>
                    																								<li><a style="text-align:right;font-weight: bold;border-top: 1px solid rgba(242, 239, 9, 0.1);" href="{{ url('/Tplayers',19) }}"> التشيك</a></li>
                    																								<li><a style="text-align:right;font-weight: bold;border-top: 1px solid rgba(242, 239, 9, 0.1);" href="{{ url('/Tplayers',7) }}"> اسبانيا</a></li>
																																		<li><a style="text-align:right;font-weight: bold;border-top: 1px solid rgba(242, 239, 9, 0.1);" href="{{ url('/Tplayers',25) }}"> تركيا</a></li>
																																</ul>
                																						</div>
                																						<div class="col-sm-4"  style="float: right;">
                  																							<ul class="list-items space-0 group">
		                    																						<h4 style="text-align:right; font-weight:bold;color: rgb(212, 212, 5);">المجموعة الخامسة</h4>
																																		<li><a style="text-align:right;font-weight: bold;border-top: 1px solid rgba(242, 239, 9, 0.1);" href="{{ url('/Tplayers',14) }}"> بلجيكا</a></li>
																																		<li><a style="text-align:right;font-weight: bold;border-top: 1px solid rgba(242, 239, 9, 0.1);" href="{{ url('/Tplayers',10) }}"> ايطاليا</a></li>
																																		<li><a style="text-align:right;font-weight: bold;border-top: 1px solid rgba(242, 239, 9, 0.1);" href="{{ url('/Tplayers',28) }}"> ايرلندا</a></li>
																																		<li><a style="text-align:right;font-weight: bold;border-top: 1px solid rgba(242, 239, 9, 0.1);" href="{{ url('/Tplayers',27) }}"> السويد</a></li>
																																</ul>
                																						</div>
																														<div class="col-sm-4"  style="float: right;">
																																<ul class="list-items space-0 group">
																																		<h4 style="text-align:right; font-weight:bold;color: rgb(212, 212, 5);">المجموعة السادسة</h4>
																																		<li><a style="text-align:right;font-weight: bold;border-top: 1px solid rgba(242, 239, 9, 0.1);" href="{{ url('/Tplayers',3) }}"> النمسا </a></li>
																																		<li><a style="text-align:right;font-weight: bold;border-top: 1px solid rgba(242, 239, 9, 0.1);" href="{{ url('/Tplayers',21) }}"> المجر </a></li>
																																		<li><a style="text-align:right;font-weight: bold;border-top: 1px solid rgba(242, 239, 9, 0.1);" href="{{ url('/Tplayers',22) }}"> ايسلندا</a></li>
																																		<li><a style="text-align:right;font-weight: bold;border-top: 1px solid rgba(242, 239, 9, 0.1);" href="{{ url('/Tplayers',24) }}"> البرتغال </a></li>
																																</ul>
																														</div>
																												</div>
            																				</div>
          																			</div>
        																		</li>
        																		<li style="float:right;"><a style="font-size: 14px;font-weight: bold;" href="{{ url('/news') }}">الأخبار</a> </li>
        																		<li style="float:right;"> <a style="font-size: 14px;font-weight: bold;" href="{{ url('/statistics') }}"> الأحصائيات </a> </li>
      																	</ul>
    																</section>
  															</nav>
														</div>
														@yield('content')
														<div class="footer">
																<div class="fcopy">
																			<div class="container">
																					<div class="row">
																							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
																										<p class="ftex">&copy; جميع الحقوق محفوظة</p>
																							</div>
																					</div>
																			</div>
																	</div>
														</div>
														<script type='text/javascript' src='https://maps.google.com/maps/api/js?sensor=false&amp;ver=4.1.5'></script>
														<script type="text/javascript" src="{{ asset('/admin-ui/front/main_js/bootstrap.min.js') }}"></script>
														<script type="text/javascript" src="{{ asset('/admin-ui/front/main_js/owl.carousel.min.js') }}"></script>
														<script type="text/javascript" src="{{ asset('/admin-ui/front/main_js/bootstrap-hover-dropdown.min.js') }}"></script>
														<script type="text/javascript" src="{{ asset('/admin-ui/front/main_js/jquery.magnific-popup.min.js') }}"></script>
														<script type="text/javascript" src="{{ asset('/admin-ui/front/main_js/script.js') }}"></script>
														<script type="text/javascript" src="{{ asset('/admin-ui/front/main_js/jquery.min.js') }}"></script>
														<script type="text/javascript" src="{{ asset('/admin-ui/front/main_js/modernizr.min.js') }}"></script>
														<script type="text/javascript" src="{{ asset('/admin-ui/front/main_js/owl.carousel.min.js')}}"></script>
														<script type="text/javascript" src="{{ asset('/admin-ui/front/main_js/jqBootstrapValidation.js') }}"></script>
														<script type="text/javascript" src="{{ asset('/admin-ui/js/jquery.1.7.2.js') }}"></script>
														<script type="text/javascript" src="{{ asset('/admin-ui/js/jquery.syotimer.js') }}"></script>
														<script type="text/javascript" src="{{ asset('/admin-ui/front/main_js/demo.js') }}"></script>
														<script type="text/javascript" src="{{ asset('/admin-ui/front/main_js/matchMedia.addListener.min.js') }}"></script>
														<script type="text/javascript" src="{{ asset('/admin-ui/front/main_js/material.min.js') }}"></script>
														<script type="text/javascript" src="{{ asset('/admin-ui/front/main_js/mashable-menu.min.js') }}"></script>
														@yield('scripts')
												</div>
										</div>
								</div>
					</body>
</html>
