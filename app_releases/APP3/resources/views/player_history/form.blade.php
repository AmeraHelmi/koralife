<input type="hidden" name="_token" value="{{ csrf_token() }}">
<table>
  <tr>
    <td style="width: 48%;">
      <div class="form-group">
      <label for="exampleInputFile">أختيار لاعب</label>
      <select  class="form-control" name="player_id">
        <option selected>أختيار لاعب</option>
       @foreach($players as $player_id => $player_name)
        <option value="{!! $player_id !!}">{!! $player_name !!}</option>
        @endforeach
      </select>
      </div>
    </td>


      <td style="width: 48%; padding-left: 2%;">
        <div class="form-group">
        <label for="exampleInputFile">نوع العقد </label>
        <select  class="form-control"  name="contract_type">
          <option selected>Seclect contract</option>
          <option value="أعاره"><bdi>أعاره</bdi></option>
          <option value="أنتقال"><bdi>أنتقال</bdi></option>
        </select>
        </div>
      </td>
</tr>
<tr>
    <td style="width: 48%">
      <div class="form-group">
      <label for="exampleInputFile">من نادى </label>
      <select  class="form-control" name="from_team_id">
        <option selected>Seclect team</option>
       @foreach($teams as $team_id => $team_name)
        <option value="{!! $team_id !!}">{!! $team_name !!}</option>
        @endforeach
      </select>
      </div>
    </td>

    <td style="width: 48%; padding-left: 2%;">
      <div class="form-group">
      <label for="exampleInputFile">الى نادى </label>
      <select  class="form-control" name="to_team_id">
        <option selected>Seclect team</option>
       @foreach($teams as $team_id => $team_name)
        <option value="{!! $team_id !!}">{!! $team_name !!}</option>
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
    <div class="form-group">
    <label class="control-label" style="display: block;">االى</label>
    <input id="datetime2" data-format="YYYY-MM-DD" data-template="YYYY / MM / DD" name="to_date" value="" type="text">
    </div>
  </td>

</tr>
<tr>
  <td style="width: 48%; ">
    <div class="form-group">
    <label for="exampleInputFile">نوع الفصل </label>
    <select  class="form-control"  name="season_type">
      <option selected>اختيار الفصل</option>
      <option value="انتقالات صيفيه"><bdi>انتقالات صيفيه</bdi></option>
      <option value="أنتقالات شتويه"><bdi>أنتقالات شتويه</bdi></option>
    </select>
    </div>
  </td>

  <td style="width: 48%; padding-left: 2%;">
    <div class="form-group">
    <label for="exampleInputPassword1">مبلغ العقد</label>
    <input type="text"
     name="contract_total"
     required
     placeholder="money"
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
