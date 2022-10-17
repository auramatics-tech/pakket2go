<div class="es_card mt-3 @if ($options->default && !$booking->booking_data($parcel_details, $type.'floor' ,'id')) active @elseif($booking->booking_data($parcel_details, $type.'floor' ,'id') == $options->id) active @endif" data-step="{{ $current_step->id }}" data-option="{{ $options->id }}">
    <div class="d-flex align-items-center">
        <figure>
            <img src="{{ asset($options->image) }}" alt="cal">
        </figure>
        <div class="ms-3">
            <h6 class="mb-0" id="name_{{ $current_step->id }}_{{ $options->id }}">{{ json_decode($options->name)->{App::getLocale()} }}</h6>
            <p class="mb-0 my_para">{{ json_decode($options->description)->{App::getLocale()} }}</p>
        </div>
    </div>
    <input type="hidden" name="" value="{{ number_format($options->price, 2) }}" id="price_{{ $current_step->id }}_{{ $options->id }}">
    <p class="mb-0"><span class="price @if($options->price) plus_price @endif">€ {{ number_format($options->price,2) }}</span><span class="ms-3 font_angle"><i
                class="fa-solid fa-angle-right"></i></span></p>
</div>