<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pakket2Go - Address</title>
    <link rel="icon" type="image/x-icon" href="./img/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">
            <div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
                <div class="aside-logo flex-column-auto" id="kt_aside_logo">
                    <a href="../../demo1/dist/index.html">
                        <img alt="Logo" src="{{ asset('assets/img/Pakket2gologo.png') }}" class="h-25px logo" />
                    </a>
                    <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle su_click_icon" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
                        <span class="svg-icon svg-icon-1 rotate-180">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="currentColor" />
                                <path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="currentColor" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="aside-menu flex-column-fluid">
                    <div class="" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
                        <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true" data-kt-menu-expand="false">

                            <div class="menu-item">
                                <div class="menu-content">
                                    <div class="d-flex">
                                        <div>
                                            <div class="su_user_img">
                                                <img src="{{ asset('assets/img/user.png') }}" alt="">
                                            </div>
                                        </div>
                                        <div>
                                            <div class="mg_left_10">
                                                <h3 class="su_user_name">Robert Johnson </h3>
                                                <p class="su_user_email">john12@gmail.com</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="su_side_padding_dashboard">
                                <div class="su_padding_items">
                                    <span class="">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <img src="{{ asset('assets/svg/Dashboard.svg') }}" alt="">
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="su_menu_title">
                                            <a href=""><span class="side_bar_text">Dashboard</span></a>
                                        </span>
                                    </span>
                                </div>
                                <div class="su_padding_items">
                                    <span class="">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <img src="{{ asset('assets/svg/My Deliveries.svg') }}" alt="">
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="su_menu_title">
                                            <a href=""><span class="side_bar_text">My Deliveries</span></a>
                                        </span>
                                    </span>
                                </div>
                                <div class="su_padding_items">
                                    <span class="">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <img src="{{ asset('assets/svg/All Chats.svg') }}" alt="">
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="su_menu_title">
                                            <a href=""><span class="side_bar_text">All Chats</span></a>
                                        </span>
                                    </span>
                                </div>
                                <hr class="dashboard_hr">
                                <h5 class="su_About_Pakket2Go">About Pakket2Go</h5>
                                <div class="su_padding_items">
                                    <span class="">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <img src="{{ asset('assets/svg/Contact Us.svg') }}" alt="">
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="su_menu_title">
                                            <a href=""><span class="side_bar_text">Contact Us</span></a>
                                        </span>
                                    </span>
                                </div>
                                <div class="su_padding_items">
                                    <span class="">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <img src="{{ asset('assets/svg/Terms and Conditions.svg') }}" alt="">
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="su_menu_title">
                                            <a href=""><span class="side_bar_text">Terms and Conditions</span></a>
                                        </span>
                                    </span>
                                </div>
                                <div class="su_padding_items">
                                    <span class="">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <img src="{{ asset('assets/svg/Privacy Policy.svg') }}" alt="">
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="su_menu_title">
                                            <a href=""><span class="side_bar_text">Privacy Policy</span></a>
                                        </span>
                                    </span>
                                </div>
                                <div class="su_padding_items">
                                    <span class="">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <img src="{{ asset('assets/svg/Share App.svg') }}" alt="">
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="su_menu_title">
                                            <a href=""><span class="side_bar_text">Share App</span></a>
                                        </span>
                                    </span>
                                </div>

                                <div class="aside-footer flex-column-auto" id="kt_aside_footer">
                                    <div class="su_padding_items">
                                        <span class="">
                                            <span class="menu-icon">
                                                <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <img src="{{ asset('assets/svg/logout.svg') }}" alt="">
                                                </span>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <span class="su_menu_title ">
                                                <a class="su_logout_red" href=""><span class="side_bar_text">Log-out</span></a>
                                            </span>
                                        </span>
                                    </div>
                                </div>

                            </div>



                        </div>
                    </div>
                </div>

            </div>

            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <div id="kt_header" style="" class="header align-items-stretch primary-bg">
                    <div class="container-fluid d-flex align-items-stretch justify-content-between">
                                    <div class="d-flex align-items-center justify-content-between su_navbar_padding">
                                        <div class="d-flex align-items-center">
                                            <h2 class="su_navbar_heading">Want to deliver your packages/products?</h2>
                                            <button class="su_Book_Transport">Book a Transport >></button>
                                        </div>

                                        <div class="d-flex align-content-center justify-content-center lang_toggle">
                                            <button>English</button>
                                            <button class="active">Dutch</button>
                                        </div>
                                    </div>
                    </div>
                </div>
                <div class="d-flex flex-column flex-column-fluid" id="kt_content">

                    <div class="toolbar" id="kt_toolbar">
                        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                                <div class="su_width_40">
                                    <h3 class="Track_orders">Track orders</h3>
                                </div>
                                <div class="su_width_60">
                                    <input class="su_dashboard_search" type="text" placeholder="Search...">
                                </div>
                        </div>
                    </div>
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <div id="kt_content_container" class="container-xxl">
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
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDPyWbxCqalUPsqs3f2bY1w_FDh5rAAXEE&callback=initMap" async defer></script>
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
    </script>

</html>