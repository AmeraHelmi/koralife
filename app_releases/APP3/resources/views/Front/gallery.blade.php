@extends('front_inc')
@section('title')
مكتبة الصور
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
        <li><a href="{{url('/gallary')}}">مكتبة الصور</a></li>
        <li class="active">كل الصور</li>
      </ol>
    </div>
    <div class="col-sm-6 text-left">
      <ul class="nav nav-pills pull-left">
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
 <div class="col-sm-3">
      <p class="pull-left small"><i class="icofont icofont-idea"></i>
          <strong>اجمالى الصور</strong> <span class="text-muted">{{ $imagescount }}صور</span>
      </p>
    </div>
  <div id="load_gif"></div>
  </div>
</div>
    <!-- Gallery Data
================================================== -->
@if($status == 'gallary')
<div class="col-sm-12 photo-gallery gallery-with-loadmore animated fadeIn">
  @if($msg == 'images')
  <div class="row" id="photo">
    <div class="col-sm-12" >
      <div class="row">
        <div class="master-photo box-body col-sm-6">
          <figure class="gallery-box">
            <div class="box">
              <div class="slide"><img class="img-responsive" alt="" src="images/uploads/{{ $first_objs->flag }}"/>
                <div class="overlay"></div>
                <div class="overlay-info">
                   <span class="details-action"><a href="images/uploads/{{ $first_objs->flag }}" class="popup-img">
                     <i class="action-icon icofont icofont-maximize"></i></a></span>
                  <div class="info text-center">
                    <h4 class="text-uppercase">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h4>
                  </div>
                </div>
              </div>
            </div>
          </figure>
        </div>

        <div class="col-sm-6">
          <div class="row">
            @foreach($second_objs as $obj)
            <div class="box-body col-sm-6">
              <figure class="gallery-box">
                <div class="box">
                  <div class="slide"><img class="img-responsive" alt="" src="images/uploads/{{ $obj->flag }}"/>
                    <div class="overlay"></div>
                    <div class="overlay-info"> <span class="details-action"><a href="images/uploads/{{ $obj->flag }}" class="popup-img"><i class="action-icon icofont icofont-maximize"></i></a></span>
                      <div class="info text-center">
                        <h4 class="text-uppercase">{{ $obj->flag }}</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </figure>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
      @if(count($three_objs)>0)
    <div class="col-sm-12">
      <div class="row">
        <div class="col-sm-6">
          <div class="row">
            @foreach($three_objs as $tobj)
            <div class="box-body col-sm-6">
              <figure class="gallery-box">
                <div class="box">
                  <div class="slide"><img class="img-responsive" alt="" src="images/uploads/{{ $tobj->flag }}"/>
                    <div class="overlay"></div>
                    <div class="overlay-info"> <span class="details-action"><a href="images/uploads/{{ $tobj->flag }}" class="popup-img"><i class="action-icon icofont icofont-maximize"></i></a></span>
                      <div class="info text-center">
                        <h4 class="text-uppercase">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </figure>
            </div>

            @endforeach

          </div>
        </div>
        @if(count($forth_objs)>0)
        <div class="master-photo box-body col-sm-6">
          <figure class="gallery-box">
            <div class="box">
              <div class="slide"><img class="img-responsive" alt="" src="images/uploads/{{ $forth_objs->flag }}"/>
                <div class="overlay"></div>
                <div class="overlay-info"> <span class="details-action"><a href="images/uploads/{{ $forth_objs->flag }}" class="popup-img"><i class="action-icon icofont icofont-maximize"></i></a></span>
                  <div class="info text-center">
                    <h4 class="text-uppercase">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h4>
                  </div>
                </div>
              </div>
            </div>
          </figure>
        </div>
        @endif
      </div>
    </div>
    @endif
  </div>
  @else
  <div><p style="text-align:center;">{{ $msg }}</p></div>
  @endif
