<footer id="main_footer">
    <div class="container footer_top">
        <div class="row footer_list">
            <div class="col-lg-4 col-md-7 child1 mb-md-4">
                <a href="/">
                    <figure>
                        <img src="{{ asset('assets/svg/Pakket2go.svg') }}" alt="logo">
                    </figure>
                </a>
                <p class="mb-0 text-white mt-3">
                    {{ __('home.footer_desc') }}
                </p>
            </div>
            <div class="col-lg-3 col-md-5 child2 mb-md-4">
                <h6>{{ __('home.About Us') }}</h6>
                <ul class="list-unstyled">
                    <li>
                        <div>
                            <figure>
                                <img src="{{ asset('assets/svg/info.svg') }}" alt="">
                            </figure>
                        </div>
                        <a href="#">
                            <span>{{ __('home.Legal') }}</span>
                        </a>
                    </li>
                    <li>
                        <div>
                            <figure>
                                <img src="{{ asset('assets/svg/enhanced_encryption.svg') }}" alt="">
                            </figure>
                        </div>
                        <a href="{{ route('privacy') }}">
                            <span>{{ __('home.Privacy Policy') }}</span>
                        </a>
                    </li>
                    <li>
                        <div>
                            <figure>
                                <img src="{{ asset('assets/svg/security.svg') }}" alt="">
                            </figure>
                        </div>
                        <a href="{{ route('terms') }}">
                            <span>{{ __('home.Terms and conditions') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-7 child3">
                <h6>Contact Us</h6>
                <ul class="list-unstyled">
                    <li>
                        <div>
                            <figure>
                                <img src="{{ asset('assets/svg/call.svg') }}" alt="">
                            </figure>
                        </div>
                        <a href="tel:0302496233">
                            <span>030 249 6233</span>
                        </a>
                    </li>
                    <li>
                        <div>
                            <figure>
                                <img src="{{ asset('assets/svg/email.svg') }}" alt="">
                            </figure>
                        </div>
                        <a href="mailto:info@pakket2go.nl">
                            <span>info@pakket2go.nl</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-5 child4">
                <h6>Follow Us</h6>
                <ul class="list-unstyled">
                    <li>
                        <div>
                            <figure>
                                <img src="{{ asset('assets/svg/fb.svg') }}" alt="">
                            </figure>
                        </div>
                        <a href="http://facebook.com/pakket2go" target="_blank">
                            <span>{{ __('home.Facebook') }}</span>
                        </a>
                    </li>
                    <li>
                        <div>
                            <figure>
                                <img src="{{ asset('assets/svg/insta.svg') }}" alt="">
                            </figure>
                        </div>
                        <a href="http://instagram.com/pakket2go" target="_blank">
                            <span>{{ __('home.Instagram') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div
        class="container d-flex align-items-center justify-content-between primary-bg border-radius-20 py-3 px-5 footer_bottom">
        <p class="mb-0 text-white">© 2022 Pakket2Go {{ __('home.Limited') }} {{ __('home.All rights reserved') }}.</p>
        <figure>
            <img src="{{ asset('assets/svg/Pakket2go.svg') }}" alt="logo">
        </figure>
    </div>
</footer>
