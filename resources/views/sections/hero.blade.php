<div class="pp-hero-area scene p-relative z-index-1 bg-position fix pp-hero-spacing"
    data-background="{{ $siteSetting?->hero_image
    ? \Illuminate\Support\Facades\Storage::disk('s3')->url($siteSetting->hero_image)
    : asset('assets/img/hero/pp/sahad_hero.jpg') }}">



    <div class="container">
        <div class="row align-items-end">

            <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-5">
                <div class="pp-hero-avatar pb-190">

                </div>

                <div class="pp-hero-video mb-30">

                </div>
            </div>

            <div class="col-xxl-2 col-xl-2 col-lg-5 col-md-5">
                <div class="ca-hero-service pp-hero-service mb-30 mr-80">
                    <ul>
                        <li><a href="javascript:void(0);"><span class="explore-text" data-text="Video Editing">Video Editing</span></a></li>
                        <li><a href="javascript:void(0);"><span class="explore-text" data-text="Color Grading">Color Grading</span></a></li>
                        <li><a href="javascript:void(0);"><span class="explore-text" data-text="Graphic Design">Graphic Design</span></a></li>
                        <li><a href="javascript:void(0);"><span class="explore-text" data-text="Real Estate Video Editing">Real Estate Video Editing</span></a></li>
                        <li><a href="javascript:void(0);"><span class="explore-text" data-text="AI Video Creation">AI Video Creation</span></a></li>
                        <li><a href="javascript:void(0);"><span class="explore-text" data-text="Social Media Content">Social Media Content</span></a></li>
                    </ul>
                </div>
            </div>

            <div class="col-xxl-5 col-xl-7 offset-xxl-3">
                <div class="pp-hero-content ml-55">


                    <span class="pp-hero-subtitle text-white mb-10 d-inline-block">
                        Creative Designer · Video Editor | Dubai, UAE
                    </span>

                    <h1 class="pp-hero-title text-white mb-50">
                        Creating Visual Stories Through
                        Design & Cinematic Motion.
                    </h1>


                    <div class="pp-hero-btn d-flex flex-wrap gap-2">

                        <a class="tp-btn text-black bg-white mb-10" href="#graphics-creatives">
                            <span>
                                <span class="text-1">Explore My Work</span>
                                <span class="text-2">Explore My Work</span>
                            </span>
                        </a>


                        <a class="tp-btn tp-btn-border-white text-white mb-10" href="https://wa.me/971547285569?text=Hello%20Sahad%2C%20I%20came%20across%20your%20portfolio%20and%20would%20like%20to%20discuss%20a%20project." target="_blank">
                            <span>
                                <span class="text-1">Let's Work Together</span>
                                <span class="text-2">Let's Work Together</span>
                            </span>
                        </a>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>