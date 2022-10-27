@extends('web.layouts.master')

@section('title')
    Pakket2Go - Login
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/howitworks.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <style>
        .form-wrapper {
            max-width: 30%;
            min-width: 300px;
            padding: 50px 30px 50px 30px;
            margin: 50px auto;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 15px 35px rgba(50, 50, 93, .1), 0 5px 15px rgba(0, 0, 0, .07);
        }

        .form-group {
            position: relative;

            &+.form-group {
                margin-top: 30px;
            }
        }

        .form-label {
            position: absolute;
            left: 60px;
            top: 15px;
            width: auto;
            width: auto !important;
        }

        .focused .form-label {
            transform: translateY(-125%);
            font-size: .75em;
            background-color: #ffffff;
            font-weight: 600;
            font-size: 14.4298px;
            line-height: 20px;
            color: #01B537;
            transition: all .3s ease-out;
        }

        .form-input.filled {
            box-shadow: 0 2px 0 0 lightgreen;
        }

        .su_hide_input {
            border: none;
            width: 100%;
        }

        .su_hide_input:focus-visible {
            outline: none !important;
        }
    </style>
@endsection

@section('content')
    <section class="courier_type_section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-12 su_col_padding_off">
                    <div class="su_register_sidebar">
                        <div class="su_register_sidebar_padding">
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
                            <div class="su_side_margin">
                                <div class="d-flex align-items-center my-4">
                                    <div>
                                        <div class="su_white_bg">
                                            <img src="{{ asset('assets/svg/Quick.svg') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="flex_align_end">
                                        <p class="su_Quick_Fast">Quick & Fast</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center my-4">
                                    <div>
                                        <div class="su_white_bg">
                                            <img src="{{ asset('assets/svg/Safe.svg') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="flex_align_end">
                                        <p class="su_Quick_Fast">Safe & Secure</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center my-4">
                                    <div>
                                        <div class="su_white_bg">
                                            <img src="{{ asset('assets/svg/Hassle.svg') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="flex_align_end">
                                        <p class="su_Quick_Fast">Hassle Free</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center my-4">
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
                <div class="col-lg-9 col-md-9 col-12 su_col_padding_off">
                    <div class="su_sign_up_align">
                        <div class="d-lg-flex d-none m-auto my-3 lang_toggle su_position_3_btns">
                            @include('web.layouts.language')
                        </div>
                        <div class="su_col_padding">
                            <div class="su_register_card mt-4">
                                <h6 class="su_Register_Now">Register Now</h6>
                                <p class="su_account_to_continue">Create an account to continue</p>
                                <form action="{{ route('register') }}" method="post">
                                    @csrf
                                    <div class="su_button_padding">
                                        <div class="form-group mt-4">
                                            <div class="radio_style">
                                                <label for="Private" id="private"
                                                    class="@if (!old('user_type') || old('user_type') == 'private') active @endif user_type"
                                                    data-other="courier">
                                                    Private
                                                    <input type="radio" value="private" name="user_type" id="form_private"
                                                        @if (!old('user_type') || old('user_type') == 'private') checked @endif>
                                                </label>
                                                <label for="Courier" id="courier"
                                                    class="@if (old('user_type') == 'courier') active @endif user_type"
                                                    data-other="private">
                                                    Business
                                                    <input type="radio" value="courier" name="user_type" id="form_courier"
                                                        @if (old('user_type') == 'courier') checked @endif>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="register_form">
                                        @if (old('user_type'))
                                            @include('web.includes.' . old('user_type') . '_registration_form')
                                        @else
                                            @include('web.includes.private_registration_form')
                                        @endif
                                    </div>

                                    <div class="d-flex su_margin_top">
                                        <div>
                                            <label class="su_container">
                                                <input type="checkbox" checked="checked">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div>
                                            <p class="su_checkbox_text ">
                                                I agree to the
                                                <a href="#" class="login_ancr orange-color ms-2">Terms and
                                                    Conditions</a>
                                                of Pakket2Go
                                            </p>
                                        </div>
                                    </div>

                                    <div class="text-center my-4">
                                        <button class="su_Sign_In" type="submit">Register</button>
                                    </div>
                                    <p class="su_Login">Already have an account? <a href="{{ route('login') }}"
                                            class="su_login_red">Login</a></p>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('assets/js/login_register.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $(document).on("click", ".user_type", function() {

            $('.user_type').removeClass("active")
            $(this).addClass("active")
            console.log($(this).attr('data-other'))
            console.log($(this).attr('id'))
            $('#form_' + $(this).attr('data-other')).attr('checked', false)
            $('#form_' + $(this).attr('id')).attr('checked', true)

            $.ajax({
                url: BASEURL + '/load-register-form/' + $(this).attr('id'),
                method: 'get',
                success: function(data) {
                    $('#register_form').html(data.form);
                    phone_country_code()
                    autocompletecn()
                    $('input').focus(function() {
                        $(this).parents('.form-group').addClass('focused');
                    });
                }
            })
        })

        $(document).on('click', '.form-label', function() {
            $(this).closest('.form-group').addClass('focused');
            $(this).parent().find('input').focus();
        })

        $('input').focus(function() {
            $(this).parents('.form-group').addClass('focused');
        });
        @if (old('user_type'))
            $('input').parents('.form-group').addClass('focused');
        @endif

        $('input').blur(function() {
            var inputValue = $(this).val();
            if (inputValue == "") {
                $(this).removeClass('filled');
                $(this).parents('.form-group').removeClass('focused');
            } else {
                $(this).addClass('filled');
            }
        })


        function autocompletecn() {
            $("#kvkcompanyname").autocomplete({

                source: function(request, response) {
                    $.ajax({
                        url: BASEURL + '/' + "kvkautocomplete",
                        data: {
                            searchval: decodeURI(request.term)
                        },
                        dataType: "json",
                        beforeSend: function() {
                            console.log('calling');
                        },
                        success: function(data) {
                            console.log(data);

                            var resp = $.map(data, function(obj) {
                                return {
                                    'label': obj.handelsnaam,
                                    'value': obj
                                };
                            });

                            console.log(resp);
                            response(resp);
                        },
                        error: function(err) {
                            console.log(err);
                            $("#error").text(err.message);
                            $("#error").show();
                            $('#street').val('');
                            $('#kvknumber').val('');
                            $('#city').val('');
                            $('#zipcode').val('');
                            $('#housenumber').val('');
                            $('#houseletter').val('');
                        }
                    });
                },
                minLength: 4,
                select: function(event, ui) {
                    // Set selection
                    console.log(ui.item.value);
                    $('#kvkcompanyname').val(ui.item.label).parents('.form-group').addClass(
                        'focused');; // display the selected text
                    $('#street').val(ui.item.value.straatnaam).parents('.form-group').addClass('focused');;
                    $('#kvknumber').val(ui.item.value.kvkNummer).parents('.form-group').addClass('focused');;
                    $('#city').val(ui.item.value.plaats).parents('.form-group').addClass('focused');

                    $.ajax({
                        url: BASEURL + '/' + "kvkbasicprofile",
                        data: {
                            kvknumberis: ui.item.value.kvkNummer
                        },
                        dataType: "json",
                        beforeSend: function() {
                            console.log('calling curl');
                        },
                        success: function(data) {
                            let alldata = data[0];
                            console.log(alldata);
                            $('#zipcode').val(alldata[0]['postcode']).parents('.form-group')
                                .addClass('focused');;
                            $('#housenumber').val(alldata[0]['huisnummer']).parents('.form-group')
                                .addClass('focused');;
                            $('#houseletter').val(alldata[0]['huisletter']).parents('.form-group')
                                .addClass('focused');;
                            jQuery(".loadermodal").hide();
                        },
                        error: function(err) {
                            console.log(err);
                            $("#error").text(err.message);
                            $("#error").show();
                        }
                    });
                    return false;
                }
            });
        }
        @if (old('user_type') == 'courier')
            autocompletecn()
        @endif
    </script>
@endsection
