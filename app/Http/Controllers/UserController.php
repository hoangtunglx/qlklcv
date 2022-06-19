<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
	
	public function getDoiMatKhau()
	{
		return view('dashboard.hosonhanvien.doimatkhau');
	}
	
	public function postDoiMatKhau(Request $request)
	{
		$this->validate($request, [
			'old_password' => ['required', 'string', 'max:191'],
			'new_password' => ['required', 'string', 'min:6', 'confirmed'],
		]);
		
		$sys_nguoidung = SYS_NguoiDung::where('id', Auth::user()->id)
			->first();
		if(Hash::check($request->old_password, $sys_nguoidung->password))
		{
			SYS_NguoiDung::where('id', Auth::user()->id)->update([
				'password' => Hash::make($request->new_password)
			]);
			return redirect()->route('dashboard.hosonhanvien.doimatkhau')->with('success', 'Đổi mật khẩu thành công!');
		}
		else
			return redirect()->route('dashboard.hosonhanvien.doimatkhau')->with('warning', 'Mật khẩu cũ không chính xác!');
	}
}