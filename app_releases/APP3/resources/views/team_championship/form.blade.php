<input type="hidden" name="_token" value="{{ csrf_token() }}">
<table>
    <tr>
        <td style="width: 48%">
            <div class="form-group">
                <label for="exampleInputFile">Select team</label>
                <select id="team"  class="form-control" name="team_id">
                      <option selected>select team</option>
                      @foreach($teams as $team_id => $team_name)
                      <option value="{!! $team_id !!}">{!! $team_name !!}</option>
                      @endforeach
                </select>
            </div>
        </td>
        <td style="width: 48%; padding-left: 2%;">
            <div class="form-group">
                <label for="exampleInputFile">Select championship</label>
                <select id="championship"  class="form-control" name="championship_id">
                        <option selected>select championship</option>
                        @foreach($championships as $championship_id => $championship_name)
                        <option value="{!! $championship_id !!}">{!! $championship_name !!}</option>
                        @endforeach
                </select>
            </div>
        </td>
  </tr>
  <tr>
      <td style="width: 48%">
          <div class="form-group">
              <label for="exampleInputFile">Select coach</label>
              <select id="coach"  class="form-control" name="coach_id">
                    <option selected>select coach</option>
                    @foreach($coaches as $coach_id => $coach_name)
                    <option value="{!! $coach_id !!}">{!! $coach_name !!}</option>
                    @endforeach
              </select>
          </div>
      </td>
      <td style="width: 48%; padding-left: 2%;">
          <div class="form-group">
              <label for="exampleInputPassword1">no_goals</label>
              <input type="number" name="weight" min='0' max='250' required placeholder="weight" class="form-control">
              <span class="help-block with-errors errorName"></span>
          </div>
      </td>
  </tr>
  <tr>
      <td style="width: 48%">
          <div class="form-group">
              <label for="exampleInputPassword1">amount</label>
              <input type="number" name="amount" min='0' max='250' required placeholder="amount" class="form-control">
              <span class="help-block with-errors errorName"></span>
          </div>
      </td>
  </tr>
</table>
