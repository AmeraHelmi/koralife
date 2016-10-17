<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
    <label for="exampleInputPassword1">أسم الوكيل</label>
    <input type="text" class="form-control" name="name" id="agent_name" placeholder="Agent name" required class="form-control">
    <label for="agent_addition_info">معلومات اضافيه</label>
    <textarea  rows="2" cols="30" class="form-control" name="addition_info" id="agent_addition_info" placeholder="addition_info" class="form-control"></textarea>
    <span class="help-block with-errors errorName"></span>
</div>
