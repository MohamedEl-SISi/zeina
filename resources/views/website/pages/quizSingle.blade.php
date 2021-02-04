
@extends('website.master')

@section('meta_title',$item->title)
@section('meta_description',$item->desc)
@section('meta_url',env("APP_URL"))
@section('data-page',"quiz")



@section('content')


  <!-- <div class="ads">
    <img src="{{url('img/ad/768x90.png')}}" alt=""/>
  </div> -->
  <div class="layout-wrap">
    <section class="main-section">
      @php
        $Helper= new App\Http\Helpers\Helpers;
      @endphp
      <div class="single-wrapper" id="single-wrapper" >
        <div class="single-wrapper__img-holder mb25 mt15">
          @if(is_null($item->image))
          <img src="{{url('default.png')}}" alt="{{$item->title}}"/>
          @else
          <img src="{{$Helper->getImageUrl($item->image->fileName,'600x400',$item->image->path)}}" alt="{{$item->title}}"/>
          @endif

        </div>
        <div class="single-wrapper__title">
          <h1>{{$item->title}}</h1>

        </div>
        <div class="single-wrapper__content">
          <div class="social-box no-touch">
            <div class="handle-sticky">
              <a href="#">
                <div class="icon fb">
                  <svg aria-hidden="true" data-prefix="fab" data-icon="facebook-f" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 264 512" data-fa-i2svg="">
                    <path d="M76.7 512V283H0v-91h76.7v-71.7C76.7 42.4 124.3 0 193.8 0c33.3 0 61.9 2.5 70.2 3.6V85h-48.2c-37.8 0-45.1 18-45.1 44.3V192H256l-11.7 91h-73.6v229"></path>
                  </svg>
                </div>
              </a>
              <a href="#"><span class="icon twtr">
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
            <div class="q-box">

              @foreach($item->questions as $question)
              <div class="question question-head">
                <p class="single-wrapper__sm-title">{{$question->question_head}}</p>
                <ul>

                  @if(!is_null($question->answer_1))
                  <li>
                    <input class="choise" type="radio" name="selector" value="{{$question->answer_1_value}}"/>
                    <label for="f-option">{{$question->answer_1}}</label>
                    <div class="check"></div>
                  </li>
                  @endif
                  @if(!is_null($question->answer_2))
                  <li>
                    <input class="choise" type="radio" name="selector" value="{{$question->answer_2_value}}"/>
                    <label for="f-option">{{$question->answer_2}}</label>
                    <div class="check"></div>
                  </li>
                  @endif

                  @if(!is_null($question->answer_3))
                  <li>
                    <input class="choise" type="radio" name="selector" value="{{$question->answer_3_value}}"/>
                    <label for="f-option">{{$question->answer_3}}</label>
                    <div class="check"></div>
                  </li>
                  @endif

                  @if(!is_null($question->answer_4))
                  <li>
                    <input class="choise" type="radio" name="selector" value="{{$question->answer_4_value}}"/>
                    <label for="f-option">{{$question->answer_4}}</label>
                    <div class="check"></div>
                  </li>
                  @endif

                </ul>
              </div>
              @endforeach
              <div class="question">
                <div class="single-wrapper__result"><span class="single-wrapper__result-text mt15">النتيجة :</span></div>


                @foreach($item->result as $result)
                    <div class="single-wrapper__title noMr">
                      <div class="single-wrapper__answer" minscore="{{$result['from']}}" maxscore="{{$result['to']}}">
                        {{$result['text']}}
                        @if(isset($result['photos']))
                          <img class="single-wrapper__answer-img" src="{{$result['photos']['image_thumb']}}" alt=""/>
                        @endif
                      </div>
                    </div>

                @endforeach

              </div>
            </div>
          </div>
        </div>

        <div class="related-section mt15">
            <div class="main-title">
              <div class="main-title__box"><span> مزيد من الاختبارات </span></div>
            </div>
          <div class="section__content">
            <div class="row">

              @each('website.shared.quizCard',$item->related,'item')

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
