@extends('frontend.common.master')
@section('meta_title', 'Live TV - ' . ($settings->meta_title ?? ''))
{{-- @section('meta_description', @$video->meta_details ?? Str::limit(strip_tags(@$video->description), 160))
@section('meta_keywords', @$video->meta_keyword ?? optional($settings)->meta_keywords)
@section('og_title', @$video->meta_title ?? @$video->title)
@section('og_description', @$video->meta_details ?? Str::limit(strip_tags(@$video->description), 160))
@section('og_image', youtube_id(@$video->youtube_link)
? "https://img.youtube.com/vi/" . youtube_id(@$video->youtube_link) . "/mqdefault.jpg"
: asset(optional($settings)->logo)
) --}}
@section('og_type', 'video')

@section('content')
    <div id="wrapper" class="wrap overflow-hidden-x">

        {{-- Breadcrumbs --}}
        <div class="breadcrumbs panel py-2 bg-gray-25 dark:bg-gray-100 dark:text-white">
            <div class="container max-w-xl">
                <ul class="breadcrumb nav-x justify-center gap-1 fs-7 sm:fs-6 m-0">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><i class="unicon-chevron-right opacity-50"></i></li>
                    <li><a href="{{ route('videos.list') }}">Videos</a></li>
                    <li><i class="unicon-chevron-right opacity-50"></i></li>
                    <li><span class="opacity-50">{{ @$video->title }}</span></li>
                </ul>
            </div>
        </div>

        <article class="post py-4 lg:py-6 xl:py-9">
            <div class="container max-w-xl">

                {{-- ================= TOP SECTION ================= --}}
                <div class="row g-4 lg:g-6">

                    {{-- LEFT: VIDEO PLAYER --}}
                    <div class="col-lg-8">

                        {{-- VIDEO PLAYER (YouTube OR uploaded video) --}}
                        <div class="ratio ratio-16x9 rounded overflow-hidden mb-3">

                            <iframe width="100%" height="100%" src="{{ optional($settings)->live_tv_url }}" frameborder="0"
                                allowfullscreen></iframe>

                        </div>
                        <div class="post-meta panel hstack justify-between fs-7 text-dark text-opacity-60 mt-1">

                            <div class="meta">
                                <div class="hstack gap-3">

                                    <!-- Time -->
                                    {{-- <div class="hstack gap-narrow">
                                        <i class="fa fa-clock"></i>
                                        <span></span>
                                    </div>

                                    <!-- Views -->
                                    <div class="hstack gap-narrow">
                                        <i class="icon-narrow unicon-view"></i>
                                        <span>20</span>
                                    </div> --}}

                                </div>



                            </div>
                        </div>

                        <div class="actions">
                            <div class="hstack gap-1"></div>
                        </div>

                    </div>

                    <div class="row mt-2">
                        <div class="col-lg-8">
                            <h1 class="h3 mb-3">{{ @$video->title }}</h1>
                            <div class="post fs-6 md:fs-5">
                                {!! @$video->description !!}
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        @php
                            $shareUrl = route('live.tv');
                            $shareTitle = urlencode('Live TV - ' . ($settings->meta_title ?? ''));
                        @endphp

                        <div class="panel text-center">
                            <h4 class="h6 mb-2">Share This Video</h4>
                            <ul class="nav-x justify-center gap-1">
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
                        </div>
                    </div>
                    <div class="col-lg-4 mt-3">
                        <div class="sidebar-wrap panel vstack gap-4" data-uc-sticky="end: true;">
                            {{-- Recent Videos --}}
                            
                            {{-- Ad Section --}}
                            @php 
                                        $ad = getAd('news_right_side');
                                        $image = $ad ? firstImage($ad->images) : null;
                                    @endphp

                                    @if($ad && $image)
                                    <div class="widget">
                                    <a href="{{ $ad->link ?? '#' }}" target="_blank" rel="nofollow">
                                                    <img 
                                                        src="{{ asset($image) }}" 
                                                        alt="{{ $ad->title ?? 'Advertisement' }}" 
                                                        class="image attachment-full size-full"
                                                        style="width:100%; height:auto;"
                                                    >
                                                </a>
                            </div>
                                    @endif


                        </div>
                    </div>
                </div>

            </div>
    </div>

    </div>
    </div>
    </article>
    </div>
@endsection