<div class="child_first">
    <div class="d-flex align-items-center justify-content-between top_data">
        <div class="parcel">
            <figure class="mb-0">
                <img src="{{ asset('assets/svg/accessibility.svg') }}" alt="accessibility">
            </figure>
            <p class="mb-0 ms-2 primary-color ">
            {{ __('booking.Service') }} 
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
    <div class="card_data mt-4">
        <form action="" id="booking_form" style="display: none" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <input type="hidden" name="session_id" value="{{ Session::getId() }}">
            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
            <input type="hidden" name="step" value="{{ $current_step->id }}">
            <input type="hidden" id="value_{{ $current_step->id }}" name="type_id" value="{{ $booking->booking_data($parcel_details, 'pickup_extra_help' ,'id') }}">
        </form>
        <h6>{{ __('booking.Need extra help') }}</h6>
        @if (count($parcel_options['popular']))
            <p class="mb-0 pl_des">{{ __('booking.Most popular option') }}</p>
            @foreach ($parcel_options['popular'] as $options)
                @include('web.booking.includes.help_card')
            @endforeach
        @endif
        @if (count($parcel_options['other']))
            <p class="mb-0 pl_des mt-5">{{ __('booking.Other option') }}</p>
            @foreach ($parcel_options['other'] as $options)
                @include('web.booking.includes.help_card')
            @endforeach
        @endif
    </div>
</div>
