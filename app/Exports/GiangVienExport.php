<?php

namespace App\Exports;

use App\Models\GiangVien;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;

class GiangVienExport implements FromCollection, WithHeadings, WithCustomStartCell, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
	{
		return [
			'MaGiangVien',
			'MaNgach',
            'MaBoMon',
            'HoVaTen',
            'Email'
		];
	}
	
	public function map($row): array
	{
		return [
			$row->MaGiangVien,
			$row->MaNgach,
            $row->MaBoMon,
            $row->HoVaTen,
            $row->Email
		];
	}
	
	public function startCell(): string
	{
		return 'A1';
	}
    public function collection()
    {
        return GiangVien::all();
    }
}
