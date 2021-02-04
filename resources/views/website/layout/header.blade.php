<header class="header">
  <div class="search-full-section" id="search-full-section">
    <div class="container">
      <div class="search-full-section__box">

        {!!Form::open(array('url'=>url('/search'),'method' =>'get',"class"=>"search-full-section__search "))!!}

          {!!Form::text('q',null,array('class'=>'search-full-section__searchInput ','placeholder'=>'إبحث هنا..'))!!}
          <button type="submit" id="start-search">
            <span>
              <svg id="Capa_1" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 515.558 515.558" height="512" viewBox="0 0 515.558 515.558" width="512">
                <path d="m378.344 332.78c25.37-34.645 40.545-77.2 40.545-123.333 0-115.484-93.961-209.445-209.445-209.445s-209.444 93.961-209.444 209.445 93.961 209.445 209.445 209.445c46.133 0 88.692-15.177 123.337-40.547l137.212 137.212 45.564-45.564c0-.001-137.214-137.213-137.214-137.213zm-168.899 21.667c-79.958 0-145-65.042-145-145s65.042-145 145-145 145 65.042 145 145-65.043 145-145 145z"></path>
              </svg>
            </span>
            </button>
        {!!Form::close()!!}

        @if(count($keywords??[]))
        <div class="search-full-section__tags">
          <h4>أكثر الكلمات إنتشارا</h4>
          <div class="search-full-section__tagsBox">
            @foreach($keywords as $tag)
              <a href="{{url('tags/'.$tag->slug)}}">{{$tag->name}}</a>
            @endforeach
          </div>
        </div>
          @endif

      </div>
    </div>
  </div>
  <div class="header__body">
    <div class="container-fluid flex">
      <div class="header__burger"><span class="one"></span><span class="two"></span><span class="three"></span></div>
      <div class="header__logo">
        <a href="{{url('/')}}"><img src="{{url('img/logo.png')}}"/></a>
      </div>
      <div class="header__corner">
        @if($socailLinks['instagram']??0)
        <a class="header__cornerBtn instagram" href="{{$socailLinks['instagram']}}">
          <svg class="u-icon undefined">
            <use xlink:href="{{url('img/icons.svg#icon-Instagram')}}"></use>
          </svg>
        </a>
        @endif
        @if($socailLinks['twitter']??0)
        <a class="header__cornerBtn twitter" href="{{$socailLinks['twitter']}}">
          <svg class="u-icon undefined">
            <use xlink:href="{{url('img/icons.svg#icon-twitter')}}"></use>
          </svg>
        </a>
        @endif
        @if($socailLinks['facebook']??0)
        <a class="header__cornerBtn facebook" href="{{$socailLinks['facebook']}}">
          <svg class="u-icon undefined">
            <use xlink:href="{{url('img/icons.svg#icon-facebook')}}"></use>
          </svg>
        </a>
        @endif
        <span class="header__cornerBtn search"><span class="open active">
            <svg class="u-icon undefined">
              <use xlink:href="{{url('img/icons.svg#icon-search')}}"></use>
            </svg></span><span class="close">
            <svg class="u-icon undefined">
              <use xlink:href="{{url('img/icons.svg#icon-close')}}"></use>
            </svg></span></span></div>
    </div>
  </div>
</header>
