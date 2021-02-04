@php
  $Helper= new App\Http\Helpers\Helpers;

  if(is_null($news->image))
  {
       $imageUrl = url('default.png');
  }else
  {
      $imageUrl = $Helper->getImageUrl($news->image->fileName,'120x90',$news->image->path).'?'.time();
  }
@endphp

<div class="news-card news-card--card news-card--switch">
  <a class="news-card__link" href="{{url('news/'.$news->id.'/'.$news->slug)}}"></a>
  <div class="news-card__img">
    <img class="lazy" alt="{{$news->title}}" src="{{url('img/placeholder.png')}}" image-src="{{url($imageUrl)}}"/>
  </div>
  <div class="news-card__caption">
    <div class="news-card__details">
      <div class="news-card__caption-row"><a class="cat" href="#9">{{$news->section->name}}</a>
      </div><span class="news-card__title">{{$news->title}}</span>
    </div>
  </div>
</div>
