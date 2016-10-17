<li class="accordion">
    <a href="#">
        <i class="glyphicon glyphicon-plus"></i>
        <span> الدول والبلاد</span>
    </a>
    <ul class="nav nav-pills nav-stacked">
        <li><a href="{{ url('country') }}">الدول</a></li>
        <li><a href="{{ url('city') }}">البلد</a></li>
    </ul>
</li>

<li>
    <a class="ajax-link" href="{{ url('stadium') }}">
        <i class="glyphicon glyphicon-arrow-left"></i>
        <span> الاستادات</span>
    </a>
</li>

<li>
    <a class="ajax-link" href="{{ url('commentor') }}">
        <i class="glyphicon glyphicon-arrow-left"></i>
        <span> المعلقون</span>
    </a>
</li>


<li>
    <a class="ajax-link" href="{{ url('referee') }}">
        <i class="glyphicon glyphicon-arrow-left"></i>
        <span> الحكم</span>
    </a>
</li>

<li>
    <a class="ajax-link" href="{{ url('sponsor') }}">
        <i class="glyphicon glyphicon-arrow-left"></i>
        <span> الرعاه</span>
    </a>
</li>

<li>
    <a class="ajax-link" href="{{ url('channel') }}">
        <i class="glyphicon glyphicon-arrow-left"></i>
        <span> القنوات الرياضيه</span>
    </a>
</li>


<li>
    <a class="ajax-link" href="{{ url('shoe') }}">
        <i class="glyphicon glyphicon-arrow-left"></i>
        <span> الاحذيه</span>
    </a>
</li>

<li class="accordion">
    <a href="#"><i class="glyphicon glyphicon-plus"></i>
        <span> المدربين</span>
    </a>
    <ul class="nav nav-pills nav-stacked">
        <li><a href="{{ url('coach') }}">اضافة مدرب</a></li>
        <li><a href="{{ url('team_history_coach') }}">مدربين النادى</a></li>
    </ul>
</li>


<li class="accordion">
    <a href="#">
       <i class="glyphicon glyphicon-plus"></i>
       <span> المديرين</span>
    </a>
    <ul class="nav nav-pills nav-stacked">
        <li><a href="{{ url('manager') }}"> اضافة مدير </a></li>
        <li><a href="{{ url('managment_championship') }}">مديرين النادى</a></li>
    </ul>
</li>

<li class="accordion">
    <a href="#">
        <i class="glyphicon glyphicon-plus"></i>
        <span> النادى</span>
    </a>
    <ul class="nav nav-pills nav-stacked">
        <li><a href="{{ url('team') }}">اضافة نادى</a></li>
        <li><a href="{{ url('teamcloth') }}">ملابس الفريق</a></li>
        <li><a href="{{ url('team_sponsor') }}">الرعاه</a></li>
    </ul>
</li>

<li class="accordion">
    <a href="#">
        <i class="glyphicon glyphicon-plus"></i>
        <span> الكوره</span>
    </a>
    <ul class="nav nav-pills nav-stacked">
        <li><a href="{{ url('ball') }}"> اضافة كوره</a></li>
    </ul>
</li>

<li class="accordion">
    <a href="#">
        <i class="glyphicon glyphicon-plus"></i>
        <span> البطولات</span>
    </a>
    <ul class="nav nav-pills nav-stacked">
        <li><a href="{{ url('championship') }}">اضافة بطوله</a></li>
        <li><a href="{{ url('champsponsors') }}">الرعاه</a></li>
    </ul>
</li>

<li>
    <a class="ajax-link" href="{{ url('group') }}">
        <i class="glyphicon glyphicon-arrow-left"></i>
        <span> المجموعات</span>
    </a>
</li>

<li>
  <a class="ajax-link" href="{{ url('team_group') }}">
    <i class="glyphicon glyphicon-arrow-left"></i>
    <span> مجموعات البطوله</span>
  </a>
</li>

<li>
    <a class="ajax-link" href="{{ url('branch') }}">
        <i class="glyphicon glyphicon-arrow-left"></i>
        <span> فروع النادى</span>
    </a>
</li>

