<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title') Zeina | Dashboard</title>
    <meta name="robots" content="noindex, nofollow">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="/assets/images/favicon.ico">
    <link rel="stylesheet" href="{{url('assets/css/vendor/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/vendor/material-design-iconic-font.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/vendor/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/vendor/themify-icons.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/vendor/cryptocurrency-icons.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/plugins/plugins.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/helper.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/style.css')}}">
    <link id="cus-style" rel="stylesheet" href="{{url('assets/css/style-primary.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/jquery.fancybox.min.css')}}" />
    <script src="{{url('assets/js/vendor/jquery-3.3.1.min.js')}}"></script>
<style>
    .modal-content
    {
        max-height: 600px;
        overflow-y: scroll;
    }
    #loader{
        position: fixed;
        width: 100%;
        height: 100vh;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0,0,0,0.5);
        display: none;
        z-index: 9999;
    }
    #loader.active
    {
        display: flex;
    }
    .spinner-border
    {
        width: 10rem;
        height: 10rem;

    }
    .farda
    {
        width: 100%;
    }
</style>
</head>


<div id ="loader" class="active"><div class="spinner-border text-danger" >
        <span class="sr-only">Loading...</span>
    </div></div>
<body class="header-top-light" dir="rtl">
<div class="main-wrapper">

    <div class="header-section">
        <div class="container-fluid">
            <div class="row justify-content-between align-items-center">

                <!-- Header Logo (Header Left) Start -->
                <div class="header-logo col-auto">
                    <a href="{{url('dashboard')}}">
                        <img src="/assets/images/logo/logo.png" alt="">
                        <img src="/assets/images/logo/logo-light.png" class="logo-light" alt="">
                    </a>
                </div><!-- Header Logo (Header Left) End -->

                <!-- Header Right Start -->
                <div class="header-right flex-grow-1 col-auto">
                    <div class="row justify-content-between align-items-center">

                        <div class="col-auto" style="width: 100%;width: calc(100% - 350px);">
                            <div class="row align-items-center" style="width: 100%;">

                                <div class="col-auto">
                                    <button class="side-header-toggle">
                                        <i class="zmdi zmdi-menu"></i>
                                    </button>
                                </div>



                            </div>
                        </div><!-- Side Header Toggle & Search End -->

                        <div class="col-auto">
                            <ul class="header-notification-area">

                                <li class="adomx-dropdown col-auto">
                                    <a class="toggle" href="#">
                                    <span class="user">

                                        <span class="name">{{auth::user()->name??null}}</span>
                                    </span>
                                    </a>

                                    <!-- Dropdown -->
                                    <div class="adomx-dropdown-menu dropdown-menu-user">
                                        <div class="head">
                                            <h5 class="name"><a href="#">{{auth::user()->name??null}}</a></h5>
                                        </div>
                                        <div class="body">
                                            <ul>
                                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="zmdi zmdi-lock-open"></i>تسجيل خروج</a></li>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                </form>
                                            </ul>
                                        </div>
                                    </div>

                                </li>

                            </ul>

                        </div><!-- Header Notifications Area End -->

                    </div>
                </div><!-- Header Right End -->

            </div>
        </div>
    </div>
    <div class="side-header hide">
        <button class="side-header-close"><i class="zmdi zmdi-close"></i></button>
        <!-- Side Header Inner Start -->
        <div class="side-header-inner custom-scroll">

            <nav class="side-header-menu" id="side-header-menu">
                <ul>
                    <li @if(Request::is('/dashboard')) class="active" @endif >
                      <a href="{{url('dashboard')}}">
                      <i class="zmdi zmdi-home zmdi-hc-fw"></i><span>الرئيسية</span>
                    </a>
                  </li>
                  <li  @if(Request::segment(2) =='news') class="active" @endif >
                      <a href="{{url('dashboard/news')}}">
                    <i class="zmdi zmdi-collection-text"></i><span>اخبار</span>
                    </a>
                  </li>

                  <li  @if(Request::segment(2) =='articles') class="active" @endif >
                      <a href="{{url('dashboard/articles')}}">
                    <i class="zmdi zmdi-file-plus"></i><span>المقالات</span>
                    </a>
                  </li>

                  <li  @if(Request::segment(2) =='question') class="active" @endif >
                      <a href="{{url('dashboard/question')}}">
                    <i class="zmdi zmdi-border-color"></i><span>الأسئلة</span>
                    </a>
                  </li>
                  @if(auth::user()->role->role_id <= 3)
                  <li  @if(Request::segment(2) =='files') class="active" @endif >
                      <a href="{{url('dashboard/files')}}">
                    <i class="zmdi zmdi-collection-item-1"></i><span>ملفات</span>
                    </a>
                  </li>
                  @endif

                  <li  @if(Request::segment(2) =='exam') class="active" @endif >
                      <a href="{{url('dashboard/exam')}}">
                    <i class="zmdi zmdi-puzzle-piece"></i><span>الأختبارات</span>
                    </a>
                  </li>


                    <li @if(Request::segment(2) =='image') class="active" @endif>
                      <a href="{{url('dashboard/image')}}">
                        <i class="zmdi zmdi-collection-image-o zmdi-hc-fw"></i>
                        <span>مكتبه الصور</span>
                      </a>
                    </li>
                    <li @if(Request::segment(2) =='keywords') class="active" @endif>
                      <a href="{{url('dashboard/keywords')}}">
                        <i class=" zmdi zmdi-tag"></i> <span>الكلمات الدالة</span>
                      </a>
                    </li>
                    @if(auth::user()->role->role_id <= 2)
                    <li @if(Request::segment(2) =='section') class="has-sub-menu active" @endif>
                      <a href="#">
                        <i class="zmdi zmdi-layers"></i> <span>االاقسام</span>
                    </a>
                        <ul class="side-header-sub-menu" >
                            <li @if(Request::segment(2) =='section') class="active" @endif><a href="{{url('dashboard/section')}}">
                              <span>تصنيفات </span></a>
                            </li>

                            <li @if(Request::segment(2) =='articleSection') class="active" @endif><a href="{{url('dashboard/articleSection')}}">
                              <span>تصنيفات  المقالات</span></a>
                            </li>

                            <li @if(Request::segment(2) =='examsSection') class="active" @endif><a href="{{url('dashboard/examsSection')}}">
                              <span>تصنيفات  الاختبارات </span></a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    <li @if(Request::segment(2) =='users') class="has-sub-menu active" @endif><a href="#">
                      <i class="zmdi zmdi-settings"></i>
                      <span>ادارة المستخدمين</span></a>
                        <ul class="side-header-sub-menu" >
                            <li><a href="{{url('dashboard/users')}}"><span>المستخدمين</span></a></li>
                            @if(auth::user()->role->role_id==1)
                              <li><a href="{{url('dashboard/roles')}}"><span>Role</span></a></li>
                            @endif
                        </ul>
                    </li>
                </ul>

            </nav>

        </div><!-- Side Header Inner End -->
    </div>
    @yield('content')
    <div class="footer-section">
        <div class="container-fluid">

            <div class="footer-copyright text-center">
                <p class="text-body-light">2020 &copy; <a href="{{url('/')}}">Zeina</a></p>
            </div>

        </div>
    </div>

