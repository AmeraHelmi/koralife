<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="ar" dir="rtl">
<!--<![endif]-->

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>
كورة لايف - @yield('title')
</title>

<!-- Favicon
================================================== -->
<link rel="shortcut icon" href="images/favicon.png">
<link rel="apple-touch-icon" href="apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="apple-touch-icon-114x114.png">

<!-- CSS
================================================== -->
<!--<link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/midan-normal" type="text/css"/>
<link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/midan-black" type="text/css"/> -->
<link href="{{URL::asset('admin-ui/front_css/custom.css')}}" rel="stylesheet">
@yield('style')

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>

<!--[if lt IE 8]>
  <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->

<!-- Header
================================================== -->
<header>
  <div class="top-bar">
    <div class="container">
      <div class="row">
        <div id="datetime" class="no-padding-right col-sm-3"></div>
        <nav class="hot-access text-left no-padding-left col-sm-9">
          <ul class="list-inline">
           @if($session == '')
            <li><a href="javascript:void(0)" data-toggle="modal" data-target="#login-box">تسجيل الدخول</a></li>
            <li><a href="javascript:void(0)" data-toggle="modal" data-target="#create-account">اشتراك جديد</a></li>
              @else
      <li><a href="{{ url('/logout') }}">{{  $session }}, تسجيل الخروج</a></li>
      @endif
            <li class="notification-box"><a href="#">البث المباشر</a>
              <div class="noti-dot"> <span class="dot"></span> <span class="pulse"></span> </div>
            </li>
            <li><a href="{{ url('/blogs') }}">علي الناصية</a></li>
            <li><a href="{{ url('/posts') }}">مع القراء</a></li>
            <li><a href="#">كاريكاتير</a></li>
            <li><a href="#">انفوجرافيك</a></li>
            <li><a href="#">RSS</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
  <div class="site-name container">
    <div class="row">
      <div class="logo col-sm-2"> <a class="navbar-brand" href="#brand"><img src="images/brand/logo-black.png" class="logo" alt=""></a> </div>
      <div class="col-sm-10"></div>
    </div>
  </div>
</header>

