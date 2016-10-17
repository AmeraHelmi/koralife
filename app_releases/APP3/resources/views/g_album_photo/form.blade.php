<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
<label for="exampleInputFile"> اختيار الالبوم</label>
<select  class="form-control"
 name="g_album_id"
 id="g_album_id">
 <option selected value="">اختر الالبوم</option>
 @foreach($albums as $g_album_id => $title)
  <option value="{!! $title !!}">{!! $g_album_id !!}</option>
  @endforeach
</select>
</div>

<div class="form-group" style="display:none;">
<label for="exampleInputFile">pic path</label>
<input type="text"
 name="flagcountry"
 id="flag"
 >
</div>
<div class="fileupload fileupload-new" data-provides="fileupload">
  <span class="btn btn-primary btn-file"><span class="fileupload-new">الصور</span>
  <span class="fileupload-exists">Change</span>         <input type="file" name="flag[]" multiple required /></span>

</div>
