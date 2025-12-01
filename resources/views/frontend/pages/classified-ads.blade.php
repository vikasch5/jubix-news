@extends('frontend.common.master')

@section('content')
    <div id="wrapper" class="wrap overflow-hidden-x">

        <div class="breadcrumbs panel z-1 py-2 bg-gray-25 dark:bg-gray-100 dark:bg-opacity-5 dark:text-white">
            <div class="container max-w-xl">
                <ul class="breadcrumb nav-x justify-center gap-1 fs-7 sm:fs-6 m-0">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><i class="unicon-chevron-right opacity-50"></i></li>
                    <li><span class="opacity-50">Classified Ads</span></li>
                </ul>
            </div>
        </div>

        <div class="section py-4 lg:py-6 xl:py-8">
            <div class="container max-w-lg">

                <header class="page-header panel text-center mb-4">
                    <h1 class="h3 lg:h1 m-0">Classified Ads</h1>
                </header>

                @php
                    $ads = [
                        [
                            'image' => 'https://picsum.photos/seed/car1/400/250',
                            'title' => 'Buy / Sell Used Cars',
                            'link' => 'https://example.com/ad1'
                        ],
                        [
                            'image' => 'https://picsum.photos/seed/house1/400/250',
                            'title' => 'House for Rent in Mumbai',
                            'link' => 'https://example.com/ad2'
                        ],
                        [
                            'image' => 'https://picsum.photos/seed/mobile1/400/250',
                            'title' => 'Mobile Phones – Best Deals',
                            'link' => 'https://example.com/ad3'
                        ],
                        [
                            'image' => 'https://picsum.photos/seed/job1/400/250',
                            'title' => 'Find Jobs Near You',
                            'link' => 'https://example.com/ad4'
                        ],
                        [
                            'image' => 'https://picsum.photos/seed/furniture1/400/250',
                            'title' => 'Second-hand Furniture Sale',
                            'link' => 'https://example.com/ad5'
                        ],
                        [
                            'image' => 'https://picsum.photos/seed/property1/400/250',
                            'title' => 'Property for Sale',
                            'link' => 'https://example.com/ad6'
                        ],
                    ];
                @endphp

                <div class="row g-3">
                    @foreach ($ads as $ad)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card shadow-sm h-100 border-0">
                                <a href="{{ $ad['link'] }}" target="_blank">
                                    <img src="{{ $ad['image'] }}" class="card-img-top" style="height: 200px; object-fit: cover;"
                                        alt="{{ $ad['title'] }}">
                                </a>

                                <div class="card-body text-center">
                                    <h5 class="card-title fs-6">{{ $ad['title'] }}</h5>
                                    <a href="{{ $ad['link'] }}" class="btn btn-primary btn-sm" target="_blank">
                                        Visit
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

    </div>
@endsection