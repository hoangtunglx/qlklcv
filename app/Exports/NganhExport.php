<?php

namespace App\Exports;

use App\Models\Nganh;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;

class NganhExport implements FromCollection, WithHeadings, WithCustomStartCell, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
	{
		return [
			'MaNganh',
			'TenNganh',
			'MaKhoa',
		];
	}
	
	public function map($row): array
	{
		return [
			$row->MaNganh,
			$row->TenNganh,
			$row->MaKhoa,
		];
	}
	
	public function startCell(): string
	{
		return 'A1';
	}
    public function collection()
    {
        return Nganh::all();
    }
}
