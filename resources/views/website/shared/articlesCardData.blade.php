

<a class="news-card__link" href="{{url('articles/'.$news->id.'/'.$news->slug)}}"></a>
<div class="news-card__img">
  <img class="lazy" src="{{url('img/placeholder.png')}}" image-src="{{$imageUrl}}" alt="{{$news->title}}" />
</div>
<span class="profile-name">{{$news->publisher_name}}</span>
<div class="news-card__caption">
  <div class="news-card__details">
    <div class="news-card__caption-row">
    </div><span class="news-card__title">{{$news->title}}</span>
  </div>
</div>
