<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
    <label for="exampleInputFile">اختر الفئة</label>
    <select id="category_id2"  class="form-control" name="cat_id" onchange="selectnews2()">
          <option selected value="">اختر الفئة</option>
          @foreach($categories as $category_id => $category_name)
          <option value="{!! $category_name !!}">{!! $category_id !!}</option>
          @endforeach
    </select>
</div>

<div class="form-group" style="display:none;" id="shownews2">
    <label for="exampleInputFile">اختر الخبر</label>
    <select id="show_news2"  class="form-control" name="id" ></select>
</div>
