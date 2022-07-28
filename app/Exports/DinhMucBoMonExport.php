<?php

namespace App\Exports;

use App\Models\DinhMucBoMon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DinhMucBoMonExport implements FromCollection, WithHeadings, WithCustomStartCell, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
	{
		return [
			'MaBoMon',
			'TongDinhMuc',
            'NamHoc'
		];
	}
	
	public function map($row): array
	{
		return [
			$row->MaBoMon,
			$row->TongDinhMuc,
            $row->NamHoc
		];
	}
	
	public function startCell(): string
	{
		return 'A1';
	}
    public function collection()
    {
        return DinhMucBoMon::all();
    }
}
