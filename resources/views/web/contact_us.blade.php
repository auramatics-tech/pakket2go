@extends('web.layouts.master')

@section('title')
    Pakket2Go - How it works
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/howitworks.css') }}">
@endsection

@section('content')
    <section class="su_accordion">
        <div class="container">
            <div class="text-center">
                <h2 class="su_Contact_with">Contact with Team Pakket2Go</h2>
                <p class="su_green_para">We are more than happy to answer all your questions. Curious to see the
                    price of your delivery?
                    You can check and see the price for your transport on our homepage immediately. Enter the
                    pick-up and destination details to see your price and then arrange your transport. Chat with us
                    or e-mail us for any other questions.</p>
            </div>
            <div class="accordion su_accordion_padding" id="accordionExample">
                <div class="accordion-item su_accordion_item">
                    <h2 class="accordion-header su_accordion_header" id="headingOne">
                        <button class="accordion-button su_accordion_button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Accordion Item #1
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body su_accordion_body">
                            <p class="su_accordion_para">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Faucibus ?</p>
                            This is the first item's accordion body. It is shown by default, until
                            the collapse plugin adds the appropriate classes that we use to style each element.
                            These classes control the overall appearance, as well as the showing and hiding via CSS
                            transitions. You can modify any of this with custom CSS or overriding our default
                            variables. It's also worth noting that just about any HTML can go within the
                            though the transition does limit overflow.
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
                            <p class="su_accordion_para">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Faucibus ?</p>
                            It is hidden by default,
                            until the collapse plugin adds the appropriate classes that we use to style each
                            element. These classes control the overall appearance, as well as the showing and hiding
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
                            <p class="su_accordion_para">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Faucibus ?</p>
                            It is hidden by default, until
                            the collapse plugin adds the appropriate classes that we use to style each element.
                            These classes control the overall appearance, as well as the showing and hiding via CSS
                            transitions. You can modify any of this with custom CSS or overriding our default
                            variables. It's also worth noting that just about any HTML can go within the
                            though the transition does limit overflow.
                        </div>
                    </div>
                </div>
            </div>
            <p class="su_red_text_center">Still got Queries?</p>
        </div>

    </section>
    <section class="su_form_section">
        <div class="container">
            <div class="su_form_section_padding">
                <div class="su_form_card">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="su_flex_center">
                                <div>
                                    <img src="{{ asset('assets/svg/red phone.svg') }}" alt="">
                                </div>
                                <div class="su_ml_20">
                                    <p class="su_phone_text">030 249 6233</p>
                                </div>
                            </div>
                            <div class="su_flex_center">
                                <div>
                                    <img src="{{ asset('assets/svg/red msg.svg') }}" alt="">
                                </div>
                                <div class="su_ml_20">
                                    <p class="su_phone_text">info@pakket2go.nl</p>
                                </div>
                            </div>
                            <div class="su_map_frame">
                                <div id="map"></div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <h6 class="su_Message">Leave Us a Message</h6>

                            <form action="">
                                <div class="form-group mt-4">
                                    <div class="msg_input">

                                        <label for="Email" class="ms-3">
                                            <span class="Email_label">Email Address</span>
                                            <div>
                                                <input type="text" class="code" value="john@gmail.com">
                                                <input type="text" class="number">
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group mt-4">
                                    <div class="subject_input">

                                        <label for="phone" class="ms-3">
                                            <!-- <span class="phone_label">phone</span> -->
                                            <div>
                                                <input type="text" class="code" placeholder="Subject">
                                                <input type="text" class="number">
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group mt-4">
                                    <div class="su_textarea">

                                        <label for="phone" class="ms-3">
                                            <!-- <span class="phone_label">phone</span> -->
                                            <div>
                                                <textarea type="text" placeholder="Type your message here" name="w3review" rows="4" cols="50"></textarea>>

                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <button class="su_Send_width">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('web.includes.stay_upto_date')
@endsection
