<?php

namespace App\Http\Controllers;

use App\Models\SYS_NguoiDung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class TaiKhoanController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function getDanhSach()
	{
		$sys_nguoidung = SYS_NguoiDung::all();
		return view('dashboard.danhmuc.nguoidung', compact('sys_nguoidung'));
	}
	
	public function postThem(Request $request)
	{
		$this->validate($request, [
			'name' => ['required', 'string', 'max:191'],
			'username' => ['required', 'string', 'max:191', 'unique:sys_nguoidung'],
			'email' => ['required', 'email', 'max:191', 'unique:sys_nguoidung'],
			'password' => ['required', 'string', 'min:6', 'confirmed'],
			'privilege' => ['required'],
		]);
		
		$orm = new SYS_NguoiDung();
		$orm->name = $request->name;
		$orm->username = $request->username;
		$orm->email = $request->email;
		$orm->password = Hash::make($request->password);
		$orm->privilege = $request->privilege;
		$orm->save();
		
		return redirect()->route('dashboard.danhmuc.nguoidung');
	}
	
	public function postSua(Request $request)
	{
		$this->validate($request, [
			'name_edit' => ['required', 'max:191'],
			'username_edit' => ['required', 'max:191', 'unique:sys_nguoidung,username,' . $request->id_edit],
			'email_edit' => ['required', 'email', 'max:191', 'unique:sys_nguoidung,email,' . $request->id_edit],
			'password_edit' => ['nullable', 'string', 'min:6', 'confirmed'],
			'privilege_edit' => ['required'],
		]);
		
		$orm = SYS_NguoiDung::find($request->id_edit);
		$orm->name = $request->name_edit;
		$orm->username = $request->username_edit;
		$orm->email = $request->email_edit;
		if(!empty($request->password_edit)) $orm->password = Hash::make($request->password_edit);
		$orm->privilege = $request->privilege_edit;
		$orm->save();
		
		return redirect()->route('dashboard.danhmuc.nguoidung');
	}
	
	public function postXoa(Request $request)
	{
		$orm = SYS_NguoiDung::find($request->id_delete);
		$orm->delete();
		
		return redirect()->route('dashboard.danhmuc.nguoidung');
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