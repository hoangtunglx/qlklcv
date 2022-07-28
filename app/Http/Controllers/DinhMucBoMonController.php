<?php

namespace App\Http\Controllers;

use App\Exports\DinhMucBoMonExport;
use App\Models\BoMon;
use App\Models\DinhMucBoMon;
use App\Models\Khoa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DinhMucBoMonController extends Controller
{
	//
	public function getDanhSach_SupManager()
	{
		$dinhmucbomon = DinhMucBoMon::where("NamHoc", getNamHoc())->paginate(getSoDong());
        $bomon=BoMon::all();
		$mabomon='';
		return view('dashboard.supmanager.danhmuc.dinhmucbomon', compact('dinhmucbomon','bomon','mabomon'));
	}
	public function getDanhSach_Statistic()
	{
		$dinhmucbomon = DinhMucBoMon::where("NamHoc", getNamHoc())->paginate(getSoDong());
        $khoa=Khoa::all();
		$makhoa='';
		return view('dashboard.statistic.danhmuc.dinhmucbomon', compact('dinhmucbomon','khoa','makhoa'));
	}
	public function getDanhSach_Manager()
	{
		$dinhmucbomon = DinhMucBoMon::where("NamHoc", getNamHoc())
		->join('bomon','bomon.MaBoMon','=','dinhmucbomon.MaBoMon')
		->where('bomon.MaKhoa', getGV_Khoa())
		->paginate(getSoDong());
        $khoa=Khoa::all();
		$makhoa='';
		return view('dashboard.manager.danhmuc.dinhmucbomon', compact('dinhmucbomon','khoa','makhoa'));
	}
	public function postDanhSach_BoMon_SupManager(Request $request)
	{
		$dinhmucbomon = DinhMucBoMon::where("NamHoc", getNamHoc())->where('MaBoMon',$request->MaBoMon)->paginate(getSoDong());
        $bomon=BoMon::all();
		$mabomon=$request->MaBoMon;
		return view('dashboard.supmanager.danhmuc.dinhmucbomon', compact('dinhmucbomon','bomon','mabomon'));
	}
	public function postDanhSach_Khoa_Statistic(Request $request)
	{
		$dinhmucbomon = DinhMucBoMon::where("NamHoc", getNamHoc())
		->join('bomon','bomon.MaBoMon','=','dinhmucbomon.MaBoMon')
		->where('bomon.MaKhoa',$request->MaKhoa)->paginate(getSoDong());
        $khoa=Khoa::all();
		$makhoa=$request->MaKhoa;
		return view('dashboard.statistic.danhmuc.dinhmucbomon', compact('dinhmucbomon','khoa','makhoa'));
	}
	public function postThem_SupManager(Request $request)
	{
		$this->validate($request, [
            'MaBoMon' => ['required', 'string', 'max:5'],
			'TongDinhMuc' => ['required', 'numeric', 'min:0'],
            // 'NamHoc' => ['required', 'string', 'max:9']
		]);
		
		$orm = new DinhMucBoMon();
		$orm->MaBoMon = $request->MaBoMon;
		$orm->TongDinhMuc = $request->TongDinhMuc;
        $orm->NamHoc = getNamHoc();
		$orm->save();
		return redirect()->route('supmanager.dinhmucbomon');
	}
	public function postSua_SupManager(Request $request)
	{
		$this->validate($request, [
            'MaBoMon_edit' => ['required', 'string', 'max:5'],
			'TongDinhMuc_edit' => ['required', 'numeric', 'min:0'],
            // 'NamHoc_edit' => ['required', 'string', 'max:9']
		]);
		
		$orm = DinhMucBoMon::find($request->id_edit);
		$orm->MaBoMon = $request->MaBoMon_edit;
		$orm->TongDinhMuc = $request->TongDinhMuc_edit;
        // $orm->NamHoc = $request->NamHoc_edit;
		$orm->save();
		return redirect()->route('supmanager.dinhmucbomon');
	}
	public function postXoa_SupManager(Request $request)
	{
		$orm = DinhMucBoMon::find($request->ID_delete);
		$orm->delete();
		return redirect()->route('supmanager.dinhmucbomon');
	}
	public function postNhap_SupManager(Request $request)
	{
		try
		{
			$import = new DinhMucBoMon();
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
				return redirect()->route('supmanager.dinhmucbomon')->with('warning', $messages);
			}
			else
			{
				return redirect()->route('supmanager.dinhmucbomon')->with('success', 'Đã nhập dữ liệu thành công!');
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
			return redirect()->route('supmanager.dinhmucbomon')->with('warning', $messages);
		}
	}
	
	public function getXuat_SupManager()
	{
		return Excel::download(new DinhMucBoMonExport(), 'dinhmucbomon.xlsx');
	}
}
