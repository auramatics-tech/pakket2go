<?php

use App\Models\ParcelOption;

if (!function_exists('skip_steps')) {
    function skip_steps($booking, $current_step = '', $user_id = '')
    {
        $skip_steps = [];
        if ($user_id == '') {
            $user_id = Auth::id();
        }

        $booking_details = $booking->details;
        $parcel_type = $booking->booking_data($booking_details, 'parcel_type', 'id');
        $skip_steps = json_decode(
            ParcelOption::where('id', $parcel_type)
                ->pluck('skip_steps')
                ->first(),
        );

        if ($current_step == 8 && $user_id) {
            $skip_steps[] = 8;
        }
        
        return $skip_steps;
    }
}
