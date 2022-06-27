<?php

namespace App\Http\Controllers;

use App\Models\Ngach;
use Illuminate\Http\Request;

class NgachController extends Controller
{
    //
    public function getDanhSach()
	{
		$ngach = Ngach::all();
		return view('dashboard.supmanager.danhmuc.ngach', compact('ngach'));
	}
    public function postThem(Request $request)
	{
		$this->validate($request, [
            'MaNgach' => ['required', 'string', 'max:191', 'unique:ngach'],
			'DienGiai' => ['required', 'string', 'max:191','unique:ngach,DienGiai'],
            'DinhMucGiangDay' => ['required', 'numeric', 'min:0'],
            'DinhMucNCKH' => ['required', 'numeric', 'min:0']
		]);
		
		$orm = new Ngach();
		$orm->MaNgach = $request->MaNgach;
		$orm->DienGiai = $request->DienGiai;
        $orm->DinhMucGiangDay = $request->DinhMucGiangDay;
        $orm->DinhMucNCKH = $request->DinhMucNCKH;
		$orm->save();
		
		return redirect()->route('supmanager.ngach');
	}
    public function postSua(Request $request)
	{

		$this->validate($request, [
            'MaNgach_edit' => ['required', 'string', 'max:191', 'unique:ngach,MaNgach,'. $request->id_edit.',MaNgach'],
			'DienGiai_edit' => ['required', 'string', 'max:191','unique:ngach,DienGiai,'. $request->id_edit.',MaNgach'],
            'DinhMucGiangDay_edit' => ['required', 'numeric', 'min:0'],
            'DinhMucNCKH_edit' => ['required', 'numeric', 'min:0']
		]);
		
		$orm = Ngach::find($request->id_edit);
		$orm->MaNgach = $request->MaNgach_edit;
		$orm->DienGiai = $request->DienGiai_edit;
        $orm->DinhMucGiangDay = $request->DinhMucGiangDay_edit;
		$orm->DinhMucNCKH = $request->DinhMucNCKH_edit;
		$orm->save();
		
		return redirect()->route('supmanager.ngach');
	}
	public function postXoa(Request $request)
	{
		$orm = Ngach::find($request->MaNgach_delete);
		$orm->delete();
		
		return redirect()->route('supmanager.ngach');
	}
}
