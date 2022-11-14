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
            {{ __('booking.More info') }}
            </p>
        </div>
    </div>
    <form action="" id="booking_form" style="display: none" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <input type="hidden" name="session_id" value="{{ Session::getId() }}">
        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
        <input type="hidden" name="step" value="{{ $current_step->id }}">
        <input type="hidden" id="value_{{ $current_step->id }}" name="type_id" value="{{ $booking->booking_data($parcel_details, 'parcel_type' ,'id') }}">
    </form>
    <div class="card_data mt-4">
        <h6> {{ __('booking.Select your parcel type') }}</h6>
        <p class="mb-0 pl_des">{{ __('booking.Price varies in different type of parcel') }}</p>
        <div class="row mt-5">
            @if ($parcel_options)
                @foreach ($parcel_options as $options)
                    <div class="col-xl-6 col-12 mb-3">
                        <div data-step="{{ $current_step->id }}" data-option="{{ $options->id }}"
                            class="card parcel_card @if ($options->default && !$booking->booking_data($parcel_details, 'parcel_type' ,'id')) active @elseif($booking->booking_data($parcel_details, 'parcel_type' ,'id') == $options->id) active @endif">
                            <div class="parcel_img mb-3">
                                <figure class="mx-auto">
                                    <img src="{{ asset($options->image) }}" alt="home">
                                </figure>
                            </div>
                            <div class="desc">
                                <h6 class="mb-2" id="name_{{ $current_step->id }}_{{ $options->id }}">
                                    {{ json_decode($options->name)->{App::getLocale()} }}</h6>
                                <p class="mb-4">{{ json_decode($options->description)->{App::getLocale()} }}</p>
                                <input type="hidden" id="price_{{ $current_step->id }}_{{ $options->id }}"
                                    value="{{ number_format($options->price, 2) }}">
                            </div>
                            <div class="price">
                                <a href="#">
                                    <span>+ €{{ $options->price }}</span>
                                    <span class="text-white">&gt;</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