<li class="accordion">
    <a href="#">
        <i class="glyphicon glyphicon-plus"></i>
        <span> المباراه</span>
    </a>
    <ul class="nav nav-pills nav-stacked">
        <li><a href="{{ url('match') }}">اضافة مباراه</a></li>
        <li><a href="{{ url('msponsors') }}">الرعاه</a></li>
    </ul>
</li>


<li class="accordion">
    <a href="#">
        <i class="glyphicon glyphicon-plus"></i>
        <span> اللاعب</span>
    </a>
    <ul class="nav nav-pills nav-stacked">
        <li><a href="{{ url('player') }}">اضافة لاعب</a></li>
        <li><a href="{{ url('playershoes') }}">حذاء اللاعب</a></li>
        <li><a href="{{ url('playersteam') }}">الفريق</a></li>
        <li><a href="{{ url('playerhistory') }}">تارخ اللاعب</a></li>
        <li><a href="{{ url('player_sponsor') }}">الرعاه للاعب</a></li>
    </ul>
</li>

<li>
    <a class="ajax-link" href="{{ url('player_injured_history') }}">
        <i class="glyphicon glyphicon-arrow-left"></i>
        <span> اصابات الاعبين</span>
    </a>
</li>


<li class="accordion">
    <a href="#">
        <i class="glyphicon glyphicon-plus"></i>
        <span> الوكلاء</span>
    </a>
    <ul class="nav nav-pills nav-stacked">
        <li><a href="{{ url('agent') }}">اضافة وكيل</a></li>
        <li><a href="{{ url('agent_history') }}">تاريخ الوكلاء</a></li>
    </ul>
</li>

<li>
    <a class="ajax-link" href="{{ url('category') }}">
        <i class="glyphicon glyphicon-arrow-left"></i>
        <span> الوسوم</span>
    </a>
</li>

<li class="accordion">
    <a href="#">
        <i class="glyphicon glyphicon-plus"></i>
        <span> مكتبة الصور</span>
    </a>
    <ul class="nav nav-pills nav-stacked">
        <li>
            <a href="{{ url('g_album') }}">الالبوم</a>
        </li>
        <li>
            <a href="{{ url('g_album_photo') }}">اضافة صور للالبوم</a>
        </li>
    </ul>
</li>

<li class="accordion">
    <a href="#">
        <i class="glyphicon glyphicon-plus"></i>
        <span> الفيديوهات</span>
    </a>
    <ul class="nav nav-pills nav-stacked">
        <li><a href="{{ url('v_album') }}">اضافة فيديو</a></li>
    </ul>
</li>

<li>
    <a class="ajax-link" href="{{ url('snew') }}">
        <i class="glyphicon glyphicon-arrow-left"></i>
        <span> الاخبار</span>
    </a>
</li>

<li>
    <a class="ajax-link" href="{{ url('advert') }}">
        <i class="glyphicon glyphicon-arrow-left"></i>
        <span> الاعلان</span>
    </a>
</li>

<li>
    <a class="ajax-link" href="{{ url('analysis') }}">
        <i class="glyphicon glyphicon-arrow-left"></i>
        <span> التحليل</span>
    </a>
</li>

<li>
    <a class="ajax-link" href="{{ url('expection') }}">
        <i class="glyphicon glyphicon-arrow-left"></i>
        <span> التوقعات</span>
    </a>
</li>

<li>
    <a class="ajax-link" href="{{ url('minute') }}">
        <i class="glyphicon glyphicon-arrow-left"></i>
        <span> لحظة بلحظة </span>
    </a>
</li>

<li>
    <a class="ajax-link" href="{{ url('blog') }}">
        <i class="glyphicon glyphicon-arrow-left"></i>
        <span> على الناصيه</span>
    </a>
</li>

<li>
    <a class="ajax-link" href="{{ url('post') }}">
        <i class="glyphicon glyphicon-arrow-left"></i>
        <span> المدونه</span>
    </a>
</li>


<li>
    <a class="ajax-link" href="{{ url('winner') }}">
        <i class="glyphicon glyphicon-arrow-left"></i>
        <span> الفائز بالبطوله</span>
    </a>
</li>
