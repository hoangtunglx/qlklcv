<?php

namespace App\Http\Controllers;

use App\Models\Khoa;
use Illuminate\Http\Request;

class KhoaController extends Controller
{
    //
    public function getDanhSach()
	{
		$khoa = Khoa::all();
		return view('dashboard.supmanager.danhmuc.khoa', compact('khoa'));
	}
    public function postThem(Request $request)
	{
		$this->validate($request, [
            'MaKhoa' => ['required', 'string', 'max:5', 'unique:khoa'],
			'TenKhoa' => ['required', 'string', 'max:191', 'unique:khoa']
		]);
		
		$orm = new Khoa();
		$orm->MaKhoa = $request->MaKhoa;
		$orm->TenKhoa = $request->TenKhoa;
		$orm->save();
		
		return redirect()->route('supmanager.khoa');
	}
    public function postSua(Request $request)
	{

		$this->validate($request, [
            'MaKhoa_edit' => ['required', 'string', 'max:5', 'unique:khoa,MaKhoa,'. $request->id_edit.',MaKhoa'],
			'TenKhoa_edit' => ['required', 'string', 'max:191', 'unique:khoa,TenKhoa,'. $request->id_edit.',MaKhoa']
		]);
		
		$orm = Khoa::where('MaKhoa',$request->id_edit)->first();
		$orm->MaKhoa = $request->MaKhoa_edit;
		$orm->TenKhoa = $request->TenKhoa_edit;
		$orm->save();
		
		return redirect()->route('supmanager.khoa');
	}
	public function postXoa(Request $request)
	{
		$orm = Khoa::find($request->MaKhoa_delete);
		$orm->delete();
		
		return redirect()->route('supmanager.khoa');
	}
}
