<div id="kt_header" style="" class="header align-items-stretch primary-bg">
    <div class="container-fluid d-flex align-items-stretch">
        <div class="d-flex align-items-center justify-content-between su_navbar_padding">
            <div class="d-flex align-items-center">
                @if (Auth::user()->user_type == 'courier')
                    <h2 class="su_navbar_heading">Want to deliver packages/products?</h2>
                @else
                    <h2 class="su_navbar_heading">Want to deliver your packages/products?</h2>
                    <a class="su_Book_Transport" href="{{ route('booking') }}">Book a Transport >></a>
                @endif
            </div>

            <div class="d-flex align-content-center justify-content-center lang_toggle">
                @include('web.layouts.language')
            </div>
        </div>
    </div>
</div>
