<?php

namespace App\Imports;

use App\Models\QuyDoiGioChuan;
use Maatwebsite\Excel\Concerns\ToModel;

class QuyDoiGioChuanImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new QuyDoiGioChuan([
            //
        ]);
    }
}
