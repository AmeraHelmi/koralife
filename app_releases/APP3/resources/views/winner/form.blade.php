<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
    <label for="exampleInputFile">البطوله</label>
      <select  class="form-control" required name="championship_id">
              <option>أختيار البطوله</option>
              @foreach($championships as $championship_id => $championship_name)
              <option value="{!! $championship_id !!}">{!! $championship_name !!}</option>
              @endforeach
      </select>
</div>
<div class="form-group">
    <label for="exampleInputFile">أختيار الفريق</label>
    <select id="team_type"  class="form-control" onchange="select_team()">
            <option selected><bdi>أختر الفريق</bdi></option>
            <option value="نادى"><bdi>نادى</bdi></option>
            <option value="منتخب"><bdi>منتخب</bdi></option>
    </select>
</div>
<div class="form-group">
    <label for="exampleInputFile"> الفريق </label>
    <select  class="form-control" name="team_id">
            <option selected>Seclect team</option>
            @foreach($teams as $team_id => $team_name)
            <option value="{!! $team_id !!}">{!! $team_name !!}</option>
            @endforeach
    </select>
</div>
<div class="form-group">
    <label class="control-label" style="display: block;">تارخ الفوز(Year/Month/Day)</label>
    <input id="datetime12" data-format="YYYY-MM-DD" data-template="YYYY / MM / DD" name="win_date" value="" type="text">
</div>
<div class="form-group">
    <label for="exampleInputPassword1">عدد الاهداف </label>
    <input type="text" class="form-control" name="no_goals" id="no_goals" placeholder="no_goals" class="form-control">
    <label for="exampleInputPassword1">عدد النقاط</label>
    <input type="text" class="form-control" name="no_points" id="no_points" placeholder="no_points" class="form-control">
</div>
<div class="form-group">
    <label for="exampleInputPassword1">معلومات اضافيه</label>
    <textarea rows="2" cols="30" name="additional_info" class="form-control" ></textarea>
    <span class="help-block with-errors errorName"></span>
</div>
