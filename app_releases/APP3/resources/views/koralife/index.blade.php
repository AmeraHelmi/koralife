@extends('kora_app')

@section('styles')

<style>



.style22 {

color: #666666;

}

.style23 {

font-family: Arial, Helvetica, sans-serif;

font-size: 12px;

}

.style31 {

font-family: "Arial";

color: #999999;

font-size: 12px;

font-weight: bold;

}

.style34 {

font-family: "Arial";

}

.style24 {  font-size: 11px;

color: #999999;

font-family: Arial, Helvetica, sans-serif;

}

.style62 {

font-size: 12px; color: #999999;

font-family: "myriad Pro";

}

.style67 {

font-family: "myriad Pro";

color: #999999;

font-size: 12px;

font-weight: bold;

}

.style69 {

font-family: "Arial";

color: #999999;

font-weight: bold;

}

.style1 {

font-family: Arial, Helvetica, sans-serif;

color: #999999;

font-size: 14px;

font-weight: bold;

}

.style3 {

font-family: "Arial";

font-size: 12px;

line-height: normal;

height: 10px;

}

.style71 {

font-family: "myriad Pro";

}

.style73 {

font-family: Arial;

color: #999999;

font-size: 12px;

font-weight: bold;

}

.style74 {

font-size: 12px;

color: #999999;

font-family: Arial;

}

.style75 {

font-family: Arial;

color: #CCC;

font-size: 12px;

font-weight: bold;

}

.style76 {

font-size: 12px;

font-family: Arial;

color: #FF0000;

}

.style81 {

font-family: Arial;

}

.style82 {

color: #999999;

font-size: 12px;

}

.style83 {

font-size: 12px;

font-weight: bold;

color: #999999;

}

/* jssor slider bullet navigator skin 05 css */

/*

.jssorb05 div           (normal)

.jssorb05 div:hover     (normal mouseover)

.jssorb05 .av           (active)

.jssorb05 .av:hover     (active mouseover)

.jssorb05 .dn           (mousedown)

*/

.jssorb05 {

position: absolute;

}

.jssorb05 div, .jssorb05 div:hover, .jssorb05 .av {

position: absolute;

/* size of bullet elment */

width: 16px;

height: 16px;

background: url('{{ asset('/admin-ui/front/main_images/b05.png')}}') no-repeat;

overflow: hidden;

cursor: pointer;

}

.jssorb05 div { background-position: -7px -7px; }

.jssorb05 div:hover, .jssorb05 .av:hover { background-position: -37px -7px; }

.jssorb05 .av { background-position: -67px -7px; }

.jssorb05 .dn, .jssorb05 .dn:hover { background-position: -97px -7px; }



/* jssor slider arrow navigator skin 22 css */

/*

.jssora22l                  (normal)

.jssora22r                  (normal)

.jssora22l:hover            (normal mouseover)

.jssora22r:hover            (normal mouseover)

.jssora22l.jssora22ldn      (mousedown)

.jssora22r.jssora22rdn      (mousedown)

*/

.jssora22l, .jssora22r {

display: block;

position: absolute;

/* size of arrow element */

width: 40px;

height: 58px;

cursor: pointer;

background: url('{{ asset('/admin-ui/front/main_images/a22.png')}}') center center no-repeat;

overflow: hidden;

}

.jssora22l { background-position: -10px -31px; }

.jssora22r { background-position: -70px -31px; }

.jssora22l:hover { background-position: -130px -31px; }

.jssora22r:hover { background-position: -190px -31px; }

.jssora22l.jssora22ldn { background-position: -250px -31px; }

.jssora22r.jssora22rdn { background-position: -310px -31px; }

.arrow,.arrow2:hover{

color:#00aeef;

}

</style>

<link rel='stylesheet' href="{{ asset('/admin-ui/css/custom.css') }}">

<link rel='stylesheet' href="{{ asset('/admin-ui/css/ionicons.min.css') }}">

@endsection

@section('content')

<!-- BANNER -->

<div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 1300px; height:

500px; overflow: hidden; visibility: hidden;">

  <!-- Loading Screen -->

  <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">

    <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>

    <div style="position:absolute;display:block;background:url('{{ asset('/admin-ui/main_images/loading.gif')}} no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>

  </div>

  <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 1300px; height: 500px; overflow: hidden;">
     @foreach($news as $new)

    <div data-p="225.00" style="display: none;"> <img data-u="image" src="images/uploads/{{ $new->flag }}" />

      <div class="container ur-container"> <a style="position: absolute; left: 8%; top: 38%;

