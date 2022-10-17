<div class="child_first">
    <div class="d-flex align-items-center justify-content-between top_data">
        <div class="parcel">
            <figure class="mb-0">
                <img src="{{ asset('assets/svg/group.svg') }}" alt="group">
            </figure>
            <p class="mb-0 ms-2 primary-color ">
                Extra Help
            </p>
        </div>
        <div class="moreinfo">
            <figure>
                <img src="{{ asset('assets/svg/g_info.svg') }}" alt="info">
            </figure>
            <p class="mb-0 ms-2 primary-color ">
                More info
            </p>
        </div>
    </div>
    <form action="" id="booking_form" style="display: none" method="POST">
        @csrf
        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
        <input type="hidden" name="step" value="{{ $current_step->id }}">
        <input type="hidden" id="value_{{ $current_step->id }}" name="type_id"
            value="{{ $booking->booking_data($parcel_details, 'pickup_floor', 'id') }}">
    </form>yy
    <div class="card_data mt-4">
        <h6>Delivey: Where does everything go?</h6>
        <p class="mb-0 pl_des">The damage insurance applies from door to door and not indoord.</p>
        @php
            $type = 'delivery_';
        @endphp
        @if ($parcel_options)
            @foreach ($parcel_options as $options)
                @include('web.booking.includes.floor_card')
            @endforeach
        @endif
    </div>
</div>
