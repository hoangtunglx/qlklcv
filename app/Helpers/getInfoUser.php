<?php

use App\Models\GiangVien;
use App\Models\QuyDinh;
use Illuminate\Support\Facades\Auth;

    function getGiangVien()
    {
        $giangvien=GiangVien::where('Email', Auth::user()->email)
        ->join('bomon','bomon.MaBoMon','=','giangvien.MaBoMon')
        ->first();
        return $giangvien;
    }
    function getGV_BM()
    {
        return getGiangVien()->MaBoMon;
        
    }
    function getGV_Khoa()
    {
        return getGiangVien()->MaKhoa;
    }
    // function getNgayMoKeKhai()
    // {
    //     return getQuyDinh()->NgayMoKeKhai;
    // }
    // function getNgayDongKeKhai()
    // {
    //     return getQuyDinh()->NgayDongKeKhai;
    // }
?>