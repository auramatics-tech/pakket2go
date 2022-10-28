<div class="child_first">
    <div class="d-flex align-items-center justify-content-between top_data">
        <div class="parcel">
            <h6 class="mb-0 ct_h6">Pickup address contact details</h6>
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
        <p class="mb-0 pl_des">How can we contact you? With these contact details we will keep you up to
            date on your transport.
            Enter your details here.</p>
        <form action="" id="booking_form" class="row" method="post">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <input type="hidden" name="session_id" value="{{ Session::getId() }}">
            <input type="hidden" name="step" value="{{ $current_step->id }}">
            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
            <div class="col-6">
                <div class="form-group mt-4">
                    <input type="text" name="pickup_postcode" value="{{ isset($booking->address->pickup_postcode) ? $booking->address->pickup_postcode : '' }}" id="pickup_postcode" class="ct_input postal"
                        placeholder="Postal code">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group mt-4">
                    <input type="text" name="pickup_house_no" value="{{ isset($booking->address->pickup_house_no) ? $booking->address->pickup_house_no : '' }}" id="pickup_house_no" class="ct_input house" placeholder="House No.">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group mt-4">
                    <input type="text"  name="pickup_street" value="{{ isset($booking->address->pickup_street) ? $booking->address->pickup_street : '' }}" id="pickup_street" class="ct_input street" placeholder="Street">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group mt-4">
                    <input type="text"  name="pickup_locality" value="{{ isset($booking->address->pickup_locality) ? $booking->address->pickup_locality : '' }}" id="pickup_locality"class="ct_input locality"
                        placeholder="Locality">
                </div>
            </div>
            <div class="col-12">
                <div class="form-group mt-4">
                    <textarea name="pickup_additinal_info" rows="2" class="ct_input des_contact"
                        placeholder="Additional info for the courier at here">{{ isset($booking->address->pickup_additinal_info) ? $booking->address->pickup_additinal_info : '' }}</textarea>
                </div>
            </div>
            <h6 class="ct_h6 mt-3">What is the closing time?</h6>
            <p class="mb-0 ct_p">If this address is for a company</p>
            <div class="col-12">
                <div class="form-group mt-4">
                    <input type="time" name="pickup_closing_time" id="pickup_closing_time" value="{{ isset($booking->address->pickup_closing_time) ? $booking->address->pickup_closing_time : '' }}" class="ct_input time" placeholder="time">
                </div>
            </div>
            <h6 class="ct_h6 mt-3">Who can we get in touch with here?</h6>
            <p class="mb-0 ct_p">These pickup details can be adjusted later</p>
            <div class="col-6">
                <div class="form-group mt-4">
                    <input type="text" name="pickup_contact_name" id="pickup_contact_name" value="{{ isset($booking->address->pickup_contact_name) ? $booking->address->pickup_contact_name : '' }}" class="ct_input name" placeholder="Full name">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group mt-4">
                    <div class="phone_input">
                        <figure>
                            <img src="{{ asset('assets/img/flag.png') }}" alt="">
                        </figure>
                        <label for="phone" class="ms-3">
                            <span class="phone_label">phone</span>
                            <div class="d-flex">
                                <input type="text" class="number" name="pickup_contact_number" value="{{ isset($booking->address->pickup_contact_number) ? $booking->address->pickup_contact_number : '' }}" >
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
