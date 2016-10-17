<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="form-group">
    <label for="exampleInputFile">أختيار النادى </label>
    <select  class="form-control"  name="team_id">
        <option selected>Seclect team</option>
        @foreach($teams as $team_id => $team_name)
        <option value="{!! $team_id !!}">{!! $team_name !!}</option>
        @endforeach
    </select>
</div>
