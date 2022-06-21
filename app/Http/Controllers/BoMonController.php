<?php

namespace App\Http\Controllers;

use App\Models\BoMon;
use App\Models\Khoa;
use Illuminate\Http\Request;

class BoMonController extends Controller
{
    //
    public function getDanhSach()
	{
		$bomon = BoMon::all();
        $khoa =Khoa::all();
		return view('dashboard.supmanager.danhmuc.bomon', compact('bomon','khoa'));
	}
    public function postThem(Request $request)
	{
		$this->validate($request, [
            'MaBoMon' => ['required', 'string', 'max:5', 'unique:bomon'],
			'TenBoMon' => ['required', 'string', 'max:191','unique:bomon,TenBoMon'],
            'MaKhoa' => ['required', 'string', 'max:191']
		]);
		
		$orm = new BoMon();
		$orm->MaBoMon = $request->MaBoMon;
		$orm->TenBoMon = $request->TenBoMon;
        $orm->MaKhoa = $request->MaKhoa;
		$orm->save();
		
		// return redirect()->route('dashboard.admin.nguoidung');
		return redirect()->route('supmanager.bomon');
	}
    public function postSua(Request $request)
	{

		$this->validate($request, [
            'MaBoMon_edit' => ['required', 'string', 'max:5', 'unique:bomon,MaBoMon,'. $request->id_edit.',MaBoMon'],
			'TenBoMon_edit' => ['required', 'string', 'max:191','unique:bomon,TenBoMon,'. $request->id_edit.',MaBoMon'],
            'MaKhoa_edit' => ['required', 'string', 'max:191'],
		]);
		
		$orm = BoMon::where('MaBoMon',$request->id_edit)->first();
		$orm->MaBoMon = $request->MaBoMon_edit;
		$orm->TenBoMon = $request->TenBoMon_edit;
        $orm->MaKhoa = $request->MaKhoa_edit;
		$orm->save();
		
		// return redirect()->route('dashboard.admin.nguoidung');
		return redirect()->route('supmanager.bomon');
	}
    public function postXoa(Request $request)
	{
		$orm = BoMon::where('MaBoMon',$request->MaBoMon_delete)->first();
		$orm->delete();
		
		// return redirect()->route('dashboard.admin.taikhoan');
		return redirect()->route('supmanager.bomon');
	}
}
