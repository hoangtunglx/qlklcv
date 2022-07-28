<?php

namespace App\Http\Controllers;

use App\Exports\KhoaExport;
use App\Models\Khoa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
class KhoaController extends Controller
{
    //
    public function getDanhSach()
	{
		$khoa = Khoa::all();
		return view('dashboard.supmanager.danhmuc.khoa', compact('khoa'));
	}
    public function postThem(Request $request)
	{
		$this->validate($request, [
            'MaKhoa' => ['required', 'string', 'max:5', 'unique:khoa'],
			'TenKhoa' => ['required', 'string', 'max:191', 'unique:khoa']
		]);
		
		$orm = new Khoa();
		$orm->MaKhoa = $request->MaKhoa;
		$orm->TenKhoa = $request->TenKhoa;
		$orm->save();
		
		return redirect()->route('supmanager.khoa');
	}
    public function postSua(Request $request)
	{

		$this->validate($request, [
            'MaKhoa_edit' => ['required', 'string', 'max:5', 'unique:khoa,MaKhoa,'. $request->id_edit.',MaKhoa'],
			'TenKhoa_edit' => ['required', 'string', 'max:191', 'unique:khoa,TenKhoa,'. $request->id_edit.',MaKhoa']
		]);
		
		$orm = Khoa::where('MaKhoa',$request->id_edit)->first();
		$orm->MaKhoa = $request->MaKhoa_edit;
		$orm->TenKhoa = $request->TenKhoa_edit;
		$orm->save();
		
		return redirect()->route('supmanager.khoa');
	}
	public function postXoa(Request $request)
	{
		$orm = Khoa::find($request->MaKhoa_delete);
		$orm->delete();
		
		return redirect()->route('supmanager.khoa');
	}
	public function postNhap_SupManager(Request $request)
	{
		try
		{
			$import = new Khoa();
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
				return redirect()->route('supmanager.khoa')->with('warning', $messages);
			}
			else
			{
				return redirect()->route('supmanager.khoa')->with('success', 'Đã nhập dữ liệu thành công!');
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
			return redirect()->route('supmanager.khoa')->with('warning', $messages);
		}
	}
	
	public function getXuat_SupManager()
	{
		return Excel::download(new KhoaExport(), 'khoa.xlsx');
	}
}
