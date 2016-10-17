<input type="hidden" name="_token" value="{{ csrf_token() }}">
<table>
    <tr>
        <td style="width: 48%">
            <div class="form-group">
                <label for="exampleInputFile">Select manager</label>
                <select id="manager"  class="form-control" name="manager_id">
                      <option selected>select manager</option>
                      @foreach($managers as $manager_id => $manager_name)
                      <option value="{!! $manager_id !!}">{!! $manager_name !!}</option>
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
          <div class="date">
              <label class="control-label">win date</label>
              <div class="input-group input-append date" id="datePicker2">
                  <input type="text" class="form-control" name="win_date" required />
                  <span class="input-group-addon add-on"><i class="fa fa-calendar" aria-hidden="true"></i></span>
              </div>
          </div>
      </td>
  </tr>
</table>
