<aside class="col-sm-4">
  <div class="bordered padding-all">
    <div class="row">
      <section class="col-sm-12">
        <div class="title">
          <p>الأقسام</p>
        </div>
        <ul class="list-group nudge">
          @foreach($categories as $cat)
          <li class="list-group-item"><a href="#">{{$cat->name }}</a></li>
          @endforeach
        </ul>
      </section>
      <section class="col-sm-12 opacity-eff">
        <div class="title">
          <p>موضوع مميز</p>
        </div>
        @if($page == 'news')
            <a href="{{ url('/news',$get_record->id) }}">
            <figure><img class=" img-responsive" src="{{ asset('images/uploads/'.$get_record->flag)}}" width="470" height="290" alt=""/></figure>
            </a>
            <h5 class="text-uppercase"> <a href="{{ url('/news',$get_record->id) }}">{{ $get_record->title }}</a></h5>
            <p>{{ $get_record->additional_info }}</p>

        @elseif($page == 'vedios')
            <a href="{{ url('/vedios',$get_record->id) }}">
              <figure>
              <div  class="vid-box">
                <i class="icofont icofont-ui-play"></i>
                <img class="img-responsive" alt="" src="{{ asset('images/uploads/'.$get_record->flag)}}"> </div>
            </figure>
            </a>
            <h5 class="text-uppercase"> <a href="{{ url('/vedios',$get_record->id) }}">{{ $get_record->title }}</a></h5>
            <p>{{ $get_record->description }}</p>

          @elseif($page == 'posts')
              <a href="{{ url('/posts',$get_record->id) }}">
              <figure><img class=" img-responsive" src="{{ asset('images/uploads/'.$get_record->flag)}}" width="470" height="290" alt=""/></figure>
              </a>
              <h5 class="text-uppercase"> <a href="{{ url('/posts',$get_record->id) }}">{{ $get_record->title }}</a></h5>
              <p>{{ $get_record->body }}</p>

        @else
            <a href="{{ url('/blogs',$get_record->id) }}">
            <figure><img class=" img-responsive" src="{{ asset('images/uploads/'.$get_record->flag)}}" width="470" height="290" alt=""/></figure>
            </a>
            <h5 class="text-uppercase"> <a href="{{ url('/blogs',$get_record->id) }}">{{ $get_record->title }}</a></h5>
            <p>{{ $get_record->body }}</p>
        @endif
      </section>
      <section class="col-sm-12 tags">
        <div class="title">
          <p>أهم الوسوم</p>
        </div>
          @foreach($tags as $tag)
            <a href="{{ $tag->id }}">{{$tag->meta_words}}</a>
          @endforeach
       </section>

    </div>
  </div>
</aside>
