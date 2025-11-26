<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    @yield('meta_title', optional($settings)->meta_title)
  </title>

  <meta name="description" content="@yield('meta_description', optional($settings)->meta_description)">

  <meta name="keywords" content="@yield('meta_keywords', optional($settings)->meta_keywords)">

  <meta name="theme-color" content="#2757fd">
  <link rel="canonical" href="{{ url()->current() }}">
  <link rel="icon" type="image/png" href="{{ asset(optional($settings)->favicon) }}">
  <link rel="shortcut icon" href="{{ asset(optional($settings)->favicon) }}" type="image/png">
  <link rel="apple-touch-icon" href="{{ asset(optional($settings)->favicon) }}">
  <!-- preload head styles -->
  <link rel="preload" href="{{ asset('frontend/css/unicons.min.css')}}" as="style">
  <link rel="preload" href="{{ asset('frontend/css/swiper-bundle.min.css')}}" as="style">

  <!-- preload footer scripts -->
  <link rel="preload" href="{{ asset('frontend/js/libs/jquery.min.js')}}" as="script">
  <link rel="preload" href="{{ asset('frontend/js/libs/scrollmagic.min.js')}}" as="script">
  <link rel="preload" href="{{ asset('frontend/js/libs/swiper-bundle.min.js')}}" as="script">
  <link rel="preload" href="{{ asset('frontend/js/libs/anime.min.js')}}" as="script">
  <link rel="preload" href="{{ asset('frontend/js/helpers/data-attr-helper.js')}}" as="script">
  <link rel="preload" href="{{ asset('frontend/js/helpers/swiper-helper.js')}}" as="script">
  <link rel="preload" href="{{ asset('frontend/js/helpers/anime-helper.js')}}" as="script">
  <link rel="preload" href="{{ asset('frontend/js/helpers/anime-helper-defined-timelines.js')}}" as="script">
  <link rel="preload" href="{{ asset('frontend/js/uikit-components-bs.js')}}" as="script">
  <link rel="preload" href="{{ asset('frontend/js/app.js')}}" as="script">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
    integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- app head for bootstrap core -->
  <script src="{{ asset('frontend/js/app-head-bs.js')}}"></script>

  <!-- include uni-core components -->
  <link rel="stylesheet" href="{{ asset('frontend/js/uni-core/css/uni-core.min.css')}}">

  <!-- include styles -->
  <link rel="stylesheet" href="{{ asset('frontend/css/unicons.min.css')}}">
  <link rel="stylesheet" href="{{ asset('frontend/css/prettify.min.css')}}">
  <link rel="stylesheet" href="{{ asset('frontend/css/swiper-bundle.min.css')}}">

  <!-- include main style -->
  <link rel="stylesheet" href="{{ asset('frontend/css/theme/demo-seven.min.css')}}">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

  <!-- include scripts -->
  <script src="{{ asset('frontend/js/uni-core/js/uni-core-bundle.min.js')}}"></script>
  <link rel="stylesheet" href="{{ asset('frontend/css/style.css')}}">
</head>