<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mt15-1">
  <div class="second-title">
    <a class="second-title__box" href="{{url($url)}}">
      <span>{{$text}}</span>
    </a>
  </div>

  @php
    $Helper= new App\Http\Helpers\Helpers;
  @endphp

  @forelse($data as $index=>$news)
    @php
      if(is_null($news->image))
      {
           $imageUrl = url('default.png');
      }else
      {
          $imageUrl = $index? $Helper->getImageUrl($news->image->fileName,'120x90',$news->image->path):$news->image->getImageThumbAttribute().'?'.time();
      }
    @endphp

    <div class="news-card news-card--card @if($index) news-card--switch @else  category-card @endif">
      @include('website.shared.newsCardData')
    </div>

  @empty

  @endforelse


</div>
