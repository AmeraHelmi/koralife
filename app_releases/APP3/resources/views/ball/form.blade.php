<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="form-group">
    <label for="exampleInputPassword1">أدخل الماركه</label>
    <input type="text" class="form-control" name="brand" id="title" placeholder="title" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="fileupload fileupload-new" data-provides="fileupload">
    <span class="btn btn-primary btn-file"><span class="fileupload-new">الصوره</span>
    <span class="fileupload-exists">تغير</span>
    <input type="file" name="flag"/></span>
    <span class="fileupload-preview"></span>
    <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
</div>

<div class="form-group" style="display:none;">
    <label for="exampleInputFile">pic path</label>
    <input type="text" name="flagcountry" id="flag">
</div>

<div class="form-group">
    <label for="exampleInputPassword1">معلومات أضافيه</label>
    <textarea rows="2" cols="30" name="addition_info" class="form-control"></textarea>
</div>
