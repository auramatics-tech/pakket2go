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
                            <img src="{{isset($result['conversation'][0]->sender_profile_pic)?asset($result['conversation'][0]->sender_profile_pic):asset('assets/img/user_img.png')}}" alt="">
                          
                        </div>
                        <div class="su_user_name_topic">
                           {{$result['conversation'][0]->receiver_firstname}} {{$result['conversation'][0]->receiver_lastname}}
                        </div>
                    </div>
                </div>
                <div class=""></div>
            </div>
            <div class="">
                <div class="su_detail_page_bg su_padding_chat_section" id="chat_sections">
                @if(count($result))
                @foreach($result['conversation'] as $chating)
                    <p class="su_day_name_date">{{$chating->created_at->diffForHumans()}}</p>
                    @if($chating->sender_id == Auth::id())
                    <div class=" su_chat_right">
                        <div class="su_msg">@if($chating->type == 1){{$chating->message}} @else <img src="{{ asset($chating->message) }}" alt=""> @endif</div>
                        <div class="d-flex justify-content-end my-4 align-items-center">
                            <p class="su_msg_time">{{date('h:i A',strtotime($chating->created_at))}}</p>
                            <img src="{{ asset('assets/svg/seen_msg.svg') }}" alt="">
                            <img src="{{ asset('assets/svg/rec_svg.svg') }}" alt="">
                            <img src="{{ asset('assets/svg/send_svg.svg') }}" alt="">
                        </div>
                    </div>
                    @else
                    <div class="su_chat_left">
                        <div class="d-flex">
                            <div class="su_user_msg_send_img">
                                <img src="{{isset($result['conversation'][0]->sender_profile_pic)?asset($result['conversation'][0]->sender_profile_pic):asset('assets/img/user_img.png')}}" alt="">
                            </div>
                            <div class="su_chat_width">
                                <div class="su_msg_receive">@if($chating->type == 1){{$chating->message}} @else <img src="{{ asset($chating->message) }}" alt=""> @endif</div>
                                <div class="d-flex justify-content-start my-4">
                                    <p class="su_msg_time">{{date('h:i A',strtotime($chating->created_at))}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
                @endif
                </div>
                <div class="d-flex align-items-center su_padding_msg_send_input type_messege">
                    <div class="su_chat_width_10"><img class="su_img_height2" id="new_file" src="{{ asset('assets/svg/add_options.svg') }}" enctype="multipart/form-data" alt="">
                    </div>
                    <div class="su_chat_width_80">
                        <form action="" id="form1" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="image" id="photo_input" style="display: none;">
                            <input type="hidden" id="sender_id_val" name="sender_id" value="{{Auth::id()}}">
                            <input type="hidden" id="receiver_id_val" name="receiver_id" value="{{$result['conversation'][0]->receiver_id}}" >
                            <input type="hidden" id="booking_id_val" name="booking_id" value="{{$result['conversation'][0]->booking_id}}" >
                            <input id="message_val" type="text" name="message" class="su_msg_send_input smile" placeholder="Type a message">
                        </form>
                    </div>
                    <div class="su_chat_width_10"><img class="su_img_height send_msg" src="{{ asset('assets/svg/send_msg_svg.svg') }}" alt=""></div>
                </div>
            </div>
        </div>
        <div class="width_35">
            <div class="su_Shared_Contents">Shared Contents</div>
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12 my-4">
                    <div class="su_Shared_Contents_img">
                    @if(count($result))
                @foreach($result['conversation'] as $chating)
                    @if($chating->type == 2) <img src="{{ asset($chating->message) }}" alt=""> @endif
                    @endforeach
                @endif
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
<script>
    $(document).on('click', '.send_msg', function() {
        var formData = new FormData();
        var fileInput = document.getElementById('photo_input');
        var file = fileInput.files[0];
        if(file){
            formData.append('image', file);
        }
        formData.append('_token', "{{csrf_token()}}");
        formData.append('sender_id', $('#sender_id_val').val());
        formData.append('receiver_id', $('#receiver_id_val').val());
        formData.append('booking_id', $('#booking_id_val').val());
        if($('#message_val').val()){
            formData.append('message', $('#message_val').val());
        }
        $.ajax({
            method: "post",
            headers:{'Accept':'application/json'},
            url: "{{route('update_conversation')}}",
            data: formData,
            processData: false,
            contentType: false,
            success : function(data) { 
                // console.log(data.data.conversation)
                // var html = '';
                // $('#chat_sections').html('');
                // $.each(data.data.conversation, function(k, v) {
                //     html += '<p class="su_day_name_date">'+v.created_at+'</p>';
                //     if(v.sender_id == "{{Auth::id()}}"){
                //         html += '<div class=" su_chat_right">\n\
                //         <div class="su_msg">';
                //         if(v.type == 1){
                //             html += v.message
                //         }else{
                //             html += '<img src="'+v.message+'" alt=""></div>'
                //         }
                //         html += '<div class="d-flex justify-content-end my-4 align-items-center">\n\
                //             <p class="su_msg_time">'+v.created_at+'</p>\n\
                //             <img src="" alt="">\n\
                //             <img src="" alt="">\n\
                //             <img src="" alt="">\n\
                //         </div>\n\
                //     </div>';
                //     }else{
                //         html += '<div class="su_chat_left">\n\
                //         <div class="d-flex">\n\
                //             <div class="su_user_msg_send_img">\n\
                //                 <img src="" alt="">\n\
                //             </div>\n\
                //             <div class="su_chat_width">\n\
                //                 <div class="su_msg_receive">';if(v.type == 1){
                //             html += v.message
                //         }else{
                //             html += '<img src="'+v.message+'" alt=""></div>'
                //         }
                //         html += '</div>\n\
                //                 <div class="d-flex justify-content-start my-4">\n\
                //                     <p class="su_msg_time">'+v.created_at+'</p>\n\
                //                 </div>\n\
                //             </div>\n\
                //         </div>\n\
                //     </div>';
                //     }
                // });
                // $('#chat_sections').html(html);  
                // if($('#message_val').val()){
                //     $('#message_val').val('');
                // }   
                window.location.reload()     
            }
        })
    });  
</script>
<script>
 	$(document).on('click', '#new_file', function() {
		$('#photo_input').trigger('click')
	}) 
</script>
@endsection