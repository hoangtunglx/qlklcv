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
	public function getDanhSach_User()
	{
		$giangvien= GiangVien::where('Email', Auth::user()->email)->first();
		$dinhmucgiangvien = DinhMucGiangVien::where('MaGiangVien', $giangvien->MaGiangVien)->orderBy('NamHoc','ASC')->get()	;

		return view('dashboard.user.dinhmucgiangvien', compact('dinhmucgiangvien','giangvien'));
	}
	public function postThem_User(Request $request)
	{
		$gv= GiangVien::where('email', Auth::user()->email)->first();
		$this->validate($request, [         
			'DinhMucGiangDay' => ['required', 'numeric', 'min:0'],
            'DinhMucNCKH' => ['required', 'numeric', 'min:0'],
            'NamHoc' => ['required', 'string', 'max:9', 'unique:DinhMucGiangVien,MaGiangVien,'.$gv->MaGiangVien.',MaGiangVien']
		]);
		
		$orm = new DinhMucGiangVien();
		$orm->MaGiangVien = $gv->MaGiangVien;
		$orm->DinhMucGiangDay = $request->DinhMucGiangDay;
        $orm->DinhMucNCKH = $request->DinhMucNCKH;
        $orm->NamHoc = $request->NamHoc;
		$orm->save();
		return redirect()->route('user.dinhmucgiangvien');
	}
	public function postSua_User(Request $request)
	{
		$this->validate($request, [         
			'DinhMucGiangDay_edit' => ['required', 'numeric', 'min:0'],
            'DinhMucNCKH_edit' => ['required', 'numeric', 'min:0'],
            'NamHoc_edit' => ['required', 'string', 'max:9','unique:DinhMucGiangVien,NamHoc,'. $request->ID_edit.',ID']
		]);
		$orm = DinhMucGiangVien::find($request->ID_edit);
		$orm->DinhMucGiangDay = $request->DinhMucGiangDay_edit;
        $orm->DinhMucNCKH = $request->DinhMucNCKH_edit;
        $orm->NamHoc = $request->NamHoc_edit;
		$orm->save();
		return redirect()->route('user.dinhmucgiangvien');
	}
	public function postXoa_User(Request $request)
	{
		$orm = DinhMucGiangVien::find($request->ID_delete);
		$orm->delete();
		return redirect()->route('user.dinhmucgiangvien');
	}
}