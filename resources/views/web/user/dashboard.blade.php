@extends('web.user.layouts.master')

@section('content')
<div class="d-flex flex-column flex-column-fluid" id="kt_content">

    <div class="toolbar su_padding_toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div class="su_width_40">
                <h3 class="Track_orders">Track orders</h3>
            </div>
            <div class="su_width_60">
                <!-- <input class="su_dashboard_search su_search_filter_img" type="text" placeholder="Search..."> -->
                {{-- <img src="{{asset('assets/svg/search_filter.svg')}}" alt=""> --}}
                <div class="form-group su_search_border_style ">
                    <input class="su_search_border" id="" class="form-input" placeholder="search..." value="{{ old('email') }}" type="text" />
                    @error('full_name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
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
                                        <img src="{{ asset($booking->address->direction_image) }}" alt="">
                                    </div>
                                    <div class="su_margin_left_15">
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex  b">
                                                <h2 class="su_item_name mb-0">{{ $booking->booking_code }}</h2>
                                                <button class="su_item_name_btn">
                                                    <span class="badge su_badges">0</span>{{ $booking->booking_status() }}</button>
                                            </div>
                                            <div class="" style="">

                                            </div>
                                        </div>
                                        <p class="su_item_price">€{{ number_format($booking->final_price, 2) }}
                                        </p>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('assets/svg/order_date.svg') }}" alt="">
                                            <p class="su_item_date">Order date:
                                                {{ date('l, M d', strtotime($booking->created_at)) }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="ms-auto">
                                        <a class="su_item_name_btn" href="{{ route('booking.details',['id'=>$booking->booking_code]) }}">View Details</a>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex su_block_at_400 justify-content-between">
                                    <div class="d-flex align-items-center su_my_480 w-child-1">
                                        <img src="{{ asset('assets/svg/circle_circle.svg') }}" alt="">
                                        <p class="su_address_dashboard">{{ $booking->address->pickup_address }}
                                        </p>
                                        <div class="ms-auto img_hide_400">
                                             <img src="{{ asset('assets/svg/red_arrow.svg') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center su_my_480 w-child-2">
                                        <img src="{{ asset('assets/svg/location_dashboard.svg') }}" alt="">
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