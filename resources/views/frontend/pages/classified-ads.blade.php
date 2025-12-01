@extends('frontend.common.master')

@section('content')

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/css/lightgallery-bundle.min.css" />

  <div class="container py-5">

    <header class="text-center mb-4">
      <h1 class="h3">Classified Ads</h1>
    </header>



    <div class="row g-4">
      @foreach ($ads as $i => $ad)

        @php
          $images = json_decode($ad->images, true) ?? [];
          $firstImage = $images[0] ?? 'https://via.placeholder.com/600x400?text=No+Image';
        @endphp

        <div class="col-12 col-md-6 col-lg-4">

          <div class="card border-0 shadow-sm h-100">

            <!-- Thumbnail -->
            <div onclick="openGallery({{ $i }})"
              style="position:relative;width:100%;padding-top:75%;overflow:hidden;cursor:zoom-in;">

              <img src="{{ $firstImage }}" style="position:absolute;top:0;left:0;width:100%;height:100%;object-fit:cover;">
            </div>

            <div class="card-body text-center">
              <h5 class="card-title fs-6">{{ $ad->title }}</h5>
              <a href="{{ $ad->link }}" target="_blank" class="btn btn-primary btn-sm">View Details</a>
            </div>
          </div>

          <!-- LightGallery Container (only for this ad) -->
          <div id="gallery-{{ $i }}" class="d-none">
            @foreach ($images as $img)
              <a href="{{ $img }}">
                <img src="{{ $img }}">
              </a>
            @endforeach
          </div>

        </div>

      @endforeach
    </div>

  </div>

  <!-- LightGallery JS -->
  <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/lightgallery.umd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/zoom/lg-zoom.umd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/thumbnail/lg-thumbnail.umd.min.js"></script>

  <script>
    const galleryInstances = {};

    function openGallery(id) {
      const galleryElem = document.getElementById(`gallery-${id}`);

      // Create instance only once for each ad
      if (!galleryInstances[id]) {
        galleryInstances[id] = lightGallery(galleryElem, {
          plugins: [lgThumbnail, lgZoom],
          thumbnail: true,
          zoom: true,
          speed: 400,
          hideBarsDelay: 3000,
          download: false,
        });
      }

      // Always open from first image
      galleryInstances[id].openGallery(0);
    }
  </script>

@endsection