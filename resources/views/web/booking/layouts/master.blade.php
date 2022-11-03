@extends('web.layouts.master')

@section('title')
    {{ 'Parcel Details - Booking - Pakket2Go' }}
@endsection

@section('style')
    @if ($current_step->id == 4)
        <link rel="stylesheet" href="{{ asset('assets/css/mobiscroll.jquery.min.css') }}">
    @endif
@endsection

@section('content')
    <div class="loading">Loading&#8230;</div>
    @if ($current_step->id != 1)
        <section class="courier_type_section">
            <div class="container d-flex">
                @include("web.booking.$current_step->url_code")
                @include('web.booking.includes.booking_info')
            </div>
        </section>
    @else
        @include("web.booking.$current_step->url_code")
    @endif
@endsection

@section('script')
    @if ($current_step->id == 1)
        <script>
            console.log("{{ config('name') }}", "key")
            var show_map = 1;
            var direction = 1;
        </script>
        <script src="{{ asset('assets/js/html2canvas.min.js') }}"></script>
        <script src="{{ asset('assets/js/common.js') }}"></script>
        <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{ env('GOOGLE_SITE_KEY') }}&callback=initMap"
            async defer></script>
    @endif

    @if ($current_step->id == 4)
        <script src="{{ asset('assets/js/mobiscroll.jquery.min.js') }}"></script>
        <script>
            mobiscroll.setOptions({
                locale: mobiscroll.localeEn,
                theme: 'ios',
                themeVariant: 'light'
            });

            $(function() {
                // Mobiscroll Calendar initialization
                $('#week').mobiscroll().datepicker({
                    controls: ['calendar'],
                    display: 'inline',
                    calendarType: 'week',
                    dayNamesShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                    calendarSize: 1
                });
            });
        </script>
    @endif

    <script>
        $(document).on('click', '.parcel_card, .es_card', function() {
            $('.parcel_card').removeClass('active');
            $('.es_card').removeClass('active');
            $(this).addClass('active')
            final_price($(this))
        })

        $(document).on('click', '.pay_card', function() {
            $('.pay_card').removeClass('active');
            $(this).addClass('active')

            $('#method').val($(this).attr('data-method'));
        })

        function final_price($this) {
            var step = $this.attr('data-step');
            var option = $this.attr('data-option');
            console.log(step, option)

            $('#info_name_' + step).html($('#name_' + step + '_' + option).html());
            $('#info_price_' + step).html('€ ' + $('#price_' + step + '_' + option).val());
            $('#info_price_' + step).attr('data-price', $('#price_' + step + '_' + option).val())

            $('#value_' + step).val(option)
            var price = 0.00;
            $('.prices').each(function() {
                price = parseFloat(price) + parseFloat($(this).attr('data-price'));
            })

            $('.final_price').html('€ ' + price.toFixed(2));
        }

        $('#booking_form').on('submit', function(e) {
            e.preventDefault();
            $('.loading').show();
            $.ajax({
                url: BASEURL + '/api/{{ App::getLocale() }}/booking',
                method: 'post',
                data: $('#booking_form').serialize(),
                success: function(data) {
                    if (data.success && data.redirect) {
                        window.location.href = data.redirect;
                    } else {
                        $('.loading').hide();
                        $('input').removeClass('is-invalid')
                        if (data.field_name == 'parcel_size') {

                        } else {
                            $(".border_bottom").css('border-top', '0.5px solid #D9D9D9')
                            $('input[name="' + data.field_name + '"]').addClass("is-invalid").focus();
                            $(".border_bottom").css('border-top', '0.5px solid red')
                        }
                    }
                }
            })
        })

        $(document).on("keyup", ".big_parcel_charges", function() {
            if ($(this).val() == 0) {
                $(this).val('')
            }

            var total_parcel_details = parseInt($('#parcel_details_main').attr('data-count'));
            console.log(total_parcel_details)
            $("#parcel_details_div").html('');
            for (var i = 0; i <= total_parcel_details; i++) {
                var height = $('#height_' + i).val();
                var width = $('#width_' + i).val();
                var length = $('#length_' + i).val();
                var name = height + 'x' + width + 'x' + length + 'cm';

                $("#parcel_details_div").append('<div class="d-flex justify-content-between">\n\
                                        <p">' + name + '</p>\n\
                                        <p class="prices" data-price="10">10</p></div>');
            }
        })

        $(document).on('click', '.continue_button', function() {
            $('#booking_form').submit();
        })

        $(document).on('click', '.date_card', function() {
            var date = $(this).attr('data-date');
            var date_view = $(this).attr('data-date-view');

            $('.date_card').removeClass('active');
            $(this).addClass('active')

            $("#pickup_date").val(date);
            $('#pickup_date_p').remove();
            $('#delivery_date_p').remove();

            $(".from_address_p").after('<p id="pickup_date_p">' + date_view + '</p>');
            $(".to_address_p").after('<p id="delivery_date_p">' + date_view + '</p>');
        })
    </script>


    @if ($current_step->id == 8)
        <script src="{{ asset('assets/js/login_register.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <script>
            var user_type = "{{ old('user_type') }}";
        </script>
        <script src="{{ asset('assets/js/register.js') }}"></script>
    @endif
@endsection
