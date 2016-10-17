<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
<label for="exampleInputFile">أختيار المباراه </label>
<select  class="form-control"  id="match"  name="match_id">
 <option selected>أختيار المباراه</option>
 @foreach($matches as $key=>$value)
  <option value="{!! $value['matchid'] !!}">{!! $value['team1_name'] !!} - {!! $value['team2_name'] !!}</option>
  @endforeach
</select>
</div>
<div class="form-group">
<label for="exampleInputPassword1">لحظه بلحظه</label>
<textarea rows="2" cols="30" name="body" class="form-control"></textarea>
</div>

<div class="form-group">
<label for="exampleInputPassword1">الدقيقه</label>
<input type="number"
  class="form-control"
  name="minute"
  id="min"
  placeholder="minute"
  required
  class="form-control"

  >
    <span class="help-block with-errors errorName"></span>
</div>
