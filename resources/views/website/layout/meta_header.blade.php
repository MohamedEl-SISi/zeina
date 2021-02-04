<head>

  <link rel="stylesheet" href="{{url('css/style.css')}}?{{time()}}"/>
  <link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{url('img/icons/apple-icon-57x57.png')}}"/>
  <link rel="apple-touch-icon-precomposed" sizes="60x60" href="{{url('img/icons/apple-icon-60x60.png')}}"/>
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{url('img/icons/apple-icon-72x72.png')}}"/>
  <link rel="apple-touch-icon-precomposed" sizes="76x76" href="{{url('img/icons/apple-icon-76x76.png')}}"/>
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{url('img/icons/apple-icon-114x114.png')}}"/>
  <link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{url('img/icons/apple-icon-120x120.png')}}"/>
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{url('img/icons/apple-icon-144x144.png')}}"/>
  <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{url('img/icons/apple-icon-152x152.png')}}"/>
  <link rel="apple-touch-icon-precomposed" sizes="180x180" href="{{url('img/icons/apple-icon-180x180.png')}}"/>
  <link rel="apple-touch-icon-precomposed" sizes="192x192" href="{{url('img/icons/apple-icon-precomposed.png')}}"/>
  <link rel="icon" type="image/png" sizes="32x32" href="{{url('img/icons/favicon-32x32.png')}}"/>
  <link rel="icon" type="image/png" sizes="96x96" href="{{url('img/icons/android-icon-72x72.png')}}"/>
  <link rel="icon" type="image/png" sizes="96x96" href="{{url('img/icons/favicon-96x96.png')}}"/>
  <link rel="icon" type="image/png" sizes="16x16" href="{{url('img/icons/favicon-16x16.png')}}"/>
  <link rel="icon" type="image/png" sizes="32x32" href="{{url('img/icons/favicon-144x144.png')}}"/>
  <link rel="icon" type="image/png" sizes="192x192" href="{{url('img/icons/android-icon-192x192.png')}}"/>
  <link rel="icon" type="image/png" sizes="310x310" href="{{url('img/icons/favicon-310x310.png')}}"/>
<meta name="theme-color" content="#f1c7b8"/>
  <link rel="manifest" href="{{url('manifest.json')}}"/>
  <meta name="apple-mobile-web-app-status-bar" content="#f1c7b8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
  <meta charset="UTF-8"/>

  <title>@yield('meta_title') زينة</title>
  <meta name="description" content="@yield('meta_description')"/>

  <meta property="og:title" content="@yield('meta_title')"/>
  <meta property="og:description" content="@yield('meta_description')"/>

  <meta property="og:locale" content="ar_Ar" />
  <meta property="og:url" content="{{ urldecode (Request::url())}}" />
  <meta property="og:site_name" content="زينة" />

  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:description" content="@yield('meta_description')" />
  <meta name="twitter:title" content="@yield('meta_title')" />

  <meta name="keywords" content="@yield('keywords')" />
  <link rel="canonical" href="{{urldecode (Request::url())}}" />

  @yield('meta')

</head>
