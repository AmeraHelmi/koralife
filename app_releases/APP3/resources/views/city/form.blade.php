<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
<label for="exampleInputPassword1">أسم المدينه</label>
<input type="text"
 name="name"
 required
 placeholder="city name"
 class="form-control"
 data-remote-error="city with the same name exists"
 data-remote="{{ url('city/checkname') }}"
>
<span class="help-block with-errors errorName"></span>

</div>
<div class="form-group">
<label for="exampleInputFile">اختيار الدوله</label>
<select  class="form-control"
 name="country_id">
 <option selected>اختار دوله </option>
 @foreach($countries as $country_id => $country_name)
  <option value="{!! $country_id !!}">{!! $country_name !!}</option>
  @endforeach
</select>
</div>
