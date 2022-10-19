@extends('web.layouts.master')

@section('title')
    Pakket2Go
@endsection

@section('content')
    <div class="container-fluid" style="padding-left: 0% !important">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-6">
                <div class="su_side_color">

                    <div class="su_register_sidebar_padding">
                        <div class="">
                            <figure class="su_main_circle">
                                <img src="{{ asset('assets/svg/white_circle.svg') }}" alt="">
                            </figure>
                            <figure class="text-center su_main_logo">
                                <img src="{{ asset('assets/svg/Pakket2go.svg') }}" alt="logo">
                            </figure>
                            <h6 class="su_Your_Best">
                                Your Best Choice in Netherland
                            </h6>
                            <p class="su_easilest">
                                The easilest and most affordable way to transport any parcel regarding size
                            </p>
                            <div class="d-lg-flex d-md-flex d-block justify-content-center">
                                <div class="d-flex justify-content-center my-4 mx-4">
                                    <div>
                                        <div class="su_white_bg">
                                            <img src="{{ asset('assets/svg/Quick.svg') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="flex_align_end">
                                        <p class="su_Quick_Fast">Quick & Fast</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center my-4 mx-4">
                                    <div>
                                        <div class="su_white_bg">
                                            <img src="{{ asset('assets/svg/Safe.svg') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="flex_align_end">
                                        <p class="su_Quick_Fast">Safe & Secure</p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-lg-flex d-md-flex d-block justify-content-center">
                                <div class="d-flex justify-content-center my-4 mx-4">
                                    <div>
                                        <div class="su_white_bg">
                                            <img src="{{ asset('assets/svg/Hassle.svg') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="flex_align_end">
                                        <p class="su_Quick_Fast">Hassle Free</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center my-4 mx-4">
                                    <div>
                                        <div class="su_white_bg">
                                            <img src="{{ asset('assets/svg/Support3.svg') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="flex_align_end">
                                        <p class="su_Quick_Fast">24 / 7 Support</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-6">
                <div class="d-flex m-auto my-3 lang_toggle">
                    @include('web.layouts.language')
                </div>
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="su_sign_in_form_padding">
                        <div class="su_sign_in_form">
                            <p class="su_text_Sign_In">Sign In</p>
                            <div class="su_truck_bg_img">
                                <div class="su_truck_img">
                                    <img src="{{ asset('assets/img/truck.png') }}" alt="">
                                </div>
                            </div>
                            <input type="hidden" name="country_code" value="91">
                            <div class="su_inputs_padding">
                                <div class="form-group mt-4">
                                    <input type="number" name="phone_number" id="" class="su_des_textarea flag"
                                        placeholder="646872017">
                                </div>
                                <div class="form-group mt-4">
                                    <input type="text" name="password" id="" class="su_des_textarea Password"
                                        placeholder="Password">
                                </div>


                                <div class="d-flex justify-content-between my-4">
                                    <div class="d-flex">
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
                                <div class="text-center my-4">
                                    <p class="su_Join_now">Don't have an account? <span class="su_Join_now_span">Join
                                            now</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
