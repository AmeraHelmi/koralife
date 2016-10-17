<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="matchid" value="{{ $matchdetail->match_id }}">
<input type="hidden" name="T1" value="{{ $matchdetail->T1ID }}">
<input type="hidden" name="T2" value="{{ $matchdetail->T2ID }}">
<div class="form-group">
<label for="exampleInputFile">Select team</label>
<select id="teamid1"  class="form-control" onchange="corner()" name="team_id">
 <option selected>select Team</option>
 @foreach($match as  $T)
<option value="{!! $T->T1ID !!}">{!! $T->T1name !!}</option>
<option value="{!! $T->T2ID !!}">{!! $T->T2name !!}</option>
@endforeach
</select>
</div>

<div class="form-group" style="display:none;" id="showplayer3">
<label for="exampleInputFile">Select player</label>
<select id="player_id3"  class="form-control"  name="player_id">
</select>
</div>
