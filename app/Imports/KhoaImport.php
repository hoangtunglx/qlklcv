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
			'MaKhoa' => $row['makhoa'],
			'TenKhoa' => $row['tenkhoa']
        ]);
    }
    public function rules(): array
	{
		return [
			'*.makhoa' => 'required|string|max:5|unique:khoa',
			'*.tenkhoa' => 'required|string|max:191',
		];
	}
}
