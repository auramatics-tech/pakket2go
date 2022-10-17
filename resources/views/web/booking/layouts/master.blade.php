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
            console.log("{{ config('name') }}","key")
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

        function final_price($this) {
            var step = $this.attr('data-step');
            var option = $this.attr('data-option');
            console.log(step,option)

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
            $.ajax({
                url: BASEURL + '/api/booking',
                method: 'post',
                data: $('#booking_form').serialize(),
                success: function(data) {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    }
                }
            })
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
@endsection
