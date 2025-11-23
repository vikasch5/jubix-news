@extends('frontend.common.master')
@section('content')
    <style>
        .myNewsSwiper .swiper-button-next,
        .myNewsSwiper .swiper-button-prev {
            width: 32px !important;
            height: 32px !important;
            background: rgba(0, 0, 0, 0.4);
            /* subtle background */
            border-radius: 50%;
            backdrop-filter: blur(4px);
        }

        .myNewsSwiper .swiper-button-next:after,
        .myNewsSwiper .swiper-button-prev:after {
            font-size: 16px !important;
            /* reduce arrow size */
            color: #fff;
            /* arrow color */
        }

        .myNewsSwiper .swiper-button-prev {
            left: 10px !important;
            /* adjust position */
        }

        .myNewsSwiper .swiper-button-next {
            right: 10px !important;
            /* adjust position */
        }
    </style>
    <div id="wrapper" class="wrap overflow-hidden-x">
        <div class="breadcrumbs panel z-1 py-2 bg-gray-25 dark:bg-gray-100 dark:bg-opacity-5 dark:text-white">
            <div class="container max-w-xl">
                <ul class="breadcrumb nav-x justify-center gap-1 fs-7 sm:fs-6 m-0">
                    <li><a href="index.html">Home</a></li>
                    <li><i class="unicon-chevron-right opacity-50"></i></li>
                    <li><a href="blog.html">Blog</a></li>
                    <li><i class="unicon-chevron-right opacity-50"></i></li>
                    <li><span class="opacity-50">{{ $news->title }}</span></li>
                </ul>
            </div>
        </div>

        <article class="post type-post single-post py-4 lg:py-6 xl:py-9">
            <div class="container max-w-xl">
                <div class="post-header">
                    <div class="panel vstack gap-4 md:gap-6 xl:gap-8 text-center">
                        <div @php
                            $shareUrl = route('news.detail', $news->slug);
                            $shareTitle = urlencode($news->title);
                        @endphp
                            class="panel vstack items-center max-w-400px sm:max-w-500px xl:max-w-md mx-auto gap-2 md:gap-3">
                            <h1 class="h4 sm:h2 lg:h1 xl:display-6">{{ $news->title }}</h1>
                            <ul class="post-share-icons nav-x gap-1 dark:text-white">
                                <li>
                                    <a class="btn btn-md p-0 border-gray-900 border-opacity-15 w-32px lg:w-48px h-32px lg:h-48px text-dark dark:text-white dark:border-white hover:bg-primary hover:border-primary hover:text-white rounded-circle"
                                        href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}"><i
                                            class="unicon-logo-facebook icon-1"></i></a>
                                </li>
                                <li>
                                    <a class="btn btn-md p-0 border-gray-900 border-opacity-15 w-32px lg:w-48px h-32px lg:h-48px text-dark dark:text-white dark:border-white hover:bg-primary hover:border-primary hover:text-white rounded-circle"
                                        href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}"><i
                                            class="unicon-logo-x-filled icon-1"></i></a>
                                </li>
                                <li>
                                    <a class="btn btn-md p-0 border-gray-900 border-opacity-15 w-32px lg:w-48px h-32px lg:h-48px text-dark dark:text-white dark:border-white hover:bg-primary hover:border-primary hover:text-white rounded-circle"
                                        href="https://www.linkedin.com/shareArticle?mini=true&url={{ $shareUrl }}&title={{ $shareTitle }}"><i
                                            class="unicon-logo-linkedin icon-1"></i></a>
                                </li>

                                <li>
                                    <a class="btn btn-md p-0 border-gray-900 border-opacity-15 w-32px lg:w-48px h-32px lg:h-48px text-dark dark:text-white dark:border-white hover:bg-primary hover:border-primary hover:text-white rounded-circle"
                                        href="https://www.instagram.com/?url={{ $shareUrl }}"><i
                                            class="unicon-logo-instagram icon-1"></i></a>
                                </li>
                                <li>
                                    <a class="btn btn-md p-0 border-gray-900 border-opacity-15 w-32px lg:w-48px h-32px lg:h-48px text-dark dark:text-white dark:border-white hover:bg-primary hover:border-primary hover:text-white rounded-circle"
                                        href="https://wa.me/?text={{ $shareTitle }}%20{{ $shareUrl }}"><i
                                            class="fa-brands fa-whatsapp icon-1"></i></a>
                                </li>

                            </ul>
                            @php
                                $images = json_decode($news->images, true); // field name may be different
                                // $firstImage = $images[0] ?? null;
                            @endphp
                        </div>
                        <div
                            class="featured-image m-0 ratio ratio-2x1 rounded uc-transition-toggle overflow-hidden bg-gray-25 dark:bg-gray-800">

                            <div class="swiper myNewsSwiper h-100">
                                <div class="swiper-wrapper">

                                    @if (!empty($images))
                                        @foreach ($images as $img)
                                            <div class="swiper-slide">
                                                <img class="media-cover image w-100 h-100 object-cover" src="{{ asset($img) }}"
                                                    alt="news image" loading="lazy">
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="swiper-slide">
                                            <img class="media-cover image w-100 h-100 object-cover"
                                                src="{{ asset('frontend/images/common/img-fallback.png') }}" alt="fallback"
                                                loading="lazy">
                                        </div>
                                    @endif

                                </div>

                                <!-- Pagination -->
                                <div class="swiper-pagination"></div>

                                <!-- Arrows -->
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="panel position-relative mt-4 lg:mt-6 xl:mt-9">
                <div class="container">
                    <div class="content-wrap row child-col-12 lg:child-cols g-4 lg:g-6">
                        <div class="lg:col-8 uc-first-column">
                            <div class="max-w-lg">
                                <div class="post-content panel fs-6 md:fs-5" data-uc-lightbox="animation: scale">
                                    {!! $news->description !!}
                                </div>
                                {{-- <div
                                    class="post-footer panel vstack sm:hstack gap-3 justify-between justifybetween border-top py-4 mt-4 xl:py-9 xl:mt-9">
                                    <ul class="nav-x gap-narrow text-primary">
                                        <li><span class="text-black dark:text-white me-narrow">Tags:</span></li>
                                        <li>
                                            <a href="#" class="uc-link gap-0 dark:text-white">Food <span
                                                    class="text-black dark:text-white">,</span></a>
                                        </li>
                                        <li>
                                            <a href="#" class="uc-link gap-0 dark:text-white">Life Style <span
                                                    class="text-black dark:text-white">,</span></a>
                                        </li>
                                        <li>
                                            <a href="#" class="uc-link gap-0 dark:text-white">Tech <span
                                                    class="text-black dark:text-white">,</span></a>
                                        </li>
                                        <li><a href="#" class="uc-link gap-0 dark:text-white">Travel</a></li>
                                    </ul>
                                    <ul class="post-share-icons nav-x gap-narrow">
                                        <li class="me-1"><span class="text-black dark:text-white">Share:</span></li>
                                        <li>
                                            <a class="btn btn-md btn-outline-gray-100 p-0 w-32px lg:w-40px h-32px lg:h-40px text-dark dark:text-white dark:border-gray-600 hover:bg-primary hover:border-primary hover:text-white rounded-circle"
                                                href="#"><i class="unicon-logo-facebook icon-1"></i></a>
                                        </li>
                                        <li>
                                            <a class="btn btn-md btn-outline-gray-100 p-0 w-32px lg:w-40px h-32px lg:h-40px text-dark dark:text-white dark:border-gray-600 hover:bg-primary hover:border-primary hover:text-white rounded-circle"
                                                href="#"><i class="unicon-logo-x-filled icon-1"></i></a>
                                        </li>
                                        <li>
                                            <a class="btn btn-md btn-outline-gray-100 p-0 w-32px lg:w-40px h-32px lg:h-40px text-dark dark:text-white dark:border-gray-600 hover:bg-primary hover:border-primary hover:text-white rounded-circle"
                                                href="#"><i class="unicon-email icon-1"></i></a>
                                        </li>
                                        <li>
                                            <a class="btn btn-md btn-outline-gray-100 p-0 w-32px lg:w-40px h-32px lg:h-40px text-dark dark:text-white dark:border-gray-600 hover:bg-primary hover:border-primary hover:text-white rounded-circle"
                                                href="#"><i class="unicon-link icon-1"></i></a>
                                        </li>
                                    </ul>
                                </div> --}}

                                {{-- <div class="post-related panel border-top pt-2 mt-8 xl:mt-9">
                                    <h4 class="h5 xl:h4 mb-5 xl:mb-6">Related to this topic:</h4>
                                    <div class="row child-cols-6 md:child-cols-4 gx-2 gy-4 sm:gx-3 sm:gy-6">
                                        <div>
                                            <article class="post type-post panel vstack gap-2">
                                                <figure
                                                    class="featured-image m-0 ratio ratio-4x3 rounded uc-transition-toggle overflow-hidden bg-gray-25 dark:bg-gray-800">
                                                    <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                                        src="../assets/images/common/img-fallback.png"
                                                        data-src="../assets/images/demo-two/posts/img-07.html"
                                                        alt="The Art of Baking: From Classic Bread to Artisan Pastries"
                                                        data-uc-img="loading: lazy">
                                                    <a href="blog-details.html" class="position-cover"
                                                        data-caption="The Art of Baking: From Classic Bread to Artisan Pastries"></a>
                                                </figure>
                                                <div class="post-header panel vstack gap-1">
                                                    <h5 class="h6 md:h5 m-0">
                                                        <a class="text-none" href="blog-details.html">The Art of Baking:
                                                            From Classic Bread to Artisan Pastries</a>
                                                    </h5>
                                                    <div class="post-date hstack gap-narrow fs-7 opacity-60">
                                                        <span>Feb 28,
                                                            <script>
                                                                document.write(
                                                                    new Date().getFullYear()
                                                                )
                                                            </script>
                                                        </span>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <div>
                                            <article class="post type-post panel vstack gap-2">
                                                <figure
                                                    class="featured-image m-0 ratio ratio-4x3 rounded uc-transition-toggle overflow-hidden bg-gray-25 dark:bg-gray-800">
                                                    <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                                        src="../assets/images/common/img-fallback.png"
                                                        data-src="../assets/images/demo-two/posts/img-08.jpg"
                                                        alt="AI and Marketing: Unlocking Customer Insights"
                                                        data-uc-img="loading: lazy">
                                                    <a href="blog-details.html" class="position-cover"
                                                        data-caption="AI and Marketing: Unlocking Customer Insights"></a>
                                                </figure>
                                                <div class="post-header panel vstack gap-1">
                                                    <h5 class="h6 md:h5 m-0">
                                                        <a class="text-none" href="blog-details.html">AI and Marketing:
                                                            Unlocking Customer Insights</a>
                                                    </h5>
                                                    <div class="post-date hstack gap-narrow fs-7 opacity-60">
                                                        <span>Feb 22,
                                                            <script>
                                                                document.write(
                                                                    new Date().getFullYear()
                                                                )
                                                            </script>
                                                        </span>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <div>
                                            <article class="post type-post panel vstack gap-2">
                                                <figure
                                                    class="featured-image m-0 ratio ratio-4x3 rounded uc-transition-toggle overflow-hidden bg-gray-25 dark:bg-gray-800">
                                                    <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                                        src="../assets/images/common/img-fallback.png"
                                                        data-src="../assets/images/demo-two/posts/img-09.jpg"
                                                        alt="Hidden Gems: Underrated Travel Destinations Around the World"
                                                        data-uc-img="loading: lazy">
                                                    <a href="blog-details.html" class="position-cover"
                                                        data-caption="Hidden Gems: Underrated Travel Destinations Around the World"></a>
                                                </figure>
                                                <div class="post-header panel vstack gap-1">
                                                    <h5 class="h6 md:h5 m-0">
                                                        <a class="text-none" href="blog-details.html">Hidden Gems:
                                                            Underrated Travel Destinations Around the World</a>
                                                    </h5>
                                                    <div class="post-date hstack gap-narrow fs-7 opacity-60">
                                                        <span>Feb 14,
                                                            <script>
                                                                document.write(
                                                                    new Date().getFullYear()
                                                                )
                                                            </script>
                                                        </span>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                </div> --}}
                                <div id="blog-comment" class="panel border-top pt-2 mt-8 xl:mt-9">
                                    <h4 class="h5 xl:h4 mb-5 xl:mb-6">Comments ({{ $news->comments->count() }})</h4>

                                    <div class="spacer-half"></div>
                                    <ol>
                                        @foreach ($news->comments as $comment)
                                            <li>
                                                <div class="avatar">
                                                    <img src="{{ asset('frontend/images/avatars/01.png') }}" alt="">
                                                </div>
                                                <div class="comment-info">
                                                    <span class="c_name">{{ $comment->name }}</span>

                                                    <span class="c_date id-color">
                                                        {{ $comment->created_at->diffForHumans() }}
                                                    </span>

                                                    <div class="clearfix"></div>
                                                </div>

                                                <div class="comment">
                                                    {{ $comment->comment }}
                                                </div>
                                            </li>
                                        @endforeach
                                    </ol>

                                    <div class="spacer-single"></div>

                                    <div id="comment-form-wrapper" class="panel pt-2 mt-8 xl:mt-9">
                                        <h4 class="h5 xl:h4 mb-5 xl:mb-6">Leave a Comment</h4>

                                        <div class="comment_form_holder">
                                            <div class="response-msg"></div>
                                            <form id="commentForm" action="{{ route('comments.store') }}"
                                                class="vstack gap-2">
                                                @csrf
                                                <input type="hidden" name="news_id" value="{{ $news->id }}" id="">
                                                <input
                                                    class="form-control form-control-sm h-40px w-full fs-6 bg-white dark:bg-opacity-0 dark:text-white dark:border-gray-300 dark:border-opacity-30"
                                                    name="name" type="text" placeholder="Full Name" required>
                                                <input
                                                    class="form-control form-control-sm h-40px w-full fs-6 bg-white dark:bg-opacity-0 dark:text-white dark:border-gray-300 dark:border-opacity-30"
                                                    name="email" type="email" placeholder="Your email" required>
                                                <textarea
                                                    class="form-control h-250px w-full fs-6 bg-white dark:bg-opacity-0 dark:text-white dark:border-gray-300 dark:border-opacity-30"
                                                    name="comment" type="text" placeholder="Your comment"
                                                    required></textarea>
                                                <input type="submit" class="btn btn-primary btn-sm mt-1" value="Send">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="lg:col-4">
                            <div class="sidebar-wrap panel vstack gap-2" data-uc-sticky="end: true;">
                                <div class="right-sidebar">
                                    <div class="recent-widget widget">
                                        <h2 class="widget-title">Recent Posts</h2>
                                        <div class="recent-post-widget clearfix">
                                            @foreach ($recent_news as $recentNews)
                                                @php
                                                    $recentimages = json_decode($recentNews->images, true); // field name may be different
                                                    $recentfirstImage = $recentimages[0] ?? null;
                                                @endphp
                                                <div class="show-featured clearfix">
                                                    <div class="post-img">
                                                        <a href="{{ route('news.detail', $recentNews->slug) }}">
                                                            <img width="1200" height="700"
                                                                src="{{ $recentfirstImage ? asset($recentfirstImage) : asset('frontend/images/common/img-fallback.png') }}"
                                                                class="attachment-full size-full wp-post-image" alt=""
                                                                decoding="async"
                                                                srcset="{{ $recentfirstImage ? asset($recentfirstImage) : asset('frontend/images/common/img-fallback.png') }} 1200w"
                                                                sizes="(max-width: 1200px) 100vw, 1200px"> </a>
                                                    </div>
                                                    <div class="post-item">
                                                        <div class="post-desc">
                                                            <div class="rt-site-mega">
                                                                <span class="author-post">
                                                                    {{ $recentNews->created_at->format('M d, Y') }}</span><span
                                                                    class="date-post">
                                                                    By <a href="#">{{ $recentNews->reporter_name }}</a>
                                                                </span>
                                                            </div>
                                                            <a href="{{ route('news.detail', $recentNews->slug) }}">
                                                                {{ $recentNews->title }} </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>

                                    <section id="media_image-1" class="widget widget_media_image"><img width="600"
                                            height="700"
                                            src="../../../reactheme.com/news5/news-magazine/wp-content/uploads/sites/26/2025/04/add__image.png"
                                            class="image wp-image-10098 attachment-full size-full" alt="" decoding="async"
                                            srcset="https://reactheme.com/news5/news-magazine/wp-content/uploads/sites/26/2025/04/add__image.png 600w, https://reactheme.com/news5/news-magazine/wp-content/uploads/sites/26/2025/04/add__image-257x300.png 257w"
                                            sizes="(max-width: 600px) 100vw, 600px"></section>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>

        <!-- Newsletter -->
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {

            $("#commentForm").on("submit", function (e) {
                e.preventDefault(); // stop normal form submit
                let url = $(this).attr("action");
                let form = $(this);
                let formData = form.serialize(); // serialize form data

                $.ajax({
                    url: url, // your backend route
                    type: "POST",
                    data: formData,
                    dataType: "json",

                    success: function (response) {

                        // Remove field errors
                        form.find(".text-danger").remove();

                        // Reset form
                        form.trigger("reset");

                        // Show success message
                        $(".response-msg").html(`
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        ${response.message ?? "Comment added successfully!"}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                `);
                    },

                    error: function (xhr) {
                        let errors = xhr.responseJSON.errors;

                        // Clear old errors
                        form.find(".text-danger").remove();

                        // Show general error alert
                        $(".response-msg").html(`
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Please fix the errors below.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                `);

                        // Show field-wise error messages
                        $.each(errors, function (key, value) {
                            let input = form.find(`[name="${key}"]`);
                            input.after(`<small class="text-danger">${value[0]}</small>`);
                        });
                    }
                });
            });

        });

        var swiper = new Swiper(".myNewsSwiper", {
            slidesPerView: 1,
            loop: true,
            spaceBetween: 10,

            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },

            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },

            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            },
        });
    </script>

@endsection