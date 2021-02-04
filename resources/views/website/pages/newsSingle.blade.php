
@extends('website.master')

@section('meta_title',$item->title)
@section('meta_description',$item->desc)
@section('meta_url',env("APP_URL"))
@section('data-page',"single")


@section('meta')
    <meta property="og:type" content="article" />
    @forelse( $item->keywords??[] as $tag )
        <meta property="article:tag" content="{{$tag['name']}}" />
    @empty

    @endforelse

    @if(($item->section))
    <meta property="article:section" content="{{$item->section->name}}" />
    @endif
    <meta property="article:published_time" content="{{\Carbon\Carbon::parse($item->publish_date)->format('c')}}" />
    <meta property="article:modified_time" content="{{\Carbon\Carbon::parse($item->updated_at)->format('c')}}" />
    <meta property="og:updated_time" content="{{\Carbon\Carbon::parse($item->updated_at)->format('c')}}" />
    <meta name="author" content="{{$item->publisher_name}}">
    <meta name="googlebot" content="index,follow"/>
    <meta name="robots" content="index,follow"/>

    @component('website.shared.Schema.news_schema')
        @slot('title',$item->title)
        @slot('imageUrl',$item->image->getImageThumbAttribute())
        @slot('publishDate',$item->publish_date)
        @slot('modifiedDate',$item->updated_at)
    @endcomponent

    @component('website.shared.Schema.breadcrumb_schema')
      @slot('postTitle',$item->title)
      @slot('postUrl',Request::url())
      @slot('categoryTitle',($item->section)?($item->section->name):"عام")
      @slot('categoryUrl',($item->section)?(url('news').'/'.$item->section->slug):url('news'))
  @endcomponent
@stop


@section('content')

<!-- <div class="ads">
  <img src="{{url('img/ad/768x90.png')}}" alt=""/>
