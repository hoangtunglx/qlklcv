<?php

namespace App\Exports;

use App\Models\DuLieuThoiKhoaBieu;
use Maatwebsite\Excel\Concerns\FromCollection;

class DuLieuThoiKhoaBieuExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DuLieuThoiKhoaBieu::all();
    }
}
