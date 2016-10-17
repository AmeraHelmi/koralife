
@extends('front_inc')

@section('title')
الاخبار
@endsection

@section('content')
<!-- Data
================================================== -->
<main class="container ">
  <div class="row data">
    <div class="col-sm-8 ">
      <div class="row">
        <!-- Breadcrumb
================================================== -->
        <div class="col-sm-12">
          <ol class="breadcrumb">
            <li><a href="{{url('/')}}">الصفحة الرئيسية</a></li>
            <li><a href="{{url('/news')}}">الأخبار</a></li>
            <li class="active">تفاصيل الأخبار</li>
          </ol>
        </div>

        <!-- News details data
================================================== -->

        <div class="blog-post-body col-sm-12">
          <h2 class="text-primary">{{$newdetails->title}}</h2>
          <p class="text-muted"><span>{{$newdetails->date}} / القسم: <a href="#">{{$newdetails->Cname}}</a> / <bdi>{{$newdetails->likes}}</bdi> اعجاب</span></p>
          <figure><img alt="" src="../images/uploads/{{$newdetails->flag}}" class="img-responsive"></figure>

          <p>{{$newdetails->additional_info}}</p>
        </div>
         <input type="hidden" id="hidden_id"  value="{{ $newid }}">
         <input type="hidden" id="hidden_url" value="{{ $news }}">
         <!-- like -->
         <button type="button" class="btn btn-primary like" onclick="like()">like</button>
         <!-- dislike -->
         <button type="button" class="btn btn-primary dislike" style="display:none;" onclick="dislike()">dislike</button>
         <div class="col-sm-12 post-tags clearfix">
           <div class="title">
             <p>كلمات دلالية</p>
           </div>
           <div class="row">
             <div class="col-sm-6">
                @foreach($news_meta as $meta)
                       <a href='{{ url("/news/meta/$meta->meta_words") }}'>{{ $meta->meta_words }}</a> /
                 @endforeach
               </div>
             <div class="col-sm-6">
               <ul class="soc pull-left">
                 <li><a class="soc-facebook" href="#"><i class="icofont icofont-social-facebook"></i></a></li>
               </ul>
             </div>

           </div>
           <hr>
         </div>
        <div  class="col-sm-12 post-shuffle">
          <ul class="list-inline no-padding clearfix">
          @if(count($previous_new_id) > 0)
            <li class="col-sm-6 btn btn-sm btn-primary hvr-underline-from-center-primary ">
            <a href="{{url('/news',$previous_new_id)}}"> <i class="icofont icofont-long-arrow-right pull-right shuffle-prev"></i>
              <div class="pull-left text-left"> الخبر السابق
                <h5>الذهاب الى خبر السابق</h5>
              </div>
            </a>
            </li>
              @else
            <li disabled="true" class="col-sm-6 btn btn-sm btn-primary hvr-underline-from-center-primary ">
              <div class="pull-left text-left"> الخبر السابق
                <h5>لا يوجد خبر سابقه</h5>
              </div>
            </li>
              @endif

         @if(count($next_new_id) > 0)
            <li   class="col-sm-6 btn btn-sm btn-primary pull-right hvr-underline-from-center-primary pull-left"> <a href="{{url('/news',$next_new_id)}}"><i class="icofont icofont-long-arrow-left pull-left shuffle-next"></i>
              <div class="pull-right text-right"> الخبر التالي
                <h5>الذهاب الى خبر التالى </h5>
              </div>
              </a> </li>
               @else
            <li disabled="true"   class="col-sm-6 btn btn-sm btn-primary pull-right hvr-underline-from-center-primary pull-left">
              <div class="pull-right text-right"> الخبر التالي
                <h5>لا يوجد خبر تاليه </h5>
              </div>
           </li>
               @endif
          </ul>
        </div>
      </div>
    </div>
@include('Front.side-bar')
  </div>
</main>

@endsection

@section('scripts')

@endsection
