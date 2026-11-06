<div class="tp-skill-area pt-145" id="familiar-tools">
    <div class="container">
        <div class="row">
            @foreach ($skills as $index => $skill)
                <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6">
                    <div class="tp-skill-item d-flex flex-column mb-25 align-items-center tp_fade_anim"
                         data-delay=".{{ min($index + 3, 9) }}">

                        @if ($skill->icon_path)
                            <div class="tp-skill-icon mb-20">
                                <img
                                    src="{{ Storage::disk('s3')->url($skill->icon_path) }}"
                                    alt="{{ $skill->name }}"
                                    loading="lazy">
                            </div>
                        @endif

                        <span class="tp-skill-text">{{ $skill->name }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>