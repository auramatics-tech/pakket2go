<header id="main_navbar" class="primary-bg">
    <nav class="navbar navbar-expand-lg">
        <div class="container d-flex align-items-center">
            <div class="d-flex align-items-center">

                <a
                    @if ($current_step->id > 1) href="{{ route('booking', ['step' => $previous_step->url_code, 'locale' => App::getLocale()]) }}" @else href="{{ route('home') }}" @endif>
                    <i class="fa-solid fa-angle-left text-white"></i>
                </a>
                <div class="d-flex align-items-center ms-3">
                    <div class="nav_circle mx-3">
                        <span>{{ $current_step->order }}</span>
                    </div>
                    <h6 class="text-white mb-0 top_heading">{{ __("booking.$current_step->name") }}</h6>
                </div>
            </div>
            <a class="navbar-brand logo_cls" href="#">
                <figure>
                    <img src="{{ asset('assets/svg/Pakket2go.svg') }}" alt="logo">
                </figure>
            </a>
            <div class="d-flex align-content-center justify-content-center lang_toggle">
                @include('web.layouts.language')
            </div>
        </div>
    </nav>
</header>
