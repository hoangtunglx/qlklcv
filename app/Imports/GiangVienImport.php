<?php

namespace App\Imports;

use App\Models\GiangVien;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class GiangVienImport implements ToModel, SkipsEmptyRows, WithValidation, WithHeadingRow, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $hovaten=$row['f_holotcbv'].' '.$row['f_tencbv'];
        return new GiangVien([
            //
            'MaGiangVien' => $row['f_manv'],
			'HoVaTen' =>  $hovaten,
            'Email' => $row['email'],
            'MaBoMon' => $row['f_mabm'],
			'MaNgach' => $row['nn']
        ]);
    }
    public function rules(): array
	{
		return [
			'*.f_manv' => ['required', 'string', 'max:10', 'unique:giangvien'],
			'*.hovaten' => ['required', 'string', 'max:191'],
            '*.email' => ['required', 'email', 'max:191'],
            '*.f_mabm' => ['required', 'string', 'max:5'],
            '*.nn' => ['required', 'string', 'max:10']
		];
	}
}
