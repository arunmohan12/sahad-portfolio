// ========================================
// YouTube Playlist
// ========================================

document.addEventListener('DOMContentLoaded', function () {

    const playlistItems = document.querySelectorAll('.pp-youtube-item');

    const playerWrapper = document.getElementById('youtube-player-wrapper');

    const mainTitle = document.getElementById('youtube-main-title');
    const mainDescription = document.getElementById('youtube-main-description');

    const mainChannel = document.getElementById('youtube-main-channel');
    const mainViews = document.getElementById('youtube-main-views');
    const mainLikes = document.getElementById('youtube-main-likes');

    if (!playlistItems.length || !playerWrapper) {
        return;
    }

    let selectedVideo = playlistItems[0];

    function formatNumber(value) {
        return new Intl.NumberFormat().format(Number(value) || 0);
    }

    // Create and display the video thumbnail preview
    function showPreview(video) {

        const thumbnail = document.createElement('img');
        thumbnail.src = video.dataset.thumbnail;
        thumbnail.alt = video.dataset.title;
        thumbnail.className = 'pp-youtube-main-thumbnail';
        thumbnail.id = 'youtube-main-thumbnail';

        const playButton = document.createElement('button');
        playButton.type = 'button';
        playButton.className = 'pp-youtube-preview-play';
        playButton.id = 'youtube-preview-play';
        playButton.setAttribute('aria-label', 'Play video');
        playButton.innerHTML = '<i class="fa-brands fa-youtube"></i>';

        playerWrapper.replaceChildren(thumbnail, playButton);
    }

    // Update channel information
    function updateChannel(video) {

        mainChannel.replaceChildren();

        const channelThumbnail = video.dataset.channelThumbnail;
        const channelName = video.dataset.channel || '';

        if (channelThumbnail) {
            const image = document.createElement('img');

            image.src = channelThumbnail;
            image.alt = channelName;

            mainChannel.appendChild(image);
        }

        const name = document.createElement('span');
        name.textContent = channelName;

        mainChannel.appendChild(name);
    }

    // Update views
    function updateViews(video) {

        const icon = document.createElement('i');
        icon.className = 'fa-solid fa-eye';

        const text = document.createElement('span');
        text.textContent = `${formatNumber(video.dataset.views)} views`;

        mainViews.replaceChildren(icon, text);
    }

    // Update likes
    function updateLikes(video) {

        const icon = document.createElement('i');
        icon.className = 'fa-solid fa-thumbs-up';

        const text = document.createElement('span');

        text.textContent = video.dataset.likes
            ? `${formatNumber(video.dataset.likes)} likes`
            : 'Likes unavailable';

        mainLikes.replaceChildren(icon, text);
    }

    // Select a playlist video
    function selectVideo(video) {

        selectedVideo = video;

        mainTitle.textContent = video.dataset.title;
        mainDescription.textContent = video.dataset.description;

        updateChannel(video);
        updateViews(video);
        updateLikes(video);

        // Show the selected video's thumbnail
        showPreview(video);

        // Update active playlist item
        playlistItems.forEach(function (item) {
            item.classList.remove('active');
        });

        video.classList.add('active');
    }

    // Load the selected video in the YouTube player
    function playSelectedVideo() {

        if (!selectedVideo) {
            return;
        }

        const iframe = document.createElement('iframe');

        iframe.src =
            `https://www.youtube-nocookie.com/embed/${encodeURIComponent(selectedVideo.dataset.videoId)}?autoplay=1&rel=0`;

        iframe.title = selectedVideo.dataset.title;

        iframe.allow =
            'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';

        iframe.allowFullscreen = true;

        iframe.referrerPolicy = 'strict-origin-when-cross-origin';

        playerWrapper.replaceChildren(iframe);
    }

    // Playlist click
    playlistItems.forEach(function (item) {

        item.addEventListener('click', function () {
            selectVideo(this);
        });

    });

    // Main player play button (event delegation)
    playerWrapper.addEventListener('click', function (event) {

        if (event.target.closest('#youtube-preview-play')) {
            playSelectedVideo();
        }

    });

});


// ========================================
// Smooth Anchor Scrolling - GSAP
// ========================================

document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('a[href^="#"]').forEach(function (link) {

        link.addEventListener('click', function (event) {

            const targetId = link.getAttribute('href');

            if (!targetId || targetId === '#') {
                return;
            }

            const target = document.querySelector(targetId);

            if (!target) {
                return;
            }

            event.preventDefault();

            // Use GSAP ScrollSmoother if initialized
            if (typeof ScrollSmoother !== 'undefined') {

                const smoother = ScrollSmoother.get();

                if (smoother) {
                    smoother.scrollTo(target, true, 'top top');
                    return;
                }
            }

            // Fallback
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });

        });

    });

});