background-color: rgba(0, 0, 0, 0.8); line-height: 32px;

width: 526px; height: 166px;

padding-bottom: 15px; padding-left: 28px;padding-top: 12px;font-size: 30px;" class="article--wrap"

 href="{{ url('/Newdetails',$new->id) }}"

 title="Amputee football has bright future">

        <div class="article--overlay"> </div>

        <header class="article--header">

          <h1 class="article--title" style="font-size:30px !important; overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">{{ $new->title }} </h1>

          <p class="article--title">{{ $new->additional_info}}</p>

        </header>

        <footer class="article--footer"> <span class="more-link arrow2"style="color: rgba(255,255,255,0.6) !important;font-size:14px !important; " title="More: Amputee football has bright future "><span class="arrow"> <i class="fa fa-arrow-right" aria-hidden="true"></i> </span>المزيد</span> </footer>

        </a> </div>

    </div>

    @endforeach </div>

  <!-- Bullet Navigator -->

  <div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">

    <!-- bullet navigator item prototype -->

    <div data-u="prototype" style="width:16px;height:16px;"></div>

  </div>



  <!-- Arrow Navigator -->

  <span data-u="arrowleft" class="jssora22l" style="top:0px;leaft:12px;width:40px;height:58px;" data-autocenter="2"></span> <span data-u="arrowright" class="jssora22r" style="top:0px;right:12px;width:40px;height:58px;" data-autocenter="2"></span> </div>



<!-- ABOUT SECTION -->

<div class="section about" >

  <div class="container" style="width: 100%;">

    <div class="row">

      <div class="col-sm-12">

        <div class="page-title">

          <h2 class="lead">مباريات اليوم</h2>

          <div class="border-style"></div>

        </div>

      </div>

    </div>

    <!-- video -->

    <div class="row grass" style="text-align: -;">

      <div class="col-sm-12">

        <div class="matches col-sm-8 col-lg-offset-2 bordered"> @foreach($match as $matchdetail)

          <div class="row">

            <div class="col-sm-4 team team-1 text-center">

              <div class="bordered"><a href="{{ url('/Tplayers',$matchdetail->T1ID) }}"> <img class="img-responsive" src="images/uploads/{{ $matchdetail->T1flag }}" width="200" height="200" alt=""/></a> <a href="{{ url('/Tplayers',$matchdetail->T1ID) }}">

                <h5 class="text-center">{{ $matchdetail->T1name }}</h5>

                </a> </div>

            </div>

            <div class="col-sm-4 result bordered">

              <div class="result-info clearfix"> <span class="pull-right text-center">{{ $matchdetail->team1_goals }}</span> <span class="pull-left text-center">{{ $matchdetail->team2_goals }}</span> </div>

              <div class="sub-info ">

                <p class="text-center"><span class="stadum">أستاد {{ $matchdetail->stadium_name }}</span> <span>{{ $matchdetail->date }}</span></p>

                <p></p>

              </div>

              <div class="deal-counter text-center coming-match rtl row" id="match-coming-1">

                <div class="col-sm-4">

                  <p><span class="hours">18</span> <span class="timeRefHours">ساعة</span></p>

                </div>

                <div class="col-sm-4">

                  <p><span class="minutes">01</span> <span class="timeRefMinutes">دقيقة</span></p>

                </div>

                <div class="col-sm-4">

                  <p><span class="seconds">51</span> <span class="timeRefSeconds">ثانية</span></p>

                </div>

              </div>

            </div>

            <div class="col-sm-4 team team-2 text-center">

              <div class="bordered"> <a href="{{ url('/Tplayers',$matchdetail->T2ID) }}"><img class="img-responsive" src="images/uploads/{{ $matchdetail->T2flag }}" width="200" height="200" alt=""/></a> <a href="{{ url('/Tplayers',$matchdetail->T2ID) }}">

                <h5 class="text-center">{{ $matchdetail->T2name }}</h5>

                </a> </div>

            </div>

            <div class="col-sm-12 text-center live"> <a  class="btn btn-success" href="" data-toggle="modal" data-target="#vid-box">بث مباشر</a> <a  class="btn btn-success"

href="{{ url('/plan',$matchdetail->match_id) }}">تفاصيل</a> <a  class="btn btn-success"

