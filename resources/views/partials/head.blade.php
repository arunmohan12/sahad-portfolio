
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>@yield('title', 'Sahad KP | Creative Professional in Dubai')</title>

<meta name="description" content="@yield('meta_description', 'Explore Sahad KP’s portfolio featuring graphic design, photography, videography, professional video editing and AI video creation in Dubai, UAE.')">

<meta name="robots" content="{{ app()->environment('production') ? 'index, follow, max-image-preview:large' : 'noindex, nofollow' }}">

<meta name="author" content="Sahad KP">
<meta name="theme-color" content="#111111">

<link rel="canonical" href="{{ url('/') }}">

<!-- Open Graph -->
<meta property="og:type" content="website">
<meta property="og:site_name" content="Sahad KP Portfolio">
<meta property="og:title" content="@yield('og_title', 'Sahad KP | Creative Portfolio')">
<meta property="og:description" content="@yield('og_description', 'Graphic design, photography, videography and AI video creation in Dubai, UAE.')">
<meta property="og:url" content="{{ url('/') }}">
<meta property="og:locale" content="en_AE">
<meta property="og:image" content="{{ asset('assets/images/og-image.jpg') }}">
<meta property="og:image:alt" content="Sahad KP creative portfolio">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="@yield('og_title', 'Sahad KP | Creative Portfolio')">
<meta name="twitter:description" content="@yield('og_description', 'Creative portfolio of Sahad KP, Dubai, UAE.')">
<meta name="twitter:image" content="{{ asset('assets/images/og-image.jpg') }}">

<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
@if (!empty($siteSetting?->hero_image))
    <link
        rel="preload"
        as="image"
        href="{{ Storage::disk('s3')->url($siteSetting->hero_image) }}"
        fetchpriority="high"
    >
@endif
@vite(['resources/css/app.css', 'resources/js/app.js'])

<!-- Person Structured Data -->

@php
    $personSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Person',
        'name' => 'Sahad KP',
        'url' => url('/'),
        'jobTitle' => [
            'Graphic Designer',
            'Photographer',
            'Videographer',
            'Video Editor',
            'AI Video Creator',
        ],
        'description' => 'Sahad KP is a creative professional based in Dubai, UAE, specialising in graphic design, photography, videography, professional video editing and AI-powered video creation.',
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => 'Dubai',
            'addressCountry' => 'AE',
        ],
        'knowsAbout' => [
            'Graphic Design',
            'Photography',
            'Videography',
            'Video Editing',
            'AI Video Generation',
            'AI-Assisted Video Production',
            'Visual Storytelling',
        ],
    ];
@endphp

<script type="application/ld+json">
    {!! json_encode($personSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

@php
    $websiteSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => 'Sahad KP Portfolio',
        'alternateName' => 'Sahad KP',
        'url' => url('/'),
        'inLanguage' => 'en',
    ];
@endphp

<script type="application/ld+json">
    {!! json_encode($websiteSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
