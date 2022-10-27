<div class="child_first">
    <div class="d-flex align-items-center justify-content-between top_data">
        <div class="parcel">
            <figure class="mb-0">
                <img src="{{ asset('assets/svg/login.svg') }}" alt="group">
            </figure>
            <p class="mb-0 ms-2 primary-color ">
                Already have an account?
                <a href="{{ route('booking.pickup_address') }}" class="login_ancr orange-color ms-2">login</a>
                here
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
        <h6>Fill in your contact details</h6>
        <p class="mb-0 pl_des">How can we contact you? With these contact details we will keep you up to
            date on your transport.
            Enter your details here.</p>
        @include('web.includes.register')
    </div>
</div>
