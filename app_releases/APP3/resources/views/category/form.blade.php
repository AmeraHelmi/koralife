<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
    <label for="exampleInputPassword1">أسم الفئة</label>
    <input type="text" class="form-control" name="name" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>
