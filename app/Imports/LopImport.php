<?php

namespace App\Imports;

use App\Models\Lop;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class LopImport implements ToModel, SkipsEmptyRows, WithValidation, WithHeadingRow, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Lop([
            //
            'MaLop' => $row['malop'],
			'TenLop' => $row['tenlop'],
            'SiSo' => $row['siso'],
            'MaKhoa' => $row['makhoa']
        ]);
    }
    public function rules(): array
	{
		return [
			'*.malop' => ['required', 'string', 'max:10', 'unique:lop'],
			'*.tenlop' => ['required', 'string', 'max:191','unique:lop,TenLop'],
            '*.siso' => ['required', 'numeric', 'min:1'],
            '*.makhoa' => ['required', 'string', 'max:5']
		];
	}
}
