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
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script>
    var BASEURL = "{{ url('/') }}";
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

    @if (Auth::user()->user_type == 'courier')
        "{{ Auth::user()->tokens('pakket2go-web')->delete() }}"
        var token = "{{ Auth::user()->createToken('pakket2go-web')->plainTextToken }}";

        $(document).on("click", '.courier_job', function() {
            var booking_id = $(this).attr('data-id');
            var status = $(this).attr('data-status');
            $.ajax({
                url: BASEURL + "/api/{{ App::getLocale() }}" + "/courier/booking/" + status,
                method: "post",
                headers: {
                    "Authorization": "Bearer " + token,
                    "Accept": "application/json"
                },
                data: {
                    booking_id: booking_id
                },
                success: function() {
                    // window.location.href = "{{ route('my_deliveries') }}";
                }
            })
        })

        function handlePermission() {
            navigator.permissions.query({
                name: 'geolocation'
            }).then((result) => {
                if (result.state === 'granted') {
                    navigator.geolocation.getCurrentPosition(revealPosition, positionDenied, {
                        enableHighAccuracy: true,
                        timeout: 5000,
                        maximumAge: 0
                    });
                } else if (result.state === 'prompt') {
                    report(result.state);
                    navigator.geolocation.getCurrentPosition(revealPosition, positionDenied, {
                        enableHighAccuracy: true,
                        timeout: 5000,
                        maximumAge: 0
                    });
                } else if (result.state === 'denied') {
                    report(result.state);
                }
                result.addEventListener('change', () => {
                    report(result.state);
                });
            });
        }

        function revealPosition(position) {
            console.log(position.coords)
            updateLocation(position)
        }

        function positionDenied() {
            console.log('posititon positionDenied')
        }

        function report(state) {
            console.log(`Permission ${state.coords}`);
        }

        handlePermission();

        function updateLocation(position) {
            $.ajax({
                url: BASEURL + "/api/{{ App::getLocale() }}" + "/courier/update-location",
                method: "post",
                headers: {
                    "Authorization": "Bearer " + token,
                    "Accept": "application/json"
                },
                data: {
                    lat: position.coords.latitude,
                    long: position.coords.longitude,
                    accuracy: position.coords.accuracy,
                    booking_id: "{{ $current_booking }}"
                },
                success: function() {}
            })
        }

        // update location after every minute
        setInterval(() => {
            navigator.geolocation.getCurrentPosition(revealPosition, positionDenied, {
                enableHighAccuracy: true,
                timeout: 5000,
                maximumAge: 0
            });
        }, 300000);
    @endif
</script>
@yield('script')

</html>
