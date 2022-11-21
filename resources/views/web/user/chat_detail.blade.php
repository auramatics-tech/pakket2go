@extends('web.user.layouts.master')

@section('content')
<div class="d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="" class="su_container_dashboard_chat">
            <div class="su_user_name_and_back d-flex align-items-center justify-content-between">
                <div class="">
                    <a href="">
                        <img src="{{ asset('assets/svg/back_svg.svg') }}" alt="">
                    </a>
                </div>
                <div>
                    <div class="d-flex align-items-center">
                        <div class="su_img_user_main">
                            <img src="{{ asset('assets/img/user_img.png') }}" alt="">
                        </div>
                        <div class="su_user_name_topic">
                            Ridikamiana
                        </div>
                    </div>
                </div>
                <div class=""></div>
            </div>
            <div class="">
                <div class="su_detail_page_bg su_padding_chat_section">
                    <p class="su_day_name_date">Today</p>
                    <div class="su_chat_right">
                        <div class="su_msg">Hi! Good morning Good morning Good morning Good morning Good morning!</div>
                        <div class="d-flex justify-content-end my-4 align-items-center">
                            <p class="su_msg_time">11:20 PM</p>
                            <img src="{{ asset('assets/svg/seen_msg.svg') }}" alt="">
                            <img src="{{ asset('assets/svg/rec_svg.svg') }}" alt="">
                            <img src="{{ asset('assets/svg/send_svg.svg') }}" alt="">
                        </div>
                    </div>
                    <div class="su_chat_left">
                        <div class="d-flex">
                            <div class="su_user_msg_send_img">
                                <img src="{{ asset('assets/img/user_img.png') }}" alt="">
                            </div>
                            <div class="su_chat_width">
                                <div class="su_msg_receive">Hi! Good morning Good morning Good morning Good morning!</div>
                                <div class="d-flex justify-content-start my-4">
                                    <p class="su_msg_time">11:20 PM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center su_padding_msg_send_input">
                    <div class="su_chat_width_10"><img class="su_img_height2" src="{{ asset('assets/svg/add_options.svg') }}" alt=""></div>
                    <div class="su_chat_width_80">
                        <form action="">
                            <input type="text" class="su_msg_send_input smile" placeholder="Type a message">
                        </form>
                    </div>
                    <div class="su_chat_width_10"><img class="su_img_height" src="{{ asset('assets/svg/send_msg_svg.svg') }}" alt=""></div>
                </div>
            </div>
        </div>
        <div class="width_35">
            <div class="su_Shared_Contents">Shared Contents</div>
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12 my-4">
                    <div class="su_Shared_Contents_img">
                        <img src="{{ asset('assets/img/Shared_Contents1.png') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12 my-4">
                    <div class="su_Shared_Contents_img">
                        <img src="{{ asset('assets/img/Shared_Contents2.png') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12 my-4">
                    <div class="su_Shared_Contents_img">
                        <img src="{{ asset('assets/img/Shared_Contents3.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="chat_filter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <a class="su_chat_filter" href="">Filter</a>
                        </div>
                        <div>
                            <a class="su_chat_Reset" href="">Reset</a>
                        </div>
                    </div>
                    <div>
                        <p class="su_filter_heading su_Sort_By">Sort By</p>
                        <a class="" href="javascript:;">
                            <div class="su_filter_select my-4">Date (new - old)</div>
                        </a>
                        <a class="" href="javascript:;">
                            <div class="su_filter_select my-4">Alphabetically (a-z)</div>
                        </a>
                        <a class="" href="javascript:;">
                            <div class="su_filter_select my-4">Date (old - new)</div>
                        </a>
                        <a class="" href="javascript:;">
                            <div class="su_filter_select my-4">Alphabetically (z-a)</div>
                        </a>
                        <p class="su_filter_heading su_Sort_By">Sort By</p>
                        <a class="" href="javascript:;">
                            <div class="su_filter_select my-4">All</div>
                        </a>
                        <a class="" href="javascript:;">
                            <div class="su_filter_select my-4">Unread</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(function() {
        $(".su_filter_select").click(function() {
            $(this).toggleClass("active");
        });
    });
</script>
<script>
    $(function() {
        $(".su_chat_user_box").click(function() {
            $(this).addClass("active");
        });
    });
</script>
@endsection