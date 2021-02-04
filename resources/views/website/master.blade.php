
<html dir="rtl">
  @include('website.layout.meta_header')
  <body>
    <div id="app">

      @include('website.layout.side_menu')
      <div class="wrapper">

          @include('website.layout.header')


        <div class="container app-box" id="app-box" data-src="@yield('data-page')"section-name="@yield('data-name')">
          @yield('content')
        </div>

          @yield('outContainer')
    </div>

      @include('website.layout.footer')

    </div>

    <script src="{{url('js/bundle.js')}}?{{time()}}"></script>

  </body>
</html>
