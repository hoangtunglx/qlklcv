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
            'MaKhoa' => $row['f_makh'],
            'MaNganh' => $row['f_mang'],
			'TenNganh' => $row['f_tenngvn']          
        ]);
    }
    public function rules(): array
	{
		return [
			'*.f_mang' => 'required', 'string', 'max:5', 'unique:nganh',
			'*.f_tenngvn' => 'required', 'string', 'max:191','unique:nganh,TenNganh',
            '*.f_makh' => 'required', 'string', 'max:191'
		];
	}
}
