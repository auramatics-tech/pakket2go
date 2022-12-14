@extends('web.layouts.master')

@section('title')
    Pakket2Go - Otp
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/howitworks.css') }}">
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid" style="padding-left: 0% !important">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-12 su_col_padding_off">
                <div class="su_side_color">

                    <div class="su_register_sidebar_padding">
                        <div class="su_position_white_arrow">
                            <a href="">
                                <figure class="su_main_circle">
                                    <img src="{{ asset('assets/svg/white_circle.svg') }}" alt="">
                                </figure>
                            </a>
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
                            <div class="su_margin_767">
                                <div class="d-lg-flex d-md-flex d-block justify-content-around">
                                    <div class="d-flex align-items-center my-4">
                                        <div>
                                            <div class="su_white_bg">
                                                <img src="{{ asset('assets/svg/Quick.svg') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="flex_align_end">
                                            <p class="su_Quick_Fast su_icons_text_adjust">Quick & Fast</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center my-4">
                                        <div>
                                            <div class="su_white_bg">
                                                <img src="{{ asset('assets/svg/Safe.svg') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="flex_align_end">
                                            <p class="su_Quick_Fast su_icons_text_adjust">Safe & Secure</p>
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
                                            <p class="su_Quick_Fast su_icons_text_adjust">Hassle Free</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center my-4">
                                        <div>
                                            <div class="su_white_bg">
                                                <img src="{{ asset('assets/svg/Support3.svg') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="flex_align_end">
                                            <p class="su_Quick_Fast su_icons_text_adjust">24 / 7 Support</p>
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
                    <div class="su_sign_in_form_padding">
                        <div class="su_sign_in_form">
                            <p class="su_text_Sign_In">Phone Verification</p>
                            <div class="su_truck_bg_img">
                                <div class="su_truck_img">
                                    <img src="{{ asset('assets/img/truck.png') }}" alt="">
                                </div>
                            </div>
                            <input type="hidden" name="country_code" value="{{ Auth::user()->country_code }}">
                            <div class="su_inputs_padding">
                                <p class="su_enter_pin_text">Enter the 6-digit PIN code we sent to the number:</p>
                                <p class="su_phone_no">
                                    +{{ Auth::user()->country_code }}-{{ substr(Auth::user()->phone_number, 0, 2) }}****{{ substr(Auth::user()->phone_number, -3) }}
                                </p>
                                <form action="" autocomplete="off">
                                    <div class="d-flex my-2">
                                        @for ($i = 1; $i <= 6; $i++)
                                            <div class="form-group my-4 mx-2">
                                                <input type="number" name="phone_number" id="{{ $i }}"
                                                    class="su_otp_inputs" placeholder="0" autocomplete="off" maxlength="1">
                                            </div>
                                        @endfor
                                    </div>
                                </form>
                                <span style="color: red; display:none;" id="error"></span>
                                <span style="color: red; display:none;" id="valid_otp">Invalid OTP Number</span>
                                <span style="color: red; display:none;" id="expired_otp">OTP expired</span>
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
        </div>
        <input type="hidden" value="{{ Auth::user()->id }}" id="user_id">
        <input type="hidden" value="{{ isset(Auth::user()->otp_sent_at) ? Auth::user()->otp_sent_at : '' }}"
            id="otp_sent_at">
    @endsection

    @section('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/8.0.1/firebase.js"></script>
        <script>
            var phone_number =
                "{{ isset(Auth::user()->country_code) ? Auth::user()->country_code . Auth::user()->phone_number : '' }}";
            console.log(phone_number)
            var first_otp = "{{ date('F d, Y H:i:s', strtotime('+5 mins')) }}"

            var minutesToAdd = 2;
            var currentDate = new Date();
            var otp_sent_at = "{{ isset(Auth::user()->otp_sent_at) ? Auth::user()->otp_sent_at : '' }}";
            @if (isset(Auth::user()->otp_sent_at) && !Auth::user()->otp_sent_at)
                // Set the date we're counting down to
                var countDownDate = new Date(currentDate.getTime() + minutesToAdd * 60000).getTime();
            @else
                var countDownDate = "{{ isset(Auth::user()->otp_sent_at) ? Auth::user()->otp_sent_at : '' }}"
            @endif

            var coderesult = '{{ isset(Auth::user()->otp_result) ? Auth::user()->otp_result : '' }}';
            console.log(coderesult)
            window.confirmationResult = coderesult
        </script>
        <script src="{{ asset('assets/js/otp.js') }}"></script>
    @endsection