</div>

<script>
    let loader = document.getElementById('loader');
    $(document).ready(function() {
        loader.classList.remove('active')
    });
</script>

<script src="{{url('assets/js/vendor/modernizr-3.6.0.min.js')}}"></script>
<script src="{{url('assets/js/vendor/popper.min.js')}}"></script>
<script src="{{url('assets/js/vendor/bootstrap.min.js')}}"></script>
<!--Plugins JS-->
<script src="{{url('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
<script src="{{url('assets/js/plugins/tippy4.min.js.js')}}"></script>
<!--Main JS-->
<script src="{{url('assets/js/main.js')}}"></script>
<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/js/plugins/sweetalert/sweetalert.active.js')}}"></script>
<script src="{{url('assets/js/jquery.fancybox.min.js')}}"></script>


@yield('script')

<script src="{{url('assets/js/plugins/moment/moment.min.js')}}"></script>
<script src="{{url('assets/js/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{url('assets/js/plugins/daterangepicker/daterangepicker.active.js')}}"></script>
<script src="{{url('assets/js/plugins/inputmask/bootstrap-inputmask.js')}}"></script>


<script src="{{url('assets/js/plugins/filepond/filepond.min.js')}}"></script>
<script src="{{url('assets/js/plugins/filepond/filepond-plugin-image-exif-orientation.min.js')}}"></script>
<script src="{{url('assets/js/plugins/filepond/filepond-plugin-image-preview.min.js')}}"></script>
<script src="{{url('assets/js/plugins/filepond/filepond.active.js')}}"></script>
<script src="{{url('assets/js/plugins/dropify/dropify.min.js')}}"></script>
<script src="{{url('assets/js/plugins/dropify/dropify.active.js')}}"></script>

</body>

</html>
