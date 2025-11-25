 <footer id="uc-footer" class="uc-footer panel uc-dark">
            <div class="footer-outer py-4 lg:py-6 bg-white dark:bg-gray-900 text-gray-900 dark:text-white text-opacity-50">
                <div class="container max-w-xl">
                    <div class="footer-inner vstack gap-6 xl:gap-8">
                        <div class="uc-footer-bottom panel vstack gap-4 justify-center lg:fs-5">
                            {{-- <nav class="footer-nav">
                                <ul class="nav-x gap-2 lg:gap-4 justify-center text-center text-uppercase fw-medium">
                                    <li><a class="hover:text-gray-900 dark:hover:text-white duration-150" href="blog-category.html">Politics</a></li>
                                    <li><a class="hover:text-gray-900 dark:hover:text-white duration-150" href="blog-category.html">Opinions</a></li>
                                    <li><a class="hover:text-gray-900 dark:hover:text-white duration-150" href="blog-category.html">World</a></li>
                                    <li><a class="hover:text-gray-900 dark:hover:text-white duration-150" href="blog-category.html">Media</a></li>
                                </ul>
                            </nav> --}}
                            <div class="footer-social hstack justify-center gap-2 lg:gap-3">
                                <ul class="nav-x gap-2">
                                    
                                    {{-- LinkedIn --}}
                        @if(!empty($settings->linkedin))
                            <li>
                                <a href="{{ $settings->linkedin }}" target="_blank"
                                class="hover:text-gray-900 dark:hover:text-white duration-150">
                                    <i class="icon icon-2 unicon-logo-linkedin"></i>
                                </a>
                            </li>
                        @endif

                        {{-- Facebook --}}
                        @if(!empty($settings->facebook))
                            <li>
                                <a href="{{ $settings->facebook }}" target="_blank"
                                class="hover:text-gray-900 dark:hover:text-white duration-150">
                                    <i class="icon icon-2 unicon-logo-facebook"></i>
                                </a>
                            </li>
                        @endif

                        {{-- Twitter --}}
                        @if(!empty($settings->twitter))
                            <li>
                                <a href="{{ $settings->twitter }}" target="_blank"
                                class="hover:text-gray-900 dark:hover:text-white duration-150">
                                    <i class="icon icon-2 unicon-logo-x-filled"></i>
                                </a>
                            </li>
                        @endif

                        {{-- Instagram --}}
                        @if(!empty($settings->instagram))
                            <li>
                                <a href="{{ $settings->instagram }}" target="_blank"
                                class="hover:text-gray-900 dark:hover:text-white duration-150">
                                    <i class="icon icon-2 unicon-logo-instagram"></i>
                                </a>
                            </li>
                        @endif

                        {{-- WhatsApp --}}
                        @if(!empty($settings->whatsapp))
                            <li>
                                <a href="https://wa.me/{{ $settings->whatsapp }}" target="_blank"
                                class="hover:text-gray-900 dark:hover:text-white duration-150">
                                    <i class="fa-brands fa-whatsapp icon-2 icon"></i>
                                </a>
        </li>
    @endif
                                </ul>
                                <div class="vr"></div>
                                <div class="d-inline-block">
                                    <a href="#" class="hstack gap-1 text-none fw-medium">
                                        <i class="icon icon-1 unicon-earth-filled"></i>
                                        <span>English</span>
                                        <span data-uc-drop-parent-icon=""></span>
                                    </a>
                                    <div class="p-2 bg-white dark:bg-gray-800 shadow-xs w-150px" data-uc-drop="mode: click; boundary: !.uc-footer-bottom; animation: uc-animation-slide-top-small; duration: 150;">
                                        <ul class="nav-y gap-1 fw-medium items-end">
                                            <li><a href="#en">English</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="footer-copyright vstack sm:hstack justify-center items-center gap-1 lg:gap-2">
                                <p>Bharat News © <script>
                                document.write(
                                    new Date().getFullYear()
                                )
                            </script>, All rights reserved.</p>
                                <ul class="nav-x gap-2 fw-medium">
                                    <li><a class="uc-link text-underline hover:text-gray-900 dark:hover:text-white duration-150" href="page-privacy.html">Privacy notice</a></li>
                                    <li><a class="uc-link text-underline hover:text-gray-900 dark:hover:text-white duration-150" href="page-terms.html">Terms of condition</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>