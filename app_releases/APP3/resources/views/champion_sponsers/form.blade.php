<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
    <label for="exampleInputFile">أختيار البطوله</label>
    <select  class="form-control" name="championship_id">
        @foreach($championships as $championship_id => $championship_name)
        <option value="{!! $championship_id !!}">{!! $championship_name !!}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>الرعاه</label><br />
    {!! Form::select('sponsor_id[]',$sponsors, null, array('multiple'=> true, 'data-placeholder'=>'Select sponsors' ,'class'=> 'form-control group-select chosen-select-multiple ')) !!}
</div>
