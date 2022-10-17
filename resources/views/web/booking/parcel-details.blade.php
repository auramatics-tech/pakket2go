<div class="child_first">
    <div class="d-flex align-items-center justify-content-between top_data">
        <div class="parcel">
            <figure class="mb-0">
                <img src="{{ asset('assets/svg/inventory.svg') }}" alt="inventory">
            </figure>
            <p class="mb-0 ms-2 primary-color ">
                {{ __("booking.$current_step->name") }}
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
    <div class="card_data mt-4">
        @php
            $parcel_type = App\Models\ParcelOption::find($booking->booking_data($parcel_details, 'parcel_type', 'id'));
            $details = json_decode($parcel_details->parcel_details);
        @endphp
        @if (isset($parcel_type->id) && $parcel_type->dimensions == 1)
            <h6>Fill in the dimensions and check the price</h6>
        @endif
        <form action="" method="POST" id="booking_form">
            @csrf
            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
            <input type="hidden" name="step" value="{{ $current_step->id }}">
            @if (count($details))
                @foreach ($details as $detail)
                    @include('web.booking.includes.details')
                @endforeach
            @else
                @include('web.booking.includes.details')
            @endif
        </form>
    </div>
</div>
