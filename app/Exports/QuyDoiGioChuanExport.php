<?php

namespace App\Exports;

use App\Models\QuyDoiGioChuan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class QuyDoiGioChuanExport implements FromCollection, WithHeadings,  WithCustomStartCell, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
	{
		return [
			'HoatDong',		
            'GioChuan',
            'NamHoc',
		];
	}
	
	public function map($row): array
	{
		return [
			$row->HoatDong,
			$row->GioChuan,
            $row->NamHoc,
		];
	}
	
	public function startCell(): string
	{
		return 'A1';
	}
    public function collection()
    {
        return QuyDoiGioChuan::all();
    }
}
