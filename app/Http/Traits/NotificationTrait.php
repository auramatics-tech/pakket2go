<?php

namespace App\Http\Traits;

use Http;
use Log;

trait NotificationTrait
{

    protected function sendPushNotification($token = "", $msg = "", $type = "", $booking_id = "")
    {
        $notification = array(
            "to" => $token,
            "notification" => array(
                "title" => 'New Notification',
                "body" => $msg,
                "content_available" => true,
                "priority" => "high"
            ),
            "data" => array("targetScreen" => "detail", "type" => $type, "booking_id" => $booking_id),
            "priority" => 'high',
            "sound" => 'app_sound.wav',
            "content_available" => true,
        );

        $headers = array(
            'Content-Type: application/json',
            'Authorization: key=' . env('FCM_KEY')
        );

        try {
            
            Log::channel('notification')->info($notification);
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($notification));
			$result = curl_exec($ch);
			curl_close($ch);
            Log::channel('notification')->info($result);
            //code...
        } catch (\Throwable $th) {
            Log::channel('notification')->error('Error sending notification:- ' . $th->getMessage());
        }
    }
}
