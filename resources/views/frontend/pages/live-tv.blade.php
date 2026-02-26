@extends('frontend.common.master')
@section('meta_title', 'Live TV – ' . ($settings->meta_title ?? ''))
@section('og_type', 'video')

@section('content')

@php
    $shareUrl   = route('live.tv');
    $shareTitle = urlencode('Watch Bharat TV Live — 24/7 News & Entertainment');
    $ad         = getAd('news_right_side');
    $adImage    = $ad ? firstImage($ad->images) : null;
@endphp

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Syne:wght@700;800&display=swap" rel="stylesheet">

<div class="ltv-page">

    {{-- ── TOP NAV BAR ── --}}
    <header class="ltv-topbar">
        <div class="ltv-container">
            <div class="ltv-topbar__inner">
                <div class="ltv-topbar__brand">
                    <div class="ltv-topbar__brand-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="3.5" fill="currentColor"/>
                            <path d="M8 8a6 6 0 0 0 0 8M16 8a6 6 0 0 1 0 8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M4.5 4.5a11 11 0 0 0 0 15M19.5 4.5a11 11 0 0 1 0 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" opacity=".4"/>
                        </svg>
                    </div>
                    <div>
                        <span class="ltv-topbar__brand-eyebrow">Live Television</span>
                        <h1 class="ltv-topbar__brand-name">Bharat TV</h1>
                    </div>
                </div>
                <div class="ltv-topbar__meta">
                    <div class="ltv-live-chip">
                        <span class="ltv-live-dot"></span>
                        <span>LIVE NOW</span>
                    </div>
                    {{-- <div class="ltv-viewers">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" opacity=".5"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                        <span id="viewer-count">2,487</span>&nbsp;watching
                    </div> --}}
                </div>
            </div>
        </div>
    </header>

    {{-- ── MAIN LAYOUT ── --}}
    <main class="ltv-main">
        <div class="ltv-container">
            <div class="ltv-grid">

                {{-- LEFT: PLAYER --}}
                <section class="ltv-player-col">

                    <div class="channel-selector-segmented">
    <div class="segmented-control" role="tablist">
        <button class="ltv-tab ltv-tab--active" id="btn-main" role="tab" aria-selected="true"
            onclick="changeStream('main','{{ $settings->live_tv_url ?? '' }}','Bharat TV Live','{{ $settings->live_tv_description ?? '' }}')">
            <span class="ltv-tab__dot"></span>
            <div class="ltv-tab__content">
                <span class="ltv-tab__name">Bharat TV</span>
                <span class="ltv-tab__badge ltv-tab__badge--red">News</span>
            </div>
        </button>

        <button class="ltv-tab" id="btn-bhakti" role="tab" aria-selected="false"
            onclick="changeStream('bhakti','{{ $settings->bhakti_live_tv_url ?? '' }}','{{ $settings->bhakti_live_tv_title ?? 'Bhakti TV' }}','{{ $settings->bhakti_live_tv_description ?? '' }}')">
            <span class="ltv-tab__dot"></span>
            <div class="ltv-tab__content">
                <span class="ltv-tab__name">Bharat Bhakti</span>
                <span class="ltv-tab__badge ltv-tab__badge--saffron">Spiritual</span>
            </div>
        </button>
    </div>
