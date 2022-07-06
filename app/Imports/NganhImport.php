<?php

namespace App\Imports;

use App\Models\Nganh;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class NganhImport implements ToModel, SkipsEmptyRows, WithValidation, WithHeadingRow, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Nganh([
            //
            'MaNganh' => $row['manganh'],
			'TenNganh' => $row['tennganh'],
            'MaKhoa' => $row['makhoa']
        ]);
    }
    public function rules(): array
	{
		return [
			'*.manganh' => 'required', 'string', 'max:5', 'unique:nganh',
			'*.tennganh' => 'required', 'string', 'max:191','unique:nganh,TenNganh',
            '*.makhoa' => 'required', 'string', 'max:191'
		];
	}
}
