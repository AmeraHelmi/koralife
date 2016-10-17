<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
<td style="width: 48%">
<label for="exampleInputFile">Player</label>
<select  class="form-control"
 name="player_id">
 @foreach($players as $player_id => $player_name)
  <option value="{!! $player_id !!}">{!! $player_name !!}</option>
  @endforeach
</select>
</div>

<div class="form-group">
<td style="width: 48%">
<label for="exampleInputFile">Team</label>
<select  class="form-control"
 name="team_id">
 @foreach($teams as $team_id => $team_name)
  <option value="{!! $team_id !!}">{!! $team_name !!}</option>
  @endforeach
</select>
</div>

<div class="form-group">
<td style="width: 48%">
<label for="exampleInputFile">Referee</label>
<select  class="form-control"
 name="referee_id">
 @foreach($referees as $referee_id => $referee_name)
  <option value="{!! $referee_id !!}">{!! $referee_name !!}</option>
  @endforeach
</select>
</div>

<div class="form-group">
<td style="width: 48%">
<label for="exampleInputPassword1">Time</label>
<input type="datetime"
 name="time"
 required
 placeholder="Time"
 class="form-control"
 data-remote-error="error with the same name exists"
 data-remote="{{ url('error/checkname') }}"
>
<span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
<td style="width: 48%">
<label for="exampleInputPassword1">Comment</label>
<input type="text"
 name="comment"
 required
 placeholder="Comment"
 class="form-control"
 data-remote-error="error with the same name exists"
 data-remote="{{ url('error/checkname') }}"
>
<span class="help-block with-errors errorName"></span>
</div>
