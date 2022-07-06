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
            'MaHocPhan' => $row['mahocphan'],
			'TenHocPhan' => $row['tenhocphan'],
            'SoTinChi' => $row['sotinchi'],
            'SoTietLyThuyet' => $row['sotietlythuyet'],
            'SoTietThucHanh' => $row['sotietthuchanh']
        ]);
    }
    public function rules(): array
	{
		return [
			'*.mahocphan' => 'required', 'string', 'max:10','unique:HocPhan',
			'*.tenhocphan' => 'required', 'string', 'max:191',
			'*.sotinchi' => 'required', 'numeric',
			'*.sotietlythuyet' => 'required', 'numeric',
			'*.sotietthuchanh' => 'required','numeric'
		];
	}
}
