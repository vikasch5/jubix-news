@extends('frontend.common.master')

@section('content')
  <style>
    .share-icons {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 10px;
    }

    .share-icons .share {
      width: 38px;
      height: 38px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      text-decoration: none;
      background: #f3f4f6;
      transition: all .25s ease;
    }

    .share-icons .share i {
      font-size: 18px;
      line-height: 1;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* Hover Colors */

    .share.wa:hover {
      background: #25D366;
      color: #fff;
    }

    .share.fb:hover {
      background: #1877F2;
      color: #fff;
    }

    .share.tw:hover {
      background: #000;
      color: #fff;
    }

    .share.li:hover {
      background: #0A66C2;
      color: #fff;
    }

    .share.copy:hover {
      background: #6c757d;
      color: #fff;
    }

    .share:hover {
      transform: translateY(-3px);
    }
  </style>

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

              <a href="{{ $ad->link }}" target="_blank" class="btn btn-primary btn-sm">
                View Details
              </a>

              @php
                $url = urlencode($ad->link);
                $title = urlencode($ad->title);
              @endphp

              <div class="d-flex justify-content-center gap-2 share-icons mt-2">

                <a href="https://wa.me/?text={{ $title }}%20{{ $url }}" target="_blank" class="share wa">
                  <i class="uil uil-whatsapp"></i>
                </a>

                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}" target="_blank" class="share fb">
                  <i class="uil uil-facebook-f"></i>
                </a>

                <a href="https://twitter.com/intent/tweet?url={{ $url }}&text={{ $title }}" target="_blank"
                  class="share tw">
                  <i class="uil uil-twitter"></i>
                </a>

                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $url }}" target="_blank" class="share li">
                  <i class="uil uil-linkedin"></i>
                </a>

                <a href="javascript:void(0)" onclick="copyLink('{{ $ad->link }}')" class="share copy">
                  <i class="uil uil-link"></i>
                </a>

              </div>

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
    function copyLink(link) {
      navigator.clipboard.writeText(link);
      alert("Link copied!");
    }
  </script>
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