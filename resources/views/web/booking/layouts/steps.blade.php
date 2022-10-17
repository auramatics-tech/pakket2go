<section id="sub_header">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between progress_bar_top">
            @if (count($booking_steps))
                @foreach ($booking_steps as $key => $step)
                    <div @if ($current_step->id >= $step->id) class="active" @endif>
                        <figure>
                            <img src="{{ asset('assets/svg/incompleted.svg') }}" alt="incompleted"
                                class="incompleted_style">
                            @if ($current_step->id > $step->id)
                                <img src="{{ asset('assets/svg/completed_step.svg') }}" alt="current" class="current_style">
                            @else
                                <img src="{{ asset('assets/svg/current.svg') }}" alt="current" class="current_style">
                            @endif
                            <img src="{{ asset('assets/svg/completed.svg') }}" alt="completed" class="completed_style">
                        </figure>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
