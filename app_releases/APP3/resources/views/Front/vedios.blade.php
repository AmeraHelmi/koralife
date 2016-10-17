@extends('front_inc')

@section('title')
الفيديوهات
@endsection

@section('content')

<!-- Data
================================================== -->
<main class="container ">
  <div class="data row">
    <!-- Breadcrumb
================================================== -->
    <div class="col-sm-12">
      <div class="row">
        <div class="col-sm-6">
          <ol class="breadcrumb">
            <li><a href="{{url('/')}}">الصفحة الرئيسية</a></li>
            <li><a href="{{url('/vedios')}}">الفيديوهات</a></li>
            <li class="active">كل الفيديوهات</li>
          </ol>
        </div>
        <div class="col-sm-6 text-left">
          <ul class="nav nav-pills pull-left">
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
        {{-- <div class="col-sm-3">
          <p class="pull-left small"><i class="icofont icofont-idea"></i>
              <strong>اجمالي الفيديوهات:</strong> <span class="text-muted">{{ count($vedios)}}فيديو</span>
          </p>
        </div> --}}
      <div id="load_gif"></div>
      </div>
    </div>
    <!-- Videos Data
================================================== -->


<div class="col-sm-12">
  <div  class="row" id="a"></div>
  <div id="video-info" class="row hidden_vid">
    @if(count($vedios))
       <?php $count = 0 ; ?>
      @foreach($vedios as $vedio)
      <?php $count++; ?>
    <div class="box-body col-sm-4">
      <div class="bordered padding-all">
        <a class="details" href="{{ url('/vedios',$vedio->id) }}" id="myvedio" >
        <figure title="<h3 class='text-uppercase text-info'>{{ $vedio->title}}
        </h3><p>{{ $vedio->description}}</p>">
          <h3 class="text-uppercase text-info">{{$vedio->title}}</h3>
          <div  class="vid-box">
            <i class="icofont icofont-ui-play"></i>
            <img class="img-responsive" alt="" src="{{ asset('images/uploads/'.$vedio->flag)}}">
          </div>
        </figure>
        </a>
        <div class="box-sub-info">
          <ul class="list-inline no-padding-right text-primary row">
            <li class="col-sm-4">
              <a class="btn btn-sm btn-default btn-block" href="#">
                <i class="icofont icofont-calendar"></i>{{ $vedio->date}}
              </a>
            </li>
            <li class="col-sm-4">
              <a class="btn btn-sm btn-default btn-block" href="#">
                <i class="icofont icofont-eye-alt"></i>{{ $vedio->view_count }} مشاهدة
              </a>
            </li>

            <li class="col-sm-4">
              <a class="btn btn-sm btn-default btn-block" href="#">
                <i class="icofont icofont-speech-comments"></i>{{ $vedio->like_count }} اعجاب
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    @if($count == 6 )
  <div class="col-sm-12 text-center ad"><img class="img-responsive" src="images/uploads/728-90-ad.gif" width="728" height="90" alt=""/></div>
   @endif
      @endforeach
      <div id="remove">
   <div class="col-sm-6 col-lg-offset-3">
     <button class="btn btn-block btn-orange" id="btn_more" data-id="{{ $vedio->id  }}">أظهر فيديوهات أكثر</button>
   </div>
   </div>
    @else
 <div><p style="text-align:center;">لا يوجد فيديوهات</p></div>
 @endif
  </div>
</div>
<!-- Load more
================================================== -->

  </div>
</main>

<!-- Footer
================================================== -->
<footer></footer>
@endsection
@section('scripts')
 <script>
 function filter($cat_id){
     $('#load_gif').show();
      $cat_id=$cat_id;
      $.ajax({
         url: "{{ url('filter') }}",
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
  $(document).ready(function(e) {
    $('#load_gif').hide();
  $(document).on('click', '#btn_more', function() {
       $('#btn_more').html('...جارى التحميل');
        $lastid=$(this).data("id");
            $.ajax({
               url: "{!!URL::route('vediosloadmore')!!}",
               type: "POST",
               data:{
                lastid:$lastid
               },
               success: function(data){
                      if(data != ''){
                        $('#remove').remove();
                        $('#video-info').append(data);
                      }
                 else{
                    $('#btn_more').html('لأ يوجد بيانات اخرى');
                  }
               },
           });
        });
    });
 </script>
  @endsection
