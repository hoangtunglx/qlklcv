<?php

namespace App\Exports;

use App\Models\Khoa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;

class KhoaExport implements FromCollection, WithHeadings, WithCustomStartCell, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
	{
		return [
			'MaKhoa',
			'TenKhoa',
		];
	}
	
	public function map($row): array
	{
		return [
			$row->MaKhoa,
			$row->TenKhoa,
		];
	}
	
	public function startCell(): string
	{
		return 'A1';
	}
    public function collection()
    {
        return Khoa::all();
    }
}
