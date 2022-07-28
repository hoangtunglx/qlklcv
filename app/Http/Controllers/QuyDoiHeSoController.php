<?php

namespace App\Http\Controllers;

use App\Exports\QuyDoiHeSoExport;
use App\Models\QuyDoiHeSo;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class QuyDoiHeSoController extends Controller
{
    //
    public function getDanhSach()
	{
		$quydoiheso = QuyDoiHeSo::where('NamHoc', getNamHoc())->first();
		return view('dashboard.supmanager.danhmuc.quydoiheso', compact('quydoiheso'));
	}
    public function postThem(Request $request)
	{
		$this->validate($request, [
        	'ID' => ['required', 'string', 'max:10', 'unique:quydoiheso'],
			'HoatDong' => ['required', 'string', 'max:191'],
            'HeSo' => ['required', 'numeric', 'min:0']
		]);
		
		$orm = new QuyDoiHeSo();
		$orm->ID = $request->ID;
		$orm->HoatDong = $request->HoatDong;
		$orm->HeSo = $request->HeSo;
        $orm->NamHoc = getNamHoc();
		$orm->save();
		return redirect()->route('supmanager.quydoiheso');
	}
    public function postSua(Request $request)
	{

		$this->validate($request, [
            'ID_edit' => ['required', 'string', 'max:10', 'unique:quydoiheso,ID,'. $request->id_old.',ID'],
            'HoatDong_edit' => ['required', 'string', 'max:191'],
			'HeSo_edit' => ['required', 'numeric', 'min:0']

		]);
		
		$orm = QuyDoiHeSo::find($request->id_old);
		$orm->ID = $request->ID_edit;
		$orm->HoatDong = $request->HoatDong_edit;
		$orm->HeSo = $request->HeSo_edit;
		$orm->save();
		return redirect()->route('supmanager.quydoiheso');
	}
	public function postXoa(Request $request)
	{
		$orm = QuyDoiHeSo::find($request->ID_delete);
		
		$orm->delete();
		return redirect()->route('supmanager.quydoiheso');
	}
	public function postNhap(Request $request)
	{
		try
		{
			$import = new QuyDoiHeSo();
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
				return redirect()->route('supmanager.quydoiheso')->with('warning', $messages);
			}
			else
			{
				return redirect()->route('supmanager.quydoiheso')->with('success', 'Đã nhập dữ liệu thành công!');
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
			return redirect()->route('supmanager.quydoiheso')->with('warning', $messages);
		}
	}
	
	public function getXuat()
	{
		return Excel::download(new QuyDoiHeSoExport(), 'quydoiheso.xlsx');
	}
}
