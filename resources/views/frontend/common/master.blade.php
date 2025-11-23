<!DOCTYPE html>
<html lang="zxx" dir="ltr">
@include('frontend.common.head')

<body class="uni-body panel bg-white text-gray-900 dark:bg-black dark:text-white text-opacity-50 overflow-x-hidden">



    @include('frontend.common.header')

    <!-- Header end -->

    <!-- Wrapper start -->
    @yield('content')

    @include('frontend.common.footer')

    <!-- Footer end -->

    <!-- include jquery & bootstrap js -->
    {{-- <script defer src="{{ asset('frontend/js/libs/jquery.min.js')}}"></script> --}}
    <script defer src="{{ asset('frontend/js/libs/bootstrap.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.20.0/dist/jquery.validate.min.js"></script>
    <script defer src="{{ asset('frontend/js/validation.js')}}"></script>
    <!-- include scripts -->
    <script defer src="{{ asset('frontend/js/libs/anime.min.js')}}"></script>
    <script src="{{ asset('frontend/js/libs/swiper-bundle.min.js')}}"></script>
    <script defer src="{{ asset('frontend/js/libs/scrollmagic.min.js')}}"></script>
    <script defer src="{{ asset('frontend/js/helpers/data-attr-helper.js')}}"></script>
    <script src="{{ asset('frontend/js/helpers/swiper-helper.js')}}"></script>
    <script defer src="{{ asset('frontend/js/helpers/anime-helper.js')}}"></script>
    <script defer src="{{ asset('frontend/js/helpers/anime-helper-defined-timelines.js')}}"></script>
    <script defer src="{{ asset('frontend/js/uikit-components-bs.js')}}"></script>

    <!-- include app script -->
    <script defer src="{{ asset('frontend/js/app.js')}}"></script>
    @yield('scripts')
    <script>
        // Schema toggle via URL
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const getSchema = urlParams.get("schema");
        if (getSchema === "dark") {
            setDarkMode(1);
        } else if (getSchema === "light") {
            setDarkMode(0);
        }
    </script>
</body>

</html>