</div>
@else
<div class="col-sm-12 photo-gallery gallery-with-loadmore animated fadeIn">
  @if($msg == 'images')
  <div class="row" id="photo">
    <div class="col-sm-12" >
      <div class="row">
        <div class="master-photo box-body col-sm-6">
          <figure class="gallery-box">
            <div class="box">
              <div class="slide"><img class="img-responsive" alt="" src="../images/uploads/{{ $first_objs->flag }}"/>
                <div class="overlay"></div>
                <div class="overlay-info">
                   <span class="details-action"><a href="../images/uploads/{{ $first_objs->flag }}" class="popup-img">
                     <i class="action-icon icofont icofont-maximize"></i></a></span>
                  <div class="info text-center">
                    <h4 class="text-uppercase">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h4>
                  </div>
                </div>
              </div>
            </div>
          </figure>
        </div>

        <div class="col-sm-6">
          <div class="row">
            @foreach($second_objs as $obj)
            <div class="box-body col-sm-6">
              <figure class="gallery-box">
                <div class="box">
                  <div class="slide"><img class="img-responsive" alt="" src="images/uploads/{{ $obj->flag }}"/>
                    <div class="overlay"></div>
                    <div class="overlay-info"> <span class="details-action"><a href="images/uploads/{{ $obj->flag }}" class="popup-img"><i class="action-icon icofont icofont-maximize"></i></a></span>
                      <div class="info text-center">
                        <h4 class="text-uppercase">{{ $obj->flag }}</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </figure>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
      @if(count($three_objs)>0)
    <div class="col-sm-12">
      <div class="row">
        <div class="col-sm-6">
          <div class="row">
            @foreach($three_objs as $tobj)
            <div class="box-body col-sm-6">
              <figure class="gallery-box">
                <div class="box">
                  <div class="slide"><img class="img-responsive" alt="" src="images/uploads/{{ $tobj->flag }}"/>
                    <div class="overlay"></div>
                    <div class="overlay-info"> <span class="details-action"><a href="images/uploads/{{ $tobj->flag }}" class="popup-img"><i class="action-icon icofont icofont-maximize"></i></a></span>
                      <div class="info text-center">
                        <h4 class="text-uppercase">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </figure>
            </div>

            @endforeach

          </div>
        </div>
        @if(count($forth_objs)>0)
        <div class="master-photo box-body col-sm-6">
          <figure class="gallery-box">
            <div class="box">
              <div class="slide"><img class="img-responsive" alt="" src="images/uploads/{{ $forth_objs->flag }}"/>
                <div class="overlay"></div>
                <div class="overlay-info"> <span class="details-action"><a href="images/uploads/{{ $forth_objs->flag }}" class="popup-img"><i class="action-icon icofont icofont-maximize"></i></a></span>
                  <div class="info text-center">
                    <h4 class="text-uppercase">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h4>
                  </div>
                </div>
              </div>
            </div>
          </figure>
        </div>
        @endif
      </div>
    </div>
    @endif
  </div>
  @else
  <div><p style="text-align:center">{{ $msg }}</p></div>

  @endif
</div>
@endif

    <!-- Load more
================================================== -->
<div id="remove">
   <div class="col-sm-6 col-lg-offset-3">
     <button class="btn btn-block btn-orange" id="btn_more" data-id="{{ $lastid }}">أظهر المزيد</button>
   </div>
 </div>
  </div>
</main>
@endsection

@section('scripts')
 <script>

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
            $('#remove').remove();
            $('#photo').html(data);
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
        // alert($lastid);
            $.ajax({
               url: "{!!URL::route('gallaryloadmore')!!}",
               type: "POST",
               data:{
                lastid:$lastid
               },
               success: function(data){
                      if(data != ''){
                        $('#remove').remove();
                        $('#photo').append(data);
                      }
                 else{
                    $('#btn_more').html('لأ يوجد بيانات اخرى');
                  }
               },
               error:function(){
                  $('#btn_more').html('لأ يوجد بيانات اخرى');
               },
           });
        });
    });
 </script>
  @endsection
