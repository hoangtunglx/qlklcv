<?php

namespace App\Http\Controllers;

use App\Models\QuyDinh;
use Illuminate\Http\Request;

class QuyDinhController extends Controller
{
    //
    public function getDanhSach()
	{
		$quydinh = QuyDinh::first();
		return view('dashboard.admin.quydinh', compact('quydinh'));
	}
	public function postSuaNamHoc(Request $request)
	{
		$this->validate($request, [
			'NamHocHienTai_edit' => ['required', 'max:191', ''],
		]);
		
		$orm = QuyDinh::where('NamHocHienTai',$request->ID_edit)->first();
		$orm->NamHocHienTai = $request->NamHocHienTai_edit;
		$orm->save();
		
		return redirect()->route('admin.quydinh');
	}
	public function postSuaThoiGianKeKhai(Request $request)
	{
		$this->validate($request, [
			'NgayMoKeKhai_edit' => ['required'],
			'NgayDongKeKhai_edit' => ['required']
		]);
		
		$orm = QuyDinh::where('NamHocHienTai',$request->NamHocHienTai_edit_thoigian)->first();
		$orm->NgayMoKeKhai = $request->NgayMoKeKhai_edit;
		$orm->NgayDongKeKhai = $request->NgayDongKeKhai_edit;
		$orm->save();
		
		return redirect()->route('admin.quydinh');
	}
}
