<div class="form-group des_textarea contact mt-4 su_padding_important_email">
    <label class="form-label" for="">Company name</label>
    <input class="su_hide_input" type="text" name="name" id="kvkcompanyname" class="form-input" placeholder=""
        value="{{ old('name') }}" type="text" />
  
</div>
@error('name')
        <span class="text-danger">{{ $message }}</span>
    @enderror
<div class="mt-4 row">
    <div class="col-6">
        <div class="form-group des_textarea contact su_padding_important_email">
            <label class="form-label" for="">First name</label>
            <input class="su_hide_input" name="first_name" type="text" id="" class="form-input"
                placeholder="" value="{{ old('first_name') }}" type="text" />
           
        </div>
        @error('first_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
    </div>
    <div class="col-6">
        <div class="form-group des_textarea contact su_padding_important_email">
            <label class="form-label" for="">Last name</label>
            <input class="su_hide_input" name="last_name" type="text" id="" class="form-input"
                placeholder="" value="{{ old('last_name') }}" type="text" />
           
        </div>
        @error('last_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
    </div>
</div>
<div class="mt-4 row">
    <div class="col-6">
        <div class="form-group des_textarea email su_padding_important_email">
            <label class="form-label" for="">Email</label>
            <input class="su_hide_input" name="email" type="text" id="" class="form-input" placeholder=""
                value="{{ old('email') }}" type="text" />
            
        </div>
        @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
    </div>
    <input type="hidden" name="country_code" value="31" id="country_code">
    <div class="col-6">
        <div class="form-group">
            <input class="su_country_dropdown" id="phone" id="phone_number" type="tel" name="phone_number"
                value="{{ old('phone_number') }}" required />
           
        </div>
        @error('phone_number')
                <span class="text-danger">{{ $message }}</span>
            @enderror

    </div>
</div>
<div class="mt-4 row">
    <div class="col-6">

        <div class="form-group des_textarea contact su_padding_important_email">
            <label class="form-label" for="">Street </label>
            <input class="su_hide_input" name="street" type="text" id="street" class="form-input" placeholder=""
                value="{{ old('street') }}" type="text" />
           
        </div>
        @error('street')
                <span class="text-danger">{{ $message }}</span>
            @enderror
    </div>
    <div class="col-6">
        <div class="form-group des_textarea contact su_padding_important_email">
            <label class="form-label" for="">House No </label>
            <input class="su_hide_input" name="house_no" type="text" id="housenumber" class="form-input" placeholder=""
                value="{{ old('house_no') }}" type="text" />
           
        </div>
        @error('house_no')
                <span class="text-danger">{{ $message }}</span>
            @enderror
    </div>
</div>
<div class="mt-4 row">
    <div class="col-6">
        <div class="form-group des_textarea contact su_padding_important_email">
            <label class="form-label" for="">House No Extension </label>
            <input class="su_hide_input" name="house_no_extension" type="text" id="houseletter" class="form-input"
                placeholder="" value="{{ old('house_no_extension') }}" type="text" />
           
        </div>
        @error('house_no_extension')
                <span class="text-danger">{{ $message }}</span>
            @enderror
    </div>
    <div class="col-6">
        <div class="form-group des_textarea contact su_padding_important_email">
            <label class="form-label" for="">KVK No </label>
            <input class="su_hide_input" name="kvk_no" type="text" id="kvknumber" class="form-input"
                placeholder="" value="{{ old('kvk_no') }}" type="text" />
          
        </div>
        @error('kvk_no')
                <span class="text-danger">{{ $message }}</span>
            @enderror
    </div>
</div>
<div class="mt-4 row">
    <div class="col-6">
        <div class="form-group des_textarea contact su_padding_important_email">
            <label class="form-label" for="">City </label>
            <input class="su_hide_input" name="city" type="text" id="city" class="form-input"
                placeholder="" value="{{ old('city') }}" type="text" />
          
        </div>
        @error('city')
                <span class="text-danger">{{ $message }}</span>
            @enderror
    </div>
    <div class="col-6">
        <div class="form-group des_textarea contact su_padding_important_email">
            <label class="form-label" for="">Zipcode </label>
            <input class="su_hide_input" name="zipcode" type="text" id="zipcode" class="form-input"
                placeholder="" value="{{ old('zipcode') }}" type="text" />
           
        </div>
        @error('zipcode')
                <span class="text-danger">{{ $message }}</span>
            @enderror
    </div>
</div>
<div class="mt-4 row">
    <div class="col-6">
        <div class="form-group des_textarea contact su_padding_important_email">
            <label class="form-label" for="">Password </label>
            <input class="su_hide_input" name="password" type="password" id="" class="form-input"
                placeholder="" value="" type="text" />
          
        </div>
        @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
    </div>
    <div class="col-6">
        <div class="form-group des_textarea contact su_padding_important_email">
            <label class="form-label" for="">Confirm Password </label>
            <input class="su_hide_input" name="password_confirmation" type="password" id="" class="form-input"
                placeholder="" value="" type="text" />
           
        </div>
        @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
            @enderror
    </div>
</div>
