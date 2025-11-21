<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light"
    data-width="fullwidth" data-menu-styles="light" data-toggled="close">
@include('backend.common.head')

<body>
    @include('backend.common.preloader')
    <div class="page">
        @include('backend.common.header')
        @include('backend.common.sidebar')
        @yield('content')
    </div>

    @include('backend.common.footer')
    @yield('scripts')

</body>

</html>