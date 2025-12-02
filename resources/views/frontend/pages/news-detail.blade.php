@extends('frontend.common.master')
@section('meta_title', $news->meta_title)
@section('meta_description', $news->meta_description)
@section('meta_keywords', $news->meta_keywords)
@section('og_title', $news->title)
@section('og_description', Str::limit(strip_tags($news->short_description ?? $news->description), 150))
@section('og_type', 'article')
@php
    $firstImage = firstImage($news->images); // change to correct column if different
    $ogImage = $firstImage
        ? asset( $firstImage)
        : asset(optional($settings)->logo);
@endphp
@section('og_image', $ogImage)
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
    {{-- <style>
        @media print {

            body {
                width: 997px !important;
            }

            /* Show header on first page only */
            header {
                width: 997px !important;
                display: block;
                position: running(header);
            }

            /* Place header only on the first page */
            @page: first {
                margin-top: 50mm;
                /* adjust as needed */
            }

            @page {
                @top-center {
                    content: none;
                    /* No header on other pages */
                }
            }
        }
    </style> --}}

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

        <article class="post type-post single-post py-4 lg:py-6 xl:py-9  NewsSection">
            <div class="container max-w-xl">
                <div class="post-header">
                    <div class="panel vstack gap-4 md:gap-6 xl:gap-4 text-center">
                        <div @php
                            $shareUrl = route('news.detail', $news->slug);
                            $shareTitle = urlencode($news->title);
                             $shareText  = $news->title . "\n" . $shareUrl;
                        @endphp
                            class="panel vstack items-center max-w-400px sm:max-w-500px xl:max-w-md mx-auto gap-2 md:gap-3">
                            <h1 class="h4 sm:h2 lg:h1 xl:display-6">{{ $news->title }}</h1>
                            <ul class="post-share-icons nav-x gap-1 dark:text-white">
                                <li>
                                    <a class="btn btn-md p-0 border-gray-900 border-opacity-15 w-32px lg:w-48px h-32px lg:h-48px text-dark dark:text-white dark:border-white hover:bg-primary hover:border-primary hover:text-white rounded-circle"
                                        href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}"><i
                                           target="_blank" class="unicon-logo-facebook icon-1"></i></a>
                                </li>
                                <li>
                                    <a class="btn btn-md p-0 border-gray-900 border-opacity-15 w-32px lg:w-48px h-32px lg:h-48px text-dark dark:text-white dark:border-white hover:bg-primary hover:border-primary hover:text-white rounded-circle"
                                       target="_blank" href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}"><i
                                            class="unicon-logo-x-filled icon-1"></i></a>
                                </li>
                                <li>
                                    <a class="btn btn-md p-0 border-gray-900 border-opacity-15 w-32px lg:w-48px h-32px lg:h-48px text-dark dark:text-white dark:border-white hover:bg-primary hover:border-primary hover:text-white rounded-circle"
                                    target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url={{ $shareUrl }}&title={{ $shareTitle }}"><i
                                            class="unicon-logo-linkedin icon-1"></i></a>
                                </li>

                                <li>
                                    <a class="btn btn-md p-0 border-gray-900 border-opacity-15 w-32px lg:w-48px h-32px lg:h-48px text-dark dark:text-white dark:border-white hover:bg-primary hover:border-primary hover:text-white rounded-circle"
                                        href="https://www.instagram.com/?url={{ $shareUrl }}" target="_blank"><i
                                            class="unicon-logo-instagram icon-1"></i></a>
                                </li>
                                <li>
                                    <a class="btn btn-md p-0 border-gray-900 border-opacity-15 w-32px lg:w-48px h-32px lg:h-48px text-dark dark:text-white dark:border-white hover:bg-primary hover:border-primary hover:text-white rounded-circle"
                                       target="_blank" href="https://wa.me/?text={{ urlencode($shareText) }}"><i
                                            class="fa-brands fa-whatsapp icon-1"></i></a>
                                </li>
                                <li>
                                    <a class="btn btn-md p-0 border-gray-900 border-opacity-15 w-32px lg:w-48px h-32px lg:h-48px 
                          text-dark dark:text-white dark:border-white hover:bg-primary hover:border-primary 
                          hover:text-white rounded-circle" href="javascript:void(0);" onclick="window.print();">
                                        <i class="fa-solid fa-print icon-1"></i>
                                    </a>
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
                        <div class="post-meta panel hstack justify-between fs-7 text-dark text-opacity-60 mt-1">

                            <div class="meta">
                                <div class="hstack gap-1">
                                    <div class="post-author hstack gap-1 m-0">
                                        <a href="#"
                                            data-uc-tooltip="Peter Sawyer">
                                            <img src="{{ asset('frontend/images/avatars/02.png') }}"
                                                alt="{{ $news->reporter_name }}"
                                                class="w-24px h-24px rounded-circle">
                                        </a>
                                        <a href="#"
                                            class="text-dark text-none fw-bold">
                                            {{ $news->reporter_name }}
                                        </a>
                                    </div>
                                    <!-- Time BEFORE comment -->
                                    <div class="hstack gap-narrow">
                                       <i class="fa fa-clock"></i>
                                        <span>{{
                                            $news->created_at->diffForHumans()
                                            }}</span>
                                    </div>

                                    <!-- Comments -->
                                    <div class="hstack gap-narrow">
                                        <i class="icon-narrow unicon-view"></i>
                                        <span>{{ $news->totalViews()
                                            }}</span>
                                    </div>

                                    <!-- Author -->
                                    

                                </div>
                            </div>

                            <div class="actions">
                                <div class="hstack gap-1"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="panel position-relative mt-4 lg:mt-6 xl:mt-4">
                <div class="container">
                    <div class="content-wrap row child-col-12 lg:child-cols g-4 lg:g-6">

                       

                        <div class="lg:col-8 uc-first-column">
                            <div class="max-w-lg">
                                <div class="post-content text-dark panel fs-6 md:fs-5" data-uc-lightbox="animation: scale">
                                    {!! $news->description !!}
                                </div>
                                @php 
                                $ad = getAd('news_inside'); 
                                $image = $ad ? firstImage($ad->images) : null;
                            @endphp

                            @if($ad && $image)
                            <div class="news-inside-ad my-4 text-center">

                                <a href="{{ $ad->link ?? '#' }}" target="_blank" rel="nofollow">
                                    <img 
                                        src="{{ asset($image) }}" 
                                        alt="{{ $ad->title ?? 'Advertisement' }}" 
                                        class="w-100 rounded"
                                        style="max-width: 100%; height: auto; object-fit: cover;"
                                    >
                                </a>
                            </div>
                            @endif  
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
                       
                        <div class="lg:col-4" id="recent-posts">
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

                                    @php 
                                        $ad = getAd('news_right_side');
                                        $image = $ad ? firstImage($ad->images) : null;
                                    @endphp

                                    @if($ad && $image)
                                    <section id="media_image-1" class="widget widget_media_image">

                                        <a href="{{ $ad->link ?? '#' }}" target="_blank" rel="nofollow">
                                            <img 
                                                src="{{ asset($image) }}" 
                                                alt="{{ $ad->title ?? 'Advertisement' }}" 
                                                class="image attachment-full size-full"
                                                style="width:100%; height:auto;"
                                            >
                                        </a>

                                    </section>
                                    @endif
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