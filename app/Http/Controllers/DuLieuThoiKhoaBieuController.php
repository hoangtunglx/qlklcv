<?php

namespace App\Http\Controllers;

use App\Models\DuLieuThoiKhoaBieu;
use Illuminate\Http\Request;

class DuLieuThoiKhoaBieuController extends Controller
{
    //
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
				return redirect()->route('supmanager.dulieuhtoikhoabieu')->with('warning', $messages);
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
	
	// public function getXuat_SupManager()
	// {
	// 	return Excel::download(new DuLieuThoiKhoaBieu(), 'dulieuthoikhoabieu.xlsx');
	// }
}
