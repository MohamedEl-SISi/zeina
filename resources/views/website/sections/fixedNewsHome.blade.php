@if(count($data??[]))
<div class="layout-wrap">
  <div class="section-wrapper section-wrapper__1st">

      @php
        $Helper= new App\Http\Helpers\Helpers;
      @endphp

      @forelse($order as $key => $id)
      @php
        $news = $data->where('id',$id)->first();
      @endphp

        @switch($key)

        @case(0)

        @php
          if(is_null($news->image))
          {
               $imageUrl = url('default.png');
          }else
          {
              $imageUrl=  $Helper->getImageUrl($news->image->fileName,'600x400',$news->image->path).'?'.time();
          }
        @endphp
        <section class="main-section">
        <div class="news-card news-card--over news-card--large size-A">
          @include('website.shared.newsCardDataWithSrc')
        </div>

        @break

        @case(1)
        @case(2)
            @php
              if(is_null($news->image))
              {
                   $imageUrl = url('default.png');
              }else
              {
                  $imageUrl= $news->image->getImageThumbAttribute().'?'.time();
              }
            @endphp
        @if($key==1)
          <div class="flex wrap-mobile">
        @endif
            <div class="w50">
              <div class="news-card news-card--over news-card--large size-B">
                @include('website.shared.newsCardDataWithSrc')
              </div>
            </div>
        @if($key==2)
        </div>
        </section>
        @endif
        @break
          @case(3)
              @php
                if(is_null($news->image))
                {
                     $imageUrl = url('default.png');
                }else
                {
                    $imageUrl= $news->image->getImageThumbAttribute().'?'.time();
                }
              @endphp
            <section class="right-side">
              <div class="news-card news-card--over news-card--large size-A">
                @include('website.shared.newsCardDataWithSrc')
              </div>
            @break

          @case(4)
            @php
              if(is_null($news->image))
              {
                   $imageUrl = url('default.png');
              }else
              {
                  $imageUrl= $news->image->getImageThumbAttribute().'?'.time();
              }
            @endphp
          <div class="news-card news-card--over news-card--large size-B">
            @include('website.shared.newsCardDataWithSrc')
          </div>
          </section>
          @default
        @endswitch

      @empty
      @endforelse

  </div>
  @if($positionOne)
  <aside class="left-side mobile-w100">
    <div class="news-card news-card--over news-card--large">
      @php
      if(is_null($positionOne->image))
      {
           $PositionimageUrl = url('default.png');
      }else
      {
          $PositionimageUrl=  $Helper->getImageUrl($positionOne->image->fileName,'300x550',$positionOne->image->path).'?'.time();
      }
      @endphp
      <a class="news-card__link" href="{{url('news/'.$positionOne->id.'/'.$positionOne->slug)}}"></a>
      <div class="news-card__img">
        <img class="lazy" src="{{url('img/placeholder.png')}}" image-src="{{$PositionimageUrl}}"/>
      </div>
      <div class="news-card__caption">
        <div class="news-card__details">
          <div class="news-card__caption-row">
          </div>
          <span class="news-card__title">{{$positionOne->title}}</span>
        </div>
      </div>
    </div>
  </aside>
  @endif
</div>
@endif
