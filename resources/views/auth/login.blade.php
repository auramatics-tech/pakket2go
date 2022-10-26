@extends('web.layouts.master')

@section('title')
    Pakket2Go - Login
@endsection

@section('content')
    <div class="container-fluid" style="padding-left: 0% !important">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-12 su_col_padding_off">
                <div class="su_side_color">

                    <div class="su_register_sidebar_padding">
                        <div class="su_position_white_arrow">
                            <figure class="su_main_circle">
                                <img src="{{ asset('assets/svg/white_circle.svg') }}" alt="">
                            </figure>
                        </div>
                        <div>
                            <figure class="text-center su_main_logo">
                                <img src="{{ asset('assets/svg/Pakket2go.svg') }}" alt="logo">
                            </figure>
                            <h6 class="su_Your_Best">
                                Your Best Choice in Netherland
                            </h6>
                            <p class="su_easilest">
                                The easilest and most affordable way to transport any parcel regarding size
                            </p>
                            <div class="">
                                <div class="d-lg-flex d-md-flex d-block justify-content-around">
                                    <div class="d-flex align-items-center my-4">
                                        <div>
                                            <div class="su_white_bg">
                                                <img src="{{ asset('assets/svg/Quick.svg') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="flex_align_end">
                                            <p class="su_Quick_Fast su_icons_text_adjust"> Quick & Fast</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center my-4">
                                        <div>
                                            <div class="su_white_bg">
                                                <img src="{{ asset('assets/svg/Safe.svg') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="flex_align_end">
                                            <p class="su_Quick_Fast su_icons_text_adjust"> Safe & Secure</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-lg-flex d-md-flex d-block justify-content-around">
                                    <div class="d-flex align-items-center my-4">
                                        <div>
                                            <div class="su_white_bg">
                                                <img src="{{ asset('assets/svg/Hassle.svg') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="flex_align_end">
                                            <p class="su_Quick_Fast su_icons_text_adjust"> Hassle Free</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center my-4">
                                        <div>
                                            <div class="su_white_bg">
                                                <img src="{{ asset('assets/svg/Support3.svg') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="flex_align_end">
                                            <p class="su_Quick_Fast su_icons_text_adjust"> 24 / 7 Support</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12 su_col_padding_off">
                <div class="su_sign_up_align">
                    <div class="d-lg-flex d-none m-auto my-3 lang_toggle su_position_2_btns">
                        @include('web.layouts.language')
                    </div>
                    <div>
                        <form action="{{ route('login') }}" method="post" id="login-form">
                            @csrf
                            <div class="su_sign_in_form_padding">
                                <div class="su_sign_in_form">
                                    <p class="su_text_Sign_In">Sign In</p>
                                    <div class="su_truck_bg_img">
                                        <div class="su_truck_img">
                                            <img src="{{ asset('assets/img/truck.png') }}" alt="">
                                        </div>
                                    </div>
                                    <input type="hidden" name="country_code" value="31" id="country_code">
                                    <div class="su_inputs_padding">
                                        <div class="form-group mt-4">
                                            <input class="su_country_dropdown" id="phone" type="tel"
                                                name="phone_number" />
                                            @error('phone_number')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="alert alert-info" style="display: none;"></div>
                                        <div class="form-group mt-4">
                                            <input type="password" name="password" id=""
                                                class="su_des_textarea Password" placeholder="Password">
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center su_margin_1366">
                                            <div>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <label class="su_container">
                                                            <input type="checkbox" checked="checked" name="remember">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                    <div>
                                                        <p class="su_checkbox_text ">
                                                            {{ __('Remember me') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                @if (Route::has('password.request'))
                                                    <a class="su_Forgot_password" href="{{ route('password.request') }}">
                                                        {{ __('Forgot your password?') }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                            <button class="su_sign_btn" type="submit">Sign In</button>
                                        </div>
                                        <div class="text-center su_margin_1366">
                                            <p class="su_Join_now">Don't have an account? <a href="{{ route('register') }}"
                                                    class="su_Join_now_span">Join
                                                    now</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/js/login_register.js') }}"></script>
@endsection
