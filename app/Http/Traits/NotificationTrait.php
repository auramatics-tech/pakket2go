<?php

namespace App\Http\Traits;

use Http;
use Log;

trait NotificationTrait
{

    protected function sendPushNotification($token = "", $msg = "", $type = "", $booking_id = "")
    {
        $data = array(
            "to" => $token,
            "notification" => array(
                "body" => $msg,
                "content_available" => true,
                "priority" => "high"
            ),
            "data" => array("targetScreen" => "detail", "type" => $type, "booking_id" => $booking_id),
            "priority" => 'high',
            "sound" => 'app_sound.wav',
            "content_available" => true,
        );

        Log::channel('notification')->info($data);

        $headers = array(
            'Content-Type: application/json',
            'Authorization: key=' . env('FCM_KEY')
        );

        try {
            $result = Http::withHeaders([
                $headers
            ])->post(env('FCM_URL'), [
                $data,
            ]);

            Log::channel('notification')->info($result->json());
            //code...
        } catch (\Throwable $th) {
            Log::channel('notification')->error('Error sending notification:- ' . $th->getMessage());
        }
    }
}
