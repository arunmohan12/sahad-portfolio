@extends('layouts.app')

@section('title', 'Sahad KP | Graphic Designer, Photographer & AI Video Creator in Dubai')
@section('meta_description', 'Explore Sahad KP’s creative portfolio featuring graphic design, photography, videography, professional video editing and AI-powered video creation in Dubai, UAE.')
@section('content')

<div id="smooth-wrapper">
    <div id="smooth-content">

        @include('sections.hero')
        @include('sections.about')

        @include('sections.what-i-do')
        @include('sections.skills')
        @include('sections.youtube-playlist')
        @include('sections.reels')
        @include('sections.experience')
        @include('sections.creatives')
        @include('sections.footer')

    </div>
</div>

@endsection