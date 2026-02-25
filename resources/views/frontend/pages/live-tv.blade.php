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
                    <div class="ltv-viewers">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" opacity=".5"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                        <span id="viewer-count">2,487</span>&nbsp;watching
                    </div>
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

                    <div class="ltv-tabs" role="tablist" aria-label="Select Channel">
                        <button class="ltv-tab ltv-tab--active" id="btn-main" role="tab" aria-selected="true"
                            onclick="changeStream('main','{{ $settings->live_tv_url ?? '' }}','Bharat TV Live','Broadcasting live 24/7 — breaking news, current affairs, and India\'s top stories as they happen.')">
                            <span class="ltv-tab__dot"></span>
                            <span class="ltv-tab__name">Bharat TV</span>
                            <span class="ltv-tab__badge ltv-tab__badge--red">News</span>
                        </button>
                        <button class="ltv-tab" id="btn-bhakti" role="tab" aria-selected="false"
                            onclick="changeStream('bhakti','{{ $settings->bhakti_tv_url ?? '' }}','Bharat TV Bhakti','Devotional and spiritual programming — bhajans, pravachans, katha and sacred content from across India.')">
                            <span class="ltv-tab__dot"></span>
                            <span class="ltv-tab__name">Bharat TV Bhakti</span>
                            <span class="ltv-tab__badge ltv-tab__badge--saffron">Spiritual</span>
                        </button>
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
                            <div class="ltv-player__viewers">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                                <span id="footer-viewers">2,487</span>
                            </div>
                        </div>
                    </div>

                    <div class="ltv-description">
                        <p id="stream-desc">Broadcasting live 24/7 — breaking news, current affairs, and India's top stories as they happen.</p>
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
                    <div class="ltv-card">
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
                    </div>

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

<style>
.ltv-page {
    --c-bg:          #f4f6fb;
    --c-surface:     #ffffff;
    --c-surface2:    #f0f2f8;
    --c-border:      #e3e7f0;
    --c-border-dark: #c8cedd;
    --c-text:        #0d1120;
    --c-text-2:      #445069;
    --c-text-3:      #8b93ac;
    --c-red:         #e8303a;
    --c-red-soft:    #fff1f2;
    --c-red-border:  #fecdd3;
    --c-blue:        #2563eb;
    --c-blue-soft:   #eff6ff;
    --c-orange:      #f97316;
    --c-orange-soft: #fff7ed;
    --c-saffron:     #ea580c;
    --shadow-sm:     0 1px 3px rgba(15,20,40,.06), 0 1px 2px rgba(15,20,40,.04);
    --shadow-md:     0 4px 16px rgba(15,20,40,.09), 0 1px 4px rgba(15,20,40,.05);
    --shadow-lg:     0 8px 36px rgba(15,20,40,.11), 0 2px 8px rgba(15,20,40,.06);
    --radius-xl:     18px;
    --radius-lg:     13px;
    --radius-md:     9px;
    --trans:         0.22s cubic-bezier(.4,0,.2,1);
    --font-head:     'Syne', sans-serif;
    --font-body:     'Plus Jakarta Sans', sans-serif;

    font-family:     var(--font-body);
    background:      var(--c-bg);
    color:           var(--c-text);
    min-height:      100vh;
}

/* Container */
.ltv-container { max-width: 1300px; margin: 0 auto; padding: 0 28px; }

