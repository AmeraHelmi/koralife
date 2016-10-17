<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="form-group">
    <label for="exampleInputPassword1">اسم الالبوم</label>
    <input type="text" class="form-control" name="title" placeholder="أدخل اسم الالبوم" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>
<div class="form-group">
    <label for="exampleInputFile" style="float: right;">رابط الفيديو</label>
    <input type="url" name="vedio_url" placeholder="http://" class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>
<div class="form-group">
    <label for="exampleInputFile">اختر الفئة</label>
    <select id="category"  class="form-control" name="category_id">
          <option selected value="">اختر الفئة</option>
          @foreach($categories as $category_id => $category_name)
          <option value="{!! $category_name !!}">{!! $category_id !!}</option>
          @endforeach
    </select>
</div>
<div class="form-group">
    <label for="exampleInputPassword1">محتوى الفيديو</label>
    <textarea rows="2" cols="30" name="description" class="form-control"></textarea>
</div>
<div class="fileupload fileupload-new" data-provides="fileupload">
    <span class="btn btn-primary btn-file"><span class="fileupload-new">الصوره</span>
    <span class="fileupload-exists">تغير</span>
    <input type="file" name="flag" /></span>
    <span class="fileupload-preview"></span>
    <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
</div>

{{-- <div class="form-group">
    <label>الكلمات الدلاليه</label><br />
  <input type="text" id="tags2" name="tags"/>
</div> --}}
<div class="form-group" style="display:none;">
    <label for="exampleInputFile">pic path</label>
    <input type="text" name="flag" id="flag">
</div>