</div> -->
<div class="layout-wrap">
  <section class="main-section">
    <div class="breadCrumb mt15">
      <div class="breadCrumb__list">
        <span class="icon breadCrumb__home">
          <svg id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
            <g>
              <g>
                <polygon points="256,152.96 79.894,288.469 79.894,470.018 221.401,470.018 221.401,336.973 296.576,336.973 296.576,470.018     432.107,470.018 432.107,288.469   "></polygon>
              </g>
            </g>
            <g>
              <g>
                <polygon points="439.482,183.132 439.482,90.307 365.316,90.307 365.316,126.077 256,41.982 0,238.919 35.339,284.855     256,115.062 476.662,284.856 512,238.92   "></polygon>
              </g>
            </g>
          </svg>
        </span>
        <li class="breadCrumb__item">
          <a href="{{url('/')}}" class="breadCrumb__link">الرئيسية</a></li>

          @if($item->section)

          <span class="icon">
          <svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 492 492" style="enable-background:new 0 0 492 492;" xml:space="preserve">
            <g>
              <g>
                <path d="M198.608,246.104L382.664,62.04c5.068-5.056,7.856-11.816,7.856-19.024c0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12    C361.476,2.792,354.712,0,347.504,0s-13.964,2.792-19.028,7.864L109.328,227.008c-5.084,5.08-7.868,11.868-7.848,19.084    c-0.02,7.248,2.76,14.028,7.848,19.112l218.944,218.932c5.064,5.072,11.82,7.864,19.032,7.864c7.208,0,13.964-2.792,19.032-7.864    l16.124-16.12c10.492-10.492,10.492-27.572,0-38.06L198.608,246.104z"></path>
              </g>
            </g>
          </svg></span>

          <li class="breadCrumb__item">
            <a class="breadCrumb__link" href="{{url('news/'.$item->section->slug)}}">{{$item->section->name}}</a>
          </li>

        @endif

        @if($item->subsection)
        <span class="icon">
        <svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 492 492" style="enable-background:new 0 0 492 492;" xml:space="preserve">
          <g>
            <g>
              <path d="M198.608,246.104L382.664,62.04c5.068-5.056,7.856-11.816,7.856-19.024c0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12    C361.476,2.792,354.712,0,347.504,0s-13.964,2.792-19.028,7.864L109.328,227.008c-5.084,5.08-7.868,11.868-7.848,19.084    c-0.02,7.248,2.76,14.028,7.848,19.112l218.944,218.932c5.064,5.072,11.82,7.864,19.032,7.864c7.208,0,13.964-2.792,19.032-7.864    l16.124-16.12c10.492-10.492,10.492-27.572,0-38.06L198.608,246.104z"></path>
            </g>
          </g>
        </svg></span>
        <li class="breadCrumb__item">
          <span class="breadCrumb__link"> {{$item->subsection->name}}  </span>
        </li>
        @endif

      </div>
    </div>
    <div class="single-wrapper" id="single-wrapper" article-id="253151">
      <div class="single-wrapper__title">
        <h1>{{$item->title}}</h1>
      </div>
      <div class="single-wrapper__status">
        <div class="status-cell">
          <div class="status-cell__icon icon">
            <svg id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
              <path d="M437.02,74.98C388.667,26.629,324.38,0,256,0S123.333,26.629,74.98,74.98C26.629,123.333,0,187.62,0,256    s26.629,132.667,74.98,181.02C123.333,485.371,187.62,512,256,512s132.667-26.629,181.02-74.98    C485.371,388.667,512,324.38,512,256S485.371,123.333,437.02,74.98z M256,472c-119.103,0-216-96.897-216-216S136.897,40,256,40    s216,96.897,216,216S375.103,472,256,472z"></path>
              <polygon points="276,236 276,76 236,76 236,276 388,276 388,236   "></polygon>
            </svg>
          </div>
          <div class="status-cell__text"> {{Carbon\carbon::parse($item->publish_date)->diffForHumans()}}</div>
        </div>
        <div class="status-cell">
          <div class="status-cell__icon icon">
            <svg id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 383.947 383.947" style="enable-background:new 0 0 383.947 383.947;" xml:space="preserve">
              <polygon points="0,303.947 0,383.947 80,383.947 316.053,147.893 236.053,67.893    "></polygon>
              <path d="M377.707,56.053L327.893,6.24c-8.32-8.32-21.867-8.32-30.187,0l-39.04,39.04l80,80l39.04-39.04     C386.027,77.92,386.027,64.373,377.707,56.053z"></path>
            </svg>
          </div>
          <div class="status-cell__text">{{$item->publisher_name}}  </div>
        </div>
      </div>
      <div class="single-wrapper__img-holder mb25">

        @php
          $Helper= new App\Http\Helpers\Helpers;
        @endphp

        @if(is_null($item->image))
        <img src="{{url('default.png')}}" alt="{{$item->title}}"/>
        @else
        <img src="{{$Helper->getImageUrl($item->image->fileName,'600x400',$item->image->path)}}" alt="{{$item->title}}"/>
        @endif

      </div>
      <div class="single-wrapper__content">
        <div class="social-box no-touch">
          <div class="handle-sticky"><a href="#">
              <div class="icon fb">
                <svg aria-hidden="true" data-prefix="fab" data-icon="facebook-f" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 264 512" data-fa-i2svg="">
                  <path d="M76.7 512V283H0v-91h76.7v-71.7C76.7 42.4 124.3 0 193.8 0c33.3 0 61.9 2.5 70.2 3.6V85h-48.2c-37.8 0-45.1 18-45.1 44.3V192H256l-11.7 91h-73.6v229"></path>
                </svg>
              </div></a><a href="#"><span class="icon twtr">
                <svg aria-hidden="true" data-prefix="fab" data-icon="twitter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                  <path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path>
                </svg></span></a><a href="#"><span class="icon wts">
                <svg id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                  <g>
                    <g>
                      <path d="M256.064,0h-0.128C114.784,0,0,114.816,0,256c0,56,18.048,107.904,48.736,150.048l-31.904,95.104l98.4-31.456    C155.712,496.512,204,512,256.064,512C397.216,512,512,397.152,512,256S397.216,0,256.064,0z M405.024,361.504    c-6.176,17.44-30.688,31.904-50.24,36.128c-13.376,2.848-30.848,5.12-89.664-19.264C189.888,347.2,141.44,270.752,137.664,265.792    c-3.616-4.96-30.4-40.48-30.4-77.216s18.656-54.624,26.176-62.304c6.176-6.304,16.384-9.184,26.176-9.184    c3.168,0,6.016,0.16,8.576,0.288c7.52,0.32,11.296,0.768,16.256,12.64c6.176,14.88,21.216,51.616,23.008,55.392    c1.824,3.776,3.648,8.896,1.088,13.856c-2.4,5.12-4.512,7.392-8.288,11.744c-3.776,4.352-7.36,7.68-11.136,12.352    c-3.456,4.064-7.36,8.416-3.008,15.936c4.352,7.36,19.392,31.904,41.536,51.616c28.576,25.44,51.744,33.568,60.032,37.024    c6.176,2.56,13.536,1.952,18.048-2.848c5.728-6.176,12.8-16.416,20-26.496c5.12-7.232,11.584-8.128,18.368-5.568    c6.912,2.4,43.488,20.48,51.008,24.224c7.52,3.776,12.48,5.568,14.304,8.736C411.2,329.152,411.2,344.032,405.024,361.504z"></path>
                    </g>
                  </g>
                </svg></span></a></div>
        </div>
        <div class="single-wrapper__article">

          @if($item->paragraph_body)

          @forelse($item->body??[] as $content)

              @if(!is_null($content['title']))
                <h4>{!! $content['title'] !!} </h4>
              @endif


              @if(!is_null($content['content']))
                {!! $content['content'] !!}
              @endif

              @if(!is_null($content['photos']))
                @foreach($content['photos'] as $Albumkey => $photo )
                  @php
                    $size = isset($content['size'])?$content['size'][$Albumkey]:'600x340';

                    $photoUrl    =  $Helper->getImageUrl($photo['fileName'],$size,$photo['path']);

                  @endphp
                    <img  class="lazy" src="{{url('img/placeholder.png')}}" image-src="{{$photoUrl}}" title="{{$photo['title']}}" >
                @endforeach
              @endif

              @if(!is_null($content['youtube']))

                @php
                  $content['youtube'] = str_replace("watch?v=","embed/",$content['youtube']);

                  $content['youtube'] = str_replace(".be/","be.com/embed/",$content['youtube']);
                @endphp
              <div class="article-iframe">
                <iframe src="{{$content['youtube']}} "></iframe>
              </div>
              @endif

              @if(!is_null($content['video']))
              @php
                if(strstr($content['video'],'twitter-tweet'))
                {
                  $class = "twitter-embed";
                }elseif (strstr($content['video'],'instagram-media'))
                {
                  $class = "instagram-embed";
                }
                elseif (strstr($content['video'],'facebook.com/plugins'))
                {
                  $class = "facebook-embed";
                }else
                {
                  $class = "other-embed";
                }
              @endphp
              <div class="article-embed  {{$class}}">
                {!! $content['video'] !!}
              </div>
              @endif
            @empty

            @endforelse



          @else
          <p> {!!$item->body !!}</p>
          @endif

        </div>
      </div>
      @if(count($item->keywords))
      <div class="single-wrapper__tags">
          @foreach($item->keywords as $tag)
          <a href="{{url('tags/'.$tag->keyword->slug)}}">{{$tag->keyword->name}} </a>
          @endforeach
      </div>
      @endif
      <!-- <div class="single-wrapper__nav">
        <a class="single-wrapper__prev" href="#">
          <span class="icon single-wrapper__arrow">
            <svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve">
              <g>
                <g>
                  <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12    c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028    c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265    c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"></path>
                </g>
              </g>
            </svg>
          </span>
          <div class="single-wrapper__nav-holder"><span class="single-wrapper__smText">السابق</span>
            <h2>حمادة هلال يفكر جديا في الطلاق و بالتالي والتالت والرابع</h2>
          </div></a><a class="single-wrapper__next" href="#">
          <div class="single-wrapper__nav-holder"><span class="single-wrapper__smText">التالي</span>
            <h2>حمادة هلال يفكر جديا في الطلاق و بالتالي والتالت والرابع</h2>
          </div><span class="icon single-wrapper__arrow">
            <svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 492 492" style="enable-background:new 0 0 492 492;" xml:space="preserve">
              <g>
                <g>
                  <path d="M198.608,246.104L382.664,62.04c5.068-5.056,7.856-11.816,7.856-19.024c0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12    C361.476,2.792,354.712,0,347.504,0s-13.964,2.792-19.028,7.864L109.328,227.008c-5.084,5.08-7.868,11.868-7.848,19.084    c-0.02,7.248,2.76,14.028,7.848,19.112l218.944,218.932c5.064,5.072,11.82,7.864,19.032,7.864c7.208,0,13.964-2.792,19.032-7.864    l16.124-16.12c10.492-10.492,10.492-27.572,0-38.06L198.608,246.104z"></path>
                </g>
              </g>
            </svg></span></a></div> -->
      <div class="related-section">
        <div class="main-title">
          <div class="main-title__box">
            <h1>مقالات متعلقة </h1>
          </div>
        </div>
        <div class="section__content">
          <div class="row">

            @forelse($item['related_news'] as $news)

            @php

              if(is_null($news->image))
              {
                   $imageUrl = url('default.png');
              }else
              {
                  $imageUrl= $news->image->getImageThumbAttribute()."?".time();
              }
            @endphp
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="news-card news-card--card">
                @include('website.shared.newsCardData')
              </div>
            </div>

            @empty

            @endforelse


          </div>
        </div>
      </div>
    </div>
    <div id="requested"></div>
  </section>
  @if(!IS_MOBILE)
    @include('website.sections.asideNews')
  @endif
