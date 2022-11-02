<section id="sub_header">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between progress_bar_top">
            @php
                $skip_steps = [];
                if (!empty($parcel_details)) {
                    $parcel_type = $booking->booking_data($parcel_details, 'parcel_type', 'id');
                    $skip_steps = json_decode(
                        \App\Models\ParcelOption::where('id', $parcel_type)
                            ->pluck('skip_steps')
                            ->first(),
                    );
                }
                // echo Auth::guard('web')->user()->user_type;
            @endphp
            @if (count($booking_steps))
                @foreach ($booking_steps as $key => $step)
                    @php
                        if ($step->id == 8 && isset(Auth::guard('web')->user()->id)) {
                            $skip_steps[] = 8;
                        }
                        if ($step->id == 11 && isset(Auth::guard('web')->user()->id) && Auth::guard('web')->user()->user_type == 'business') {
                            $skip_steps[] = 11;
                        }
                    @endphp
                    @if (empty($skip_steps) || !in_array($step->id, $skip_steps))
                        <div @if ($current_step->id >= $step->id) class="active" @endif>
                            <figure>
                                <img src="{{ asset('assets/svg/incompleted.svg') }}" alt="incompleted"
                                    class="incompleted_style">
                                @if ($current_step->id > $step->id)
                                    <img src="{{ asset('assets/svg/completed_step.svg') }}" alt="current"
                                        class="current_style">
                                @else
                                    <img src="{{ asset('assets/svg/current.svg') }}" alt="current"
                                        class="current_style">
                                @endif
                                <img src="{{ asset('assets/svg/completed.svg') }}" alt="completed"
                                    class="completed_style">
                            </figure>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</section>
