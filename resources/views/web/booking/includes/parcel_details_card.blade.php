@php
    $step_detail = implode('_', explode('-', $steps->url_code));
@endphp
@if ($step_detail == 'parcel_details')
    <div id="parcel_details_div">
        @foreach ($booking->booking_data($parcel_details, $step_detail, 'id') as $key => $parcel_details)
            <div class="d-flex justify-content-between" class="step_{{ $steps->id }}">
                <p id="info_name_{{ $steps->id }}">
                    {{ $parcel_details['name'] }}</p>
                <p id="info_price_{{ $steps->id }}" class="prices" data-price="{{ $parcel_details['price'] }}">
                    €
                    {{ $parcel_details['price'] }}</p>
            </div>
        @endforeach
    </div>
@elseif ($booking->booking_data($parcel_details, $step_detail, 'id'))
    <div class="d-flex justify-content-between" class="step_{{ $steps->id }}">
        <p id="info_name_{{ $steps->id }}">
            {{ $booking->booking_data($parcel_details, $step_detail, 'name') }}</p>
        <p id="info_price_{{ $steps->id }}" class="prices"
            data-price="{{ $booking->booking_data($parcel_details, $step_detail, 'price') }}">
            €
            {{ $booking->booking_data($parcel_details, $step_detail, 'price') }}</p>
    </div>
@endif
