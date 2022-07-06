<?php

namespace App\Exports;

use App\Models\QuyDoiHeSo;
use Maatwebsite\Excel\Concerns\FromCollection;

class QuyDoiHeSoExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return QuyDoiHeSo::all();
    }
}