<!-- Navigation
================================================== -->
<nav class="navbar navbar-default navbar-mobile bootsnav container no-padding-left">
  <div class="top-search">
    <div class="container">
      <div class="input-group"> <span class="input-group-addon search"><i class="icofont icofont-search"></i></span>
        <input type="text" class="form-control" placeholder="Search">
        <span class="input-group-addon close-search"><i class="fa fa-times">s</i></span> </div>
    </div>
  </div>
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu"> <i class="fa fa-bars">s</i> </button>
  </div>
  <div id="navbar-menu" class="collapse navbar-collapse no-padding-left">
    <ul class="nav navbar-nav navbar-right" data-in="fadeIn" data-out="fadeOut">
      <li><a href="{{ url('/') }}">الصفحة الرئيسية</a></li>
      <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" >المباريات</a>
        <ul class="dropdown-menu">
          <li><a href="#">الاحصائيات</a></li>
          <li><a href="#">دقيقة بدقيقة</a></li>
          <li><a href="#">Custom Menu</a></li>
          <li><a href="#">Custom Menu</a></li>
          <li><a href="#">Custom Menu</a></li>
          <li><a href="#">Custom Menu</a></li>
        </ul>
      </li>
      <li class="dropdown megamenu-fw"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">بطولات و دوريات</a>
        <ul class="dropdown-menu megamenu-content" role="menu">
          <li>
            <div class="row">
              <div class="col-menu col-md-3">
                <h6 class="title">كأس أمم أوروبا</h6>
                <div class="content">
                  <ul class="menu-col">
                    <li><a href="#">Custom Menu</a></li>
                    <li><a href="#">Custom Menu</a></li>
                    <li><a href="#">Custom Menu</a></li>
                    <li><a href="#">Custom Menu</a></li>
                    <li><a href="#">Custom Menu</a></li>
                    <li><a href="#">Custom Menu</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-menu col-md-3">
                <h6 class="title">الدورى المصرى الممتاز</h6>
                <div class="content">
                  <ul class="menu-col">
                    <li><a href="#">Custom Menu</a></li>
                    <li><a href="#">Custom Menu</a></li>
                    <li><a href="#">Custom Menu</a></li>
                    <li><a href="#">Custom Menu</a></li>
                    <li><a href="#">Custom Menu</a></li>
                    <li><a href="#">Custom Menu</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-menu col-md-3">
                <h6 class="title">كأس القارة الأفريقية</h6>
                <div class="content">
                  <ul class="menu-col">
                    <li><a href="#">Custom Menu</a></li>
                    <li><a href="#">Custom Menu</a></li>
                    <li><a href="#">Custom Menu</a></li>
                    <li><a href="#">Custom Menu</a></li>
                    <li><a href="#">Custom Menu</a></li>
                    <li><a href="#">Custom Menu</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-menu col-md-3">
                <h6 class="title">بطولة آسيا</h6>
                <div class="content">
                  <ul class="menu-col">
                    <li><a href="#">Custom Menu</a></li>
                    <li><a href="#">Custom Menu</a></li>
                    <li><a href="#">Custom Menu</a></li>
                    <li><a href="#">Custom Menu</a></li>
                    <li><a href="#">Custom Menu</a></li>
                    <li><a href="#">Custom Menu</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </li>
      <li><a href="{{ url('/vedios') }}">فيديوهات</a></li>
      <li><a href="{{ url('/gallary') }}">صور</a></li>
      <li><a href="{{ url('/news') }}">أخبار</a></li>
      <li><a href="#">اللاعبون</a></li>
      <li><a href="#">النوادي</a></li>
      <li><a href="#">الاستادات</a></li>
      <li><a href="#">المعلقون</a></li>
      <li><a href="#">الحكام</a></li>
      <li><a href="#">المديرون</a></li>
      <li><a href="#">المدربون</a></li>
    </ul>
    <div class="attr-nav">
      <ul>
        <li class="side-menu"><a href="#">
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 294.843 294.843" style="enable-background:new 0 0 294.843 294.843;" xml:space="preserve" width="32px" height="32px">
            <g>
              <path d="M147.421,0C66.133,0,0,66.133,0,147.421c0,40.968,17.259,80.425,47.351,108.255c2.433,2.25,6.229,2.101,8.479-0.331   c2.25-2.434,2.102-6.229-0.332-8.479C27.854,221.3,12,185.054,12,147.421C12,72.75,72.75,12,147.421,12   s135.421,60.75,135.421,135.421s-60.75,135.421-135.421,135.421c-3.313,0-6,2.687-6,6s2.687,6,6,6   c81.289,0,147.421-66.133,147.421-147.421S228.71,0,147.421,0z" fill="#FFFFFF"/>
              <path d="M84.185,90.185h126.473c3.313,0,6-2.687,6-6s-2.687-6-6-6H84.185c-3.313,0-6,2.687-6,6S80.872,90.185,84.185,90.185z" fill="#FFFFFF"/>
              <path d="M84.185,153.421h126.473c3.313,0,6-2.687,6-6s-2.687-6-6-6H84.185c-3.313,0-6,2.687-6,6S80.872,153.421,84.185,153.421z" fill="#FFFFFF"/>
              <path d="M216.658,210.658c0-3.313-2.687-6-6-6H84.185c-3.313,0-6,2.687-6,6s2.687,6,6,6h126.473   C213.971,216.658,216.658,213.971,216.658,210.658z" fill="#FFFFFF"/>
            </g>
            <g> </g>
            <g> </g>
            <g> </g>
            <g> </g>
            <g> </g>
            <g> </g>
            <g> </g>
            <g> </g>
            <g> </g>
            <g> </g>
            <g> </g>
            <g> </g>
            <g> </g>
            <g> </g>
            <g> </g>
          </svg>
          </a></li>
        <li class="search"><a href="#">
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_2" x="0px" y="0px" viewBox="0 0 489.4 489.4" style="enable-background:new 0 0 489.4 489.4; " xml:space="preserve" width="24px" height="24px">
            <g>
              <path d="M483.1,454.038l-109.6-109.6c29.9-36.4,47.9-83,47.9-133.7c0-116.2-94.5-210.7-210.7-210.7S0,94.538,0,210.738   s94.5,210.7,210.7,210.7c50.7,0,97.3-18,133.7-47.9l109.6,109.6c8.3,8.3,20.8,8.3,29.1,0   C491.5,474.837,491.5,462.337,483.1,454.038z M41,210.738c0-93.6,76.1-169.7,169.7-169.7s169.7,76.1,169.7,169.7   s-76.1,169.7-169.7,169.7S41,304.337,41,210.738z" fill="#FFFFFF"/>
            </g>
            <g> </g>
            <g> </g>
            <g> </g>
            <g> </g>
            <g> </g>
            <g> </g>
            <g> </g>
            <g> </g>
            <g> </g>
            <g> </g>
            <g> </g>
            <g> </g>
            <g> </g>
            <g> </g>
            <g> </g>
          </svg>
          </a></li>
      </ul>
    </div>
  </div>
  <!-- Side menu
