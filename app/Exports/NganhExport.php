<?php

namespace App\Exports;

use App\Models\Nganh;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class NganhExport implements FromCollection, WithHeadings, WithCustomStartCell, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
	{
		return [
			'f_makh',
			'f_mang',
			'f_tenngvn',
		];
	}
	
	public function map($row): array
	{
		return [
			$row->MaKhoa,
			$row->MaNganh,
			$row->TenNganh			
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
