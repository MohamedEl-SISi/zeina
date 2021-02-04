<a class="news-card__link" href="{{url('news/'.$news->id.'/'.$news->slug)}}"></a>
<div class="news-card__img">
  <img class="lazy" alt="{{$news->title}}" src="{{url('img/placeholder.png')}}" image-src="{{$imageUrl}}"/>
</div>
<div class="news-card__caption">
  <div class="news-card__details">
    <div class="news-card__caption-row">
    </div>
    <span class="news-card__title">{{$news->title}}</span>
  </div>
</div>
