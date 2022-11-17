@extends('web.layouts.master')
@section('content')
<header class="upload_header_bg">
    <div class="su_upload_logo">
        <img src="{{ asset('assets/img/Pakket2gologo.png') }}" alt="">
    </div>
</header>
<section>
    <div class="su_upload_border">
        <h4 class="su_Upload_heading">Upload your documents</h4>
        <form action="">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12 su_upload_768_margin">
                        <label class="su_upload_label" for="">Your IBAN</label><br>
                        <div class="su_upload_input_bg_clr">
                            <input class="su_upload_input bank" placeholder="Bank account number" type="" id="" name="" value="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 su_upload_768_margin">
                        <label class="su_upload_label" for="">In the name of</label><br>
                        <div class="su_upload_input_bg_clr">
                            <input class="su_upload_input account_holder" placeholder="Account holder name" type="" id="" name="" value="">
                        </div>
                    </div>
                </div>
                <div class="su_upload_border_top"></div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-12 su_upload_768_margin">
                        <div class="text-center">
                            <p class="su_upload_para">Front driving license</p>
                        </div>
                        <div class="dashed text-center">
                            <div class="text-center">
                                <img src="{{ asset('assets/svg/upload_folder.svg') }}" alt="">
                            </div>
                            <div>
                                <p class="su_upload_Drag_para">Drag and Drop your file here</p>
                                <p class="su_upload_Drag_or">or</p>
                                <button class="su_upload_sm_btn">Broswe Files</button>
                                <p class="su_upload_Drag_para_green">Maximum file size 100 MB</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12 su_upload_768_margin">
                        <div class="text-center">
                            <p class="su_upload_para">Back of driver's license</p>
                        </div>
                        <div class="dashed text-center">
                            <div class="text-center">
                                <img src="{{ asset('assets/svg/upload_folder.svg') }}" alt="">
                            </div>
                            <div>
                                <p class="su_upload_Drag_para">Drag and Drop your file here</p>
                                <p class="su_upload_Drag_or">or</p>
                                <button class="su_upload_sm_btn">Broswe Files</button>
                                <p class="su_upload_Drag_para_green">Maximum file size 100 MB</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12 su_upload_768_margin">
                        <div class="text-center">
                            <p class="su_upload_para">Image Chamber of Commerce Extract</p>
                        </div>
                        <div class="dashed text-center">
                            <div class="text-center">
                                <img src="{{ asset('assets/svg/upload_folder.svg') }}" alt="">
                            </div>
                            <div>
                                <p class="su_upload_Drag_para">Drag and Drop your file here</p>
                                <p class="su_upload_Drag_or">or</p>
                                <button class="su_upload_sm_btn">Broswe Files</button>
                                <p class="su_upload_Drag_para_green">Maximum file size 100 MB</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col-lg-4 col-md-4 col-12 su_upload_768_margin">
                        <div class="su_upload_bg_light">
                            <div class="d-lg-flex d-md-block d-block">
                                <div>
                                    <div class="su_license_img">
                                        <img src="{{ asset('assets/img/license.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="ms-2">
                                    <p class="su_license_details">Driver's license Front.jpg</p>
                                    <p class="su_license_details">222 KB</p>
                                </div>
                                <div class="d-flex align-items-center ms-auto">
                                    <div>
                                        <a href="">
                                    <img src="{{ asset('assets/svg/cross_icon.svg') }}" alt="">
                                    </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12 su_upload_768_margin">
                        <div class="su_upload_bg_light">
                            <div class="d-lg-flex d-md-block d-block">
                                <div>
                                    <div class="su_license_img">
                                        <img src="{{ asset('assets/img/license.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="ms-2">
                                    <p class="su_license_details">Driver's license Front.jpg</p>
                                    <p class="su_license_details">222 KB</p>
                                </div>
                                <div class="d-flex align-items-center ms-auto">
                                    <div>
                                        <a href="">
                                    <img src="{{ asset('assets/svg/cross_icon.svg') }}" alt="">
                                    </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12 su_upload_768_margin">
                        <div class="su_upload_bg_light">
                                <div class="text-center">
                                    <p class="su_license_details">No File Chosen</p>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button class="su_upload_button">Continue <span class="">>></span></button>
                </div>
        </form>
    </div>
    </div>

</section>
@endsection

@section('script')

@endsection