@extends('front_inc')

@section('title')
الصفحه الرئيسيه
@endsection

@section('content')
<!-- Data
================================================== -->
<main class="container">
  <section class="row bg-white">
    <div class="ticker hot-news col-sm-12"> <span class="icn custom-float-one"><i class="icofont icofont-fire-burn"></i></span>
      <ul>
        <li><a href="#"> كرواتيا تسقط أسبانيا وتضعها في نار إيطاليا.. وتركيا تنتظر "معجزة" فوق أنقاض التشيك</a></li>
        <li><a href="#"> كرواتيا تسقط أسبانيا وتضعها في نار إيطاليا.. وتركيا تنتظر "معجزة" فوق أنقاض التشيك</a></li>
        <li><a href="#"> كرواتيا تسقط أسبانيا وتضعها في نار إيطاليا.. وتركيا تنتظر "معجزة" فوق أنقاض التشيك</a></li>
      </ul>
    </div>
    <div class="col-sm-12">
      <div class="row">
        <div class="col-sm-8">
          <div class="row">
            <!--banner-->
            <div class="banner col-sm-12" role="slider">
              <div class="row">
                <div class="no-padding-left col-sm-10">
                  <div id="banner-carousel" class="carousel slide carousel-fade" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <?php $count = -1; ?>
                      @foreach($slider_news as $new)
                        <?php $count++; if($count == 0){?>
                      <li data-target="#banner-carousel" data-slide-to="<?php echo $count; ?>" class="active"></li>
                      <?php }else{?>
                      <li data-target="#banner-carousel" data-slide-to="<?php echo $count; ?>"></li>
                      <?php } ?>
                      @endforeach
                    </ol>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                      <?php $count = -1; ?>
                    @foreach($slider_news as $new)
                      <?php $count++; if($count == 0){?>
                      <div class="item active" data-slide-number="<?php echo $count; ?>">
                      <a href="{{ url('/news',$new->id) }}">
                        <div class="navy-gradient-overlay"></div>
                        <img class="img-responsive" src="{{ asset('images/uploads/'.$new->flag)}}" width="640" height="456" alt=""/>
                      </a>
                        <div class="carousel-caption"><a href="{{ url('/news',$new->id) }}">
                          <h3>{{ $new->additional_info }}</h3>
                          </a></div>
                       </div>
                        <?php }else{?>
                      <div class="item" data-slide-number="<?php echo $count; ?>"> <a href="{{ url('/news',$new->id) }}">
                        <div class="navy-gradient-overlay"></div>
                        <img class="img-responsive" src="{{ asset('images/uploads/'.$new->flag)}}" width="640" height="456" alt=""/> </a>
                        <div class="carousel-caption"><a href="{{ url('/news',$new->id) }}">
                          <h3>{{ $new->additional_info }}</h3>
                          </a></div>
                      </div>
                      <?php } ?>
                    @endforeach
                    </div>
                  </div>
                </div>
                <!-- Wrapper for thumbnails -->
                <div  id="banner-thumbs" class="col-sm-2 hidden-xs">
                  <ul class="list-unstyled row no-gutters">
                    <?php $count = -1; ?>
                  @foreach($slider_news as $new)
                    <?php $count++; if($count == 0){?>
                    <li class="col-sm-12"> <a id="carousel-selector-<?php echo $count; ?>" class="selected" href="javascript:void(0)">
                      <div class="navy-gradient-overlay"></div>
                      <img class="img-responsive" src="{{ asset('images/uploads/'.$new->flag)}}" alt=""/></a> </li>
                        <?php }else{?>
                    <li class="col-sm-12"> <a id="carousel-selector-<?php echo $count; ?>" href="javascript:void(0)">
                      <div class="navy-gradient-overlay"></div>
                      <img class="img-responsive" src="{{ asset('images/uploads/'.$new->flag)}}" alt=""/></a></li>
                      <?php } ?>
                  @endforeach
                  </ul>
                </div>
              </div>
            </div>

            <!---->

            <div class="col-sm-12">
              <div class="row">
                <div class="col-sm-7">
                  <div class="title">
                    <p>خبر اليوم</p>
                    <ul class="menu-filter menu-filter-orange-line nav nav-pills pull-left">
                      <li class="active" role="presentation"><a href="{{ url('/news') }}">الكل</a></li>
                      <?php $count = 0; ?>
                      @foreach($cats as $cat)
                        <?php $count++; ?>
                        <?php if($count <=3){?>
                      <li role="presentation" id="filter"  onclick="filter_today_new({{ $cat->id }})">
                        <a href="javascript:void(0)">
                          {{ $cat->name }}
                        </a>
                      </li>
                      <?php if($count == 3){ ?>
                        <li class="dropdown" role="presentation"> <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icofont icofont-curved-down"></i></a>
                          <ul class="dropdown-menu" data-dropdown-in="flipInY" data-dropdown-out="flipOutY">
                            <?php } ?>
                      <?php }else{ ?>
                            <li id="filter"  onclick="filter_today_new({{ $cat->id }})">
                              <a href="javascript:void(0)">
                                {{ $cat->name }}
                              </a>
                            </li>
                        <?php } ?>
                      @endforeach
                    </ul>
                  </li>
                    <div id="load_gif_news"></div>
                    </ul>
                  </div>

                  <div  class="row" id="today_new"></div>
                  <div class="hidden_today_new">
                  <div class="box-body">
                    <a href="{{url('/news',$news->id)}}" >
                    <figure> <span class="label label-orange">كرة مصرية</span>
                      <div class="navy-gradient-overlay"></div>
                      <img class="img-responsive" alt="" src="{{ asset('images/uploads/'.$news->flag)}}"> </figure>
                    </a>
                    <div class="post-header post-header-today">
                      <div class="labels text-gray"> <span><a href="#">
                        <i class="icofont icofont-clock-time"></i> </a></span>منذ{{ round((StrToTime ( date('Y-m-d H:i:s') )- StrToTime ( $news->created_at )) / ( 60 * 60 )) }}ساعه<span><a href="#">
                        <i class="icofont icofont-speech-comments"></i> <bdi>{{ $news->likes }}</bdi> اعجاب</a></span></div>
                      <h3 class="text-uppercase">
                         <a href="{{url('/news',$news->id)}}">{{ $news->title }}</a></h3>
                      <p class="box-desc">{{ $news->additional_info }}</p>
                    </div>
                  </div>
                </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="title">
                        <p>علي الناصية</p>
                      </div>
                      <div data-type="vimeo" data-video-id="143418951"></div>
                    </div>
                  </div>
                </div>
                <div class="no-padding-left right-bordered col-sm-5">
                  <div class="title">
                    <p>اختيار المحرر</p>
                    <ul class="menu-filter menu-filter-orange-line nav nav-pills pull-left">
                      <li role="presentation"><a href="#">كل الاختيارات</a></li>
                      <li class="dropdown" role="presentation"> <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icofont icofont-curved-down"></i></a>
                        <ul class="dropdown-menu" data-dropdown-in="flipInY" data-dropdown-out="flipOutY">
                          <li><a href="#">العالم العربي</a></li>
                          <li><a href="#">أوروبا</a></li>
                          <li><a href="#">أمريكا</a></li>
                          <li class="divider" role="separator"></li>
                          <li><a href="#">دول آسيا</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                  <div class="med-post progressive-bar"> <a href="#">
                    <figure> <span class="label label-orange">كرة مصرية</span>
                      <div class="navy-gradient-overlay"></div>
                      <img class="img-responsive" src="images/selected-img-1.jpg" alt=""></figure>
                    </a>
                    <div class="post-desc">
                      <div class="labels text-gray"> <span><a href="#"><i class="icofont icofont-clock-time"></i> منذ ٤ ساعات</a></span> <span><a href="#"><i class="icofont icofont-speech-comments"></i>٣٥٠ تعليقا</a></span></div>
                      <h5><a href="#" title="">مروان محسن يتحدث عن عروض الأهلي والزمالك وأبرز منافسيه على لقب هداف </a></h5>
                    </div>
                    <hr>
                  </div>
                  <div class="med-post progressive-bar"> <a href="#">
                    <figure> <span class="label label-orange">كرة مصرية</span>
                      <div class="navy-gradient-overlay"></div>
                      <img class="img-responsive" src="images/selected-img-2.jpg" alt=""></figure>
                    </a>
                    <div class="post-desc">
                      <div class="labels text-gray"> <span><a href="#"><i class="icofont icofont-clock-time"></i> منذ ٤ ساعات</a></span> <span><a href="#"><i class="icofont icofont-speech-comments"></i>٣٥٠ تعليقا</a></span></div>
                      <h5><a href="#" title="">برادلي يتحدث عن كارثة بورسعيد وحلم المونديال وعلاقته بأبوتريكة وصلاح</a></h5>
                    </div>
                    <hr>
                  </div>
                  <div class="med-post progressive-bar"> <a href="#">
                    <figure> <span class="label label-orange">كرة مصرية</span>
                      <div class="navy-gradient-overlay"></div>
                      <img class="img-responsive" src="images/selected-img-3.jpg" alt=""></figure>
                    </a>
                    <div class="post-desc">
                      <div class="labels text-gray"> <span><a href="#"><i class="icofont icofont-clock-time"></i> منذ ٤ ساعات</a></span> <span><a href="#"><i class="icofont icofont-speech-comments"></i>٣٥٠ تعليقا</a></span></div>
                      <h5><a href="#" title="">مارتن يول: أبحث عن أبوتريكة جديد في النادي الأهلي</a></h5>
                      <a class="btn btn-orange btn-block" href="#">المزيد من الأخبار</a> </div>
                    <hr>
                  </div>
                  <div class="subscribe bg-orange text-white">
                    <dl class="subscribe-text padding-all">
                      <dt>تابع الأخبار أولا بأول</dt>
                      <dd>انضم للقائمة البريدية ليصلك
                        كل جديد فورا..</dd>
                    </dl>
                    <div class="form-group form-inline padding-all bg-orange-transparent clearfix">
                      <input type="email" class="form-control pull-right" id="exampleInputEmail1" placeholder="البريد الاليكتروني">
                      <button type="submit" class="btn btn-submit pull-left"> <i class="icofont icofont-paper-plane"></i> </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr>
          {{-- <div class="ad clearfix col-sm-12">
            <div class="ad-label-short text-center pull-right"><span class="rotate">اعلانات</span></div>
            <img class="img-responsive pull-left" src="images/ad-728-90.jpg" alt="" height="90" width="728">
          </div> --}}
        </div>
        <aside class="col-sm-4">
          <div class="bordered padding-all">
            <section>
              <div class="title">
                <p>المباريات</p>
                <span class="pull-left"><a href="#"><i class="icofont icofont-refresh"></i> تحديث البيانات</a></span></div>
              <div class="time-left">
                <div class="counter">
                  <div class="remaining-time">
                    <div id="countdown">
                      <p class="hours">00</p>
                      <p class="timeRefHours count-desc">ساعة</p>
                      <p class="minutes">00</p>
                      <p class="timeRefMinutes count-desc">دقيقة</p>
                      <p class="seconds">00</p>
                      <p class="timeRefSeconds count-desc">ثانية</p>
                    </div>
                  </div>
                </div>
                <div class="remaining-titme-progress">
                  <div class="progress progress-xs">
                    <div class="progress-bar  progress-bar-warning gradient-orange " role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"> <span class="sr-only">60% Complete</span> </div>
                  </div>
                </div>
              </div>
              <div class="upcoming-matches  padding-all">
                <div class="matches-board-wrapper bordered padding-all bg-white">
                  <div id="matches-board" class="owl-carousel">
                    <!--Start loop-->
                    <div class="item text-center">
                      <h6 class="text-default text-center">بطولة أمم أوروبا لكرة القدم</h6>
                      <p class="text-center">10 مباريات - المباراة النهائية</p>
                      <ul class="list-inline no-padding clearfix">
                        <li class="col-sm-5"> <a href="#">
                          <figure><img class="img-responsive" src="images/club-1.jpg" width="95" height="128" alt=""/></figure>
                          <h6 class="text-center">سانتوس</h6>
                          </a> </li>
                        <li class="col-sm-2"><span class="bordered round match-time"><strong>8:30</strong> <span class="small">AM</span></span></li>
                        <li class="col-sm-5"> <a href="#">
                          <figure><img class="img-responsive" src="images/club-2.jpg" width="95" height="128" alt=""/></figure>
                          <h6 class="text-center">سانتاكروز</h6>
                          </a> </li>
                      </ul>
                    </div>
                    <!--End loop-->
                    <div class="item text-center">
                      <h6 class="text-default text-center">بطولة أمريكا الجنوبية لكرة القدم</h6>
                      <p class="text-center">10 مباريات - المباراة النهائية</p>
                      <ul class="list-inline no-padding clearfix">
                        <li class="col-sm-5"> <a href="#">
                          <figure><img class="img-responsive" src="images/club-1.jpg" width="95" height="128" alt=""/></figure>
                          <h6 class="text-center">سانتوس</h6>
                          </a> </li>
                        <li class="col-sm-2"><span class="bordered round match-time"><strong>9:45</strong> <span class="small">PM</span></span></li>
                        <li class="col-sm-5"> <a href="#">
                          <figure><img class="img-responsive" src="images/club-2.jpg" width="95" height="128" alt=""/></figure>
                          <h6 class="text-center">سانتاكروز</h6>
                          </a> </li>
                      </ul>
                    </div>
                    <div class="item text-center">
                      <h6 class="text-default text-center">بطولة أمم أوروبا لكرة القدم</h6>
                      <p class="text-center">10 مباريات - المباراة النهائية</p>
                      <ul class="list-inline no-padding clearfix">
                        <li class="col-sm-5"> <a href="#">
                          <figure><img class="img-responsive" src="images/club-1.jpg" width="95" height="128" alt=""/></figure>
                          <h6 class="text-center">مانشستر</h6>
                          </a> </li>
                        <li class="col-sm-2"><span class="bordered round match-time"><strong>7:00</strong> <span class="small">AM</span></span></li>
                        <li class="col-sm-5"> <a href="#">
                          <figure><img class="img-responsive" src="images/club-2.jpg" width="95" height="128" alt=""/></figure>
                          <h6 class="text-center">برشلونة</h6>
                          </a> </li>
                      </ul>
                    </div>
                  </div>
                  <hr>
                  <p class="no-margin-btm"><a href="#"><i class="icofont icofont-video-cam"></i> قنوات البث المباشر</a></p>
                </div>
                <div class="all-matches">
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs bordered-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">مباريات اليوم</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">أمس</a></li>
                    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">غدا</a></li>
                    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">المباريات الحالية</a></li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="home">
                      <ul class="list-group bg-transparent">
                        <li class="list-group-item">
                          <ul class="list-inline no-padding clearfix ">
                            <li class="col-sm-5"> <a href="#">
                              <figure><img class="img-responsive" src="images/m-logo-1.png"  alt=""/></figure>
                              <h6 class="text-center">برشلونة</h6>
                              </a> </li>
                            <li class="text-center col-sm-2"><span class="match-result label-inverse "><strong>2 - 0</strong></span><span class="small"><a href="#">تفاصيل</a></span></li>
                            <li class="col-sm-5"> <a href="#">
                              <figure><img class="img-responsive" src="images/m-logo-2.png"  alt=""/></figure>
                              <h6 class="text-center">برشلونة</h6>
                              </a> </li>
                          </ul>
                        </li>
                        <li class="list-group-item">
                          <ul class="list-inline no-padding clearfix">
                            <li class="col-sm-5"> <a href="#">
                              <figure><img class="img-responsive" src="images/m-logo-3.png"  alt=""/></figure>
                              <h6 class="text-center">برشلونة</h6>
                              </a> </li>
                            <li class="text-center col-sm-2"><span class="match-result label-inverse "><strong>2 - 0</strong></span><span class="small"><a href="#">تفاصيل</a></span></li>
                            <li class="col-sm-5"> <a href="#">
                              <figure><img class="img-responsive" src="images/m-logo-4.png"  alt=""/></figure>
                              <h6 class="text-center">برشلونة</h6>
                              </a> </li>
                          </ul>
                        </li>
                        <li class="list-group-item">
                          <ul class="list-inline no-padding clearfix">
                            <li class="col-sm-5"> <a href="#">
                              <figure><img class="img-responsive" src="images/m-logo-3.png"  alt=""/></figure>
                              <h6 class="text-center">برشلونة</h6>
                              </a> </li>
                            <li class="text-center col-sm-2"><span class="match-result label-inverse "><strong>2 - 0</strong></span><span class="small"><a href="#">تفاصيل</a></span></li>
                            <li class="col-sm-5"> <a href="#">
                              <figure><img class="img-responsive" src="images/m-logo-4.png"  alt=""/></figure>
                              <h6 class="text-center">برشلونة</h6>
                              </a> </li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="profile">
                      <ul class="list-group bg-transparent">
                        <li class="list-group-item">
                          <ul class="list-inline no-padding clearfix ">
                            <li class="col-sm-5"> <a href="#">
                              <figure><img class="img-responsive" src="images/m-logo-1.png"  alt=""/></figure>
                              <h6 class="text-center">برشلونة</h6>
                              </a> </li>
                            <li class="text-center col-sm-2"><span class="match-result label-inverse "><strong>2 - 0</strong></span><span class="small"><a href="#">تفاصيل</a></span></li>
                            <li class="col-sm-5"> <a href="#">
                              <figure><img class="img-responsive" src="images/m-logo-2.png"  alt=""/></figure>
                              <h6 class="text-center">برشلونة</h6>
                              </a> </li>
                          </ul>
                        </li>
                        <li class="list-group-item">
                          <ul class="list-inline no-padding clearfix">
                            <li class="col-sm-5"> <a href="#">
                              <figure><img class="img-responsive" src="images/m-logo-3.png"  alt=""/></figure>
                              <h6 class="text-center">برشلونة</h6>
                              </a> </li>
                            <li class="text-center col-sm-2"><span class="match-result label-inverse "><strong>2 - 0</strong></span><span class="small"><a href="#">تفاصيل</a></span></li>
                            <li class="col-sm-5"> <a href="#">
                              <figure><img class="img-responsive" src="images/m-logo-4.png"  alt=""/></figure>
                              <h6 class="text-center">برشلونة</h6>
                              </a> </li>
                          </ul>
                        </li>
                        <li class="list-group-item">
                          <ul class="list-inline no-padding clearfix">
                            <li class="col-sm-5"> <a href="#">
                              <figure><img class="img-responsive" src="images/m-logo-3.png"  alt=""/></figure>
                              <h6 class="text-center">برشلونة</h6>
                              </a> </li>
                            <li class="text-center col-sm-2"><span class="match-result label-inverse "><strong>2 - 0</strong></span><span class="small"><a href="#">تفاصيل</a></span></li>
                            <li class="col-sm-5"> <a href="#">
                              <figure><img class="img-responsive" src="images/m-logo-4.png"  alt=""/></figure>
                              <h6 class="text-center">برشلونة</h6>
                              </a> </li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="messages">
                      <ul class="list-group bg-transparent">
                        <li class="list-group-item">
                          <ul class="list-inline no-padding clearfix ">
                            <li class="col-sm-5"> <a href="#">
                              <figure><img class="img-responsive" src="images/m-logo-1.png"  alt=""/></figure>
                              <h6 class="text-center">برشلونة</h6>
                              </a> </li>
                            <li class="text-center col-sm-2"><span class="match-result label-inverse "><strong>2 - 0</strong></span><span class="small"><a href="#">تفاصيل</a></span></li>
                            <li class="col-sm-5"> <a href="#">
                              <figure><img class="img-responsive" src="images/m-logo-2.png"  alt=""/></figure>
                              <h6 class="text-center">برشلونة</h6>
                              </a> </li>
                          </ul>
                        </li>
                        <li class="list-group-item">
                          <ul class="list-inline no-padding clearfix">
                            <li class="col-sm-5"> <a href="#">
                              <figure><img class="img-responsive" src="images/m-logo-3.png"  alt=""/></figure>
                              <h6 class="text-center">برشلونة</h6>
                              </a> </li>
                            <li class="text-center col-sm-2"><span class="match-result label-inverse "><strong>2 - 0</strong></span><span class="small"><a href="#">تفاصيل</a></span></li>
                            <li class="col-sm-5"> <a href="#">
                              <figure><img class="img-responsive" src="images/m-logo-4.png"  alt=""/></figure>
                              <h6 class="text-center">برشلونة</h6>
                              </a> </li>
                          </ul>
                        </li>
                        <li class="list-group-item">
                          <ul class="list-inline no-padding clearfix">
                            <li class="col-sm-5"> <a href="#">
                              <figure><img class="img-responsive" src="images/m-logo-3.png"  alt=""/></figure>
                              <h6 class="text-center">برشلونة</h6>
                              </a> </li>
                            <li class="text-center col-sm-2"><span class="match-result label-inverse "><strong>2 - 0</strong></span><span class="small"><a href="#">تفاصيل</a></span></li>
                            <li class="col-sm-5"> <a href="#">
                              <figure><img class="img-responsive" src="images/m-logo-4.png"  alt=""/></figure>
                              <h6 class="text-center">برشلونة</h6>
                              </a> </li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="settings">
                      <ul class="list-group bg-transparent">
                        <li class="list-group-item">
                          <ul class="list-inline no-padding clearfix ">
                            <li class="col-sm-5">
                              <figure><img class="img-responsive" src="images/m-logo-1.png"  alt=""/></figure>
                              <h6 class="text-center">برشلونة</h6>
                            </li>
                            <li class="text-center col-sm-2"><span class="match-result label-inverse "><strong>2 - 0</strong></span><span class="small"><a href="#">تفاصيل</a></span></li>
                            <li class="col-sm-5">
                              <figure><img class="img-responsive" src="images/m-logo-2.png"  alt=""/></figure>
                              <span>نيويورك سيتي</span> </li>
                          </ul>
                        </li>
                        <li class="list-group-item">
                          <ul class="list-inline no-padding clearfix">
                            <li class="col-sm-5">
                              <figure><img class="img-responsive" src="images/m-logo-3.png"  alt=""/></figure>
                              <h6 class="text-center">برشلونة</h6>
                            </li>
                            <li class="text-center col-sm-2"><span class="match-result label-inverse "><strong>2 - 0</strong></span><span class="small"><a href="#">تفاصيل</a></span></li>
                            <li class="col-sm-5">
                              <figure><img class="img-responsive" src="images/m-logo-4.png"  alt=""/></figure>
                              <h6 class="text-center">برشلونة</h6>
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </section>
            <div class="ad clearfix">
              <div class="ad-label-short text-center pull-right"><span class="rotate">اعلانات</span></div>
              <img class="img-responsive" src="images/ad-300-250.jpg" width="300" height="250" alt=""/></div>
            <div class="ad clearfix">
              <div class="ad-label-short text-center pull-right"><span class="rotate">اعلانات</span></div>
              <img class="img-responsive" src="images/gray-ad.jpg"  alt=""/></div>
          </div>
        </aside>
      </div>
    </div>
  </section>
  <section class="row bg-white ex-top-padding ex-btm-padding">
    <div class="col-sm-12">
      <div class="title">
        <p>فيديوهات</p>
        <ul class="menu-filter menu-filter-orange-line nav nav-pills pull-left">
          <li class="active" role="presentation"><a href="{{ url('/vedios') }}">الكل</a></li>
          <?php $count = 0; ?>
          @foreach($cats as $cat)
            <?php $count++; ?>
            <?php if($count <=3){?>
          <li role="presentation" id="filter"  onclick="filter({{ $cat->id }})">
            <a href="javascript:void(0)">
              {{ $cat->name }}
            </a>
          </li>
          <?php if($count == 3){ ?>
            <li class="dropdown" role="presentation"> <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icofont icofont-curved-down"></i></a>
              <ul class="dropdown-menu" data-dropdown-in="flipInY" data-dropdown-out="flipOutY">
                <?php } ?>
          <?php }else{ ?>
                <li id="filter"  onclick="filter({{ $cat->id }})">
                  <a href="javascript:void(0)">
                    {{ $cat->name }}
                  </a>
                </li>
            <?php } ?>
          @endforeach
        </ul>
      </li>
        </ul>
      </div>

      <!--Videos Box-->
      <div class="row">
        <div class="col-sm-12" role="slider">
          <div class="row">
            <div class="no-padding-left col-sm-8">
              <div id="videos-carousel" class="carousel slide carousel-fade" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                  <?php $count = 3; ?>
                @foreach($vedios as $vedio)
                  <?php $count++; if($count == 4){?>
                  <li data-target="#videos-carousel" data-slide-to="<?php echo $count; ?>" class="active"></li>
                    <?php }else{?>
                  <li data-target="#videos-carousel" data-slide-to="<?php echo $count; ?>"></li>
                  <?php } ?>
                @endforeach
                </ol>
                <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
                  <?php $count = 3; ?>
              @foreach($vedios as $vedio)
                  <?php $count++; if($count == 4){?>
                  <div class="item active" data-slide-number="<?php echo $count; ?>">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe width="560" height="315" src="{{ $vedio->vedio_url }}" frameborder="0" allowfullscreen ></iframe>
                    </div>
                  </div>
                    <?php }else{?>
                  <div class="item" data-slide-number="<?php echo $count; ?>">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe width="560" height="315" src="{{ $vedio->vedio_url }}" frameborder="0" allowfullscreen ></iframe>
                    </div>
                  </div>
                  <?php } ?>
                @endforeach
          </div>
              </div>
            </div>
            <!-- Wrapper for thumbnails -->
            <div  id="videos-thumbs" class="col-sm-4 hidden-xs">
              <ul class="list-unstyled row no-gutters">
                <?php $count = 3; ?>
                @foreach($vedios as $vedio)
                <?php $count++; if($count == 4){?>
                <li> <a id="carousel-selector-<?php echo $count; ?>" class="selected" href="javascript:void(0)">
                  <article class="video-post clearfix">
                    <figure>
                      <div class="navy-gradient-overlay"></div>
                      <img alt="" src="{{ asset('images/uploads/'.$vedio->flag) }}"></figure>
                    <div class="post-right">
                    <h5 class="post-title">{{ $vedio->title }}</h5>
                    </div>
                  </article>
                  </a> </li>
                  <?php }else{?>
                <li> <a id="carousel-selector-<?php echo $count; ?>" href="javascript:void(0)">
                  <article class="video-post clearfix">
                    <figure>
                      <div class="navy-gradient-overlay"></div>
                      <img alt="" src="{{ asset('images/uploads/'.$vedio->flag) }}"></figure>
                    <div class="post-right">
                      <h5 class="post-title">{{ $vedio->title }}</h5>
                    </div>
                  </article>
                  </a>
                 </li>
                  <?php } ?>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="row bg-white ex-top-padding ex-btm-padding">
    <div class="col-sm-3">
      <div class="title">
        <p>ألبوم اللاعبين</p>
      </div>
      <div class="thumbnail"> <img src="images/slide-img-1.jpg" class="img-responsive" alt="">
        <div class="caption">
          <h3>أفضل اللاعبين </h3>
          <p>زين الدين زيدان هو لاعب كرة قدم فرنسي سابق ومدرب نادي ريال مدريد الحالي، اسمه الأصلي هو زين الدين يزيد...</p>
          <p> <a href="#" class="btn btn-inverse" role="button"> اقرأ المزيد</a> </p>
        </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="title">
        <p>أفضل الحكام</p>
      </div>
      <div class="thumbnail"> <img src="images/slide-img-1.jpg" class="img-responsive" alt="">
        <div class="caption">
          <h3>زين الدين زيدان </h3>
          <p>زين الدين زيدان هو لاعب كرة قدم فرنسي سابق ومدرب نادي ريال مدريد الحالي، اسمه الأصلي هو زين الدين يزيد...</p>
          <p> <a href="#" class="btn btn-inverse" role="button">اقرأ المزيد</a> </p>
        </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="title">
        <p>أفضل المدربين</p>
      </div>
      <div class="thumbnail"> <img src="images/slide-img-1.jpg" class="img-responsive" alt="">
        <div class="caption">
          <h3>زين الدين زيدان </h3>
          <p>زين الدين زيدان هو لاعب كرة قدم فرنسي سابق ومدرب نادي ريال مدريد الحالي، اسمه الأصلي هو زين الدين يزيد...</p>
          <p> <a href="#" class="btn btn-inverse" role="button">اقرأ المزيد</a> </p>
        </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="title">
        <p>ألبوم الصور</p>
      </div>
      <div class="thumbnail"> <img src="images/slide-img-1.jpg" class="img-responsive" alt="">
        <div class="caption">
          <h3>زين الدين زيدان </h3>
          <p>زين الدين زيدان هو لاعب كرة قدم فرنسي سابق ومدرب نادي ريال مدريد الحالي، اسمه الأصلي هو زين الدين يزيد...</p>
          <p> <a href="#" class="btn btn-inverse" role="button"> اقرأ المزيد</a> </p>
        </div>
      </div>
    </div>
    <div class="ad clearfix col-sm-8">
      <div class="ad-label-short text-center pull-right"><span class="rotate">اعلانات</span></div>
      <img class="img-responsive pull-left" src="{{ asset('/admin-ui/front_images/ad-728-90.jpg')}}" alt="" height="90" width="728">
    </div>
  </section>
  <section class="row bg-white ex-top-padding ex-btm-padding">
    <div class="col-sm-8">
      <div class="title">
        <p>ألبوم الصور</p>
        <ul class="menu-filter menu-filter-orange-line nav nav-pills pull-left">
          <li class="active" role="presentation"><a href="{{ url('/gallary') }}">الكل</a></li>
          <?php $count = 0; ?>
          @foreach($cats as $cat)
            <?php $count++; ?>
            <?php if($count <=3){?>
          <li role="presentation" id="filter"  onclick="filter({{ $cat->id }})">
            <a href="javascript:void(0)">
              {{ $cat->name }}
            </a>
          </li>
          <?php if($count == 3){ ?>
            <li class="dropdown" role="presentation"> <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icofont icofont-curved-down"></i></a>
              <ul class="dropdown-menu" data-dropdown-in="flipInY" data-dropdown-out="flipOutY">
                <?php } ?>
          <?php }else{ ?>
                <li id="filter"  onclick="filter({{ $cat->id }})">
                  <a href="javascript:void(0)">
                    {{ $cat->name }}
                  </a>
                </li>
            <?php } ?>
          @endforeach
        </ul>
      </li>
        </ul>
      </div>
        <div id="load_gif"></div>
      <div class="row">
        <div class="col-sm-12">
          <div  class="row" id="a"></div>
          <div class="row hidden_vid">
          @foreach($photos as $photo)
            <div class="box-body col-sm-6">
              <figure class="gallery-box">
                <div class="box">
                  <div class="slide"><img class="img-responsive" alt="{{$photo->alt}}" src="{{ asset('images/uploads/'.$photo->flag)}}">
                    <div class="overlay"></div>
                    <div class="overlay-info"> <span class="details-action">
                      <a href="{{ asset('images/uploads/'.$photo->flag)}}" class="popup-img"
                      ><i class="action-icon icofont icofont-maximize"></i>
                    </a></span>
                      <div class="info text-center">
                        <h4 class="text-uppercase">{{ $photo->alt }}</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </figure>
            </div>
          @endforeach
          </div>
          <hr>
        </div>
        <div class="col-sm-12">
          <div class="row">
            <div class="col-sm-12">
              <div class="title">
                <p>أخبار الانتقالات</p>
              </div>
              <!-- <div class="widget-body">
                                            <div class="streamline">
                                                <div class="sl-item sl-primary">
                                                    <div class="sl-content">
                                                        <small class="text-muted">18 مايو </small>
                                                        <p>إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية</p>
                                                    </div>
                                                </div>
                                                <div class="sl-item sl-danger">
                                                    <div class="sl-content">
                                                        <small class="text-muted">18 مايو </small>
                                                        <p>مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع</p>
                                                    </div>
                                                </div>
                                                <div class="sl-item sl-success">
                                                    <div class="sl-content">
                                                       <small class="text-muted">18 مايو </small>
                                                       <p>أبوتريكة ينتقل لنادي يوفنتوس </p>
                                                    </div>
                                                </div>
                                                <div class="sl-item">
                                                    <div class="sl-content">
                                                        <small class="text-muted">18 مايو </small>
                                                        <p>محمد صلاح ينتقل لنادي مانشستر </p>
                                                    </div>
                                                </div>
                                                <div class="sl-item sl-warning">
                                                    <div class="sl-content">
                                                       <small class="text-muted">18 مايو </small>
                                                        <p>محمد صلاح ينتقل لنادي مانشستر </p>
                                                    </div>
                                                </div>
                                                <div class="sl-item">
                                                    <div class="sl-content">
                                                        <small class="text-muted">18 مايو </small>
                                                        <p>محمد صلاح ينتقل لنادي مانشستر </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>-->

              <div class="widget-body">
                <div class="streamline m-l-25">
                @foreach($players as $player)
                  <div class="sl-item p-b-15">
                    <div class="sl-avatar pull-right">
                      <img class="lgi-img" src="{{ asset('images/uploads/'.$player->flag)}}" alt="">
                    </div>
                    <!-- .avatar -->
                    <div class="sl-content m-l-25">
                      <h5 class="m-t-0 m-b-5"> <a href="{{ url('/players',$player->player_id) }}" class="m-r-5 theme-color">{{ $player->player_name }}</a> <small class="text-muted fz-sm">{{ date('d M', strtotime($player->from_date)) }}</small> </h5>
                      <p><span>{{ $player->team2_name }}<bdi>ألى نادى</bdi>{{ $player->team1_name }}<bdi>من نادى</bdi></span><span></bdi>قيمة الصفقة</bdi>{{ $player->contract_total }}</span></p>
                    </div>
                  </div>
                @endforeach
                </div>
                <!-- .streamline -->
              </div>
            </div>
            <!--<div class="col-sm-5">
              <div class="title">
                <p>مع القراء</p>
              </div>
            </div>-->
          </div>
        </div>
      </div>
    </div>
    <aside class="col-sm-4">
      <div class="bordered padding-all">
        <section>
          <div class="title">
            <p>كاريكاتير</p>
          </div>
          <a href="#">
          <figure><img class="img-responsive" src="{{ asset('/admin-ui/front_images/caricature-1.jpg')}}" width="340" height="180" alt=""/></figure>
          </a>
          <hr>
        </section>
        <section>
          <div class="title">
            <p>شارك برأيك</p>
          </div>
          <form  role="form"  method="POST" class="share_opinion" action="{{ url('/share_opinion',$expections->id) }}" data-toggle="validator" >
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <fieldset>
              <legend class="">{{ $expections->question_text }}</legend>
              <div class="radio">
                <label>
                    {{ $expections->ans1 }}
                  <input type="hidden" name="quest_id"  value="{{$expections->id}}">
                  <input type="radio" name="ans" id="ans1" value="ans1">
                  </label>
              </div>
              <div class="radio">
                <label>
                  {{ $expections->ans2 }}
                  <input type="radio" name="ans" id="ans2" value="ans2">
                  </label>
              </div>
              @if($expections->ans3 != "")
              <div class="radio">
                <label>
                  {{ $expections->ans3 }}
                  <input type="radio" name="ans" id="ans3" value="ans3">
                  </label>
              </div>
            @endif
            @if($expections->ans4 != "")
              <div class="radio">
                <label>
                  {{ $expections->ans4 }}
                  <input type="radio" name="ans" id="ans4" value="">
                  </label>
              </div>
            @endif
              <button class="btn btn-primary" id="share" type="submit" data-id="{{$expections->id}}">
              تصويت
              </button>

              <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"> النتائج </button>
              <div class="collapse" id="collapseExample">
                <div class="well"> 1 :
                  <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="{{ $expections->count1}}" aria-valuemin="0" aria-valuemax="100" style="width: {{ round(($expections->count1*100)/($expections->count1 + $expections->count2 + $expections->count3 + $expections->count4)) }}%"> <span class="sr-only">{{ round(($expections->count1*100)/($expections->count1 + $expections->count2 + $expections->count3 + $expections->count4)) }}% Complete (success)</span> </div>
                  </div>
                  2 :
                  <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="{{ $expections->count2 }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ round(($expections->count2*100)/($expections->count1 + $expections->count2 + $expections->count3 + $expections->count4)) }}%"> <span class="sr-only">{{ round(($expections->count2*100)/($expections->count1 + $expections->count2 + $expections->count3 + $expections->count4)) }}% Complete (success)</span> </div>
                  </div>
               @if($expections->ans3 != "")
                  3 :
                  <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ $expections->count3 }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ round(($expections->count3*100)/($expections->count1 + $expections->count2 + $expections->count3 + $expections->count4)) }}%"> <span class="sr-only">{{ round(($expections->count3*100)/($expections->count1 + $expections->count2 + $expections->count3 + $expections->count4)) }}% Complete (success)</span> </div>
                  </div>
                @endif
                @if($expections->ans4 != "")
                   4 :
                   <div class="progress progress-striped active">
                     <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ $expections->count4 }}" aria-valuemin="0" aria-valuemax="100" style="width:{{ round(($expections->count4*100)/($expections->count1 + $expections->count2 + $expections->count3 + $expections->count4)) }}%"> <span class="sr-only">{{ round(($expections->count4*100)/($expections->count1 + $expections->count2 + $expections->count3 + $expections->count4)) }}% Complete (success)</span> </div>
                   </div>
                 @endif
                </div>
              </div>
            </fieldset>
          </form>
        </section>
        <section class="tags">
          <div class="title">
            <p>أهم الوسوم</p>
          </div>
          <a href="#">أهداف</a> <a href="#">كرة مصرية</a> <a href="#">lifestyle</a> <a href="#">feature</a> <a href="#">mountain</a> <a href="#">design</a> <a href="#">restaurant</a> <a href="#">journey</a> <a href="#">classic</a> <a href="#">sunset</a>
          <hr>
          <div class="advertising"><img class="img-responsive" src="{{ asset('/admin-ui/front_images/ad-300-250.jpg')}}" alt="" height="250" width="300"></div>
        </section>
      </div>
    </aside>
  </section>
  <section class="row bg-white ex-top-padding ex-btm-padding">
    <div class="title">
      <p>مع القراء</p>
    </div>
    <div id="from-blog" class="owl-carousel">
      @foreach($posts as $post)
        <div class="item">
        <article class="post clearfix mb-sm-30 bg-lighter">
          <div class="entry-header">
            <div class="post-thumb thumb"> <img src="{{ asset('images/uploads/'.$post->flag)}}" alt="" class="img-responsive img-fullwidth"> </div>
          </div>
          <div class="entry-content p-20 pr-10">
            <div class="entry-meta media mt-0 no-bg no-border">
              <div class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">
                <ul>
                  <li class="font-16 text-white font-weight-600 border-bottom">{{ date('d', strtotime($post->date)) }}</li>
                  <li class="font-12 text-white text-uppercase">{{ date('M', strtotime($post->date)) }}</li>
                </ul>
              </div>
              <div class="media-body pl-15">
                <div class="event-content">
                  <h4 class="entry-title text-white text-uppercase m-0 mt-5"><a href="#">{{ $post->title }}</a></h4>
                  <div class="labels text-gray"> <span><a href="#"><i class="icofont icofont-clip"></i> {{ $post->catname }}</a></span> <span><a href="#"><i class="icofont icofont-speech-comments"></i>{{ $post->comments }} تعليق</a></span></div>
                </div>
              </div>
            </div>
            <p class="mt-10">{{ $post->body }}</p>
            <a href="{{ url('/posts',$post->id) }}" class="btn btn-orange">اقرأ المزيد</a>
            <div class="clearfix"></div>
          </div>
        </article>
      </div>
     @endforeach
    </div>
  </section>
