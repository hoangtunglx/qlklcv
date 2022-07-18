<?php

use App\Models\QuyDinh;

    function getQuyDinh()
    {
        $quydinh=QuyDinh::take(1)->first();
        return $quydinh;
    }
    function getNamHoc()
    {
        return getQuyDinh()->NamHocHienTai;
        
    }
    function getSoDong()
    {
        return getQuyDinh()->SoLuongDongTrenMotTrang;
    }
    function getNgayMoKeKhai()
    {
        return getQuyDinh()->NgayMoKeKhai;
    }
    function getNgayDongKeKhai()
    {
        return getQuyDinh()->NgayDongKeKhai;
    }
?>