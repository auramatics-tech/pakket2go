<header id="main_navbar" class="primary-bg">
    <nav class="navbar navbar-expand-lg">
        <div class="container d-flex align-items-center">
            <a class="navbar-brand" href="{{ route('home') }}">
                <figure>
                    <img src="{{ asset('assets/svg/Pakket2go.svg') }}" alt="logo">
                </figure>
            </a>
            <div class="d-flex align-items-center">
                <div class="d-none align-content-center justify-content-center lang_toggle ms-3 d-lg-none d-md-flex me-3">   
                    @include('web.layouts.language')
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#menu_items" aria-controls="menu_items"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="menu_items">
                <ul class="navbar-nav mb-2 mb-lg-0 ms-auto me-0">
                    <li class="nav-item @if(Route::is('home')) active @endif px-3">
                        <a class="nav-link text-white py-1" aria-current="page" href="{{ route('home') }}">{{ __('home.Home') }}</a>
                        <div class="active_dot mx-auto"></div>
                    </li>
                    <li class="nav-item @if(Route::is('howitworks')){{'active'}}@endif px-3">
                        <a class="nav-link  text-white py-1" href="{{ route('howitworks') }}">{{ __('home.How it Works') }}</a>
                        <div class="active_dot mx-auto"></div>
                    </li>
                    <li class="nav-item  @if(Route::is('become_courier')) active @endif px-3">
                        <a class="nav-link text-white py-1" href="{{ route('become_courier') }}">{{ __('home.Become Courier') }}</a>
                        <div class="active_dot mx-auto"></div>
                    </li>
                    <li class="nav-item @if(Route::is('contact_us')) active @endif px-3">
                        <a class="nav-link text-white py-1" href="{{ route('contact_us') }}">{{ __('home.Contact Us') }}</a>
                        <div class="active_dot mx-auto"></div>
                    </li>
                    <li class="nav-item px-3">
                        @if(!Auth::check())
                            <a class="nav-link text-white py-1" href="{{ route('login') }}">{{ __('home.Login') }}</a>
                        @else
                            <a class="nav-link text-white py-1" href="{{ route('dashboard') }}">Welkom {{ Auth::user()->first_name.' '.Auth::user()->last_name }}</a>
                        @endif
                    </li>
                </ul>
                <div class="align-content-center justify-content-center lang_toggle ms-3 d-md-none d-flex d-lg-flex">
                    @include('web.layouts.language')
                </div>
            </div>
        </div>
    </nav>
</header>