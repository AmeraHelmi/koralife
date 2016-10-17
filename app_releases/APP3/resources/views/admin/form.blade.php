<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
      <label for="exampleInputPassword1">أسم المستخدم</label>
      <input type="text" name="name" required class="form-control">
      <span class="help-block with-errors errorName"></span>
      <label for="exampleInputPassword1">الأيميل</label>
      <input type="text" name="email" required class="form-control">
      <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
      <label for="exampleInputFile">اختار الدور</label>
      <select  class="form-control" name="role">
              <option selected value="disactive">غير نشط</option>
              <option value="Editor">متابع مباراه</option>
              <option value="News">محرر اخبار</option>
              <option value="Data Entry">مدخل بيانات</option>
              <option value="Admin">مدير</option>
              <option value="Analyiser">محلل رياضى</option>
      </select>
</div>