/* ── TOPBAR ── */
.ltv-topbar {
    background: var(--c-surface);
    border-bottom: 1px solid var(--c-border);
    padding: 14px 0;
    position: sticky; top: 0; z-index: 100;
    box-shadow: var(--shadow-sm);
}
.ltv-topbar__inner {
    display: flex; align-items: center;
    justify-content: space-between; gap: 16px; flex-wrap: wrap;
}
.ltv-topbar__brand { display: flex; align-items: center; gap: 12px; }
.ltv-topbar__brand-icon {
    width: 42px; height: 42px; background: var(--c-red);
    border-radius: var(--radius-md); display: flex;
    align-items: center; justify-content: center; color: #fff;
    flex-shrink: 0; box-shadow: 0 4px 12px rgba(232,48,58,.28);
}
.ltv-topbar__brand-eyebrow {
    display: block; font-size: 10px; font-weight: 600;
    letter-spacing: .14em; text-transform: uppercase;
    color: var(--c-text-3); margin-bottom: 2px;
}
.ltv-topbar__brand-name {
    font-family: var(--font-head); font-size: 1.4rem; font-weight: 800;
    color: var(--c-text); line-height: 1; margin: 0; letter-spacing: .02em;
}
.ltv-topbar__meta { display: flex; align-items: center; gap: 14px; }
.ltv-live-chip {
    display: flex; align-items: center; gap: 7px;
    background: var(--c-red); color: #fff;
    font-size: 11px; font-weight: 700; letter-spacing: .12em;
    padding: 6px 14px; border-radius: 20px;
    box-shadow: 0 3px 10px rgba(232,48,58,.3);
}
.ltv-live-dot {
    width: 7px; height: 7px; background: #fff; border-radius: 50%;
    animation: ltv-pulse 1.4s ease-in-out infinite;
}
.ltv-viewers {
    display: flex; align-items: center; gap: 6px;
    font-size: 13px; font-weight: 500; color: var(--c-text-2);
}

/* ── MAIN ── */
.ltv-main { padding: 28px 0 64px; }
.ltv-grid {
    display: grid;
    grid-template-columns: 1fr 356px;
    gap: 26px;
    align-items: start;
}

/* ── TABS ── */
.ltv-tabs {
    display: flex; gap: 8px; margin-bottom: 14px;
    background: var(--c-surface); border: 1px solid var(--c-border);
    border-radius: var(--radius-lg); padding: 5px;
    box-shadow: var(--shadow-sm);
}
.ltv-tab {
    flex: 1; display: flex; align-items: center; gap: 9px;
    padding: 11px 15px; background: transparent; border: none;
    border-radius: var(--radius-md); cursor: pointer;
    transition: all var(--trans); font-family: var(--font-body);
    color: var(--c-text-3); text-align: left;
}
.ltv-tab:hover { background: var(--c-surface2); color: var(--c-text-2); }
.ltv-tab--active {
    background: var(--c-red); color: #fff;
    box-shadow: 0 3px 12px rgba(232,48,58,.25);
}
.ltv-tab__dot {
    width: 8px; height: 8px; border-radius: 50%;
    background: currentColor; flex-shrink: 0; opacity: .5;
}
.ltv-tab--active .ltv-tab__dot { opacity: 1; animation: ltv-pulse 1.4s ease-in-out infinite; }
.ltv-tab__name { font-weight: 600; font-size: 14px; flex: 1; }
.ltv-tab__badge {
    font-size: 10px; font-weight: 700; letter-spacing: .06em;
    padding: 2px 9px; border-radius: 20px; white-space: nowrap;
}
.ltv-tab__badge--red   { background: var(--c-red-soft);   color: var(--c-red); }
.ltv-tab__badge--saffron { background: var(--c-orange-soft); color: var(--c-saffron); }
.ltv-tab--active .ltv-tab__badge--red,
.ltv-tab--active .ltv-tab__badge--saffron { background: rgba(255,255,255,.22); color: #fff; }

/* ── PLAYER ── */
.ltv-player {
    background: #000;
    border: 1px solid var(--c-border);
    border-radius: var(--radius-xl);
    overflow: hidden;
    box-shadow: var(--shadow-lg);
}
#main-player { display: block; width: 100%; transition: opacity .3s ease; }
#main-player.ltv-fading { opacity: 0; }

.ltv-player__footer {
    display: flex; align-items: center;
    justify-content: space-between;
    padding: 14px 20px;
    border-top: 1px solid rgba(255,255,255,.07);
    background: #fff;
    border-top: 1px solid var(--c-border);
}
.ltv-player__info { display: flex; align-items: center; gap: 11px; }
.ltv-live-label {
    display: flex; align-items: center; gap: 5px;
    background: var(--c-red-soft); border: 1px solid var(--c-red-border);
    color: var(--c-red); font-size: 10px; font-weight: 800;
    letter-spacing: .14em; padding: 3px 9px; border-radius: 5px; white-space: nowrap;
}
.ltv-live-label__dot {
    width: 6px; height: 6px; border-radius: 50%; background: var(--c-red);
    animation: ltv-pulse 1.4s ease-in-out infinite;
}
.ltv-player__title { font-size: 15px; font-weight: 700; color: var(--c-text); margin: 0; }
.ltv-player__viewers {
    display: flex; align-items: center; gap: 6px;
    font-size: 12px; font-weight: 500; color: var(--c-text-3);
}

/* ── DESCRIPTION ── */
.ltv-description {
    margin-top: 14px;
    padding: 16px 20px;
    background: var(--c-surface);
    border: 1px solid var(--c-border);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-sm);
}
.ltv-description p {
    font-size: 14px; line-height: 1.75;
    color: var(--c-text-2); margin: 0;
}

