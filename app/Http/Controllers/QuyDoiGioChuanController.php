<?php

namespace App\Http\Controllers;

use App\Exports\QuyDoiGioChuanExport;
use App\Models\QuyDoiGioChuan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class QuyDoiGioChuanController extends Controller
{
    //
    public function getDanhSach()
	{
		$quydoigiochuan = QuyDoiGioChuan::where('NamHoc', getNamHoc())->first();
		return view('dashboard.supmanager.danhmuc.quydoigiochuan', compact('quydoigiochuan'));
	}
    public function postThem(Request $request)
	{
		$this->validate($request, [
        	'ID' => ['required', 'string', 'max:10', 'unique:quydoigiochuan'],
			'HoatDong' => ['required', 'string', 'max:191'],
            'GioChuan' => ['required', 'numeric', 'min:0']
		]);
		
		$orm = new QuyDoiGioChuan();
		$orm->ID = $request->ID;
		$orm->HoatDong = $request->HoatDong;
		$orm->GioChuan = $request->GioChuan;
        $orm->NamHoc = getNamHoc();
		$orm->save();
		return redirect()->route('supmanager.quydoigiochuan');
	}
    public function postSua(Request $request)
	{

		$this->validate($request, [
            'ID_edit' => ['required', 'string', 'max:10', 'unique:quydoigiochuan,ID,'. $request->id_old.',ID'],
            'HoatDong_edit' => ['required', 'string', 'max:191'],
			'GioChuan_edit' => ['required', 'numeric', 'min:0']
		]);
		
		$orm = QuyDoiGioChuan::find($request->id_old);
		$orm->ID = $request->ID_edit;
		$orm->HoatDong = $request->HoatDong_edit;
		$orm->GioChuan = $request->GioChuan_edit;
		$orm->save();
		return redirect()->route('supmanager.quydoigiochuan');
	}
	public function postXoa(Request $request)
	{
		$orm = QuyDoiGioChuan::find($request->ID_delete);
		$orm->delete();
		return redirect()->route('supmanager.quydoigiochuan');
	}
	public function postNhap(Request $request)
	{
		try
		{
			$import = new QuyDoiGioChuan();
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
				return redirect()->route('supmanager.quydoigiochuan')->with('warning', $messages);
			}
			else
			{
				return redirect()->route('supmanager.quydoigiochuan')->with('success', 'Đã nhập dữ liệu thành công!');
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
			return redirect()->route('supmanager.quydoigiochuan')->with('warning', $messages);
		}
	}
	
	public function getXuat()
	{
		return Excel::download(new QuyDoiGioChuanExport(), 'quydoigiochuan.xlsx');
	}
}
