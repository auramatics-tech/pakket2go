@extends('web.user.layouts.master')

@section('content')
    <div class="d-flex flex-column flex-column-fluid" id="kt_content">

        <div class="toolbar su_padding_toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div class="su_cou_width_30">
                    <h3 class="Track_orders">Order Details</h3>
                </div>
                <div>
                    <a class="download_pdf_btn" href="{{ route('booking.invoice', ['id' => $booking->booking_code]) }}">Download Invoice</a>
                </div>
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="" class="su_container_dashboard">
                <div class="su_card_out_box">

                    <div class="su_card my-4">

                        <div class="su_flex_768_block justify-content-between">
                            <div class="su_order_width_20 su_order_width_sm">
                                <div class="su_details_img">
                                    <img src="{{ asset($booking->address->direction_image) }}" alt="">
                                </div>
                            </div>
                            <div class="su_order_width_80">
                                <div class="table-responsive">
                                    <table class="table w-100">
                                        <tr class="su_display_grid_sm">
                                            <td class="su_order_width_40">
                                                <div class="su_margin_left_15">
                                                    <h2 class="su_item_name_new">{{ $booking->booking_code }}<button
                                                            class="su_item_name_btn"><span
                                                                class="badge su_badges">0</span>{{ $booking->booking_status() }}</button>
                                                    </h2>
                                                    <p class="su_item_price_new">
                                                        €{{ number_format($booking->final_price, 2) }}</p>
                                                    <div class="d-flex align-items-center">
                                                        <img class="su_margin_x_20"
                                                            src="{{ asset('assets/svg/truck_svg.svg') }}" alt="">
                                                        <img class="su_margin_x_20"
                                                            src="{{ asset('assets/svg/person_with_order.svg') }}"
                                                            alt="">
                                                        <img class="su_margin_x_20"
                                                            src="{{ asset('assets/svg/order_loading.svg') }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="su_order_width_40">
                                                <div class="su_flex_column">
                                                    <div>
                                                        <div class="d-flex justify-content-between align_items-center">
                                                            <div class="su_order_details_text su_margin_y_12">
                                                                Distance ({{ $booking->address->distance }} Km)
                                                            </div>
                                                            <div class="su_order_details_text su_margin_y_12">€
                                                                {{ number_format($booking->distance_price, 2) }}
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-between align_items-center">
                                                            <div class="su_order_details_text su_margin_y_12">
                                                                {{ $booking->booking_data($booking_details, 'parcel_type', 'name') }}
                                                            </div>
                                                            <div class="su_order_details_text su_margin_y_12">€
                                                                {{ $booking->booking_data($booking_details, 'parcel_type', 'price') }}
                                                            </div>
                                                        </div>
                                                        @if (count($booking->booking_data($booking_details, 'parcel_details', 'name')))
                                                            @foreach ($booking->booking_data($booking_details, 'parcel_details', 'name') as $details)
                                                                <div
                                                                    class="d-flex justify-content-between align_items-center">
                                                                    <div class="su_order_details_text su_margin_y_12">
                                                                        {{ $details['name'] }}</div>
                                                                    <div class="su_order_details_text su_margin_y_12">€
                                                                        {{ $details['price'] }}
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                        <div class="d-flex justify-content-between align_items-center">
                                                            <div class="su_order_details_text su_margin_y_12">
                                                                {{ $booking->booking_data($booking_details, 'extra_help', 'name') }}
                                                            </div>
                                                            <div class="su_order_details_text su_margin_y_12">€
                                                                {{ $booking->booking_data($booking_details, 'extra_help', 'price') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="su_flex_768_block justify-content-between">
                            <div class="su_order_width_20"></div>
                            <div class="su_order_width_80">
                            <div class="su_order_width_100">
                                <div class="table-responsive">
                                    <table class="table w-100">
                                        <tr class="su_display_grid_sm">
                                            <td class="su_order_width_40">
                                                <div class="su_flex align-items-basline">
                                                    <div class="su_from_text su_margin_right_20 su_sm_ml">From >></div>
                                                    <div class="su_order_details_text">
                                                        {{ $booking->address->pickup_address }}</div>
                                                </div>
                                            </td>
                                            <td class="su_order_width_40">
                                                <div class=" su_flex_column">
                                                    @if ($booking->booking_data($booking_details, 'pickup_date', 'date'))
                                                        <div>
                                                            <div class="d-flex justify-content-between align_items-center">
                                                                <div class="su_order_details_text su_margin_y_12">
                                                                    {{ date('l, d F Y', strtotime($booking->booking_data($booking_details, 'pickup_date', 'date'))) }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if ($booking->booking_data($booking_details, 'extra_help', 'date'))
                                                        <div>
                                                            <div class="d-flex justify-content-between align_items-center">
                                                                <div class="su_order_details_text su_margin_y_12">
                                                                    {{ $booking->booking_data($booking_details, 'extra_help', 'name') }}
                                                                </div>
                                                            </div>
                                                            <div class="su_order_details_text su_margin_y_12">€
                                                                {{ number_format($booking->booking_data($booking_details, 'extra_help', 'price'), 2) }}
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if ($booking->booking_data($booking_details, 'pickup_floor', 'name'))
                                                        <div>
                                                            <div class="d-flex justify-content-between align_items-center">
                                                                <div class="su_order_details_text su_margin_y_12">
                                                                    {{ $booking->booking_data($booking_details, 'pickup_floor', 'name') }}
                                                                </div>
                                                                <div class="su_order_details_text su_margin_y_12">€
                                                                    {{ number_format($booking->booking_data($booking_details, 'pickup_floor', 'price'), 2) }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table w-100">
                                        <tr class="su_display_grid_sm">
                                            <td class="su_order_width_40">
                                                <div class="d-flex align-items-basline">
                                                    <div class="su_to_text su_margin_right_20 su_sm_ml">To >></div>
                                                    <div class="su_order_details_text">
                                                        {{ $booking->address->delivery_address }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="su_order_width_40">
                                                <div class=" su_flex_column">
                                                    @if ($booking->booking_data($booking_details, 'pickup_date', 'date'))
                                                        <div>
                                                            <div class="d-flex justify-content-between align_items-center">
                                                                <div class="su_order_details_text su_margin_y_12">
                                                                    {{ date('l, d F Y', strtotime($booking->booking_data($booking_details, 'pickup_date', 'date'))) }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if ($booking->booking_data($booking_details, 'delivery_floor', 'name'))
                                                        <div>
                                                            <div class="d-flex justify-content-between align_items-center">
                                                                <div class="su_order_details_text su_margin_y_12">
                                                                    {{ $booking->booking_data($booking_details, 'delivery_floor', 'name') }}
                                                                </div>
                                                                <div class="su_order_details_text su_margin_y_12">€
                                                                    {{ number_format($booking->booking_data($booking_details, 'delivery_floor', 'price'), 2) }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                            </div>
                        </div>
                        <hr>

                        <div class="d-flex justify-content-between">
                            <div class="su_order_width_20">
                            </div>
                            <div class="su_order_width_80">
                                <div class="table-responsive">
                                    <table class="table w-100">
                                        <tr class="su_display_grid_sm">
                                            <td class="su_order_width_40">

                                            </td>
                                            <td class="su_order_width_40">
                                                <div class="su_flex_column">
                                                    <div>
                                                        <div class="d-flex justify-content-between align_items-center">
                                                            <div class="su_total_details su_margin_y_12">Total Price</div>
                                                            <div class="su_total_details_price su_margin_y_12"><a
                                                                    href="{{ route('generatePDF') }}">€
                                                                    {{ number_format($booking->final_price, 2) }}</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
