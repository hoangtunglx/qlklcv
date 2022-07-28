<?php

namespace App\Imports;

use App\Models\DuLieuThoiKhoaBieu;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class DuLieuThoiKhoaBieuImport implements ToModel, SkipsEmptyRows, WithValidation, WithHeadingRow, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    public function model(array $row)
    {
        return new DuLieuThoiKhoaBieu([
            //
            'MaGiangVien'=>$row['CBGD'],		
            'MaHocPhan'=>$row['Mã HP'],
            'Nhom'=>$row['Nhóm'],
            'ToThucHanh'=>$row['Tổ TH'],
            'Phong'=>$row['Phòng'],
            'SiSoTKB'=>$row['Sỉ số TKB'],
            'Thu'=>$row['Thứ'],
            'TietBatDau'=>$row['Tiết bắt đầu'],
            'SoTiet'=>$row['Số tiết'],
            'TongSoTiet'=>$row['Tổng số tiết'],
            'Lop'=>$row['Lớp'],
            'HocKy'=>$row['Học kỳ']
        ]);
    }
    public function rules(): array
	{
		return [
            '*.CBGD' => 'required', 'string', 'max:10',
			'*.Mã HP' => 'required', 'string', 'max:10',
            '*.Nhóm' => 'required', 'string', 'max:3',
            '*.Tổ TH' => 'required', 'string', 'max:3',
			'*.Phòng' => 'required', 'string', 'max:50',
			'*.Sỉ số TKB' => 'required', 'numeric', 'max:999',
            '*.Thứ' => 'required', 'numeric', 'max:999',
            '*.Tiết bắt đầu' => 'required', 'numeric', 'max:999',
			'*.Số tiết' => 'required', 'numeric', 'max:999',
			'*.Tổng số tiết' => 'required', 'numeric', 'max:999',
            '*.Lớp' => 'required', 'string', 'max:50',
            '*.Học kỳ' =>'required', 'numeric', 'max:999'
		];
	}
}
