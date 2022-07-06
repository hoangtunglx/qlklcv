<?php

namespace App\Exports;

use App\Models\BoMon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;

class BoMonExport implements FromCollection, WithHeadings, WithCustomStartCell, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
	{
		return [
			'MaBoMon',		
            'TenBoMon',
            'MaKhoa',
		];
	}
	
	public function map($row): array
	{
		return [
			$row->MaBoMon,
			$row->TenBoMon,
            $row->MaKhoa,
		];
	}
	
	public function startCell(): string
	{
		return 'A1';
	}
    public function collection()
    {
        return BoMon::all();
    }
}
