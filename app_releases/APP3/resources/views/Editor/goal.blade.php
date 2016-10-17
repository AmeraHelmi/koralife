<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="matchid" value="{{ $matchdetail->match_id }}">
<input type="hidden" name="T1" value="{{ $matchdetail->T1ID }}">
<input type="hidden" name="T2" value="{{ $matchdetail->T2ID }}">
<div class="form-group">
<label for="exampleInputFile">Select team</label>
<select id="team_id9"  class="form-control" onchange="goal()" name="team_id">
 <option selected>select Team</option>
 @foreach($match as  $T)
<option value="{!! $T->T1ID !!}">{!! $T->T1name !!}</option>
<option value="{!! $T->T2ID !!}">{!! $T->T2name !!}</option>
@endforeach
</select>
</div>
<div class="form-group" style="display:none;" id="showplayer9">
<label for="exampleInputFile">Select player</label>
<select id="player_id9"  class="form-control"  name="player_id">
</select>
</div>
<div class="form-group">
<label for="exampleInputFile">in-team</label>
<select id="inteam_id"  class="form-control"  name="inteam_id">
 <option selected>select Team</option>
 @foreach($match as  $T)
<option value="{!! $T->T1ID !!}">{!! $T->T1name !!}</option>
<option value="{!! $T->T2ID !!}">{!! $T->T2name !!}</option>
@endforeach
</select>
</div>
<div class="form-group">
<label for="exampleInputPassword1">Type</label>
<input type="text"
 name="type"
 required
 placeholder="الجون جه ازاى"
 class="form-control"
>

<span class="help-block with-errors errorName"></span>

</div>

 <div class="form-group">
<label for="exampleInputFile">Select championship</label>
<select  class="form-control" name="championship_id">
 @foreach($championships as $championship_id => $championship_name)
 <option selected>Select championship </option>
  <option value="{!! $championship_id !!}">{!! $championship_name !!}</option>
  @endforeach
</select>
</div>