(() => {
    const modal = document.getElementById('tpReelModal');
    const player = document.getElementById('tpReelPlayer');
    const modalTitle = document.getElementById('tpReelModalTitle');
    const closeButton = document.getElementById('tpReelModalClose');
    const prevButton = document.getElementById('tpReelPrev');
    const nextButton = document.getElementById('tpReelNext');

    if (!modal || !player || !closeButton) return;

    // Keep popup outside GSAP ScrollSmoother containers
    document.body.appendChild(modal);

    const reelButtons = Array.from(
        document.querySelectorAll('.tp-reel-preview')
    );

    const inlineVideos = Array.from(
        document.querySelectorAll('.tp-reel-inline-video')
    );

    let currentReelIndex = -1;

    // Pause all inline videos
    const pauseInlineVideos = () => {
        inlineVideos.forEach(video => video.pause());
    };

    // Load and play an inline video
    const playInlineVideo = (video) => {
        if (!video.src && video.dataset.src) {
            video.src = video.dataset.src;
            video.load();
        }

        video.play().catch(() => {
            // Browser may prevent autoplay.
        });
    };

    // Autoplay videos when visible
    const reelObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            const video = entry.target;

            if (modal.classList.contains('is-active')) {
                video.pause();
                return;
            }

            if (entry.isIntersecting && entry.intersectionRatio >= 0.5) {
                playInlineVideo(video);
            } else {
                video.pause();
            }
        });
    }, {
        threshold: [0, 0.5]
    });

    inlineVideos.forEach(video => {
        reelObserver.observe(video);

        video.addEventListener('playing', () => {
            video.closest('.tp-reel-preview')?.classList.add('is-playing');
        });

        video.addEventListener('pause', () => {
            video.closest('.tp-reel-preview')?.classList.remove('is-playing');
        });
    });

    // Open popup and play selected reel
    const playReel = (index) => {
        if (index < 0 || index >= reelButtons.length) return;

        currentReelIndex = index;

        const button = reelButtons[index];

        pauseInlineVideos();

        player.pause();
        player.src = button.dataset.reelUrl;
        player.load();



        modal.classList.add('is-active');
        modal.setAttribute('aria-hidden', 'false');

        document.body.style.overflow = 'hidden';

        player.play().catch(() => {
            // User can start playback using video controls.
        });
    };

    // Close popup
    const closeReel = () => {
        player.pause();
        player.removeAttribute('src');
        player.load();

        modal.classList.remove('is-active');
        modal.setAttribute('aria-hidden', 'true');

        document.body.style.overflow = '';

        currentReelIndex = -1;

        // Resume visible inline videos
        inlineVideos.forEach(video => {
            const rect = video.getBoundingClientRect();

            const visible =
                rect.bottom > 0 &&
                rect.top < window.innerHeight &&
                rect.right > 0 &&
                rect.left < window.innerWidth;

            if (visible) {
                playInlineVideo(video);
            }
        });
    };

    // Next reel
    const showNext = () => {
        if (reelButtons.length <= 1) return;

        playReel((currentReelIndex + 1) % reelButtons.length);
    };

    // Previous reel
    const showPrevious = () => {
        if (reelButtons.length <= 1) return;

        playReel(
            (currentReelIndex - 1 + reelButtons.length) % reelButtons.length
        );
    };

    // Reel thumbnail click
    reelButtons.forEach((button, index) => {
        button.addEventListener('click', () => playReel(index));
    });

    prevButton?.addEventListener('click', showPrevious);
    nextButton?.addEventListener('click', showNext);

    closeButton.addEventListener('click', closeReel);

    // Click outside popup to close
    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            closeReel();
        }
    });

    // Keyboard controls
    document.addEventListener('keydown', (event) => {
        if (!modal.classList.contains('is-active')) return;

        if (event.key === 'Escape') closeReel();
        if (event.key === 'ArrowRight') showNext();
        if (event.key === 'ArrowLeft') showPrevious();
    });
})();



(() => {
    const tabs = document.querySelectorAll('[data-reel-filter]');
    const items = document.querySelectorAll('.reel-filter-item');

    if (!tabs.length || !items.length) return;

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const selectedCategory = tab.dataset.reelFilter;

            tabs.forEach(item => item.classList.remove('active'));
            tab.classList.add('active');

            items.forEach(item => {
                const category = item.dataset.reelCategory;

                const shouldShow =
                    selectedCategory === 'all' ||
                    category === selectedCategory;

                item.style.display = shouldShow ? '' : 'none';
            });
        });
    });
})();