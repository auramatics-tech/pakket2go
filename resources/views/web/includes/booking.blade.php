<form action="{{ route('booking', ['step' => 'address']) }}" class="w-100 mx-auto">
    <div class="d-lg-flex align-items-center justify-content-between ps-lg-3 pe-lg-2">
        <div class="form-group border-right wf-35">
            <label for="" class="d-flex align-items-center">
                <span>
                    <img src="{{ asset('assets/svg/form.svg') }}" alt="form">
                </span>
                <b class="ms-3 me-1">{{ __('home.From') }}</b>
                <input class="form-control border-0 ad_input searchInput" type="text" name="from"
                    placeholder="{{ __('home.Enter locality or address') }}" id="searchInput_from">
            </label>
        </div>
        <div class="form-group wf-35">
            <label for="" class="d-flex align-items-center">
                <span>
                    <img src="{{ asset('assets/svg/to.svg') }}" alt="to">
                </span>
                <b class="ms-3 me-1">{{ __('home.To') }}</b>
                <input class="form-control border-0 ad_input searchInput" type="text" name="to"
                    placeholder="{{ __('home.Enter locality or address') }}" id="searchInput_to">
            </label>
        </div>
        <div class="form-group wf-25">
            <button type="submit"
                class="d-flex align-items-center submit border-0 calculate">{{ __('home.Calculate Price') }}
                <span class="ms-2 angle_icon"> &gt;&gt;</span></button>
        </div>
    </div>
</form>
