
@section('script')
    <script src="{{url('assets/js/plugins/moment/moment.min.js')}}"></script>
    <script src="{{url('assets/js/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{url('assets/js/plugins/daterangepicker/daterangepicker.active.js')}}"></script>
    <script src="{{url('assets/js/plugins/chartjs/Chart.min.js')}}"></script>
    <script src="{{url('assets/js/plugins/chartjs/chartjs.active.js')}}"></script>
@stop

@extends('dashboard.layouts.app')
@section('content')
<style>
.addNewsHome
{
  position: absolute;left: 3%;top: 4%;
}
@media only screen and (max-width: 600px) {
  .addNewsHome
  {
    left: 6%;
    top: 20%;
  }
}
</style>
    <div class="content-body">
        <div class="row justify-content-between align-items-center mb-10">
            <div class="col-12 col-lg-auto mb-20">
                <div class="page-heading">
                    <h3>مرحبا</h3>
                </div>
            </div>
        </div>
        <div class="row">

          @if(auth::user()->role->role_id <= 2)

          <div class="col-xlg-12 col-md-12 col-sm-12 col-lg-12 mb-30">
          {!!Form::open(array('url'=>url('dashboard/socailMedia'),'method' => 'post','files'=>true,'style'=>'width: 100%',"class"=>"row"))!!}

            <div class="col-lg-3 ">
                {!!Form::text('data[facebook]',$data['facebook']??null,array('class'=>'form-control ','placeholder'=>'Facebook Link','autocomplete'=>'off','style'=>'text-align: left'))!!}
            </div>
            <div class="col-lg-3 ">
                {!!Form::text('data[twitter]',$data['twitter']??null,array('class'=>'form-control ','placeholder'=>'Twitter Link','autocomplete'=>'off','style'=>'text-align: left'))!!}
            </div>
            <div class="col-lg-3 ">
                {!!Form::text('data[instagram]',$data['instagram']??null,array('class'=>'form-control ','placeholder'=>'Instagram Link','autocomplete'=>'off','style'=>'text-align: left'))!!}
            </div>
            <div class="col-lg-3">
                {!!Form::submit('Save', array('class'=>'button button-primary farda'))!!}
            </div>

          </form>
        </div>
        @endif
            <div class="col-xlg-3 col-md-3 col-sm-6 col-lg-3 mb-30">
                <div class="top-report">
                    <div class="head">
                        <h4>عدد التصنيفات الرئيسية</h4>
                        @if(auth::user()->role->role_id <= 2)
                                        <a href="{{url('dashboard/section')}}" class="view"><i class="zmdi zmdi-eye"></i></a>
                        @endif
                    </div>
                    <div class="content">
                        <h2>{{$sectionCount??0}}</h2>
                    </div>
                    <div class="footer">
                        <div class="progess">
                            <div class="progess-bar" style="width: 90%;"></div>
                        </div>
                        @if(auth::user()->role->role_id <= 2)
                        <a href="{{url('dashboard/section/create')}}">اضافة تصنيف رئيسي</a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-xlg-3 col-md-3 col-sm-6 col-lg-3 mb-30">
                <div class="top-report">
                    <div class="head">
                        <h4>عدد التصنيفات المقالات </h4>
                        @if(auth::user()->role->role_id <= 2)
                        <a href="{{url('dashboard/articleSection')}}" class="view"><i class="zmdi zmdi-eye"></i></a>
                        @endif
                    </div>
                    <div class="content">
                        <h2>{{$sectionArticlesCount??0}}</h2>
                    </div>
                    <div class="footer">
                        <div class="progess">
                            <div class="progess-bar" style="width: 98%;"></div>
                        </div>
                        @if(auth::user()->role->role_id <= 2)
                        <a href="{{url('dashboard/articleSection/create')}}">إضافة تصنيف مقالات </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xlg-3 col-md-3 col-sm-6 col-lg-3 mb-30">
                <div class="top-report">
                    <div class="head">
                        <h4>عدد الصور</h4>
                        <a href="{{url('dashboard/image')}}" class="view"><i class="zmdi zmdi-eye"></i></a>
                    </div>
                    <div class="content">
                        <h2>{{$imageCount??0}}</h2>
                    </div>
                    <div class="footer">
                        <div class="progess">
                            <div class="progess-bar" style="width: 88%;"></div>
                        </div>

                    </div>
                    <a href="{{url('dashboard/image/create')}}">اضافة صوره </a>

                </div>
            </div>
            <div class="col-xlg-3 col-md-3 col-sm-6 col-lg-3 mb-30">
                <div class="top-report">
                    <div class="head">
                        <h4>عدد الأخبار</h4>
                        <a href="{{url('dashboard/news')}}" class="view"><i class="zmdi zmdi-eye"></i></a>
                    </div>
                    <div class="content">
                        <h2>{{$newsCount??0}}</h2>
                    </div>
                    <div class="footer">
                        <div class="progess">
                            <div class="progess-bar" style="width: 88%;"></div>
                        </div>

                    </div>
                    <a href="{{url('dashboard/news/create')}}">اضافة خبر</a>

                </div>
            </div>
            <div class="col-xlg-3 col-md-3 col-sm-6 col-lg-3 mb-30">
                <div class="top-report">
                    <div class="head">
                        <h4>عدد مقالات</h4>
                        <a href="{{url('dashboard/articles')}}" class="view"><i class="zmdi zmdi-eye"></i></a>
                    </div>
                    <div class="content">
                        <h2>{{$articlesCount??0}}</h2>
                    </div>
                    <div class="footer">
                        <div class="progess">
                            <div class="progess-bar" style="width: 88%;"></div>
                        </div>

                    </div>
                    <a href="{{url('dashboard/articles/create')}}">إضافة مقالات </a>

                </div>
            </div>
            <div class="col-xlg-3 col-md-3 col-sm-6 col-lg-3 mb-30">
                <div class="top-report">
                    <div class="head">
                        <h4>عدد  الاختبارات</h4>
                        <a href="{{url('dashboard/exam')}}" class="view"><i class="zmdi zmdi-eye"></i></a>
                    </div>
                    <div class="content">
                        <h2>{{$examCount??0}}</h2>
                    </div>
                    <div class="footer">
                        <div class="progess">
                            <div class="progess-bar" style="width: 88%;"></div>
                        </div>

                    </div>
                    <a href="{{url('dashboard/exam/create')}}">اضافة اختبار</a>

                </div>
            </div>