================================================== -->
  <div class="side"> <a href="#" class="close-side"><i class="fa fa-times"></i></a>
    <div class="widget">
      <h6 class="title">Custom Pages</h6>
      <ul class="link">
        <li><a href="#">About</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Blog</a></li>
        <li><a href="#">Portfolio</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </div>
    <div class="widget">
      <h6 class="title">Additional Links</h6>
      <ul class="link">
        <li><a href="#">Retina Homepage</a></li>
        <li><a href="#">New Page Examples</a></li>
        <li><a href="#">Parallax Sections</a></li>
        <li><a href="#">Shortcode Central</a></li>
        <li><a href="#">Ultimate Font Collection</a></li>
      </ul>
    </div>
  </div>
</nav>






@yield('content')

<!-- Footer
================================================== -->
<footer class="bg-info ex-top-padding ex-btm-padding">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="row">
          <div class="col-sm-4 text-white">
            <h3>كورة لايف</h3>
            <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.</p>
          </div>
          <div class="col-sm-4 text-white">
            <h3>تحديثات فايسبوك</h3>
          </div>
          <div class="col-sm-4 text-white">
            <h3>تحديثات تويتر</h3>
          </div>
        </div>
      </div>
      <div class="col-sm-12">
        <div class="row">
          <div class="footer-menu col-sm-8">
            <nav>
              <ul class="list-inline">
                <li><a href="#">الرئيسية</a></li>
                <li><a href="#">المباريات</a></li>
                <li><a href="#">البطولات</a></li>
                <li><a href="#">فيديوهات</a></li>
                <li><a href="#">صور</a></li>
                <li><a href="#">أخبار</a></li>
                <li><a href="#">اللاعبون</a></li>
              </ul>
            </nav>
          </div>
          <div class="copyrights col-sm-4">جميع الحقوق محفوظة</div>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- Login & Create Account
  ================================================== -->

<div class="modal fade" id="create-account" tabindex="-1" role="dialog" aria-labelledby="loginboxLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close hvr-sweep-to-right-primary" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <ul class="alerts-list" style="display:none;" id="show">
  <li>
     <div class="alert alert-success alert-dismissable">
           <i class="icon-remove-sign"></i> تم تسجيلك بنجــــــــــــــــــاح.
       </div>
   </li>
