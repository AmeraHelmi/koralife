<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
<td style="width: 48%">
<label for="exampleInputFile">أختر مباراه</label>
<select  class="form-control"  id="match"
 name="match_id">
 @foreach($matches as $key=>$value)

  <option value="{!! $value['matchid'] !!}">{!! $value['team1_name'] !!} - {!! $value['team2_name'] !!}</option>
  @endforeach
</select>
</div>


<div class="form-group">
    <label>الرعاه</label><br />
    {!! Form::select('sponsor_id[]',$sponsors, null, array('multiple'=> true, 'data-placeholder'=>'Select sponsors' ,'class'=> 'form-control group-select chosen-select-multiple ')) !!}
</div>
