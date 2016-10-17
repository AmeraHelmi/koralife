<input type="hidden" name="_token" value="{{ csrf_token() }}">
<table>
  <tr>
  <td style="width: 48%">
<div class="form-group">
<label for="exampleInputPassword1">أسم اللاعب</label>
<input type="text"
 name="name"
 required
 placeholder="player name"
 class="form-control"
>
<span class="help-block with-errors errorName"></span>
</div>
</td>

<td style="width: 48%; padding-left: 2%;">
<div class="form-group">
<label for="exampleInputPassword1">اللقب</label>
<input type="text"
 name="nickname"
 placeholder="player nickname"
 class="form-control"
>
<span class="help-block with-errors errorName"></span>
</div>
</td>
</tr>

<tr>
<td style="width: 48%">
<div class="form-group">
<label for="exampleInputPassword1">القدم المفضله</label>
<select  class="form-control"
 name="prefered_foot">
  <option value="Right">يمين</option>
  <option value="Left">يسار</option>
  <option value="Right and Left">الثنين معا</option>
</select>
<span class="help-block with-errors errorName"></span>
</div>
</td>

<td style="width: 48%; padding-left: 2%;">

<div class="form-group">

<label for="exampleInputPassword1">الوزن</label>

<input type="number"

 name="weight"

 min='0'

 max='250'

 required

 placeholder="weight"

 class="form-control"

>

<span class="help-block with-errors errorName"></span>



</div>

</td></tr>

<tr>

<td style="width: 48%">

<div class="form-group">

<label for="exampleInputPassword1">الطول</label>

<input type="number"

 name="height"

 min='0'

 max='250'

 required

 placeholder="height"

 class="form-control"

>



<span class="help-block with-errors errorName"></span>



</div>

</td>

<td style="width: 48%; padding-left: 2%;">

  <div class="form-group">

<label for="exampleInputPassword1">السرعه</label>

<input type="number"

 name="speed"

 min:'0'

 max:'250'

 placeholder="speed"

 class="form-control"

>



<span class="help-block with-errors errorName"></span>



</div>

</td>

</tr>

<tr>

  <td style="width: 48%">

<div class="form-group">

<label for="exampleInputFile">أختيار الدوله</label>

<select id="country2"  class="form-control" onchange="selectCity2()"

 name="country_id">

 <option selected>select country</option>

 @foreach($countries as $country_id => $country_name)

  <option value="{!! $country_id !!}">{!! $country_name !!}</option>

  @endforeach

</select>

</div>

</td>

<td style="width: 48%; padding-left: 2%;">

<div class="form-group" id="show-City"  style="display:none;">

<label for="exampleInputFile">اختيار المدينه</label>

<select  class="form-control"name="city_id" id="cityID2" >

</select>

</div>

</td>

</tr>



<tr>

  <td style="width: 48%">

<div class="form-group">

<label for="exampleInputFile">رقم اللاعب</label>

<input type="number"

 name="num"

 required

 placeholder="Player number"

 class="form-control"

 >

</div>

</td>

<td style="width: 48%; padding-left: 2%;">

<div class="form-group">

<label for="exampleInputFile">أختيار المركز</label>

<select  class="form-control"name="position">

  <option value="حارس مرمى"><bdi>حارس مرمى</bdi> </option>

  <option value="مدافع"><bdi>مدافع</bdi></option>

  <option value="مهاجم"><bdi>مهاجم</bdi></option>

  <option value="خط وسط"><bdi>خط وسط </bdi></option>

  <option value="جناح ايمن"><bdi>جناح ايمن</bdi></option>

  <option value="جناح ايسر"><bdi>جناح ايسر</bdi></option>

</select>

</div>

</td>

</tr>

<tr>

  <td style="width: 48%">

    <div class="form-group">

    <label for="exampleInputFile">النستجرام</label>

    <input type="url"

     name="instagram"

     placeholder="http://"

     class="form-control"

     >

     <span class="help-block with-errors errorName"></span>

    </div>

  </td>

  <td style="width: 48%; padding-left: 2%;">

    <div class="form-group">

    <label for="exampleInputFile">الفيس بوك</label>

    <input type="url"

     name="facebook"

     placeholder="http://"

     class="form-control"

     >

     <span class="help-block with-errors errorName"></span>

     </div>

  </td>

</tr>



<tr>

  <td style="width: 48%;">

    <div class="form-group">

    <label for="exampleInputFile">تويتر</label>

    <input type="url"

     name="twitter"

     placeholder="http://"

     class="form-control"

     >

     <span class="help-block with-errors errorName"></span>

   </div>

  </td>

  <td style="width: 48%; padding-left: 2%;">

<div class="form-group">

<label for="exampleInputPassword1">جنسية اللاعب</label>

<input type="text"

 name="nationality"



 placeholder="player nationality"

 class="form-control"

>



<span class="help-block with-errors errorName"></span>



</div>

</td>

</tr>



</table>

<div class="form-group">

<label class="control-label" style="display: block;">تاريخ ميلاده(Year/Month/Day)</label>

<input id="datetime12" data-format="YYYY-MM-DD" data-template="YYYY / MM / DD" name="birth_date" value="" type="text">

</div>

<div class="form-group">
<label for="exampleInputPassword1">المنتخب</label>
<select  class="form-control"
 name="team_id">
 @foreach($teams as $team_id => $team_name)
  <option value="{!! $team_id !!}">{!! $team_name !!}</option>
@endforeach
</select>
<span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">

<label for="exampleInputPassword1">معلومات أضافيه</label>

<textarea rows="2" cols="30" name="addition_info" class="form-control"></textarea>

</div>


<div class="fileupload fileupload-new" data-provides="fileupload">

  <span class="btn btn-primary btn-file"><span class="fileupload-new">الصوره</span>

  <span class="fileupload-exists">تغير</span>

  <input type="file" name="flag" /></span>

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
