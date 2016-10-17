<input type="hidden" name="_token" value="{{ csrf_token() }}">
<table>
  <tr>
    <td style="width: 48%">
  <div class="form-group">
  <label for="exampleInputFile">أختيار لاعب</label>
  <select id="player"  class="form-control"
   name="player_id">
   <option selected>أختيار لاعب</option>
   @foreach($players as $player_id => $player_name)
    <option value="{!! $player_id !!}">{!! $player_name !!}</option>
    @endforeach
  </select>
  </div>
  </td>
<td style="width: 48%; padding-left: 2%;">
  <div class="form-group">
  <label for="exampleInputFile">أختيار راعى</label>
  <select id="sponsor"  class="form-control"
   name="sponsor_id">
   <option selected>أختيار راعى</option>
   @foreach($sponsors as $sponsor_id => $sponsor_name)
    <option value="{!! $sponsor_id !!}">{!! $sponsor_name !!}</option>
    @endforeach
  </select>
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
    <div class="date">
<label class="control-label">الى</label>
<div class="form-group">
<input id="datetime2" data-format="YYYY-MM-DD" data-template="YYYY / MM / DD" name="to_date" value="" type="text">
</div>
      </div>
  </td>
</tr>
<tr>
  <td style="width: 48%">
  <div class="form-group">
  <label for="exampleInputPassword1">مبلغ</label>
  <input type="number"
   name="amount"
   min=''
   max=''
   required
   placeholder="amount"
   class="form-control"
  >

  <span class="help-block with-errors errorName"></span>

  </div>
  </td>
</tr>
</table>
<div class="form-group">

<label for="exampleInputPassword1">معلومات أضافيه</label>

<textarea rows="2" cols="30" name="addition_info" class="form-control"></textarea>

</div>
