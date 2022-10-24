<div id="courier_form" style="display: none">
    <!-- <div class="form-group mt-4">
        <input type="text" name="" id="" class="des_textarea contact" placeholder="Company name">
    </div> -->
    <div class="form-group des_textarea contact mt-4 su_padding_important_email">
        <label class="form-label" for="">Company name</label>
        <input class="su_hide_input" type="text" id="" class="form-input" placeholder="" value="{{ old('email') }}" type="text" />
        @error('full_name')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mt-4 row">
        <div class="col-6">
            <!-- <div class="phone_input">
                <label for="phone" class="ms-3">
                    <input type="email" name="" id="" class=" contact" placeholder="First name">
                </label>
            </div> -->

            <div class="form-group des_textarea contact su_padding_important_email">
                <label class="form-label" for="">First name</label>
                <input class="su_hide_input" name="full_name" type="text" id="" class="form-input" placeholder="" value="{{ old('Last_name') }}" type="text" />
                @error('Last_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <!-- <div class="phone_input">
                <label for="phone" class="ms-3">
                    <input type="text" name="" id="" class=" contact" placeholder="Last name">
                </label>
            </div> -->
            <div class="form-group des_textarea contact su_padding_important_email">
                <label class="form-label" for="">Last name</label>
                <input class="su_hide_input" name="Last_name" type="text" id="" class="form-input" placeholder="" value="{{ old('Last_name') }}" type="text" />
                @error('Last_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="mt-4 row">
        <div class="col-6">
            <!-- <div class="phone_input">
                <label for="phone" class="ms-3">
                    <input type="email" name="" id="" class=" contact" placeholder="Email">
                </label>
            </div> -->
            <div class="form-group des_textarea email su_padding_important_email">
                <label class="form-label" for="">Email</label>
                <input class="su_hide_input" name="Last_name" type="text" id="" class="form-input" placeholder="" value="{{ old('Email') }}" type="text" />
                @error('Email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <!-- <div class="form-group">
                <input class="su_country_dropdown" id="phone" id="phone_number" type="tel" name="phone_number"
                    value="{{ old('phone_number') }}" />
            </div> -->
            <div class="form-group des_textarea contact su_padding_important_email">
                <label class="form-label" for="">Phone </label>
                <input class="su_hide_input" name="Last_name" type="text" id="" class="form-input" placeholder="" value="{{ old('phone_number') }}" type="text" />
                @error('phone_number')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

        </div>
    </div>
    <div class="mt-4 row">
        <div class="col-6">

            <div class="form-group des_textarea contact su_padding_important_email">
                <label class="form-label" for="">Street </label>
                <input class="su_hide_input" name="Street" type="text" id="" class="form-input" placeholder="" value="{{ old('Street') }}" type="text" />
                @error('Street')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <!-- <div class="phone_input">
                <label for="phone" class="ms-3">
                    <input type="text" name="" id="" class=" contact" placeholder="House No">
                </label>
            </div> -->
            <div class="form-group des_textarea contact su_padding_important_email">
                <label class="form-label" for="">House No </label>
                <input class="su_hide_input" name="House_No" type="text" id="" class="form-input" placeholder="" value="{{ old('House_No') }}" type="text" />
                @error('House_No')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="mt-4 row">
        <div class="col-6">
            <!-- <div class="phone_input">
                <label for="phone" class="ms-3">
                    <input type="email" name="" id="" class=" contact"
                        placeholder="House No Extension">
                </label>
            </div> -->
            <div class="form-group des_textarea contact su_padding_important_email">
                <label class="form-label" for="">House No Extension </label>
                <input class="su_hide_input" name="House_No_Extension" type="text" id="" class="form-input" placeholder="" value="{{ old('House_No_Extension') }}" type="text" />
                @error('House_No_Extension')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <!-- <div class="phone_input">
                <label for="phone" class="ms-3">
                    <input type="text" name="" id="" class=" contact" placeholder="KVK No">
                </label>
            </div> -->
            <div class="form-group des_textarea contact su_padding_important_email">
                <label class="form-label" for="">KVK No </label>
                <input class="su_hide_input" name="KVK_No" type="text" id="" class="form-input" placeholder="" value="{{ old('KVK_No') }}" type="text" />
                @error('KVK_No')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="mt-4 row">
        <div class="col-6">
            <!-- <div class="phone_input">
                <label for="phone" class="ms-3">
                    <input type="email" name="" id="" class=" contact" placeholder="City">
                </label>
            </div> -->
            <div class="form-group des_textarea contact su_padding_important_email">
                <label class="form-label" for="">City </label>
                <input class="su_hide_input" name="City" type="text" id="" class="form-input" placeholder="" value="{{ old('City') }}" type="text" />
                @error('City')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <!-- <div class="phone_input">
                <label for="phone" class="ms-3">
                    <input type="text" name="" id="" class=" contact" placeholder="Zipcode">
                </label>
            </div> -->
            <div class="form-group des_textarea contact su_padding_important_email">
                <label class="form-label" for="">Zipcode </label>
                <input class="su_hide_input" name="Zipcode" type="text" id="" class="form-input" placeholder="" value="{{ old('Zipcode') }}" type="text" />
                @error('Zipcode')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="mt-4 row">
        <div class="col-6">
            <!-- <div class="phone_input">
                <label for="phone" class="ms-3">
                    <input type="text" name="" id="" class=" contact" placeholder="Password">
                </label>
            </div> -->
            <div class="form-group des_textarea contact su_padding_important_email">
                <label class="form-label" for="">Password </label>
                <input class="su_hide_input" name="Password" type="text" id="" class="form-input" placeholder="" value="{{ old('Password') }}" type="text" />
                @error('Password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <!-- <div class="phone_input">
                <label for="phone" class="ms-3">
                    <input type="text" name="" id="" class=" contact"
                        placeholder="Confirm Password">
                </label>
            </div> -->
            <div class="form-group des_textarea contact su_padding_important_email">
                <label class="form-label" for="">Confirm Password </label>
                <input class="su_hide_input" name="Confirm_Password" type="text" id="" class="form-input" placeholder="" value="{{ old('Confirm_Password') }}" type="text" />
                @error('Confirm_Password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>