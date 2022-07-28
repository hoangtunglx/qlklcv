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
            'MaBoMon' => $row['f_mabm'],
            'MaKhoa' => $row['f_makh'],
			'TenBoMon' => $row['f_tenbmvn']
            
        ]);
    }
    public function rules(): array
	{
		return [
            '*.f_mabm' => 'required', 'string', 'max:5', 'unique:bomon',
            '*.f_makh' => 'required', 'string', 'max:5',
			'*.f_tenbmvn' => 'required', 'string', 'max:191','unique:bomon,TenBoMon'
            
		];
	}
}
