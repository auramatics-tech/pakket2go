<div class="child_second">
    <div>
        <div class="map_frame">
            <div id="map"></div>
        </div>
        <div class="content_total mt-4">
            <span class="from orange-color">From &gt;&gt;</span>
            <p class="mt-3 from_address_p">
                {{ isset($booking->address->pickup_address) ? $booking->address->pickup_address : '' }}</p>
            @if (isset($parcel_details->id) && $booking->booking_data($parcel_details, 'pickup_date', 'date'))
                <p id="pickup_date_p">
                    {{ date('l, d, F Y', strtotime($booking->booking_data($parcel_details, 'pickup_date', 'date'))) }}
                </p>
            @endif
            @if (isset($parcel_details->id) && $booking->booking_data($parcel_details, 'pickup_floor', 'name'))
                <div class="d-flex justify-content-between" class="step_5">
                    <p id="info_name_6">{{ $booking->booking_data($parcel_details, 'pickup_floor', 'name') }}</p>
                    <p id="info_price_6" class="prices" data-price="{{ number_format($booking->booking_data($parcel_details, 'pickup_floor', 'price'), 2) }}">€
                        {{ number_format($booking->booking_data($parcel_details, 'pickup_floor', 'price'), 2) }}</p>
                </div>
            @endif
            <span class="to primary-color">To &gt;&gt;</span>
            <p class="mt-3 to_address_p">
                {{ isset($booking->address->delivery_address) ? $booking->address->delivery_address : '' }}
            </p>
            @if (isset($parcel_details->id) && $booking->booking_data($parcel_details, 'pickup_date', 'date'))
                <p id="delivery_date_p">
                    {{ date('l, d, F Y', strtotime($booking->booking_data($parcel_details, 'pickup_date', 'date'))) }}
                </p>
            @endif
            @if (isset($parcel_details->id) && $booking->booking_data($parcel_details, 'delivery_floor', 'name'))
                <div class="d-flex justify-content-between">
                    <p id="info_name_7">{{ $booking->booking_data($parcel_details, 'delivery_floor', 'name') }}</p>
                    <p id="info_price_7" class="prices" data-price="{{ number_format($booking->booking_data($parcel_details, 'delivery_floor', 'price'), 2) }}">€
                        {{ number_format($booking->booking_data($parcel_details, 'delivery_floor', 'price'), 2) }}</p>
                </div>
            @endif
            <span><b>Package Details &gt;&gt;</b></span>
            <div class="total mt-3">
                <div class="d-flex justify-content-between">
                    <p>Distance ({{ $booking->address->distance }} Km)</p>
                    <p class="prices" data-price="{{ number_format($booking->distance_price, 2) }}">€
                        {{ number_format($booking->distance_price, 2) }}</p>
                </div>
                @if (isset($parcel_details->id))
                    @if (count($booking_steps))
                        @foreach ($booking_steps as $steps)
                            @if($steps->id < 6)
                                @include('web.booking.includes.parcel_details_card')
                            @endif
                        @endforeach
                    @endif
                @endif
                <hr>
                <div class="d-flex justify-content-between final">
                    <p>Total Price</p>
                    <p><b class="final_price">€ {{ number_format($booking->final_price, 2) }}</b></p>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom_child">
        <button class="border-0 button continue_button" type="button">
            <div class="price_btn">
                <span class="final_price">€ {{ number_format($booking->final_price, 2) }}</span>
            </div>
            <p class="mb-0 text-white me-3">
                Continue
                <span class="angle_bot"><i class="fa-solid fa-angle-right"></i><i
                        class="fa-solid fa-angle-right"></i></span>
            </p>
        </button>
        <div class="floating_btn d-block d-md-none d-lg-none text-center">
            <button class="border-0 button continue_button" type="button">
                <div class="price_btn">
                    <span class="final_price">€ {{ number_format($booking->final_price, 2) }}</span>
                </div>
                <p class="mb-0 text-white me-3">
                    Continue
                    <span class="angle_bot"><i class="fa-solid fa-angle-right"></i><i
                            class="fa-solid fa-angle-right"></i></span>
                </p>
            </button>
        </div>
    </div>
</div>
