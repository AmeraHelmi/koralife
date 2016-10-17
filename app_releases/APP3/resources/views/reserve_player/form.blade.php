<input type="hidden" name="_token" value="{{ csrf_token() }}">
<table>
    <tr>
        <td style="width: 48%">
            <div class="form-group">
                <label for="exampleInputFile" style="float: right;">اختر مباراة </label>
                <select  class="form-control"  id="match" onchange="selectteam()" name="match_id">
                      <option selected>اختر مباراة</option>
                      @foreach($matches as $key=>$value)
                      <option value="{!! $value['matchid'] !!}">{!! $value['team1_name'] !!} - {!! $value['team2_name'] !!}</option>
                      @endforeach
               </select>
            </div>
        </td>
        <td style="width: 48%; padding-left: 2%;">
            <div class="form-group" id="showteam" style="display:none;" onchange="selectplayers()">
              <label for="exampleInputFile" style="float: right;">اختر فريق</label>
              <select  class="form-control"  name="team_id" id="team_id" >
              </select>
            </div>
        </td>
    </tr>
</table>
<div class="form-group"  id="showplayers" style="display:none;"  >
</div>
