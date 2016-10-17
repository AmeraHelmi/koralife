<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="matchid" value="{{ $matchdetail->match_id }}">
<input type="hidden" name="T1" value="{{ $matchdetail->T1ID }}">
<input type="hidden" name="T2" value="{{ $matchdetail->T2ID }}">
<div class="form-group">
<label for="exampleInputFile">Select team</label>
<select id="teamid2"  class="form-control"  name="team_id">
 <option selected>select Team</option>
 @foreach($match as  $T)
<option value="{!! $T->T1ID !!}">{!! $T->T1name !!}</option>
<option value="{!! $T->T2ID !!}">{!! $T->T2name !!}</option>
@endforeach
</select>
</div>
<div class="form-group">
<label for="exampleInputPassword1">Enter psession percent</label>
<input type="number"
 name="percent"
 required
placeholder="% نسبة الاستحواذ"
 class="form-control"
>

<span class="help-block with-errors errorName"></span>

</div>
