@extends('kora_app')
@section('content')
<div class="container">
    @foreach($coache_details as $coache_detail)
    <div class="row">
        <div class="col-sm-2 col-md-4" style="float: right;">
            <img style="height:380px; width:360px;" src="../images/uploads/{{ $coache_detail->flag }}"
            alt="" class="img-rounded img-responsive" />
        </div>
        <div class="col-sm-4 col-md-8">
            <blockquote style="text-align: right;">
                <p>{{ $coache_detail->coache_name }}</p>
                 <small><cite title="Source Title">
                {{ $coache_detail->city_name }}, {{ $coache_detail->country_name }}  
                <i class="glyphicon glyphicon-map-marker"></i></cite>
            </br>
                <i class="glyphicon glyphicon-gift"></i> {{ $coache_detail->birth_date }}
            </small>
            </blockquote>
             <p style="text-align: justify;">  {{ $coache_detail->info }} </p>  
        </div>
    </div>
    @endforeach
</div>
@endsection 