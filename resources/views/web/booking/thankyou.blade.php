@extends('layouts.master')

@section('title')
    Pakket2Go - Thank You
@endsection

@section('content')
    <style>
        .order {
            background: #FC4C00;
            border-radius: 19px;
            color: white;

        }

        .order_detail {
            text-align: center;
            background: #FFFFFF;
            box-shadow: 2.09362px 2.09362px 10.4681px 3.14043px rgba(0, 0, 0, 0.1);
            border-radius: 20.9362px;
        }

        .order_p {
            font-family: Poppins;
            font-size: 18px;
            font-weight: 400;
            line-height: 27px;
            letter-spacing: 0px;
            text-align: center;

        }

        .parent {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: calc(100vh - 76px);
        }
    </style>
    <div class="parent">
        <div class="card order_detail mx-auto py-4" style="width: 500px;">
            <div class="card-body">
                <figure>
                    <img src="{{ asset('public/website/img/thankyou.png') }}" alt="logo">
                </figure>
                <h1>{{ __('home.Thank You') }}!</h1>
                <p class="order_p">{{ __('home.Your order has been sucessfully created') }}</p>
                <a href="{{ url('home/mylisting') }}" class="btn order">{{ __('home.Track my order') }}</a>
            </div>
        </div>
    </div>
@endsection
