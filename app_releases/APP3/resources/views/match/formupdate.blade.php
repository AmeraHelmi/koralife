<input type="hidden" name="_token" value="{{ csrf_token() }}">

<table>

<tr>
  <td style="width: 48%">
      <div class="form-group" >
          <label for="exampleInputFile" style="float:right">نوع البطولة</label>
          <select  class="form-control" id="type" name="type" onchange="func(this)">
            <option value="ودية" selected>ودية</option>
            <option value="دورى">دورى</option>
            <option value="كأس" >كأس</option>

          </select>
      </div>
  </td>
</tr>
<tr>
  <td style="width: 48%;">
    <div class="form-group">
        <label for="exampleInputFile" style="float:right">أختيار القناه</label>
        <select id="channel"  class="form-control" name="channel_id">
              <option value="Null" selected>أختيار القناه</option>
              @foreach($channels as $channel_id => $channel_name)
              <option value="{!! $channel_id !!}">{!! $channel_name !!}</option>
              @endforeach
        </select>
    </div>
  </td>
  <td style="width: 48%; padding-left: 2%;">

      <div class="form-group" id="champion">
          <label for="exampleInputFile" style="float:right">أختيار البطوله</label>
          <select  class="form-control" name="champion_id">
                <option value="Null" selected>أختيار البطوله</option>
                @foreach($championships as $championship_id => $championship_name)
                <option value="{!! $championship_id !!}">{!! $championship_name !!}</option>
                @endforeach
          </select>
      </div>
 </td>
</tr>

<tr>
  <td style="width: 48%">

          <label for="exampleInputFile" style="float:right">أختيار الأستاد</label>
          <select  class="form-control" name="stadium_id">
                <option selected>أختيار الأستاد</option>
                @foreach($stadiums as $stadium_id => $stadium_name)
                <option value="{!! $stadium_id !!}">{!! $stadium_name !!}</option>
                @endforeach
          </select>
      </div>
   </td>
   <td style="width: 48%; padding-left: 2%;">
     <div class="form-group" id="weekdiv" style="display: none;">
         <label for="exampleInputPassword1" style="float:right"> الاسبوع</label>
         <input type="text"
         name="group_id"
         class="form-control"
      >
     </div>
   </td>
</tr>
<tr>
  <td style="width: 48%">

     <div class="form-group" id="rolediv" style="display: none;"   >
         <label for="exampleInputPassword1" style="float:right">الدور</label>
         <select  class="form-control" name="role">
               <option value="Null">دور المجموعات</option>
               <option value="16">دور ال 16</option>
               <option value="8">دور ال 8</option>
               <option value="4">دور ال 4</option>
               <option value="2">دور النهائى</option>
         </select>
     </div>
   </td>
   <td style="width: 48%; padding-left: 2%;">

      <div class="form-group" id="groupdiv" style="display: none;"  >
          <label for="exampleInputPassword1" style="float:right">المجموعة</label>
          <select  class="form-control" name="group">
            <option value="Null" selected>أختيار المجموعه</option>
            @foreach($groups as $group_id => $group_name)
            <option value="{!! $group_id !!}">{!! $group_name !!}</option>
            @endforeach
          </select>
      </div>
    </td>
</tr>

</table>
<div class="form-group">
<label for="exampleInputPassword1">وقت المبارأة</label>
<input type="number"
 name="match_period"
 placeholder="ادخل مدة المباراة"
 class="form-control"
>
</div>
<div class="form-group" style="text-align:right;">
    <label>الحكام</label><br />
          {!! Form::select('referees[]', $referees, null, array('multiple'=> true, 'data-placeholder'=>'Select referees' ,'class'=> 'form-control group-select chosen-select-multiple chosen-select-no-results')) !!}
</div>
<div class="form-group">
    <label for="exampleInputPassword1" style="float:right">معلومات أضافيه</label>
    <textarea rows="2" cols="30" name="addition_info" class="form-control"></textarea>
</div>