href="{{ url('/statistics',$matchdetail->match_id) }}">أحصائيات</a> </div>

          </div>

          @endforeach </div>

      </div>

    </div>

  </div>

</div>

<div class="modal fade" id="vid-box" tabindex="-1" role="dialog" aria-labelledby="loginboxLabel" aria-hidden="true">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div class="modal-body">

        <button type="button" class="close hvr-sweep-to-right-primary" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <div id="flashContent">

          <p>To view this page ensure that Adobe Flash Player version 10.3.0 or greater is installed.</p>

        </div>

      </div>

    </div>

  </div>

</div>

<!-- ABOUT SECTION -->

<div class="section about about-2">

  <div class="container">

    <div class="row">

      <div class="col-sm-12 col-md-12"> </div>

    </div>

    <div class="row">

      <div class="col-sm-12 col-md-3"> <img class="img-responsive" src="/admin-ui/images/ad.gif"/> </div>

      <div class="col-sm-12 col-md-6">

        <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">

          <ul id="myTabs" class="nav nav-tabs" role="tablist">

            <li class="active"><a href="#match" id="match-tab" role="tab" data-toggle="tab" aria-controls="match" aria-expanded="true">ترتيب الفرق</a></li>

            <li><a href="#league" role="tab" id="league-tab" data-toggle="tab" aria-controls="league">نتائج المباريات</a></li>

            <li><a href="#training" role="tab" id="training-tab" data-toggle="tab" aria-controls="training">مباريات اليوم</a></li>

          </ul>

          <div id="myTabContent" class="tab-content tab-content-bg">

            <div role="tabpanel" class="tab-pane fade in active" id="match" aria-labelledBy="match-tab">

              <div class="table-responsive">

                <div class="themeum-club-ranking ">

                  <div id="club-ranking" class="carousel slide" data-ride="carousel">

                    <div class="themeum-title themeum-title-black">

                      <div class="club-ranking-control"> <a class="left club-ranking-carousel-control" href="#club-ranking" role="button" data-slide="prev"> <i class="fa fa-angle-left"></i></a> <a class="right club-ranking-carousel-control" href="#club-ranking" role="button" data-slide="next"> <i class="fa fa-angle-right"></i></a> </div>

                    </div>

                    <div class="themeum-recent-result-inner">

                      <div class="carousel-inner" role="listbox">

                        <div class="item active" style="background-image: none !important;">

                          <?php $i=0; ?>

                          @foreach($team_championship as $team_point)

                          <?php $i++; ?>

                          <ul class="club-ranking-inner list-inline row">

                            <li class="col-sm-1"> <?php echo $i; ?> </li>

                            <li class="col-sm-1"> <img class="img-responsive" src="images/uploads/{{ $team_point->team_flag }}" alt=""> </li>

                            <li class="col-sm-9 text-right"> {{ $team_point->team_name }} </li>

                            <li class="col-sm-1"> {{ $team_point->points }} </li>

                          </ul>

                          <?php if($i == 4 || $i == 12 || $i == 20) {

echo'</div><div class="item" style="background-image: none !important;">';

}

else if($i == 8 || $i == 16 || $i == 24 ) {

echo'</div><div class="item active" style="background-image: none !important;">';

}

