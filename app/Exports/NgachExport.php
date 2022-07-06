<?php

namespace App\Exports;

use App\Models\Ngach;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;
class NgachExport implements FromCollection, WithHeadings, WithCustomStartCell, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
	{
		return [
			'MaNgach',
			'DienGiai',
            'DinhMucGiangDay',
            'DinhMucNCKH'
		];
	}
	
	public function map($row): array
	{
		return [
			$row->MaNgach,
			$row->DienGiai,
            $row->DinhMucGiangDay,
            $row->DinhMucNCKH
		];
	}
	
	public function startCell(): string
	{
		return 'A1';
	}
    public function collection()
    {
        return Ngach::all();
    }
}
