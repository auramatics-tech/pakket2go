<form action="">
    <div class="form-group mt-4">
        <div class="radio_style">
            <label for="private" data-type="business" class="active registeration_type" id="type_private">
                Private
                <input type="radio" name="" id="Private" checked>
            </label>
            <label for="business" data-type="private" class="registeration_type" id="type_business">
                Business
                <input type="radio" name="" id="Business">
            </label>
        </div>
    </div>
    @include('web.includes.private_registration_form')
    @include('web.includes.business_registration_form')
    <p class="mb-0 dis_content mt-4">Your contact details are passed on to the driver so that they
        can get intouch with you during
        transport</p>

</form>