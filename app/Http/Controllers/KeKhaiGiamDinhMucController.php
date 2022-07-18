<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KeKhaiGiamDinhMucController extends Controller
{
    //
    function getDanhSach_User(){
        return view('dashboard.user.kekhaigiamdinhmuc');
    }
}
