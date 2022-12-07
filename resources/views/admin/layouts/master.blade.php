<!DOCTYPE html>
<html lang="en">

<head>
    <base href="">
    <title>Pakket2Go</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ asset('assets/admin/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
</head>

<body id="kt_body" class="bg-body">
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->

        @if (isset(Auth::guard('admin')->user()->id) && Auth::guard('admin')->user()->id)
            <div class="page d-flex flex-row flex-column-fluid">
            @else
                <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
                    style="background-image: url({{ asset('assets/admin/media/illustrations/sketchy-1/14.png') }}">
        @endif
        @if (isset(Auth::guard('admin')->user()->id) && Auth::guard('admin')->user()->id)
            @include('admin.layouts.sidebar')
            @include('admin.layouts.header')
        @endif
        @yield('content')

        @include('admin.layouts.footer')
    </div>
    </div>
    </div>

    <script>
        var hostUrl = "assets/admin/";
    </script>
    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{ asset('assets/admin/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/admin/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <script src="{{ asset('assets/admin/js/custom/authentication/sign-in/general.js') }}"></script>
</body>

</html>