</ul>
        <div id="show" style="display:none;" class="alert alert-success alert-dismissable"> تم تسجيل اشتراكك بنجاح، . </div>
        <ul class="list-inline social-login row">
          <li class="col-sm-6">
            <button class="btn btn-facebook btn-block" type="button"> <i class="icofont icofont-social-facebook"></i> فايسبوك </button>
          </li>
          <li class="col-sm-6">
            <button class="btn btn-twitter btn-block" type="button"> <i class="icofont icofont-social-twitter"></i> تويتر </button>
          </li>
        </ul>
        <hr>
        <form method="POST" id="login-form" class="addForm" role="form" action="{{ url('/register') }}" data-toggle="validator" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="row">
            <div class="col-sm-6">
              <div class=" form-group">
                <label class="control-label" for="register-name">الاسم <span class="req">*</span></label>
                <input type="text" class="form-control" name="username" id="register-name" placeholder="سيظهر فى التعليقات مثلا" required>
              </div>
            </div>
            <div class="col-sm-6">
              <div class=" form-group">
                <label class="control-label" for="register-mail">البريد الاليكترونى <span class="req">*</span></label>
                <input type="email" class="form-control" name="email" id="register-mail" placeholder="سنرسل لك تأكيدا للاشتراك عليه"  required>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label text-uppercase" for="login-password">كلمة المرور <span class="req">*</span></label>
                <input type="password" class="form-control" name="password" id="login-password-1" placeholder="حروف و أرقام فقط" required>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label text-uppercase" for="login-password">تأكيد كلمة المرور <span class="req">*</span></label>
                <input type="password" class="form-control" name="confirm_password" id="login-password-2" placeholder="كرر كلمة المرور التى اخترتها" required>
              </div>
            </div>
            <div class="col-sm-12">
              <label class="control-label" for="login-name">صورة البروفايل <small class="text-muted">(الامتدادات المقبولة: png - jpg)</small></label>
              <div class="dropify-wrapper">
                <div class="dropify-message"><span class="file-icon "></span>
                  <p class="text-center">اسحب صورة لرفعها مباشرة أو استعرض الملفات لاختيار صورة</p>
                  <p class="dropify-error">للأسف، حدث خطأ ما!</p>
                </div>
                <div class="dropify-loader"></div>
                <div class="dropify-errors-container">
                  <ul>
                  </ul>
                </div>
                <input type="file" data-max-file-size="1M" class="dropify" name="image">
                <button class="dropify-clear" type="button">حذف</button>
                <div class="dropify-preview"><span class="dropify-render"></span>
                  <div class="dropify-infos">
                    <div class="dropify-infos-inner">
                      <p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p>
                      <p class="dropify-infos-message">اسحب صورة أو استعرض الملفات لاستبدال الصورة</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="checkbox">
            <input type="checkbox" id="registercheckbox" value="option1" name="registercheckbox">
            <label for="registercheckbox"> اشتراكك يعنى موافقتك على <a href="#"><span class="text-capitalize">الشروط و الأحكام.</span></a> </label>
          </div>
          <button class="btn btn-block btn-orange btn-lg hvr-sweep-to-right-primary" id="login-submit" type="submit">تسجيل الاشتراك</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="login-box" tabindex="-1" role="dialog" aria-labelledby="loginboxLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close hvr-sweep-to-right-primary" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <div id="show_login_success" class="alert alert-success alert-dismissable" style="display:none;">مرحبا بعودتك لكورة لايف!</div>
        <div id="show_login_error" class="alert alert-success alert-dismissable" style="display:none;">راجع الاسم و كلمة المرور!</div>
        <ul class="list-inline social-login row">
          <li class="col-sm-6">
            <button class="btn btn-facebook btn-block" type="button"> <i class="icofont icofont-social-facebook"></i> فايسبوك </button>
          </li>
          <li class="col-sm-6">
            <button class="btn btn-twitter btn-block" type="button"> <i class="icofont icofont-social-twitter"></i> تويتر </button>
          </li>
        </ul>
        <hr>
        <form method="POST" role="form" id="the-login-form" class="login_form" action="{{ url('/login') }}"  >
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class=" form-group">
            <label class="control-label" for="login-name">الايميل</label>
            <input type="text" class="form-control" value="" name="email" id="login-name" placeholder="الاسم أو البريد الاليكترونى" required>
          </div>
          <div class="form-group">
            <label class="control-label text-uppercase" for="login-password">كلمة المرور</label>
            <input type="password" class="form-control" value="" name="password" id="login-password" required>
          </div>
          <div class="checkbox">
            <input type="checkbox" id="logincheckbox" value="option1" name="logincheckbox">
            <label for="logincheckbox"> تذكرنى</label>
          </div>
          <button class="btn btn-block btn-orange btn-lg hvr-sweep-to-right-primary" id="the-login-submit" type="submit">تسجيل الدخول</button>
        </form>
      </div>
      <div class="modal-footer">
        <p class="text-center"><small>نسيت كلمة المرور؟ <a href="#">لا تقلق، سنساعدك.</a></small></p>
      </div>
    </div>
  </div>
