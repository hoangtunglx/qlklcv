<?php

namespace App\Http\Controllers;

use App\Models\KeKhaiGiangDay_PhanLoai;
use Illuminate\Http\Request;

class KeKhaiGiangDayPhanLoaiController extends Controller
{
    //
    public function getDanhSach()
	{
		$kekhaigiangday_phanloai = KeKhaiGiangDay_PhanLoai::all();
		return view('dashboard.supmanager.danhmuc.kekhaigiangday_phanloai', compact('kekhaigiangday_phanloai'));
	}
    public function postThem(Request $request)
	{
		$this->validate($request, [
			'TenLoai' => ['required', 'string', 'max:191', 'unique:kekhaigiangday_phanloai']
		]);
		
		$orm = new KeKhaiGiangDay_PhanLoai();
		$orm->TenLoai = $request->TenLoai;
		$orm->save();
		
		return redirect()->route('supmanager.kekhaigiangday_phanloai');
	}
    public function postSua(Request $request)
	{

		$this->validate($request, [
			'TenLoai_edit' => ['required', 'string', 'max:191', 'unique:kekhaigiangday_phanloai,TenLoai,'. $request->id_edit.',TenLoai']
		]);
		
		$orm = KeKhaiGiangDay_PhanLoai::find($request->id_edit);
		$orm->TenLoai = $request->TenLoai_edit;
		$orm->save();
		
		return redirect()->route('supmanager.kekhaigiangday_phanloai');
	}
	public function postXoa(Request $request)
	{
		$orm = KeKhaiGiangDay_PhanLoai::find($request->ID_delete);
		$orm->delete();
		
		return redirect()->route('supmanager.kekhaigiangday_phanloai');
	}
}