?>

                          @endforeach </div>

                      </div>

                    </div>

                  </div>

                </div>

                <script type="text/javascript">jQuery(document).ready(function() { jQuery('#club-ranking').carousel({ interval:  }) });</script>

                <div class="vc_empty_space" style="height: 30px"><span class="vc_empty_space_inner"></span></div>

              </div>

            </div>

            <div role="tabpanel" class="tab-pane fade" id="training" aria-labelledBy="training-tab">

              <div class="table-responsive">

                <div class="themeum-recent-result ">

                  <div id="recent-result" class="carousel slide" data-ride="carousel">

                    <div class="themeum-title themeum-title-black"> </div>

                    <div class="themeum-recent-result-inner">

                      <div class="carousel-inner" role="listbox">

                        <div class="item active"> @if(count($Allmatch)> 0)

                          @foreach($Allmatch as $matchdetail)

                          <div class="themeum-recent-result-item-inner">

                            <div class="clearfix"></div>

                            <div class="themeum-recent-result-item">

                              <div class="text-left themeum-recent-result-list"> <img class="img-responsive" src="" alt=""> {{ $matchdetail->T1name }}</div>

                              <div class="text-center themeum-recent-result-list"> <span class="goal">VS</span> </div>

                              <div class="text-center themeum-recent-result-list"> <img class="img-responsive" src="" alt=""> {{ $matchdetail->T2name }}</div>

                            </div>

                          </div>

                          @endforeach

                          @else

                          <div class="themeum-recent-result-item"  style="text-align:center;"> <span style="text-align:center; font-size:22px; color:#fff;">لأ يوجد مباريات اليوم</span> </div>

                          @endif </div>

                      </div>

                    </div>

                  </div>

                </div>

                <script type="text/javascript">jQuery(document).ready(function() { jQuery('#club-ranking').carousel({ interval:  }) });</script>

                <div class="vc_empty_space" style="height: 30px"><span class="vc_empty_space_inner"></span></div>

              </div>

            </div>

            <div role="tabpanel" class="tab-pane fade" id="league" aria-labelledBy="league-tab">

              <div class="table-responsive">

                <div class="themeum-recent-result ">

                  <div id="recent-result" class="carousel slide" data-ride="carousel">

                    <div class="themeum-title themeum-title-black">

                      <div class="recent-result-control"><a class="left recent-result-carousel-control" href="#recent-result" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a><a class="right recent-result-carousel-control" href="#recent-result" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a></div>

                    </div>

                    <div class="themeum-recent-result-inner">

                      <div class="carousel-inner" role="listbox">

                        <div class="item active">

                          <?php $i=0; ?>

                          @foreach($Allmatch2 as $matchdetail2)

                          <?php $i++; ?>

                          <div class="themeum-recent-result-item-inner">

                            <div class="clubnames"> <span class="pull-right">{{ $matchdetail2->date }}</span> </div>

                            <div class="clearfix"></div>

                            <div class="themeum-recent-result-item">

                              <div class="text-left themeum-recent-result-list"> <img class="img-responsive" src="images/uploads/{{ $matchdetail2->T1flag }}" alt="">{{ $matchdetail2->T1name }}</div>

                              <div class="text-center themeum-recent-result-list"><span class="goal">{{ $matchdetail2->team1_goals }}</span> - <span class="goal">{{ $matchdetail2->team2_goals }}</span> </div>

                              <div class="text-center themeum-recent-result-list"> <img class="img-responsive" src="images/uploads/{{ $matchdetail2->T2flag }}" alt="">{{ $matchdetail2->T2name }}</div>

                            </div>

                          </div>

                          <?php if($i == 4 || $i == 12 || $i == 20 || $i == 8 || $i == 16 || $i == 24) {

echo'</div><div class="item">';

}

?>

                          @endforeach </div>

                        <!-- <div class="item">

</div> -->

                      </div>

                    </div>

                  </div>

                </div>

                <script type="text/javascript">jQuery(document).ready(function() { jQuery('#recent-result').carousel({ interval:  }) });</script>

                <div class="vc_empty_space" style="height: 30px"><span class="vc_empty_space_inner"></span></div>

              </div>

            </div>

          </div>

        </div>

        <!-- /example -->



      </div>

      <div class="col-sm-12 col-md-3"> <img class="img-responsive" src="/admin-ui/images/ad.gif"/></div>

    </div>

  </div>

</div>



<!-- BLOG/NEWS SECTION -->

<div class="section blog">

  <div class="container">



    <div class="row">

      <div class="col-sm-12 col-md-6 col-md-offset-3">

        <div class="page-title">

          <h2 class="lead">أخر الأخبار</h2>

          <div class="border-style"></div>

        </div>

      </div>

    </div>

    <div class="row"> @foreach($newcontent as $new)

      <div class="col-sm-12 col-md-4">

        <div class="blog-item">

          <div class="gambar">

            <div class="date"> {{ $new->date }} </div>

            <a href="{{ url('/Newdetails',$new->id) }}" ><img style="height:200px !important;width:360px !important;" src="images/uploads/{{$new->flag}}" alt="" class="img-responsive" /></a> </div>

          <div class="item-body">

            <div class="description">

              <h3><a href="{{ url('/Newdetails',$new->id) }}" title="">{{ $new->title }}</a></h3>

              <p>{{ $new->additional_info}}</p>

              <a href="{{ url('/Newdetails',$new->id) }}" title="" class="readmore">أقرأ المزيد</a> </div>

          </div>

        </div>

      </div>

      @endforeach </div>

  </div>

</div>

