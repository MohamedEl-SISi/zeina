@extends('website.master')

@section('meta_url',env("APP_URL"))
@section('meta_title',$data['section']->name)
@section('meta_description',$data['section']->desc)
@section('data-page',"section")
@section('data-name',"news")


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

    @if(!is_null($data['section']->parent))
          <span class="icon">
          <svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 492 492" style="enable-background:new 0 0 492 492;" xml:space="preserve">
            <g>
              <g>
                <path d="M198.608,246.104L382.664,62.04c5.068-5.056,7.856-11.816,7.856-19.024c0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12    C361.476,2.792,354.712,0,347.504,0s-13.964,2.792-19.028,7.864L109.328,227.008c-5.084,5.08-7.868,11.868-7.848,19.084    c-0.02,7.248,2.76,14.028,7.848,19.112l218.944,218.932c5.064,5.072,11.82,7.864,19.032,7.864c7.208,0,13.964-2.792,19.032-7.864    l16.124-16.12c10.492-10.492,10.492-27.572,0-38.06L198.608,246.104z"></path>
              </g>
            </g>
          </svg>
        </span>

      <li class="breadCrumb__item">
        <a href="{{$data['section']->parent->slug}}" class="breadCrumb__link">{{$data['section']->parent->name}}</a>
      </li>
    @endif
    <span class="icon">
      <svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 492 492" style="enable-background:new 0 0 492 492;" xml:space="preserve">
        <g>
          <g>
            <path d="M198.608,246.104L382.664,62.04c5.068-5.056,7.856-11.816,7.856-19.024c0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12    C361.476,2.792,354.712,0,347.504,0s-13.964,2.792-19.028,7.864L109.328,227.008c-5.084,5.08-7.868,11.868-7.848,19.084    c-0.02,7.248,2.76,14.028,7.848,19.112l218.944,218.932c5.064,5.072,11.82,7.864,19.032,7.864c7.208,0,13.964-2.792,19.032-7.864    l16.124-16.12c10.492-10.492,10.492-27.572,0-38.06L198.608,246.104z"></path>
          </g>
        </g>
      </svg></span>
    <li class="breadCrumb__item"><span class="breadCrumb__link"> {{$data['section']->name}}  </span></li>
  </div>
</div>
@php
$sectionID = is_null($data['section']->parent)?$data['section']->id:$data['section']->parent->id;
@endphp

<div class="cat-info">
  <div class="cat-info__img
  @switch($sectionID)
    @case(1)
      section-1
    @break

    @case(14)
      section-2
    @break

    @case(5)
      section-3
    @break

    @case(19)
      section-4
    @break

    @case(9)
      section-5
    @break

    @case(18)
      section-6
    @break

    @case(20)
      section-7
    @break

    @default
    section-0

  @endswitch


  "></div>
  <div class="cat-info__over-lay"></div>
  <div class="cat-info__text">
    <div class="cat-info__name">
      <p>{{$data['section']->name}}</p>
    </div>

    <div class="cat-info__desc">
      <p>{{$data['section']->desc}}</p>
    </div>
  </div>
</div>
@if(count($data['section']->sub->where('status','published')))
<div class="cat-menu">

  @foreach($data['section']->sub as $subSection)
    @if($subSection->status == "published")
        <div class="cat-menu__item"><a class="cat-menu__link" href="{{url('news/'.$subSection->slug)}}">{{$subSection->name}}</a></div>
    @endif
  @endforeach

</div>
@endif
<div class="layout-wrap">
  <section class="main-section">
    <div class="row cont">

      @each('website.shared.bigNewsCard',$data['news'],'news')

    </div>
    @if(count($data['news'])==10)
    <a class="btn btn--primary" id="loadmore-cards"> عرض المزيد</a>
    @endif
  </section>

  @if(!IS_MOBILE)
    @include('website.sections.asideNews')
  @endif

</div>

@stop
