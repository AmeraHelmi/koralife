@extends('front_inc')

@section('title')
الاخبار
@endsection

@section('content')
<!-- Data
================================================== -->
<main class="container">
  <div class="row data">
    <!-- Breadcrumb
================================================== -->
    <div class="col-sm-12">
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}">الصفحة الرئيسية</a></li>
        <li class="active">كل الأخبار</li>
      </ol>
    </div>
    <!-- News data
================================================== -->
    <div class="col-sm-8 classic-blog">
    <div id="a">
      <div class="row">
      @foreach($get_match_meta as $get_meta)
        <div class="box-body col-sm-12">
          <div class="bordered-content">
            <h3 class="text-uppercase"> <a href="{{url('/news',$get_meta->id)}}">{{$get_meta->title}}</a></h3>
            <a href="{{url('/news',$get_meta->id)}}" >
            <figure> <img class="img-responsive" alt="{{$get_meta->flag}}" src="{{ asset('images/uploads/'.$get_meta->flag)}}"> </figure>
            </a>
            <div class="post-header">
              <div class="box-sub-info">
                <ul class="list-inline no-padding-right text-primary row">
                  <li class="col-sm-4"><i class="icofont icofont-calendar"></i>{{$get_meta->date}}</li>
                  <li class="col-sm-4"><i class="icofont icofont-eye-alt"></i>{{$get_meta->likes}} اعجاب</li>
                  <li class="col-sm-4"><i class="icofont icofont-speech-comments"></i>4 تعليقات</li>
                </ul>
                <hr>
              </div>
              <p class="box-desc">{{$get_meta->additional_info}}</p>
              <hr>
              <a href="{{url('/news',$get_meta->id)}}" class="btn btn-orange btn-lg btn-block hvr-sweep-to-right-primary">استكمل القراءة</a> </div>
          </div>
        </div>
            @endforeach
     {{-- <div id="remove">
        <div class="col-sm-6 col-lg-offset-3">
          <button class="btn btn-block btn-orange" id="btn_more" data-id="{{ $get_meta->id  }}">أظهر المزيد</button>
        </div>
      </div> --}}
    </div>
    </div>
    </div>
  @include('Front.side-bar')
  </div>
    </div>
</main>

@endsection

@section('scripts')

  @endsection
