<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt15-1">
  <div class="third-title">
    <a class="third-title__box" href="{{url($url)}}">
      <span>{{$text}}</span>
    </a>
  </div>
  @php
    $Helper= new App\Http\Helpers\Helpers;
  @endphp
  @forelse($data as $key=>$news)

  @php
    if(is_null($news->image))
    {
         $imageUrl = url('default.png');
    }else
    {
        $imageUrl = $Helper->getImageUrl($news->image->fileName,'120x90',$news->image->path).'?'.time();
    }
  @endphp
  <div class="news-card news-card--card news-card--switch profile-card profile-card--circle">
    @include('website.shared.articlesCardData')
  </div>
  @empty
  @endforelse

</div>
