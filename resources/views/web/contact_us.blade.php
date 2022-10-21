@extends('web.layouts.master')

@section('title')
    Pakket2Go - How it works
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

    </style>
@endsection

@section('content')
    <section class="su_accordion">
        <div class="container">
            <div class="text-center">
                <h2 class="su_Contact_with">{{ __('contact.Contact with Team') }} Pakket2Go</h2>
                <p class="su_green_para">{{ __('contact.contact_desc') }}</p>
            </div>
            <div class="accordion su_accordion_padding" id="accordionExample">
                <h2 class="su_heading_accordion">{{ __('contact.General Questions') }}</h2>
                @for ($i = 1; $i <= 3; $i++)
                    <div class="accordion-item su_accordion_item">
                        <h2 class="accordion-header su_accordion_header" id="headingGeneral{{ $i }}">
                            <button
                                class="accordion-button su_accordion_button @if ($i != 1) collapsed @endif"
                                type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseGeneral{{ $i }}" aria-expanded="true"
                                aria-controls="collapse{{ $i }}">
                                {{ __("contact.g_q_title_$i") }}
                            </button>
                        </h2>
                        <div id="collapseGeneral{{ $i }}"
                            class="accordion-collapse collapse @if ($i == 1) show @endif"
                            aria-labelledby="heading{{ $i }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body su_accordion_body">
                                {{ __("contact.g_q_description_$i") }}
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            <div class="accordion su_accordion_padding" id="accordionExample">
                <h2 class="su_heading_accordion">{{ __('contact.Payment') }}</h2>
                @for ($i = 1; $i <= 3; $i++)
                    <div class="accordion-item su_accordion_item">
                        <h2 class="accordion-header su_accordion_header" id="heading{{ $i }}">
                            <button
                                class="accordion-button su_accordion_button @if ($i != 1) collapsed @endif"
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $i }}"
                                aria-expanded="true" aria-controls="collapse{{ $i }}">
                                {{ __("contact.payment_title_$i") }}
                            </button>
                        </h2>
                        <div id="collapse{{ $i }}"
                            class="accordion-collapse collapse @if ($i == 1) show @endif"
                            aria-labelledby="heading{{ $i }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body su_accordion_body">
                                {{ __("contact.payment_description_$i") }}
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            <div class="accordion su_accordion_padding" id="accordionExample">
                <h2 class="su_heading_accordion">{{ __('contact.Delivery') }}</h2>
                @for ($i = 1; $i <= 3; $i++)
                    <div class="accordion-item su_accordion_item">
                        <h2 class="accordion-header su_accordion_header" id="heading{{ $i }}">
                            <button
                                class="accordion-button su_accordion_button @if ($i != 1) collapsed @endif"
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $i }}"
                                aria-expanded="true" aria-controls="collapse{{ $i }}">
                                {{ __("contact.delivery_title_$i") }}
                            </button>
                        </h2>
                        <div id="collapse{{ $i }}"
                            class="accordion-collapse collapse @if ($i == 1) show @endif"
                            aria-labelledby="heading{{ $i }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body su_accordion_body">
                                {{ __("contact.delivery_description_$i") }}
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            <p class="su_red_text_center">{{ __('contact.Still got Queries?') }}</p>
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
                            <div class="su_flex_center">
                                <div>
                                    <img src="{{ asset('assets/svg/red location.svg') }}" alt="">
                                </div>
                                <div class="su_ml_20">
                                    <p class="su_phone_text">Peppelkade 2c, 3992AK Houten</p>
                                </div>
                            </div>
                            <div class="su_map_frame">
                                <div id="map"></div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <h6 class="su_Message">{{ __('contact.Leave Us a Message') }}</h6>

                            <form action="">
  
                            <div class="form-group msg_input mt-4">
                                    <label class="form-label" for="first">Email Address</label>
                                    <input id="first" class="form-input" type="text" />
                                    </div>

                                    <div class="form-group subject_input mt-4">
                                    <label class="form-label" for="">Subject</label>
                                    <input id="" class="form-input" type="text" />
                                    </div>

                                <div class="form-group mt-4">
                                    <div class="su_textarea">
                                        <label for="phone" class="ms-3">
                                            <!-- <span class="phone_label">phone</span> -->
                                            <div>
                                                <textarea type="text" placeholder="{{ __('contact.Type your message here') }}" name="w3review" rows="4"
                                                    cols="50" ></textarea>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                    

                                   

                                <button class="su_Send_width">{{ __('contact.Send') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('web.includes.stay_upto_date')
@endsection

@section('script')
    <script>
          $(document).on('click','.form-label',function(){
            $(this).closest('input').focus()
            $(this).closest('.form-group').addClass('focused');
        })
        
        $('input').focus(function(){
        $(this).parents('.form-group').addClass('focused');
        });

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
    <script>
        style = [
            {
                "featureType": "administrative",
                "elementType": "geometry",
                "stylers": [{
                    "visibility": "off"
                }]
            },
            {
                "featureType": "poi",
                "stylers": [{
                    "visibility": "off"
                }]
            },
            {
                "featureType": "road",
                "elementType": "labels.icon",
                "stylers": [{
                    "visibility": "off"
                }]
            },
            {
                "featureType": "transit",
                "stylers": [{
                    "visibility": "off"
                }]
            }
        ];

        function initMap() {
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: {
                    lat: 52.0397702,
                    lng: 5.1462434
                },
                streetViewControl: false,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                disableDefaultUI: true,
                options: {
                    styles: style
                }
            });
            var marker = new google.maps.Marker({
                map: map,
                anchorPoint: new google.maps.Point(0, -29)
            });
            marker.setIcon(({
                url: BASEURL + '/assets/svg/marker.svg',
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));
            marker.setPosition({
                lat: 52.0397702,
                lng: 5.1462434
            });
            marker.setVisible(true);
        }
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{ env('GOOGLE_SITE_KEY') }}&callback=initMap"
        async defer></script>
@endsection
