<?php

namespace App\Exports;

use App\Models\QuyDoiGiamDinhMuc;
use Maatwebsite\Excel\Concerns\FromCollection;

class QuyDoiGiamDinhMucExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return QuyDoiGiamDinhMuc::all();
    }
}
