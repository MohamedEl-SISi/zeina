<div class="side-menu">
  <ul class="side-menu__nav">
    <li class="side-menu__item"> <a class="side-menu__link" href="{{url('/')}}">الرئيسية</a></li>

    @forelse($orderMenuSection->data??[] as $key=> $id)
      @php
        $section = $sectionMenu->where('id',$id)->first();
      @endphp
    @if($section)
    <li class="side-menu__item has-sub">
      <a class="side-menu__link" href="{{url('news/'.$section->slug)}}">{{$section->name}}
        @if(count($section->sub->where('status','published')))
        <div class="side-menu__expand icon">
          <svg id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 256 256" style="enable-background:new 0 0 256 256;" xml:space="preserve">
            <g>
              <g>
                <polygon points="225.813,48.907 128,146.72 30.187,48.907 0,79.093 128,207.093 256,79.093   "></polygon>
              </g>
            </g>
          </svg>
        </div>
        @endif
      </a>
      @if(count($section->sub))
      <div class="side-menu__sub-links">

        @foreach($section->sub as $subSection)
          @if($subSection->status == "published")
            <a class="side-menu__link sub-link" href="{{url('news/'.$subSection->slug)}}">{{$subSection->name}}</a>
          @endif
        @endforeach
        </div>
      @endif

    </li>
  @endif
    @empty

    @endforelse

    @forelse($articleSectionMenu??[] as $key=> $section)

    <li class="side-menu__item has-sub">
      <a class="side-menu__link" href="#">{{$section->name}}
      </a>
    </li>
    @empty

    @endforelse


    <li class="side-menu__item"> <a class="side-menu__link" href="{{url('articles')}}">آراء ومشاركات</a></li>
    <li class="side-menu__item"> <a class="side-menu__link" href="{{url('exams')}}">الاختبارات والأسئلة</a></li>
    <li class="side-menu__item"> <a class="side-menu__link rev" href="{{url('aboutUs')}}">من نحن </a></li>
    <li class="side-menu__item"> <a class="side-menu__link rev" href="{{url('contactus')}}">اتصل بنا </a></li>
    <li class="side-menu__item"> <a class="side-menu__link rev" href="{{url('share_with_us')}}">اكتبي معنا </a></li>
    <li class="side-menu__item touch"> <a class="side-menu__link rev" href="{{url('privacy')}}">سياسة الخصوصية</a></li>
  </ul>
</div>
