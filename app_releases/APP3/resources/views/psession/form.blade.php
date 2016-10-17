<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="form-group">
    <td style="width: 48%">
        <label for="exampleInputFile">Team</label>
        <select  class="form-control" name="team_id">
            @foreach($teams as $team_id => $team_name)
            <option value="{!! $team_id !!}">{!! $team_name !!}</option>
            @endforeach
        </select>
    </td>
</div>
<div class="form-group">
    <td style="width: 48%">
      <label for="exampleInputFile">Match</label>
      <select  class="form-control"  id="match" name="match_id">
            @foreach($matches as $key=>$value)
            <option value="{!! $value['matchid'] !!}">{!! $value['team1_name'] !!} - {!! $value['team2_name'] !!}</option>
            @endforeach
      </select>
    </td>
</div>
<div class="form-group">
    <td style="width: 48%">
        <label for="exampleInputPassword1">Time</label>
        <input type="time" name="time" required placeholder="time" class="form-control">
        <span class="help-block with-errors errorName"></span>
    </td>
</div>
<div class="form-group">
    <td style="width: 48%">
        <label for="exampleInputPassword1">Percent</label>
        <input type="number" name="percent" required placeholder="percent" class="form-control">
        <span class="help-block with-errors errorName"></span>
    </td>
</div>
