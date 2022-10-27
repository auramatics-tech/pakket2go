<div class="form-group des_textarea contact mt-4 su_padding_important_email">
    <label class="form-label" for="">Full name</label>
    <input class="su_hide_input" id="" class="form-input" placeholder="" value="{{ old('email') }}" type="text" />
    @error('full_name')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="mt-4 row">
    <div class="col-6">
        <div class="form-group des_textarea contact su_padding_important_email">
            <label class="form-label" for="">Email</label>
            <input class="su_hide_input" id="" class="form-input" placeholder="" value="{{ old('email') }}" type="text" />
        </div>
        @error('email')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <input type="hidden" value="91" name="country_code">
    <div class="col-6">
        <div class="form-group">
            <input class="su_country_dropdown" id="phone" id="phone_number" type="tel" name="phone" value="{{ old('phone_number') }}" required />
        </div>
        @error('phone_number')
            <span class="text-danger">{{ $message }}</span>
            @enderror
    </div>
</div>
<div class="mt-4 row">
    <div class="col-6">
        <div class="form-group des_textarea phone_input">
            <label class="form-label" for="">Password</label>
            <input class="su_hide_input" id="" name="password" class="form-input" placeholder="" value="" type="password" />
        </div>
        @error('password')
            <span class="text-danger">{{ $message }}</span>
            @enderror
    </div>
    <div class="col-6">
        <div class="form-group des_textarea phone_input">
            <label class="form-label" for="">Confirm Password</label>
            <input class="su_hide_input" id="" name="password_confirmation" class="form-input" placeholder="" value="" type="password" />
         
        </div>
        @error('password_confirmation')
            <span class="text-danger">{{ $message }}</span>
            @enderror

    </div>
</div>