<div class="row">

      <div class="col-sm-12 text-center ad-con">  </div>

      </div>

<div class="row">

  <div class="col-sm-12 col-md-6 col-md-offset-3">

    <div class="page-title">

      <h2 class="lead">الرعاه الرسمى</h2>

      <div class="border-style"></div>

    </div>

  </div>

</div>

<!-- CLIENT SECTION -->

<div class="section stat-client p-main bg-client">

  <div class="container">

    <div class="row"> @foreach($sponsors6 as $sponsor)

      <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">

        <div class="client-img"> <a data-track="N" target="_blank" href="{{ $sponsor->url }}" title="Hyundai" class="sponsor-item-link half-link"> <img style="width:176px;height:90px;" src="images/uploads/{{ $sponsor->sponsor_flag }}" alt="" class="img-responsive" /> </a> </div>

      </div>

      @endforeach </div>

  </div>

</div>

@endsection



@section('scripts')

<script>



  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){



  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),



  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)



  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');







  ga('create', 'UA-74569500-1', 'auto');



  ga('send', 'pageview');







</script>

<script src="{{ asset('/admin-ui/js/countdown.js') }}"></script>

<script src="{{ asset('/admin-ui/js/custom.js') }}"></script>

<script src="{{ asset('/admin-ui/js/jquery-1.11.3.min.js') }}"></script>

<script src="{{ asset('/admin-ui/js/jssor.slider.mini.js') }}"></script>

<script src="{{ asset('/admin-ui/js/swfobject.js') }}"></script>

<!-- <script type="text/javascript">

var pageHost = ((document.location.protocol == "https:") ? "https://" : "http://");

document.write("<a href='http://www.adobe.com/go/getflashplayer'><img src='"

+ pageHost + "www.adobe.com/images/shared/download_buttons/get_flash_player.gif' alt='Get Adobe Flash player' /></a>" );

</script>

<noscript>

<a href="http://www.adobe.com/go/getflashplayer/" style="color:black"><img src="images/ERROR_getFlashPlayer.gif" width="640" height="377" /></a>



</noscript> -->

<script language="javascript">



var queryParameters = new Array();

var flashVars = "";

var tag = "";

var url = "";



window.onload = function ()

{

document.getElementById( 'inputURL' ).value = queryParameters['source'];

document.getElementById('embedField').innerHTML = tag;



for(var i=1 ; i<=10;i++)

{

var ids = String("sel"+i.toString());



document.getElementById( ids ).style.visibility = "hidden";

document.getElementById( ids ).className = "style76";

}



// mark the entry for that index

if(queryParameters['idx'] != "")

{

document.getElementById("td" + queryParameters['idx'] ).className = "style75";

document.getElementById("sel" + queryParameters['idx'] ).style.visibility = "visible";

}



}



function initialise()

{





function getUrlParam( name )

{

name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");

var regexS = "[\\?&]"+name+"=([^&#]*)";

var regex = new RegExp( regexS );

var results = regex.exec( window.location.href );

if( results == null )

return "";

else

return unescape( results[1] );

}



queryParameters['source'] = getUrlParam('source');

queryParameters['type'] = getUrlParam('type');

queryParameters['idx'] = getUrlParam('idx');



if( queryParameters['source'] == "" )

queryParameters['source'] = "rtmp://92.222.119.250/live/englishmovies";



if( queryParameters['type'] == "" )

queryParameters['type'] = "live";



if( queryParameters['idx'] == "" )

queryParameters['idx'] = "2";



flashVars += "&src=";

flashVars += queryParameters['source'];



flashVars += "&autoHideControlBar=";

flashVars += unescape("true");



flashVars += "&streamType=";

flashVars += queryParameters['type'];



flashVars += "&autoPlay=";

flashVars += unescape("true");



flashVars += "&verbose=";

flashVars += "true";



var soFlashVars = {

src: queryParameters['source'],

streamType: queryParameters['type'],

controlBarAutoHide: "true",

controlBarPosition: "bottom"

};



tag = "&lt;object width='640' height='377' id='StrobeMediaPlayback' name='StrobeMediaPlayback' type='application/x-shockwave-flash' classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' &gt;&lt;param name='movie' value='{{ asset('/admin-ui/swfs/StrobeMediaPlayback.swf')}}' /&gt; &lt;param name='quality' value='high' /&gt; &lt;param name='bgcolor' value='#000000' /&gt; &lt;param name='allowfullscreen' value='true' /&gt; &lt;param name='flashvars' value= '"+

flashVars+"'/&gt;&lt;embed src='{{ asset('/admin-ui/swfs/StrobeMediaPlayback.swf')}}' width='640' height='377' id='StrobeMediaPlayback' quality='high' bgcolor='#000000' name='StrobeMediaPlayback' allowfullscreen='true' pluginspage='http://www.adobe.com/go/getflashplayer'   flashvars='"+ flashVars +"' type='application/x-shockwave-flash'&gt; &lt;/embed&gt;&lt;/object&gt;";





var swfVersionStr = "10.3.0";

var xiSwfUrlStr = "{{ asset('/admin-ui/swfs/playerProductInstall.swf')}}";

var params = {};

params.quality = "high";

params.bgcolor = "#000000";

params.allowscriptaccess = "sameDomain";

params.allowfullscreen = "true";

var attributes = {};

attributes.id = "StrobeMediaPlayback";

attributes.name = "StrobeMediaPlayback";

attributes.align = "middle";

swfobject.embedSWF("{{ asset('/admin-ui/swfs/StrobeMediaPlayback.swf')}}", "flashContent", "640", "377", swfVersionStr, xiSwfUrlStr, soFlashVars, params, attributes);

swfobject.createCSS("#flashContent", "display:block;text-align:left;");

}



