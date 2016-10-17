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
       @foreach($get_match_meta as $get_meta)
        <?php $count++; ?>
          <div class="blog-post-body col-sm-12">
            <div class="bordered-content">
              <h3 class="text-uppercase"><a href="{{ url('/blogs',$get_meta->id) }}">{{$get_meta->title}}</a></h3>

               <a href="{{ url('/blogs',$get_meta->id) }}">
                <figure>
              <div  class="vid-box">
                <i class="icofont icofont-ui-play"></i>
               <img class="img-responsive" alt="" src="{{ asset('images/uploads/'.$get_meta->flag)}}"> </div>
            </figure>
            </a>

              <div class="box-sub-info box-sub-info-bordered">
                <ul class="list-inline no-padding-right text-primary row">
                <li class="col-sm-4"><i class="icofont icofont-calendar"></i>{{$get_meta->date}} </li>
                <li class="col-sm-4"><i class="icofont icofont-eye-alt"></i>{{$get_meta->likes}} أعجاب</li>
                <li class="col-sm-4"><i class="icofont icofont-speech-comments"></i>{{$get_meta->author}} الكاتب</li>
              </ul>
              </div>
              <p>{{$get_meta->body}}</p>
              <hr>
              <a class="btn btn-primary btn-block hvr-sweep-to-right-primary" href="{{ url('/blogs',$get_meta->id) }}">استكمل القراءة...</a> </div>
          </div>
          <?php if($count == 3 ){
              echo '</div><div>';
              $count = 0;
          }
          ?>
           @endforeach

     </div>
     </div>
     </div>
     </div>
</main>

@endsection
@section('scripts')
  @endsection
