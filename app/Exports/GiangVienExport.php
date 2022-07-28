<?php

namespace App\Exports;

use App\Models\GiangVien;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class GiangVienExport implements FromCollection, WithHeadings, WithCustomStartCell, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
	{
		return [
			'f_manv',
			'HoVaTen',
			'email',
            'f_mabm',
            'nn'
		];
	}
	
	public function map($row): array
	{
		return [
			$row->MaGiangVien,
			$row->HoVaTen,
            $row->Email,
            $row->MaBoMon,
            $row->MaNgach
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
