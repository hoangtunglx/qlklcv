<?php

namespace App\Http\Controllers;

use App\Models\BoMon;
use App\Models\DinhMucGiangVien;
use App\Models\GiangVien;
use App\Models\Khoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DinhMucGiangVienController extends Controller
{
    //
	public function getDanhSach_SupManager()
	{
		$dinhmucgiangvien = DinhMucGiangVien::where("NamHoc", getNamHoc())->paginate(getSoDong());
		$giangvien=GiangVien::all();
		$bomon=BoMon::all();
		$khoa=Khoa::all();
		$mabomon = '';
		$makhoa = '';
		return view('dashboard.supmanager.danhmuc.dinhmucgiangvien', compact('dinhmucgiangvien','giangvien','bomon','khoa','mabomon','makhoa'));
	}
	public function getDanhSach_Statistic()
	{
		$dinhmucgiangvien = DinhMucGiangVien::where("NamHoc", getNamHoc())->paginate(getSoDong());
		$giangvien=GiangVien::all();
		$bomon=BoMon::all();
		$khoa=Khoa::all();
		$mabomon = '';
		$makhoa = '';
		return view('dashboard.statistic.danhmuc.dinhmucgiangvien', compact('dinhmucgiangvien','giangvien','bomon','khoa','mabomon','makhoa'));
	}
	public function getDanhSach_Manager()
	{
		$dinhmucgiangvien = DinhMucGiangVien::where("NamHoc", getNamHoc())
		->join('giangvien','giangvien.MaGiangVien','=','dinhmucgiangvien.MaGiangVien')
		->join('bomon','bomon.MaBoMon','=','giangvien.MaBoMon')
		->where('bomon.MaKhoa', getGV_Khoa())
		->paginate(getSoDong());
		$giangvien=GiangVien::all();
		$bomon=BoMon::where('MaKhoa',getGV_Khoa())->get();
		$mabomon = '';
		$makhoa = '';
		return view('dashboard.manager.danhmuc.dinhmucgiangvien', compact('dinhmucgiangvien','giangvien','bomon','mabomon','makhoa'));
	}
	public function getDanhSach_BoMon_SupManager(Request $request)
	{
		$dinhmucgiangvien = DinhMucGiangVien::where("NamHoc", getNamHoc())
		->join('giangvien','giangvien.MaGiangVien','=','dinhmucgiangvien.MaGiangVien')
		->where('giangvien.MaBoMon',$request->MaBoMon)
		->select('dinhmucgiangvien.*')
		->paginate(getSoDong());
		$giangvien=GiangVien::all();
		$bomon=BoMon::all();
		$khoa=Khoa::all();
		$mabomon = $request->MaBoMon;
		$makhoa = '';
		return view('dashboard.supmanager.danhmuc.dinhmucgiangvien', compact('dinhmucgiangvien','giangvien','bomon','khoa','mabomon','makhoa'));
	}
	public function getDanhSach_Khoa_SupManager(Request $request)
	{
		$dinhmucgiangvien = DinhMucGiangVien::where("NamHoc", getNamHoc())
		->join('giangvien','giangvien.MaGiangVien','=','dinhmucgiangvien.MaGiangVien')
		->join('bomon','bomon.MaBoMon','=','giangvien.MaBoMon')
		->where('bomon.MaKhoa',$request->MaKhoa)
		->select('dinhmucgiangvien.*')
		->paginate(getSoDong());
		$giangvien=GiangVien::all();
		$bomon=BoMon::all();
		$khoa=Khoa::all();
		$mabomon = '';
		$makhoa = $request->MaKhoa;
		return view('dashboard.supmanager.danhmuc.dinhmucgiangvien', compact('dinhmucgiangvien','giangvien','bomon','khoa','mabomon','makhoa'));
	}
	public function postDanhSach_BoMon_Statistic(Request $request)
	{
		$dinhmucgiangvien = DinhMucGiangVien::where("NamHoc", getNamHoc())
		->join('giangvien','giangvien.MaGiangVien','=','dinhmucgiangvien.MaGiangVien')
		->where('giangvien.MaBoMon',$request->MaBoMon)
		->select('dinhmucgiangvien.*')
		->paginate(getSoDong());
		$giangvien=GiangVien::all();
		$bomon=BoMon::all();
		$khoa=Khoa::all();
		$mabomon = $request->MaBoMon;
		$makhoa = '';
		return view('dashboard.statistic.danhmuc.dinhmucgiangvien', compact('dinhmucgiangvien','giangvien','bomon','khoa','mabomon','makhoa'));
	}
	public function postDanhSach_Khoa_Statistic(Request $request)
	{
		$dinhmucgiangvien = DinhMucGiangVien::where("NamHoc", getNamHoc())
		->join('giangvien','giangvien.MaGiangVien','=','dinhmucgiangvien.MaGiangVien')
		->join('bomon','bomon.MaBoMon','=','giangvien.MaBoMon')
		->where('bomon.MaKhoa',$request->MaKhoa)
		->select('dinhmucgiangvien.*')
		->paginate(getSoDong());
		$giangvien=GiangVien::all();
		$bomon=BoMon::all();
		$khoa=Khoa::all();
		$mabomon = '';
		$makhoa = $request->MaKhoa;
		return view('dashboard.statistic.danhmuc.dinhmucgiangvien', compact('dinhmucgiangvien','giangvien','bomon','khoa','mabomon','makhoa'));
	}
	public function postDanhSach_BoMon_Manager(Request $request)
	{
		$dinhmucgiangvien = DinhMucGiangVien::where("NamHoc", getNamHoc())
		->join('giangvien','giangvien.MaGiangVien','=','dinhmucgiangvien.MaGiangVien')
		->where('giangvien.MaBoMon',$request->MaBoMon)
		->select('dinhmucgiangvien.*')
		->paginate(getSoDong());
		$giangvien=GiangVien::all();
		$bomon=BoMon::where('MaKhoa',getGV_Khoa())->get();
		$mabomon = $request->MaBoMon;
		$makhoa = '';
		return view('dashboard.manager.danhmuc.dinhmucgiangvien', compact('dinhmucgiangvien','giangvien','bomon','mabomon','makhoa'));
	}
	public function getDanhSach_User()
	{
		$giangvien= GiangVien::where('Email', Auth::user()->email)->first();
		$dinhmucgiangvien = DinhMucGiangVien::where('NamHoc',getNamHoc())
		->where('MaGiangVien', $giangvien->MaGiangVien)
		->first()	;
		return view('dashboard.user.dinhmucgiangvien', compact('dinhmucgiangvien','giangvien'));
	}
	public function postThem_User(Request $request)
	{
		$gv= GiangVien::where('email', Auth::user()->email)->first();
		//validate Năm học đối với mỗi user
		$this->validate($request, [         
			'DinhMucGiangDay' => ['required', 'numeric', 'min:0'],
            'DinhMucNCKH' => ['required', 'numeric', 'min:0']
		]);
		
		$orm = new DinhMucGiangVien();
		$orm->MaGiangVien = $gv->MaGiangVien;
		$orm->DinhMucGiangDay = $request->DinhMucGiangDay;
        $orm->DinhMucNCKH = $request->DinhMucNCKH;
        $orm->NamHoc = getNamHoc();
		$orm->save();
		return redirect()->route('user.dinhmucgiangvien');
	}
	public function postSua_User(Request $request)
	{
		$this->validate($request, [         
			'DinhMucGiangDay_edit' => ['required', 'numeric', 'min:0'],
            'DinhMucNCKH_edit' => ['required', 'numeric', 'min:0']
		]);
		$orm = DinhMucGiangVien::find($request->ID_edit);
		$orm->DinhMucGiangDay = $request->DinhMucGiangDay_edit;
        $orm->DinhMucNCKH = $request->DinhMucNCKH_edit;
		$orm->save();
		return redirect()->route('user.dinhmucgiangvien');
	}
	public function postXoa_User(Request $request)
	{
		$orm = DinhMucGiangVien::find($request->ID_delete);
		$orm->delete();
		return redirect()->route('user.dinhmucgiangvien');
	}
}