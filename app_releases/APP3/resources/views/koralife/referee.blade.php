@extends('kora_app')
@section('content')
    <!-- COACH SECTION -->
    <div class="section coach bg-coach">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="page-title">
                        <h2 class="lead">MEET OUR Referees</h2>
                        <div class="border-style"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($referee as $referee)
                <div class="col-sm-12 col-md-3" style="float: right;">
                    <div class="coach-item">
                        <div class="gambar">
     <a href="{{ url('/referee_profile',$referee->id) }}">
      <img style="height: 185px;width: 262.5px;" 
      src="images/uploads/{{ $referee->flag }}" alt="" class="img-responsive">
  </a>
                        </div>
                        <div class="item-body" style="height: 50px; padding-top: 10px;">
                            <div class="name" style="text-align: center;">
                     <a href="{{ url('/referee_profile',$referee->id) }}">
                                {{ $referee->name }}
                    </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
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