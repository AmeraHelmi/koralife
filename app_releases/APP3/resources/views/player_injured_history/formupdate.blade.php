<input type="hidden" name="_token" value="{{ csrf_token() }}">
<table>
  <tr>
<div class="form-group">
<label for="exampleInputFile" style="float:right;">اختر المباراة </label>
<select  class="form-control"  id="match2" onchange="selectteam2()"
 name="match_id">
 <option selected>اختر مباراة</option>
 @foreach($matches as $key=>$value)
  <option value="{!! $value['matchid'] !!}">{!! $value['team1_name'] !!} - {!! $value['team2_name'] !!}</option>
  @endforeach
</select>
</div>
</tr>

<tr>
<div class="form-group" id="showteam2"   onchange="selectplayers2()">
<label for="exampleInputFile" style="float:right;">اختر نادى </label>
<select  class="form-control"  name="team_id" id="team_id2" >
</select>
</div>
</tr>

<tr>
<div class="form-group"  id="showplayers2"  style="display: none;">
  <label for="exampleInputFile" style="float:right;">اختر الاعب</label>
  <select  class="form-control" name="player_id" id="player2_id">
  </select>
</div>
</tr>
<tr>
<td style="width: 48%;">
<div class="form-group">
<label for="exampleInputPassword1">طبيعة العلاج</label>
<input type="text"
 name="nature_of_medicine"
 placeholder="nature_of_medicine"
 class="form-control"
 required>
<span class="help-block with-errors errorName"></span>
</div>
</td>
<td style="width: 48%; padding-left: 2%;">
<div class="form-group">
<label for="exampleInputPassword1">أسم الأصابه</label>
<input type="text"
 name="injured_name"
 placeholder="injured_name"
 class="form-control"
 required>
 <span class="help-block with-errors errorName"></span>
</div>
</td>
</tr>
<tr>
  <td style="width: 48%">
    <div class="form-group">
    <label class="control-label" style="display: block;">من</label>
    <input id="datetime1" data-format="YYYY-MM-DD" data-template="YYYY / MM / DD" name="from_date" value="" type="text">
    </div>
  </td>

<td style="width: 48%; padding-left: 2%;">
  <div class="form-group">
  <label class="control-label" style="display: block;">االى</label>
  <input id="datetime2" data-format="YYYY-MM-DD" data-template="YYYY / MM / DD" name="to_date" value="" type="text">
  </div>
</td>
</tr>
<tr>
<td style="width: 48%;">
<div class="form-group">
<label for="exampleInputPassword1">مكان العلاج</label>
<input type="text"
 name="medicine_place"
 placeholder="medicine_place"
 class="form-control"
 required>
 <span class="help-block with-errors errorName"></span>
 </div>
</td>
</tr>
</table>
<div class="form-group">
<label for="exampleInputPassword1">معلومات أضافيه</label>
<textarea rows="2" cols="30" name="addition_info" class="form-control"></textarea>
</div>

