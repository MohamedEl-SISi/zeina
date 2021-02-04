@extends('website.master')

@section('meta_url',env("APP_URL"))
@section('meta_title',$data->title)
@section('meta_description',$data->desc)
@section('data-page',"section")


@section('content')

<div class="breadCrumb mt15">
  <div class="breadCrumb__list"><span class="icon breadCrumb__home">
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
      <a class="breadCrumb__link" href="{{url('/')}}">الرئيسية</a>
    </li>


  </div>
</div>
<div class="cat-info">
  <div class="cat-info__img section-1"></div>
  <div class="cat-info__over-lay"></div>
  <div class="cat-info__text">
    <div class="cat-info__name">
      <p>{{$data->title}}</p>
    </div>

    <div class="cat-info__desc">
      <p>{{$data->desc}}</p>
    </div>
  </div>
</div>
<div class="layout-wrap">
  <section class="main-section">
    <div class="row cont">

      @each('website.shared.bigNewsCard',$data['news'],'news')

    </div>
    <!-- <a class="btn btn--primary" id="loadmore-cards"> عرض المزيد</a> -->
  </section>

  @if(!IS_MOBILE)
    @include('website.sections.asideNews')
  @endif

</div>

@stop
