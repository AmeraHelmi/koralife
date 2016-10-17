@extends('kora_app')
	<!-- BANNER -->
	@section('content')
	<div class="section subbanner"style="background:url('{{ asset('/admin-ui/main_images/tickets.jpg')}}') no-repeat center center;background-size: cover;
	height: 300px;">
		<div class="container">
			<div class="row">
				@foreach($newdetails as $newdetail)
				<div class="col-sm-12 col-md-12">
					<div class="caption" style="text-align:right;">{{$newdetail->title}}</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
	<!-- NEWS SECTION -->
	<div class="section singlepage" >
		<div class="container">

			<div class="row pbot-main">

				<div style="text-align: center;" class="col-xs-12 col-md-12">
					@foreach($newdetails as $newdetail)
					<div class="post-item detail">
						<div class="image-wrap">
							<img style="margin: 0px auto;" src="../images/uploads/{{ $newdetail->flag }}" alt="..." class="img-responsive">
						</div>
						<h3 class="post-title">{{ $newdetail->title }}</h3>
						<p>{{ $newdetail->additional_info }}</p>
					</div>
					@endforeach

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
            <img style="width:176px;height:90px;" src="../images/uploads/{{ $sponsor->sponsor_flag }}" alt="" class="img-responsive" />
            </a>
          </div>
        </div>
        @endforeach

			</div>
		</div>
	</div>
@endsection