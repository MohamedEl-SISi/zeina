
@php
  if(is_null($news->image))
  {
       $imageUrl = url('default.png');
  }else
  {
      $imageUrl= $news->image->getImageThumbAttribute().'?'.time();
  }
@endphp

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="news-card news-card--card news-card--switch section-theme">
    <a class="news-card__link" href="{{url('news/'.$news->id.'/'.$news->slug)}}"></a>
    <div class="news-card__img">
      <img class="lazy" src="{{url('img/placeholder.png')}}" image-src="{{$imageUrl}}" alt="{{$news->title}}"/>
    </div>
    <div class="news-card__caption-row">
      @if(is_null($news->subsection))
        <a class="cat" href="{{url('news/'.$news->section->slug)}}">{{$news->section->name}}</a>
      @else
        <a class="cat" href="{{url('news/'.$news->subsection->slug)}}">{{$news->subsection->name}}</a>
      @endif

    </div>
    <div class="news-card__caption">
      <div class="news-card__details">
        <div class="news-card__caption-row">
        </div><span class="news-card__title">{{$news->title}}</span>
        <div class="news-card__info">
          <p>{{$news->desc}}</p>
        </div>
      </div>
    </div>
  </div>
</div>
