<input type="hidden" name="_token" value="{{ csrf_token() }}">
<table>
  <tr>
      <div class="form-group">
      <label for="exampleInputFile">اختيار نادى</label>
      <select  class="form-control"name="team_id">
        <option selected>أختيار نادى</option>
        @foreach($teams as $team_id => $team_name)
         <option value="{!! $team_id !!}">{!! $team_name !!}</option>
         @endforeach
      </select>
      </div>
    </tr>
<tr>
  <div class="form-group">
  <label for="exampleInputFile">أختيار مدير</label>
  <select id="coach"  class="form-control"
   name="manager_id">
   <option selected>أختيار مدير</option>
   @foreach($managers as $manager_id => $manager_name)
    <option value="{!! $manager_id !!}">{!! $manager_name !!}</option>
    @endforeach
  </select>
  </div>
</tr>

<tr>
    <td style="width: 48%">
        <div class="form-group">
            <label class="control-label" style="display: block;">من</label>
            <input id="datetime1" data-format="YYYY-MM-DD" data-template="YYYY / MM / DD" name="from_date" value="" type="text">
        </div>
        <input type="checkbox" name="present[]" id="present" value="asd" onclick="toggle_todate()"> حتى الأن

    </td>
    <td style="width: 48%; padding-left: 2%;" >
        <div class="form-group" id="td_to">
            <label class="control-label" style="display: block;">الى</label>
            <input id="datetime2" data-format="YYYY-MM-DD" data-template="YYYY / MM / DD" name="to_date" value="" type="text">
        </div>
    </td>
</tr>
<tr>
  <td style="width: 48%">
    <div class="form-group">
    <label for="exampleInputPassword1">عقد</label>
    <input type="number"
     name="contract"

     placeholder="contract amount"
     class="form-control"
    >

    <span class="help-block with-errors errorName"></span>

    </div>
</td>

</tr>
</table>
<div class="form-group">
<label for="exampleInputPassword1">نبذه عن بطولات المدير مع النادى</label>
<textarea rows="2" cols="30"  name="addition_info" class="form-control" ></textarea>
<span class="help-block with-errors errorName"></span>
</div>
