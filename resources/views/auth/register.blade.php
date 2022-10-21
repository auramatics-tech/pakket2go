@extends('web.layouts.master')

@section('title')
    Pakket2Go - Login
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/howitworks.css') }}">
    <style>

.form-wrapper {
  max-width: 30%;
  min-width: 300px;
  padding: 50px 30px 50px 30px;
  margin: 50px auto;   
  background-color: #ffffff;
  border-radius: 5px;
  box-shadow: 0 15px 35px rgba(50,50,93,.1),0 5px 15px rgba(0,0,0,.07);
}

.form-group {
  position:relative;  

  & + .form-group {
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
.su_hide_input{
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
                                                <label for="Private" id="private" class="active user_type"
                                                    data-other="courier">
                                                    Private
                                                    <input type="radio" value="private" name="user_type" id="form_private"
                                                        checked>
                                                </label>
                                                <label for="Courier" id="courier" class="user_type" data-other="private">
                                                    Business
                                                    <input type="radio" value="courier" name="user_type" id="form_courier">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @include('web.includes.private_registration_form')
                                    @include('web.includes.business_registration_form')

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
    <script>
        $(document).on("click", ".user_type", function() {
            console.log("hete")
            $('.user_type').removeClass("active")
            $(this).addClass("active")

            console.log($(this).attr('data-other'))
            $('#input_' + $(this).attr('data-other')).prop('checked', false)
            $('#input_' + $(this).attr('id')).prop('checked', true)

            $("#" + $(this).attr('data-other') + '_form').hide();
            $("#" + $(this).attr('id') + '_form').show();
        })
    </script>
    <script>
       
        $(document).on('click','.form-label',function(){
            $(this).closest('input').focus()
            $(this).closest('.form-group').addClass('focused');
        })
        $('input').focus(function(){
        $(this).parents('.form-group').addClass('focused');
        });

        $(document).on('click','.iti__country',function(){
        $('#phone').val($(this).children('.iti__dial-code').html())
    }) 

        $('input').blur(function(){
        var inputValue = $(this).val();
        if ( inputValue == "" ) {
            $(this).removeClass('filled');
            $(this).parents('.form-group').removeClass('focused');  
        } else {
            $(this).addClass('filled');
        }
        }) 
    </script>
@endsection
