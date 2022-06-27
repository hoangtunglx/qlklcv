<?php

namespace App\Http\Controllers;

use App\Models\QuyDoiGiamDinhMuc;
use Illuminate\Http\Request;

class QuyDoiGiamDinhMucController extends Controller
{
    //
    public function getDanhSach()
	{
		$quydoigiamdinhmuc = QuyDoiGiamDinhMuc::all();
		return view('dashboard.supmanager.danhmuc.quydoigiamdinhmuc', compact('quydoigiamdinhmuc'));
	}
    public function postThem(Request $request)
	{
		$this->validate($request, [
        	'ID' => ['required', 'string', 'max:10', 'unique:quydoigiamdinhmuc'],
			'HoatDong' => ['required', 'string', 'max:191'],
            'PhanTramDinhMuc' => ['required', 'numeric', 'min:0'],
        	'NamHoc' => ['required', 'string', 'max:9']
		]);
		
		$orm = new QuyDoiGiamDinhMuc();
		$orm->ID = $request->ID;
		$orm->HoatDong = $request->HoatDong;
		$orm->PhanTramDinhMuc = $request->PhanTramDinhMuc;
        $orm->NamHoc = $request->NamHoc;
		$orm->save();
		return redirect()->route('supmanager.quydoigiamdinhmuc');
	}
    public function postSua(Request $request)
	{

		$this->validate($request, [
            'ID_edit' => ['required', 'string', 'max:10', 'unique:quydoigiamdinhmuc,ID,'. $request->id_old.',ID'],
            'HoatDong_edit' => ['required', 'string', 'max:191'],
			'PhanTramDinhMuc_edit' => ['required', 'numeric', 'min:0'],
            'NamHoc_edit' => ['required', 'string', 'max:9']

		]);
		
		$orm = QuyDoiGiamDinhMuc::find($request->id_old);
		$orm->ID = $request->ID_edit;
		$orm->HoatDong = $request->HoatDong_edit;
		$orm->PhanTramDinhMuc = $request->PhanTramDinhMuc_edit;
        $orm->NamHoc = $request->NamHoc_edit;
		$orm->save();
		return redirect()->route('supmanager.quydoigiamdinhmuc');
	}
	public function postXoa(Request $request)
	{
		$orm = QuyDoiGiamDinhMuc::find($request->ID_delete);
		$orm->delete();
		return redirect()->route('supmanager.quydoigiamdinhmuc');
	}
}
