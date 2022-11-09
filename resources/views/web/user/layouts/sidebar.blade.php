<div id="kt_aside" class="aside aside-dark" data-kt-drawer="true" data-kt-drawer-name="aside"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_aside_mobile_toggle">

    <div class="aside-menu flex-column-fluid">
        <div class="" id="kt_aside_menu_wrapper" data-kt-scroll="true"
            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
            data-kt-scroll-offset="0">
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                id="#kt_aside_menu" data-kt-menu="true" data-kt-menu-expand="false">

                <div class="aside-logo flex-column-auto" id="kt_aside_logo">
                    <div class="su_style_icon_sidebar" id="su_show_icon_sidebar">
                        <span class="svg-icon svg-icon-1 rotate-180">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path opacity="0.5"
                                    d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                                    fill="currentColor" />
                                <path
                                    d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                                    fill="currentColor" />
                            </svg>
                        </span>
                    </div>
                    <a href="">
                        <img alt="Logo" src="{{ asset('assets/img/Pakket2gologo.png') }}" class="h-25px logo" />
                    </a>
                    <div id="kt_aside_toggle"
                        class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle su_click_icon"
                        data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
                        data-kt-toggle-name="aside-minimize">
                        <span class="svg-icon svg-icon-1 rotate-180">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path opacity="0.5"
                                    d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                                    fill="currentColor" />
                                <path
                                    d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                                    fill="currentColor" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-content">
                        <div class="d-flex">
                            <div>
                                <div class="su_user_img">
                                    <img src="@if(Auth::user()->profile_pic){{ asset(Auth::user()->profile_pic) }}@else{{ asset('assets/img/avatar.png') }}@endif" alt="">
                                </div>
                            </div>
                            <div>
                                <div class="mg_left_10">
                                    <h3 class="su_user_name">{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</h3>
                                    <p class="su_user_email">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="su_side_padding_dashboard">
                    <div class="su_padding_items">
                        <a href="">
                            <span class="">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <img src="{{ asset('assets/svg/Dashboard.svg') }}" alt="">
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="su_menu_title">
                                    <span class="side_bar_text">Dashboard</span>
                                </span>
                            </span>
                        </a>
                    </div>
                    <div class="su_padding_items">
                        <a href="">
                            <span class="">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <img src="{{ asset('assets/svg/My Deliveries.svg') }}" alt="">
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="su_menu_title">
                                    <span class="side_bar_text">My Deliveries</span>
                                </span>
                            </span>
                        </a>
                    </div>
                    <div class="su_padding_items">
                        <a href="">
                            <span class="">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <img src="{{ asset('assets/svg/All Chats.svg') }}" alt="">
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="su_menu_title">
                                    <span class="side_bar_text">All Chats</span>
                                </span>
                            </span>
                        </a>
                    </div>
                    <hr class="dashboard_hr">
                    <h5 class="su_About_Pakket2Go">About Pakket2Go</h5>
                    <div class="su_padding_items">
                        <a href="">
                            <span class="">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <img src="{{ asset('assets/svg/Contact Us.svg') }}" alt="">
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="su_menu_title">
                                    <span class="side_bar_text">Contact Us</span>
                                </span>
                            </span>
                        </a>
                    </div>
                    <div class="su_padding_items">
                        <a href="">
                            <span class="">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <img src="{{ asset('assets/svg/Terms and Conditions.svg') }}" alt="">
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="su_menu_title">
                                    <span class="side_bar_text">Terms and Conditions</span>
                                </span>
                            </span>
                        </a>
                    </div>
                    <div class="su_padding_items">
                        <a href="">
                            <span class="">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <img src="{{ asset('assets/svg/Privacy Policy.svg') }}" alt="">
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="su_menu_title">
                                    <span class="side_bar_text">Privacy Policy</span>
                                </span>
                            </span>
                        </a>
                    </div>
                    <div class="su_padding_items">
                        <a href="">
                            <span class="">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <img src="{{ asset('assets/svg/Share App.svg') }}" alt="">
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="su_menu_title">
                                    <span class="side_bar_text">Share App</span>
                                </span>
                            </span>
                        </a>
                    </div>

                </div>

                <div class="aside-footer flex-column-auto su_side_padding_dashboard su_dashboard_logout_position"
                    id="kt_aside_footer">
                    <div class="su_padding_items">
                        <a class="" href="">
                            <span class="">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <img src="{{ asset('assets/svg/logout.svg') }}" alt="">
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="su_menu_title ">
                                    <span class="su_logout_red side_bar_text">Log-out</span>
                                </span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
