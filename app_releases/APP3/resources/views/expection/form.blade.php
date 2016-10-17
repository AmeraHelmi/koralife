<input type="hidden" name="_token" value="{{ csrf_token() }}">
<table>
  <div class="form-group">
  <label for="exampleInputPassword1" style="float:right;">الاستفتاء</label>
  <input type="text"
   name="question_text"
   required
   placeholder="question_text"
   class="form-control"
   >
  </div>
  
<tr>
  <td style="width: 48%;">
  <div class="form-group">
  <label for="exampleInputPassword1">الاختيار الاول</label>
  <input type="text"
   name="ans1"
   required
   placeholder="ans1"
   class="form-control"
  >
  </div>
  </td>
  <td style="width: 48%; padding-left: 2%;">
  <div class="form-group">
  <label for="exampleInputPassword1">الاختيار الثانى</label>
  <input type="text"
   name="ans2"
   required
   placeholder="ans2"
   class="form-control"
  >
  </div>
  </td>
  </tr>
  <tr>
    <td style="width: 48%;">
    <div class="form-group">
    <label for="exampleInputPassword1">الاختيار الثالث</label>
    <input type="text"
     name="ans3"
     placeholder="ans3"
     class="form-control"
    >
    </div>
    </td>
    <td style="width: 48%; padding-left: 2%;">
    <div class="form-group">
    <label for="exampleInputPassword1">الاختيار الرابع</label>
    <input type="text"
     name="ans4"
     placeholder="ans4"
     class="form-control"
    >
    </div>
    </td>
    </tr>

</table>
