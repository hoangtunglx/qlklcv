<?php

namespace App\Http\Controllers;

use App\Exports\HocPhanExport;
use App\Models\HocPhan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HocPhanController extends Controller
{
    //
    public function getDanhSach()
	{
		$hocphan = HocPhan::paginate(getSoDong());
		return view('dashboard.supmanager.danhmuc.hocphan', compact('hocphan'));
	}
    public function postThem(Request $request)
	{
		$this->validate($request, [
			'MaHocPhan' => ['required', 'string', 'max:10','unique:HocPhan'],
			'TenHocPhan' => ['required', 'string', 'max:191'],
			'SoTinChi' => ['required', 'numeric'],
			'SoTietLyThuyet' => ['required', 'numeric'],
			'SoTietThucHanh' => ['required','numeric']
		]);
		
		$orm = new HocPhan();
		$orm->MaHocPhan = $request->MaHocPhan;
		$orm->TenHocPhan = $request->TenHocPhan;
        if($request->SoTinChi)
		    $orm->SoTinChi = $request->SoTinChi;
        if($request->SoTietLyThuyet)
		    $orm->SoTietLyThuyet = $request->SoTietLyThuyet;
        if($request->SoTietThucHanh)
            $orm->SoTietThucHanh = $request->SoTietThucHanh;
		$orm->save();
		
		return redirect()->route('supmanager.hocphan');
	}
	public function postSua(Request $request)
	{

		$this->validate($request, [
            'MaHocPhan_edit' => ['required', 'string', 'max:10', 'unique:hocphan,MaHocPhan,'. $request->id_edit.',MaHocPhan'],
			'TenHocPhan_edit' => ['required', 'string', 'max:191'],
			'SoTinChi_edit' => ['required', 'numeric'],
			'SoTietLyThuyet_edit' => ['required', 'numeric'],
			'SoTietThucHanh_edit' => ['required','numeric']
		]);
		
		$orm = HocPhan::find($request->id_edit);
		$orm->MaHocPhan = $request->MaHocPhan_edit;
		$orm->TenHocPhan = $request->TenHocPhan_edit;
		$orm->SoTinChi = $request->SoTinChi_edit;
		$orm->SoTietLyThuyet = $request->SoTietLyThuyet_edit;
		$orm->SoTietThucHanh = $request->SoTietThucHanh_edit;
		$orm->save();
		
		return redirect()->route('supmanager.hocphan');
	}
	public function postXoa(Request $request)
	{
		$orm =HocPhan::find($request->MaHocPhan_delete);
		$orm->delete();
		
		return redirect()->route('supmanager.hocphan');
	}
	public function postNhap(Request $request)
	{
		try
		{
			$import = new HocPhan();
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
				return redirect()->route('supmanager.hocphan')->with('warning', $messages);
			}
			else
			{
				return redirect()->route('supmanager.hocphan')->with('success', 'Đã nhập dữ liệu thành công!');
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
			return redirect()->route('supmanager.hocphan')->with('warning', $messages);
		}
	}
	
	public function getXuat()
	{
		return Excel::download(new HocPhanExport(), 'hocphan.xlsx');
	}
}
