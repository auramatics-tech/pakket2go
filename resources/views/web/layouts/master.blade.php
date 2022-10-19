<!doctype html>
<html lang="nl" translate="no">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-536N9TP');
    </script>
    <!-- End Google Tag Manager -->

    <link rel="shortcut icon" href=" {{ asset('assets/img/favicon.ico') }}" />
    <meta name="google" content="notranslate">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/img/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assets/img/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/img/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/img/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/img/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/img/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/img/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/img/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicon.ico') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('assets/img/favicon.ico') }}">
    <meta name="theme-color" content="#ffffff">

    <title>@yield('title')</title>
    <meta name="description" content="@yield('metaDescription')" />
    <meta name="keywords" content="@yield('metaKeywords')" />

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/howitworks.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

    @yield('style')
</head>

<body>
    @if (Route::is('booking'))
        @include('web.booking.layouts.header')
        @include('web.booking.layouts.steps')
    @elseif (!Route::is('login'))
        @include('web.layouts.header')
    @endif
    @yield('content')

    @if (!Route::is('booking') && !Route::is('login'))
        @include('web.layouts.footer')
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <script>
        console.log("{{ config('app.GOOGLE_SITE_KEY') }}", "key")
        var BASEURL = "{{ url('/') }}"
        var show_map = 0;
        $(document).on('click', '.registeration_type', function() {
            var to_active = $(this).attr('for');
            var type = $(this).attr('data-type');
            $(".registeration_type").removeClass('active');
            $(this).addClass('active');

            $('#' + to_active).show();
            $('#' + type).hide();
        })
    </script>
    @yield('script')
</body>

</html>
