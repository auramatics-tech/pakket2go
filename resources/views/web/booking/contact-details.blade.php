<div class="child_first">
    <div class="d-flex align-items-center justify-content-between top_data">
        <div class="parcel">
            <figure class="mb-0">
                <img src="{{ asset('assets/svg/login.svg') }}" alt="group">
            </figure>
            <p class="mb-0 ms-2 primary-color ">
            {{ __('booking.Already have an account?') }}
                <a href="{{ route('booking.pickup_address') }}" class="login_ancr orange-color ms-2">{{ __('booking.login') }}</a>
                {{ __('booking.here') }}
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
        <h6>{{ __('booking.Fill in your contact details') }}</h6>
        <p class="mb-0 pl_des">{{ __('booking.Contact_details') }}</p>
        @include('web.includes.register')
    </div>
</div>
