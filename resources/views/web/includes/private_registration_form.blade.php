<div id="private_form">
    <div class="form-group mt-4">
        <input type="text" name="full_name" id="full_name" class="des_textarea contact" placeholder="Full name"
            value="{{ old('full_name') }}" required>
        @error('full_name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group mt-4 row">
        <div class="col-6">
            <div class="phone_input">
                <label for="phone" class="ms-3">
                    <input type="email" name="email" id="" class=" contact" placeholder="Email"
                        value="{{ old('email') }}" required>
                </label>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <input type="hidden" value="91" name="country_code">
        <div class="col-6">
            <div class="phone_input">
                <label for="phone" class="ms-3">
                    <input type="text" name="phone_number" id="phone_number" class="contact" placeholder="Phone"
                        value="{{ old('phone_number') }}" required>
                </label>
                @error('phone_number')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="form-group mt-4 row">
        <div class="col-6">
            <div class="phone_input">
                <label for="phone" class="ms-3">
                    <input type="text" name="password" id="password" class="contact" placeholder="Password"
                        value="" required>
                </label>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="phone_input">
                <label for="phone" class="ms-3">
                    <input type="text" name="password_confirmation" id="password_confirmation" class=" contact"
                        value="" required placeholder="Confirm Password">
                </label>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>
