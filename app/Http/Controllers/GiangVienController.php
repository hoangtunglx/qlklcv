<?php

namespace App\Http\Controllers;

use App\Exports\GiangVienExport;
use App\Models\BoMon;
use App\Models\GiangVien;
use App\Models\Ngach;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class GiangVienController extends Controller
{
    //
    public function getDanhSach()
	{
		$giangvien = GiangVien::paginate(getSoDong());
        $bomon=BoMon::all();
        $ngach=Ngach::all();
		$mabomon='';
		return view('dashboard.supmanager.danhmuc.giangvien', compact('giangvien','bomon','ngach','mabomon'));
	}
	public function postDanhSach_BoMon(Request $request)
	{
		$giangvien = GiangVien::where('MaBoMon',$request->MaBoMon)->paginate(getSoDong());
        $bomon=BoMon::all();
        $ngach=Ngach::all();
		$mabomon=$request->MaBoMon;
		return view('dashboard.supmanager.danhmuc.giangvien', compact('giangvien','bomon','ngach','mabomon'));
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

		//Khi thêm giảng viên đồng thời thêm tài khoản (privilege)
		// $orm = new TaiKhoan();
		// $orm->name = $request->HoVaTen;
		// $orm->username = $request->username;
		// $orm->email = $request->Email;
		// $orm->password = Hash::make('password');
		// $orm->privilege = $request->privilege;
		// $orm->save();

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
	public function postNhap_SupManager(Request $request)
	{
		try
		{
			$import = new GiangVien();
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
				return redirect()->route('supmanager.giangvien')->with('warning', $messages);
			}
			else
			{
				return redirect()->route('supmanager.giangvien')->with('success', 'Đã nhập dữ liệu thành công!');
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
			return redirect()->route('supmanager.giangvien')->with('warning', $messages);
		}
	}
	
	public function getXuat_SupManager()
	{
		return Excel::download(new GiangVienExport(), 'giangvien.xlsx');
	}
}