</div>

                    <div class="ltv-player">
                        <div class="ltv-player__frame">
                            <div class="ratio ratio-16x9">
                                <iframe id="main-player"
                                    src="{{ $settings->live_tv_url ?? '' }}"
                                    frameborder="0"
                                    allow="autoplay; encrypted-media; picture-in-picture"
                                    allowfullscreen
                                    title="Bharat TV Live Stream">
                                </iframe>
                            </div>
                        </div>
                        <div class="ltv-player__footer">
                            <div class="ltv-player__info">
                                <div class="ltv-live-label">
                                    <span class="ltv-live-label__dot"></span>
                                    <span>LIVE</span>
                                </div>
                                <h2 class="ltv-player__title" id="stream-title">Bharat TV Live</h2>
                            </div>
                            {{-- <div class="ltv-player__viewers">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                                <span id="footer-viewers">2,487</span>
                            </div> --}}
                        </div>
                    </div>

                    <div class="ltv-description">
                        <p id="stream-desc">{{ $settings->live_tv_description ?? 'Bharat TV Live — Broadcasting live 24/7 — breaking news, current affairs, and India\'s top stories as they happen.' }}</p>
                    </div>

                </section>

                {{-- RIGHT: SIDEBAR --}}
                <aside class="ltv-sidebar">

                    {{-- Share Card --}}
                    <div class="ltv-card">
                        <div class="ltv-card__head">
                            <div class="ltv-card__icon ltv-card__icon--blue">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
                            </div>
                            <div>
                                <h3 class="ltv-card__title">Share Stream</h3>
                                <p class="ltv-card__subtitle">Invite friends to watch live</p>
                            </div>
                        </div>
                        <div class="ltv-share-grid">
                            <a href="https://wa.me/?text={{ $shareTitle }}%20{{ $shareUrl }}" target="_blank" rel="noopener" class="ltv-share-btn ltv-share-btn--wa">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.123 1.532 5.856L.058 23.5l5.799-1.52A11.95 11.95 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.891 0-3.666-.523-5.184-1.433l-.373-.219-3.443.903.919-3.352-.24-.386A9.96 9.96 0 0 1 2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>
                                WhatsApp
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" rel="noopener" class="ltv-share-btn ltv-share-btn--fb">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}" target="_blank" rel="noopener" class="ltv-share-btn ltv-share-btn--tw">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.748l7.73-8.835L1.254 2.25H8.08l4.259 5.63zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                X / Twitter
                            </a>
                            <button onclick="copyLink('{{ $shareUrl }}')" class="ltv-share-btn ltv-share-btn--copy">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                                <span id="copy-label">Copy Link</span>
                            </button>
                        </div>
                    </div>

                    {{-- Schedule Card --}}
                    {{-- <div class="ltv-card">
                        <div class="ltv-card__head">
                            <div class="ltv-card__icon ltv-card__icon--orange">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            </div>
                            <div>
                                <h3 class="ltv-card__title">On Air Today</h3>
                                <p class="ltv-card__subtitle">Today's broadcast schedule</p>
                            </div>
                        </div>
                        <div class="ltv-schedule">
                            <div class="ltv-sched-item ltv-sched-item--now">
                                <div class="ltv-sched-time"><span class="ltv-sched-time__label">NOW</span></div>
                                <div class="ltv-sched-track">
                                    <div class="ltv-sched-track__dot ltv-sched-track__dot--live"></div>
                                    <div class="ltv-sched-track__line ltv-sched-track__line--live"></div>
                                </div>
                                <div class="ltv-sched-info">
                                    <p class="ltv-sched-show">Live News Bulletin</p>
                                    <p class="ltv-sched-tag">Breaking News</p>
                                </div>
                            </div>
                            <div class="ltv-sched-item">
                                <div class="ltv-sched-time"><span class="ltv-sched-time__label">2:00 PM</span></div>
                                <div class="ltv-sched-track">
                                    <div class="ltv-sched-track__dot"></div>
                                    <div class="ltv-sched-track__line"></div>
                                </div>
                                <div class="ltv-sched-info">
                                    <p class="ltv-sched-show">Business Hour</p>
                                    <p class="ltv-sched-tag">Economy & Markets</p>
                                </div>
                            </div>
                            <div class="ltv-sched-item">
                                <div class="ltv-sched-time"><span class="ltv-sched-time__label">4:00 PM</span></div>
                                <div class="ltv-sched-track">
                                    <div class="ltv-sched-track__dot"></div>
                                    <div class="ltv-sched-track__line"></div>
                                </div>
                                <div class="ltv-sched-info">
                                    <p class="ltv-sched-show">Regional News</p>
                                    <p class="ltv-sched-tag">State & Local</p>
                                </div>
                            </div>
                            <div class="ltv-sched-item">
                                <div class="ltv-sched-time"><span class="ltv-sched-time__label">8:00 PM</span></div>
                                <div class="ltv-sched-track">
                                    <div class="ltv-sched-track__dot"></div>
                                </div>
                                <div class="ltv-sched-info">
                                    <p class="ltv-sched-show">Prime Time News</p>
                                    <p class="ltv-sched-tag">Top Stories</p>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    {{-- Advertisement --}}
                    @if($ad && $adImage)
                    <div class="ltv-ad-card">
                        <p class="ltv-ad-label">Sponsored</p>
                        <a href="{{ $ad->link ?? '#' }}" target="_blank" rel="noopener sponsored" class="ltv-ad-link">
                            <img src="{{ asset($adImage) }}" alt="Advertisement" class="ltv-ad-img" loading="lazy">
                            <div class="ltv-ad-cta">
                                <span>Visit Site</span>
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </div>
                        </a>    
                    </div>
                    @endif

                </aside>

            </div>
        </div>
    </main>

</div>

<script>
(function(){
    'use strict';

    window.changeStream = function(id, url, title, desc) {
        var p = document.getElementById('main-player');
        p.classList.add('ltv-fading');
        setTimeout(function(){ p.src = url; p.classList.remove('ltv-fading'); }, 280);
        document.getElementById('stream-title').textContent = title;
        document.getElementById('stream-desc').textContent  = desc;
        document.querySelectorAll('.ltv-tab').forEach(function(b){
            b.classList.remove('ltv-tab--active');
            b.setAttribute('aria-selected','false');
        });
        var a = document.getElementById('btn-'+id);
        if(a){ a.classList.add('ltv-tab--active'); a.setAttribute('aria-selected','true'); }
    };

    window.copyLink = function(url) {
        var lbl = document.getElementById('copy-label');
        var done = function(){ lbl.textContent='Copied!'; setTimeout(function(){ lbl.textContent='Copy Link'; },2200); };
        if(navigator.clipboard){ navigator.clipboard.writeText(url).then(done).catch(done); }
        else {
            var el = document.createElement('textarea');
            el.value = url; el.style.cssText = 'position:fixed;opacity:0';
            document.body.appendChild(el); el.focus(); el.select();
            try{ document.execCommand('copy'); }catch(e){}
            document.body.removeChild(el); done();
        }
    };

    /* Animated viewer count */
    var els = [document.getElementById('viewer-count'), document.getElementById('footer-viewers')];
    function fmt(n){ return n>=1000?(n/1000).toFixed(1)+'k':String(n); }
    setInterval(function(){
        var v = 2487 + Math.floor(Math.random()*500) - 200;
        var f = fmt(Math.max(1800, v));
        els.forEach(function(el){ if(el) el.textContent=f; });
    }, 7000);
}());
</script>

@endsection