<input type="hidden" name="_token" value="{{ csrf_token() }}">
<table>
    <tr>
        <td style="width: 48%">
            <div class="form-group">
                <label for="exampleInputPassword1">أسم الحكم</label>
                <input type="text" name="name" required placeholder="referee name" class="form-control">
            </div>
        </td>
        <td style="width: 48%; padding-left: 2%;">
            <div class="form-group">
                <label for="exampleInputPassword1">وظيفة الحكم</label>
                <input type="text" name="job" required placeholder="referee job" class="form-control">
            </div>
        </td>
    </tr>
    <tr>
        <td style="width: 48%">
            <div class="form-group" >
                <label for="exampleInputFile">أختيار الدوله</label>
                <select id="country"  class="form-control" onchange="selectCity()" name="country_id">
                      <option selected>أختيار الدوله</option>
                      @foreach($countries as $country_id => $country_name)
                      <option value="{!! $country_id !!}">{!! $country_name !!}</option>
                      @endforeach
                </select>
            </div>
        </td>
        <td style="width: 48%;; padding-left: 2%;">
          <div class="form-group" id="showCity" style="display:none;">
              <label for="exampleInputFile">أختيار المدينه</label>
              <select  class="form-control" name="city_id" id="cityID" >
              </select>
          </div>
       </td>
     </tr>
     <tr>
       <td>
          <div class="form-group">
              <label class="control-label" style="display: block;">تاريخ الميلاد</label>
              <input id="datetime1" data-format="YYYY-MM-DD" data-template="YYYY / MM / DD" name="birth_date" value="" type="text">
          </div>
      </td>
    </tr>
</table>
<div class="form-group">
    <label for="exampleInputPassword1">الدور</label>
    <select  class="form-control" name="role">
          <option value="حكم 1"><bdi>حكم 1</bdi></option>
          <option value="حكم 2"><bdi>حكم 2</bdi></option>
          <option value="حكم 3"><bdi>حكم 3</bdi></option>
          <option value="حكم 4"><bdi>حكم 4</bdi></option>
          <option value="حكم 5"><bdi>حكم 5</bdi></option>
    </select>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">معلومات أضافيه</label>
    <textarea rows="2" cols="30" name="additional_info" class="form-control"></textarea>
</div>

<div class="fileupload fileupload-new" data-provides="fileupload">
    <span class="btn btn-primary btn-file"><span class="fileupload-new">الصوره</span>
    <span class="fileupload-exists">تغير</span>
    <input type="file" name="flag" required /></span>
    <span class="fileupload-preview"></span>
    <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
</div>

<div class="form-group" style="display:none;">
    <label for="exampleInputFile">pic path</label>
    <input type="text" name="flagcountry" id="flag">
</div>
