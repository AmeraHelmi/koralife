@extends('kora_app')
@section('content')
<div class="container">
    @foreach($referee_details as $referee_detail)
    <div class="row">
        <div class="col-sm-2 col-md-4" style="float:right;">
            <img style="height:380px; width:360px;" src="../images/uploads/{{ $referee_detail->flag }}"
            alt="" class="img-rounded img-responsive" />
        </div>
        <div class="col-sm-4 col-md-8">
            <blockquote style="text-align: right;">
                <p style="text-align: right !important;">{{ $referee_detail->coache_name }}</p>
                 <small><cite title="Source Title">
                {{ $referee_detail->city_name }}, {{ $referee_detail->country_name }}  
                <i class="glyphicon glyphicon-map-marker"></i></cite>
            </br>
            وظيفته الاساسيه : {{ $referee_detail->job }}
</br>
حكم أول
            </small>
            </blockquote>
             <p style="text-align: justify;">  {{ $referee_detail->info }} </p>  
        </div>
    </div>
    @endforeach
</div>
@endsection