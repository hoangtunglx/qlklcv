<?php

namespace App\Imports;

use App\Models\Ngach;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class NgachImport implements ToModel, SkipsEmptyRows, WithValidation, WithHeadingRow, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Ngach([
            //
            'MaNgach' => $row['mangach'],
			'DienGiai' => $row['diengiai'],
            'DinhMucGiangDay' => $row['dinhmucgiangday'],
			'DinhMucNCKH' => $row['dinhmucnckh']
        ]);
    }
    public function rules(): array
	{
		return [
            '*.mangach' => 'required', 'string', 'max:191', 'unique:ngach',
			'*.diengiai' => 'required', 'string', 'max:191','unique:ngach,DienGiai',
            '*.dinhmucgiangday' => 'required', 'numeric', 'min:0',
            '*.dinhmucnckh' => 'required', 'numeric', 'min:0'
		];
	}
}
