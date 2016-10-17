<input type="hidden" name="_token" value="{{ csrf_token() }}">
<table>
    <tr>
        <td style="width: 48%">
            <div class="form-group">
                <label for="exampleInputFile" style="float: right;">اختر مباراة </label>
                <select  class="form-control"  id="match2" onchange="selectteam_update()" name="match_id">
                      @foreach($matches as $key=>$value)
                      <option value="{!! $value['matchid'] !!}">{!! $value['team1_name'] !!} - {!! $value['team2_name'] !!}</option>
                      @endforeach
                </select>
            </div>
        </td>
        <td style="width: 48%; padding-left: 2%;">
            <div class="form-group" id="showteam2" onchange="selectplayers_update()">
                <label for="exampleInputFile" style="float: right;">اختر فريق </label>
                <select  class="form-control"  name="team_id" id="team_id2" >
                </select>
            </div>
        </td>
    </tr>
</table>
<div class="form-group"  id="showplayers2"  >
</div>
