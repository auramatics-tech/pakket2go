    <section class="map_section">
        <div class="container mob_px">
            <div class="form_pos">
                <form action="" id="booking_form" class="w-100 mx-auto" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <input type="hidden" name="session_id" value="{{ Session::getId() }}">
                    <div class="map_form">
                        <div class="top_div">
                            <div class="form-group">
                                <label for="" class="d-flex align-items-center">
                                    <span>
                                        <img src="{{ asset('assets/svg/form.svg') }}" alt="form">
                                    </span>
                                    <input class="form-control border-0 ad_input searchInput" type="text"
                                        name="pickup_address" placeholder="{{ __('home.Enter locality or address') }}"
                                        id="searchInput_from" value="{{ isset($booking->address->pickup_address) ? $booking->address->pickup_address : request()->from }}">
                                </label>
                            </div>
                            <hr class="border_bottom">
                            <div class="form-group">
                                <label for="" class="d-flex align-items-center">
                                    <span>
                                        <img src="{{ asset('assets/svg/to.svg') }}" alt="to">
                                    </span>
                                    <input class="form-control border-0 ad_input searchInput" type="text"
                                        name="delivery_address" placeholder="{{ __('home.Enter locality or address') }}"
                                        id="searchInput_to" value="{{ isset($booking->address->delivery_address) ? $booking->address->delivery_address :  request()->to }}">
                                </label>
                            </div>
                        </div>
                        <div class="form-group z-index-3 d-none d-md-block d-lg-block">
                            <button type="submit"
                                class="d-flex align-items-center submit border-0 continue ms-auto">{{ __('booking.Continue') }}<span
                                    class="ms-2 angle_icon"> &gt;&gt;</span></button>
                        </div>
                        <div class="floating_btn d-block d-md-none d-lg-none text-center">
                            <button type="submit"
                                class="d-flex align-items-center submit border-0 continue ms-auto footer_btn">{{ __('booking.Continue') }}<span
                                    class="ms-2 angle_icon"> &gt;&gt;</span></button>
                        </div>
                    </div>
                    <input type="hidden" name="step" value="{{ $current_step->id }}">
                    <input type="hidden" name="pickup_postcode" value="{{ isset($booking->address->pickup_postcode) ? $booking->address->pickup_postcode : '' }}" id="pickup_postcode">
                    <input type="hidden" name="pickup_house_no" value="{{ isset($booking->address->pickup_house_no) ? $booking->address->pickup_house_no : '' }}" id="pickup_house_no">
                    <input type="hidden" name="pickup_street" value="{{ isset($booking->address->pickup_street) ? $booking->address->pickup_street : '' }}" id="pickup_street">
                    <input type="hidden" name="pickup_locality" value="{{ isset($booking->address->pickup_locality) ? $booking->address->pickup_locality : '' }}" id="pickup_locality">
                    <input type="hidden" name="pickup_lat" value="{{ isset($booking->address->pickup_lat) ? $booking->address->pickup_lat : '' }}" id="pickup_lat">
                    <input type="hidden" name="pickup_lng" value="{{ isset($booking->address->pickup_lng) ? $booking->address->pickup_lng : '' }}" id="pickup_lng">
                    <input type="hidden" name="booking_id" value="{{ isset($booking->id) ? $booking->id : '' }}" id="booking_id">
                    <input type="hidden" name="delivery_postcode" value="{{ isset($booking->address->delivery_postcode) ? $booking->address->delivery_postcode : '' }}" id="delivery_postcode">
                    <input type="hidden" name="delivery_house_no" value="{{ isset($booking->address->delivery_house_no) ? $booking->address->delivery_house_no : '' }}" id="delivery_house_no">
                    <input type="hidden" name="delivery_street" value="{{ isset($booking->address->delivery_street) ? $booking->address->delivery_street : '' }}" id="delivery_street">
                    <input type="hidden" name="delivery_locality" value="{{ isset($booking->address->delivery_locality) ? $booking->address->delivery_locality : '' }}" id="delivery_locality">
                    <input type="hidden" name="delivery_lat" value="{{ isset($booking->address->delivery_lat) ? $booking->address->delivery_lat : '' }}" id="delivery_lat">
                    <input type="hidden" name="delivery_lng" value="{{ isset($booking->address->delivery_lng) ? $booking->address->delivery_lng : '' }}" id="delivery_lng">
                    <input type="hidden" name="distance" value="{{ isset($booking->address->distance) ? $booking->address->distance : '' }}" id="address_distance">
                </form>
            </div>
            <div id="map"></div>
        </div>
    </section>
