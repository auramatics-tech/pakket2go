@extends('web.layouts.master')

@section('title')
    Pakket2Go - How it works
@endsection

@section("style")
    <link rel="stylesheet" href="{{ asset('assets/css/howitworks.css') }}">
@endsection

@section('content')
    <section class="first-section">
        <div class="container content-top text-center">
            <h1>Learn how this Easy Process Works</h2>
                <p>Arrange the transport of large items in three easy steps</p>
        </div>
    </section>
    <section class="second_section">
        <div class="container">
            <div class="su_row_div_padding">
                <div class="row su_row_padding">
                    <div class="col-lg-6 col-md-6 col-12 su_flex_align">
                        <div class="su_width">
                            <h2>Post your order with Courier Details and
                                Delivery Information</h2>
                            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In eleifend lacinia quam
                                malesm orbi potenti. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In
                                eleifend lacinia quam malesm.</span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="">
                            <div class="su_position_right">
                                <span class="badge su_badge">1</span>
                            </div>
                            <figure class="su_details">
                                <img src="{{ asset('assets/png/details.png') }}" alt="details" style="width:100%">
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="row su_row_padding d-lg-flex d-md-flex d-none">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="">
                            <div class="su_position_left su_flex_end">
                                <span class="badge su_badge">2</span>
                            </div>
                            <figure class="su_details">
                                <img src="{{ asset('assets/png/location.png') }}" alt="details" style="width:100%">
                            </figure>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 su_flex_align">
                        <div class="su_width">
                            <h2>All couriers in the Neighborhood will
                                see Your Parcel</h2>
                            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In eleifend lacinia quam
                                malesm orbi potenti. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In
                                eleifend lacinia quam malesm.</span>
                        </div>
                    </div>
                </div>
                <div class="row su_row_padding d-lg-none d-md-none d-block">
                    <div class="col-lg-6 col-md-6 col-12 su_flex_align">
                        <div class="su_width">
                            <h2>All couriers in the Neighborhood will
                                see Your Parcel</h2>
                            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In eleifend lacinia quam
                                malesm orbi potenti. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In
                                eleifend lacinia quam malesm.</span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="">
                            <div class="su_position_left su_flex_end">
                                <span class="badge su_badge">2</span>
                            </div>
                            <figure class="su_details">
                                <img src="{{ asset('assets/png/location.png') }}" alt="details" style="width:100%">
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="row su_row_padding">
                    <div class="col-lg-6 col-md-6 col-12 su_flex_align">
                        <div class="su_width">
                            <h2>First courier accepts it and picks up and
                                Delivers Your Parcel</h2>
                            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In eleifend lacinia quam
                                malesm orbi potenti. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In
                                eleifend lacinia quam malesm.</span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="">
                            <div class="su_position_right">
                                <span class="badge su_badge">3</span>
                            </div>
                            <figure class="su_details">
                                <img src="{{ asset('assets/png/details.png') }}" alt="deliver" style="width:100%">
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12 d-flex">
                                <div class="text_info">
                                    <h2>Post your order with Courier Details and
                                        Delivery Information</h2>
                                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In eleifend lacinia quam
                                        malesm orbi potenti. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In
                                        eleifend lacinia quam malesm.</span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12 d-flex">
                                <div class="text_info">
                                    <figure class="details">
                                        <img src="{{ asset('assets/png/details.png') }}" alt="details" style="width:90%">
                                    </figure>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12 d-flex">
                                <div class="text_info">
                                    <figure class="location">
                                        <img src="{{ asset('assets/png/location.png') }}" alt="location" style="width:90%">
                                    </figure>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12 d-flex">
                                <div class="text_info">
                                    <h2>All couriers in the Neighborhood will
                                        see Your Parcel</h2>
                                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In eleifend lacinia quam
                                        malesm orbi potenti. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In
                                        eleifend lacinia quam malesm.</span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12 d-flex ">
                                <div class="text_info">
                                    <h2>First courier accepts it and picks up and
                                        Delivers Your Parcel</h2>
                                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In eleifend lacinia quam
                                        malesm orbi potenti. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In
                                        eleifend lacinia quam malesm.</span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12 d-flex ">
                                <div class="text_info">
                                    <figure class="deliver">
                                        <img src="{{ asset('assets/png/details.png') }}" alt="deliver" style="width:90%">
                                    </figure>
                                </div>
                            </div>
                        </div> -->
        </div>
    </section>
    <section class="third-section">
        <div class="center-images">
            <img src="{{ asset('assets/img/cloud.png') }}" class="img-fluid" alt="cloud">
            <img src="{{ asset('assets/img/building.png') }}" class="img-fluid d-none d-lg-block d-md-block" alt="building">
            <div class="mobile_build d-block d-lg-none d-md-none"></div>
            <figure class="truck_imgone">
                <img src="{{ asset('assets/img/truck.png') }}" alt="">
            </figure>
        </div>
        </div>
    </section>
    <section class="four_section_top">
        <div class="container bg-white info text-center below">
            @include('web.includes.booking')
        </div>
    </section>
    @include('web.includes.stay_upto_date')
@endsection

@section('script')
    <script src="{{ asset('assets/js/common.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{ env('GOOGLE_SITE_KEY') }}&callback=initMap"
        async defer></script>
@endsection