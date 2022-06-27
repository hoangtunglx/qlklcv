<?php

namespace App\Http\Controllers;

use App\Models\QuyDoiGioChuan;
use Illuminate\Http\Request;

class QuyDoiGioChuanController extends Controller
{
    //
    public function getDanhSach()
	{
		$quydoigiochuan = QuyDoiGioChuan::all();
		return view('dashboard.supmanager.danhmuc.quydoigiochuan', compact('quydoigiochuan'));
	}
    public function postThem(Request $request)
	{
		$this->validate($request, [
        	'ID' => ['required', 'string', 'max:10', 'unique:quydoigiochuan'],
			'HoatDong' => ['required', 'string', 'max:191'],
            'GioChuan' => ['required', 'numeric', 'min:0'],
        	'NamHoc' => ['required', 'string', 'max:9']
		]);
		
		$orm = new QuyDoiGioChuan();
		$orm->ID = $request->ID;
		$orm->HoatDong = $request->HoatDong;
		$orm->GioChuan = $request->GioChuan;
        $orm->NamHoc = $request->NamHoc;
		$orm->save();
		return redirect()->route('supmanager.quydoigiochuan');
	}
    public function postSua(Request $request)
	{

		$this->validate($request, [
            'ID_edit' => ['required', 'string', 'max:10', 'unique:quydoigiochuan,ID,'. $request->id_old.',ID'],
            'HoatDong_edit' => ['required', 'string', 'max:191'],
			'GioChuan_edit' => ['required', 'numeric', 'min:0'],
            'NamHoc_edit' => ['required', 'string', 'max:9']

		]);
		
		$orm = QuyDoiGioChuan::find($request->id_old);
		$orm->ID = $request->ID_edit;
		$orm->HoatDong = $request->HoatDong_edit;
		$orm->GioChuan = $request->GioChuan_edit;
        $orm->NamHoc = $request->NamHoc_edit;
		$orm->save();
		return redirect()->route('supmanager.quydoigiochuan');
	}
	public function postXoa(Request $request)
	{
		$orm = QuyDoiGioChuan::find($request->ID_delete);
		$orm->delete();
		return redirect()->route('supmanager.quydoigiochuan');
	}
}
