<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="form-group">
    <label for="exampleInputPassword1">أسم الراعى</label>
    <input type="text" class="form-control" name="name" id="sponsor name" placeholder="sponsor name" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>
<div class="form-group">
    <label for="exampleInputPassword1">الرابط</label>
    <input type="url" class="form-control" name="url" placeholder="http://..." required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>
<div class="fileupload fileupload-new" data-provides="fileupload">
    <span class="btn btn-primary btn-file"><span class="fileupload-new">الصوره</span>
    <span class="fileupload-exists">تغير</span>
    <input type="file" name="flag" /></span>
    <span class="fileupload-preview"></span>
    <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
</div>
<div class="form-group" style="display:none;">
    <label for="exampleInputFile">pic path</label>
    <input type="text" name="flagcountry" id="flag" required >
</div>
