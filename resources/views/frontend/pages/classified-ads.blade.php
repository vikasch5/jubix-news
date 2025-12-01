@extends('frontend.common.master')

@section('content')
<div class="container py-5">
  <header class="text-center mb-4">
    <h1 class="h3">Classified Ads</h1>
  </header>

  @php
    $ads = [
      [
        'images' => [
          'https://picsum.photos/seed/car1/800/600',
          'https://picsum.photos/seed/car2/800/600',
          'https://picsum.photos/seed/car3/800/600',
        ],
        'title' => 'Buy / Sell Used Cars',
        'link'  => 'https://example.com/ad1'
      ],
      [
        'images' => [
          'https://picsum.photos/seed/house1/800/600',
          'https://picsum.photos/seed/house2/800/600',
        ],
        'title' => 'House for Rent in Mumbai',
        'link'  => 'https://example.com/ad2'
      ],
      // ... more ads
    ];
  @endphp

  <div class="row g-4">
    @foreach ($ads as $i => $ad)
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100">

          <!-- Thumbnail wrapper with fixed aspect ratio -->
          <div style="position: relative; width: 100%; padding-top: 75%; overflow: hidden;">
            <a href="{{ $ad['images'][0] }}"
               class="glightbox"
               data-gallery="gallery-{{ $i }}"
               data-title="{{ $ad['title'] }}">
              <img src="{{ $ad['images'][0] }}"
                   class="img-fluid"
                   style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; cursor: zoom-in;"
                   alt="{{ $ad['title'] }}">
            </a>
            @if (count($ad['images']) > 1)
              @foreach (array_slice($ad['images'], 1) as $img)
                <a href="{{ $img }}"
                   class="glightbox d-none"
                   data-gallery="gallery-{{ $i }}"
                   data-title="{{ $ad['title'] }}"></a>
              @endforeach
            @endif
          </div>

          <div class="card-body text-center">
            <h5 class="card-title fs-6">{{ $ad['title'] }}</h5>
            <a href="{{ $ad['link'] }}" target="_blank" class="btn btn-primary btn-sm">View Details</a>
          </div>

        </div>
      </div>
    @endforeach
  </div>
</div>

<!-- Include GLightbox CSS & JS in your layout head/footer -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    GLightbox({
      selector: '.glightbox',
      touchNavigation: true,
      loop: true
    });
  });
</script>
@endsection
