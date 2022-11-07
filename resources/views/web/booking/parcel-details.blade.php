<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
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
            $details = $parcel_details->parcel_details ? json_decode($parcel_details->parcel_details) : [];
        @endphp
        @if (isset($parcel_type->id) && $parcel_type->dimensions == 1)
            <h6>Fill in the dimensions and check the price</h6>
        @endif
        <form action="" method="POST" id="booking_form">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <input type="hidden" name="session_id" value="{{ Session::getId() }}">
            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
            <input type="hidden" name="step" value="{{ $current_step->id }}">
            <div id="parcel_details_main" data-count="{{ count($details) }}">
                @if (count($details))
                    @foreach ($details as $key => $detail)
                        @include('web.booking.includes.details')
                    @endforeach
                @else
                    @php
                        $key = 0;
                    @endphp
                    @include('web.booking.includes.details')
                @endif
            </div>
        </form>
        <div class="form-group last_div">
            <button type="button" class="primary_btn border-0" id="new_parcel_item">
                <div>
                    <figure>
                        <img src="{{ asset('assets/svg/plus.svg') }}" alt="plus">
                    </figure>
                </div>
                <p class="mb-0 text-white ms-2">Add Items</p>
            </button>
        </div>
    </div>
</div>
