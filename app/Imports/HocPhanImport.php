<?php

namespace App\Imports;

use App\Models\HocPhan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class HocPhanImport implements ToModel, SkipsEmptyRows, WithValidation, WithHeadingRow, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new HocPhan([
            //

            'MaHocPhan' => $row['f_mamh'],
			'TenHocPhan' => $row['f_tenmhvn'],
            'SoTinChi' => $row['f_dvht'],
            'SoTietLyThuyet' => $row['f_lt'],
            'SoTietThucHanh' => $row['f_tn']
        ]);
    }
    public function rules(): array
	{
		return [
			'*.f_mamh' => 'required', 'string', 'max:10','unique:HocPhan',
			'*.f_tenmhvn' => 'required', 'string', 'max:191',
			'*.f_dvht' => 'required', 'numeric',
			'*.f_lt' => 'required', 'numeric',
			'*.f_tn' => 'required','numeric'
		];
	}
}
