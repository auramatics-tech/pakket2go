@extends('web.layouts.master')

@section('title')
    Pakket2Go - Otp
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
                                    <div class="d-flex my-4">
                                        <div>
                                            <div class="su_white_bg">
                                                <img src="{{ asset('assets/svg/Quick.svg') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="flex_align_end">
                                            <p class="su_Quick_Fast">Quick & Fast</p>
                                        </div>
                                    </div>
                                    <div class="d-flex my-4">
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
                                <div class="d-lg-flex d-md-flex d-block justify-content-around">
                                    <div class="d-flex my-4">
                                        <div>
                                            <div class="su_white_bg">
                                                <img src="{{ asset('assets/svg/Hassle.svg') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="flex_align_end">
                                            <p class="su_Quick_Fast">Hassle Free</p>
                                        </div>
                                    </div>
                                    <div class="d-flex my-4">
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
            </div>
            <div class="col-lg-6 col-md-12 col-12 su_col_padding_off">
                <div class="d-flex m-auto my-3 lang_toggle">
                    @include('web.layouts.language')
                </div>
                <div class="su_sign_in_form_padding">
                    <div class="su_sign_in_form">
                        <p class="su_text_Sign_In">Phone Verification</p>
                        <div class="su_truck_bg_img">
                            <div class="su_truck_img">
                                <img src="{{ asset('assets/img/truck.png') }}" alt="">
                            </div>
                        </div>
                        <input type="hidden" name="country_code" value="91">
                        <div class="su_inputs_padding">
                            <p class="su_enter_pin_text">Enter the 4-digit PIN code we sent to the number:</p>
                            <p class="su_phone_no">
                                +{{ Session::get('country_code') }}-{{ substr(Session::get('phone_number'), 0, 2) }}****{{ substr(Session::get('phone_number'), -3) }}
                            </p>
                            <form action="">
                                <div class="d-flex">
                                    <div class="form-group my-4 mx-2">
                                        <input type="number" name="phone_number" id="" class="su_otp_inputs"
                                            placeholder="0">
                                    </div>
                                    <div class="form-group my-4 mx-2">
                                        <input type="number" name="phone_number" id="" class="su_otp_inputs"
                                            placeholder="0">
                                    </div>
                                    <div class="form-group my-4 mx-2">
                                        <input type="number" name="phone_number" id="" class="su_otp_inputs"
                                            placeholder="0">
                                    </div>
                                    <div class="form-group my-4 mx-2">
                                        <input type="number" name="phone_number" id="" class="su_otp_inputs"
                                            placeholder="0">
                                    </div>
                                    <div class="form-group my-4 mx-2">
                                        <input type="number" name="phone_number" id="" class="su_otp_inputs"
                                            placeholder="0">
                                    </div>
                                    <div class="form-group my-4 mx-2">
                                        <input type="number" name="phone_number" id="" class="su_otp_inputs"
                                            placeholder="0">
                                    </div>
                                </div>
                            </form>
                            <span style="color: red; display:none;" id="valid_otp">Invalid OTP Number</span>
                            <div id="recaptcha-container"></div>
                            <div>
                                <button class="su_sign_btn" type="button" onclick="codeverify()">Submit Code</button>
                            </div>
                            <div class="text-center my-4" id="su_Join_now_span">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" value="{{ Session::get('user_id') }}" id="user_id">
        @php
            $user = App\Models\User::find(Session::get('user_id'));
        @endphp
        <input type="hidden" value="{{ $user->otp_sent_at }}" id="otp_sent_at">
    @endsection

    @section('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/8.0.1/firebase.js"></script>
        <script>
            var phone_number = "{{ $user->country_code . $user->phone_number }}";
            var first_otp = "{{ date('F d, Y H:i:s', strtotime('+5 mins')) }}"

            var minutesToAdd = 1;
            var currentDate = new Date();
            var otp_sent_at = "{{ $user->otp_sent_at }}";
            @if (!$user->otp_sent_at)
                // Set the date we're counting down to
                var countDownDate = new Date(currentDate.getTime() + minutesToAdd * 60000).getTime();
            @else
                var countDownDate = "{{ $user->otp_sent_at }}"
            @endif
        </script>
        <script src="{{ asset('assets/js/otp.js') }}"></script>
    @endsection
