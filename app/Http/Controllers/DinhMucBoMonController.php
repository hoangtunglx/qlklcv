<?php

namespace App\Http\Controllers;

use App\Models\BoMon;
use App\Models\DinhMucBoMon;
use Illuminate\Http\Request;

class DinhMucBoMonController extends Controller
{
	//
	public function getDanhSach_SupManager()
	{
		$dinhmucbomon = DinhMucBoMon::all();
        $bomon=BoMon::all();
		return view('dashboard.supmanager.danhmuc.dinhmucbomon', compact('dinhmucbomon','bomon'));
	}
	public function postThem_SupManager(Request $request)
	{
		$this->validate($request, [
            'MaBoMon' => ['required', 'string', 'max:5'],
			'TongDinhMuc' => ['required', 'numeric', 'min:0'],
            'NamHoc' => ['required', 'string', 'max:9']
		]);
		
		$orm = new DinhMucBoMon();
		$orm->MaBoMon = $request->MaBoMon;
		$orm->TongDinhMuc = $request->TongDinhMuc;
        $orm->NamHoc = $request->NamHoc;
		$orm->save();
		return redirect()->route('supmanager.dinhmucbomon');
	}
	public function postSua_SupManager(Request $request)
	{
		$this->validate($request, [
            'MaBoMon_edit' => ['required', 'string', 'max:5'],
			'TongDinhMuc_edit' => ['required', 'numeric', 'min:0'],
            'NamHoc_edit' => ['required', 'string', 'max:9']
		]);
		
		$orm = DinhMucBoMon::find($request->id_edit);
		$orm->MaBoMon = $request->MaBoMon_edit;
		$orm->TongDinhMuc = $request->TongDinhMuc_edit;
        $orm->NamHoc = $request->NamHoc_edit;
		$orm->save();
		return redirect()->route('supmanager.dinhmucbomon');
	}
	public function postXoa_SupManager(Request $request)
	{
		$orm = DinhMucBoMon::find($request->ID_delete);
		$orm->delete();
		return redirect()->route('supmanager.dinhmucbomon');
	}
}
