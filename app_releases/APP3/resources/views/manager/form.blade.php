<input type="hidden" name="_token" value="{{ csrf_token() }}">
<table>
  <tr>
  <td style="width: 48%">
<div class="form-group">
<label for="exampleInputPassword1"> الأسم</label>
<input type="text"
 name="name"
 required
 placeholder=" name"
 class="form-control"
>
<span class="help-block with-errors errorName"></span>

</div>
</td>
<td style="width: 48%; padding-left: 2%;">
<div class="form-group">
<label for="exampleInputPassword1">الدور</label>
<input type="text"
 name="role"
 required
 placeholder="role"
 class="form-control"
>
<span class="help-block with-errors errorName"></span>
</div>
</td>
</tr>

<tr>
<td style="width: 48%">
<div class="form-group">
<label for="exampleInputPassword1">الوظيفه</label>
<input type="text"
 name="job"
 required
 placeholder="job"
 class="form-control"
>
<span class="help-block with-errors errorName"></span>

</div>
</td>
<td style="width: 48%; padding-left: 2%;">
<div class="form-group">
<label for="exampleInputPassword1">المرتب</label>
<input type="number"
 name="salary"
 min='0'
 max='2500'
 required
 placeholder="salary"
 class="form-control"
>
<span class="help-block with-errors errorName"></span>

</div>
</td>
</tr>

<tr>
  <td style="width: 48%">
<div class="form-group">
<label for="exampleInputFile">أختر الدوله</label>
<select id="country"  class="form-control" onchange="selectCity()"required
 name="country_id">
 <option selected>اختار دوله</option>
 @foreach($countries as $country_id => $country_name)
  <option value="{!! $country_id !!}">{!! $country_name !!}</option>
  @endforeach
</select>
</div>
</td>
<td style="width: 48%; padding-left: 2%;">
<div class="form-group" id="showCity" style="display:none;">
<label for="exampleInputFile">أختر المدينه</label>
<select  class="form-control" name="city_id" id="cityID" >
</select>
</div>
</td>
</tr>
<tr>
<td style="width: 48%">
<div class="form-group">
<label for="exampleInputPassword1">نوع التعين</label>
<select id="type"  class="form-control" name="type" required>
  <option selected>أختر النوع</option>
  <option value="Elected">منتخب</option>
  <option value="appoint">معين</option>
 </select>
<span class="help-block with-errors errorName"></span>

</div>
</td>
</tr>
</table>
  <div class="fileupload fileupload-new" data-provides="fileupload">
    <span class="btn btn-primary btn-file"><span class="fileupload-new">الصوره</span>
    <span class="fileupload-exists">تغير</span>
            <input type="file" name="flag" required /></span>
    <span class="fileupload-preview"></span>
    <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
  </div>

  <div class="form-group" style="display:none;">
  <label for="exampleInputFile">pic path</label>
  <input type="text"
   name="flagcountry"
   id="flag"
   >
  </div>
<div class="form-group">
<label for="exampleInputPassword1">معلومات اضافيه</label>
<textarea rows="2" cols="30" name="addition_info" class="form-control" required></textarea>
<span class="help-block with-errors errorName"></span>
</div>
