<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KeKhaiHoatDongKhacController extends Controller
{
    //
    function getDanhSach_User(){
        return view('dashboard.user.kekhaihoatdongkhac');
    }
}
