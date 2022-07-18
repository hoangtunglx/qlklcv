<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KeKhaiGiangDayController extends Controller
{
    //
    // getDanhSach_User
    function getDanhSach_User(){
        return view('dashboard.user.kekhaigiangday');
    }
}
