<?php

namespace App\Http\Controllers;

use App\Exports\LopExport;
use App\Models\Khoa;
use App\Models\Lop;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LopController extends Controller
{
    //
    public function getDanhSach()
	{
		$lop = Lop::paginate(getSoDong());
        $khoa=Khoa::all();
		return view('dashboard.supmanager.danhmuc.lop', compact('lop','khoa'));
	}
    public function postThem(Request $request)
	{
		$this->validate($request, [
            'MaLop' => ['required', 'string', 'max:10', 'unique:lop'],
			'TenLop' => ['required', 'string', 'max:191','unique:lop,TenLop'],
            'SiSo' => ['required', 'numeric', 'min:1'],
            'MaKhoa' => ['required', 'string', 'max:5']
		]);
		
		$orm = new Lop();
		$orm->MaLop = $request->MaLop;
		$orm->TenLop = $request->TenLop;
        $orm->SiSo = $request->SiSo;
        $orm->MaKhoa = $request->MaKhoa;
		$orm->save();
		return redirect()->route('supmanager.lop');
	}
    public function postSua(Request $request)
	{

		$this->validate($request, [
            'MaLop_edit' => ['required', 'string', 'max:10', 'unique:lop,MaLop,'. $request->id_edit.',MaLop'],
			'TenLop_edit' => ['required', 'string', 'max:191','unique:lop,TenLop,'. $request->id_edit.',MaLop'],
            'SiSo_edit' => ['required', 'numeric', 'min:1'],
            'MaKhoa_edit' => ['required', 'string', 'max:5'],
		]);
		
		$orm = Lop::find($request->id_edit);
		$orm->MaLop = $request->MaLop_edit;
		$orm->TenLop = $request->TenLop_edit;
        $orm->SiSo = $request->SiSo_edit;
        $orm->MaKhoa = $request->MaKhoa_edit;
		$orm->save();
		return redirect()->route('supmanager.lop');
	}
    public function postXoa(Request $request)
	{
		$orm = Lop::find($request->MaLop_delete);
		$orm->delete();
		return redirect()->route('supmanager.lop');
	}
	public function postNhap_SupManager(Request $request)
	{
		try
		{
			$import = new Lop();
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
				return redirect()->route('supmanager.lop')->with('warning', $messages);
			}
			else
			{
				return redirect()->route('supmanager.lop')->with('success', 'Đã nhập dữ liệu thành công!');
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
			return redirect()->route('supmanager.lop')->with('warning', $messages);
		}
	}
	
	public function getXuat_SupManager()
	{
		return Excel::download(new LopExport(), 'lop.xlsx');
	}
}
