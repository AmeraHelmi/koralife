<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
<label for="exampleInputFile">البطوله</label>
<select  class="form-control" required
 name="championship_id">
 <option>أختيار البطوله</option>
 @foreach($championships as $championship_id => $championship_name)
  <option value="{!! $championship_id !!}">{!! $championship_name !!}</option>
  @endforeach
</select>
</div>

<div class="form-group">
<label for="exampleInputFile">أسم المجموعه</label>
<select  class="form-control" required
 name="name">
 <option>أسم المجموعه</option>
 <option value="A المجموعه">A المجموعه</option>
 <option value="B المجموعه">B المجموعه</option>
 <option value="C المجموعه">C المجموعه</option>
 <option value="D المجموعه">D المجموعه</option>
 <option value="E المجموعه">E المجموعه</option>
 <option value="F المجموعه">F المجموعه</option>
 <option value="G المجموعه">G المجموعه</option>
 <option value="H المجموعه">H المجموعه</option>
</select>
</div>
<div class="form-group">
<label for="exampleInputPassword1">المحتوى</label>
<textarea rows="2" cols="30" name="addition_info" class="form-control" ></textarea>
<span class="help-block with-errors errorName"></span>
</div>
<label for="exampleInputPassword1">عدد المباريات</label>
<input type="text"
  class="form-control"
  name="no_matches"
  id="title"
  placeholder="no_matches"
  class="form-control">