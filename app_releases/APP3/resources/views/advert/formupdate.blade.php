<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
    <label for="exampleInputPassword1">أسم الأعلان</label>
    <input type="text" class="form-control" name="name" id="advert_name" placeholder="ادخل اسم الاعلان" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>
<div class="form-group">
    <label for="exampleInputFile">الرابط</label>
    <input type="url" name="url" placeholder="http://" class="form-control">
</div>
<div class="form-group" style="display:none;">
    <label for="exampleInputFile">pic path</label>
    <input type="text" name="flagadvert" id="flag" required>
</div>
<div class="fileupload fileupload-new" data-provides="fileupload">
  <span class="btn btn-primary btn-file"><span class="fileupload-new">الصوره</span>
  <span class="fileupload-exists">تغير</span>
  <input type="file" name="flag"/></span>
  <span class="fileupload-preview"></span>
  <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
</div>

<div class="form-group">
<label for="exampleInputFile">اختيار الصفحه</label>
<select  class="form-control" name="page_name" id="page_name2" onchange="advert_place2()">
 <option selected>اختار الصفحه</option>
 <option value="Home">الرئيسيه</option>
 <option value="player">اللاعب</option>
 <option value="coach">المدربين</option>
 <option value="referee">الحكام</option>
 <option value="manager">المديرين</option>
 <option value="news">الاخبار</option>
 <option value="videos">الفيديوهات</option>
 <option value="news_details">تفاصيل الخبر</option>
 <option value="videos_details">تفاصيل الفيديو</option>
 <option value="search_results">نتائج البحث</option>
 <option value="min_By_min">لحظه بلحظه</option>
 <option value="matches">المباريات</option>
 <option value="championships">البطولات</option>
 <option value="blog">على الناصيه</option>
</select>
</div>

<div class="form-group" id="remain_page2" style="display:none;">
      <label for="exampleInputFile">مكان الأعلان</label>
<select  class="form-control" name="place">
   <option value="1">1</option>
   <option value="2">2</option>
</select>
</div>

<div class="form-group" id="home_page2" style="display:none;">
      <label for="exampleInputFile">مكان الأعلان</label>
<select  class="form-control" name="place">
   <option value="1">1</option>
   <option value="2">2</option>
   <option value="3">3</option>
   <option value="4">4</option>
   <option value="5">5</option>
   <option value="6">6</option>
   <option value="7">7</option>
</select>
</div>

<table>
  <tr>
    <label for="exampleInputFile">مقاس الأعلان</label>
</tr>
  <tr>
    <td>
<select  class="form-control" name="height">
   <option value="90px">90px</option>
   <option value="250px">250px</option>
</select>
</td>
<td>x</td>
<td>
<select  class="form-control" name="width">
   <option value="728px">728px</option>
   <option value="300px">300px</option>
</select>
</td>
</tr>
</table>
