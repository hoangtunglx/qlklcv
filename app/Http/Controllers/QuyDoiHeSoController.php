<?php

namespace App\Http\Controllers;

use App\Models\QuyDoiHeSo;
use Illuminate\Http\Request;

class QuyDoiHeSoController extends Controller
{
    //
    public function getDanhSach()
	{
		$quydoiheso = QuyDoiHeSo::all();
		return view('dashboard.supmanager.danhmuc.quydoiheso', compact('quydoiheso'));
	}
    public function postThem(Request $request)
	{
		$this->validate($request, [
        	'ID' => ['required', 'string', 'max:10', 'unique:quydoiheso'],
			'HoatDong' => ['required', 'string', 'max:191'],
            'HeSo' => ['required', 'numeric', 'min:0'],
        	'NamHoc' => ['required', 'string', 'max:9']
		]);
		
		$orm = new QuyDoiHeSo();
		$orm->ID = $request->ID;
		$orm->HoatDong = $request->HoatDong;
		$orm->HeSo = $request->HeSo;
        $orm->NamHoc = $request->NamHoc;
		$orm->save();
		return redirect()->route('supmanager.quydoiheso');
	}
    public function postSua(Request $request)
	{

		$this->validate($request, [
            'ID_edit' => ['required', 'string', 'max:10', 'unique:quydoiheso,ID,'. $request->id_old.',ID'],
            'HoatDong_edit' => ['required', 'string', 'max:191'],
			'HeSo_edit' => ['required', 'numeric', 'min:0'],
            'NamHoc_edit' => ['required', 'string', 'max:9']

		]);
		
		$orm = QuyDoiHeSo::find($request->id_old);
		$orm->ID = $request->ID_edit;
		$orm->HoatDong = $request->HoatDong_edit;
		$orm->HeSo = $request->HeSo_edit;
        $orm->NamHoc = $request->NamHoc_edit;
		$orm->save();
		return redirect()->route('supmanager.quydoiheso');
	}
	public function postXoa(Request $request)
	{
		$orm = QuyDoiHeSo::find($request->ID_delete);
		
		$orm->delete();
		return redirect()->route('supmanager.quydoiheso');
	}
}
