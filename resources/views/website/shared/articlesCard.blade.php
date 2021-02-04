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

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="news-card news-card--card news-card--switch profile-card profile-card--circle profile-card--section">
    @include('website.shared.articlesCardData')
  </div>
</div>
