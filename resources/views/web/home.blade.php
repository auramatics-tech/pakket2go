@extends('web.layouts.master')

@section('title')
Pakket2Go
@endsection
@section('style')

@endsection

@section('content')
<section class="become_banner_section">
    <div class="su_main_top_bg">
        <div class="container content text-center">
            <h1>{{ __('home.Your Best Choice in Netherland') }}</h1>
            <p>{{ __('home.The easilest and most affordable way to transport any parcel regarding size') }}</p>
        </div>
    </div>
    <div class="images">
        <img src="{{ asset('assets/img/cloud.png') }}" class="img-fluid" alt="cloud">
        <img src="{{ asset('assets/img/building.png') }}" class="img-fluid d-none d-lg-block d-md-block" alt="building">
        <div class="mobile_build d-block d-lg-none d-md-none"></div>
        <figure class="truck_img">
            <img src="{{ asset('assets/img/truck.png') }}" alt="">
        </figure>
    </div>
    </div>
</section>
<section class="info_section_top">
    <div class="container bg-white info text-center">
        @include('web.includes.booking')
    </div>
</section>
<section class="step_section">
    <div class="container text-center">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 d-flex d-md-flex d-lg-flex align-items-start py-3 py-lg-5">
                <div class="data_icon">
                    <figure>
                        <img src="{{ asset('assets/svg/truck.svg') }}" alt="">
                    </figure>
                </div>
                <div class="data_list">
                    <h2>{{ __('home.Quick & Fast') }}</h2>
                    <span>{{ __('home.Value the time of clients') }}</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 d-flex d-md-flex d-lg-flex align-items-start py-3 py-lg-5">
                <div class="data_icon">
                    <figure>
                        <img src="{{ asset('assets/svg/dl_secure.svg') }}" alt="">
                    </figure>
                </div>
                <div class="data_list">
                    <h2>{{ __('home.Secure') }}</h2>
                    <span>{{ __('home.Provide 100% security') }}</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 d-flex d-md-flex d-lg-flex align-items-start py-3 py-lg-5">
                <div class="data_icon">
                    <figure>
                        <img src="{{ asset('assets/svg/free.svg') }}" alt="">
                    </figure>
                </div>
                <div class="data_list">
                    <h2>{{ __('home.Hassle Free') }}</h2>
                    <span>{{ __('home.Quick, easy and reliable') }}</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 d-flex d-md-flex d-lg-flex align-items-start py-3 py-lg-5">
                <div class="data_icon">
                    <figure>
                        <img src="{{ asset('assets/svg/support.svg') }}" alt="">
                    </figure>
                </div>
                <div class="data_list">
                    <h2>{{ __('home.24/7 Support') }}</h2>
                    <span>{{ __('home.Easy communication') }}</span>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="about_section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12">
                <figure class="about_img">
                    <img src="{{ asset('assets/img/parsalboy.png') }}" alt="">
                </figure>
            </div>
            <div class="col-lg-6 col-md-12 ps-lg-5 text-center text-md-center text-lg-start mt-md-5">
                <button class="about_btn">{{ __('home.About Us') }}</button>
                <div class="py-4">
                    <h2>{{ __('home.Who Are We?') }}</h2>
                    <p>{{ __('home.who_we_are') }}</p>
                </div>
                <div>
                    <a href="{{ route('booking', ['step' => 'address']) }}" class="book border rounded-3">{{ __('home.Book a Transport') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="our_values_section">
    <div class="container text-center">
        <h2 class="mb-3">{{ __('home.Our Core Values') }}</h2>
        <p class="text-center width-lg mx-auto">{{ __('home.core_values_desc') }}</p>
        <div class="text-center">
            <img src="{{ asset('assets/img/line.png') }}" alt="" class="img-fluid">
        </div>
        <div class="container text-center text-light mt-5">
            <div class="row justify-content-md-center">
                <div class="col-lg-4 col-md-6 mb-lg-0 mb-4">
                    <h6>{{ __('home.Trustfulness') }}</h6>
                    <figure class="my-4">
                        <img src="{{ asset('assets/svg/trustfulness.svg') }}" alt="">
                    </figure>
                    <p class="text_p">{{ __('home.Trustfulness_desc') }}</p>
                </div>
                <div class="col-lg-4 col-md-6 mb-lg-0 mb-4">
                    <h6>{{ __('home.Innovation') }}</h6>
                    <figure class="my-4">
                        <img src="{{ asset('assets/svg/innovation.svg') }}" alt="">
                    </figure>
                    <p class="text_p">{{ __('home.Innovation_desc') }}</p>
                </div>
                <div class="col-lg-4 col-md-6 mb-lg-0 mb-4">
                    <h6>{{ __('home.Sustainability') }}</h6>
                    <figure class="my-4">
                        <img src="{{ asset('assets/svg/sustainability.svg') }}" alt="">
                    </figure>
                    <p class="text_p">{{ __('home.Sustainability_desc') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="play_section">
    <div class="container">
        <div class="row align-items-center flxDirection">
            <div class="col-md-6">
                <div class="play_content">
                    <div class="d-flex badge align-items-center">
                        <button class="pakket_btn me-3">Pakket2Go</button>
                        <p class="mb-0">{{ __('home.Is available Now on android and ios') }}
                        </p>
                    </div>
                    <div class="py-3 mob_align">
                        <h2 class="d-lg-block d-md-block d-none">{{ __('home.Download The App') }}</h2>
                        <p class="py-2">{{ __('home.app_desc') }}</p>
                    </div>
                    <div class="d-flex align-items-center justify-content-lg-start justify-content-md-start justify-content-sm-center">
                        <a href="https://apps.apple.com/nl/app/pakket2go/id1606859161" class="appstore_btn" target="_blank">
                            <div>
                                <figure>
                                    <img src="{{ asset('assets/svg/apple.svg') }}" alt="">
                                </figure>
                            </div>
                            <div class="ms-lg-3 ms-2">
                                {{ __('home.Download on the') }}<br>
                                <strong> Applestore</strong>
                            </div>
                        </a>
                        <a href="https://play.google.com/store/apps/details?id=com.slimpakket.user&hl=nl&gl=US" class="appstore_btn2 ms-lg-5 ms-3" target="_blank">
                            <div>
                                <figure>
                                    <img src="{{ asset('assets/svg/play.svg') }}" alt="">
                                </figure>
                            </div>
                            <div class="ms-lg-3 ms-2">{{ __('home.Download on the') }}<br>
                                <strong> Playstore</strong>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 dflex">
                <h2 class="mb-5 d-lg-none d-md-none text-center">{{ __('home.Download The App') }}</h2>
                <div class="mobile">
                    <figure>
                        <img src="{{ asset('assets/img/mobile_frame_'.App::getlocale().'.png') }}" alt="">
                    </figure>
                </div>
            </div>
        </div>
    </div>
</section>
@include('web.includes.stay_upto_date')
@endsection

@section('script')
<script src="{{ asset('assets/js/common.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{ env('GOOGLE_SITE_KEY') }}&callback=initMap" async defer></script>
@endsection