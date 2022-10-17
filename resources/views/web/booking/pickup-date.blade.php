<div class="child_first">
    <div class="d-flex align-items-center justify-content-between top_data">
        <div class="parcel">

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

    <form action="" method="POST" id="booking_form">
        @csrf
        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
        <input type="hidden" name="step" value="{{ $current_step->id }}">
        <input type="hidden" name="pickup_date" id="pickup_date" value="{{ $booking->booking_data($parcel_details, 'pickup_date', 'date') }}">
        <div class="card_data mt-4">
            <h6>Pick-up: Select a date</h6>
            <div class="row mt-4">
                @php
                    $now = new DateTime();
                    $interval = new DateInterval('P1D'); // 1 Day interval
                    $period = new DatePeriod($now, $interval, 7); // 7 Days
                @endphp
                @foreach ($period as $key => $day)
                    <div class="col-6 mb-3" style="cursor: pointer">
                        <div data-date="{{ $day->format('Y-m-d') }}" data-date-view="{{ $day->format('l, d, F Y') }}" class="date_card @if($key == 0 && !$booking->booking_data($parcel_details, 'pickup_date', 'date')) active @elseif($booking->booking_data($parcel_details, 'pickup_date', 'date') == $day->format('Y-m-d')) active @endif">
                            <div class="d-flex align-items-center">
                                <figure>
                                    <img src="{{ asset('assets/svg/cal_circle.svg') }}" alt="cal">
                                </figure>
                                <h6 class="mb-0 ms-3">{{ $day->format('l, d, F Y') }}</h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </form>
</div>
