<header>
    <div class="tp-header-area tp-header-spacing header-transparent">
        <div class="container">

            {{-- Header top --}}
            <div class="pp-header-top">
                <div class="row">
                    <div class="col-lg-5 col-sm-6 col-12">
                        <div class="pp-header-top-wrap mb-10">
                            <h2 class="pp-header-top-content tp-ff-sequel-semi-bold text-white tp-char-animation">
                                <a href="{{ route('home') }}">Sahad </a>
                            </h2>
                        </div>
                    </div>

                    <div class="col-lg-5 col-sm-6 col-12">
                        <div class="pp-header-top-logo-wrap d-flex align-items-start justify-content-sm-end justify-content-sm-start ml-55 mb-10">
                            <h2 class="pp-header-top-content tp-ff-sequel-semi-bold text-white tp-char-animation">
                                KP
                            </h2>

                            <button class="pp-header-hamburger hamburger-open-btn mt-20 ml-40" type="button" aria-label="Open menu">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 6H0M6 12L6 0" stroke="currentColor"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Main navigation --}}
            <div class="pp-header-main mt-15 mb-20">
                <div class="row align-items-center">

                    <div class="col-xxl-4 col-xl-4 d-none d-xl-block">
                        <div class="pp-main-menu mb-20">

                            {{-- Desktop menu --}}
                            <nav>
                                <ul>
                                    <li><a href="#home">Home</a></li>
                                    <li><a href="#about">About</a></li>
                                    <li><a href="#services">Services</a></li>
                                    <li><a href="#portfolio">Portfolio</a></li>
                                    <li><a href="#contact">Contact</a></li>
                                </ul>
                            </nav>

                            {{-- Mobile menu source --}}
                            <div class="tp-main-menu d-none">
                                <nav class="tp-mobile-menu-active">
                                    <ul>
                                        <li><a href="#home">Home</a></li>
                                        <li><a href="#about">About</a></li>
                                        <li><a href="#services">Services</a></li>
                                        <li><a href="#portfolio">Portfolio</a></li>
                                        <li><a href="#contact">Contact</a></li>
                                    </ul>
                                </nav>
                            </div>

                        </div>
                    </div>

                    {{-- Project enquiry button --}}
                    <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-4 offset-xxl-1">
                        <div class="pp-header-btn ml-60 mb-20">
                            <a class="tp-btn pp-btn-nobg text-uppercase" href="#contact">
                                <span>
                                    
                                </span>
                                <i>
                                    <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.75 9.9375L9.9375 0.75M3.1875 0.75H9.9375V7.5"
                                              stroke="currentColor"
                                              stroke-width="1.5"
                                              stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                    </svg>
                                </i>
                            </a>
                        </div>
                    </div>

                    {{-- Social links --}}
                    <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8">
                        <div class="pp-header-social mb-20">
                            <a class="tp-btn tp-btn-white text-uppercase"
                               href="#contact">
                                <span>
                                    <span class="text-1">Let's Connect</span>
                                    <span class="text-2">Let's Connect</span>
                                </span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</header>