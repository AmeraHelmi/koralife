@extends('kora_app')
@section('styles')

	<link rel='stylesheet' href="{{ asset('/admin-ui/css/ideaboxTimeline.css') }}">
@endsection

@section('content')

	<div class="section subbanner" style="background:url('{{ asset('/admin-ui/main_images/image_5.img.jpg')}}') no-repeat center center;background-size: cover;
height: 300px;">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
				</div>
			</div>
		</div>
	</div>


<div style="width:100%; max-width:960px;background-image: url(../images/pattern2.png) !important; margin:0 auto; padding:0 20px 50px 20px; box-sizing:border-box;">

	<!-- PLUGIN CODE START -->
    <div class="ideaboxTimeline" id="i-timeline">
    	<div class="it-spine"></div>
        <div class="it-minibox"><span>استادات يورو 2016</span></div>
         <div id="a">
  	@foreach($stadiums as $stadium)
  	        <div class="it-box">
        	<div class="it-content">
            	<a href="images/uploads/{{ $stadium->flag }}" class="it-image">
                    <img src="images/uploads/{{ $stadium->flag }}"><span><i></i></span></a>
                <h2 style="text-align: right;">{{ $stadium->name }}</h2>
        		<p style="text-align: right;">{{ $stadium->addition_info }}</p>
            	<div class="it-infobar">
                	<em><bdi>شخص</bdi> {{ $stadium->capacity }} </em><span>:السعة</span>
                    <h3 font-size:15px; style="float: right;" class="it-readmore">الأرض {{ $stadium->ground }}</h3>
                </div>
            </div>
            <div class="it-iconbox">
            	<span></span>
            </div>

        </div>
        @endforeach
           <div id="remove">
            <button style="margin-left:44%; margin-top:3%;" type="button" class="btn btn-success form_control" id="btn_more" data-id="{{ $stadium->id  }}">...تحميل المزيد</button>
            </div>
</div>

    </div>

</div>
	<!-- CLIENT SECTION -->
	<div class="section stat-client p-main bg-client">
		<div class="container">
			<div class="row">
      @foreach($sponsors6 as $sponsor)
        <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
          <div class="client-img">
            <a data-track="N" target="_blank" href="{{ $sponsor->url }}" title="Hyundai" class="sponsor-item-link half-link">
            <img style="width:176px;height:90px;" src="images/uploads/{{ $sponsor->sponsor_flag }}" alt="" class="img-responsive" />
            </a>
          </div>
        </div>
        @endforeach

			</div>
		</div>
	</div>
@endsection
@section('scripts')
<script src="{{ asset('/admin-ui/js/ideaboxTimeline.js') }}"></script>
<script>
	$(document).ready(function(e) {
        $("#i-timeline").ideaboxTimeline();
    });
 </script>
<script>
	$(document).ready(function(e) {

  $(document).on('click', '#btn_more', function() {
                $('#btn_more').html('...جاى التحميل');
				$lastid=$(this).data("id");
        		$.ajax({
	             url: "{!!URL::route('loadmorestadium')!!}",
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
											$('#remove').remove();
	             	  }
	             },
	         });
        });
    });
 </script>
 <script>
	$(document).ready(function(e) {
		$("header span").on("click",function(){
			$(".ideaboxTimeline").removeClass().addClass("ideaboxTimeline it-"+$(this).attr("data-val"));
			$("header span").removeClass();
			$(this).addClass("act");
		});
	});
</script>
 @endsection