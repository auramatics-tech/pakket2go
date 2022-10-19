@extends('web.layouts.master')

@section('title')
    Pakket2Go - Become Courier
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/howitworks.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/owlcarousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/owlcarousel/assets/owl.theme.default.min.css') }}">
@endsection

@section('content')
    <section class="become_banner_section">
        <div class="su_main_top_bg">
            <div class="container content text-center">
                <h1>{{ __('becomecourier.Become Courier') }}</h1>
                <p>{{ __('becomecourier.earn_extra') }}</p>
            </div>
            <div class="d-flex justify-content-center">
                <div>
                    <button class="su_Register_btn">{{ __('home.Register') }}</button>
                </div>
                <div>
                    <button class="su_See_Jobs">{{ __('becomecourier.See Jobs') }}</button>
                </div>
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
    <section class="about_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 ps-lg-5 text-center text-md-center text-lg-start">
                    <div class="accordion su_accordion_padding" id="accordionExample">
                        <h2 class="su_heading_accordion mt-0">{{ __('becomecourier.FAQs for Courier') }}</h2>
                        @for($i = 1; $i <= 4; $i++)
                            <div class="accordion-item su_accordion_item">
                                <h2 class="accordion-header su_accordion_header" id="heading{{ $i }}">
                                    <button class="accordion-button su_accordion_button @if($i != 1) collapsed @endif" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse{{ $i }}" aria-expanded="true"
                                        aria-controls="collapse{{ $i }}">
                                        {{ __("becomecourier.faq_title_$i") }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $i }}" class="accordion-collapse collapse @if($i == 1) show @endif" aria-labelledby="heading{{ $i }}"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body su_accordion_body">
                                        {{ __("becomecourier.faq_description_$i") }}
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <figure class="about_img">
                        <img src="{{ asset('assets/img/parsalboy.png') }}" alt="">
                    </figure>
                </div>

            </div>
        </div>
    </section>
    <section class="su_green_bg_with_col">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="su_white_bg_img">
                        <img src="{{ asset('assets/img/coins.png') }}" alt="">
                    </div>
                    <div class="su_col_padding">
                        <h2 class="su_col_heading">{{ __('becomecourier.earn_money') }}</h2>
                        <p class="su_col_para">{{ __('becomecourier.earn_money_desc') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="su_white_bg_img">
                        <img src="{{ asset('assets/img/order.png') }}" alt="">
                    </div>
                    <div class="su_col_padding">
                        <h2 class="su_col_heading">{{ __('becomecourier.accept_order') }}</h2>
                        <p class="su_col_para">{{ __('becomecourier.accept_order_desc') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="su_white_bg_img">
                        <img src="{{ asset('assets/img/truck_loaded.png') }}" alt="">
                    </div>
                    <div class="su_col_padding">
                        <h2 class="su_col_heading">{{ __('becomecourier.empty_van') }}</h2>
                        <p class="su_col_para">{{ __('becomecourier.empty_van_desc') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <section class="su_carousal">
        <div class="container">
            <h3 class="su_Featured_Partners">Featured Partners</h3>
            <div class="owl-carousel owl-loaded bever_carousel owl-drag su_carousal_padding">
                <div class="item">
                    <div class="su_carousal_img_ste">
                        <img src="{{ asset('assets/img/tim.png') }}" alt="">
                    </div>
                </div>
                <div class="item">
                    <div class="su_carousal_img_ste">
                        <img src="{{ asset('assets/img/apple.png') }}" alt="">
                    </div>
                </div>
                <div class="item">
                    <div class="su_carousal_img_ste">
                        <img src="{{ asset('assets/img/nike.png') }}" alt="">
                    </div>
                </div>
                <div class="item">
                    <div class="su_carousal_img_ste">
                        <img src="{{ asset('assets/img/walmart.png') }}" alt="">
                    </div>
                </div>
                <div class="item">
                    <div class="su_carousal_img_ste">
                        <img src="{{ asset('assets/img/kfc.png') }}" alt="">
                    </div>
                </div>
                <div class="item">
                    <div class="su_carousal_img_ste">
                        <img src="{{ asset('assets/img/airbnb.png') }}" alt="">
                    </div>
                </div>
                <div class="item">
                    <div class="su_carousal_img_ste">
                        <img src="{{ asset('assets/img/walmart.png') }}" alt="">
                    </div>
                </div>
                <div class="item">
                    <div class="su_carousal_img_ste">
                        <img src="{{ asset('assets/img/kfc.png') }}" alt="">
                    </div>
                </div>
                <div class="item">
                    <div class="su_carousal_img_ste">
                        <img src="{{ asset('assets/img/airbnb.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <section class="our_values_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="su_register_sidebar_padding">
                        <div class="">
                            <figure class="su_main_logo_become">
                                <img src="{{ asset('assets/svg/Pakket2go.svg') }}" alt="logo">
                            </figure>

                            <div class="">
                                <div class="d-lg-flex d-md-flex d-block justify-content-between">
                                    <div class="d-flex align-items-center my-4">
                                        <div>
                                            <div class="su_white_bg_become">
                                                <img src="{{ asset('assets/svg/Quick.svg') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="flex_align_end">
                                            <p class="su_Quick_Fast su_icons_text_adjust">{{ __('home.Quick & Fast') }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center my-4">
                                        <div>
                                            <div class="su_white_bg_become">
                                                <img src="{{ asset('assets/svg/Safe.svg') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="flex_align_end">
                                            <p class="su_Quick_Fast su_icons_text_adjust">{{ __('home.Secure') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-lg-flex d-md-flex d-block justify-content-between">
                                    <div class="d-flex align-items-center my-4">
                                        <div>
                                            <div class="su_white_bg_become">
                                                <img src="{{ asset('assets/svg/Hassle.svg') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="flex_align_end">
                                            <p class="su_Quick_Fast su_icons_text_adjust">{{ __('home.Hassle Free') }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center my-4">
                                        <div>
                                            <div class="su_white_bg_become">
                                                <img src="{{ asset('assets/svg/Support3.svg') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="flex_align_end">
                                            <p class="su_Quick_Fast su_icons_text_adjust">{{ __('home.24/7 Support') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <h2 class="su_become_courier">{{ __('becomecourier.how_to_become') }}<span class="su_Pakket2Go">Pakket2Go</span>
                    </h2>
                    <div class="d-flex align-items-center my-4">
                        <div class="su_white_bg su_white_bg_text">
                            1
                        </div>
                        <div>
                            <h2 class="su_courier_white_bg">{{ __('becomecourier.step_1') }}
                            </h2>
                        </div>
                    </div>
                    <div class="d-flex align-items-center my-4">
                        <div class="su_white_bg su_white_bg_text">
                            2
                        </div>
                        <div>
                            <h2 class="su_courier_white_bg">{{ __('becomecourier.step_2') }}
                            </h2>
                        </div>
                    </div>
                    <div class="d-flex align-items-center my-4">
                        <div class="su_white_bg su_white_bg_text">
                            3
                        </div>
                        <div>
                            <h2 class="su_courier_white_bg">{{ __('becomecourier.step_3') }}
                            </h2>
                        </div>
                    </div>
                    <div class="d-lg-flex d-md-flex d-block align-items-center">
                        <div>
                            <button class="su_Apply_Now">{{ __('becomecourier.Apply Now') }}</button>
                        </div>
                        <div>
                            <button class="su_See">{{ __('becomecourier.See Jobs') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="su_white_section_margin"></section>
    @include('web.includes.stay_upto_date')
@endsection

@section('script')
    <script src="{{ asset('assets/owlcarousel/owl.carousel.js') }}"></script>
    <script>
        jQuery(document).ready(function($) {
            $(".bever_carousel").owlCarousel({
                margin: 20,
                nav: true,
                loop: false,
                dots: true,
                // autoplay: true,
                // autoplayTimeout: 2000,
                // autoplayHoverPause: true,
                navText: ['<i class="fa fa-arrow-left text-dark"></i>',
                    '<i class="fa fa-arrow-right text-dark"></i>'
                ],
                responsive: {
                    0: {
                        items: 1,
                        nav: true,
                        dots: true,
                    },
                    300: {
                        items: 1,
                        nav: true,
                        margin: 0,
                        dots: true,
                    },
                    700: {
                        items: 3,
                        nav: true,
                        dots: true,
                    },
                    1000: {
                        items: 6,
                        nav: true,
                        dots: true,
                    },
                    1600: {
                        items: 6,
                        nav: true,
                        dots: true,
                    }
                }
            });
        });
    </script>
@endsection
