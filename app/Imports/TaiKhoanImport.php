<?php

namespace App\Imports;

use App\Models\TaiKhoan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class TaiKhoanImport implements ToModel, SkipsEmptyRows, WithValidation, WithHeadingRow, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new TaiKhoan([
            //
            'name' => $row['name'],
			'username' => $row['username'],
            'email' => $row['email'],
            'password' => $row['username'],
            'privilege' => $row['privilege']
        ]);
    }
    public function rules(): array
	{
		return [
			'*.name' => 'required|string|max:5|unique:khoa',
			'*.username' => 'required|string|max:191',
            '*.email' => ['required', 'email', 'max:191', 'unique:taikhoan'],
			'*.password' => ['required', 'string', 'min:6', 'confirmed'],
			'*.privilege' => ['required'],
		];
	}
}
