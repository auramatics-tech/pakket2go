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
                <h1>Become Courier</h1>
                <p> Earn extra on your rides. Apply as a courier! </p>
            </div>
            <div class="d-flex justify-content-center">
                <div>
                    <button class="su_Register_btn">Register</button>
                </div>
                <div>
                    <button class="su_See_Jobs">See Jobs</button>
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
                        <h2 class="su_heading_accordion mt-0">General Questions</h2>
                        <div class="accordion-item su_accordion_item">
                            <h2 class="accordion-header su_accordion_header" id="headingOne">
                                <button class="accordion-button su_accordion_button" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    Accordion Item #1
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body su_accordion_body">
                                   
                                    This is the first item's accordion body. It is shown by default, until
                                    the collapse plugin adds the appropriate classes that we use to style each element.
                                    These classes control the overall appearance, as well as the showing and hiding via
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item su_accordion_item">
                            <h2 class="accordion-header su_accordion_header" id="headingTwo">
                                <button class="su_accordion_button accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                    aria-controls="collapseTwo">
                                    Accordion Item #2
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body su_accordion_body">
                                    via CSS transitions. You can modify any of this with custom CSS or overriding our
                                    default variables. It's also worth noting that just about any HTML can go within the
                                    though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item su_accordion_item">
                            <h2 class="accordion-header su_accordion_header" id="headingThree">
                                <button class="su_accordion_button accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseThree">
                                    Accordion Item #3
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body su_accordion_body">
                                    It is hidden by default, until
                                    the collapse worth noting that just about any HTML can go within the
                                    though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item su_accordion_item">
                            <h2 class="accordion-header su_accordion_header" id="headingThree">
                                <button class="su_accordion_button accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false"
                                    aria-controls="collapse4">
                                    Accordion Item #3
                                </button>
                            </h2>
                            <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body su_accordion_body">
                                    It is hidden by default, until
                                    the collapse worth noting that just about any HTML can go within the
                                    though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
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
                        <h2 class="su_col_heading">Earn money in your own time</h2>
                        <p class="su_col_para">Lorem ipsum dolor sit amet,
                            consectetur adipiscing elit.
                            In eleifend lacinia quam.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="su_white_bg_img">
                        <img src="{{ asset('assets/img/order.png') }}" alt="">
                    </div>
                    <div class="su_col_padding">
                        <h2 class="su_col_heading">Accept any order you like &
                            get paid immediately
                        </h2>
                        <p class="su_col_para">Lorem ipsum dolor sit amet,
                            consectetur adipiscing elit.
                            In eleifend lacinia quam.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="su_white_bg_img">
                        <img src="{{ asset('assets/img/truck_loaded.png') }}" alt="">
                    </div>
                    <div class="su_col_padding">
                        <h2 class="su_col_heading">Don’t return home with
                            an empty van
                        </h2>
                        <p class="su_col_para">Lorem ipsum dolor sit amet,
                            consectetur adipiscing elit.
                            In eleifend lacinia quam.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="su_carousal">
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
    </section>
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
                                        <div class="flex_align_end su_icons_text_adjust">
                                            <p class="su_Quick_Fast">Quick & Fast aaaaaaaaaaaaaaaaa</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center my-4">
                                        <div>
                                            <div class="su_white_bg_become">
                                                <img src="{{ asset('assets/svg/Safe.svg') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="flex_align_end su_icons_text_adjust">
                                            <p class="su_Quick_Fast">Safe & Secure aaaaaaaaaaaaaaaaa</p>
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
                                        <div class="flex_align_end su_icons_text_adjust">
                                            <p class="su_Quick_Fast">Hassle Free aaaaaaaaaaaaaaaaa</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center my-4">
                                        <div>
                                            <div class="su_white_bg_become">
                                                <img src="{{ asset('assets/svg/Support3.svg') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="flex_align_end su_icons_text_adjust">
                                            <p class="su_Quick_Fast">24 / 7 Support aaaaaaaaaaaaaaaaa</p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <h2 class="su_become_courier">How to become a courier for <span class="su_Pakket2Go">Pakket2Go</span>
                    </h2>
                    <div class="d-flex align-items-center my-4">
                        <div class="su_white_bg su_white_bg_text">
                            1
                        </div>
                        <div>
                            <h2 class="su_courier_white_bg">Are you a professional courier? Click on the “Apply Now”
                            </h2>
                        </div>
                    </div>
                    <div class="d-flex align-items-center my-4">
                        <div class="su_white_bg su_white_bg_text">
                            2
                        </div>
                        <div>
                            <h2 class="su_courier_white_bg">Your profile will be verified after a phone call
                            </h2>
                        </div>
                    </div>
                    <div class="d-flex align-items-center my-4">
                        <div class="su_white_bg su_white_bg_text">
                            3
                        </div>
                        <div>
                            <h2 class="su_courier_white_bg">Claim a transport and execute it!
                            </h2>
                        </div>
                    </div>
                    <div class="d-lg-flex d-md-flex d-block align-items-center">
                        <div>
                            <button class="su_Apply_Now">Apply Now</button>
                        </div>
                        <div>
                            <button class="su_See">See Jobs</button>
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
