<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
    <label for="exampleInputFile">أختيار النادى</label>
    <select  class="form-control" name="team_id">
            <option selected>أختيار النادى</option>
            @foreach($teams as $team_id => $team_name)
            <option value="{!! $team_id !!}">{!! $team_name !!}</option>
            @endforeach
    </select>
</div>

<div class="form-group">
    <label>الرعاه</label><br />
    {!! Form::select('sponsor_id[]',$sponsors, null, array('multiple'=> true, 'data-placeholder'=>'Select sponsors' ,'class'=> 'form-control group-select chosen-select-multiple ')) !!}
</div>
