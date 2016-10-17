<input type="hidden" name="_token" value="{{ csrf_token() }}">
<table>

    <tr>
        <td style="width: 48%">
            <div class="form-group" >
                <label for="exampleInputFile">أختيار الحكم</label>
                <select id="referee"  class="form-control"  name="referee_id">
                      <option selected>أختيار الحكم</option>
                      @foreach($referees as $referee_id => $referee_name)
                      <option value="{!! $referee_id !!}">{!! $referee_name !!}</option>
                      @endforeach
                </select>
            </div>
        </td>

     </tr>

</table>
