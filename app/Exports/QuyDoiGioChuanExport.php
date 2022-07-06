<?php

namespace App\Exports;

use App\Models\QuyDoiGioChuan;
use Maatwebsite\Excel\Concerns\FromCollection;

class QuyDoiGioChuanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return QuyDoiGioChuan::all();
    }
}
