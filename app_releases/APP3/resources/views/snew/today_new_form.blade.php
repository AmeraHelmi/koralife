<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
    <label for="exampleInputFile">اختر الفئة</label>
    <select id="category_id"  class="form-control" name="cat_id" onchange="selectnews()">
          <option selected value="">اختر الفئة</option>
          @foreach($categories as $category_id => $category_name)
          <option value="{!! $category_name !!}">{!! $category_id !!}</option>
          @endforeach
    </select>
</div>

<div class="form-group" style="display:none;" id="shownews">
    <label for="exampleInputFile">اختر الخبر</label>
    <select id="show_news"  class="form-control" name="id" ></select>
</div>
