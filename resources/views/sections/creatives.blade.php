
<div class="tp-breadcrumb-area about-us-spacing pb-40" id="graphics-creatives">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="tp-tp-breadcrumb-main text-center">
                    <span class="tp-breadcrumb-subtitle text-uppercase fw-600 mb-10 tp_fade_anim" data-delay=".3">
                        CREATIVE SHOWCASE
                    </span>
                    <h2 class="tp-breadcrumb-title tp-ff-sequel-bold-head text-uppercase tp_fade_anim" data-delay=".5">
                        Creating <br /> What You Imagine
                    </h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="tp-portfolio-inner-ptb tp-animate-tab pb-90">
    <div class="container">
        <div class="tp-portfolio-tab-content-wrap">

            <div class="tp-portfolio-inner-tab-wrap mb-55 tp_fade_anim" data-delay=".7">
                <nav>
                    <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">

                        <button
                            class="nav-link active"
                            id="nav-profile-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#nav-profile"
                            type="button"
                            role="tab"
                            aria-controls="nav-profile"
                            aria-selected="true">
                            Creatives
                        </button>

                        <button
                            class="nav-link"
                            id="nav-contact-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#nav-contact"
                            type="button"
                            role="tab"
                            aria-controls="nav-contact"
                            aria-selected="false">
                            Realestate
                        </button>

                    </div>
                </nav>
            </div>

            <div class="tab-content p-relative" id="nav-tabContent">

                {{-- Creatives --}}
                <div
                    class="tab-pane show active"
                    id="nav-profile"
                    role="tabpanel"
                    aria-labelledby="nav-profile-tab"
                    tabindex="0">

                    <div class="row gx-60">

                        @forelse ($projects->where('category.slug', 'creatives') as $project)

                            <div class="col-lg-6">
                                <div class="mg-portfolio-item anim-zoomin-wrap mb-55">

                                    <div class="mg-portfolio-thumb anim-zoomin not-hide-cursor"
                                         data-cursor="View<br>Demo">

                                        <a class="cursor-hide portfolio-image-popup"
                                           href="{{ Storage::disk('s3')->url($project->media_path) }}"
                                           title="{{ $project->title }}">

                                            <img
                                                class="w-100"
                                                src="{{ Storage::disk('s3')->url($project->thumbnail_path ?: $project->media_path) }}"
                                                alt="{{ $project->thumbnail_alt ?: $project->title }}"
                                                loading="lazy">
                                        </a>
                                    </div>

                                    <div class="mg-portfolio-content cs-portfolio-content d-flex align-items-center flex-wrap justify-content-between">

                                        <h3 class="cs-portfolio-title tp-title-anim fix mr-20 tp-ff-sequel-semi-bold">
                                            <span class="tp-title-text">{{ $project->title }}</span>
                                        </h3>

                                        <div class="cs-portfolio-tag">
                                            <ul>
                                                <li>
                                                    <a href="#">{{ $project->project_type }}</a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        @empty

                            <div class="col-12 text-center">
                                <p>No creative projects available yet.</p>
                            </div>

                        @endforelse

                    </div>
                </div>

                {{-- Realestate --}}
                <div
                    class="tab-pane"
                    id="nav-contact"
                    role="tabpanel"
                    aria-labelledby="nav-contact-tab"
                    tabindex="0">

                    <div class="row gx-60">

                        @forelse ($projects->where('category.slug', 'realestate') as $project)

                            <div class="col-lg-6">
                                <div class="mg-portfolio-item anim-zoomin-wrap mb-55">

                                    <div class="mg-portfolio-thumb anim-zoomin not-hide-cursor"
                                         data-cursor="View<br>Demo">

                                        <a class="cursor-hide portfolio-image-popup"
                                           href="{{ Storage::disk('s3')->url($project->media_path) }}"
                                           title="{{ $project->title }}">

                                            <img
                                                class="w-100"
                                                src="{{ Storage::disk('s3')->url($project->thumbnail_path ?: $project->media_path) }}"
                                                alt="{{ $project->thumbnail_alt ?: $project->title }}"
                                                loading="lazy">
                                        </a>
                                    </div>

                                    <div class="mg-portfolio-content cs-portfolio-content d-flex align-items-center flex-wrap justify-content-between">

                                        <h3 class="cs-portfolio-title tp-title-anim fix mr-20 tp-ff-sequel-semi-bold">
                                            <span class="tp-title-text">{{ $project->title }}</span>
                                        </h3>

                                        <div class="cs-portfolio-tag">
                                            <ul>
                                                <li>
                                                    <a href="#">{{ $project->project_type }}</a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        @empty

                            <div class="col-12 text-center">
                                <p>No real estate projects available yet.</p>
                            </div>

                        @endforelse

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
