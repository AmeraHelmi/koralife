<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
    <label for="exampleInputFile">البطوله</label>
    <select  class="form-control" required onchange="select_match()" name="championship_id" id="championship_id">
          <option>أختيار البطوله</option>
          @foreach($championships as $championship_id => $championship_name)
          <option value="{!! $championship_id !!}">{!! $championship_name !!}</option>
          @endforeach
    </select>
</div>

<div class="form-group" id="show_match" style="display:none;">
    <label for="exampleInputFile">أختيار المباراه </label>
    <select  class="form-control"  id="match"  name="match_id">
    </select>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">التحليل</label>
    <textarea rows="2" cols="30" name="analysis" class="form-control"></textarea>
</div>

<div class="form-group">
    <label class="control-label" style="display: block;">الوقت(Year/Month/Day   HH:MM PM)</label>
    <input id="datetime12" data-format="YYYY-MM-DD  h:mm a" data-template="YYYY / MM / DD  h:mm a" name="analysis_date" value="" type="text">
</div>
