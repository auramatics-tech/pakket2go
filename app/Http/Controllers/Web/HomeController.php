<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class HomeController extends Controller
{

    /**
     * Landing page 
     */

    public function index()
    {
        return view('web.home');
    }

    public function howitworks()
    {
        return view('web.howitworks');
    }

    public function become_courier()
    {
        return view('web.become_courier');
    }


    public function contact_us()
    {
        return view('web.contact_us');
    }

    public function dashboard_user()
    {
        return view('web.dashboard_user');
    }

    public function dashboard_courier()
    {
        return view('web.dashboard_courier');
    }

    public function order_detail()
    {
        return view('web.order_detail_invoice');
    }

    public function order_detail_pdf(){
        return view('web.order_detail_invoice_pdf');
    }
}
