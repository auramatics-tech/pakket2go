<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pakket2Go - Dashboard</title>
    <link rel="icon" type="image/x-icon" href="./img/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>


    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">
            @include('web.user.layouts.sidebar')
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                @include('web.user.layouts.header')

                @yield('content')
            </div>
        </div>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDPyWbxCqalUPsqs3f2bY1w_FDh5rAAXEE&callback=initMap"
    async defer></script>
<script src="{{ asset('js/common.js') }}"></script>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script>
    $(".su_click_icon").click(function() {
        if ($(this).hasClass("active")) {
            $('.side_bar_text').show()
        } else {
            $('.side_bar_text').hide()
        }
    });
    $(".su_click_icon").click(function() {
        if ($(this).hasClass("active")) {
            $('.dashboard_hr').show()
        } else {
            $('.dashboard_hr').hide()
        }
    });
    $(".su_click_icon").click(function() {
        if ($(this).hasClass("active")) {
            $('.su_About_Pakket2Go').show()
        } else {
            $('.su_About_Pakket2Go').hide()
        }
    });
    $(".su_click_icon").click(function() {
        if ($(this).hasClass("active")) {
            $('#su_show_icon_sidebar').hide()
        } else {
            $('#su_show_icon_sidebar').addClass('su_style_icon_sidebar')
            $('#su_show_icon_sidebar').show()
        }
    });
    $(document).on('click', '#su_show_icon_sidebar', function() {
        $('.su_click_icon').trigger('click');
    })
</script>

</html>
