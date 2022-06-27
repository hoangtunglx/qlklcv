<?php

namespace App\Http\Controllers;

use App\Models\Khoa;
use App\Models\Lop;
use Illuminate\Http\Request;

class LopController extends Controller
{
    //
    public function getDanhSach()
	{
		$lop = Lop::all();
        $khoa=Khoa::all();
		return view('dashboard.supmanager.danhmuc.lop', compact('lop','khoa'));
	}
    public function postThem(Request $request)
	{
		$this->validate($request, [
            'MaLop' => ['required', 'string', 'max:10', 'unique:lop'],
			'TenLop' => ['required', 'string', 'max:191','unique:lop,TenLop'],
            'SiSo' => ['required', 'numeric', 'min:1'],
            'MaKhoa' => ['required', 'string', 'max:5']
		]);
		
		$orm = new Lop();
		$orm->MaLop = $request->MaLop;
		$orm->TenLop = $request->TenLop;
        $orm->SiSo = $request->SiSo;
        $orm->MaKhoa = $request->MaKhoa;
		$orm->save();
		return redirect()->route('supmanager.lop');
	}
    public function postSua(Request $request)
	{

		$this->validate($request, [
            'MaLop_edit' => ['required', 'string', 'max:10', 'unique:lop,MaLop,'. $request->id_edit.',MaLop'],
			'TenLop_edit' => ['required', 'string', 'max:191','unique:lop,TenLop,'. $request->id_edit.',MaLop'],
            'SiSo_edit' => ['required', 'numeric', 'min:1'],
            'MaKhoa_edit' => ['required', 'string', 'max:5'],
		]);
		
		$orm = Lop::find($request->id_edit);
		$orm->MaLop = $request->MaLop_edit;
		$orm->TenLop = $request->TenLop_edit;
        $orm->SiSo = $request->SiSo_edit;
        $orm->MaKhoa = $request->MaKhoa_edit;
		$orm->save();
		return redirect()->route('supmanager.lop');
	}
    public function postXoa(Request $request)
	{
		$orm = Lop::find($request->MaLop_delete);
		$orm->delete();
		return redirect()->route('supmanager.lop');
	}
}
