<?php

namespace App\Http\Controllers;

use App\Exports\NganhExport;
use App\Models\Khoa;
use App\Models\Nganh;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class NganhController extends Controller
{
    //
    public function getDanhSach()
	{
		$nganh = Nganh::paginate(getSoDong());
        $khoa =Khoa::all();
		$makhoa='';
		return view('dashboard.supmanager.danhmuc.nganh', compact('nganh','khoa','makhoa'));
	}
	public function postDanhSach_Khoa(Request $request)
	{
		$nganh = Nganh::where('MaKhoa', $request->MaKhoa)->paginate(getSoDong());
        $khoa =Khoa::all();
		$makhoa=$request->MaKhoa;
		return view('dashboard.supmanager.danhmuc.nganh', compact('nganh','khoa','makhoa'));
	}
    public function postThem(Request $request)
	{
		$this->validate($request, [
            'MaNganh' => ['required', 'string', 'max:5', 'unique:nganh'],
			'TenNganh' => ['required', 'string', 'max:191','unique:nganh,TenNganh'],
            'MaKhoa' => ['required', 'string', 'max:191']
		]);
		
		$orm = new Nganh();
		$orm->MaNganh = $request->MaNganh;
		$orm->TenNganh = $request->TenNganh;
        $orm->MaKhoa = $request->MaKhoa;
		$orm->save();
		
		return redirect()->route('supmanager.nganh');
	}
    public function postSua(Request $request)
	{

		$this->validate($request, [
            'MaNganh_edit' => ['required', 'string', 'max:5', 'unique:nganh,MaNganh,'. $request->id_edit.',MaNganh'],
			'TenNganh_edit' => ['required', 'string', 'max:191','unique:nganh,TenNganh,'. $request->id_edit.',MaNganh'],
            'MaKhoa_edit' => ['required', 'string', 'max:191'],
		]);
		
		$orm = Nganh::find($request->id_edit);
		$orm->MaNganh = $request->MaNganh_edit;
		$orm->TenNganh = $request->TenNganh_edit;
        $orm->MaKhoa = $request->MaKhoa_edit;
		$orm->save();
		
		return redirect()->route('supmanager.nganh');
	}
    public function postXoa(Request $request)
	{
		$orm = Nganh::find($request->MaNganh_delete);
		$orm->delete();
		
		return redirect()->route('supmanager.nganh');
	}
	public function postNhap_SupManager(Request $request)
	{
		try
		{
			$import = new Nganh();
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
				return redirect()->route('supmanager.nganh')->with('warning', $messages);
			}
			else
			{
				return redirect()->route('supmanager.nganh')->with('success', 'Đã nhập dữ liệu thành công!');
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
			return redirect()->route('supmanager.nganh')->with('warning', $messages);
		}
	}
	
	public function getXuat_SupManager()
	{
		return Excel::download(new NganhExport(), 'nganh.xlsx');
	}
}