/* ── SIDEBAR ── */
.ltv-sidebar { display: flex; flex-direction: column; gap: 18px; }

/* ── CARD ── */
.ltv-card {
    background: var(--c-surface);
    border: 1px solid var(--c-border);
    border-radius: var(--radius-xl);
    padding: 22px;
    box-shadow: var(--shadow-sm);
}
.ltv-card__head { display: flex; align-items: flex-start; gap: 12px; margin-bottom: 18px; }
.ltv-card__icon {
    width: 38px; height: 38px; border-radius: var(--radius-md);
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.ltv-card__icon--blue   { background: var(--c-blue-soft);   color: var(--c-blue); }
.ltv-card__icon--orange { background: var(--c-orange-soft);  color: var(--c-orange); }
.ltv-card__title   { font-size: 15px; font-weight: 700; color: var(--c-text); margin: 0 0 2px; }
.ltv-card__subtitle{ font-size: 12px; color: var(--c-text-3); margin: 0; }

/* ── SHARE GRID ── */
.ltv-share-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 9px; }
.ltv-share-btn {
    display: flex; align-items: center; justify-content: center; gap: 7px;
    padding: 11px 12px; border: 1px solid var(--c-border);
    border-radius: var(--radius-md); background: var(--c-surface2);
    color: var(--c-text-2); font-size: 13px; font-weight: 600;
    font-family: var(--font-body); cursor: pointer; text-decoration: none;
    transition: all var(--trans);
}
.ltv-share-btn:hover { transform: translateY(-2px); box-shadow: var(--shadow-md); text-decoration: none; }
.ltv-share-btn--wa:hover  { background: #25D366; border-color: #25D366; color: #fff; }
.ltv-share-btn--fb:hover  { background: #1877F2; border-color: #1877F2; color: #fff; }
.ltv-share-btn--tw:hover  { background: #111;    border-color: #111;    color: #fff; }
.ltv-share-btn--copy:hover{ background: var(--c-blue); border-color: var(--c-blue); color: #fff; }

/* ── SCHEDULE ── */
.ltv-schedule { display: flex; flex-direction: column; }
.ltv-sched-item { display: flex; gap: 12px; align-items: stretch; }
.ltv-sched-time { width: 60px; flex-shrink: 0; display: flex; align-items: flex-start; padding-top: 3px; }
.ltv-sched-time__label { font-size: 11px; font-weight: 700; color: var(--c-text-3); white-space: nowrap; }
.ltv-sched-item--now .ltv-sched-time__label {
    color: var(--c-red); font-size: 10px; letter-spacing: .1em;
    background: var(--c-red-soft); padding: 2px 7px;
    border-radius: 20px; border: 1px solid var(--c-red-border);
}
.ltv-sched-track {
    display: flex; flex-direction: column; align-items: center;
    flex-shrink: 0; width: 16px;
}
.ltv-sched-track__dot {
    width: 10px; height: 10px; border-radius: 50%;
    border: 2px solid var(--c-border-dark); background: var(--c-surface);
    flex-shrink: 0; margin-top: 4px;
}
.ltv-sched-track__dot--live {
    border-color: var(--c-red); background: var(--c-red);
    box-shadow: 0 0 0 3px var(--c-red-soft);
}
.ltv-sched-track__line {
    flex: 1; width: 2px; background: var(--c-border);
    margin-top: 4px; min-height: 24px;
}
.ltv-sched-track__line--live { background: var(--c-red); }
.ltv-sched-info { padding-bottom: 20px; flex: 1; }
.ltv-sched-show { font-size: 14px; font-weight: 600; color: var(--c-text); margin: 0 0 3px; line-height: 1.4; }
.ltv-sched-item--now .ltv-sched-show { color: var(--c-red); }
.ltv-sched-tag  { font-size: 11px; color: var(--c-text-3); margin: 0; font-weight: 500; }

/* ── AD CARD ── */
.ltv-ad-card {
    background: var(--c-surface); border: 1px solid var(--c-border);
    border-radius: var(--radius-xl); overflow: hidden; box-shadow: var(--shadow-sm);
}
.ltv-ad-label {
    font-size: 10px; font-weight: 700; letter-spacing: .12em; text-transform: uppercase;
    color: var(--c-text-3); padding: 8px 16px; border-bottom: 1px solid var(--c-border);
    background: var(--c-surface2); margin: 0;
}
.ltv-ad-link { display: block; position: relative; overflow: hidden; }
.ltv-ad-img  { display: block; width: 100%; transition: transform .4s ease; }
.ltv-ad-link:hover .ltv-ad-img { transform: scale(1.04); }
.ltv-ad-cta {
    position: absolute; bottom: 12px; right: 12px;
    display: flex; align-items: center; gap: 5px;
    background: rgba(255,255,255,.9); backdrop-filter: blur(6px);
    color: var(--c-text); font-size: 11px; font-weight: 700;
    padding: 5px 12px; border-radius: 20px; box-shadow: var(--shadow-md);
    opacity: 0; transform: translateY(4px); transition: all var(--trans);
    font-family: var(--font-body);
}
.ltv-ad-link:hover .ltv-ad-cta { opacity: 1; transform: translateY(0); }

/* ── KEYFRAMES ── */
@keyframes ltv-pulse {
    0%,100% { opacity: 1; transform: scale(1); }
    50%     { opacity: .45; transform: scale(.7); }
}

/* ── RESPONSIVE ── */
@media (max-width: 1100px) {
    .ltv-grid { grid-template-columns: 1fr 310px; }
}
@media (max-width: 860px) {
    .ltv-grid { grid-template-columns: 1fr; gap: 22px; }
    .ltv-sidebar { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
    .ltv-ad-card { grid-column: 1 / -1; }
}
@media (max-width: 620px) {
    .ltv-container { padding: 0 16px; }
    .ltv-main { padding: 18px 0 48px; }
    .ltv-viewers { display: none; }
    .ltv-topbar__brand-name { font-size: 1.2rem; }
    .ltv-tabs { flex-direction: column; }
    .ltv-tab { width: 100%; }
    .ltv-player { border-radius: 0; margin: 0 -16px; border-left: none; border-right: none; }
    .ltv-sidebar { display: flex; flex-direction: column; }
    .ltv-share-grid { grid-template-columns: 1fr 1fr; }
    .ltv-card { padding: 18px; border-radius: var(--radius-lg); }
}
@media (max-width: 360px) {
    .ltv-share-grid { grid-template-columns: 1fr; }
}
</style>

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