<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class BookingRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    public function validationData()
    {
        $data = $this->all();
        if ($this->step == 3) {
            $data['parcel_size'] =  $this->meter_cube();
        }

        return $data;
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        $response = [
            'success' => false,
            'data'    => [],
            'message' => $errors->first(),
        ];

        throw new HttpResponseException(response()->json($response, 200));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->step) {
            case 1:
                return $this->address();
                break;
            case 2:
                return $this->parcel_type();
                break;
            case 3:
                return $this->parcel_details();
                break;
            case 4:
                return $this->pickup_date();
                break;
            case 5:
                return $this->extra_help();
                break;
            case 6:
                return $this->pickup_floor();
                break;
            case 7:
                return $this->delivery_floor();
                break;
            case 9:
                return $this->pickup_address();
                break;
            case 10:
                return $this->delivery_address();
                break;
            case 11:
                return $this->payment();
                break;

            default:
                # code...
                break;
        }
    }

    protected function address()
    {
        return [
            'pickup_address' => ['required'],
            'pickup_street' => ['required'],
            'pickup_lat' => ['required'],
            'pickup_lng' => ['required'],
            'step' => ['required'],
            'delivery_address' => ['required'],
            'delivery_street' => ['required'],
            'delivery_lat' => ['required'],
            'delivery_lng' => ['required']
        ];
    }

    protected function parcel_type()
    {
        return [
            'step' => ['required'],
            'booking_id' => ['required'],
            'type_id' => ['required'],
        ];
    }

    protected function meter_cube()
    {

        $meter_cube = 0;
        if (isset($this->width) && count($this->width)) {
            foreach ($this->width as $key => $val) {
                $cm_cube = $this->width[$key] * $this->height[$key] * $this->length[$key];
                $meter_cube +=  $cm_cube / 1000000;
            }
        }
        if ($meter_cube > 6) {
            return 7;
        }
        return round($meter_cube, 0);
    }

    protected function parcel_details()
    {

        return [
            'step' => ['required'],
            'booking_id' => ['required'],
            'width' => ['required'],
            'height' => ['required'],
            'length' => ['required'],
            'parcel_size' => ['required', 'integer', 'max:6'],
        ];
    }

    protected function pickup_date()
    {
        return [
            'step' => ['required'],
            'booking_id' => ['required'],
            'pickup_date' => ['required'],
        ];
    }

    protected function extra_help()
    {
        return [
            'step' => ['required'],
            'booking_id' => ['required'],
            'type_id' => ['required'],
        ];
    }

    protected function pickup_floor()
    {
        return [
            'step' => ['required'],
            'booking_id' => ['required'],
            'type_id' => ['required'],
        ];
    }

    protected function delivery_floor()
    {
        return [
            'step' => ['required'],
            'booking_id' => ['required'],
            'type_id' => ['required'],
        ];
    }

    protected function pickup_address()
    {
        return [
            'step' => ['required'],
            'booking_id' => ['required'],
            'delivery_address' => ['required'],
            'delivery_postcode' => ['required'],
            'delivery_street' => ['required'],
            'delivery_lat' => ['required'],
            'delivery_lng' => ['required']
        ];
    }

    protected function delivery_address()
    {
        return [
            'step' => ['required'],
            'booking_id' => ['required'],
            'delivery_address' => ['required'],
            'delivery_postcode' => ['required'],
            'delivery_street' => ['required'],
            'delivery_lat' => ['required'],
            'delivery_lng' => ['required']
        ];
    }

    protected function payment()
    {
        return [
            'step' => ['required'],
            'booking_id' => ['required'],
            'transaction_id' => ['required'],
            'status' => ['required']
        ];
    }
}
