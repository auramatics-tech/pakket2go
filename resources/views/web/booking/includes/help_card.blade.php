<div style="cursor: pointer" data-step="{{ $current_step->id }}" data-option="{{ $options->id }}" class="es_card mt-3 @if ($options->default == 1 && !$booking->booking_data($parcel_details, 'extra_help', 'id')) active @elseif($booking->booking_data($parcel_details, 'extra_help', 'id') == $options->id) active @endif">
    <div class="d-flex align-items-center">
        <figure>
            <img src="{{ asset('assets/svg/user_circle.svg') }}" alt="cal">
        </figure>
        <div class="ms-3">
            <h6 class="mb-0" id="name_{{ $current_step->id }}_{{ $options->id }}">{{ json_decode($options->name)->{App::getLocale()} }}</h6>
            <p class="mb-0 my_para">{{ json_decode($options->description)->{App::getLocale()} }}</p>
        </div>
        <input type="hidden" name="" value="{{ number_format($options->price, 2) }}" id="price_{{ $current_step->id }}_{{ $options->id }}">
    </div>
    <p class="mb-0"><span class="price">€ {{ number_format($options->price, 2) }}</span><span class="ms-3 font_angle"><i
                class="fa-solid fa-angle-right"></i></span></p>
</div>
