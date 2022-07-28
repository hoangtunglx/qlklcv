<?php

namespace App\Exports;

use App\Models\DuLieuThoiKhoaBieu;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class DuLieuThoiKhoaBieuExport implements FromCollection, WithHeadings,  WithCustomStartCell, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
	{
		return [
			'CBGD',		
            'Mã HP',
            'Nhóm',
            'Tổ TH',
            'Phòng',
            'Sỉ số TKB',
            'Thứ',
            'Tiết bắt đầu',
            'Số tiết',
            'Tổng số tiết',
            'Lớp',
            'Học kỳ'
		];
	}
	
	public function map($row): array
	{
		return [
			$row->MaGiangVien,
			$row->MaHocPhan,
            $row->Nhom,
            $row->ToThuHanh,
            $row->Phong,
            $row->SiSoTKB,
            $row->Thu,
            $row->TietBatDau,
            $row->SoTiet,
            $row->TongSoTiet,
            $row->Lop,
            $row->HocKy
		];
	}
	
	public function startCell(): string
	{
		return 'A1';
	}
    public function collection()
    {
        return DuLieuThoiKhoaBieu::all();
    }
}
