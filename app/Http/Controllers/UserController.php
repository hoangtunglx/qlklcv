<?php

namespace App\Http\Controllers;

use App\Models\BoMon;
use App\Models\GiangVien;
use App\Models\Ngach;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function getHome()
	{
		return view('dashboard.index');
	}
	
	public function getHoSo()
	{
		$giangvien= GiangVien::where('Email', Auth::user()->email)->first();
		$ngach=Ngach::all();
		$bomon=BoMon::all();
		return view('dashboard.user.hoso', compact('giangvien','ngach','bomon'));
	}

	public function getDoiMatKhau()
	{
		return view('dashboard.user.doimatkhau');
	}
	
	public function postHoSo(Request $request)
	{
		$this->validate($request, [
			'HoVaTen_edit' => ['required', 'string', 'max:191'],
            'Email_edit' => ['required', 'email', 'max:191'],
            'MaBoMon_edit' => ['required', 'string', 'max:5'],
            'MaNgach_edit' => ['required', 'string', 'max:10'],
		]);
		
		$orm= GiangVien::where('Email', Auth::user()->email)->first();
		// $orm = GiangVien::find($giangvien->MaGiangVien);
		
		$orm->HoVaTen = $request->HoVaTen_edit;
        $orm->Email = $request->Email_edit;
        $orm->MaBoMon = $request->MaBoMon_edit;
        $orm->MaNgach = $request->MaNgach_edit;
		$orm->save();
		return redirect()->route('user.hoso')->with('success', 'Cập nhật thông tin thành công!');;
	}
	public function postDoiMatKhau(Request $request)
	{
		
		$this->validate($request, [
			'old_password' => ['required', 'string', 'max:191'],
			'new_password' => ['required', 'string', 'min:6', 'confirmed'],
		]);
		
		$sys_nguoidung = TaiKhoan::where('id', Auth::user()->id)
			->first();
		if(Hash::check($request->old_password, $sys_nguoidung->password))
		{
			TaiKhoan::where('id', Auth::user()->id)->update([
				'password' => Hash::make($request->new_password)
			]);
			return redirect()->route('user.doimatkhau')->with('success', 'Đổi mật khẩu thành công!');
		}
		else
			return redirect()->route('user.doimatkhau')->with('warning', 'Mật khẩu cũ không chính xác!');
	}
}