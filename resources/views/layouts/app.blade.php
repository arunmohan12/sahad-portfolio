
<!DOCTYPE html>
<html class="no-js cunnet-dark" lang="en">
<head>
    @include('partials.head')
</head>

<body>

<body class="tp-magic-cursor">

    <a href="#main-content" class="skip-link">Skip to main content</a>

    @include('partials.global-ui')

    @include('partials.header')

    <main id="main-content">
        @yield('content')
    </main>

    @include('partials.footer')



   <!-- Cunnet Template JavaScript -->
<script src="{{ asset('assets/js/vendor/jquery.js') }}"></script>
<script src="{{ asset('assets/js/plugin.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('assets/js/split-type.js') }}"></script>
<script src="{{ asset('assets/js/three.js') }}"></script>
<script src="{{ asset('assets/js/hover-effect.umd.js') }}"></script>

<script src="{{ asset('assets/js/swiper-bundle.js') }}"></script>
<script src="{{ asset('assets/js/magnific-popup.js') }}"></script>
<script src="{{ asset('assets/js/nice-select.js') }}"></script>
<script src="{{ asset('assets/js/purecounter.js') }}"></script>
<script src="{{ asset('assets/js/parallax.js') }}"></script>
<script src="{{ asset('assets/js/ajax-form.js') }}"></script>

<script src="{{ asset('assets/js/slider-init.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/tp-cursor.js') }}"></script> 
</body>
</html>
