<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="form-group">
    <label for="exampleInputFile">أختيار الفريق</label>
    <select id="team_type"  class="form-control" onchange="select_team()">
          <option selected><bdi>أختر الفريق</bdi></option>
          <option value="نادى"><bdi>نادى</bdi></option>
          <option value="منتخب"><bdi>منتخب</bdi></option>
    </select>
</div>

<div class="form-group" >
    <label for="exampleInputFile">نوع البطوله</label>
    <select id="champ_type" name="champ_type"  class="form-control" onchange="select_type()">
          <option value="0"><bdi>نوع البطوله</bdi></option>
          <option value="كأس"><bdi>كأس</bdi></option>
          <option value="دورى"><bdi>دورى</bdi></option>
    </select>
</div>

<div class="form-group" id="group" style="display:none;">
    <label for="exampleInputFile">أختيار المجموعه</label>
    <select  class="form-control" name="group_id">
          <option value="0">أختار المجموعه</option>
          @foreach($groups as $group_id => $group_name)
          <option value="{!! $group_id !!}">{!! $group_name !!}</option>
          @endforeach
    </select>
</div>
<div class="form-group" id="role" style="display:none;">
    <label for="exampleInputPassword1">الدور</label>
    <select  class="form-control" name="role">
            <option value="0">دور المجموعات</option>
            <option value="16">دور ال 16</option>
            <option value="8">دور ال 8</option>
            <option value="4">دور ال 4</option>
            <option value="2">دور النهائى</option>
    </select>
</div>
<div class="form-group">
    <label for="exampleInputFile">أختيار البطوله</label>
    <select  class="form-control" name="champion_id">
          @foreach($championships as $championship_id => $championship_name)
          <option value="{!! $championship_id !!}">{!! $championship_name !!}</option>
          @endforeach
    </select>
</div>
<div class="form-group teams">
    <label>الفرق</label><br />
    {!! Form::select('team_id[]', $teams, null, array('multiple'=> true, 'data-placeholder'=>'Select teams' ,'class'=> 'form-control group-select chosen-select-multiple chosen-select-no-results')) !!}
</div>

<div class="form-group nations">
    <label>الفرق</label><br/>
    {!! Form::select('team_id[]', $nations, null, array('multiple'=> true, 'data-placeholder'=>'Select teams' ,'class'=> 'form-control group-select chosen-select-multiple chosen-select-no-results')) !!}
</div>
