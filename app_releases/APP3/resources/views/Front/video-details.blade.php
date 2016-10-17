@extends('front_inc')

@section('title')
@foreach($v_details as $v_detail)
{{$v_detail->title}}
@endforeach
@endsection

@section('content')
<!-- Data
================================================== -->
     @foreach($v_details as $v_detail)
<main class="container ">
  <!--start of middle sec-->

  <div class="row data">
    <div class="col-sm-8 ">
      <div class="row">
        <div class="col-sm-12">
          <ol class="breadcrumb">
            <li><a href="{{url('/')}}">الصفحة الرئيسية</a></li>
            <li><a href="{{url('/vedios')}}">الفيديوهات</a></li>
            <li class="active">{{ $v_detail->title}}</li>
          </ol>
        </div>

        <div class="blog-post-body col-sm-12">
          <h3 class="text-primary"><a href="#">{{$v_detail->title}}</a></h3>
          <p class="text-muted"><span>{{$v_detail->date}} / بواسطة: <a href="#">فريق كورة لايف</a> / القسم: <a href="#">{{ $v_detail->Cname}}</a> /
            <a href="#">{{ $v_detail->like_count}} أعجاب</a></span></p>

          <!-- <figure><img alt="" src="../images/uploads/{{ $v_detail->flag}}" class="img-responsive"></figure> -->
          <div class="embed-responsive embed-responsive-16by9">
   <iframe width="560" height="315" src="{{ $v_detail->vedio_url }}" frameborder="0" allowfullscreen ></iframe>
</div>
          <blockquote>
            <p>{{$v_detail->description }}</p>
          </blockquote>

        </div>
      <input type="hidden"  id="hidden_id" value="{{ $videoid }}">
       <input type="hidden" id="hidden_url" value="{{ $vedios }}">
        <!-- like -->
       <button type="button" class="btn btn-primary like" onclick="like()">like</button>
       <!-- dislike -->
       <button type="button" class="btn btn-primary dislike" style="display:none;" onclick="dislike()">dislike</button>
        <!--start of share box & tags-->

        <div class="col-sm-12 post-tags clearfix">
          <div class="title">
            <p>كلمات دلالية</p>
          </div>
          <div class="row">
            <div class="col-sm-6">
               @foreach($videos_meta as $meta)
                      <a href='{{ url("/vedios/meta/$meta->meta_words") }}'>{{ $meta->meta_words }}</a> /
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

        <!--end of share box & tags-->


        <!--start of post shuffle-->
        <div class="col-sm-12 post-shuffle">
          <ul class="list-inline no-padding clearfix">
              @if(count($previous_vedio_id) > 0)
            <li class="col-sm-6 btn btn-sm btn-primary hvr-underline-from-center-primary "> <a href="{{url('/prevvedio',$previous_vedio_id)}}"> <i class="icofont icofont-long-arrow-right pull-right shuffle-prev"></i>
              <div class="pull-left text-left">
                <h5>الفيديو السابق</h5>
              </div>
              </a> </li>
              @else
              <li disabled="true" class="col-sm-6 btn btn-sm btn-primary hvr-underline-from-center-primary ">
                <div class="pull-left text-left">
                  <h5>الفيديو السابق</h5>
                </div>
             </li>
              @endif
              @if(count($next_vedio_id) > 0)

            <li class="col-sm-6 btn btn-sm btn-primary pull-right hvr-underline-from-center-primary pull-left"> <a href="{{url('nextvedio',$next_vedio_id)}}"><i class="icofont icofont-long-arrow-left pull-left shuffle-next"></i>
              <div class="pull-right text-right">
                <h5>الفيديو التالى</h5>
              </div>
              </a> </li>
              @else
              <li disabled="true"   class="col-sm-6 btn btn-sm btn-primary pull-right hvr-underline-from-center-primary pull-left">
                <div class="pull-right text-right">
                  <h5>الفيديو التالى</h5>
                </div>
   </li>
              @endif
          </ul>
        </div>
        <!--end of post shuffle-->

      </div>
    </div>
@include('Front.side-bar')
  </div>

  <!--end of middle sec-->
</main>
 @endforeach
@endsection

@section('scripts')

@endsection
