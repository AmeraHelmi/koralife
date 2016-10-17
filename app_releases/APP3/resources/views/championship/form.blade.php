<input type="hidden" name="_token" value="{{ csrf_token() }}">
<table>
  <tr>
  <td style="width: 48%">
<div class="form-group">
<label for="exampleInputPassword1">أسم البطوله</label>
<input type="text"
 name="name"
 required
 placeholder="Championship name"
 class="form-control"
>
<span class="help-block with-errors errorName"></span>

</div>
</td>
<td style="width: 48%;  padding-left: 2%;">
<div class="form-group">
<label for="exampleInputFile">أختيار الدوله</label>
<select id="country"  class="form-control"
name="country_id">
<option selected>أختيار الدوله</option>
@foreach($countries as $country_id => $country_name)
<option value="{!! $country_id !!}">{!! $country_name !!}</option>
@endforeach
</select>
</div>
</td>
</tr>

<tr>
<td style="width: 48%">
<div class="form-group">
<label for="exampleInputPassword1">عدد المباريات</label>
<input type="number"
 name="no_matches"
 placeholder="no_matches"
 class="form-control"
>
<span class="help-block with-errors errorName"></span>

</div>
</td>
<td style="width: 48%; padding-left: 2%;">
<div class="form-group">
<label for="exampleInputPassword1">نوع البطوله</label>
<select id="Championshiptype"  class="form-control"
 name="type">
 <option selected>أختار النوع</option>
 <option value="local">محليه</option>
 <option value="world">دوليه</option>
</select>
<span class="help-block with-errors errorName"></span>

</div>
</td>
<tr>
  <td style="width: 48%;">
    <div class="form-group">
    <label for="exampleInputFile">القاره</label>
    <select   class="form-control" name="continent">
    <option selected>أختيار القاره</option>
    <option value="أفريقيا"><bdi>أفريقيا</bdi></option>
    <option value="أوربا"><bdi>أوربا</bdi></option>
    <option value="أمريكا الشماليه"><bdi>أمريكا الشماليه</bdi></option>
    <option value="أمريكا الجنوبيه"><bdi>أمريكا الجنوبيه</bdi></option>
    <option value="أستراليا"><bdi>أستراليا</bdi></option>
    <option value="أسيا"><bdi>أسيا</bdi></option>
    </select>
    </div>
</td>
<td style="width: 48%;padding-left: 2%;">
<div class="form-group">
<label for="exampleInputPassword1">أختار ماركه</label>
<select id="Brand"  class="form-control"
name="ball_id">
@foreach($balls as $ball_id => $brand)
 <option value="{!! $ball_id !!}">{!! $brand !!}</option>
 @endforeach
</select>
<span class="help-block with-errors errorName"></span>

</div>
</td>
</tr>
<tr>
    <td >
      <div class="form-group" style="float: right;">
      <label class="control-label" style="display: block;">عام البطوله</label>
      <input id="datetime2" data-format="YYYY" data-template="YYYY" name="year" value="" type="text">
      </div>
    </td>
  </tr>
</table>

<div class="form-group">
<label for="exampleInputPassword1">معلومات أضافيه عن البطوله</label>
<textarea rows="2" cols="30" name="addition_info" class="form-control" required></textarea>
<span class="help-block with-errors errorName"></span>

</div>
