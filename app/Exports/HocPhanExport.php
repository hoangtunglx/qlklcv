<?php

namespace App\Exports;

use App\Models\HocPhan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;

class HocPhanExport implements FromCollection, WithHeadings, WithCustomStartCell, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
	{
		return [
			'MaHocPhan',
			'TenHocPhan',
            'SoTinChi',
            'SoTietLyThuyet',
            'SoTietThucHanh'
		];
	}
	
	public function map($row): array
	{
		return [
			$row->MaHocPhan,
			$row->TenHocPhan,
            $row->SoTinChi,
            $row->SoTietLyThuyet,
            $row->SoTietThucHanh,
		];
	}
	
	public function startCell(): string
	{
		return 'A1';
	}
    public function collection()
    {
        return HocPhan::all();
    }
}
