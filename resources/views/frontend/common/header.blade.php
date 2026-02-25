<style>
    .logo-img {
        width: auto !important;
        height: 55px;
    }
</style>
<!--  Search modal -->
<div id="uc-search-modal" class="uc-modal-full uc-modal" data-uc-modal="overlay: true">
    <div class="uc-modal-dialog d-flex justify-center bg-white text-dark dark:bg-gray-900 dark:text-white"
        data-uc-height-viewport="">
        <button
            class="uc-modal-close-default p-0 icon-3 btn border-0 dark:text-white dark:text-opacity-50 hover:text-primary hover:rotate-90 duration-150 transition-all"
            type="button">
            <i class="unicon-close"></i>
        </button>
        <div class="panel w-100 sm:w-500px px-2 py-10">
            <h3 class="h1 text-center">Search</h3>
            <form class="hstack gap-1 mt-4 border-bottom p-narrow dark:border-gray-700" onsubmit="event.preventDefault(); 
                let q = this.q.value.trim(); 
                if (q) { 
                    window.location.href = '{{ url('search') }}/' + encodeURIComponent(q); 
                }">

                <span class="d-inline-flex justify-center items-center w-24px sm:w-40 h-24px sm:h-40px opacity-50">
                    <i class="unicon-search icon-3"></i>
                </span>
                <input type="search" name="q" class="form-control-plaintext ms-1 fs-6 sm:fs-5 w-full dark:text-white"
                    placeholder="Type your keyword.." value="{{ $param ?? '' }}" autofocus>

            </form>

        </div>
    </div>
</div>