</div>
<!-- JS
================================================== -->
<script src="{{URL::asset('admin-ui/front_js/jquery-1.11.3.min.js')}}"></script>
<script src="{{URL::asset('admin-ui/front_js/easing.1.3.js')}}"></script>
<script src="{{URL::asset('admin-ui/front_js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('admin-ui/front_js/moment.min.js')}}"></script>
<script src="{{URL::asset('admin-ui/front_js/ar-sa.js')}}"></script>
<script src="{{URL::asset('admin-ui/front_js/bootsnav.js')}}"></script>
<script src="{{URL::asset('admin-ui/front_js/owl.carousel.min.js')}}"></script>
<script src="{{URL::asset('admin-ui/front_js/hammer.min.js')}}"></script>
<script src="{{URL::asset('admin-ui/front_js/count-down.js')}}"></script>
<script src="{{URL::asset('admin-ui/front_js/nicescroll.min.js')}}"></script>
<script src="{{URL::asset('admin-ui/front_js/sliphover.js')}}"></script>
<script src="{{URL::asset('admin-ui/front_js/salvattore.js')}}"></script>
<script src="{{URL::asset('admin-ui/front_js/magnific-popup.js')}}"></script>
<script src="{{URL::asset('admin-ui/front_js/jquery.ticker.min.js')}}"></script>
<script src="{{URL::asset('admin-ui/front_js/plyr.js')}}"></script>
 {{-- <script src="{{URL::asset('admin-ui/front_js/demo.js')}}"></script>  --}}
<script src="https://cdn.rangetouch.com/0.0.9/rangetouch.js" async></script>
<script src="https://cdn.shr.one/0.1.9/shr.js"></script>
<script>if(window.shr) { window.shr.setup({ count: { classname: 'btn__count' } }); }</script>
<script src="{{URL::asset('admin-ui/front_js/custom.js')}}"></script>
<script src="{{ asset('admin-ui/js/forms.js') }}"></script>
<script type="text/javascript">
    $('.addForm').ajaxForm(function() {
    $('.addForm')[0].reset();
    $('#show').show();
window.location.reload(1000);
        });
////////////////////////////////////////////////////////
    $(".login_form").on('submit', function(e){
        if (!e.isDefaultPrevented())
        {
            var self = $(this);
            $.ajax({
                url: "{!!URL::route('login_submit')!!}",
                type: "POST",
                data: self.serialize(),
                success: function(res){
                    $('#show_login_success').show();
                    $('#show_login_error').hide();
                    window.location.reload(60000);
                },
                error: function(){
                   $('#show_login_error').show();
                   $('#show_login_success').hide();
                }
            });
            e.preventDefault();
        }
     });

     function like(){
       $id = $('#hidden_id').val();
       $url = $('#hidden_url').val();
             $.ajax({
                 url: "{{ url('/increase_num_likes') }}",
                 type: "GET",
                 data: {
                   id:$id,
                   url:$url
                 },
                 success: function(res){
                   $('.dislike').show();
                   $('.like').hide();
                 },
                 error: function(){
                 }
             });
 }

     function dislike(){
       $id = $('#hidden_id').val();
             $.ajax({
                 url: "{{ url('/decrease_num_likes') }}",
                 type: "GET",
                 data: {
                   id:$id,
                   url:$url
                 },
                 success: function(res){
                   $('.dislike').hide();
                   $('.like').show();
                 },
                 error: function(){
                 }
             });
 }
     </script>
@yield('scripts')

</body>
</html>
