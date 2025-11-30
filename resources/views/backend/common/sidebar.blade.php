<aside class="app-sidebar sticky" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <a href="index.html" class="header-logo">
            <img src="{{ asset('frontend/images/logo/logo.jpg')}}" alt="logo" class="desktop-logo">
            <img src="{{ asset('backend/assets/images/brand-logos/toggle-dark.png')}}" alt="logo" class="toggle-dark">
            <img src="{{ asset('backend/assets/images/brand-logos/desktop-dark.png')}}" alt="logo" class="desktop-dark">
            <img src="{{ asset('backend/assets/images/brand-logos/toggle-logo.png')}}" alt="logo" class="toggle-logo">
        </a>
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll">

        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg>
            </div>
            <ul class="main-menu">

                <!-- Start::slide -->
                <li class="slide">
                    <a href="{{ route('admin.dashboard') }}"
                        class="side-menu__item {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}">
                        <i class="side-menu__icon ri-dashboard-line"></i>
                        <span class="side-menu__label">Dashboards</span>
                    </a>
                </li>

                <li
                    class="slide has-sub {{ in_array(Route::currentRouteName(), ['admin.comment.list', 'admin.category.index', 'admin.category.add', 'admin.sub.category.index', 'admin.sub.category.add', 'admin.news.list', 'admin.news.add']) ? 'active' : '' }}">
                    <a href="javascript:void(0);"
                        class="side-menu__item {{ in_array(Route::currentRouteName(), ['admin.comment.list', 'admin.category.index', 'admin.category.add', 'admin.sub.category.index', 'admin.sub.category.add', 'admin.news.list', 'admin.news.add']) ? 'active' : '' }}">
                        <i class="ri-arrow-right-s-line side-menu__angle"></i>
                        <i class="side-menu__icon ri-newspaper-line"></i>
                        <span class="side-menu__label">Manage News</span>
                    </a>

                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a href="{{ route('admin.category.index') }}"
                                class="side-menu__item {{ in_array(Route::currentRouteName(), ['admin.category.index', 'admin.category.add']) ? 'active' : '' }}">
                                Category
                            </a>
                        </li>

                        <li class="slide">
                            <a href="{{ route('admin.sub.category.index') }}"
                                class="side-menu__item {{ in_array(Route::currentRouteName(), ['admin.sub.category.index', 'admin.sub.category.add']) ? 'active' : '' }}">Sub
                                Category</a>
                        </li>

                        <li class="slide">
                            <a href="{{ route('admin.news.list') }}"
                                class="side-menu__item {{ in_array(Route::currentRouteName(), ['admin.news.list', 'admin.news.add']) ? 'active' : '' }}">News</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('admin.comment.list') }}"
                                class="side-menu__item {{ in_array(Route::currentRouteName(), ['admin.comment.list']) ? 'active' : '' }}">Comments</a>
                        </li>
                    </ul>
                </li>
                <li class="slide">
                    <a href="{{ route('admin.video.list') }}"
                        class="side-menu__item {{ in_array(Route::currentRouteName(), ['admin.video.list', 'admin.video.add']) ? 'active' : '' }}">
                        <i class="side-menu__icon ri-video-line"></i>
                        <span class="side-menu__label">Videos</span>
                    </a>
                </li>
                <li
                    class="slide has-sub {{ in_array(Route::currentRouteName(), ['admin.ads.list', 'admin.ads.add']) ? 'active' : '' }}">
                    <a href="javascript:void(0);"
                        class="side-menu__item {{ in_array(Route::currentRouteName(), ['admin.ads.list', 'admin.ads.add']) ? 'active' : '' }}">
                        <i class="ri-arrow-right-s-line side-menu__angle"></i>
                        <i class="side-menu__icon ri-megaphone-line"></i>
                        <span class="side-menu__label">Ads Management</span>
                    </a>

                    <ul class="slide-menu child1">
                         <li class="slide">
                            <a href="{{ route('admin.ads.list') }}"
                                class="side-menu__item {{ in_array(Route::currentRouteName(), ['admin.ads.list', 'admin.ads.add']) ? 'active' : '' }}">
                                Normal Ads
                            </a>
                        </li>
                         <li class="slide">
                            <a href="#"
                                class="side-menu__item ">
                                Classified Ads
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="slide">
                    <a href="{{ route('admin.settings') }}"
                        class="side-menu__item {{ Route::currentRouteName() == 'admin.settings' ? 'active' : '' }}">
                        <i class="side-menu__icon ri-settings-3-line"></i>
                        <span class="side-menu__label">Settings</span>
                    </a>
                </li>

            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24"
                    height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg></div>
        </nav>
        <!-- End::nav -->

    </div>
    <!-- End::main-sidebar -->

</aside>