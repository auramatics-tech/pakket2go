<div id="private_form">


    <div class="form-group des_textarea contact mt-4 su_padding_important_email">
        <label class="form-label" for="">Full name</label>
        <input class="su_hide_input" id="" class="form-input" placeholder="" value="{{ old('email') }}" type="text" />
        @error('full_name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group mt-4 row">
        <div class="col-6">

            <div class="form-group des_textarea contact su_padding_important_email">
                <label class="form-label" for="">Email</label>
                <input class="su_hide_input" id="" class="form-input" placeholder="" value="{{ old('email') }}" type="text" />
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

        </div>
        <input type="hidden" value="91" name="country_code">
        <div class="col-6">
            <div class="form-group">
                <form id="login" onsubmit="process(event)">
                    <input class="su_country_dropdown" id="phone" id="phone_number" type="tel" name="phone" value="{{ old('phone_number') }}" required />
                    @error('phone_number')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            {{--
            <div class="phone_input">
                <label for="phone" class="ms-3">
                    <input type="text" name="phone_number" id="phone_number" class="contact" placeholder="Phone" value="{{ old('phone_number') }}" required>
            </label>
            @error('phone_number')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        --}}
    </div>
</div>
<div class="form-group mt-4 row">
    <div class="col-6">
            <div class="form-group des_textarea phone_input">
                <label class="form-label" for="">Password</label>
                <input class="su_hide_input" id="" class="form-input" placeholder="" value="{{ old('email') }}" type="text" />
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    </div>
    <div class="col-6">

    <div class="form-group des_textarea phone_input">
                <label class="form-label" for="">Confirm Password</label>
                <input class="su_hide_input" id="" class="form-input" placeholder="" value="{{ old('email') }}" type="text" />
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

    </div>
</div>
</div>
