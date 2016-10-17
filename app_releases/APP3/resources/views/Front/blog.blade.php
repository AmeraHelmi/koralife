@extends('front_inc')

@section('title')
المدونه
@endsection

@section('content')
<!-- Data
================================================== -->
<main class="container ">
  <div class="data row">
    <!-- Breadcrumb
================================================== -->
    <div class="col-sm-12">
          <ol class="breadcrumb">
            <li><a href="{{url('/')}}">الصفحة الرئيسية</a></li>
            <li class="active">ع الناصيه </li>
          </ol>
    </div>
    <!-- Blog Data
================================================== -->
<div class="col-sm-12">
  <div id="grid" class="row"  data-columns>
    <div>
      <?php $count = 0 ; ?>
       @foreach($blogs as $blog)
        <?php $count++; ?>
          <div class="blog-post-body col-sm-12">
            <div class="bordered-content">
              <h3 class="text-uppercase"><a href="{{ url('/blogs',$blog->id) }}">{{$blog->title}}</a></h3>

               <a href="{{ url('/blogs',$blog->id) }}">
                <figure>
              <div  class="vid-box">
                <i class="icofont icofont-ui-play"></i>
               <img class="img-responsive" alt="" src="{{ asset('images/uploads/'.$blog->flag)}}"> </div>
            </figure>
            </a>

              <div class="box-sub-info box-sub-info-bordered">
                <ul class="list-inline no-padding-right text-primary row">
                <li class="col-sm-4"><i class="icofont icofont-calendar"></i>{{$blog->date}} </li>
                <li class="col-sm-4"><i class="icofont icofont-eye-alt"></i>{{$blog->likes}} أعجاب</li>
                <li class="col-sm-4"><i class="icofont icofont-speech-comments"></i>{{$blog->author}} الكاتب</li>
                <!-- comments we need to add field to count comments in db  -->
              </ul>
              </div>
              <p>{{$blog->body}}</p>
              <hr>
              <a class="btn btn-primary btn-block hvr-sweep-to-right-primary" href="{{ url('/blogs',$blog->id) }}">استكمل القراءة...</a> </div>
          </div>
          <?php if($count == 3 ){
              echo '</div><div>';
              $count = 0;
          }
          ?>
           @endforeach

     </div>
     </div>
     <div id="remove">
      <div class="col-sm-6 col-lg-offset-3">
        <button class="btn btn-block btn-orange" id="btn_more" data-id="{{ $blog->id  }}">أظهر المزيد</button>
      </div>
     </div>
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
               url: "{!!URL::route('blogloadmore')!!}",
               type: "POST",
               data:{
                lastid:$lastid
               },
               success: function(data){
                      if(data != ''){
                        $('#remove').remove();
                        $('#grid').append(data);
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
