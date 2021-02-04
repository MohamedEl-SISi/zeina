<section class="dark-section">
  <div class="main-title">
    <div class="main-title__box"><a href="#">{{$text}}</a></div>
  </div>
  <div class="section-wrapper">
    <div class="container">
      <div class="row">
        @forelse($data as $key=>$news)
        @php
          if(is_null($news->image))
          {
               $imageUrl = url('default.png');
          }else
          {
              $imageUrl= $news->image->getImageThumbAttribute().'?'.time();
          }
        @endphp
        <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
          <div class="news-card news-card--card">
            @include('website.shared.newsCardData')
          </div>
        </div>

        @empty
        @endforelse

      </div>
    </div>
  </div>
</section>
