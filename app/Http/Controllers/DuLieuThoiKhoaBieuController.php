<?php

namespace App\Http\Controllers;

use App\Exports\DuLieuThoiKhoaBieuExport;
use App\Models\BoMon;
use App\Models\DuLieuThoiKhoaBieu;
use App\Models\GiangVien;
use App\Models\HocPhan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DuLieuThoiKhoaBieuController extends Controller
{
    //
	public function getDanhSach_SupManager(){
		$dulieuthoikhoabieu=DuLieuThoiKhoaBieu::where('NamHoc', getNamHoc())->paginate(getSoDong());
		$giangvien=GiangVien::all();
		$hocphan=HocPhan::all();
		return view('dashboard.supmanager.danhmuc.dulieuthoikhoabieu', compact('dulieuthoikhoabieu','giangvien','hocphan'));
	}
	public function getDanhSach_Manager()
	{
		$dulieuthoikhoabieu = DuLieuThoiKhoaBieu::where("NamHoc", getNamHoc())
		->join('giangvien','giangvien.MaGiangVien','=','dulieuthoikhoabieu.MaGiangVien')
		->join('bomon','bomon.MaBoMon','=','giangvien.MaBoMon')
		->where('bomon.MaKhoa', getGV_Khoa())
		->paginate(getSoDong());
		$giangvien=GiangVien::all();
		$bomon=BoMon::where('MaKhoa',getGV_Khoa())->get();
		$mabomon = '';
		$makhoa = '';
		return view('dashboard.manager.danhmuc.dulieuthoikhoabieu', compact('dulieuthoikhoabieu','giangvien','bomon','mabomon','makhoa'));
	}
	public function postThem_SupManager(Request $request){
		$this->validate($request, [
            'MaGiangVien' => ['required', 'string', 'max:10'],
			'MaHocPhan' => ['required', 'string', 'max:10'],
            'Nhom' => ['required', 'string', 'max:3'],
            'ToThucHanh' => ['required', 'string', 'max:3'],
			'Phong' => ['required', 'string', 'max:50'],
			'SiSoTKB' => ['required', 'numeric', 'max:999'],
            'Thu' => ['required', 'numeric', 'max:999'],
            'TietBatDau' => ['required', 'numeric', 'max:999'],
			'SoTiet' => ['required', 'numeric', 'max:999'],
			'TongSoTiet' => ['required', 'numeric', 'max:999'],
            'Lop' => ['required', 'string', 'max:50'],
            'HocKy' => ['required', 'numeric', 'max:999']
		]);		
		$orm = new DuLieuThoiKhoaBieu();
		$orm->MaGiangVien = $request->MaGiangVien;
		$orm->MaHocPhan = $request->MaHocPhan;
        $orm->Nhom = $request->Nhom;
        $orm->ToThucHanh = $request->ToThucHanh;
		$orm->Phong = $request->Phong;
		$orm->SiSoTKB = $request->SiSoTKB;
        $orm->Thu = $request->Thu;
        $orm->TietBatDau = $request->TietBatDau;
		$orm->SoTiet = $request->SoTiet;
		$orm->TongSoTiet = $request->TongSoTiet;
        $orm->Lop = $request->Lop;
        $orm->HocKy = $request->HocKy;
		$orm->NamHoc = getNamHoc();
		$orm->save();
		return redirect()->route('supmanager.dulieuthoikhoabieu');
	}
	public function postSua_SupManager(Request $request)
	{

		$this->validate($request, [
            'MaGiangVien_edit' => ['required', 'string', 'max:10'],
			'MaHocPhan_edit' => ['required', 'string', 'max:10'],
            'Nhom_edit' => ['required', 'string', 'max:3'],
            'ToThucHanh_edit' => ['required', 'string', 'max:3'],
			'Phong_edit' => ['required', 'string', 'max:50'],
			'SiSoTKB_edit' => ['required', 'numeric', 'max:999'],
            'Thu_edit' => ['required', 'numeric', 'max:999'],
            'TietBatDau_edit' => ['required', 'numeric', 'max:999'],
			'SoTiet_edit' => ['required', 'numeric', 'max:999'],
			'TongSoTiet_edit' => ['required', 'numeric', 'max:999'],
            'Lop_edit' => ['required', 'string', 'max:50'],
            'HocKy_edit' => ['required', 'numeric', 'max:999']
		]);		
		$orm = DuLieuThoiKhoaBieu::find($request->ID_edit);
		$orm->MaGiangVien = $request->MaGiangVien_edit;
		$orm->MaHocPhan = $request->MaHocPhan_edit;
        $orm->Nhom = $request->Nhom_edit;
        $orm->ToThucHanh = $request->ToThucHanh_edit;
		$orm->Phong = $request->Phong_edit;
		$orm->SiSoTKB = $request->SiSoTKB_edit;
        $orm->Thu = $request->Thu_edit;
        $orm->TietBatDau = $request->TietBatDau_edit;
		$orm->SoTiet = $request->SoTiet_edit;
		$orm->TongSoTiet = $request->TongSoTiet_edit;
        $orm->Lop = $request->Lop_edit;
        $orm->HocKy = $request->HocKy_edit;
		// $orm->NamHoc = getNamHoc();
		$orm->save();
		return redirect()->route('supmanager.dulieuthoikhoabieu');
	}
	public function postXoa_SupManager(Request $request)
	{
		$orm = DuLieuThoiKhoaBieu::find($request->ID_delete);
		$orm->delete();
		return redirect()->route('supmanager.dulieuthoikhoabieu');
	}
    public function postNhap_SupManager(Request $request)
	{
		try
		{
			$import = new DuLieuThoiKhoaBieu();
			$import->import($request->file('file_excel'));
			
			if(count($import->failures()) > 0)
			{
				$messages = 'Các dòng bị lỗi:';
				foreach($import->failures() as $failure)
				{
					$messages .= '<br />Dòng: <b>' . $failure->row() . '</b>';
					$messages .= '; Thuộc tính: <b>' . $failure->attribute() . '</b>';
					$messages .= '; Lỗi: <b>' . implode('</b>, <b>', $failure->errors()) . '</b>';
				}
				return redirect()->route('supmanager.dulieuthoikhoabieu')->with('warning', $messages);
			}
			else
			{
				return redirect()->route('supmanager.dulieuthoikhoabieu')->with('success', 'Đã nhập dữ liệu thành công!');
			}
		}
		catch(\Maatwebsite\Excel\Validators\ValidationException $e)
		{
			$failures = $e->failures();
			$messages = 'Các dòng bị lỗi:';
			foreach($failures as $failure)
			{
				$messages .= '<br />Dòng: <b>' . $failure->row() . '</b>';
				$messages .= '; Thuộc tính: <b>' . $failure->attribute() . '</b>';
				$messages .= '; Lỗi: <b>' . implode('</b>, <b>', $failure->errors()) . '</b>';
			}
			return redirect()->route('supmanager.dulieuthoikhoabieu')->with('warning', $messages);
		}
	}
	public function getXuat_SupManager()
	{
		return Excel::download(new DuLieuThoiKhoaBieuExport(), 'dulieuthoikhoabieu.xlsx');
	}
	public function postDanhSach_BoMon_Manager(Request $request)
	{
		$dulieuthoikhoabieu = DuLieuThoiKhoaBieu::where("NamHoc", getNamHoc())
		->join('giangvien','giangvien.MaGiangVien','=','dulieuthoikhoabieu.MaGiangVien')
		->where('giangvien.MaBoMon',$request->MaBoMon)
		->select('dulieuthoikhoabieu.*')
		->paginate(getSoDong());
		$giangvien=GiangVien::all();
		$bomon=BoMon::where('MaKhoa',getGV_Khoa())->get();
		$mabomon = $request->MaBoMon;
		$makhoa = '';
		return view('dashboard.manager.danhmuc.dulieuthoikhoabieu', compact('dulieuthoikhoabieu','giangvien','bomon','mabomon','makhoa'));
	}
}
