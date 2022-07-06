<?php

namespace App\Imports;

use App\Models\QuyDoiHeSo;
use Maatwebsite\Excel\Concerns\ToModel;

class QuyDoiHeSoImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new QuyDoiHeSo([
            //
        ]);
    }
}
