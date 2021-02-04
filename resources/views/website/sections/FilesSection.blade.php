<section class="dark-section">
  <div class="main-title">
    <div class="main-title__box">
      <a href="{{url('files')}}"> ملفات زينة </a></div>
  </div>
  <div class="section-wrapper">
    <div class="container">
      <div class="row">

        @forelse($data as $index => $file)

        <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
          <div class="news-card news-card--card">
            <a class="news-card__link" href="{{url('files/'.$file->id.'/'.$file->slug)}}"></a>
            <div class="news-card__img">
              <img class="lazy" src="{{url('img/placeholder.png')}}" image-src="{{$file->firstNews?$file->firstNews->relatedNews->image->getImageThumbAttribute():url('default.png')}}"/>
            </div>
            <div class="news-card__caption">
              <div class="news-card__details">
                <div class="news-card__caption-row">
                </div><span class="news-card__title">{{$file->title}}</span>
              </div>
            </div>
          </div>
        </div>

        @empty

        @endforelse

      </div>
    </div>
  </div>
</section>
