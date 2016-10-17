<input type="hidden" name="_token" value="{{ csrf_token() }}">
<table>
      <tr>
          <td  style="width: 48%">
              <div class="form-group">
                  <label for="exampleInputFile">نادى / منتخب</label>
                  <select id="is_team"  class="form-control" name="is_team">
                          <option selected value="نادى">نادى</option>
                          <option  value="منتخب">منتخب</option>
                  </select>
              </div>
          </td>
          <td style="width: 48% ;padding-left: 2%;">
              <div class="form-group">
                  <label for="exampleInputPassword1">الاسم</label>
                  <input type="text" name="name" required placeholder=" ادخل اسم الفريق" class="form-control">
                  <span class="help-block with-errors errorName"></span>
              </div>
          </td>
        </tr>
        <tr>
            <td style="width: 48%">
                <div class="form-group">
                    <label for="exampleInputPassword1">لقب النادى</label>
                    <input type="text" name="slogan" placeholder="لقب النادى" class="form-control">
                    <span class="help-block with-errors errorName"></span>
                </div>
            </td>
            <td  style="width: 48% ;padding-left: 2%;">
                <div class="form-group">
                    <label for="exampleInputFile">أختيار الدوله</label>
                    <select id="country"  class="form-control" name="country_id">
                            <option selected>أختيار الدوله</option>
                            @foreach($countries as $country_id => $country_name)
                            <option value="{!! $country_id !!}">{!! $country_name !!}</option>
                            @endforeach
                    </select>
                </div>
            </td>
          </tr>
          <tr>
              <td style="width: 48%">
                  <div class="form-group">
                      <label for="exampleInputFile">أختيار الأستاد</label>
                      <select id="stadium"  class="form-control" name="stadium_id">
                            <option selected>أختيار الأستاد</option>
                            @foreach($stadiums as $stadium_id => $stadium_name)
                            <option value="{!! $stadium_id !!}">{!! $stadium_name !!}</option>
                            @endforeach
                      </select>
                  </div>
              </td>
              <td style="width: 48%;padding-left: 2%;">
                  <div class="form-group">
                      <label for="exampleInputFile">القاره</label>
                      <select   class="form-control" name="continent">
                            <option selected>أختيار القاره</option>
                            <option value="أفريقيا"><bdi>أفريقيا</bdi></option>
                            <option value="أوربا"><bdi>أوربا</bdi></option>
                            <option value="أمريكا الشماليه"><bdi>أمريكا الشماليه</bdi></option>
                            <option value="أمريكا الجنوبيه"><bdi>أمريكا الجنوبيه</bdi></option>
                            <option value="أستراليا"><bdi>أستراليا</bdi></option>
                            <option value="أسيا"><bdi>أسيا</bdi></option>
                      </select>
                  </div>
              </td>
            </tr>
            <tr>
                <td style="width: 48%">
                    <div class="form-group">
                        <label for="exampleInputFile">أختيار المدرب</label>
                        <select   class="form-control"name="coach_id">
                                <option selected>أختيار المدرب</option>
                                @foreach($coaches as $coache_id => $coache_name)
                                <option value="{!! $coache_id !!}">{!! $coache_name !!}</option>
                                @endforeach
                        </select>
                    </div>
                </td>
                <td style="width: 48%;padding-left: 2%;">
                    <div class="form-group">
                        <label for="exampleInputFile">أختيار المدير</label>
                        <select   class="form-control"name="manager_id">
                              <option selected>أختيار المدير</option>
                              @foreach($managers as $manager_id => $manager_name)
                              <option value="{!! $manager_id !!}">{!! $manager_name !!}</option>
                              @endforeach
                        </select>
                    </div>
                </td>
            </tr>
        </table>
        <div class="form-group">
            <label for="exampleInputPassword1">تاريخ الفريق</label>
            <textarea rows="2" cols="30"  name="history" class="form-control" ></textarea>
            <span class="help-block with-errors errorName"></span>
        </div>
        <div class="form-group">
            <label class="control-label" style="display: block;">بدايته(Year)</label>
            <input id="datetime12" data-format="YYYY" data-template="YYYY" name="start_date" value="" type="text">
        </div>
        <div class="fileupload fileupload-new" data-provides="fileupload">
            <span class="btn btn-primary btn-file"><span class="fileupload-new">صورة النادى</span>
            <span class="fileupload-exists">تغير</span>
            <input type="file" name="flag" /></span>
            <span class="fileupload-preview"></span>
            <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
        </div>
        <div class="fileupload fileupload-new" data-provides="fileupload">
            <span class="btn btn-primary btn-file"><span class="fileupload-new">صورة للفريق</span>
            <span class="fileupload-exists">تغير</span>
            <input type="file" name="flag2"  /></span>

            <span class="fileupload-preview"></span>
            <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
        </div>
        <div class="form-group" style="display:none;">
            <label for="exampleInputFile">pic path</label>
            <input type="text" name="flagcountry" id="flag" required >
        </div>
        <div class="form-group" style="display:none;">
            <label for="exampleInputFile">pic path</label>
            <input type="text" name="flagcountry" id="flag2">
        </div>