</main>
@endsection
@section('scripts')
 <script>
 $(document).ready(function(e) {
   $('#load_gif').hide();
   $('#load_gif_news').hide();
 });
 function filter($cat_id){
    $('#load_gif').show();
      $cat_id=$cat_id;
      $.ajax({
         url: "{{ url('filter_photos') }}",
         type: "GET",
         data:{
          cat_id:$cat_id
         },
         success: function(data){
             $('.hidden_vid').hide();
             $('#a').html(data);
         },
         complete:function(){
           $('#load_gif').hide();
         },
         error:function(){
         }
     });
 }

 function filter_today_new($cat_id){
    $('#load_gif_news').show();
      $cat_id=$cat_id;
      $.ajax({
         url: "{{ url('filter_today_new') }}",
         type: "GET",
         data:{
          cat_id:$cat_id
         },
         success: function(data){
             $('.hidden_today_new').hide();
             $('#today_new').html(data);
         },
         complete:function(){
           $('#load_gif_news').hide();
         },
         error:function(){
         }
     });
 }

 $(".share_opinion").on('submit', function(e){
     if (!e.isDefaultPrevented())
     {
       var self = $(this);
         $.ajax({
             url: "{{url('/share_opinion')}}",
             type: "POST",
             data: self.serialize(),
             success: function(res){
               $('#share').hide();
               $('#collapseExample').show();
             },
             error: function(){

             }
         });
         e.preventDefault();
     }
  });
 </script>
 @endsection
