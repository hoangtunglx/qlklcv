<?php

namespace App\Http\Controllers;

use App\Models\Khoa;
use App\Models\Nganh;
use Illuminate\Http\Request;

class NganhController extends Controller
{
    //
    public function getDanhSach()
	{
		$nganh = Nganh::all();
        $khoa =Khoa::all();
		return view('dashboard.supmanager.danhmuc.nganh', compact('nganh','khoa'));
	}
    public function postThem(Request $request)
	{
		$this->validate($request, [
            'MaNganh' => ['required', 'string', 'max:5', 'unique:nganh'],
			'TenNganh' => ['required', 'string', 'max:191','unique:nganh,TenNganh'],
            'MaKhoa' => ['required', 'string', 'max:191']
		]);
		
		$orm = new Nganh();
		$orm->MaNganh = $request->MaNganh;
		$orm->TenNganh = $request->TenNganh;
        $orm->MaKhoa = $request->MaKhoa;
		$orm->save();
		
		return redirect()->route('supmanager.nganh');
	}
    public function postSua(Request $request)
	{

		$this->validate($request, [
            'MaNganh_edit' => ['required', 'string', 'max:5', 'unique:nganh,MaNganh,'. $request->id_edit.',MaNganh'],
			'TenNganh_edit' => ['required', 'string', 'max:191','unique:nganh,TenNganh,'. $request->id_edit.',MaNganh'],
            'MaKhoa_edit' => ['required', 'string', 'max:191'],
		]);
		
		$orm = Nganh::find($request->id_edit);
		$orm->MaNganh = $request->MaNganh_edit;
		$orm->TenNganh = $request->TenNganh_edit;
        $orm->MaKhoa = $request->MaKhoa_edit;
		$orm->save();
		
		return redirect()->route('supmanager.nganh');
	}
    public function postXoa(Request $request)
	{
		$orm = Nganh::find($request->MaNganh_delete);
		$orm->delete();
		
		return redirect()->route('supmanager.nganh');
	}
}
