<?php

namespace App\Http\Controllers;

use App\Exports\QuyDoiGiamDinhMucExport;
use App\Models\QuyDoiGiamDinhMuc;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class QuyDoiGiamDinhMucController extends Controller
{
    //
    public function getDanhSach()
	{
		$quydoigiamdinhmuc = QuyDoiGiamDinhMuc::where("NamHoc", getNamHoc())->first();
		return view('dashboard.supmanager.danhmuc.quydoigiamdinhmuc', compact('quydoigiamdinhmuc'));
	}
    public function postThem(Request $request)
	{
		$this->validate($request, [
        	'ID' => ['required', 'string', 'max:10', 'unique:quydoigiamdinhmuc'],
			'HoatDong' => ['required', 'string', 'max:191'],
            'PhanTramDinhMuc' => ['required', 'numeric', 'min:0']
		]);
		
		$orm = new QuyDoiGiamDinhMuc();
		$orm->ID = $request->ID;
		$orm->HoatDong = $request->HoatDong;
		$orm->PhanTramDinhMuc = $request->PhanTramDinhMuc;
        $orm->NamHoc = getNamHoc();
		$orm->save();
		return redirect()->route('supmanager.quydoigiamdinhmuc');
	}
    public function postSua(Request $request)
	{

		$this->validate($request, [
            'ID_edit' => ['required', 'string', 'max:10', 'unique:quydoigiamdinhmuc,ID,'. $request->id_old.',ID'],
            'HoatDong_edit' => ['required', 'string', 'max:191'],
			'PhanTramDinhMuc_edit' => ['required', 'numeric', 'min:0']
		]);
		
		$orm = QuyDoiGiamDinhMuc::find($request->id_old);
		$orm->ID = $request->ID_edit;
		$orm->HoatDong = $request->HoatDong_edit;
		$orm->PhanTramDinhMuc = $request->PhanTramDinhMuc_edit;
		$orm->save();
		return redirect()->route('supmanager.quydoigiamdinhmuc');
	}
	public function postXoa(Request $request)
	{
		$orm = QuyDoiGiamDinhMuc::find($request->ID_delete);
		$orm->delete();
		return redirect()->route('supmanager.quydoigiamdinhmuc');
	}
	public function postNhap(Request $request)
	{
		try
		{
			$import = new QuyDoiGiamDinhMuc();
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
				return redirect()->route('supmanager.quydoigiamdinhmuc')->with('warning', $messages);
			}
			else
			{
				return redirect()->route('supmanager.quydoigiamdinhmuc')->with('success', 'Đã nhập dữ liệu thành công!');
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
			return redirect()->route('supmanager.quydoigiamdinhmuc')->with('warning', $messages);
		}
	}
	
	public function getXuat()
	{
		return Excel::download(new QuyDoiGiamDinhMucExport(), 'quydoigiamdinhmuc.xlsx');
	}
}
