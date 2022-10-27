<div class="form-group mt-4">
    <div class="radio_style">
        <label for="Private" id="private" class="@if (!old('user_type') || old('user_type') == 'private') active @endif user_type"
            data-other="courier">
            Private
            <input type="radio" value="private" name="user_type" id="form_private"
                @if (!old('user_type') || old('user_type') == 'private') checked @endif>
        </label>
        <label for="Courier" id="courier" class="@if (old('user_type') == 'courier') active @endif user_type"
            data-other="private">
            Business
            <input type="radio" value="courier" name="user_type" id="form_courier"
                @if (old('user_type') == 'courier') checked @endif>
        </label>
    </div>
</div>
<div id="register_form">
    @if (old('user_type'))
        @include('web.includes.' . old('user_type') . '_registration_form')
    @else
        @include('web.includes.private_registration_form')
    @endif
</div>
