@extends('frontend.common.master')

@section('meta_title', 'Search results for: ' . $param)
@section('meta_description', 'Search results for: ' . $param)
@section('meta_keywords', $param)

@section('content')
    <div id="wrapper" class="wrap overflow-hidden-x">

        {{-- Breadcrumbs --}}
        <div class="breadcrumbs panel z-1 py-2 bg-gray-25 dark:bg-gray-100 dark:bg-opacity-5 dark:text-white">
            <div class="container max-w-xl">
                <ul class="breadcrumb nav-x justify-center gap-1 fs-7 sm:fs-6 m-0">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><i class="unicon-chevron-right opacity-50"></i></li>
                    <li><span class="opacity-50">Search</span></li>
                    <li><i class="unicon-chevron-right opacity-50"></i></li>
                    <li><span class="opacity-50">"{{ $param }}"</span></li>
                </ul>
            </div>
        </div>

        <div class="section py-3 sm:py-6 lg:py-9">
            <div class="container max-w-xl">
                <div class="panel vstack gap-3 sm:gap-6 lg:gap-9">

                    {{-- Page Heading --}}
                    <header class="page-header panel vstack text-center">
                        <h1 class="h3 lg:h1">Search Results for: "{{ $param }}"</h1>
                        <p class="fs-6 opacity-70">
                            {{ $search_results->total() }} results found
                        </p>
                    </header>

                    <div class="row g-4 xl:g-8">
                        <div class="col">
                            <div class="panel text-center">
                                <div
                                    class="row child-cols-12 sm:child-cols-6 lg:child-cols-4 col-match gy-4 xl:gy-6 gx-2 sm:gx-4">

                                    {{-- Loop results --}}
                                    @forelse ($search_results as $news)
                                        @php
                                            $images = json_decode($news->images, true);
                                            $firstImage = $images[0] ?? null;
                                        @endphp

                                        <div>
                                            <article class="post type-post panel vstack gap-2">
                                                <div class="post-image panel overflow-hidden">
                                                    <figure
                                                        class="featured-image m-0 ratio ratio-16x9 rounded uc-transition-toggle overflow-hidden bg-gray-25 dark:bg-gray-800">
                                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                                            src="{{ $firstImage ? asset($firstImage) : asset('frontend/images/common/img-fallback.png') }}"
                                                            alt="News Image" loading="lazy">

                                                        <a href="{{ route('news.detail', $news->slug) }}"
                                                            class="position-cover"></a>
                                                    </figure>

                                                    <div
                                                        class="post-category hstack gap-narrow position-absolute top-0 start-0 m-1 fs-7 fw-bold h-24px px-1 rounded-1 shadow-xs bg-white text-primary">
                                                        <a class="text-none" href="#">
                                                            {{ $news->category->category_name ?? 'Category' }}
                                                        </a>
                                                    </div>

                                                    <div
                                                        class="position-absolute top-0 end-0 w-150px h-150px rounded-top-end bg-gradient-45 from-transparent via-transparent to-black opacity-50">
                                                    </div>

                                                    <span
                                                        class="cstack position-absolute top-0 end-0 fs-6 w-40px h-40px text-white">
                                                        <i class="icon-narrow unicon-play-filled-alt"></i>
                                                    </span>
                                                </div>

                                                <div class="post-header panel vstack gap-1 lg:gap-2">
                                                    <h3 class="post-title h6 sm:h5 xl:h4 m-0 text-truncate-2">
                                                        <a class="text-none" href="{{ route('news.detail', $news->slug) }}">
                                                            {{ $news->title }}
                                                        </a>
                                                    </h3>

                                                    <div
                                                        class="post-meta panel hstack justify-center fs-7 fw-medium text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                        <div class="meta">
                                                            <div class="hstack gap-2">

                                                                {{-- Author --}}
                                                                <div class="post-author hstack gap-1">
                                                                    <img src="{{ asset('frontend/images/avatars/05.png') }}"
                                                                        class="w-24px h-24px rounded-circle">
                                                                    <span class="fw-bold">{{ $news->reporter_name }}</span>
                                                                </div>

                                                                {{-- Date --}}
                                                                <div class="post-date hstack gap-narrow">
                                                                    <span>{{ $news->created_at->format('M d, Y') }}</span>
                                                                </div>

                                                                {{-- Comments --}}
                                                                <div>
                                                                    <a href="#post_comment"
                                                                        class="post-comments text-none hstack gap-narrow">
                                                                        <i class="icon-narrow unicon-chat"></i>
                                                                        <span>{{ $news->comments->count() }}</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>

                                    @empty
                                        {{-- No results --}}
                                        <div class="col-12 text-center py-5">
                                            <h3>No results found for "{{ $param }}"</h3>
                                            <p class="opacity-70">Try searching with different keywords.</p>
                                        </div>
                                    @endforelse

                                </div>

                                @if ($search_results->hasPages())

                                    @php
                                        $current = $search_results->currentPage();
                                        $last = $search_results->lastPage();
                                        $start = max(1, $current - 2);
                                        $end = min($last, $current + 2);
                                    @endphp

                                    <div class="nav-pagination pt-3 mt-6 lg:mt-9 border-top border-gray-100 dark:border-gray-800">
                                        <ul class="nav-x uc-pagination hstack gap-1 justify-center ft-secondary">

                                            {{-- Previous --}}
                                            @if ($current == 1)
                                                <li class="uc-disabled">
                                                    <span class="icon icon-1 unicon-chevron-left"></span>
                                                </li>
                                            @else
                                                <li>
                                                    <a href="{{ route('search', ['param' => $param, 'page' => $current - 1]) }}">
                                                        <span class="icon icon-1 unicon-chevron-left"></span>
                                                    </a>
                                                </li>
                                            @endif

                                            {{-- First Page --}}
                                            @if ($start > 1)
                                                <li>
                                                    <a href="{{ route('search', ['param' => $param, 'page' => 1]) }}">1</a>
                                                </li>

                                                @if ($start > 2)
                                                    <li class="uc-disabled"><span>…</span></li>
                                                @endif
                                            @endif

                                            {{-- Middle Pages --}}
                                            @for ($page = $start; $page <= $end; $page++)
                                                @if ($page == $current)
                                                    <li><a class="uc-active">{{ $page }}</a></li>
                                                @else
                                                    <li>
                                                        <a href="{{ route('search', ['param' => $param, 'page' => $page]) }}">
                                                            {{ $page }}
                                                        </a>
                                                    </li>
                                                @endif
                                            @endfor

                                            {{-- Last Page --}}
                                            @if ($end < $last)
                                                @if ($end < $last - 1)
                                                    <li class="uc-disabled"><span>…</span></li>
                                                @endif

                                                <li>
                                                    <a href="{{ route('search', ['param' => $param, 'page' => $last]) }}">
                                                        {{ $last }}
                                                    </a>
                                                </li>
                                            @endif

                                            {{-- Next --}}
                                            @if ($current < $last)
                                                <li>
                                                    <a href="{{ route('search', ['param' => $param, 'page' => $current + 1]) }}">
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