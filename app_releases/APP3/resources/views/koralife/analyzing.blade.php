@extends('kora_app')
@section('styles')
<style>
body{
background: transparent none repeat scroll 0% 0% !important;
}
</style>
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


<main class="wrapper"> 
  <!-- Blog Data
================================================== -->
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="row">


          <div class="box-body col-sm-4">
            <div class="bordered-content">
              <div class="title-icon"><span><img src="images/face.jpg" width="128" height="128" alt=""/></span></div>
              <h3 class="text-uppercase"> <a href="#"> هذا النص يمكن أن يتم تركيبه على أي تصميم دون مشكلة</a></h3>
              <div class="sub-info-bordered btn-box">
                <ul class="list-inline text-primary row">
                  <li class="col-sm-4"><a class="btn btn-sm btn-link btn-block" href="#"><i class="icon-left ion-android-calendar"></i> ٢٢ ديسمبر</a></li>
                  <li class="col-sm-4"><a class="btn btn-sm btn-link btn-block" href="#"><i class="icon-left ion-heart"></i>٢١ اعجاب</a></li>
                  <li class="col-sm-4"><a class="btn btn-sm btn-link btn-block" href="#"><i class="icon-left ion-android-chat"></i>٤ تعليق</a></li>
                </ul>
              </div>
              <p class="box-desc"> هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.</p>
              <hr>
              <a href="../post-details.html" class="btn btn-primary btn-block hvr-sweep-to-right-primary">أكمل القراءة</a> </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</main>
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
 @endsection