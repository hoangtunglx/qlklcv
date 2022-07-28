<?php

namespace App\Imports;

use App\Models\Khoa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class KhoaImport implements ToModel, SkipsEmptyRows, WithValidation, WithHeadingRow, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    public function model(array $row)
    {
        return new Khoa([
            //
			'MaKhoa' => $row['f_makh'],
			'TenKhoa' => $row['f_tenkhvn']
        ]);
    }
    public function rules(): array
	{
		return [
			'*.f_makh' => 'required|string|max:5|unique:khoa',
			'*.f_tenkhvn' => 'required|string|max:191',
		];
	}
}