<!--  Menu panel -->
<div id="uc-menu-panel" data-uc-offcanvas="overlay: true;">
    <div class="uc-offcanvas-bar bg-white text-dark dark:bg-gray-900 dark:text-white">
        <header class="uc-offcanvas-header hstack justify-between items-center pb-4 bg-white dark:bg-gray-900">
            <div class="uc-logo">
                <a href="{{ route('home') }}" class="h5 text-none text-gray-900 dark:text-white">
                    <img class="" style="width: auto !important;height: 60px;"
                        src="{{ asset(optional($settings)->logo) }}" alt="Bharat News" data-uc-svg>
                </a>
            </div>
            <button
                class="uc-offcanvas-close p-0 icon-3 btn border-0 dark:text-white dark:text-opacity-50 hover:text-primary hover:rotate-90 duration-150 transition-all"
                type="button">
                <i class="unicon-close"></i>
            </button>
        </header>

        <div class="panel">
            <form id="search-panel" class="form-icon-group vstack gap-1 mb-3" onsubmit="event.preventDefault(); 
                let q = this.q.value.trim(); 
                if (q) { 
                    window.location.href = '{{ url('search') }}/' + encodeURIComponent(q); 
                }">
                <input type="search" name="q" class="form-control form-control-md fs-6" placeholder="Search..">
                <span class="form-icon text-gray">
                    <i class="unicon-search icon-1"></i>
                </span>
            </form>
            <ul class="nav-y gap-narrow fw-bold fs-5" data-uc-nav>
                <li>
                    <a href="{{ route('home') }}">Home</a>
                </li>

                @foreach ($categories as $category)
                    <li class="{{ $category->subCategories->count() > 0 ? 'uc-parent' : '' }}">
                        <a href="{{ $category->subCategories->count() == 0 ? route('category', $category->slug) : '#' }}">
                            {{ $category->category_name }}
                        </a>
                        @if($category->subCategories->count() > 0)
                            <ul class="uc-nav-sub" data-uc-nav>
                                @foreach ($category->subCategories as $subcategory)
                                    <li>
                                        <a href="{{ route('category', [$category->slug, $subcategory->slug]) }}">
                                            {{ $subcategory->sub_category_name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
                <li>
                    <a href="{{ route('videos.list') }}">Videos</a>
                </li>
                <li>
                    <a href="{{ route('contact.us') }}">Contact Us</a>
                </li>
                @if ($classifiedAds > '0')
                    <li>
                        <a href="{{ route('classified.ads') }}">Classified Ads</a>
                    </li>
                @endif
            </ul>

            <ul class="social-icons nav-x mt-4">
                <li>
                    @if(!empty($settings->linkedin))
                        <a href="{{ $settings->linkedin }}" target="_blank">
                            <i class="icon icon-2 unicon-logo-linkedin"></i>
                        </a>
                    @endif

                    {{-- Facebook --}}
                    @if(!empty($settings->facebook))
                        <a href="{{ $settings->facebook }}" target="_blank">
                            <i class="icon icon-2 unicon-logo-facebook"></i>
                        </a>
                    @endif

                    {{-- Twitter --}}
                    @if(!empty($settings->twitter))
                        <a href="{{ $settings->twitter }}" target="_blank">
                            <i class="icon icon-2 unicon-logo-x-filled"></i>
                        </a>
                    @endif

                    {{-- Instagram --}}
                    @if(!empty($settings->instagram))
                        <a href="{{ $settings->instagram }}" target="_blank">
                            <i class="icon icon-2 unicon-logo-instagram"></i>
                        </a>
                    @endif

                    {{-- WhatsApp --}}
                    @if(!empty($settings->whatsapp))
                        <a href="{{ $settings->whatsapp }}" target="_blank">
                            <i class="fa-brands fa-whatsapp icon-2 icon"></i>
                        </a>
                    @endif

                </li>
            </ul>

        </div>
    </div>
</div>

<!--  Cart panel -->
<div id="uc-cart-panel" data-uc-offcanvas="overlay: true; flip: true;">
    <div class="uc-offcanvas-bar bg-white text-dark dark:bg-gray-900 dark:text-white">
        <button
            class="uc-offcanvas-close top-0 ltr:end-0 rtl:start-0 rtl:end-auto m-2 p-0 border-0 icon-2 lg:icon-3 btn btn-md dark:text-white transition-transform duration-150 hover:rotate-90"
            type="button">
            <i class="unicon-close"></i>
        </button>

        <div class="mini-cart-content vstack justify-between panel h-100">
            <div class="mini-cart-header">
                <h3 class="title h5 m-0 text-dark dark:text-white">Shopping cart</h3>
            </div>
            <div class="mini-cart-listing panel flex-1 my-4 overflow-scroll">
                <p class="alert alert-warning" hidden>Your cart empty!</p>
                <div class="panel vstack gap-3">
                    <div>
                        <article class="product type-product panel">
                            <div class="hstack gap-2">
                                <figure
                                    class="featured-image m-0 ratio ratio-1x1 w-80px uc-transition-toggle overflow-hidden bg-gray-25 dark:bg-gray-800">
                                    <img class="media-cover image uc-transition-scale-up uc-transition-opaque uc-transition-scale-up uc-transition-opaque"
                                        src="{{ asset('frontend/images/common/img-fallback.png')}}"
                                        data-src="{{ asset('frontend/images/common/products/img-07.jpg')}}"
                                        alt="Laptop Cover" data-uc-img="loading: lazy">
                                    <a href="shop-product-detail.html" class="position-cover"
                                        data-caption="Laptop Cover"></a>
                                </figure>
                                <div class="content vstack gap-narrow fs-6">
                                    <h5 class="h6 m-0"><a class="text-none text-dark dark:text-white"
                                            href="shop-product-detail.html">Laptop Cover</a></h5>
                                    <div class="hstack gap-narrow fs-7 opacity-50 text-dark dark:text-white"><span
                                            class="qty">1</span> x <span class="price">$24.00</span></div>
                                    <a href="#remove_from_cart" class="remove fs-7 text-dark dark:text-white">Remove</a>
                                </div>
                                <a href="#remove_from_cart"
                                    class="remove position-absolute top-0 end-0 btn p-0 hover:text-danger" hidden>
                                    <i class="unicon-close icon-1"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                    <div>
                        <article class="product type-product panel">
                            <div class="hstack gap-2">
                                <figure
                                    class="featured-image m-0 ratio ratio-1x1 w-80px uc-transition-toggle overflow-hidden bg-gray-25 dark:bg-gray-800">
                                    <img class="media-cover image uc-transition-scale-up uc-transition-opaque uc-transition-scale-up uc-transition-opaque"
                                        src="{{ asset('frontend/images/common/img-fallback.png')}}"
                                        data-src="{{ asset('frontend/images/common/products/img-08.jpg')}}"
                                        alt="Disney Toys" data-uc-img="loading: lazy">
                                    <a href="shop-product-detail.html" class="position-cover"
                                        data-caption="Disney Toys"></a>
                                </figure>
                                <div class="content vstack gap-narrow fs-6">
                                    <h5 class="h6 m-0"><a class="text-none text-dark dark:text-white"
                                            href="shop-product-detail.html">Disney Toys</a></h5>
                                    <div class="hstack gap-narrow fs-7 opacity-50 text-dark dark:text-white"><span
                                            class="qty">1</span> x <span class="price">$5.00</span></div>
                                    <a href="#remove_from_cart" class="remove fs-7 text-dark dark:text-white">Remove</a>
                                </div>
                                <a href="#remove_from_cart"
                                    class="remove position-absolute top-0 end-0 btn p-0 hover:text-danger" hidden>
                                    <i class="unicon-close icon-1"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                    <div>
                        <article class="product type-product panel">
                            <div class="hstack gap-2">
                                <figure
                                    class="featured-image m-0 ratio ratio-1x1 w-80px uc-transition-toggle overflow-hidden bg-gray-25 dark:bg-gray-800">
                                    <img class="media-cover image uc-transition-scale-up uc-transition-opaque uc-transition-scale-up uc-transition-opaque"
                                        src="{{ asset('frontend/images/common/img-fallback.png')}}"
                                        data-src="{{ asset('frontend/images/common/products/img-09.jpg')}}"
                                        alt="Screen Axe" data-uc-img="loading: lazy">
                                    <a href="shop-product-detail.html" class="position-cover"
                                        data-caption="Screen Axe"></a>
                                </figure>
                                <div class="content vstack gap-narrow fs-6">
                                    <h5 class="h6 m-0"><a class="text-none text-dark dark:text-white"
                                            href="shop-product-detail.html">Screen Axe</a></h5>
                                    <div class="hstack gap-narrow fs-7 opacity-50 text-dark dark:text-white"><span
                                            class="qty">1</span> x <span class="price">$19.00</span></div>
                                    <a href="#remove_from_cart" class="remove fs-7 text-dark dark:text-white">Remove</a>
                                </div>
                                <a href="#remove_from_cart"
                                    class="remove position-absolute top-0 end-0 btn p-0 hover:text-danger" hidden>
                                    <i class="unicon-close icon-1"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                    <div>
                        <article class="product type-product panel">
                            <div class="hstack gap-2">
                                <figure
                                    class="featured-image m-0 ratio ratio-1x1 w-80px uc-transition-toggle overflow-hidden bg-gray-25 dark:bg-gray-800">
                                    <img class="media-cover image uc-transition-scale-up uc-transition-opaque uc-transition-scale-up uc-transition-opaque"
                                        src="{{ asset('frontend/images/common/img-fallback.png')}}"
                                        data-src="{{ asset('frontend/images/common/products/img-10.jpg')}}"
                                        alt="Airpods Pro" data-uc-img="loading: lazy">
                                    <a href="shop-product-detail.html" class="position-cover"
                                        data-caption="Airpods Pro"></a>
                                </figure>
                                <div class="content vstack gap-narrow fs-6">
                                    <h5 class="h6 m-0"><a class="text-none text-dark dark:text-white"
                                            href="shop-product-detail.html">Airpods Pro</a></h5>
                                    <div class="hstack gap-narrow fs-7 opacity-50 text-dark dark:text-white"><span
                                            class="qty">1</span> x <span class="price">$49.00</span></div>
                                    <a href="#remove_from_cart" class="remove fs-7 text-dark dark:text-white">Remove</a>
                                </div>
                                <a href="#remove_from_cart"
                                    class="remove position-absolute top-0 end-0 btn p-0 hover:text-danger" hidden>
                                    <i class="unicon-close icon-1"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
            <div class="mini-cart-footer panel pt-3 border-top">
                <div class="panel vstack gap-3 justify-between">
                    <div class="mini-cart-total hstack justify-between">
                        <h5 class="h5 m-0 text-dark dark:text-white">Subtotal</h5>
                        <b class="fs-5">$97.00</b>
                    </div>
                    <div class="mini-cart-actions vstack gap-1">
                        <a href="shop-cart.html"
                            class="btn btn-md btn-outline-gray-100 text-dark dark:text-white dark:border-gray-700 dark:hover:bg-gray-700">View
                            cart</a>
                        <a href="shop-checkout.html" class="btn btn-md btn-primary text-white">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--  Favorites modal -->
<div id="uc-favorites-modal" data-uc-modal="overlay: true">
    <div class="uc-modal-dialog lg:max-w-500px bg-white text-dark dark:bg-gray-800 dark:text-white rounded">
        <button
            class="uc-modal-close-default p-0 icon-3 btn border-0 dark:text-white dark:text-opacity-50 hover:text-primary hover:rotate-90 duration-150 transition-all"
            type="button">
            <i class="unicon-close"></i>
        </button>
        <div class="panel vstack justify-center items-center gap-2 text-center px-3 py-8">
            <i class="icon icon-4 unicon-bookmark mb-2 text-primary dark:text-white"></i>
            <h2 class="h4 md:h3 m-0">Saved articles</h2>
            <p class="fs-5 opacity-60">You have not yet added any article to your bookmarks!</p>
            <a href="{{ route('home') }}" class="btn btn-sm btn-primary mt-2 uc-modal-close">Browse articles</a>
        </div>
    </div>
</div>

<!--  Account modal -->
<div id="uc-account-modal" data-uc-modal="overlay: true">
    <div class="uc-modal-dialog lg:max-w-500px bg-white text-dark dark:bg-gray-800 dark:text-white rounded">
        <button
            class="uc-modal-close-default p-0 icon-3 btn border-0 dark:text-white dark:text-opacity-50 hover:text-primary hover:rotate-90 duration-150 transition-all"
            type="button">
            <i class="unicon-close"></i>
        </button>
        <div class="panel vstack gap-2 md:gap-4 text-center">
            <ul class="account-tabs-nav nav-x justify-center h6 py-2 border-bottom d-none"
                data-uc-switcher="animation: uc-animation-slide-bottom-small, uc-animation-slide-top-small">
                <li><a href="#">Sign in</a></li>
                <li><a href="#">Sign up</a></li>
                <li><a href="#">Reset password</a></li>
                <li><a href="#">Terms of use</a></li>
            </ul>
            <div
                class="account-tabs-content uc-switcher px-3 lg:px-4 py-4 lg:py-8 m-0 lg:mx-auto vstack justify-center items-center">
                <div class="w-100">
                    <div class="panel vstack justify-center items-center gap-2 sm:gap-4 text-center">
                        <h4 class="h5 lg:h4 m-0">Log in</h4>
                        <div class="panel vstack gap-2 w-100 sm:w-350px mx-auto">
                            <form class="vstack gap-2">
                                <input
                                    class="form-control form-control-sm h-40px w-full fs-6 bg-white dark:bg-gray-800 dark:bg-gray-800 dark:border-white dark:border-opacity-15 dark:border-opacity-15"
                                    type="email" placeholder="Your email" required>
                                <input
                                    class="form-control form-control-sm h-40px w-full fs-6 bg-white dark:bg-gray-800 dark:bg-gray-800 dark:border-white dark:border-opacity-15 dark:border-opacity-15"
                                    type="password" placeholder="Password" autocomplete="new-password" required>
                                <div class="hstack justify-between items-start text-start">
                                    <div class="form-check text-start">
                                        <input
                                            class="form-check-input rounded-0 dark:bg-gray-800 dark:bg-gray-800 dark:border-white dark:border-opacity-15 dark:border-opacity-15"
                                            type="checkbox" id="inputCheckRemember">
                                        <label class="hstack justify-between form-check-label fs-7 sm:fs-6"
                                            for="inputCheckRemember">Remember me?</label>
                                    </div>
                                    <a href="#" class="uc-link fs-6" data-uc-switcher-item="2">Forgot password</a>
                                </div>
                                <button class="btn btn-primary btn-sm lg:mt-1" type="submit">Log in</button>
                            </form>
                            <div class="panel h-24px">
                                <hr class="position-absolute top-50 start-50 translate-middle hr m-0 w-100">
                                <span
                                    class="position-absolute top-50 start-50 translate-middle px-1 fs-7 text-uppercase bg-white dark:bg-gray-800">Or</span>
                            </div>
                            <div class="hstack gap-2">
                                <a href="#google"
                                    class="hstack items-center justify-center flex-1 gap-1 h-40px text-none rounded border border-gray-900 dark:bg-gray-800 dark:border-white dark:border-opacity-15 border-opacity-10">
                                    <i class="icon icon-1 unicon-logo-google"></i>
                                </a>
                                <a href="#facebook"
                                    class="hstack items-center justify-center flex-1 gap-1 h-40px text-none rounded border border-gray-900 dark:bg-gray-800 dark:border-white dark:border-opacity-15 border-opacity-10">
                                    <i class="icon icon-1 unicon-logo-facebook"></i>
                                </a>
                                <a href="#twitter"
                                    class="hstack items-center justify-center flex-1 gap-1 h-40px text-none rounded border border-gray-900 dark:bg-gray-800 dark:border-white dark:border-opacity-15 border-opacity-10">
                                    <i class="icon icon-1 unicon-logo-x-filled"></i>
                                </a>
                            </div>
                        </div>
                        <p class="fs-7 sm:fs-6">Have no account yet? <a class="uc-link" href="#"
                                data-uc-switcher-item="1">Sign up</a></p>
                    </div>
                </div>
                <div class="w-100">
                    <div class="panel vstack justify-center items-center gap-2 sm:gap-4 text-center">
                        <h4 class="h5 lg:h4 m-0">Create an account</h4>
                        <div class="panel vstack gap-2 w-100 sm:w-350px mx-auto">
                            <form class="vstack gap-2">
                                <input
                                    class="form-control form-control-sm h-40px w-full fs-6 bg-white dark:bg-gray-800 dark:border-white dark:border-opacity-15"
                                    type="text" placeholder="Full name" required>
                                <input
                                    class="form-control form-control-sm h-40px w-full fs-6 bg-white dark:bg-gray-800 dark:border-white dark:border-opacity-15"
                                    type="email" placeholder="Your email" required>
                                <input
                                    class="form-control form-control-sm h-40px w-full fs-6 bg-white dark:bg-gray-800 dark:border-white dark:border-opacity-15"
                                    type="password" placeholder="Password" autocomplete="new-password" required>
                                <input
                                    class="form-control form-control-sm h-40px w-full fs-6 bg-white dark:bg-gray-800 dark:border-white dark:border-opacity-15"
                                    type="password" placeholder="Re-enter Password" autocomplete="new-password"
                                    required>
                                <div class="hstack text-start">
                                    <div class="form-check text-start">
                                        <input id="input_checkbox_accept_terms"
                                            class="form-check-input rounded-0 dark:bg-gray-800 dark:border-white dark:border-opacity-15"
                                            type="checkbox" required>
                                        <label for="input_checkbox_accept_terms"
                                            class="hstack justify-between form-check-label fs-7 sm:fs-6">I read and
                                            accept the <a href="#" class="uc-link ms-narrow"
                                                data-uc-switcher-item="3">terms of use</a>. </label>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-sm lg:mt-1" type="submit">Sign up</button>
                            </form>
                            <div class="panel h-24px">
                                <hr class="position-absolute top-50 start-50 translate-middle hr m-0 w-100">
                                <span
                                    class="position-absolute top-50 start-50 translate-middle px-1 fs-7 text-uppercase bg-white dark:bg-gray-800">Or</span>
                            </div>
                            <div class="hstack gap-2">
                                <a href="#google"
                                    class="hstack items-center justify-center flex-1 gap-1 h-40px text-none rounded border border-gray-900 dark:bg-gray-800 dark:border-white dark:border-opacity-15 border-opacity-10">
                                    <i class="icon icon-1 unicon-logo-google"></i>
                                </a>
                                <a href="#facebook"
                                    class="hstack items-center justify-center flex-1 gap-1 h-40px text-none rounded border border-gray-900 dark:bg-gray-800 dark:border-white dark:border-opacity-15 border-opacity-10">
                                    <i class="icon icon-1 unicon-logo-facebook"></i>
                                </a>
                                <a href="#twitter"
                                    class="hstack items-center justify-center flex-1 gap-1 h-40px text-none rounded border border-gray-900 dark:bg-gray-800 dark:border-white dark:border-opacity-15 border-opacity-10">
                                    <i class="icon icon-1 unicon-logo-x-filled"></i>
                                </a>
                            </div>
                        </div>
                        <p class="fs-7 sm:fs-6">Already have an account? <a class="uc-link" href="#"
                                data-uc-switcher-item="0">Log in</a></p>
                    </div>
                </div>
                <div class="w-100">
                    <div class="panel vstack justify-center items-center gap-2 sm:gap-4 text-center">
                        <h4 class="h5 lg:h4 m-0">Reset password</h4>
                        <div class="panel w-100 sm:w-350px">
                            <form class="vstack gap-2">
                                <input
                                    class="form-control form-control-sm h-40px w-full fs-6 bg-white dark:bg-gray-800 dark:border-white dark:border-opacity-15"
                                    type="email" placeholder="Your email" required>
                                <div class="form-check text-start">
                                    <input
                                        class="form-check-input rounded-0 dark:bg-gray-800 dark:border-white dark:border-opacity-15"
                                        type="checkbox" id="inputCheckVerify" required>
                                    <label class="form-check-label fs-7 sm:fs-6" for="inputCheckVerify"> <span>I'm
                                            not a robot</span>. </label>
                                </div>
                                <button class="btn btn-primary btn-sm lg:mt-1" type="submit">Reset a
                                    password</button>
                            </form>
                        </div>
                        <p class="fs-7 sm:fs-6 mt-2 sm:m-0">Remember your password? <a class="uc-link" href="#"
                                data-uc-switcher-item="0">Log in</a></p>
                    </div>
                </div>
                <div class="w-100">
                    <div class="panel vstack justify-center items-center gap-2 sm:gap-4">
                        <h4 class="h5 lg:h4 m-0">Terms of use</h4>
                        <div class="page-content panel fs-6 text-start max-h-400px overflow-scroll">
                            <p>Terms of use dolor sit amet consectetur, adipisicing elit. Recusandae provident ullam
                                aperiam quo ad non corrupti sit vel quam repellat ipsa quod sed, repellendus
                                adipisci, ducimus ea modi odio assumenda.</p>
                            <h5 class="h6 md:h5 mt-3 mb-1">Disclaimers</h5>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi, cum esse possimus
                                officiis amet ea voluptatibus libero! Dolorum assumenda esse, deserunt ipsum ad
                                iusto! Praesentium error nobis tenetur at, quis nostrum facere excepturi architecto
                                totam.</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, soluta alias
                                eaque modi ipsum sint iusto fugiat vero velit rerum.</p>
                            <h5 class="h6 md:h5 mt-3 mb-1">Limitation on Liability</h5>
                            <p>Sequi, cum esse possimus officiis amet ea voluptatibus libero! Dolorum assumenda
                                esse, deserunt ipsum ad iusto! Praesentium error nobis tenetur at, quis nostrum
                                facere excepturi architecto totam.</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, soluta alias
                                eaque modi ipsum sint iusto fugiat vero velit rerum.</p>
                            <h5 class="h6 md:h5 mt-3 mb-1">Copyright Policy</h5>
                            <p>Dolor sit amet consectetur adipisicing elit. Sequi, cum esse possimus officiis amet
                                ea voluptatibus libero! Dolorum assumenda esse, deserunt ipsum ad iusto! Praesentium
                                error nobis tenetur at, quis nostrum facere excepturi architecto totam.</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, soluta alias
                                eaque modi ipsum sint iusto fugiat vero velit rerum.</p>
                            <h5 class="h6 md:h5 mt-3 mb-1">General</h5>
                            <p>Sit amet consectetur adipisicing elit. Sequi, cum esse possimus officiis amet ea
                                voluptatibus libero! Dolorum assumenda esse, deserunt ipsum ad iusto! Praesentium
                                error nobis tenetur at, quis nostrum facere excepturi architecto totam.</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, soluta alias
                                eaque modi ipsum sint iusto fugiat vero velit rerum.</p>
                        </div>
                        <p class="fs-7 sm:fs-6">Do you agree to our terms? <a class="uc-link" href="#"
                                data-uc-switcher-item="1">Sign up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--  GDPR modal -->
{{-- <div id="uc-gdpr-notification" class="uc-gdpr-notification uc-notification uc-notification-bottom-left lg:m-2">
    <div class="uc-notification-message">
        <a id="uc-close-gdpr-notification" class="uc-notification-close" data-uc-close></a>
        <h2 class="h5 ft-primary fw-bold -ls-1 m-0">GDPR Compliance</h2>
        <p class="fs-7 mt-1 mb-2">We use cookies to ensure you get the best experience on our website. By continuing
            to use our site, you accept our use of cookies, <a href="page-privacy.html"
                class="uc-link text-underline">Privacy Policy</a>, and <a href="page-terms.html"
                class="uc-link text-underline">Terms of Service</a>.</p>
        <button class="btn btn-sm btn-primary" id="uc-accept-gdpr">Accept</button>
    </div>
</div> --}}

<!--  Bottom Actions Sticky -->
<div class="backtotop-wrap position-fixed bottom-0 end-0 z-99 m-2 vstack">
    {{-- <div
        class="darkmode-trigger cstack w-40px h-40px rounded-circle text-none bg-gray-100 dark:bg-gray-700 dark:text-white"
        data-darkmode-toggle="">
        <label class="switch">
            <span class="sr-only">Dark mode toggle</span>
            <input type="checkbox">
            <span class="slider fs-5"></span>
        </label>
    </div> --}}
    <a class="btn btn-sm bg-primary text-white w-40px h-40px rounded-circle" href="to_top.html" data-uc-backtotop>
        <i class="icon-2 unicon-chevron-up"></i>
    </a>
</div>

<!-- Header start -->
<header class="uc-header header-seven uc-navbar-sticky-wrap z-999"
    data-uc-sticky="sel-target: .uc-navbar-container; cls-active: uc-navbar-sticky; cls-inactive: uc-navbar-transparent; end: !*;">
    <nav class="uc-navbar-container text-gray-900 dark:text-white fs-6 z-1">
        <div class="uc-top-navbar panel z-3 overflow-hidden bg-primary-600 swiper-parent" style="--uc-nav-height: 32px"
            data-uc-navbar=" animation: uc-animation-slide-top-small; duration: 150;">
            <div class="container container-full">
                <div class="uc-navbar-item">
                    <div class="swiper swiper-ticker swiper-ticker-sep px-2" style="--uc-ticker-gap: 32px">
                        <div class="swiper-wrapper">
                            @foreach ($headlines as $headline)
                                <div class="swiper-slide text-white">
                                    <div class="type-post post panel">
                                        <a href="{{ route('news.detail', optional($headline)->slug) }}"
                                            class="fs-7 fw-normal text-none text-inherit">{{ optional($headline)->title }}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="uc-center-navbar panel hstack z-2 min-h-48px d-none lg:d-flex"
            data-uc-navbar=" animation: uc-animation-slide-top-small; duration: 150;">
            <div class="container max-w-xl">
                <div class="navbar-container hstack border-bottom">
                    <div class="uc-navbar-center gap-2 lg:gap-3 flex-1">
                        <ul class="uc-navbar-nav gap-3 flex-1 fs-6 fw-bold" style="--uc-nav-height: 48px">
                            <li>
                                <a href="{{ route('home') }}">Home</a>
                            </li>
                            @foreach ($categories as $category)
                                <li>
                                    <a
                                        href="{{ $category->subCategories->count() == '0' ? route('category', $category->slug) : '#' }}">{{ $category->category_name }}
                                        {!! $category->subCategories->count() > 0 ? '<span data-uc-navbar-parent-icon></span>' : '' !!}</a>
                                    @if ($category->subCategories->count() > 0)
                                        <div class="uc-navbar-dropdown ft-primary text-unset p-3 pb-4 rounded-0 hide-scrollbar"
                                            data-uc-drop=" offset: 0; boundary: !.navbar-container; stretch: x; animation: uc-animation-slide-top-small; duration: 150;">
                                            <div class="row child-cols col-match g-2">
                                                <div class="col-2">
                                                    <ul class="uc-nav uc-navbar-dropdown-nav">
                                                        @foreach ($category->subCategories as $subcategory)
                                                            <li><a
                                                                    href="{{ route('category', [$category->slug, $subcategory->slug]) }}">{{ $subcategory->sub_category_name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                {{-- <div>
                                                    <div class="uc-navbar-newsletter panel vstack">
                                                        <h6 class="fs-6 ft-tertiary fw-medium">Newsletter</h6>
                                                        <form class="hstack gap-1 bg-gray-300 bg-opacity-10">
                                                            <input type="email"
                                                                class="form-control-plaintext form-control-xs fs-6 dark:text-white"
                                                                placeholder="Your email address..">
                                                            <button type="submit"
                                                                class="btn btn-sm btn-primary fs-6 rounded-0">Subscribe</button>
                                                        </form>
                                                        <p class="fs-7 mt-1">Do not worry, we don't spam!</p>
                                                        <ul class="nav-x gap-2 mt-3">
                                                            <li>
                                                                <a href="#fb"><i
                                                                        class="icon icon-2 unicon-logo-facebook"></i></a>
                                                            </li>
                                                            <li>
                                                                <a href="#x"><i
                                                                        class="icon icon-2 unicon-logo-x-filled"></i></a>
                                                            </li>
                                                            <li>
                                                                <a href="#in"><i
                                                                        class="icon icon-2 unicon-logo-instagram"></i></a>
                                                            </li>
                                                            <li>
                                                                <a href="#yt"><i
                                                                        class="icon icon-2 unicon-logo-youtube"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    @endif
                                </li>
                            @endforeach

                            <li>
                                <a href="{{ route('videos.list') }}">Videos</a>
                            </li>
                            <li>
                                <a href="{{ route('contact.us') }}">Contact Us</a>
                            </li>
                            @if ($classifiedAds > '0')
                                <li>
                                    <a href="{{ route('classified.ads') }}">Classified Ads</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="uc-bottom-navbar panel z-1">
            <div class="container max-w-xl">
                <div class="uc-navbar min-h-72px lg:min-h-100px"
                    data-uc-navbar=" animation: uc-animation-slide-top-small; duration: 150;">
                    <div class="uc-navbar-left">
                        <div>
                            <a class="uc-menu-trigger icon-2" href="#uc-menu-panel" data-uc-toggle></a>
                        </div>
                        <div class="uc-navbar-item d-none lg:d-inline-flex">
                            <a class="btn btn-xs gap-narrow ps-1 border rounded-pill fw-bold dark:text-white hover:bg-gray-25 dark:hover:bg-gray-900"
                                href="{{ route('live.tv') }}" data-uc-scroll="offset: 128">
                                <i class="icon icon-narrow unicon-dot-mark text-red" data-uc-animate="flash"></i>
                                <span>Live</span>
                            </a>
                        </div>
                        <div class="uc-logo d-block md:d-none">
                            <a href="{{ route('home') }}">
                                <img class="logo-img w-100px text-dark dark:text-white"
                                    src="{{ asset(optional($settings)->logo) }}" alt="News5" data-uc-svg>
                            </a>
                        </div>
                    </div>
                    <div class="uc-navbar-center">
                        <div class="uc-logo d-none md:d-block">
                            <a href="{{ route('home') }}">
                                <img class="logo-img w-150px text-dark dark:text-white"
                                    src="{{ asset(optional($settings)->logo) }}" alt="News5" data-uc-svg>
                            </a>
                        </div>
                    </div>
                    <div class="uc-navbar-right gap-2 lg:gap-3">
                        <div class="uc-navbar-item d-inline-flex lg:d-none">
                            <a class="btn btn-xs gap-narrow ps-1 border rounded-pill fw-bold dark:text-white hover:bg-gray-25 dark:hover:bg-gray-900"
                                href="#live_now" data-uc-scroll="offset: 128">
                                <i class="icon icon-narrow unicon-dot-mark text-red" data-uc-animate="flash"></i>
                                <span>Live</span>
                            </a>
                        </div>

                        <div class="uc-navbar-item d-none lg:d-inline-flex">
                            <a class="uc-search-trigger cstack text-none text-dark dark:text-white"
                                href="#uc-search-modal" data-uc-toggle>
                                <i class="icon icon-2 fw-medium unicon-search"></i>
                            </a>
                        </div>
                        {{-- <div class="uc-navbar-item d-none lg:d-inline-flex">
                            <div class="uc-modes-trigger btn btn-xs w-32px h-32px p-0 border fw-normal rounded-circle dark:text-white hover:bg-gray-25 dark:hover:bg-gray-900"
                                data-darkmode-toggle="">
                                <label class="switch">
                                    <span class="sr-only">Dark toggle</span>
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

@php 
                                        $ad = getAd('header_below');
    $image = $ad ? firstImage($ad->images) : null;
@endphp

@if($ad && $image)
    <div class="advertisment py-2">
        <span class="text-center d-block mb-1">Advertisement</span>

        <div class="advertisment-img text-center">
            <a href="{{ $ad->link ?? '#' }}" target="_blank" rel="nofollow">
                <img src="{{ asset($image) }}" alt="Advertisement Banner" class="img-fluid w-100"
                    style="max-height: 120px; object-fit: cover;">
            </a>
        </div>
    </div>
@endif