<div class="form-group mt-4">
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
    <textarea name="description[]" rows="1" class="des_textarea mt-3 big_parcel_charges" placeholder="Type here..."
        id="description_{{ $key }}">{{ isset($detail->description) ? $detail->description : '' }}</textarea>
</div>
<div class="form-group mt-4">
    <p class="primary-color dta">Dimensions (max weight is 200kg)</p>
    <div class="card dimentions">
        <label for="height">
            <img src="{{ asset('assets/svg/height.svg') }}" alt="">
            <span>Height</span>
            <input type="number" class="text big_parcel_charges"
                value="{{ isset($detail->height) ? $detail->height : '' }}" name="height[]"
                id="height_{{ $key }}" placeholder="">
        </label>
        <label for="width">
            <img src="{{ asset('assets/svg/width.svg') }}" alt="">
            <span>Width</span>
            <input type="number" class="text big_parcel_charges" name="width[]" id="width_{{ $key }}"
                value="{{ isset($detail->width) ? $detail->width : '' }}" placeholder="">
        </label>
        <label for="length">
            <img src="{{ asset('assets/svg/length.svg') }}" alt="">
            <span>Length</span>
            <input type="number" class="text big_parcel_charges" name="length[]" id="length_{{ $key }}"
                value="{{ isset($detail->length) ? $detail->length : '' }}" placeholder="">
        </label>
    </div>
</div>
<div class="general-errors-wrapper">
    <p style="color:red">Total box size </p>
</div>
