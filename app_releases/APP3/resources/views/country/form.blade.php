<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
<label for="exampleInputPassword1">أسم الدوله</label>
<input type="text"
  class="form-control"
  name="name"
  id="country_name"
  placeholder="country name"
  required
  class="form-control"
  data-remote-error="Country with the same name exists"
  data-remote="{{ url('country/checkname') }}"
  >
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group" style="display:none;">
<label for="exampleInputFile">pic path</label>
<input type="text"
 name="flagcountry"
 id="flag"
 >
</div>
<div class="fileupload fileupload-new" data-provides="fileupload">
  <span class="btn btn-primary btn-file"><span class="fileupload-new">الصوره</span>
  <span class="fileupload-exists">Change</span>
  <input type="file" name="flag" /></span>
  <span class="fileupload-preview"></span>
  <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
</div>
