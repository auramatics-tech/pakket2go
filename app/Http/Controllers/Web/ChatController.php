<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\NotificationTrait;
use App\Models\Booking;
use App\Models\Chat;
use App\Models\User;
use Auth;
use Validator;
use Image;
use File;
use DB;

use function PHPSTORM_META\type;

class ChatController extends Controller
{
  
    public function chat(Request $request){
        $url = url('/');
        $conversation = Chat::select(
            'booking_id',
            'sender_id',
            'receiver_id',
            'type',
            DB::raw("(CASE when type ='1' THEN `message` ELSE CONCAT('$url',message) END) as message"),
            DB::raw("(select users.profile_pic from `users` where `users`.`id` = chats.receiver_id) as sender_profile_pic"),
            'chats.created_at',
            'receiver.first_name as receiver_firstname',
            'receiver.last_name as receiver_lastname',
            'sender.first_name as sender_firstname',
            'sender.last_name as sender_lastname'
        )
            ->leftJoin('users as receiver', 'chats.receiver_id', '=', 'receiver.id')
            ->leftJoin('users as sender', 'chats.sender_id', '=', 'sender.id')
            ->whereIn('chats.id', function ($query) {
                $query->from('chats')->select(DB::raw('max(id) as id'))
                    ->groupby('chats.booking_id');
            })
            ->where(function ($query) {
                $query->where('sender_id', Auth::id())->orwhere('receiver_id', Auth::id());
            })
            ->get();
            // echo "<pre>";print_r($conversation);die;
            return view('web.user.chat',compact('conversation'));
            
    }

    public function chat_detail(Request $request , $id){
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);
        // check if user is associated with booking
        $booking = Booking::when(Auth::user()->user_type == 'courier', function ($query) {
            $query->where("courier_user_id", Auth::id());
        }, function ($query) {
            $query->where("user_id", Auth::id());
        })->where('id', $request->id)->first();

        $url = url('/');
        $result['booking_status'] = $booking->booking_status();
        $result['conversation'] = Chat::select(
            'booking_id',
            'sender_id',
            'receiver_id',
            'type',
            DB::raw("(CASE when type ='1' THEN `message` ELSE CONCAT('$url',message) END) as message"),
            DB::raw("(select users.profile_pic from `users` where `users`.`id` = chats.receiver_id) as sender_profile_pic"),
            'chats.created_at',
            'chats.updated_at',
            'receiver.first_name as receiver_firstname',
            'receiver.last_name as receiver_lastname',
            'sender.first_name as sender_firstname',
            'sender.last_name as sender_lastname'
        )
            ->leftJoin('users as receiver', 'chats.receiver_id', '=', 'receiver.id')
            ->leftJoin('users as sender', 'chats.sender_id', '=', 'sender.id')
            ->where(['booking_id' => $booking->id])
            ->latest()
            ->get();
            $shared_content = Chat::where('booking_id',$request->id)->where('type', 2 )->get();
        //  echo "<pre>";print_r($shared_content);die;
        return view('web.user.chat_detail',compact('result','shared_content'));
    }

 
}
