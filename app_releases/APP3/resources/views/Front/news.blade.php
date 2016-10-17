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
      @foreach($news as $new)
        <div class="box-body col-sm-12">
          <div class="bordered-content">
            <h3 class="text-uppercase"> <a href="{{url('/news',$new->id)}}">{{$new->title}}</a></h3>
            <a href="{{url('/news',$new->id)}}" >
            <figure> <img class="img-responsive" alt="{{$new->flag}}" src="images/uploads/{{$new->flag}}"> </figure>
            </a>
            <div class="post-header">
              <div class="box-sub-info">
                <ul class="list-inline no-padding-right text-primary row">
                  <li class="col-sm-4"><i class="icofont icofont-calendar"></i>{{$new->date}}</li>
                  <li class="col-sm-4"><i class="icofont icofont-eye-alt"></i>{{$new->likes}} اعجاب</li>
                  <li class="col-sm-4"><i class="icofont icofont-speech-comments"></i>4 تعليقات</li>
                </ul>
                <hr>
              </div>
              <p class="box-desc">{{$new->additional_info}}</p>
              <hr>
              <a href="{{url('/news',$new->id)}}" class="btn btn-orange btn-lg btn-block hvr-sweep-to-right-primary">استكمل القراءة</a> </div>
          </div>
        </div>
            @endforeach
     <div id="remove">
        <div class="col-sm-6 col-lg-offset-3">
          <button class="btn btn-block btn-orange" id="btn_more" data-id="{{ $new->id  }}">أظهر المزيد</button>
        </div>
      </div>
    </div>
    </div>
    </div>
  @include('Front.side-bar')
  </div>
    </div>
</main>

@endsection

@section('scripts')
 <script>

  $(document).ready(function(e) {
  $(document).on('click', '#btn_more', function() {

       $('#btn_more').html('...جارى التحميل');
        $lastid=$(this).data("id");
            $.ajax({
               url: "{!!URL::route('newsloadmore')!!}",
               type: "POST",
               data:{
                lastid:$lastid
               },
               success: function(data){
                      if(data != ''){
                        $('#remove').remove();
                        $('#a').append(data);
                      }
                 else{
                    $('#btn_more').html('لأ يوجد بيانات اخرى');
                   // $('#remove').remove();
                  }
               },
           });
        });
    });
 </script>
  @endsection
