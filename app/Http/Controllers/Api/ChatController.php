<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
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


class ChatController extends BaseController
{
    use NotificationTrait;

    public function all_chats(Request $request)
    {

        $url = url('/');

        $conversation = Chat::select(
            'booking_id',
            'sender_id',
            'receiver_id',
            'type',
            DB::raw("(CASE when type ='1' THEN `message` ELSE CONCAT('$url',message) END) as message"),
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

        if (count($conversation))
            return $this->sendResponse($conversation, 'Conversation saved successfully');
        else
            return $this->sendResponse([], 'No conversation found');
    }

    public function conversation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->sendError($errors->first(), [], 200);
        }

        // check if user is associated with booking
        $booking = Booking::when(Auth::user()->user_type == 'courier', function ($query) {
            $query->where("courier_user_id", Auth::id());
        }, function ($query) {
            $query->where("user_id", Auth::id());
        })->where('id', $request->booking_id)->first();

        if (!isset($booking->id)) {
            return $this->sendError('You are not associated with this booking', [], 200);
        }

        if ($request->isMethod('post')) {
            $this->update_conversation($request, $booking);
        }

        $url = url('/');
        $result['booking_status'] = $booking->booking_status();
        $result['conversation'] = Chat::select(
            'booking_id',
            'sender_id',
            'receiver_id',
            'type',
            DB::raw("(CASE when type ='1' THEN `message` ELSE CONCAT('$url',message) END) as message"),
            'chats.created_at',
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


        return $this->sendResponse($result, 'Conversation saved successfully');
    }

    protected function update_conversation($request, $booking)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required_without:image'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->sendError($errors->first(), [], 200);
        }

        $conversation = new Chat();
        $conversation->booking_id = $booking->id;
        $conversation->sender_id = Auth::id();
        $conversation->receiver_id = (Auth::user()->user_type == 'courier') ? $booking->user_id : $booking->courier_user_id;
        if ($request->message) {
            $conversation->message = $request->message;
        }
        $conversation->save();

        if ($request->image) {
            $conversation_image = $conversation->id . '_' . time() . ".png";
            $storage_path = '/storage/uploads/bookings/' . $booking->id . '/conversation';
            $path = public_path($storage_path) . '/' . $conversation_image;
            if (!File::exists($path)) {
                File::makeDirectory($path . 'original', 0775, true, true);
            }
            Image::make(file_get_contents($request->image))->save($path);
            $conversation->message = $storage_path . '/' . $conversation_image;
            $conversation->type = 2;
            $conversation->save();
        }

        $receiver = User::find($conversation->receiver_id);
        // Send push notification
        if ($receiver->device_token)
            $this->sendPushNotification($receiver->device_token, 'You received new message', 'chat', $booking->booking_code);
    }
}
