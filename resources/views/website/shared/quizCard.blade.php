
@php
  if(is_null($item->image))
  {
       $imageUrl = url('default.png');
  }else
  {
      $imageUrl= $item->image->getImageThumbAttribute().'?'.time();
  }
@endphp

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="news-card news-card--card news-card--switch section-theme quiz-card">
    <a class="news-card__link" href="{{url('exams/'.$item->id.'/'.$item->slug)}}"></a>
    <div class="news-card__img"><img class="lazy" src="{{url('img/placeholder.png')}}" image-src="{{$imageUrl}}" alt="{{$item->title}}"/>
    </div>
    <div class="news-card__caption">
      <div class="news-card__details">
        <div class="news-card__caption-row">
        </div>
        <span class="news-card__title">{{$item->title}}</span>
        <div class="news-card__info">
          <p>{{$item->desc}}</p>
        </div>
      </div>
    </div>
  </div>
</div>
