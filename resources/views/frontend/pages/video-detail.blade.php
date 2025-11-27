@extends('frontend.common.master')

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
                    <li><span class="opacity-50">{{ $video->title }}</span></li>
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
                            @if($video->youtube_link)
                                <iframe width="100%" height="100%" src="{{ $video->youtube_link }}" frameborder="0"
                                    allowfullscreen></iframe>
                            @else
                                <video width="100%" height="100%" controls>
                                    <source src="{{ asset($video->video_file) }}" type="video/mp4">
                                </video>
                            @endif
                        </div>
                        <div class="row mt-5">
                            <div class="col-lg-8">

                                <h1 class="h3 mb-3">{{ $video->title }}</h1>
                                <div class="post fs-6 md:fs-5">
                                    {!! $video->description !!}
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- RIGHT: SIDEBAR --}}
                    <div class="col-lg-4">
                        <div class="sidebar-wrap panel vstack gap-4" data-uc-sticky="end: true;">

                            {{-- SHARE BUTTONS --}}
                            @php
                                $shareUrl = route('video.detail', $video->slug);
                                $shareTitle = urlencode($video->title);
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

                            {{-- Recent Videos --}}
                            <div class="widget">
                                <h4 class="widget-title">Recent Videos</h4>
                                @foreach($recent_videos as $rv)
                                    <div class="d-flex mb-2 border-bottom pb-2">
                                        <a href="{{ route('video.detail', $rv->slug) }}">
                                            <img src="https://img.youtube.com/vi/{{ youtube_id($video->youtube_link) }}/mqdefault.jpg"
                                                width="90" class="rounded me-2">
                                        </a>
                                        <div>
                                            <a href="{{ route('video.detail', $rv->slug) }}" class="fw-bold d-block">
                                                {{ $rv->title }}
                                            </a>
                                            <small class="text-muted">{{ $rv->created_at->format('M d, Y') }}</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Ad Section --}}
                            <div class="widget">
                                <img src="https://reactheme.com/news5/news-magazine/wp-content/uploads/sites/26/2025/04/add__image.png"
                                    class="img-fluid rounded" alt="">
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </article>
    </div>
@endsection