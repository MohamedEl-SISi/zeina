@extends('website.master')

@section('meta_url',env("APP_URL"))
@section('meta_title','مقالات')
@section('meta_description',"تهدف زينة لخلق مساحة آمنة للنساء لمشاركة آرائهن وتجاربهن ووجهات نظرهن المختلفة. تعرفي على آراء أبرز الكاتبات ومشاركات  الملهمات والقراء.")

@section('data-page',"articles")
@section('data-name',"articles")


@section('content')

<div class="cat-info">
  <div class="cat-info__img section-8"></div>
  <div class="cat-info__over-lay"></div>
  <div class="cat-info__text">
    <div class="cat-info__name">
      <p>آراء ومشاركات</p>
    </div>
    <div class="cat-info__desc">
      <p> ترحب زينة بمختلف الآراء ووجهات النظر التي لولاها لما أصبحت كل منا مميزة بطابعها الخاص.. أياً يكن ما يدورفي ذهنك.. شاركينا إياه.</p>
    </div>
  </div>
</div>
<div class="layout-wrap">
  <section class="main-section">
    <div class="row cont">

      @php
        $Helper= new App\Http\Helpers\Helpers;
      @endphp

      @foreach($data as $key=>$section)

        @if($key==0)
        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
        @elseif($key==1)
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        @else
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        @endif

          <div class="main-title">
            <div class="main-title__box">
              <a href="{{url('articles/'.$section[0]->section->slug)}}">
                <span>{{$section[0]->section->name}}</span>
              </a>
            </div>
          </div>
          <div class="row @if($key!=1) fff radius-20 @endif">
            @forelse($section as $news)

            @php
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
            @empty
            @endforelse

          </div>
          @if(count($section)==10)
          <a class="btn btn--primary center-btn"  href="{{url('articles/'.$section[0]->section->slug)}}"> عرض المزيد</a>
          @endif
        </div>



      @endforeach

    </div>
  </section>

</div>
@stop