</div>



@stop

@section('outContainer')
<div class="mob-icons touch">
  <div class="social-box social-box--fixed"><a href="#">
      <div class="icon fb">
        <svg aria-hidden="true" data-prefix="fab" data-icon="facebook-f" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 264 512" data-fa-i2svg="">
          <path d="M76.7 512V283H0v-91h76.7v-71.7C76.7 42.4 124.3 0 193.8 0c33.3 0 61.9 2.5 70.2 3.6V85h-48.2c-37.8 0-45.1 18-45.1 44.3V192H256l-11.7 91h-73.6v229"></path>
        </svg>
      </div></a><a href="#"><span class="icon twtr">
        <svg aria-hidden="true" data-prefix="fab" data-icon="twitter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
          <path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path>
        </svg></span></a><a href="#"><span class="icon wts">
        <svg id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
          <g>
            <g>
              <path d="M256.064,0h-0.128C114.784,0,0,114.816,0,256c0,56,18.048,107.904,48.736,150.048l-31.904,95.104l98.4-31.456    C155.712,496.512,204,512,256.064,512C397.216,512,512,397.152,512,256S397.216,0,256.064,0z M405.024,361.504    c-6.176,17.44-30.688,31.904-50.24,36.128c-13.376,2.848-30.848,5.12-89.664-19.264C189.888,347.2,141.44,270.752,137.664,265.792    c-3.616-4.96-30.4-40.48-30.4-77.216s18.656-54.624,26.176-62.304c6.176-6.304,16.384-9.184,26.176-9.184    c3.168,0,6.016,0.16,8.576,0.288c7.52,0.32,11.296,0.768,16.256,12.64c6.176,14.88,21.216,51.616,23.008,55.392    c1.824,3.776,3.648,8.896,1.088,13.856c-2.4,5.12-4.512,7.392-8.288,11.744c-3.776,4.352-7.36,7.68-11.136,12.352    c-3.456,4.064-7.36,8.416-3.008,15.936c4.352,7.36,19.392,31.904,41.536,51.616c28.576,25.44,51.744,33.568,60.032,37.024    c6.176,2.56,13.536,1.952,18.048-2.848c5.728-6.176,12.8-16.416,20-26.496c5.12-7.232,11.584-8.128,18.368-5.568    c6.912,2.4,43.488,20.48,51.008,24.224c7.52,3.776,12.48,5.568,14.304,8.736C411.2,329.152,411.2,344.032,405.024,361.504z"></path>
            </g>
          </g>
        </svg></span></a></div>
</div>
@stop
