<?php

namespace App\Imports;

use App\Models\QuyDoiGiamDinhMuc;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class QuyDoiGiamDinhMucImport implements ToModel, SkipsEmptyRows, WithValidation, WithHeadingRow, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    public function model(array $row)
    {
        return new QuyDoiGiamDinhMuc([
            //
			'HoatDong' => $row['hoatdong'],
			'PhanTramDinhMuc' => $row['phantramdinhmuc'],
            'NamHoc'=> $row['namhoc']
        ]);
    }
    public function rules(): array
	{
		return [
			'*.hoathong' => 'required', 'string', 'max:191',
            '*.phantramdinhmuc' => 'required', 'numeric', 'min:0',
        	'*.namhoc' => 'required', 'string', 'max:9'
		];
	}
}
