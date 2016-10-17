@extends('kora_app')

@section('styles')



	<link rel='stylesheet' href="{{ asset('/admin-ui/css/ideaboxTimeline.css') }}">

@endsection



@section('content')



<div class="section subbanner" style="background:url('{{ asset('/admin-ui/main_images/tickets.jpg')}}') no-repeat center center;background-size: cover;

height: 300px;">

	<div class="container">

		<div class="row">

			<div class="col-sm-12 col-md-12">

					<div class="caption" style="text-align:right;">الأخبـــــــــــــــــــــار</div>

			</div>

		</div>

	</div>

</div>





<div style="width:100%; max-width:960px;background-image: url(../images/pattern2.png); margin:0 auto; padding:0 20px 50px 20px; box-sizing:border-box;">



	<!-- PLUGIN CODE START -->

    <div class="ideaboxTimeline" id="i-timeline">

    	<div class="it-spine"></div>

        <div class="it-minibox"><span>2016 يورو</span></div>

        <div id="a">

        @foreach($news as $new)

        <div class="it-box">

        	<div class="it-content">

            	<a href="images/uploads/{{ $new->flag }}" class="it-image">

                    <img src="images/uploads/{{ $new->flag }}"><span><i></i></span></a>

                <h2> <a style="color:#069 !important;" href="{{ url('/Newdetails',$new->id ) }}">{{ $new->title }}</a></h2>

        		<p style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">{{ $new->additional_info }}</p>

            	<div class="it-infobar">

                	<em>{{ $new->date }}</em>

                    <a style="color:#069 !important;" href="{{ url('/Newdetails',$new->id ) }}" class="it-readmore">أقرأ المزيد</a>

                </div>

            </div>

            <div class="it-iconbox">

            	<span></span>

            </div>



        </div>

        @endforeach

            <div id="remove">

            <button style="margin-left:44%; margin-top:3%;" type="button" class="btn btn-success form_control" id="btn_more" data-id="{{ $new->id  }}">...تحميل المزيد</button>

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
	             url: "{!!URL::route('loadmore')!!}",
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