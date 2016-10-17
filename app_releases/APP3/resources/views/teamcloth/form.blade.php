<input type="hidden" name="_token" value="{{ csrf_token() }}">
<table>
    <tr>
        <div class="form-group">
            <label for="exampleInputFile">أختيار الفريق</label>
            <select id="team_type"  class="form-control" onchange="select_team()">
                  <option selected><bdi>أختر الفريق</bdi></option>
                  <option value="نادى"><bdi>نادى</bdi></option>
                  <option value="منتخب"><bdi>منتخب</bdi></option>
            </select>
        </div>
    </tr>
    <tr>
        <div class="form-group" id="showteam"  style="display:none;">
            <label for="exampleInputFile">اختيار نادى</label>
            <select  class="form-control"name="team_id" id="team_id" >
            </select>
        </div>
    </tr>
    <label for="exampleInputFile">الزى الرياضى للنادى</label>
    <tr>
        <div class="fileupload fileupload-new" data-provides="fileupload">
            <span class="btn btn-info btn-file" style=" width: 166px;font-size: 16PX;padding-right: 52px;">
            <span class="fileupload-new"> الزى 1th</span>
            <i class="fa fa-folder-open-o" aria-hidden="true"></i>
            <span class="fileupload-exists">تغير</span>
            <input type="file" name="principal" required/></span>

            <span class="fileupload-preview"></span>
            <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
        </div>
        <div class="fileupload fileupload-new" data-provides="fileupload">
            <span class="btn btn-info btn-file"  style=" width: 166px;font-size: 16PX;    padding-right: 52px;">
            <span class="fileupload-new"> الزى 2th</span>
            <i class="fa fa-folder-open-o" aria-hidden="true"></i>
            <span class="fileupload-exists">تغير</span>
            <input type="file" name="reserve" required/></span>

            <span class="fileupload-preview"></span>
            <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
        </div>
        <div class="fileupload fileupload-new" data-provides="fileupload">
            <span class="btn btn-info btn-file"  style=" width: 166px;font-size: 16PX;    padding-right: 52px;">
            <span class="fileupload-new"> الزى 3th </span>
            <i class="fa fa-folder-open-o" aria-hidden="true"></i>
            <span class="fileupload-exists">تغير</span>
            <input type="file" name="reserve2" /></span>
            <a href="#" class="delete" id="del" name="delete"  style="float: none; font-size:20px; display:none;">×</a>
            </span>
            <span class="fileupload-preview"></span>
            <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
        </div>
        <div class="fileupload fileupload-new" data-provides="fileupload">
            <span class="btn btn-info btn-file"  style=" width: 166px;font-size: 16PX;">
            <span class="fileupload-new">زى التمارين</span>
            <i class="fa fa-folder-open-o" aria-hidden="true"></i>
            <span class="fileupload-exists">تغير</span>
            <input type="file" name="practise" /></span>
            <span class="fileupload-preview"></span>
            <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
        </div>
        </tr>
    </table>
    <div class="form-group" style="display:none;">
        <label for="exampleInputFile">pic path</label>
        <input type="text" name="flagcountry" id="flag">
    </div>
