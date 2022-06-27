<?php

namespace App\Http\Controllers;

use App\Models\DinhMucGiangVien;
use App\Models\GiangVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DinhMucGiangVienController extends Controller
{
    //
	public function getDanhSach_SupManager()
	{
		$dinhmucgiangvien = DinhMucGiangVien::all();
		$giangvien=GiangVien::all();
		return view('dashboard.supmanager.danhmuc.dinhmucgiangvien', compact('dinhmucgiangvien','giangvien'));
	}
}