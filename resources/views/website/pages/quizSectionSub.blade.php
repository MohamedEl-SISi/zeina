@extends('website.master')

@section('meta_url',env("APP_URL"))
@section('meta_title','Quiz - '.$data['section']->name)
@section('meta_description',$data['section']->desc)
@section('data-page',"section")
@section('data-name',"quiz-Sub")


@section('content')

<div class="breadCrumb mt15">
  <div class="breadCrumb mt15">

  </div>
  <div class="cat-info">
    <div class="cat-info__img section-0"></div>
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

  <div class="layout-wrap">
    <section class="main-section">
      <div class="row cont">
              @each('website.shared.quizCard',$data['exams'],'item')
      </div>
        @if(count($data)==10)
      <a class="btn btn--primary" id="loadmore-cards"> عرض المزيد</a>
      @endif
    </section>

    @if(!IS_MOBILE)
      @include('website.sections.asideNews')
    @endif
  </div>
@stop
