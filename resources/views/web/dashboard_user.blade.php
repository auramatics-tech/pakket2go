<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pakket2Go - Address</title>
    <link rel="icon" type="image/x-icon" href="./img/favicon.png">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>

<body>
    <div class="su_dashboard_user_width">
        <div>
            <div class="dashboard_clr">
                <div class="dashboard_logo">

                    <img src="{{ asset('assets/img/Pakket2gologo.png') }}" alt="">
                </div>
                <div class="d-flex">
                    <div>
                        <img src="{{ asset('assets/img/User.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div>
            <header id="main_navbar" class="primary-bg">
                <nav class="navbar navbar-expand-lg">
                    <div class="d-flex align-items-center su_navbar_padding">
                        <div class="d-flex align-items-center">
                            <h2 class="su_navbar_heading">Want to deliver your packages/products?</h2>
                            <button class="su_Book_Transport">Book a Transport >></button>
                        </div>

                        <div class="d-flex align-content-center justify-content-center lang_toggle">
                            <button>English</button>
                            <button class="active">Dutch</button>
                        </div>
                    </div>
                </nav>
            </header>
            <div class="d-flex justify-content-between align-items-center">
                <div class="su_width_40">
                    <h3 class="Track_orders">Track orders</h3>
                </div>
                <div class="su_width_60">
                    <input class="su_dashboard_search" type="text" placeholder="Search...">
                </div>
            </div>
            <div class="su_card_dashboard">
                <div class="su_card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="su_item_img">
                                    <img src="{{ asset('assets/img/sofa.png') }}" alt="">
                                </div>
                                <div class="su_margin_left_15">
                                    <h2 class="su_item_name">#31djh2jbn45 <button class="su_item_name_btn"><span class="green_dot">0</span>Active</button></h2>
                                    <p class="su_item_price">€30.00</p>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('assets/svg/order_date.svg') }}" alt="">
                                        <p class="su_item_date">Order date: Friday, Sep 07</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="su_map_img_dashboard">
                                <img src="{{ asset('assets/img/map_dashboard.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <div class="d-flex align-items-center su_after_img">
                            <img src="{{ asset('assets/svg/circle_circle.svg') }}" alt="">
                            <p class="su_address_dashboard">20 Ranipukur Lane, PO 234, Noord-Holland</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('assets/svg/location_dashboard.svg') }}" alt="">
                            <p class="su_address_dashboard">20 Ranipukur Lane, PO 234, Noord-Holland</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDPyWbxCqalUPsqs3f2bY1w_FDh5rAAXEE&callback=initMap" async defer></script>
    <script src="js/common.js"></script>

</html>