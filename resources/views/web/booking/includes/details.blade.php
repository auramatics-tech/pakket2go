<div class="form-group mt-4" @if (isset($parcel_type->id) && $parcel_type->dimensions == 1) @else style="display:none" @endif>
    <label for="upload" class="drag_wrapper">
        <input type="file" name="image[]" class="drag_file" id="upload">
        <figure>
            <img src="{{ asset('assets/svg/add_a_photo.svg') }}" alt="" class="mb-3">
            <p class="mb-0">Upload Courier Image Drag & Drop</p>
            <span>or</span>
            <p class="browse_files mb-0 mx-auto text-white mt-2">
                Browse Files
            </p>
        </figure>
    </label>
</div>
<div class="form-group mt-4">
    <label for="description" class="primary-color dta">Description</label>
    <textarea name="description[]" rows="1" class="des_textarea mt-3" placeholder="Type here...">{{ isset($detail->description) ? $detail->description : '' }}</textarea>
</div>
<div class="form-group mt-4" @if (isset($parcel_type->id) && $parcel_type->dimensions == 1) @else style="display:none" @endif>
    <p class="primary-color dta">Dimensions (max weight is 200kg)</p>
    <div class="card dimentions">
        <label for="height">
            <img src="{{ asset('assets/svg/height.svg') }}" alt="">
            <span>Height</span>
            <input type="text" class="text" name="height[]" id="height" value="12.5cm" placeholder="12.5cm">
        </label>
        <label for="width">
            <img src="{{ asset('assets/svg/width.svg') }}" alt="">
            <span>Width</span>
            <input type="text" class="text" name="width[]" id="width" value="11cm" placeholder="11cm">
        </label>
        <label for="length">
            <img src="{{ asset('assets/svg/length.svg') }}" alt="">
            <span>Length</span>
            <input type="text" class="text" name="length[]" id="length" value="10cm" placeholder="10cm">
        </label>
    </div>
</div>
<div class="form-group last_div" @if (isset($parcel_type->id) && $parcel_type->dimensions == 1) @else style="display:none" @endif>
    <button class="primary_btn border-0">
        <div>
            <figure>
                <img src="{{ asset('assets/svg/plus.svg') }}" alt="plus">
            </figure>
        </div>
        <p class="mb-0 text-white ms-2">Add Items</p>
    </button>
</div>
