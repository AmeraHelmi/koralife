<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="form-group">
    <label for="exampleInputPassword1">عنوان جديد</label>
    <input type="text" class="form-control" name="title" id="title" placeholder="title" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>
<div class="form-group">
    <label for="exampleInputPassword1">تفاصيل الخبر</label>
    <textarea rows="2" cols="30" name="additional_info" class="form-control" required></textarea>
    <span class="help-block with-errors errorName"></span>
</div>
<div class="form-group">
    <label class="control-label" style="display: block;">التاريخ(Year/Month/Day)</label>
    <input id="datetime1" data-format="YYYY-MM-DD" data-template="YYYY / MM / DD" name="date" value="" type="text">
</div>
<div class="form-group">
    <label for="exampleInputFile">اختر الفئة</label>
    <select id="category"  class="form-control" name="cat_id">
          <option selected value="">اختر الفئة</option>
          @foreach($categories as $category_id => $category_name)
          <option value="{!! $category_name !!}">{!! $category_id !!}</option>
          @endforeach
    </select>
</div>
<div class="fileupload fileupload-new" data-provides="fileupload">
    <span class="btn btn-primary btn-file"><span class="fileupload-new">الصوره</span>
    <span class="fileupload-exists">Change</span>
    <input type="file" name="flag"/></span>
    <span class="fileupload-preview"></span>
    <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
</div>
{{-- 
<div class="form-group">
    <label>الكلمات الدلاليه</label><br />
  <input type="text" id="tags2" name="tags"/>
</div> --}}

<div class="form-group" style="display:none;">
    <label for="exampleInputFile">pic path</label>
    <input type="text" name="flag" id="flag" required>
</div>