{{--            <div class="col-xlg-3 col-md-3 col-sm-6 col-lg-3 mb-30">--}}
{{--                <div class="top-report">--}}
{{--                    <div class="head">--}}
{{--                        <h4>عدد المكونات</h4>--}}
{{--                        <a href="#" class="view"><i class="zmdi zmdi-eye"></i></a>--}}
{{--                    </div>--}}
{{--                    <div class="content">--}}
{{--                        <h2>{{$total_facilitiyes??0}}</h2>--}}
{{--                    </div>--}}
{{--                    <div class="footer">--}}
{{--                        <div class="progess">--}}
{{--                            <div class="progess-bar" style="width: 76%;"></div>--}}
{{--                        </div>--}}
{{--                        <p>اضافة مكون</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
        <div class="row mbn-30">

            <!-- Daily Sale Report Start -->
            {{--<div class="col-xlg-4 col-lg-6 col-12 mb-30">--}}
                {{--<div class="box">--}}
                    {{--<div class="box-head">--}}
                        {{--<h4 class="title">Daily Sale Report</h4>--}}
                    {{--</div>--}}
                    {{--<div class="box-body">--}}
                        {{--<div class="table-responsive">--}}
                            {{--<table class="table daily-sale-report">--}}

                                {{--<!-- Table Head Start -->--}}
                                {{--<thead>--}}
                                {{--<tr>--}}
                                    {{--<th>Client</th>--}}
                                    {{--<th>Detail</th>--}}
                                    {{--<th>Payment</th>--}}
                                {{--</tr>--}}
                                {{--</thead><!-- Table Head End -->--}}

                                {{--<!-- Table Body Start -->--}}
                                {{--<tbody>--}}
                                {{--<tr>--}}
                                    {{--<td class="fw-600">Alexander</td>--}}
                                    {{--<td>--}}
                                        {{--<p>Sed do eiusmod tempor <br>incididunt ut labore.</p>--}}
                                    {{--</td>--}}
                                    {{--<td><span class="text-success d-flex justify-content-between fw-600">$500.00<span class="tippy" data-tippy-content="Sed do eiusmod tempor <br/> incididunt ut labore."><i class="zmdi zmdi-info-outline"></i></span></span></td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<td class="fw-600">Linda</td>--}}
                                    {{--<td>--}}
                                        {{--<p>Sed do eiusmod tempor <br>incididunt ut labore.</p>--}}
                                    {{--</td>--}}
                                    {{--<td><span class="text-success d-flex justify-content-between fw-600">$20.00<span class="tippy" data-tippy-content="Sed do eiusmod tempor <br/> incididunt ut labore."><i class="zmdi zmdi-info-outline"></i></span></span></td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<td class="fw-600">Patrick</td>--}}
                                    {{--<td>--}}
                                        {{--<p>Sed do eiusmod tempor <br>incididunt ut labore.</p>--}}
                                    {{--</td>--}}
                                    {{--<td><span class="text-danger d-flex justify-content-between fw-600">$120.00<span class="tippy" data-tippy-content="Sed do eiusmod tempor <br/> incididunt ut labore."><i class="zmdi zmdi-info-outline"></i></span></span></td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<td class="fw-600">Jose</td>--}}
                                    {{--<td>--}}
                                        {{--<p>Sed do eiusmod tempor <br>incididunt ut labore.</p>--}}
                                    {{--</td>--}}
                                    {{--<td><span class="text-success d-flex justify-content-between fw-600">$1750.00<span class="tippy" data-tippy-content="Sed do eiusmod tempor <br/> incididunt ut labore."><i class="zmdi zmdi-info-outline"></i></span></span></td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<td class="fw-600">Amber</td>--}}
                                    {{--<td>--}}
                                        {{--<p>Sed do eiusmod tempor <br>incididunt ut labore.</p>--}}
                                    {{--</td>--}}
                                    {{--<td><span class="text-warning d-flex justify-content-between fw-600">$165.00<span class="tippy" data-tippy-content="Sed do eiusmod tempor <br/> incididunt ut labore."><i class="zmdi zmdi-info-outline"></i></span></span></td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<td class="fw-600">Linda</td>--}}
                                    {{--<td>--}}
                                        {{--<p>Sed do eiusmod tempor <br>incididunt ut labore.</p>--}}
                                    {{--</td>--}}
                                    {{--<td><span class="text-success d-flex justify-content-between fw-600">$20.00<span class="tippy" data-tippy-content="Sed do eiusmod tempor <br/> incididunt ut labore."><i class="zmdi zmdi-info-outline"></i></span></span></td>--}}
                                {{--</tr>--}}
                                {{--</tbody><!-- Table Body End -->--}}

                            {{--</table>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div><!-- Daily Sale Report End -->--}}

            <!-- To Do List Start -->
            <!-- Chat Start -->
            {{--<div class="col-xlg-4 col-lg-6 col-12 mb-30">--}}
                {{--<div class="box">--}}
                    {{--<div class="box-head">--}}
                        {{--<h4 class="title">Recent Chats</h4>--}}
                    {{--</div>--}}
                    {{--<div class="box-body">--}}

                        {{--<div class="widget-chat-wrap custom-scroll">--}}
                            {{--<ul class="widget-chat-list">--}}
                                {{--<li>--}}
                                    {{--<div class="widget-chat">--}}
                                        {{--<div class="head">--}}
                                            {{--<h5>Rebecca Mitchell</h5>--}}
                                            {{--<span>Yesterday 05.30 am</span>--}}
                                            {{--<a href="#"><i class="zmdi zmdi-replay"></i></a>--}}
                                        {{--</div>--}}
                                        {{--<div class="body">--}}
                                            {{--<div class="image"><img src="assets\images\comment\comment-1.jpg" alt=""></div>--}}
                                            {{--<div class="content">--}}
                                                {{--<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text</p>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<div class="widget-chat">--}}
                                        {{--<div class="head">--}}
                                            {{--<h5>Jennifer White</h5>--}}
                                            {{--<span>Today 06.30 am</span>--}}
                                            {{--<a href="#"><i class="zmdi zmdi-replay"></i></a>--}}
                                        {{--</div>--}}
                                        {{--<div class="body">--}}
                                            {{--<div class="image"><img src="assets\images\comment\comment-2.jpg" alt=""></div>--}}
                                            {{--<div class="content">--}}
                                                {{--<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the.</p>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<div class="widget-chat">--}}
                                        {{--<div class="head">--}}
                                            {{--<h5>Roger Welch</h5>--}}
                                            {{--<span>Today 06.31 am</span>--}}
                                            {{--<a href="#"><i class="zmdi zmdi-replay"></i></a>--}}
                                        {{--</div>--}}
                                        {{--<div class="body">--}}
                                            {{--<div class="image"><img src="assets\images\comment\comment-3.jpg" alt=""></div>--}}
                                            {{--<div class="content">--}}
                                                {{--<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<div class="widget-chat">--}}
                                        {{--<div class="head">--}}
                                            {{--<h5>Rebecca Mitchell</h5>--}}
                                            {{--<span>Yesterday 05.30 am</span>--}}
                                            {{--<a href="#"><i class="zmdi zmdi-replay"></i></a>--}}
                                        {{--</div>--}}
                                        {{--<div class="body">--}}
                                            {{--<div class="image"><img src="assets\images\comment\comment-1.jpg" alt=""></div>--}}
                                            {{--<div class="content">--}}
                                                {{--<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text</p>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<div class="widget-chat">--}}
                                        {{--<div class="head">--}}
                                            {{--<h5>Jennifer White</h5>--}}
                                            {{--<span>Today 06.30 am</span>--}}
                                            {{--<a href="#"><i class="zmdi zmdi-replay"></i></a>--}}
                                        {{--</div>--}}
                                        {{--<div class="body">--}}
                                            {{--<div class="image"><img src="assets\images\comment\comment-2.jpg" alt=""></div>--}}
                                            {{--<div class="content">--}}
                                                {{--<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the.</p>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<div class="widget-chat">--}}
                                        {{--<div class="head">--}}
                                            {{--<h5>Roger Welch</h5>--}}
                                            {{--<span>Today 06.31 am</span>--}}
                                            {{--<a href="#"><i class="zmdi zmdi-replay"></i></a>--}}
                                        {{--</div>--}}
                                        {{--<div class="body">--}}
                                            {{--<div class="image"><img src="assets\images\comment\comment-3.jpg" alt=""></div>--}}
                                            {{--<div class="content">--}}
                                                {{--<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}

                        {{--<div class="widget-chat-submission">--}}
                            {{--<form action="#">--}}
                                {{--<input type="text" placeholder="Type something">--}}
                                {{--<div class="buttons">--}}
                                    {{--<label class="file-upload button button-sm button-box button-round button-primary" for="chat-file-upload">--}}
                                        {{--<input type="file" id="chat-file-upload" multiple="">--}}
                                        {{--<i class="zmdi zmdi-attachment-alt"></i>--}}
                                    {{--</label>--}}
                                    {{--<button class="submit button button-sm button-box button-round button-primary"><i class="zmdi zmdi-mail-send"></i></button>--}}
                                {{--</div>--}}
                            {{--</form>--}}
                        {{--</div>--}}

                    {{--</div>--}}
                {{--</div>--}}
            {{--</div><!-- Chat End -->--}}

            <!-- News & Updates Start -->
            {{--<div class="col-xlg-5 col-lg-6 col-12 mb-30">--}}
                {{--<!-- News & Updates Wrap Start -->--}}
                {{--<div class="box">--}}
                    {{--<div class="box-head">--}}
                        {{--<h4 class="title">News & Updates</h4>--}}
                    {{--</div>--}}
                    {{--<div class="box-body">--}}
                        {{--<!-- News & Updates Inner Start -->--}}
                        {{--<div class="news-update-inner">--}}

                            {{--<!-- News Item -->--}}
                            {{--<div class="news-item">--}}

                                {{--<!-- Content -->--}}
                                {{--<div class="content">--}}
                                    {{--<!-- Category -->--}}
                                    {{--<div class="categories">--}}
                                        {{--<a href="#" class="new">New</a>--}}
                                        {{--<a href="#" class="product">Product</a>--}}
                                    {{--</div>--}}
                                    {{--<!-- Title -->--}}
                                    {{--<h4 class="title"><a href="#">Sed do eiusmod tempor incididunt ut labore. Lorem Ipsum is simplydummy text of the printing and typesetting industry.</a></h4>--}}
                                    {{--<!-- Meta -->--}}
                                    {{--<ul class="meta">--}}
                                        {{--<li><i class="zmdi zmdi-time"></i>10 Houre ago</li>--}}
                                        {{--<li>By: <a href="#">Howard</a></li>--}}
                                    {{--</ul>--}}
                                {{--</div>--}}

                            {{--</div>--}}

                            {{--<!-- News Item -->--}}
                            {{--<div class="news-item">--}}

                                {{--<!-- Content -->--}}
                                {{--<div class="content">--}}
                                    {{--<!-- Category -->--}}
                                    {{--<div class="categories">--}}
                                        {{--<a href="#" class="support">Support</a>--}}
                                    {{--</div>--}}
                                    {{--<!-- Title -->--}}
                                    {{--<h4 class="title"><a href="#">Sed do eiusmod tempor labore. Lorem Ipsum is simplydummy text of the printing and.</a></h4>--}}
                                    {{--<!-- Meta -->--}}
                                    {{--<ul class="meta">--}}
                                        {{--<li><i class="zmdi zmdi-time"></i>10 Houre ago</li>--}}
                                        {{--<li>By: <a href="#">Aaron</a></li>--}}
                                    {{--</ul>--}}
                                {{--</div>--}}

                            {{--</div>--}}

                            {{--<!-- News Item -->--}}
                            {{--<div class="news-item">--}}

                                {{--<!-- Content -->--}}
                                {{--<div class="content">--}}
                                    {{--<!-- Category -->--}}
                                    {{--<div class="categories">--}}
                                        {{--<a href="#" class="refund">Refund</a>--}}
                                    {{--</div>--}}
                                    {{--<!-- Title -->--}}
                                    {{--<h4 class="title"><a href="#">Sed do eiusmod typesetting industry. Lorem Ipsum is simplydummy text of the printing and typesetting industry.</a></h4>--}}
                                    {{--<!-- Meta -->--}}
                                    {{--<ul class="meta">--}}
                                        {{--<li><i class="zmdi zmdi-time"></i>10 Houre ago</li>--}}
                                        {{--<li>By: <a href="#">Dylan</a></li>--}}
                                    {{--</ul>--}}
                                {{--</div>--}}

                            {{--</div>--}}

                        {{--</div><!-- News & Updates Inner End -->--}}
                    {{--</div>--}}
                {{--</div><!-- News & Updates Wrap End -->--}}
            {{--</div><!-- News & Updates End -->--}}

            <!-- Top Selling Country Start -->

        </div>
    </div>
@endsection
