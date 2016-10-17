<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
    <td style="width: 48%">
        <label for="exampleInputFile">الوكيل</label>
        <select  class="form-control" name="agent_id">
            @foreach($agents as $agent_id => $agent_name)
            <option value="{!! $agent_id !!}">{!! $agent_name !!}</option>
          @endforeach
        </select>
</div>

<div class="form-group">
    <td style="width: 48%">
        <label for="exampleInputFile">اللاعب</label>
        <select  class="form-control" name="player_id">
            @foreach($players as $player_id => $player_name)
            <option value="{!! $player_id !!}">{!! $player_name !!}</option>
            @endforeach
        </select>
</div>

<div class="form-group">
    <label class="control-label" style="display: block;">من(Year/Month/Day)</label>
    <input id="datetime12" data-format="YYYY-MM-DD" data-template="YYYY / MM / DD" name="from_date" value="" type="text">
</div>

<div class="form-group">
    <label class="control-label" style="display: block;">الى(Year/Month/Day)</label>
    <input id="datetime13" data-format="YYYY-MM-DD" data-template="YYYY / MM / DD" name="to_date" value="" type="text">
</div>
