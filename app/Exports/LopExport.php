<?php

namespace App\Exports;

use App\Models\Lop;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class LopExport implements FromCollection, WithHeadings, WithCustomStartCell, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
	{
		return [
			'MaLop',
			'MaKhoa',
            'TenLop',
            'SiSo'
		];
	}
	
	public function map($row): array
	{
		return [
			$row->MaLop,
			$row->MaKhoa,
            $row->TenLop,
            $row->SiSo
		];
	}
	
	public function startCell(): string
	{
		return 'A1';
	}
    public function collection()
    {
        return Lop::all();
    }
}
