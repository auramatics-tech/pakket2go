<div class="child_first">
    <div class="d-flex align-items-center justify-content-between top_data">
        <div class="parcel">
            <h6 class="mb-0 ct_h6">Pickup address contact details</h6>
        </div>
        <div class="moreinfo">
            <figure>
                <img src="{{ asset('assets/svg/g_info.svg') }}" alt="info">
            </figure>
            <p class="mb-0 ms-2 primary-color ">
                More info
            </p>
        </div>
    </div>
    <div class="card_data mt-4">
        <p class="mb-0 pl_des">How can we contact you? With these contact details we will keep you up to
            date on your transport.
            Enter your details here.</p>
        <form action="" class="row">
            <div class="col-6">
                <div class="form-group mt-4">
                    <input type="text" name="" id="" class="ct_input postal"
                        placeholder="Postal code">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group mt-4">
                    <input type="text" name="" id="" class="ct_input house" placeholder="House No.">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group mt-4">
                    <input type="text" name="" id="" class="ct_input street" placeholder="Street">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group mt-4">
                    <input type="text" name="" id="" class="ct_input locality"
                        placeholder="Locality">
                </div>
            </div>
            <div class="col-12">
                <div class="form-group mt-4">
                    <textarea name="description" rows="2" class="ct_input des_contact"
                        placeholder="Additional info for the courier at here"></textarea>
                </div>
            </div>
            <h6 class="ct_h6 mt-3">What is the closing time?</h6>
            <p class="mb-0 ct_p">If this address is for a company</p>
            <div class="col-12">
                <div class="form-group mt-4">
                    <input type="time" name="" id="" class="ct_input time" placeholder="time">
                </div>
            </div>
            <h6 class="ct_h6 mt-3">Who can we get in touch with here?</h6>
            <p class="mb-0 ct_p">These pickup details can be adjusted later</p>
            <div class="col-6">
                <div class="form-group mt-4">
                    <input type="text" name="" id="" class="ct_input name" placeholder="Full name">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group mt-4">
                    <div class="phone_input">
                        <figure>
                            <img src="{{ asset('assets/img/flag.png') }}" alt="">
                        </figure>
                        <label for="phone" class="ms-3">
                            <span class="phone_label">phone</span>
                            <div class="d-flex">
                                <input type="text" class="code" value="+31-">
                                <input type="text" class="number">
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
