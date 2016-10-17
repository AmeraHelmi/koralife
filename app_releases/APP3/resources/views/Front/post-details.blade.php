@extends('front_inc')

@section('title')
@foreach($p_details as $p_detail)
{{$p_detail->title}}
@endforeach
@endsection

@section('content')
<!-- Data
================================================== -->
     @foreach($p_details as $p_detail)
<main class="container ">
  <!--start of middle sec-->

  <div class="row data">
    <div class="col-sm-8 ">
      <div class="row">

        <div class="col-sm-12">
          <ol class="breadcrumb">
            <li><a href="{{url('/')}}">الصفحة الرئيسية</a></li>
            <li><a href="{{url('/posts')}}">المدونة</a></li>
            <li class="active">{{$p_detail->title}}</li>
          </ol>
        </div>

        <div class="blog-post-body col-sm-12">
          <h3 class="text-primary">
          <a href="{{url('/posts/$p_detail->id')}}">{{$p_detail->title}}</a></h3>
          <p class="text-muted"><span>{{$p_detail->date}} / بواسطة:
          <a href="{{ url('/Allposts',$p_detail->author)}}">{{$p_detail->author}}</a> / القسم:
           <a href="#">{{ $p_detail->Cname}}</a> /{{ $num_comments }} تعليقات</span></p>
          <figure><img alt="{{$p_detail->alt}}" src="../images/uploads/{{$p_detail->flag}}"
          class="img-responsive"></figure>
            <p>{{$p_detail->body}}</p>
        </div>
        <input type="hidden" id="hidden_id" value="{{ $postid }}">
         <input type="hidden" id="hidden_url"    value="{{ $posts }}">
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
              @foreach($posts_meta as $meta)
                     <a href='{{ url("/posts/meta/$meta->meta_words") }}'>{{ $meta->meta_words }}</a> /
               @endforeach
            </div>
            <div class="col-sm-6">
              <ul class="soc pull-left">
                <li><a class="soc-twitter" href="#"><i class="icofont icofont-social-twitter"></i></a></li>
                <li><a class="soc-facebook" href="#"><i class="icofont icofont-social-facebook"></i></a></li>
                <li><a class="soc-google" href="#"><i class="icofont icofont-social-google-plus"></i></a></li>
                <li><a class="soc-pinterest" href="#"><i class="icofont icofont-social-pinterest"></i></a></li>
                <li><a class="soc-linkedin" href="#"><i class="icofont icofont-social-linkedin"></i></a></li>
                <li><a class="soc-rss" href="#"><i class="icofont icofont-social-rss"></i></a></li>
                <li><a class="soc-whatsapp soc-icon-last" href="#"><i class="icofont icofont-social-whatsapp"></i></a></li>
              </ul>
            </div>

          </div>
          <hr>
        </div>

        <!--end of share box & tags-->

        <!--start of comment box-->
        <div class="col-sm-12 comment-box">
          <div class="title">
            <p>كل التعليقات:</p>
          </div>
          <!-- First Comment -->
          <input type="hidden" id="hidden_postid" value="{{ $postid }}">
          <div id="showcomment">
          </div>

          <hr>
        </div>
        <!--end of comment box-->

        <!--start of post shuffle-->
        <div class="col-sm-12 post-shuffle">
          <ul class="list-inline no-padding clearfix">
          @if(count($previous_post_id) > 0)
            <li class="col-sm-6 btn btn-sm btn-primary hvr-underline-from-center-primary ">
            <a href="{{url('/posts',$previous_post_id)}}"> <i class="icofont icofont-long-arrow-right pull-right shuffle-prev"></i>
              <div class="pull-left text-left"> الموضوع السابق
                <h5>الذهاب الى الموضوع السابق</h5>
              </div>
              </a> </li>
              @else
            <li disabled="true" class="col-sm-6 btn btn-sm btn-primary hvr-underline-from-center-primary ">
              <div class="pull-left text-left"> الموضوع السابق
                <h5>لا يوجد مدونات سابقه</h5>
              </div>
           </li>
              @endif

         @if(count($next_post_id) > 0)
            <li   class="col-sm-6 btn btn-sm btn-primary pull-right hvr-underline-from-center-primary pull-left"> <a href="{{url('/posts',$next_post_id)}}"><i class="icofont icofont-long-arrow-left pull-left shuffle-next"></i>
              <div class="pull-right text-right"> الموضوع التالي
                <h5>الذهاب الى الموضوع التالى </h5>
              </div>
              </a> </li>
               @else
            <li disabled="true"   class="col-sm-6 btn btn-sm btn-primary pull-right hvr-underline-from-center-primary pull-left">
              <div class="pull-right text-right"> الموضوع التالي
                <h5>لا يوجد مدونات تاليه </h5>
              </div>
 </li>
               @endif
          </ul>
        </div>
        <!--end of post shuffle-->
        <!--start of add comment-->
        @if($session != '')
        <div class="col-sm-12 add-comment">
 <form method="POST" id="comment-form" class="comment_form" action="{{ url('/post_comment') }}" role="form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="title">
              <p>اترك تعليقا:</p>
           </div>
           <ul class="alerts-list" style="display:none;" id="comment_success">
  <li>
     <div class="alert alert-success alert-dismissable">
           <i class="icon-remove-sign"></i> تم أضافة كومنت بنجـــــــــاح.
       </div>
   </li>
</ul>

<ul class="alerts-list"  style="display:none;" id="comment_error">
  <li>
     <div class="alert alert-danger alert-dismissable">
           <i class="icon-remove-sign"></i> حدث خطأ.
       </div>
   </li>
</ul>
            <div class="row list-unstyled">
              <div class="col-sm-12">
                <label class="control-label" for="comment-body">التعليق<span class="req">*</span></label>
                <textarea class="form-control" rows="5" cols="40" name="comment" id="comment-body" required></textarea>
              </div>
              <div class="col-md-12">
                <button class="btn btn-primary hvr-underline-from-center-primary" id="comment-submit" type="submit">مشاركة</button>
              </div>
            </div>
          </form>
        </div>
        @else
        <h3>login first to comment </h3>
        @endif
        <!--end of add comment-->
      </div>
    </div>
  @include('Front.side-bar')
  </div>

  <!--end of middle sec-->
</main>
 @endforeach
@endsection
@section('scripts')
<script type="text/javascript">
  $(document).ready(function() {
    All_comments();

        $(".comment_form").on('submit', function(e){
        if (!e.isDefaultPrevented())
        {
            var self = $(this);
            $.ajax({
                url: "{{url('/post_comment')}}",
                type: "POST",
                data: self.serialize(),
                success: function(res){
                    $('#comment_success').show();
                    $('#comment_error').hide();
                    $("#comment-body").val('');
                    All_comments();
                },
                error: function(){
                    $('#comment_success').hide();
                    $('#comment_error').show();
                }
            });
            e.preventDefault();
        }
     });

    function All_comments(){
      $postid = $('#hidden_postid').val();
            $.ajax({
                url: "{{ url('get_all_comments') }}",
                type: "GET",
                data: {postid:$postid},
                success: function(res){
                   $('#showcomment').html(res);
                }
            });
}
});
     </script>
@endsection
