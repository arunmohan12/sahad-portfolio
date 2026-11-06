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