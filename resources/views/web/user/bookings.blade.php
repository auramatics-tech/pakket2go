@extends('web.user.layouts.master')

@section('content')
    <div class="d-flex flex-column flex-column-fluid" id="kt_content">

        <div class="toolbar su_padding_toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div class="su_width_40">
                    @if (Auth::user()->user_type == 'courier')
                        @if (Route::is('dashboard'))
                            <h3 class="Track_orders">Active Jobs</h3>
                            <p class="su_available_deliveries">Total available deliveries:
                                <span><b>{{ count($bookings) }}</b></span>
                            </p>
                        @else
                            <h3 class="Track_orders">My Deliveries</h3>
                            <p class="su_available_deliveries">Total earnings:
                                <span><b>€ {{ number_format($total_earnings, 2) }}</b></span>
                            </p>
                        @endif
                    @else
                        <h3 class="Track_orders">Track Orders</h3>
                    @endif
                </div>
                <div class="su_cou_width_70">
                    <form action="">
                        <div class="su_border_Courier_page su_courier_form_flex">
                            <div class="su_border_right su_block_1167">
                                <label for="" class="d-flex align-items-center">
                                    <span class="su_mr_5">
                                        <img src="{{ asset('assets/svg/courier_location.svg') }}" alt="form">
                                    </span>

                                    <input class="form-control border-0 ad_input searchInput placeholder_courier"
                                        type="text" name="from" placeholder="Find Address" id="searchInput_from">
                                </label>
                            </div>
                            <div class="su_border_right su_block_1167">
                                <label for="" class="d-flex align-items-center">
                                    <span class="su_mr_5">
                                        <img src="{{ asset('assets/svg/courier_Packing.svg') }}" alt="form">
                                    </span>

                                    <input class="form-control border-0 ad_input searchInput placeholder_courier"
                                        type="text" name="from" placeholder="Packing type" id="searchInput_from">
                                </label>
                            </div>
                            <div class="su_block_1167">
                                <label for="" class="d-flex align-items-center">
                                    <span class="su_mr_5">
                                        <img src="{{ asset('assets/svg/courier_delivery.svg') }}" alt="form">
                                    </span>

                                    <input class="form-control border-0 ad_input searchInput placeholder_courier"
                                        type="text" name="from" placeholder="Delivery Date" id="searchInput_from">
                                </label>
                            </div>
                            <div class="su_courier_search_pt su_block_1167"><a class="su_courier_search"
                                    href="">search</a></div>

                            <div class=""><a class="su_courier_search_filter" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" href="">search filter</a></div>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Filter</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="su_border_right">
                                                <label for="" class="d-flex align-items-center">
                                                    <span class="su_mr_5">
                                                        <img src="{{ asset('assets/svg/courier_location.svg') }}"
                                                            alt="form">
                                                    </span>

                                                    <input
                                                        class="form-control border-0 ad_input searchInput placeholder_courier"
                                                        type="text" name="from" placeholder="Find Address"
                                                        id="searchInput_from">
                                                </label>
                                            </div>
                                            <div class="su_border_right">
                                                <label for="" class="d-flex align-items-center">
                                                    <span class="su_mr_5">
                                                        <img src="{{ asset('assets/svg/courier_Packing.svg') }}"
                                                            alt="form">
                                                    </span>

                                                    <input
                                                        class="form-control border-0 ad_input searchInput placeholder_courier"
                                                        type="text" name="from" placeholder="Packing type"
                                                        id="searchInput_from">
                                                </label>
                                            </div>
                                            <div>
                                                <label for="" class="d-flex align-items-center">
                                                    <span class="su_mr_5">
                                                        <img src="{{ asset('assets/svg/courier_delivery.svg') }}"
                                                            alt="form">
                                                    </span>

                                                    <input
                                                        class="form-control border-0 ad_input searchInput placeholder_courier"
                                                        type="text" name="from" placeholder="Delivery Date"
                                                        id="searchInput_from">
                                                </label>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <div class="su_courier_search_pt"><a class="su_courier_search"
                                                    href="">search</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="" class="su_container_dashboard">
                <div class="su_card_out_box">
                    @if (count($bookings))
                        @foreach ($bookings as $booking)
                            <div class="su_card_dashboard my-4">
                                <div class="su_card">
                                    <div class="d-flex su_block_in_1200 justify-content-between align-items-center">
                                        <div class="w-100">
                                            <div class="su_flex_block_at_767">
                                                <div class="su_item_img">
                                                    <img src="{{ asset($booking->address->direction_image) }}"
                                                        alt="">
                                                </div>
                                                <div class="su_margin_left_15">
                                                    <div class="d-flex align-items-center">
                                                        <div class="d-flex  b">
                                                            <h2 class="su_item_name mb-0">{{ $booking->booking_code }}</h2>
                                                            <button class="su_item_name_btn">
                                                                <span
                                                                    class="badge su_badges">0</span>{{ $booking->booking_status() }}</button>
                                                        </div>
                                                        <div class="" style="">

                                                        </div>
                                                    </div>
                                                    <p class="su_item_price">
                                                        €{{ Auth::user()->user_type == 'courier' && Auth::user()->id != $booking->id ? number_format($booking->courier_price, 2) : number_format($booking->final_price, 2) }}
                                                    </p>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('assets/svg/order_date.svg') }}"
                                                            alt="">
                                                        <p class="su_item_date">Order date:
                                                            {{ date('l, M d', strtotime($booking->created_at)) }}
                                                        </p>
                                                    </div>
                                                </div>
                                                @if (Auth::user()->user_type == 'courier' && $booking->status >= 2 && $booking->status < 5)
                                                    @php
                                                        $status = $booking->status + 1;
                                                        $next_status = App\Models\BookingStatus::find($status);
                                                    @endphp
                                                    <div class="mt_1257">
                                                        <a class="su_cou_apply_now courier_job" href="javascript:void(0);"
                                                            data-id="{{ $booking->id }}"
                                                            data-status="{{ strtolower($next_status->status_type) }}">
                                                            @if ($booking->status == 2)
                                                                Apply Now >>
                                                            @else
                                                                {{ ucfirst($next_status->status) }} >>
                                                            @endif
                                                        </a>
                                                    </div>
                                                @endif
                                                <div class="ms-auto">
                                                    <a class="su_item_name_btn"
                                                        href="{{ route('booking.details', ['id' => $booking->booking_code]) }}">View
                                                        Details</a>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="d-flex su_block_at_400 justify-content-between">
                                                <div class="d-flex align-items-center su_my_480 w-child-1">
                                                    <img src="{{ asset('assets/svg/circle_circle.svg') }}"
                                                        alt="">
                                                    <p class="su_address_dashboard">
                                                        {{ $booking->address->pickup_address }}
                                                    </p>
                                                    <div class="ms-auto img_hide_400">
                                                        <img src="{{ asset('assets/svg/red_arrow.svg') }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center su_my_480 w-child-2">
                                                    <img src="{{ asset('assets/svg/location_dashboard.svg') }}"
                                                        alt="">
                                                    <p class="su_address_dashboard">
                                                        {{ $booking->address->delivery_address }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