function playStream()

{

var url = "source=" + document.getElementById('inputURL').value;

var type;



if(document.getElementById('vodCheckbox').checked==true)

type="vod";

else

type="live";



url += ("&type=" + type);



document.getElementById('playBtn').href="videoplayer.html?" + url;



}



function checkbox(type)

{

if(type=="vod")

{

if(document.getElementById('liveCheckbox').checked==true)

{

document.getElementById('liveCheckbox').checked=true;

}

}

if(type=="live")

{

if(document.getElementById('vodCheckbox').checked==true)

{

document.getElementById('vodCheckbox').checked=false;

}

}

}



initialise();



</script>

<script>

jQuery(document).ready(function ($) {



var jssor_1_SlideoTransitions = [

[{b:5500,d:3000,o:-1,r:240,e:{r:2}}],

[{b:-1,d:1,o:-1,c:{x:51.0,t:-51.0}},{b:0,d:1000,o:1,c:{x:-51.0,t:51.0},e:{o:7,c:{x:7,t:7}}}],

[{b:-1,d:1,o:-1,sX:9,sY:9},{b:1000,d:1000,o:1,sX:-9,sY:-9,e:{sX:2,sY:2}}],

[{b:-1,d:1,o:-1,r:-180,sX:9,sY:9},{b:2000,d:1000,o:1,r:180,sX:-9,sY:-9,e:{r:2,sX:2,sY:2}}],

[{b:-1,d:1,o:-1},{b:3000,d:2000,y:180,o:1,e:{y:16}}],

[{b:-1,d:1,o:-1,r:-150},{b:7500,d:1600,o:1,r:150,e:{r:3}}],

[{b:10000,d:2000,x:-379,e:{x:7}}],

[{b:10000,d:2000,x:-379,e:{x:7}}],

[{b:-1,d:1,o:-1,r:288,sX:9,sY:9},{b:9100,d:900,x:-1400,y:-660,o:1,r:-288,sX:-9,sY:-9,e:{r:6}},{b:10000,d:1600,x:-200,o:-1,e:{x:16}}]

];



var jssor_1_options = {

$AutoPlay: true,

$SlideDuration: 800,

$SlideEasing: $Jease$.$OutQuint,

$CaptionSliderOptions: {

$Class: $JssorCaptionSlideo$,

},

$ArrowNavigatorOptions: {

$Class: $JssorArrowNavigator$

},

$BulletNavigatorOptions: {

$Class: $JssorBulletNavigator$

}

};



var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);



//responsive code begin

//you can remove responsive code if you don't want the slider scales while window resizing

function ScaleSlider() {

var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;

if (refSize) {

refSize = Math.min(refSize, 1920);

jssor_1_slider.$ScaleWidth(refSize);

}

else {

window.setTimeout(ScaleSlider, 30);

}

}

ScaleSlider();

$(window).bind("load", ScaleSlider);

$(window).bind("resize", ScaleSlider);

$(window).bind("orientationchange", ScaleSlider);

//responsive code end

});

</script>

@endsection
