@if (!empty($videos))
@php
$firstVideo = $videos[0];
@endphp

<section class="pp-youtube-area pt-120 pb-60" id="cinematic-videos">
    <div class="container">

        {{-- Section heading --}}
        <div class="row mb-50">
            <div class="col-12">
                <div class="pp-youtube-heading">
                    <span class="pp-youtube-subtitle">VIDEO SHOWCASE</span>

                    <h2>Watch My Latest Videos</h2>

                    <p>
                        Explore my latest videos, creative projects and visual stories.
                    </p>
                </div>
            </div>
        </div>

        <div class="row">

            {{-- Main video --}}
            <div class="col-lg-8">
                <div class="pp-youtube-main">

                    {{-- Video preview / player --}}
                    <div class="pp-youtube-player" id="youtube-player-wrapper">

                        <img
                            id="youtube-main-thumbnail"
                            src="{{ $firstVideo['thumbnail'] }}"
                            alt="{{ $firstVideo['title'] }}"
                            class="pp-youtube-main-thumbnail">

                        <button
                            type="button"
                            class="pp-youtube-preview-play"
                            id="youtube-preview-play"
                            aria-label="Play video">
                            <i class="fa-brands fa-youtube"></i>
                        </button>

                    </div>

                    {{-- Video information --}}
                    <div class="pp-youtube-main-info">

                        <h3 id="youtube-main-title">
                            {{ $firstVideo['title'] }}
                        </h3>

                        {{-- Channel, views and likes --}}
                        <div class="pp-youtube-meta">

                            <div class="pp-youtube-channel" id="youtube-main-channel">

                                @if (!empty($firstVideo['channel_thumbnail']))
                                <img
                                    src="{{ $firstVideo['channel_thumbnail'] }}"
                                    alt="{{ $firstVideo['channel_name'] }}"
                                    id="youtube-channel-image">
                                @endif

                                <span id="youtube-channel-name">
                                    {{ $firstVideo['channel_name'] }}
                                </span>

                            </div>

                            <div class="pp-youtube-stat" id="youtube-main-views">
                                <i class="fa-solid fa-eye"></i>
                                <span>
                                    {{ number_format($firstVideo['views']) }} views
                                </span>
                            </div>

                            <div class="pp-youtube-stat" id="youtube-main-likes">
                                <i class="fa-solid fa-thumbs-up"></i>
                                <span>
                                    {{ $firstVideo['likes'] !== null
                                            ? number_format($firstVideo['likes']) . ' likes'
                                            : 'Likes unavailable' }}
                                </span>
                            </div>

                        </div>

                        {{-- Description --}}
                        <p id="youtube-main-description">
                            {{ Str::limit($firstVideo['description'], 250) }}
                        </p>

                    </div>

                </div>
            </div>

            {{-- Playlist sidebar --}}
            <div class="col-lg-4">

                <div class="pp-youtube-playlist">

                    <div class="pp-youtube-playlist-heading">
                        <h4>More Videos</h4>
                        <span>{{ count($videos) }} Videos</span>
                    </div>

                    <div class="pp-youtube-list">

                        @foreach ($videos as $index => $video)

                        <button
                            type="button"
                            class="pp-youtube-item {{ $index === 0 ? 'active' : '' }}"

                            data-video-id="{{ $video['video_id'] }}"
                            data-title="{{ $video['title'] }}"
                            data-description="{{ Str::limit($video['description'], 250) }}"
                            data-thumbnail="{{ $video['thumbnail'] }}"
                            data-channel="{{ $video['channel_name'] }}"
                            data-channel-thumbnail="{{ $video['channel_thumbnail'] ?? '' }}"
                            data-views="{{ $video['views'] }}"
                            data-likes="{{ $video['likes'] ?? '' }}"
                            aria-label="Select {{ $video['title'] }}">

                            <div class="pp-youtube-thumb">

                                <img
                                    src="{{ $video['thumbnail'] }}"
                                    alt="{{ $video['title'] }}"
                                    loading="lazy">

                                <span class="pp-youtube-play-icon">
                                    <i class="fa-brands fa-youtube"></i>
                                </span>

                            </div>

                            <div class="pp-youtube-item-content">

                                <h5>{{ $video['title'] }}</h5>

                                <div class="pp-youtube-item-channel">

    @if (!empty($video['channel_thumbnail']))
        <img
            src="{{ $video['channel_thumbnail'] }}"
            alt="{{ $video['channel_name'] }}"
            loading="lazy"
        >
    @endif

    <span>{{ $video['channel_name'] }}</span>

</div>

                                <div class="pp-youtube-item-stats">

                                    <span>
                                        <i class="fa-solid fa-eye"></i>
                                        {{ number_format($video['views']) }}
                                    </span>

                                    <span>
                                        <i class="fa-solid fa-thumbs-up"></i>
                                        {{ $video['likes'] !== null
                ? number_format($video['likes'])
                : 'N/A' }}
                                    </span>

                                </div>

                            </div>

                        </button>

                        @endforeach

                    </div>

                </div>

            </div>

        </div>
    </div>
</section>
@endif