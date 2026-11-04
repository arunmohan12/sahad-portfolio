{{-- Preloader --}}
<div id="preloader">
    <div class="preloader">
        <span></span>
        <span></span>
    </div>
</div>

{{-- Magic Cursor --}}
<div id="magic-cursor" class="cursor-black-bg">
    <div id="ball"></div>
</div>

{{-- Back to Top --}}
<div class="back-to-top-wrapper">
    <button id="back_to_top" type="button" class="back-to-top-btn">
        <svg width="12" height="7" viewBox="0 0 12 7"
             fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M11 6L6 1L1 6"
                  stroke="currentColor"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"/>
        </svg>
    </button>
</div>

{{-- Offcanvas Menu --}}
<div class="tp-offcanvas-2-area p-relative">
    <div class="offcanvas-bg"></div>

    <div class="tp-offcanvas-2-wrapper offcanvas-menu">
        <div class="tp-offcanvas-2-left">

            <div class="tp-header-logo d-flex justify-content-between align-items-center mb-50">
                <a href="{{ route('home') }}">
                    <img class="logo-1"
                         data-width="170"
                         src="{{ asset('assets/img/logo/logo.png') }}"
                         alt="Sahad KP">

                    <img class="logo-2"
                         data-width="170"
                         src="{{ asset('assets/img/logo/logo-white.png') }}"
                         alt="Sahad KP">
                </a>

                <span class="hamburger-close-btn">
                    <svg width="37" height="38" viewBox="0 0 37 38"
                         fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.19141 9.80762L27.5762 28.1924"
                              stroke="currentColor"
                              stroke-width="1.5"
                              stroke-linecap="round"
                              stroke-linejoin="round"/>
                        <path d="M9.19141 28.1924L27.5762 9.80761"
                              stroke="currentColor"
                              stroke-width="1.5"
                              stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                </span>
            </div>

            <div class="tp-offcanvas-menu counter-row">
                <nav></nav>
            </div>

            <span class="hamburger-close-btn hamburger-mobile-close-btn d-md-none">
                CLOSE
            </span>

        </div>
    </div>
</div>