<?php

namespace App\Imports;

use App\Models\BoMon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class BoMonImport implements ToModel, SkipsEmptyRows, WithValidation, WithHeadingRow, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new BoMon([
            //
            'MaBoMon' => $row['mabomon'],
			'TenBoMon' => $row['tenbomon'],
            'MaKhoa' => $row['makhoa']
        ]);
    }
    public function rules(): array
	{
		return [
            '*.mabomon' => 'required', 'string', 'max:5', 'unique:bomon',
			'*.tenbomon' => 'required', 'string', 'max:191','unique:bomon,TenBoMon',
            '*.makhoa' => 'required', 'string', 'max:5'
		];
	}
}
