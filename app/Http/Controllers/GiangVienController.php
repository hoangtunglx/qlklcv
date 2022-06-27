<?php

namespace App\Http\Controllers;

use App\Models\BoMon;
use App\Models\GiangVien;
use App\Models\Ngach;
use Illuminate\Http\Request;

class GiangVienController extends Controller
{
    //
    public function getDanhSach()
	{
		$giangvien = GiangVien::all();
        $bomon=BoMon::all();
        $ngach=Ngach::all();
		return view('dashboard.supmanager.danhmuc.giangvien', compact('giangvien','bomon','ngach'));
	}
    public function postThem(Request $request)
	{
		$this->validate($request, [
            'MaGiangVien' => ['required', 'string', 'max:10', 'unique:giangvien'],
			'HoVaTen' => ['required', 'string', 'max:191'],
            'Email' => ['required', 'email', 'max:191'],
            'MaBoMon' => ['required', 'string', 'max:5'],
            'MaNgach' => ['required', 'string', 'max:10']
		]);
		
		$orm = new GiangVien();
		$orm->MaGiangVien = $request->MaGiangVien;
		$orm->HoVaTen = $request->HoVaTen;
        $orm->Email = $request->Email;
        $orm->MaBoMon = $request->MaBoMon;
        $orm->MaNgach = $request->MaNgach;
		$orm->save();
		return redirect()->route('supmanager.giangvien');
	}
    public function postSua(Request $request)
	{

		$this->validate($request, [
            'MaGiangVien_edit' => ['required', 'string', 'max:10', 'unique:giangvien,MaGiangVien,'. $request->id_edit.',MaGiangVien'],
			'HoVaTen_edit' => ['required', 'string', 'max:191'],
            'Email_edit' => ['required', 'email', 'max:191'],
            'MaBoMon_edit' => ['required', 'string', 'max:5'],
            'MaNgach_edit' => ['required', 'string', 'max:10'],
		]);
		
		$orm = GiangVien::find($request->id_edit);
		$orm->MaGiangVien = $request->MaGiangVien_edit;
		$orm->HoVaTen = $request->HoVaTen_edit;
        $orm->Email = $request->Email_edit;
        $orm->MaBoMon = $request->MaBoMon_edit;
        $orm->MaNgach = $request->MaNgach_edit;
		$orm->save();
		return redirect()->route('supmanager.giangvien');
	}
    public function postXoa(Request $request)
	{
		$orm = GiangVien::find($request->MaGiangVien_delete);
		$orm->delete();
		return redirect()->route('supmanager.giangvien');
	}
}
