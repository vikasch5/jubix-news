@extends('frontend.common.master')
@section('content')
    <div id="wrapper" class="wrap overflow-hidden-x">
        {{-- Breadcrumbs --}}
        <div class="breadcrumbs panel z-1 py-2 bg-gray-25 dark:bg-gray-100 dark:bg-opacity-5 dark:text-white">
            <div class="container max-w-xl">
                <ul class="breadcrumb nav-x justify-center gap-1 fs-7 sm:fs-6 m-0">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><i class="unicon-chevron-right opacity-50"></i></li>
                    <li><span class="opacity-50">Videos</span></li>
                </ul>
            </div>
        </div>

        <div class="section py-3 sm:py-6 lg:py-9">
            <div class="container max-w-xl">
                <div class="panel vstack gap-3 sm:gap-6 lg:gap-9">

                    {{-- Page Header --}}
                    <header class="page-header panel vstack text-center">
                        <h1 class="h3 lg:h1">Videos</h1>
                    </header>

                    <div class="row g-4 xl:g-8">
                        <div class="col">
                            <div class="panel text-center">
                                <div
                                    class="row child-cols-12 sm:child-cols-6 lg:child-cols-4 col-match gy-4 xl:gy-6 gx-2 sm:gx-4">

                                    @foreach ($videos as $video)
                                        
                                        <div>
                                            <article class="post type-post panel vstack gap-2">
                                                <div class="post-image panel overflow-hidden">
                                                    <figure
                                                        class="featured-image m-0 ratio ratio-16x9 rounded uc-transition-toggle overflow-hidden bg-gray-25 dark:bg-gray-800">
                                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                                            src="https://img.youtube.com/vi/{{ youtube_id($video->youtube_link) }}/mqdefault.jpg"
                                                            alt="{{ $video->title }}" loading="lazy">
                                                             <div class="video-icon-bg">
                                                                        <i class="video-icon unicon-play"></i>
                                                                    </div>
                                                        <a href="{{ route('video.detail', $video->slug) }}"
                                                            class="position-cover"
                                                            data-caption="{{ $video->title }}"></a>
                                                            
                                                    </figure>

                                                    {{-- Badge (you can change this to category if you have it) --}}
                                                    <div
                                                        class="post-category hstack gap-narrow position-absolute top-0 start-0 m-1 fs-7 fw-bold h-24px px-1 rounded-1 shadow-xs bg-white text-primary">
                                                        <span class="text-none">Videos</span>
                                                    </div>

                                                    <div
                                                        class="position-absolute top-0 end-0 w-150px h-150px rounded-top-end bg-gradient-45 from-transparent via-transparent to-black opacity-50">
                                                    </div>

                                                    {{-- Play Icon --}}
                                                    <span
                                                        class="cstack position-absolute top-0 end-0 fs-6 w-40px h-40px text-white">
                                                        <i class="icon-narrow unicon-play-filled-alt"></i>
                                                    </span>
                                                </div>

                                                <div class="post-header panel vstack gap-1 lg:gap-2">
                                                    <h3 class="post-title h6 sm:h5 xl:h4 m-0 text-truncate-2 m-0">
                                                        <a class="text-none"
                                                            href="{{ route('video.detail', $video->slug) }}">
                                                            {{ $video->title }}
                                                        </a>
                                                    </h3>

                                                    <div>
                                                        <div
                                                            class="post-meta panel hstack justify-center fs-7 fw-medium text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                            <div class="meta">
                                                                <div class="hstack gap-2">
                                                                    {{-- If you have uploader/author field --}}
                                                                    @if(!empty($video->uploader_name))
                                                                        <div>
                                                                            <div class="post-author hstack gap-1">
                                                                                <a href="#">
                                                                                    <img src="{{ asset('frontend/images/avatars/05.png') }}"
                                                                                        alt="{{ $video->uploader_name }}"
                                                                                        class="w-24px h-24px rounded-circle">
                                                                                </a>
                                                                                <a href="#"
                                                                                    class="text-black dark:text-white text-none fw-bold">
                                                                                    {{ $video->uploader_name }}
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    @endif

                                                                    <div>
                                                                        <div class="post-date hstack gap-narrow">
                                                                            <span>{{ $video->created_at->format('M d, Y') }}</span>
                                                                        </div>
                                                                    </div>

                                                                    {{-- If later you add comments for videos, you can enable this --}}
                                                                    {{-- 
                                                                    <div>
                                                                        <a href="#video_comment"
                                                                            class="post-comments text-none hstack gap-narrow">
                                                                            <i class="icon-narrow unicon-chat"></i>
                                                                            <span>{{ $video->comments->count() }}</span>
                                                                        </a>
                                                                    </div>
                                                                    --}}
                                                                </div>
                                                            </div>
                                                            <div class="actions">
                                                                <div class="hstack gap-1"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    @endforeach

                                </div>

                                {{-- Pagination --}}
                                @if ($videos->hasPages())
                                    @php
                                        $current = $videos->currentPage();
                                        $last = $videos->lastPage();
                                        $start = max(1, $current - 2);
                                        $end = min($last, $current + 2);
                                    @endphp

                                    <div
                                        class="nav-pagination pt-3 mt-6 lg:mt-9 border-top border-gray-100 dark:border-gray-800">
                                        <ul
                                            class="nav-x uc-pagination hstack gap-1 justify-center ft-secondary">

                                            {{-- Previous --}}
                                            @if ($current == 1)
                                                <li class="uc-disabled">
                                                    <span class="icon icon-1 unicon-chevron-left"></span>
                                                </li>
                                            @else
                                                <li>
                                                    <a href="{{ $videos->url($current - 1) }}">
                                                        <span class="icon icon-1 unicon-chevron-left"></span>
                                                    </a>
                                                </li>
                                            @endif

                                            {{-- First page + leading dots --}}
                                            @if ($start > 1)
                                                <li>
                                                    <a href="{{ $videos->url(1) }}">1</a>
                                                </li>

                                                @if ($start > 2)
                                                    <li class="uc-disabled"><span>…</span></li>
                                                @endif
                                            @endif

                                            {{-- Middle pages --}}
                                            @for ($page = $start; $page <= $end; $page++)
                                                @if ($page == $current)
                                                    <li><a class="uc-active">{{ $page }}</a></li>
                                                @else
                                                    <li><a href="{{ $videos->url($page) }}">{{ $page }}</a></li>
                                                @endif
                                            @endfor

                                            {{-- Trailing dots + last page --}}
                                            @if ($end < $last)
                                                @if ($end < $last - 1)
                                                    <li class="uc-disabled"><span>…</span></li>
                                                @endif

                                                <li>
                                                    <a href="{{ $videos->url($last) }}">{{ $last }}</a>
                                                </li>
                                            @endif

                                            {{-- Next --}}
                                            @if ($current < $last)
                                                <li>
                                                    <a href="{{ $videos->url($current + 1) }}">
                                                        <span class="icon icon-1 unicon-chevron-right"></span>
                                                    </a>
                                                </li>
                                            @else
                                                <li class="uc-disabled">
                                                    <span class="icon icon-1 unicon-chevron-right"></span>
                                                </li>
                                            @endif

                                        </ul>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
