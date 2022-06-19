<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Socialite;

class HomeController extends Controller
{
	public function getHome()
	{
		$baiviet = null;
		return view('frontend.index', compact('baiviet'));
	}
	
	public function getBaiViet()
	{
		return view('frontend.baiviet');
	}
	
	public function getBaiViet_ChiTiet($titleWithID)
	{
		return view('frontend.baiviet_chitiet');
	}
	
	public function postVanBanTaiVe(Request $request)
	{
		
	}
	
	public function getGoogleLogin()
	{
		return Socialite::driver('google')->redirect();
	}
	
	public function getGoogleCallback()
	{
		try
		{
			$user = Socialite::driver('google')->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))->stateless()->user();
		}
		catch(Exception $e)
		{
			return redirect()->route('login')->with('warning', 'Lỗi xác thực. Xin vui lòng thử lại!');
		}
		
		if(!Str::contains($user->email, 'agu.edu.vn'))
		{
			return redirect()->route('login')->with('warning', 'Phải sử dụng email của AGU!');
		}
		
		$existingUser = SYS_NguoiDung::where('email', $user->email)
			->first();
		if($existingUser)
		{
			Auth::login($existingUser, true);
			return redirect()->route('dashboard.home');
		}
		else
		{
			return redirect()->route('login')->with('warning', 'Tài khoản không thuộc quản lý của FIT!');
		}
	}
}