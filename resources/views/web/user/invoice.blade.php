<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pakket2Go - Address</title>
</head>

<body style="font-family: 'Poppins';font-style: normal;">
    <header>
        <table style="background-color: #01B537;width:100%;padding: 8px 20px;">
            <tr style="">
                <th style="text-align: left;">
                    <h1 style="font-weight: 600;font-size: 22px;line-height: 33px;color: #FAF9F7;margin-bottom: 0px;margin-top: 0px;">Dashboard</h1>
                </th>
                <th style="text-align: right;">
                    <div style="display: flex;background: white;width: fit-content;margin-left: auto;border-radius: 20px;">
                        <button style=" background: #FAF9F7;border: 0;font-weight: 500;font-size: 14px;line-height: 24px;display: flex;text-align: center;text-transform: capitalize;color: #000000;padding: 5px 14px;border: 1px solid #FFFFFF;border-radius: 48px;">English</button>
                        <!-- <button style=" background: #FAF9F7;border: 0;font-weight: 500;font-size: 14px;line-height: 24px;display: flex;text-align: center;text-transform: capitalize;color: #000000;padding: 5px 14px;border: 1px solid #FFFFFF;border-radius: 48px; background: #01B537;border: 1px solid #FFFFFF;border-radius: 48px;color: #FFFFFF;padding: 5px 20px;">Dutch</button> -->
                    </div>
                </th>
            </tr>
        </table>
    </header>
    <section style="margin: 20px 0px;background: #FFFFFF;border: 2.49138px solid #D9D9D9;border-radius: 24.9138px;padding: 10px 30px;">
        <table style="width:100%;">
            <tbody style="">
                <tr>
                    <th style="text-align: left;width:50%">
                        <p style="margin: 0px;font-weight: 500;font-size: 17px;line-height: 26px;color: #000000;">{{ $booking->booking_code }}<span style="background: #EEF8F0;border: 1.24569px solid #D9D9D9;border-radius: 62.2845px;font-weight: 500;font-size: 17px;line-height: 26px;color: #000000;margin-left: 10px;padding: 7px 15px;">Ready to Pickup</span></p>   
                    </th>
                    <th style="text-align:left;width:25%">
                        <p style="margin: 0px;font-weight: 500;font-size: 17px;line-height: 26px;color: #313131;">Distance ({{ $booking->address->distance }} Km)</p>
                    </th>
                    @if (Auth::user()->user_type != 'courier')
                    <th style="text-align:right;width:25%">
                        <p style="margin: 0px;font-weight: 500;font-size: 17px;line-height: 26px;color: #313131;">€
                            {{ number_format($booking->distance_price, 2) }}
                        </p>
                    </th>
                    @endif
                </tr>
                <tr>
                    <th style="text-align: left;width:50%">

                        <p style="margin: 0px;font-weight: 600;font-size: 17px;line-height: 26px;color: #FC4C00;">€{{ Auth::user()->user_type == 'courier' && Auth::user()->id != $booking->id ? number_format($booking->courier_price, 2) : number_format($booking->final_price, 2) }}</p>

                    </th>
                    <th style="text-align:left;width:25%">
                        <p style="margin: 0px;font-weight: 500;font-size: 17px;line-height: 26px;color: #313131;">{{ $booking->booking_data($booking_details, 'parcel_type', 'name') }}</p>
                    </th>

                    <th style="text-align:right;width:25%">
                        @if (Auth::user()->user_type != 'courier')
                        <p style="margin: 0px;font-weight: 500;font-size: 17px;line-height: 26px;color: #313131;"> €{{ $booking->booking_data($booking_details, 'parcel_type', 'price') }}
                        </p>
                        @endif
                    </th>

                </tr>
                <tr>
                    <th style="text-align: left;width:50%">
                    </th>
                    <th style="text-align:left;width:25%">
                        <p style="margin: 0px;font-weight: 500;font-size: 17px;line-height: 26px;color: #313131;">{{ $booking->booking_data($booking_details, 'extra_help', 'name') }} </p>
                    </th>
                    <th style="text-align:right;width:25%">
                        @if (Auth::user()->user_type != 'courier')
                        <p style="margin: 0px;font-weight: 500;font-size: 17px;line-height: 26px;color: #313131;">€
                            {{ $booking->booking_data($booking_details, 'extra_help', 'price') }}
                        </p>
                        @endif
                    </th>
                </tr>
            </tbody>
        </table>
        <section style="border-bottom: 1px solid black;margin: 10px 0px;"></section>
        <table style="width:100%;">
            <tbody style="">
                <tr>
                    <th style="text-align: left;width:50%">
                        <p style="font-weight: 600;font-size: 17px;line-height: 26px;color: #FC4C00;margin:0px;">From >> <span style="font-weight: 500;font-size: 17px;line-height: 26px;color: #313131;"> {{ $booking->address->pickup_address }}</span> </p>
                    </th>
                    <th style="text-align:left;width:50%">
                        @if ($booking->booking_data($booking_details, 'pickup_date', 'date'))
                        <p style="margin: 0px;font-weight: 500;font-size: 17px;line-height: 26px;color: #313131;"> {{ date('l, d F Y', strtotime($booking->booking_data($booking_details, 'pickup_date', 'date'))) }}</p>
                        @endif
                    </th>
                </tr>
            </tbody>
        </table>
        <section style="border-bottom: 1px solid black;margin: 10px 0px;"></section>
        <table style="width:100%;">
            <tbody style="">
                <tr>
                    <th style="text-align: left;width:50%">
                        <p style="font-weight: 600;font-size: 17px;line-height: 26px;color: #01B537;margin:0px;">To >> <span style="font-weight: 500;font-size: 17px;line-height: 26px;color: #313131;"> {{ $booking->address->delivery_address }}</span> </p>
                    </th>
                    <th style="text-align:left;width:50%">
                        @if ($booking->booking_data($booking_details, 'pickup_date', 'date'))
                        <p style="margin: 0px;font-weight: 500;font-size: 17px;line-height: 26px;color: #313131;">{{ date('l, d F Y', strtotime($booking->booking_data($booking_details, 'pickup_date', 'date'))) }}</p>
                        @endif
                    </th>
                </tr>
            </tbody>
        </table>
        <section style="border-bottom: 1px solid black;margin: 10px 0px;"></section>
        <table style="width:100%;">
            <tbody>
                <tr>
                    <th style="text-align:right; width:50%"></th>
                    <th style="text-align:left; width:25%">
                        <p style="margin: 0px;font-weight: 500;font-size: 17px;line-height: 26px;color: #313131;">Total Price</p>
                    </th>
                    <th style="text-align:right; width:25%">
                        <p style="font-weight: 700;font-size: 17px;line-height: 26px;color: #FC4C00;margin:0px;">€
                            {{ Auth::user()->user_type == 'courier' && Auth::user()->id != $booking->id ? number_format($booking->courier_price, 2) : number_format($booking->final_price, 2) }}
                        </p>
                    </th>
                </tr>
            </tbody>
        </table>
    </section>

    <section style="background: #25282B;margin: 20px 0px;padding: 30px 30px;">

        <table style="width:100%;">
            <tbody>
                <tr>
                    <th style="text-align:left;width:50%">
                        <p style="font-weight: 600;font-size: 17px;line-height: 26px;letter-spacing: 0.257966px;color: #01B537;margin: 8px 0px;">About Us</p>
                    </th>
                    <th style="text-align:left;width:50%">
                        <p style="font-weight: 600;font-size: 17px;line-height: 26px;letter-spacing: 0.257966px;color: #01B537;margin: 8px 0px;">Contact Us</p>
                    </th>
                </tr>
                <tr>
                    <th style="text-align:left;width:50%">
                        <p style="font-weight: 400;font-size: 18.0576px;line-height: 23px;color: #FFFFFF;margin:0px;">Legal</p>
                    </th>
                    <th style="text-align:left;width:50%">
                        <p style="font-weight: 400;font-size: 18.0576px;line-height: 23px;color: #FFFFFF;margin:0px;">+123 456 789 10</p>
                    </th>
                </tr>
                <tr>
                    <th style="text-align:left;width:50%">
                        <p style="font-weight: 400;font-size: 18.0576px;line-height: 23px;color: #FFFFFF;margin:0px;">Privacy Policy</p>
                    </th>
                    <th style="text-align:left;width:50%">
                        <p style="font-weight: 400;font-size: 18.0576px;line-height: 23px;color: #FFFFFF;margin:0px;">info.pakket2go.com</p>
                    </th>
                </tr>
                <tr>
                    <th style="text-align:left;width:50%">
                        <p style="font-weight: 400;font-size: 18.0576px;line-height: 23px;color: #FFFFFF;margin:0px;">Terms and conditions</p>
                    </th>
                    <th style="text-align:left;width:50%">
                        <p style="font-weight: 400;font-size: 18.0576px;line-height: 23px;color: #FFFFFF;margin:0px;">Location, City</p>
                    </th>
                </tr>
            </tbody>
        </table>

        <table style="width:100%;  margin:10px 0px;">
            <tbody>
                <tr>
                    <th style="width:50%;text-align:left;">
                        <p style="font-weight: 400;font-size: 18.06px;line-height: 20px;color: #FFFFFF;margin:0px;">We connect customers and couriers. As experienced entrepreneurs with different expertise, we simplify the transport of goods for companies and couriers.</p>
                    </th>
                    <th style="width:50%;text-align:left;">
                        <ul style="list-style-type:none;padding:0px;">
                            <li style="font-weight: 400;font-size: 18.0576px;line-height: 23px;color: #FFFFFF;margin:0px;">Facebook</li>
                            <li style="font-weight: 400;font-size: 18.0576px;line-height: 23px;color: #FFFFFF;margin:0px;">Instagram</li>
                            <li style="font-weight: 400;font-size: 18.0576px;line-height: 23px;color: #FFFFFF;margin:0px;">Twitter</li>
                            <li style="font-weight: 400;font-size: 18.0576px;line-height: 23px;color: #FFFFFF;margin:0px;">LinkedIn</li>
                        </ul>
                    </th>
                </tr>
            </tbody>
        </table>

        <table style="background: #01B537;border-radius: 20px;width: 100%;margin: auto;">
            <tbody>
                <tr>
                    <th style="text-align: center;padding: 0px 15px;">
                        <p style="font-weight: 600;font-size: 18px;line-height: 18px;color: #FFFFFF;"> 2022 Pakket2Go Limited. All rights reserved.</p>
                    </th>
                </tr>
            </tbody>
        </table>

    </section>


</body>

</html>