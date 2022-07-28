<?php

namespace App\Exports;

use App\Models\BoMon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BoMonExport implements FromCollection, WithHeadings, WithCustomStartCell, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
	{
		return [
			'f_mabm',		
            'f_makh',
            'f_tenbmvn',
			'f_tenkhvn'
		];
	}
	
	public function map($row): array
	{
		return [
			$row->MaBoMon,
			$row->TenBoMon,
            $row->MaKhoa,
			$row->Khoa->TenKhoa
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
