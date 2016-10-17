<input type="hidden" name="_token" value="{{ csrf_token() }}">
<table>

    <tr>
        <td style="width: 48%">
            <div class="form-group" >
                <label for="exampleInputFile">أختيار المدرب</label>
                <select id="coach"  class="form-control"  name="coach_id">
                      <option selected>أختيار المدرب</option>
                      @foreach($coachs as $coach_id => $coach_name)
                      <option value="{!! $coach_id !!}">{!! $coach_name !!}</option>
                      @endforeach
                </select>
            </div>
        </td>

     </tr>

</table>
