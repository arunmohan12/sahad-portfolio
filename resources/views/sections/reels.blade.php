@if($reels->isNotEmpty())

<div class="tp-breadcrumb-area about-us-spacing p-relative z-index-1 pb-50">
    <div class="tp-breadcrumb-bg">
        <img src="assets/img/breadcrumb/background.png" alt="">
    </div>

    <div class="container">
        <div class="tp-breadcrumb-border">
            <div class="row">
                <div class="col-lg-4">
                    <div class="tp-breadcrumb-list tp_fade_anim" data-delay=".3">
                        <ul>

                            <li>Short Videos </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="tp-breadcrumb-main p-relative mb-30">
                        <h2 class="tp-breadcrumb-title tp-ff-sequel-bold-head mb-20 tp_fade_anim"
                            data-delay=".4">
                            Short Videos & <span> AI</span><br>
                            Creations
                        </h2>

                        <div class="tp_fade_anim" data-delay=".5">
                            <p class="tp-breadcrumb-dec ml-240">
                                Creative short-form videos and AI-powered<br>
                                visuals crafted to capture attention,<br>
                                tell stories and bring ideas to life.
                            </p>
                        </div>

                        <span class="tp-breadcrumb-shape d-none d-md-block tp_fade_anim"
                            data-delay=".6">
                            <svg width="47" height="48" viewBox="0 0 47 48"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.7799 10.1272L42.666 36.3139V10.1272H16.7799Z" fill="#FF5722" />
                                <path d="M0.000141144 47.0136V0L47.0039 47.0136H0.000141144Z" fill="#111013" />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="tp-reels-area pt-100 pb-100" id="reels">
    <div class="container">
        <div class="tp-portfolio-inner-tab-wrap mb-50">
            <nav>
                <div class="nav nav-tabs" id="reel-category-tabs" role="tablist">

                    <button class="nav-link active"
                        type="button"
                        data-reel-filter="all">
                        All
                    </button>

                    <button class="nav-link"
                        type="button"
                        data-reel-filter="real-estate-videos">
                        Real Estate
                    </button>
                    <button class="nav-link"
                        type="button"
                        data-reel-filter="events">
                        Events
                    </button>
                    <button class="nav-link"
                        type="button"
                        data-reel-filter="ai-videos">
                        AI Videos
                    </button>

                </div>
            </nav>
        </div>
        <div class="row g-4">

            @foreach($reels as $reel)
            <div class="col-6 col-lg-4 reel-filter-item"
                data-reel-category="{{ $reel->project_type }}">
                <div class="tp-reel-card">

                    <button
                        type="button"
                        class="tp-reel-preview"
                        data-reel-url="{{ Storage::disk('s3')->url($reel->media_path) }}"
                        data-reel-title="{{ $reel->title }}"
                        aria-label="Play {{ $reel->title }}">
                        <video
                            class="tp-reel-inline-video"
                            muted
                            playsinline
                            loop
                            preload="none"
                            poster="{{ Storage::disk('s3')->url($reel->thumbnail_path) }}"
                            data-src="{{ Storage::disk('s3')->url($reel->media_path) }}">
                        </video>

                        <span class="tp-reel-play">
                            <i class="fa-solid fa-play"></i>
                        </span>
                    </button>

                    <div class="tp-reel-info mt-15">
                        <h4>{{ $reel->title }}</h4>
                        <span>{{ ucwords(str_replace('-', ' ', $reel->project_type)) }}</span>
                    </div>

                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>

{{-- Reel Video Popup --}}
<div class="tp-reel-modal" id="tpReelModal" aria-hidden="true">
    <button
        type="button"
        class="tp-reel-nav tp-reel-prev"
        id="tpReelPrev"
        aria-label="Previous video">
        <i class="fa-solid fa-chevron-left"></i>
    </button>

    <button
        type="button"
        class="tp-reel-nav tp-reel-next"
        id="tpReelNext"
        aria-label="Next video">
        <i class="fa-solid fa-chevron-right"></i>
    </button>
    <div class="tp-reel-modal-content">

        <button
            type="button"
            class="tp-reel-modal-close"
            id="tpReelModalClose"
            aria-label="Close video">
            &times;
        </button>

        <video
            id="tpReelPlayer"
            controls
            playsinline
            preload="none">
        </video>

        <h4 id="tpReelModalTitle"></h4>

    </div>
</div>
@endif