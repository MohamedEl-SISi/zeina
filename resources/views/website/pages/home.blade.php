@extends('website.master')

@section('meta_url',env("APP_URL"))
@section('meta_title',"")
@section('meta_description',"منصة نسائية عربية رائدة تهدف لخلق مساحة آمنة وموثوق بها تلتقي فيها النساء لتلبية احتياجاتهن الأساسية بشكل فعّال في كافة المجالات كالصحة والتغذية والجمال والإنتاجية والاستقلال والعلاقات وغيرها.")
@section('data-page',"home")


@section('content')

@php
  $Helper= new App\Http\Helpers\Helpers;
@endphp


  @component('website.sections.fixedNewsHome')
      @slot("order",$data['fixed_News_order'])
      @slot("data",$data['fixed_News'])
      @slot("positionOne",$data['positionNews'][1]??[])
  @endcomponent
<div class="break-line">       </div>
  @component('website.sections.darkNewsSection')
      @slot("text",'اختيارات المحرر')
      @slot("data",$data['editor_News_chocie'])
  @endcomponent


  @php
    $category_first_News = collect($data['category_News']??[])->take(2);
  @endphp

@if(count($category_first_News) || count($data['category_Articles']??[]))
<div class="break-line">      </div>

<section class="mt20">
  <div class="layout-wrap">
    <div class="section-wrapper w-100">
      <div class="row ">


        @forelse($category_first_News as $key=>$category)
        @if(count($category))
            @component('website.sections.verticalNewsSection')
                @slot("text",$category[0]->section->name)
                @slot("url",'news/'.$category[0]->section->slug)
                @slot("data",$category)
            @endcomponent
            @endif
        @empty
        @endforelse

        @if(count(isset($data['category_Articles'])?$data['category_Articles']:[]))
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 mt15-1">
          <div class="main-title mt5">
            <div class="main-title__box"><a href="{{url('articles')}}"> آراء ومشاركات</a></div>
          </div>

          <div class="row">
            @forelse($data['category_Articles']??[] as $key=>$category)

                @component('website.sections.verticalArticlesSection')
                    @slot("text",$category[0]->section->name)
                    @slot("url",'articles/')
                    @slot("data",$category)
                @endcomponent

            @empty
            @endforelse
          </div>

          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                          @if(isset($data['positionNews'][2]))
                          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="news-card news-card--over size-C">
                              <a class="news-card__link" href="{{url('news/'.$data['positionNews'][2]->id.'/'.$data['positionNews'][2]->slug)}}"></a>
                              <div class="news-card__img"><img class="lazy" src="{{url('img/placeholder.png')}}" image-src="{{$data['positionNews'][2]->image->getImageThumbAttribute()}}?{{time()}}"/>
                              </div>
                              <div class="news-card__caption">
                                <div class="news-card__details">
                                  <div class="news-card__caption-row">
                                  </div><span class="news-card__title">{{$data['positionNews'][2]->title}}</span>
                                </div>
                              </div>
                            </div>
                          </div>
                          @endif
                          @if(isset($data['positionNews'][5]))
                          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="news-card news-card--over size-C">
                              <a class="news-card__link" href="{{url('news/'.$data['positionNews'][5]->id.'/'.$data['positionNews'][5]->slug)}}"></a>
                              <div class="news-card__img"><img class="lazy" src="{{url('img/placeholder.png')}}" image-src="{{$data['positionNews'][5]->image->getImageThumbAttribute()}}?{{time()}}"/>
                              </div>
                              <div class="news-card__caption">
                                <div class="news-card__details">
                                  <div class="news-card__caption-row">
                                  </div><span class="news-card__title">{{$data['positionNews'][5]->title}}</span>
                                </div>
                              </div>
                            </div>
                          </div>
                          @endif
                        </div>
                      </div>

          </div>


        </div>
        @endif
      </div>
    </div>
  </div>
</section>
@endif

@php
  $category_first_News = collect($data['category_News']??[])->skip(2)->take(3);
@endphp

@if(count($category_first_News))
<div class="break-line">              </div>
<section class="mt20">
  <div class="layout-wrap">
    <div class="section-wrapper w-100">
      <div class="row">

        @forelse($category_first_News as $key=>$category)
        @if(count($category))
            @component('website.sections.verticalNewsSection')
                @slot("text",$category[0]->section->name)
                @slot("url",'news/'.$category[0]->section->slug)
                @slot("data",$category)
            @endcomponent
            @endif
        @empty
        @endforelse

        <div class="col-lg-3 col-md-12 col-sm-6 col-xs-12 mt15-1">
          @if(isset($data['positionNews'][3]))
          <div class="news-card news-card--over handle-s1">
            <a class="news-card__link" href="{{url('news/'.$data['positionNews'][3]->id.'/'.$data['positionNews'][3]->slug)}}"></a>
            <div class="news-card__img"><img class="lazy" src="{{url('img/placeholder.png')}}" image-src="{{$data['positionNews'][3]->image->getImageThumbAttribute()}}?{{time()}}"/>
            </div>
            <div class="news-card__caption">
              <div class="news-card__details">
                <div class="news-card__caption-row">
                </div><span class="news-card__title">{{$data['positionNews'][3]->title}}</span>
              </div>
            </div>
          </div>
          @endif
            @if(isset($data['positionNews'][4]))
          <div class="news-card news-card--over">
            <a class="news-card__link" href="{{url('news/'.$data['positionNews'][4]->id.'/'.$data['positionNews'][4]->slug)}}"></a>
            <div class="news-card__img"><img class="lazy" src="{{url('img/placeholder.png')}}" image-src="{{$data['positionNews'][4]->image->getImageThumbAttribute()}}?{{time()}}"/>
            </div>
            <div class="news-card__caption">
              <div class="news-card__details">
                <div class="news-card__caption-row">
                </div><span class="news-card__title">{{$data['positionNews'][4]->title}}</span>
              </div>
            </div>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>

@endif

@if(count($data['files']))
<div class="break-line"></div>

@component('website.sections.FilesSection')
    @slot("data",$data['files'])
@endcomponent

@endif


@php
  $category_first_News = collect($data['category_News']??[])->skip(5)->take(3)->values();
@endphp

@if(count($category_first_News))

<div class="break-line">           </div>

<section class="mt20">
  <div class="layout-wrap">
    <div class="section-wrapper w-100">
      <div class="row">

        @forelse($category_first_News as $key=>$category)
          @if(count($category))
            @component('website.sections.verticalNewsSection')
                @slot("text",$category[0]->section->name)
                @slot("url",'news/'.$category[0]->section->slug)
                @slot("data",$category)
            @endcomponent
          @endif
        @empty
        @endforelse


        <!-- <div class="col-lg-3 col-md-12 col-sm-6 col-xs-12 mt15-1">
          <div class="news-card news-card--over handle-s1"><a class="news-card__link" href="#1"></a>
            <div class="news-card__img"><img src="img/posters/4.jpg"/>
            </div>
            <div class="news-card__caption">
              <div class="news-card__details">
                <div class="news-card__caption-row">
                </div><span class="news-card__title"></span>
              </div>
            </div>
          </div>
          <div class="news-card news-card--over"><a class="news-card__link" href="#1"></a>
            <div class="news-card__img"><img src="img/posters/1.jpg"/>
            </div>
            <div class="news-card__caption">
              <div class="news-card__details">
                <div class="news-card__caption-row">
                </div><span class="news-card__title"></span>
              </div>
            </div>
          </div>
        </div> -->
      </div>
    </div>
  </div>
</section>
@endif
@stop
