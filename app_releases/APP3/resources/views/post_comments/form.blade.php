<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="form-group">
<label for="exampleInputFile">المدونه</label>
<select id="country"  class="form-control" name="post_id">
<option selected>المدونه</option>
@foreach($posts as $post_id => $post_name)
<option value="{!! $post_id !!}">{!! $post_name !!}</option>
@endforeach
</select>
</div>
<div class="form-group">
    <label for="exampleInputPassword1">الرد</label>
    <textarea rows="2" cols="30" name="comment" class="form-control" required></textarea>
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label class="control-label" style="display: block;" style="float:right">التاريخ(Year/Month/Day)</label>
    <input id="datetime1" data-format="YYYY-MM-DD" data-template="YYYY / MM / DD" name="date" value="" type="text">
</div>
