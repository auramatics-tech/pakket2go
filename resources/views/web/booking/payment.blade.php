<div class="child_first">
    <div class="d-flex align-items-center justify-content-between top_data">
        <div class="parcel">
            <figure class="mb-0">
                <img src="{{ asset('assets/svg/credit_card.svg') }}" alt="credit_card">
            </figure>
            <p class="mb-0 ms-3 primary-color ">
                It’s really easy
            </p>
        </div>
        <div class="moreinfo">
            <figure>
                <img src="{{ asset('assets/svg/g_info.svg') }}" alt="info">
            </figure>
            <p class="mb-0 ms-2 primary-color">
                More info
            </p>
        </div>
    </div>
    <form action="" id="booking_form" style="display: none" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <input type="hidden" name="session_id" value="{{ Session::getId() }}">
        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
        <input type="hidden" name="step" value="{{ $current_step->id }}">
        <input type="hidden" name="method" value="" id="method">
    </form>
    <div class="payment_card_data mt-4">
        <h6 class="mb-0 ct_h6">Select your payment method</h6>
        <div class="row mt-3">
            @if (count($payment_methods))
                @foreach ($payment_methods as $key =>  $payment_method)
                    <div class="col-6 mt-4">
                        <div class="pay_card @if($key == 0) active @endif" data-method="{{ $payment_method->description }}">
                            <div class="img">
                                <figure>
                                    <img src="{{ $payment_method->image->svg }}" alt="">
                                </figure>
                            </div>
                            <div class="text">
                                <h6 class="mb-0">{{ $payment_method->description }}</h6>
                            </div>
                            <div class="button">
                                <i class="fa-solid fa-angle-right"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
