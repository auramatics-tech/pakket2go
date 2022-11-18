@extends('web.user.layouts.master')

@section('content')
<div class="d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="" class="su_container_dashboard su_chat_bg">
            <div class="d-flex align-items-center justify-content-between">
                <div class="su_width_lg_100 my-4">
                    <form action="/action_page.php">
                        <input class="su_chat_search_input search" type="text" id="" name="" value="" placeholder="search here...">
                    </form>
                </div>
                <div class="su_chat_filter_icon">
                    <button class="su_chat_filter_btn" data-bs-toggle="modal" data-bs-target="#chat_filter">
                    <img src="{{ asset('assets/svg/chat_filter.svg') }}" alt="">
                    </button>
                </div>
            </div>
            <div class="su_chat_margin_top">
                <a href="javascript:;">
                    <div class="su_chat_user_box my-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <span class="badge su_active_badge su_position_active">0</span>
                                <div class="su_chat_user_img">
                                    <img src="{{ asset('assets/img/user_img.png') }}" alt="">
                                </div>
                            </div>
                            <div class="su_flex_column ms-2">
                                <p class="su_chat_user_name">Ridikamiana</p>
                                <p class="su_chat_user_chat">You: <span class="su_chat_user_chat_margin">Great</span> 😍</p>
                            </div>
                            <div class="su_flex_column ms-auto">
                                <div>
                                    <p class="su_chat_seen">Just Now</p>
                                </div>
                                <div class="su_seen_img">
                                    <img src="{{ asset('assets/svg/seen_msg.svg') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="javascript:;">
                    <div class="su_chat_user_box my-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <span class="badge su_unactive_badge su_position_active">0</span>
                                <div class="su_chat_user_img">
                                    <img src="{{ asset('assets/img/user_img2.png') }}" alt="">
                                </div>
                            </div>
                            <div class="su_flex_column ms-2">
                                <p class="su_chat_user_name">Ridikamiana</p>
                                <p class="su_chat_user_chat">You: <span class="su_chat_user_chat_margin">Hi</span></p>
                            </div>
                            <div class="su_flex_column ms-auto">
                                <div>
                                    <p class="su_chat_seen">Just Now</p>
                                </div>
                                <div class="su_seen_img">
                                    <img src="{{ asset('assets/svg/rec_svg.svg') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="javascript:;">
                    <div class="su_chat_user_box my-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <span class="badge su_active_badge su_position_active">0</span>
                                <div class="su_chat_user_img">
                                    <img src="{{ asset('assets/img/user_img3.png') }}" alt="">
                                </div>
                            </div>
                            <div class="su_flex_column ms-2">
                                <p class="su_chat_user_name">Ridikamiana</p>
                                <p class="su_chat_user_chat">You: <span class="su_chat_user_chat_margin">What’s the procedure?</span> </p>
                            </div>
                            <div class="su_flex_column ms-auto">
                                <div>
                                    <p class="su_chat_seen">Just Now</p>
                                </div>
                                <div class="su_seen_img">
                                    <img src="{{ asset('assets/svg/send_svg2.svg') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="javascript:;">
                    <div class="su_chat_user_box my-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <span class="badge su_active_badge su_position_active">0</span>
                                <div class="su_chat_user_img">
                                    <img src="{{ asset('assets/img/user_img.png') }}" alt="">
                                </div>
                            </div>
                            <div class="su_flex_column ms-2">
                                <p class="su_chat_user_name">Ridikamiana</p>
                                <p class="su_chat_user_chat">You: <span class="su_chat_user_chat_margin">Great</span> 😍</p>
                            </div>
                            <div class="su_flex_column ms-auto">
                                <div>
                                    <p class="su_chat_seen">Just Now</p>
                                </div>
                                <div class="su_seen_img">
                                    <img src="{{ asset('assets/svg/seen_msg.svg') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="javascript:;">
                    <div class="su_chat_user_box my-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <span class="badge su_unactive_badge su_position_active">0</span>
                                <div class="su_chat_user_img">
                                    <img src="{{ asset('assets/img/user_img2.png') }}" alt="">
                                </div>
                            </div>
                            <div class="su_flex_column ms-2">
                                <p class="su_chat_user_name">Ridikamiana</p>
                                <p class="su_chat_user_chat">You: <span class="su_chat_user_chat_margin">Hi</span></p>
                            </div>
                            <div class="su_flex_column ms-auto">
                                <div>
                                    <p class="su_chat_seen">Just Now</p>
                                </div>
                                <div class="su_seen_img">
                                    <img src="{{ asset('assets/svg/rec_svg.svg') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="javascript:;">
                    <div class="su_chat_user_box my-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <span class="badge su_active_badge su_position_active">0</span>
                                <div class="su_chat_user_img">
                                    <img src="{{ asset('assets/img/user_img3.png') }}" alt="">
                                </div>
                            </div>
                            <div class="su_flex_column ms-2">
                                <p class="su_chat_user_name">Ridikamiana</p>
                                <p class="su_chat_user_chat">You: <span class="su_chat_user_chat_margin">What’s the procedure?</span> </p>
                            </div>
                            <div class="su_flex_column ms-auto">
                                <div>
                                    <p class="su_chat_seen">Just Now</p>
                                </div>
                                <div class="su_seen_img">
                                    <img src="{{ asset('assets/svg/send_svg2.svg') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="javascript:;">
                    <div class="su_chat_user_box my-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <span class="badge su_active_badge su_position_active">0</span>
                                <div class="su_chat_user_img">
                                    <img src="{{ asset('assets/img/user_img.png') }}" alt="">
                                </div>
                            </div>
                            <div class="su_flex_column ms-2">
                                <p class="su_chat_user_name">Ridikamiana</p>
                                <p class="su_chat_user_chat">You: <span class="su_chat_user_chat_margin">Great</span> 😍</p>
                            </div>
                            <div class="su_flex_column ms-auto">
                                <div>
                                    <p class="su_chat_seen">Just Now</p>
                                </div>
                                <div class="su_seen_img">
                                    <img src="{{ asset('assets/svg/seen_msg.svg') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="javascript:;">
                    <div class="su_chat_user_box my-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <span class="badge su_unactive_badge su_position_active">0</span>
                                <div class="su_chat_user_img">
                                    <img src="{{ asset('assets/img/user_img2.png') }}" alt="">
                                </div>
                            </div>
                            <div class="su_flex_column ms-2">
                                <p class="su_chat_user_name">Ridikamiana</p>
                                <p class="su_chat_user_chat">You: <span class="su_chat_user_chat_margin">Hi</span></p>
                            </div>
                            <div class="su_flex_column ms-auto">
                                <div>
                                    <p class="su_chat_seen">Just Now</p>
                                </div>
                                <div class="su_seen_img">
                                    <img src="{{ asset('assets/svg/rec_svg.svg') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="javascript:;">
                    <div class="su_chat_user_box my-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <span class="badge su_active_badge su_position_active">0</span>
                                <div class="su_chat_user_img">
                                    <img src="{{ asset('assets/img/user_img3.png') }}" alt="">
                                </div>
                            </div>
                            <div class="su_flex_column ms-2">
                                <p class="su_chat_user_name">Ridikamiana</p>
                                <p class="su_chat_user_chat">You: <span class="su_chat_user_chat_margin">What’s the procedure?</span> </p>
                            </div>
                            <div class="su_flex_column ms-auto">
                                <div>
                                    <p class="su_chat_seen">Just Now</p>
                                </div>
                                <div class="su_seen_img">
                                    <img src="{{ asset('assets/svg/send_svg2.svg') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="javascript:;">
                    <div class="su_chat_user_box my-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <span class="badge su_active_badge su_position_active">0</span>
                                <div class="su_chat_user_img">
                                    <img src="{{ asset('assets/img/user_img.png') }}" alt="">
                                </div>
                            </div>
                            <div class="su_flex_column ms-2">
                                <p class="su_chat_user_name">Ridikamiana</p>
                                <p class="su_chat_user_chat">You: <span class="su_chat_user_chat_margin">Great</span> 😍</p>
                            </div>
                            <div class="su_flex_column ms-auto">
                                <div>
                                    <p class="su_chat_seen">Just Now</p>
                                </div>
                                <div class="su_seen_img">
                                    <img src="{{ asset('assets/svg/seen_msg.svg') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="javascript:;">
                    <div class="su_chat_user_box my-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <span class="badge su_unactive_badge su_position_active">0</span>
                                <div class="su_chat_user_img">
                                    <img src="{{ asset('assets/img/user_img2.png') }}" alt="">
                                </div>
                            </div>
                            <div class="su_flex_column ms-2">
                                <p class="su_chat_user_name">Ridikamiana</p>
                                <p class="su_chat_user_chat">You: <span class="su_chat_user_chat_margin">Hi</span></p>
                            </div>
                            <div class="su_flex_column ms-auto">
                                <div>
                                    <p class="su_chat_seen">Just Now</p>
                                </div>
                                <div class="su_seen_img">
                                    <img src="{{ asset('assets/svg/rec_svg.svg') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="javascript:;">
                    <div class="su_chat_user_box my-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <span class="badge su_active_badge su_position_active">0</span>
                                <div class="su_chat_user_img">
                                    <img src="{{ asset('assets/img/user_img3.png') }}" alt="">
                                </div>
                            </div>
                            <div class="su_flex_column ms-2">
                                <p class="su_chat_user_name">Ridikamiana</p>
                                <p class="su_chat_user_chat">You: <span class="su_chat_user_chat_margin">What’s the procedure?</span> </p>
                            </div>
                            <div class="su_flex_column ms-auto">
                                <div>
                                    <p class="su_chat_seen">Just Now</p>
                                </div>
                                <div class="su_seen_img">
                                    <img src="{{ asset('assets/svg/send_svg2.svg') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
        <div class="width_35">
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