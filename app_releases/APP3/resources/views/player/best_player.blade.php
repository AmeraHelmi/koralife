<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
<label for="exampleInputFile" style="float:right">أختيار الفريق</label>
<select id="team_type"  class="form-control" onchange="select_team()">
  <option selected><bdi>أختر الفريق</bdi></option>
 <option value="نادى"><bdi>نادى</bdi></option>
 <option value="منتخب"><bdi>منتخب</bdi></option>
</select>
</div>
<table>
  <tr>
      <td style="width: 48%">
        <div class="form-group" id="showteam1"  style="display:none;">
        <label for="exampleInputFile" style="float:right">النادى </label>
        <select  class="form-control"name="team1_id" id="team1" onchange="select_player()">
        </select>
        </div>
      </td>
      <!-- retrieve all players -->

      <td style="width: 48%; padding-left: 2%;">
        <div class="form-group" id="showplayer"  style="display:none;">
            <label for="exampleInputFile" style="float:right">اختيار لاعب</label>
            <select  class="form-control" name="player_id" id="player">

            </select>
        </div>
      </td>
</tr>
</table>
